<?php declare(strict_types=1);

namespace DevAll\Checkout\Plugin;

use Magento\Quote\Model\Quote\Address\ToOrderAddress;
use Magento\Sales\Api\Data\OrderAddressInterface;
use Magento\Quote\Model\Quote\Address;

class ConvertQuoteToOrderAddress
{
    public function afterConvert(
        ToOrderAddress $subject,
        OrderAddressInterface $result,
        Address $address
    ): OrderAddressInterface
    {
        if ($addressClassification = $address->getData('delivery_instructions')) {
            $result->setData('delivery_instructions', $addressClassification);
        }

        return $result;
    }
}
