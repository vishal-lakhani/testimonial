<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset("testimonial_form", array("legend"=>Mage::helper("testimonial")->__("Testimonial information")));
		
		$fieldset->addField("name", "text", array(
		"label" => Mage::helper("testimonial")->__("Name"),					
		"class" => "required-entry",
		"required" => true,
		"name" => "name",
		));
		$fieldset->addField("email", "text", array(
		"label" => Mage::helper("testimonial")->__("Email"),					
		"class" => "required-entry validate-email",
		"required" => true,
		"name" => "email",
		));
		$fieldset->addField("comment", "textarea", array(
		"label" => Mage::helper("testimonial")->__("Comment"),					
		"class" => "required-entry",
		"required" => true,
		"name" => "comment",
		));
		$fieldset->addField('status', 'select', array(
		'label'     => Mage::helper('testimonial')->__('Status'),
		'values'   => Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Grid::getStatus(),
		'name' => 'status',					
		"class" => "required-entry",
		"required" => true,
		));

		if (Mage::getSingleton("adminhtml/session")->getVishaltestimonialData())
		{
			$form->setValues(Mage::getSingleton("adminhtml/session")->getVishaltestimonialData());
			Mage::getSingleton("adminhtml/session")->setVishaltestimonialData(null);
		} 
		elseif(Mage::registry("vishaltestimonial_data")) {
			$form->setValues(Mage::registry("vishaltestimonial_data")->getData());
		}
		return parent::_prepareForm();
	}
}
