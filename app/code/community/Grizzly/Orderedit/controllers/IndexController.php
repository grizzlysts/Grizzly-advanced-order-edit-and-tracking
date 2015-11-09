<?php
class Grizzly_Orderedit_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/orderedit?id=15 
    	 *  or
    	 * http://site.com/orderedit/id/15 	
    	 */
    	/* 
		$orderedit_id = $this->getRequest()->getParam('id');

  		if($orderedit_id != null && $orderedit_id != '')	{
			$orderedit = Mage::getModel('orderedit/orderedit')->load($orderedit_id)->getData();
		} else {
			$orderedit = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($orderedit == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$ordereditTable = $resource->getTableName('orderedit');
			
			$select = $read->select()
			   ->from($ordereditTable,array('orderedit_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$orderedit = $read->fetchRow($select);
		}
		Mage::register('orderedit', $orderedit);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}