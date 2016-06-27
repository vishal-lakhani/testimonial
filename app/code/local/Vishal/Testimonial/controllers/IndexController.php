<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      if(!Mage::helper('testimonial')->isTestimonialEnabled()){
			Mage::app()->getResponse()->setRedirect(Mage::getBaseUrl())->sendResponse();
		}
		
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Testimonial"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("testimonial", array(
                "label" => $this->__("Testimonial"),
                "title" => $this->__("Testimonial")
		   ));

      $this->renderLayout(); 
    }
}
?>