<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Import edit block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */

namespace Ibnab\Common\Block\Adminhtml\Import;

class Edit extends \Magento\Backend\Block\Widget\Form\Container {

    /**
     * Internal constructor
     *
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->_objectId = 'import_id';
        $this->_blockGroup = 'Ibnab_Common';
        $this->_controller = 'adminhtml_import';
    }

    /**
     * Get header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText() {
        return __('Import');
    }

}
