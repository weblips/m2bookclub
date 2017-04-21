<?php

namespace Ibnab\Common\Block\Adminhtml\Banners;

/**
 * Slider block edit form container
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container {

    protected function _construct() {
        parent::_construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'Ibnab_Common';
        $this->_controller = 'adminhtml_banners';
        
    }
    /**
     * Get header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText() {
        return __('Create Banners');
    }

}
