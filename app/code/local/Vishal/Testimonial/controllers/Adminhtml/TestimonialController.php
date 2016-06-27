<?php
/**
 * @category   Customer Testimonial
 * @package    Vishal_Testimonial
 * @copyright  Copyright (c) 2016 Vishal Lakhani
 * @author     Vishal Lakhani <vishal.lakhani@yahoo.co.in>
 */
?>
<?php
class Vishal_Testimonial_Adminhtml_TestimonialController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction(){
		$this->loadLayout()->_setActiveMenu("testimonial/vishaltestimonial")->_addBreadcrumb(Mage::helper("adminhtml")->__("Testimonial  Manager"),Mage::helper("adminhtml")->__("Testimonial Manager"));
		return $this;
	}
	public function indexAction() {
		$this->_title($this->__("Testimonial"));
		$this->_title($this->__("Manager Testimonial"));

		$this->_initAction();
		$this->renderLayout();
	}
	
	/* this action is call when administreator Edit testimonial */
	public function editAction(){
		$this->_title($this->__("Testimonial"));
		$this->_title($this->__("Edit Testimonial"));
		
		$id = $this->getRequest()->getParam("id");
		$model = Mage::getModel("testimonial/vishaltestimonial")->load($id);
		if ($model->getId()) {
			Mage::register("vishaltestimonial_data", $model);
			$this->loadLayout();
			$this->_setActiveMenu("testimonial/vishaltestimonial");
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Testimonial Manager"), Mage::helper("adminhtml")->__("Testimonial Manager"));
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Testimonial Description"), Mage::helper("adminhtml")->__("Testimonial Description"));
			$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock("testimonial/adminhtml_vishaltestimonial_edit"))->_addLeft($this->getLayout()->createBlock("testimonial/adminhtml_vishaltestimonial_edit_tabs"));
			$this->renderLayout();
		} 
		else {
			Mage::getSingleton("adminhtml/session")->addError(Mage::helper("testimonial")->__("Testimonial does not exist."));
			$this->_redirect("*/*/");
		}
	}
	
	/* this action is call when administreator add new testimonial */
	public function newAction(){
		$this->_title($this->__("Testimonial"));
		$this->_title($this->__("New Testimonial"));
		$id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("testimonial/vishaltestimonial")->load($id);
		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("vishaltestimonial_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("testimonial/vishaltestimonial");
		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Testimonial Manager"), Mage::helper("adminhtml")->__("Testimonial Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Testimonial Description"), Mage::helper("adminhtml")->__("Testimonial Description"));
		$this->_addContent($this->getLayout()->createBlock("testimonial/adminhtml_vishaltestimonial_edit"))->_addLeft($this->getLayout()->createBlock("testimonial/adminhtml_vishaltestimonial_edit_tabs"));

		$this->renderLayout();
	}
	
	/* this action is call when administreator save testimonial */
	public function saveAction(){
		$post_data=$this->getRequest()->getPost();
		if ($post_data) {
			try {
				if(!$this->getRequest()->get('id')) {
					$post_data['created_date'] = Mage::helper('testimonial')->getCurrentDateTime();
				}
				
				$model = Mage::getModel("testimonial/vishaltestimonial")
				->addData($post_data)
				->setId($this->getRequest()->getParam("id"))
				->save();

				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Testimonial successfully saved"));
				Mage::getSingleton("adminhtml/session")->setVishaltestimonialData(false);

				if ($this->getRequest()->getParam("back")) {
					$this->_redirect("*/*/edit", array("id" => $model->getId()));
					return;
				}
				$this->_redirect("*/*/");
				return;
			} 
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setVishaltestimonialData($this->getRequest()->getPost());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
				return;
			}

		}
		$this->_redirect("*/*/");
	}
	
	/* this action is call when administreator delete testimonial */
	public function deleteAction(){
		if( $this->getRequest()->getParam("id") > 0 ) {
			try {
				$model = Mage::getModel("testimonial/vishaltestimonial");
				$model->setId($this->getRequest()->getParam("id"))->delete();
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Testimonial successfully deleted"));
				$this->_redirect("*/*/");
			} 
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			}
		}
		$this->_redirect("*/*/");
	}
	
	/* this action is call when administreator perform mass remove testimonial action */
	public function massRemoveAction(){
		try {
			$ids = $this->getRequest()->getPost('ids', array());
			foreach ($ids as $id) {
				  $model = Mage::getModel("testimonial/vishaltestimonial");
				  $model->setId($id)->delete();
			}
			Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Testimonial(s) successfully removed"));
		}
		catch (Exception $e) {
			Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}
	/**
	 * Export order grid to CSV format
	 */
	public function exportCsvAction(){
		$fileName   = 'vishaltestimonial.csv';
		$grid       = $this->getLayout()->createBlock('testimonial/adminhtml_vishaltestimonial_grid');
		$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
	} 
	/**
	 *  Export order grid to Excel XML format
	 */
	public function exportExcelAction(){
		$fileName   = 'vishaltestimonial.xml';
		$grid       = $this->getLayout()->createBlock('testimonial/adminhtml_vishaltestimonial_grid');
		$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
	}
}
?>