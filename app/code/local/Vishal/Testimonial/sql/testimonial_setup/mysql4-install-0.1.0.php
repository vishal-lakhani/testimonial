<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($this->getTable('testimonial'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'ID')
	->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        ), 'Customer ID')
	->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 30, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Name')
	->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 80, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Email')
	->addColumn('comment', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Comment')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Status')
	->addColumn('created_date', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created Date')
	->setComment('Testimonial Table');
$installer->getConnection()->createTable($table);

$installer->endSetup();
?>