<?php
$installer = new Mage_Sales_Model_Resource_Setup('core_setup');
$installer->startSetup();
$entities = array(
    'quote',
    'quote_address',
    'quote_item',
    'quote_address_item',
    'order',
    'order_item'
);
$options = array(
    'type' => Varien_Db_Ddl_Table::TYPE_VARCHAR,
    'visible' => true,
    'required' => false
);
foreach($entities as $entity) {
    $installer->addAttribute($entity, 'code_model', $options);
}
$installer->endSetup();