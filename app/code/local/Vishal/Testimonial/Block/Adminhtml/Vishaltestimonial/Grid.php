<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

	public function __construct(){
		parent::__construct();
		$this->setId("vishaltestimonialGrid");
		$this->setDefaultSort("id");
		$this->setDefaultDir("DESC");
		$this->setSaveParametersInSession(true);
	}
	protected function _prepareCollection(){
		$collection = Mage::getModel("testimonial/vishaltestimonial")->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	protected function _prepareColumns(){
		$this->addColumn("id", array(
		"header" => Mage::helper("testimonial")->__("ID"),
		"align" =>"right",
		"width" => "50px",
		"type" => "number",
		"index" => "id",
		));
		$this->addColumn("name", array(
		"header" => Mage::helper("testimonial")->__("Name"),
		"index" => "name",
		));
		$this->addColumn("email", array(
		"header" => Mage::helper("testimonial")->__("Email"),
		"index" => "email",
		));
		$this->addColumn('status', array(
		'header' => Mage::helper('testimonial')->__('Status'),
		'index' => 'status',
		'type' => 'options',
		'options'=>Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Grid::getStatus(),				
		));
		$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
		$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row){
		return $this->getUrl("*/*/edit", array("id" => $row->getId()));
	}


	
	protected function _prepareMassaction(){
		$this->setMassactionIdField('id');
		$this->getMassactionBlock()->setFormFieldName('ids');
		$this->getMassactionBlock()->setUseSelectAll(true);
		$this->getMassactionBlock()->addItem('remove_vishaltestimonial', array(
				 'label'=> Mage::helper('testimonial')->__('Remove testimonial'),
				 'url'  => $this->getUrl('*/adminhtml_vishaltestimonial/massRemove'),
				 'confirm' => Mage::helper('testimonial')->__('Are you sure?')
			));
		return $this;
	}
	
	static public function getCustomer(){
		$customers=mage::getModel('customer/customer')->getCollection();
		$customers->addAttributeToSelect(array(
			'id', 'firstname', 'lastname'
		));
		$customer_array=array();
		foreach($customers as $customer){
			$customer_array[$customer->getId()]=$customer->getFirstname()." ".$customer->getLastname();
		}
		
		return $customer_array;
	}
	
	static public function getStatus(){
		return Mage::helper('testimonial')->getTestimonialStatus();
	}
	
	static public function getValueArray4(){
		$data_array=array();
		foreach(Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Grid::getStatus() as $k=>$v){
		   $data_array[]=array('value'=>$k,'label'=>$v);		
		}
		return($data_array);
	}
}