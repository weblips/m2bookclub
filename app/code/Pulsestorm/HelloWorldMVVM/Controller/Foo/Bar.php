<?php
namespace Pulsestorm\HelloWorldMVVM\Controller\Foo;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Bar extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        var_dump("Proof of life");
    }
}