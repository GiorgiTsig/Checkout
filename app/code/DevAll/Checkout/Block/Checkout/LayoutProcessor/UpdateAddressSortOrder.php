<?php declare(strict_types=1);

namespace DevAll\Checkout\Block\Checkout\LayoutProcessor;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class UpdateAddressSortOrder implements LayoutProcessorInterface
{
    public function process($jsLayout): array
    {
        foreach ($jsLayout['components']['checkout']['children']
                 ['steps']['children']
                 ['billing-step']['children']
                 ['payment']['children']
                 ['payments-list']['children'] as &$paymentMethod) {
            $fields = &$paymentMethod['children']['form-fields']['children'];
            if ($fields === null) {
                continue;
            }
            $fields['telephone']['sortOrder'] = '60';
        }

        return $jsLayout;
    }
}
