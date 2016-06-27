<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Model_Mysql4_Vishaltestimonial_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	public function _construct(){
		$this->_init("testimonial/vishaltestimonial");
	}
}
?>