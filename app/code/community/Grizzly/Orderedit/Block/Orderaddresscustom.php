<?php
class Grizzly_Orderedit_Block_Orderaddresscustom extends Mage_Core_Block_Template
{
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

   public function getCountryCollection()
    {
		  $countryCollection = Mage::getResourceModel('directory/country_collection')
                    ->loadData()
                    ->toOptionArray(false);
        return $countryCollection;
    }

   public function getRegionCollection($countryCode)
    {
        $regionCollection = Mage::getModel('directory/region_api')->items($countryCode);
        return $regionCollection;
    }

}