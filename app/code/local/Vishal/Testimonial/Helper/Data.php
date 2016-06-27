<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Helper_Data extends Mage_Core_Helper_Abstract
{
	/* return the customer id */
	public function getCustomerId(){
		$customer_id=false;
		if(Mage::getSingleton('customer/session')->isLoggedIn()) {
			$customer_id=$this->getCurrentCustomer()->getId();
		}
		
		return $customer_id;
	}
	
	/* return the current loggedin customer */
	public function getCurrentCustomer(){
		$customerData=false;
		if(Mage::getSingleton('customer/session')->isLoggedIn()) {
			$customerData = Mage::getSingleton('customer/session')->getCustomer();
		}

		return $customerData;
	}
	
	/* return the limit for page */
	public function getPerPage($page_limit = 50)
    {
        if($page_limit=="all"){
            $limit=$page_limit;
        }
        else{
            $limit=$page_limit;
            
            if(!$limit){
				$limit=Mage::getSingleton('catalog/session')->getLimitPage();
            }
        }
		if($limit==""){
			$limit = 5;
		}
		Mage::getSingleton('catalog/session')->setLimitPage($limit);
		
        return $limit;
    }
    
	/* return the page number for pager */
    public function getPageNum()
    {
        return  Mage::getBlockSingleton('page/html_pager')->getCurrentPage(); 
    }
	
	/* return true if customer is currentlly loggendin other wise return false */
	public function getIsCustomerLogin()
	{
		return Mage::getSingleton('customer/session')->isLoggedIn();
	}
	
	/* return array for testimonial status */
	public function getTestimonialStatus(){
		$data_array=array(); 
		$data_array[1]='Enable';
		$data_array[0]='Disable';
		return($data_array);
	}
	
	/* return current date */
	public function getCurrentDateTime(){
		return Mage::getModel('core/date')->date('Y-m-d');
	}
	
	/* return true if testimonial extension is enabled other wise return false */
	public function isTestimonialEnabled(){
		return Mage::getStoreConfig('vishal_testimonial_section/vishal_testimonial_group/vishal_testimonial_enable');
	}
	
	/* return array for pager limit dropdown */
	public function getPagerDropdownOption(){
		$option=explode(",",Mage::getStoreConfig('vishal_testimonial_section/vishal_testimonial_group/vishal_testimonial_pagerdropdown'));
		$option_array=array();
		foreach($option as $key=>$value){
			$option_array[$value]=$value;
		}
		if($option_array){
			$option_array=array(5=>5,10=>10,20=>20,'all'=>'all');
		}else{
			$option_array["all"]="all";print_r($option_array);exit;
		}
		
		return $option_array;
	}
	
	/* return formated date to display in front */
	public function getDateToDisplay($date){
		return date('F d, Y', Mage::getModel('core/date')->gmtTimestamp($date));
	}
}
	 