<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Adminhtml_Vishaltestimonial_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct(){
		parent::__construct();
		$this->setId("vishaltestimonial_tabs");
		$this->setDestElementId("edit_form");
		$this->setTitle(Mage::helper("testimonial")->__("Testimonial Information"));
	}
	protected function _beforeToHtml(){
		$this->addTab("form_section", array(
		"label" => Mage::helper("testimonial")->__("Testimonial Information"),
		"title" => Mage::helper("testimonial")->__("Testimonial Information"),
		"content" => $this->getLayout()->createBlock("testimonial/adminhtml_vishaltestimonial_edit_tab_form")->toHtml(),
		));
		return parent::_beforeToHtml();
	}

}
?>
