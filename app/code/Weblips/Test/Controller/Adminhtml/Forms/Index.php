<?php
namespace Weblips\Test\Controller\Adminhtml\Forms;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Weblips_Test::test';  
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/index/index');
        return $resultRedirect;
    }     
}
