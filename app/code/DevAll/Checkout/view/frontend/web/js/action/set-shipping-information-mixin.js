define([
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function(
    wrapper,
    quote
) {
    'use strict';

    return function(setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function(originalAction) {
            const shippingAddress = quote.shippingAddress();
            const attributeCode = 'delivery_instructions';

            shippingAddress.extension_attributes = shippingAddress.extension_attributes || {};

            const attribute = shippingAddress.customAttributes.find(el =>
                el.attribute_code === attributeCode
            );

            if (attribute) {
                shippingAddress.extension_attributes[attributeCode] = attribute.value;
            }

            console.log('shippingAddress', shippingAddress);
            return originalAction();
        });
    };
});
