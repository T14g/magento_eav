<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : T14g
 */

 declare (strict_types = 1);

 namespace T14g\ProductCustomAttributes\Setup\Patch\Data;

 use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
 use Magento\Eav\Setup\EavSetup;
 use Magento\Eav\Setup\EavSetupFactory;
 use Magento\Framework\Setup\ModuleDataSetupInterface;
 Use Magento\Framework\Setup\Patch\DataPatchInterface;
 use Magento\Catalog\Model\Product;

 /**
  * class ProductAttribute for creating custom Product Attributes using Data Patch
  */

class ProductAttribute implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory $eavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(Product::ENTITY, 't14g_prod_parcel', [
            'type' => 'decimal',
            'label' => 'Parcelas',
            'input' => 'number',
            'sort_order' => 5,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General Information'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

}