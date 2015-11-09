<?php

class Grizzly_Orderedit_Block_Adminhtml_Orderedit_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('orderedit_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('orderedit')->__('Log Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('orderedit')->__('Log Information'),
          'title'     => Mage::helper('orderedit')->__('Log Information'),
          'content'   => $this->getLayout()->createBlock('orderedit/adminhtml_orderedit_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}