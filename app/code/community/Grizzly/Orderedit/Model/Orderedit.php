<?php

class Grizzly_Orderedit_Model_Orderedit extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('orderedit/orderedit');
    }
}