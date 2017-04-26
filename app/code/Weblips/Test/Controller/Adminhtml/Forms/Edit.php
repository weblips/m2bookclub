<?php
namespace Weblips\Test\Controller\Adminhtml\Forms;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Weblips_Test::test';       
    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();  
    }    
}
