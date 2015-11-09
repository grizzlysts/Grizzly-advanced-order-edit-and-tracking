<?php

class Grizzly_Orderedit_Block_Adminhtml_Orderedit_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'orderedit';
        $this->_controller = 'adminhtml_orderedit';
        $this->_removeButton('delete');
        $this->_removeButton('save');
        $this->_removeButton('back');
        $this->_removeButton('new');
        $this->_removeButton('reset');
       
        //$this->_updateButton('save', 'label', Mage::helper('orderedit')->__('Save Log'));
        //$this->_updateButton('delete', 'label', Mage::helper('orderedit')->__('Delete Log'));
		
      //  $this->_addButton('saveandcontinue', array(
        //    'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit Log'),
          //  'onclick'   => 'saveAndContinueEdit()',
           // 'class'     => 'save',
       // ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('orderedit_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'orderedit_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'orderedit_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('orderedit_data') && Mage::registry('orderedit_data')->getId() ) {
            return Mage::helper('orderedit')->__("Edit Logs", $this->htmlEscape(Mage::registry('orderedit_data')->getTitle()));
        } else {
            return Mage::helper('orderedit')->__('Add Item');
        }
    }
}