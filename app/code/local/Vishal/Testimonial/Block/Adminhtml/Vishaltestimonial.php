<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct(){
		$this->_controller = "adminhtml_vishaltestimonial";
		$this->_blockGroup = "testimonial";
		$this->_headerText = Mage::helper("testimonial")->__("Testimonial Manager");
		$this->_addButtonLabel = Mage::helper("testimonial")->__("Add New Testimonial");
		parent::__construct();	
	}
}