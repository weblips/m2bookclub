<?php
namespace Weblips\Core\Block\Test;
class Test extends \Magento\Framework\View\Element\Template
{
    protected $array_mix = ['книги', 'Художественная литература', 'Зарубежная литература'];
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

	public function sayAdminPanel()
	{
		return __('Bookclub Admin Panel:');
	}
        
        public function getCategoris() {
            return $this->array_mix;
        }
}