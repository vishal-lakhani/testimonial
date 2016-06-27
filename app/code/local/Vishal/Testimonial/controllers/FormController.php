<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_FormController extends Mage_Core_Controller_Front_Action{
	public function IndexAction(){
		if((!Mage::helper('testimonial')->isTestimonialEnabled())) {
			Mage::app()->getResponse()->setRedirect(Mage::getUrl('customer/account/login'))->sendResponse();
		}
		
		if(!Mage::helper('testimonial')->getIsCustomerLogin()){
			Mage::getSingleton('core/session')->setReqUrl(Mage::getBaseUrl()."testimonial/form");
			Mage::app()->getResponse()->setRedirect(Mage::helper('customer')->getAccountUrl().'login')->sendResponse();
		}
		
		$this->loadLayout();
		$this->getLayout()->getBlock("head")->setTitle($this->__("Testimonial"));
				$breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
		  $breadcrumbs->addCrumb("home", array(
					"label" => $this->__("Testimonial"),
					"title" => $this->__("Testimonial"),
					"link"  => Mage::getBaseUrl()."testimonial"
			   ));

		  $breadcrumbs->addCrumb("testimonial", array(
					"label" => $this->__("Submit Testimonial"),
					"title" => $this->__("Submit Testimonial")
			   ));
		$this->renderLayout();
	}
	
	/* this action call when customer submit testimonial */
	public function PostAction(){
		if((!Mage::helper('testimonial')->getIsCustomerLogin()) || (!Mage::helper('testimonial')->isTestimonialEnabled())) {
			Mage::app()->getResponse()->setRedirect(Mage::getUrl('customer/account/login'))->sendResponse();
		}
		$data=$this->getRequest()->getParams();
		$data["customer_id"]=Mage::helper('testimonial')->getCustomerId();
		$data["created_date"]=Mage::helper('testimonial')->getCurrentDateTime();
		$model=Mage::getModel('testimonial/vishaltestimonial');
		$model->setData($data);
		$code=Mage::getSingleton('core/session')->getCaptchaCode();
		$captcha_code=$data['captcha_code'];
		if ($code !=  $captcha_code) {
			$url=Mage::getBaseUrl()."testimonial/form";
			Mage::getSingleton('core/session')->addError('The security code entered was incorrect. Please try again!');
			Mage::app()->getResponse()->setRedirect($url)->sendResponse();
			exit;
		}
		
		try{
			$model->save();
			Mage::getSingleton("core/session")->addSuccess("Testimonial send successfully!It will display on site once it's review by admin! ");
			Mage::app()->getResponse()->setRedirect(Mage::getBaseUrl()."/testimonial/")->sendResponse();
		}catch(Exception $e){
			Mage::getSingleton("core/session")->addError("Your Testimonial send fail.");
			Mage::app()->getResponse()->setRedirect(Mage::getBaseUrl()."/testimonial/")->sendResponse();
		}
	}
	
	public function captchaAction() {
		require_once(Mage::getBaseDir('lib').DS.'vishal'.DS.'captcha'.DS.'class.simplecaptcha.php');
		//Background Image
		$config['BackgroundImage'] = Mage::getBaseDir('lib').DS.'vishal'. DS .'captcha'. DS . "white.png";

		//Background Color- HEX
		$config['BackgroundColor'] = "FFFC00";

		//image height - same as background image
		$config['Height']=30; 

		//image width - same as background image
		$config['Width']=100; 

		//text font size
		$config['Font_Size']=20; 

		//text font style
		$config['Font']= Mage::getBaseDir('lib').DS.'vishal'. DS .'captcha'. DS . "ARLRDBD.TTF";

		//text angle to the left
		$config['TextMinimumAngle']=15;

		//text angle to the right
		$config['TextMaximumAngle']=45;

		//Text Color - HEX
		$config['TextColor']='000000';

		//Number of Captcha Code Character
		$config['TextLength']=6;

		//Background Image Transparency
		// 0 - Not Visible, 100 - Fully Visible
		$config['Transparency']=70;
		
		$captcha = new SimpleCaptcha($config);
		Mage::getSingleton('core/session')->setCaptchaCode($captcha->Code);	
	}
}
?>