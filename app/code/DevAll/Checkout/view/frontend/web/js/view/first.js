define([
    'uiComponent',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
    'underscore',
    'Magento_Checkout/js/model/quote',
    'jquery',
    'Magento_Checkout/js/model/customer-email-validator',
    'uiRegistry'
], function(
    Component,
    ko,
    stepNavigator,
    $t,
    _,
    quote,
    $,
    customerEmailValidator,
    uiRegistry
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'DevAll_Checkout/first',
            isVisible: ko.observable(false),
        },
        quoteIsVirtual: quote.isVirtual(),
        initialize: function() {
            this._super();

            stepNavigator.registerStep(
                'first',
                null,
                $t('First'),
                this.isVisible,
                _.bind(this.navigate, this),
                this.sortOrder
            );


            return this;
        },
        navigate: function() {
            this.isVisible(true);
        },

        navigateToNextStep: function() {
            if (customerEmailValidator.validate()) {
                stepNavigator.next();
            }
        }
    });
});
