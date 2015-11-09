<?php

class Grizzly_Orderedit_Model_Observer

{
    
public function getOrderprocessing(Varien_Event_Observer $observer)
	{
     $order =  Mage::getSingleton('checkout/session')->getQuote();
    
	}
    
    
    
}