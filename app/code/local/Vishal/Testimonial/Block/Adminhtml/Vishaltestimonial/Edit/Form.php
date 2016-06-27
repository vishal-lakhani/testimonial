<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm(){
		$form = new Varien_Data_Form(array(
		"id" => "edit_form",
		"action" => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
		"method" => "post",
		"enctype" =>"multipart/form-data",
		)
		);
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}
