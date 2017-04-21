define([
    'uiComponent',
    'jquery',
    'ko',
    'underscore',
    'Magento_Ui/js/core/app',
    'uiLayout',
], function (Component, $, ko, _,bootstrap,layout) {
    'use strict';

    return Component.extend({
        defaults: {
            button: '',
            importModal: null,
            dataProvider: '',
            varienImport: '',
            staticSelector: '[id="import-popup"]',
            OnclickShowImportPopup: {
                name: 'OnclickShowImportPopup',
                component: 'Ibnab_Common/js/onclickimportpopup',
                enabled: true,
                statisticUrl: '',
            },
        },

        /**
         * Initialize
         * @param {Array} options
         */
        initialize: function (options) {
            this._super(options);
            var self = this;
            this.importModal = $(this.staticSelector).modal({
                title: $.mage.__('Importer'),
                type: 'slide',
                buttons: [
                        {
                        text: $.mage.__('Check Data'),
                        'id': "upload_button",
                        class: "action-default scalable save primary",
                        'data-ui-id': "import-form-container-upload-button-button",
                         title: "Check Data",
                        /**
                         * Close modal
                         * @event
                         */
                        
                        click: function () {
                            window.varienImport.postToFrame();
                        }

                       },
                        {
                        text: $.mage.__('Done'),

                        /**
                         * Close modal
                         * @event
                         */
                        
                        click: function () {
                            this.closeModal();
                        }

                       }
                ]
            });
        this.OnclickShowImportPopup.statisticUrl = this.statisticUrl;
         if(this.btnTrigger != "#null")
         {
         $(this.btnTrigger).on( "click", function() {
          self.open();
         });
         }
          
        },
        initImporter: function () {
             
             layout([this.OnclickShowImportPopup]);
             return this; 
        },
        /**
         * Open
         */
        open: function () {
            this.importModal.trigger('openModal');
            this.initImporter();
            //this._initContentDashboard();
        },

        /**
         * Close
         */
        close: function () {
                this.importModal.trigger('closeModal');

        }
    });
});
