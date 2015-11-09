<?php
class Grizzly_Orderedit_Block_Getaddressshippinglogupdate extends Mage_Core_Block_Template
{
     protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('orderedit/getaddressshippinglogupdate.phtml');
    }

    public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }

     public function getOrderedit()     
     {
        if (!$this->hasData('orderedit')) {
            $this->setData('orderedit', Mage::registry('orderedit'));
        }
        return $this->getData('orderedit');
        
    }
}