<?php

class Grizzly_Orderedit_Block_Adminhtml_Orderedit_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  
  
    protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('orderedit_form', array('legend'=>Mage::helper('orderedit')->__('Log information')));
     
     
      
      $fieldset->addField('order_id', 'text', array(
          'label'     => Mage::helper('orderedit')->__('Order Id'),
          'required'  => false,
          'name'      => 'order_id',
          'readonly'  => true,
      ));
       
     
      $fieldset->addField('user_id', 'text', array(
          'label'     => Mage::helper('orderedit')->__('User Id'),
          'required'  => false,
          'name'      => 'user_id',
          'readonly'  => true,
      ));
      
      $fieldset->addField('usernameadmin', 'text', array(
          'label'     => Mage::helper('orderedit')->__('User Name'),
          'required'  => false,
          'name'      => 'usernameadmin',
          'readonly'  => true,
      ));
      
       
      $fieldset->addField('user_email', 'text', array(
          'label'     => Mage::helper('orderedit')->__('User Email'),
          'required'  => false,
          'name'      => 'user_email',
          'readonly'  => true,
      ));
      
      $fieldset->addField('userfirstname', 'text', array(
          'label'     => Mage::helper('orderedit')->__('First Name'),
          'required'  => true,
          'name'      => 'userfirstname',
          'readonly'  => true,
      ));
      
      $fieldset->addField('userlastname', 'text', array(
          'label'     => Mage::helper('orderedit')->__('Last Name'),
          'required'  => false,
          'name'      => 'userlastname',
          'readonly'  => true,
      ));
      
      $fieldset->addField('statuslogord', 'text', array(
          'label'     => Mage::helper('orderedit')->__('Status'),
          'required'  => false,
          'name'      => 'statuslogord',
          'readonly'  => true,
      ));
     
      $fieldset->addField('user_ip', 'text', array(
          'label'     => Mage::helper('orderedit')->__('User IP'),
          'required'  => false,
          'name'      => 'user_ip',
          'readonly'  => true,
      ));
      
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('orderedit')->__('Content'),
          'title'     => Mage::helper('orderedit')->__('Content'),
          'style'     => 'width:400px; height:100px;',
          'wysiwyg'   => false,
          'required'  => false,
           'readonly'  => true,
      ));
     
      
        
      if ( Mage::getSingleton('adminhtml/session')->getOrdereditData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getOrdereditData());
          Mage::getSingleton('adminhtml/session')->setOrdereditData(null);
      } elseif ( Mage::registry('orderedit_data') ) {
          $form->setValues(Mage::registry('orderedit_data')->getData());
      }
      return parent::_prepareForm();
  }
}
?>
<style type="text/css">
#orderedit_form .hor-scroll table tr td input,textarea { border:none;}
#orderedit_form .hor-scroll table{ background-color: #FAFAFA;}
#orderedit_form .hor-scroll table tr td label{ font-weight: bold}
#orderedit_form .hor-scroll table tr td.label , label{ width: 185px !important;}
</style>