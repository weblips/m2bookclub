define([
    'uiComponent',
    'jquery',
    'ko',
    'underscore',
    'moment',
], function (Component, $, ko,_) {
    'use strict';

    return Component.extend({
        defaults: {
            template: "Ibnab_Common/showpopup",
            content: '',
        },

        /**
         * Initialize
         * @param {Array} options
         */
        initialize: function (options) {
            this._super(options);
        },

        getTemplate: function () {
          return this.template;
        },
        getContent: function () {
            var self = this;
            $.ajax({
                type: 'GET',
                data: {},
                url: this.statisticUrl,
                async: false,
                showLoader: true,
                context: $('body')
            }).success(function (data) {
                self.content = data;

            });
            
            return this.content;
        },

    });
});
