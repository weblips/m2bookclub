<?php
namespace Weblips\Test\Controller\Adminhtml\Forms;

use Magento\Backend\App\Action;
use Weblips\Test\Model\Page;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
            
class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Weblips_Test::test';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Weblips\Test\Model\Forms::STATUS_ENABLED;
            }
            if (empty($data['weblips_test_forms_id'])) {
                $data['weblips_test_forms_id'] = null;
            }

            /** @var Weblips\Test\Model\Forms $model */
            $model = $this->_objectManager->create('Weblips\Test\Model\Forms');

            $id = $this->getRequest()->getParam('weblips_test_forms_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the thing.'));
                $this->dataPersistor->clear('weblips_test_forms');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['weblips_test_forms_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('weblips_test_forms', $data);
            return $resultRedirect->setPath('*/*/edit', ['weblips_test_forms_id' => $this->getRequest()->getParam('weblips_test_forms_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }    
}
