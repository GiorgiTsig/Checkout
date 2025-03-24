<?php declare(strict_types=1);

namespace DevAll\Checkout\Block\Checkout\LayoutProcessor;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class AddressClassificationAttribute implements LayoutProcessorInterface
{
    public function process($jsLayout): array
    {
        $attributeCode = 'delivery_instructions';
        $attributeData = &$jsLayout['components']['checkout']['children']
        ['steps']['children']
        ['shipping-step']['children']
        ['shippingAddress']['children']
        ['shipping-address-fieldset']['children']
        [$attributeCode];

        $attributeData['config']['customScope'] = 'shippingAddress.custom_attributes';
        $attributeData['dataScope'] = "shippingAddress.custom_attributes.$attributeCode";

        return $jsLayout;
    }
}
