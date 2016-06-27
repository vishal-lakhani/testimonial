<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Model_Observer
{
	public function setRedirectOnLogin(){
		$current_url = Mage::getSingleton('core/session')->getReqUrl();
		if(!$current_url){
			$current_url = Mage::getBaseUrl();
		}
		$session = Mage::getSingleton('customer/session');
		$session->setAfterAuthUrl($current_url);
		$session->setBeforeAuthUrl('');
		
		//distroy session
		Mage::getSingleton('core/session')->unsReqUrl();
	}
}
?>