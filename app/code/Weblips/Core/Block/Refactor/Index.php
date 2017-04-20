<?php
namespace Weblips\Core\Block\Refactor;
class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
                     parent::__construct($context);
	}
        
    public function getParams() {
        return 'Новая категория+';
    } 

    
}