<?php
namespace DevAll\Checkout\Setup\Patch\Data;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;

class AddDeliveryInstructionsAttribute implements DataPatchInterface
{
    const ATTRIBUTE_CODE = 'delivery_instructions';
    public function __construct(
       private readonly ModuleDataSetupInterface $moduleDataSetup,
       private readonly Attribute $attribute,
       private readonly Config $config,
       private readonly EavSetupFactory $eavSetupFactory,
    ) {
    }

    public function apply(): self
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::ATTRIBUTE_CODE,
            [
                'type' => 'text',
                'label' => 'Delivery Instructions',
                'input' => 'text',
                'required' => true,
                'system' => false,
                'position' => 150,
                'sort_order' => 150,
            ]
        );

        $attribute = $this->config->getAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::ATTRIBUTE_CODE
        );
        $attribute->setData('used_in_forms', [
            'adminhtml_customer_address',
            'customer_address_edit',
            'customer_register_address',
        ]);
        $this->attribute->save($attribute);

        return $this;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
