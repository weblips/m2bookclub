<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ibnab\Common\Block\Adminhtml\Import\Edit;

use Magento\ImportExport\Model\Import;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;

/**
 * Import edit form block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Basic import model
     *
     * @var \Magento\ImportExport\Model\Import
     */
    protected $_importModel;

    /**
     * @var \Magento\ImportExport\Model\Source\Import\EntityFactory
     */
    protected $_entityFactory;

    /**
     * @var \Magento\ImportExport\Model\Source\Import\Behavior\Factory
     */
    protected $_behaviorFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\ImportExport\Model\Import $importModel
     * @param \Magento\ImportExport\Model\Source\Import\EntityFactory $entityFactory
     * @param \Magento\ImportExport\Model\Source\Import\Behavior\Factory $behaviorFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\ImportExport\Model\Import $importModel,
        \Magento\ImportExport\Model\Source\Import\EntityFactory $entityFactory,
        \Magento\ImportExport\Model\Source\Import\Behavior\Factory $behaviorFactory,
        array $data = []
    ) {
        $this->_entityFactory = $entityFactory;
        $this->_behaviorFactory = $behaviorFactory;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_importModel = $importModel;
    }

    /**
     * Add fieldsets
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('adminhtml/*/validate'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ],
            ]
        );

        // base fieldset
        $uniqueBehaviors = $this->_importModel->getUniqueEntityBehaviors();
        foreach ($uniqueBehaviors as $behaviorCode => $behaviorClass) {
            $fieldsets[$behaviorCode] = $form->addFieldset(
                $behaviorCode . '_fieldset',
                ['legend' => __('Import Behavior')]
            );
            $fieldsets[$behaviorCode]->addField(
                'entity',
                'hidden',
                [
                    'name' => 'entity',
                    'required' => true,
                    'value' => $this->getRequest()->getParam('entity'),
                    'after_element_html' => $this->getDownloadSampleFileHtml($this->getRequest()->getParam('entity')),
                ]
            );
            /** @var $behaviorSource \Magento\ImportExport\Model\Source\Import\AbstractBehavior */
            $fieldsets[$behaviorCode]->addField(
                $behaviorCode,
                'select',
                [
                    'name' => 'behavior',
                    'title' => __('Import Behavior'),
                    'label' => __('Import Behavior'),
                    'required' => true,
                    'values' => $this->_behaviorFactory->create($behaviorClass)->toOptionArray(),
                    'class' => $behaviorCode,
                    'note' => 'Operation based on email(search same email for add/update replace or delete)',
                ]
            );
            $fieldsets[$behaviorCode]->addField(
                $behaviorCode . \Magento\ImportExport\Model\Import::FIELD_NAME_VALIDATION_STRATEGY,
                'select',
                [
                    'name' => \Magento\ImportExport\Model\Import::FIELD_NAME_VALIDATION_STRATEGY,
                    'title' => __(' '),
                    'label' => __(' '),
                    'required' => true,
                    'class' => $behaviorCode,
                    'values' => [
                        ProcessingErrorAggregatorInterface::VALIDATION_STRATEGY_STOP_ON_ERROR => 'Stop on Error',
                        ProcessingErrorAggregatorInterface::VALIDATION_STRATEGY_SKIP_ERRORS => 'Skip error entries'
                    ],
                ]
            );
            $fieldsets[$behaviorCode]->addField(
                $behaviorCode . '_' . \Magento\ImportExport\Model\Import::FIELD_NAME_ALLOWED_ERROR_COUNT,
                'text',
                [
                    'name' => \Magento\ImportExport\Model\Import::FIELD_NAME_ALLOWED_ERROR_COUNT,
                    'label' => __('Allowed Errors Count'),
                    'title' => __('Allowed Errors Count'),
                    'required' => true,
                    'value' => 10,
                    'class' => $behaviorCode . ' validate-number validate-greater-than-zero input-text',
                    'note' => __(
                        'Please specify number of errors to halt import process'
                    ),
                ]
            );
            $fieldsets[$behaviorCode]->addField(
                $behaviorCode . '_' . \Magento\ImportExport\Model\Import::FIELD_FIELD_SEPARATOR,
                'text',
                [
                    'name' => \Magento\ImportExport\Model\Import::FIELD_FIELD_SEPARATOR,
                    'label' => __('Field separator'),
                    'title' => __('Field separator'),
                    'required' => true,
                    'class' => $behaviorCode,
                    'value' => ',',
                ]
            );
            $fieldsets[$behaviorCode]->addField(
                $behaviorCode . \Magento\ImportExport\Model\Import::FIELD_FIELD_MULTIPLE_VALUE_SEPARATOR,
                'text',
                [
                    'name' => \Magento\ImportExport\Model\Import::FIELD_FIELD_MULTIPLE_VALUE_SEPARATOR,
                    'label' => __('Multiple value separator'),
                    'title' => __('Multiple value separator'),
                    'required' => true,
                    'class' => $behaviorCode,
                    'value' => Import::DEFAULT_GLOBAL_MULTI_VALUE_SEPARATOR,
                ]
            );
       

        // fieldset for file uploading
        $fieldsets['upload'] = $form->addFieldset(
            'upload_file_fieldset',
            ['legend' => __('File to Import')]
        );
        $fieldsets['upload']->addField(
            \Magento\ImportExport\Model\Import::FIELD_NAME_SOURCE_FILE,
            'file',
            [
                'name' => \Magento\ImportExport\Model\Import::FIELD_NAME_SOURCE_FILE,
                'label' => __('Select File to Import'),
                'title' => __('Select File to Import'),
                'required' => true,
                'class' => 'input-file'
            ]
        );

        

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
    /**
     * Get download sample file html
     *
     * @return string
     */
    protected function getDownloadSampleFileHtml($entityName=null)
    {
        $html = '<span id="sample-file-span"><a id="sample-file-link" href="'.$this->getUrl('*/*/download/', ['filename' => $entityName]).'">'
            . __('Download Sample File')
            . '</a></span>';
        return $html;
    }
}
