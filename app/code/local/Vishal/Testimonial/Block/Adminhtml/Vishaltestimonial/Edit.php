<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct(){
		parent::__construct();
		$this->_objectId = "id";
		$this->_blockGroup = "testimonial";
		$this->_controller = "adminhtml_vishaltestimonial";
		$this->_updateButton("save", "label", Mage::helper("testimonial")->__("Save Testimonial"));
		$this->_updateButton("delete", "label", Mage::helper("testimonial")->__("Delete Testimonial"));

		$this->_addButton("saveandcontinue", array(
			"label"     => Mage::helper("testimonial")->__("Save And Continue Edit"),
			"onclick"   => "saveAndContinueEdit()",
			"class"     => "save",
		), -100);
		
		$this->_formScripts[] = "function saveAndContinueEdit(){editForm.submit($('edit_form').action+'back/edit/');}";
	}

	public function getHeaderText()
	{
			if( Mage::registry("vishaltestimonial_data") && Mage::registry("vishaltestimonial_data")->getId() ){

				return Mage::helper("testimonial")->__("Edit Testimonial '%s'", $this->htmlEscape(Mage::registry("vishaltestimonial_data")->getId()));

			} 
			else{

				 return Mage::helper("testimonial")->__("Add Testimonial");

			}
	}
}