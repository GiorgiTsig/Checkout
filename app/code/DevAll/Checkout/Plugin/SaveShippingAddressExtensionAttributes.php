<?php declare(strict_types=1);

namespace DevAll\Checkout\Plugin;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\ShippingInformationManagementInterface;

class SaveShippingAddressExtensionAttributes
{
    public function beforeSaveAddressInformation(
        ShippingInformationManagementInterface $subject,
                                               $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();

        if ($extensionAttributes = $shippingAddress->getExtensionAttributes()) {
            $shippingAddress->setData('delivery_instructions', $extensionAttributes->getDeliveryInstructions());
        }
    }
}
