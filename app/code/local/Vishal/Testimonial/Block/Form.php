<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Form extends Mage_Core_Block_Template{
	public function getCustomer(){
		$customer=false;
		 if(Mage::helper('testimonial')->getIsCustomerLogin()) {
			$customer=Mage::helper('testimonial')->getCurrentCustomer();
		 }
		 
		 return $customer;
	}
}
?>