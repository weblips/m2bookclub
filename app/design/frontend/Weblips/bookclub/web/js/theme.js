define([
    'jquery',
    'mage/smart-keyboard-handler',
    'mage/mage',
    'mage/ie-class-fixer',
    'mage/validation',
    'mage/translate',
    'domReady!'
], function ($, keyboardHandler) {
    'use strict';

    if ($('body').hasClass('checkout-cart-index')) {
        if ($('#co-shipping-method-form .fieldset.rates').length > 0 && $('#co-shipping-method-form .fieldset.rates :checked').length === 0) {
            $('#block-shipping').on('collapsiblecreate', function () {
                $('#block-shipping').collapsible('forceActivate');
            });
        }
    }

    $('.cart-summary').mage('sticky', {
        container: '#maincontent'
    });

    $('.panel.header > .header.links').clone().appendTo('#store\\.links');

    keyboardHandler.apply();
    
    // translate js weblips-hack
    $.each($.validator.messages, function(validationMessageKey, validationMessage) {
        if (typeof validationMessage == 'string') {
            $.validator.messages[validationMessageKey] = $.mage.__(validationMessage);
        }
    });

    $.validator.messages = $.extend($.validator.messages, {
        equalTo: "Пожалуйста, убедитесь, что пароли совпадают."
    }); 
    // end translate js 
});
