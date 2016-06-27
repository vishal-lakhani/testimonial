<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php   
class Vishal_Testimonial_Block_Index extends Mage_Core_Block_Template{
	public function __construct(){
        parent::__construct();
        $collection = Mage::getModel('testimonial/vishaltestimonial')->getCollection();
        $this->setCollection($collection);
    }
 
    protected function _prepareLayout(){
        parent::_prepareLayout();
 
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(Mage::helper('testimonial')->getPagerDropdownOption());
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
 
        return $this;
    }
 
    public function getPagerHtml(){
        return $this->getChildHtml('pager');
    }
 
    public function getCollection(){            
		$_helper=Mage::helper('testimonial');
		$limit = $_helper->getPerPage($this->getRequest()->getParam('limit'));
        $curr_page = $_helper->getPageNum();
        if(Mage::app()->getRequest()->getParam('p'))
        {
            $curr_page  =   Mage::app()->getRequest()->getParam('p');
        }
        $collection =   Mage::getModel('testimonial/vishaltestimonial')->getCollection()->addFieldToFilter('status',1)->setOrder('id', 'desc');    
		if($limit!="all"){
            $collection->setPageSize($limit)->setCurPage($curr_page);
        }
        else{
            $collection->getSize();
        }
        return $collection;
    }  
}