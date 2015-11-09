<?php
class Grizzly_Orderedit_Block_Adminhtml_Orderedit extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_orderedit';
    $this->_blockGroup = 'orderedit';
    $this->_headerText = Mage::helper('orderedit')->__('Item Manager');
    parent::__construct();
    $this->_removeButton('add');
  }
}