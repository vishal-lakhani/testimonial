<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Block_Toolbar extends Mage_Core_Block_Template{
	public function getPagerHtml(){
		$pagerBlock = $this->getLayout()->createBlock('page/html_pager');
 
        if ($pagerBlock instanceof Varien_Object) {
 
            /* @var $pagerBlock Mage_Page_Block_Html_Pager */
            $pagerBlock->setAvailableLimit($this->getAvailableLimit());
 
            $pagerBlock->setUseContainer(false)
            ->setShowPerPage(false)
            ->setShowAmounts(false)
            ->setLimitVarName($this->getLimitVarName())
            ->setPageVarName($this->getPageVarName())
            ->setLimit($this->getLimit())
            ->setCollection($this->getCollection());
            return $pagerBlock->toHtml();
        }
        return '';
	}
}
?>