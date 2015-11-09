<?php

class Grizzly_Orderedit_Model_Mysql4_Orderedit extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the orderedit_id refers to the key field in your database table.
        $this->_init('orderedit/orderedit', 'orderedit_id');
    }
}