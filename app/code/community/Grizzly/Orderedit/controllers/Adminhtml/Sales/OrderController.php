<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml sales orders controller
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
require_once 'Mage/Adminhtml/controllers/Sales/OrderController.php';

class Grizzly_Orderedit_Adminhtml_Sales_OrderController extends Mage_Adminhtml_Sales_OrderController
{
   public function addCommentAction()
    {
       if ($order = $this->_initOrder()) {
                try {
                    $response = false;
                    
                    $data = $this->getRequest()->getPost('history');
                    
                    $notify = isset($data['is_customer_notified']) ? $data['is_customer_notified'] : false;

                    $visible = isset($data['is_visible_on_front']) ? $data['is_visible_on_front'] : false;

                    $order->addStatusHistoryComment($data['comment'], $data['status'])
                        ->setIsVisibleOnFront($visible)
                        ->setIsCustomerNotified($notify);
                    
                    $user = Mage::getSingleton('admin/session');  
                    $userId = $user->getUser()->getUserId();
                    $userEmail = $user->getUser()->getEmail();
                    $userFirstname = $user->getUser()->getFirstname();
                    $userLastname = $user->getUser()->getLastname();
                    $userUsername = $user->getUser()->getUsername();

                    $comment = trim(strip_tags($data['comment']));
                    
                    $model = Mage::getModel('orderedit/orderedit');
                    $val = array();
                    $val['order_id'] =$order['increment_id'];
                    $val['user_id'] = $userId;
                    $val['user_email'] = $userEmail;
                    $val['statuslogord'] = $order['status'];
                    $val['usernameadmin'] = $userUsername;
                    
                    $val['userfirstname'] = $userFirstname;
                    $val['userlastname'] = $userLastname;
                    $val['content']=$data['comment']; 
                    $val['user_ip']=$order['remote_ip'];
                    $model->setData($val);
                    $model->save();
                    $order->save();
                    
                    
                    $order->sendOrderUpdateEmail($notify, $comment);

                    $this->loadLayout('empty');

                    $this->renderLayout();
                }
                catch (Mage_Core_Exception $e) {
                    $response = array(
                        'error'     => true,
                        'message'   => $e->getMessage(),
                    );
                }
                catch (Exception $e) {
                    $response = array(
                        'error'     => true,
                        'message'   => $this->__('Cannot add order history.')
                    );
                }
                if (is_array($response)) {
                    $response = Mage::helper('core')->jsonEncode($response);
                    $this->getResponse()->setBody($response);
                }
            }
   
    }



 public function getaddressorderlogAction()
 {
    $addressId = $_POST['address_id'];

    $this->loadLayout()->renderLayout();


 }

 public function getaddresslogforshippingAction()
 {
     $addressId = $_POST['address_id'];

     $this->loadLayout()->renderLayout();

 }




 public function getdataaddressAction()
    {
        $addressId  = $this->getRequest()->getParam('idofaddress');
        $address    = Mage::getModel('sales/order_address')->load($addressId);
        $data       = $this->getRequest()->getPost();
       
       //echo '<pre>';print_r($data);die;
        $response = false;
		
		$query =  "SELECT prefix,firstname,lastname,company,street,city,postcode,region,country_id,telephone,fax FROM sales_flat_order_address where parent_id =".$_POST['getorder_id']." && address_type = 'billing' ";

		$connection = Mage::getSingleton("core/resource")->getConnection("core/read");

		$get_billingaddress = $connection->fetchall($query);
		
		$get_billingvaluearray = array();
		foreach($get_billingaddress  as $get_billingaddress1 => $get_billingaddress1val)
		{
		$get_billingvaluearray[] = implode(",",$get_billingaddress1val);
          
         }
		 $billing_eleme = array();
		 $billing_element = explode(",",$get_billingvaluearray[0]);
		 foreach($billing_element  as $billing_element1)
		 {
		  $billing_eleme[] =  $billing_element1;
		 }
		
		
		
        $order = Mage::getModel("sales/order")->load($_POST['getorder_id']);
        $comment =  $data['firstname'];
		
		//$pre ="";$fname ="";
		if($billing_eleme[0] != $_POST['prefix'])
		{
		 $pre .= $_POST['prefix'];
		}
		
		if($billing_eleme[1] != $_POST['firstname'])
		{
		 $fname .= $_POST['firstname'];
		}
		
		if($billing_eleme[2] != $_POST['lastname'])
		{
		 $lname .= $_POST['lastname'];
		}
		
		if($billing_eleme[3] != $_POST['company'])
		{
		 $cname .= $_POST['company'];
		}
		
		if($billing_eleme[4] != $_POST['street'])
		{
		 $strname .= $_POST['street'];
		}
		
		


		if($billing_eleme[5] != $_POST['city'])
		{
		 $city .= $_POST['city'];
		}
		
		if($billing_eleme[6] != $_POST['postcode'])
		{
		$pcode .= $_POST['postcode'];
		}
		
		 if($billing_eleme[7] != $_POST['region'])
		{
		 $reg .= $_POST['region'];
		}
		
		
		if($billing_eleme[8] != $_POST['country_id'])
		{
		
		 
		$country_nme =  Mage::getModel('directory/country')->load($_POST['country_id'])->getName();
		$couid .= $country_nme;
		}
		
		if($billing_eleme[9] != $_POST['telephone'])
		{
		$telepho .=  $_POST['telephone'];
		}
		
		if($billing_eleme[10] != $_POST['fax'])
		{
		 $fax .= $_POST['fax'];
		}
		
        $alldata1 = array($pre , $fname, $lname,$cname,$strname,$city,$pcode.$reg,$couid,$telepho,$fax,$_POST['getbillingaddresscomment_status']);
		
	 	    $alldata2 = array_filter($alldata1);
		
		    $alldata  =  implode(",",$alldata2);
            
        $order->addStatusHistoryComment($alldata,$_POST['getorder_status']);
   
        $user = Mage::getSingleton('admin/session');  
        $userId = $user->getUser()->getUserId(); 
        $userEmail = $user->getUser()->getEmail(); 
        $userFirstname = $user->getUser()->getFirstname(); 
        $userLastname = $user->getUser()->getLastname();
        $userUsername = $user->getUser()->getUsername(); 
        if ($data && $address->getId()) 
        {
            $address->addData($data);
            try 
            {
                 $address->implodeStreetAddress()->save();
                 $order->save();
                  if (!$this->getRequest()->isXmlHttpRequest()) 
                  {
                    $this->_redirect('/');
                  }


         $this->getResponse()->setBody($this->getLayout()->createBlock('orderedit/getaddresslogupdate')
              ->setAddressid($addressId)
              ->toHtml());

        return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addException(
                    $e,
                    Mage::helper('sales')->__('An error occurred while updating the order address. The address has not been changed.')
                );
            }
        } else {

        }

      }

      
        public function getcommentaddressAction()
    {
            
      $this->addCommentAction();
            echo "calllingggg";     
       }
       
      public function getdatashippingaddressAction()
      {

        $addressId  = $this->getRequest()->getParam('idofaddress');
        $address    = Mage::getModel('sales/order_address')->load($addressId);
        $data       = $this->getRequest()->getPost();
        
		$response = false;
        $order = Mage::getModel("sales/order")->load($_POST['getorder_id']);
      
		$query =  "SELECT prefix,firstname,lastname,company,street,city,postcode,region,country_id,telephone,fax FROM sales_flat_order_address where parent_id =".$_POST['getorder_id']." && address_type = 'shipping' ";

		$connection = Mage::getSingleton("core/resource")->getConnection("core/read");

		$get_billingaddress = $connection->fetchall($query);
		
		$get_billingvaluearray = array();
		foreach($get_billingaddress  as $get_billingaddress1 => $get_billingaddress1val)
		{
		$get_billingvaluearray[] = implode(",",$get_billingaddress1val);
          
         }
		 $billing_eleme = array();
		 $billing_element = explode(",",$get_billingvaluearray[0]);
		 foreach($billing_element  as $billing_element1)
		 {
		  $billing_eleme[] =  $billing_element1;
		 }
		
		
		
        $order = Mage::getModel("sales/order")->load($_POST['getorder_id']);
        $comment =  $data['firstname'];
		
		//$pre ="";$fname ="";
		if($billing_eleme[0] != $_POST['prefix'])
		{
		 $pre .= $_POST['prefix'];
		}
		
		if($billing_eleme[1] != $_POST['firstname'])
		{
		 $fname .= $_POST['firstname'];
		}
		
		if($billing_eleme[2] != $_POST['lastname'])
		{
		 $lname .= $_POST['lastname'];
		}
		
		if($billing_eleme[3] != $_POST['company'])
		{
		 $cname .= $_POST['company'];
		}
		
		if($billing_eleme[4] != $_POST['street'])
		{
		 $strname .= $_POST['street'];
		}
		
		


		if($billing_eleme[5] != $_POST['city'])
		{
		 $city .= $_POST['city'];
		}
		
		if($billing_eleme[6] != $_POST['postcode'])
		{
		$pcode .= $_POST['postcode'];
		}
		
		 if($billing_eleme[7] != $_POST['region'])
		{
		 $reg .= $_POST['region'];
		}
		
		
		if($billing_eleme[8] != $_POST['country_id'])
		{
		
		 
		$country_nme =  Mage::getModel('directory/country')->load($_POST['country_id'])->getName();
		$couid .= $country_nme;
		}
		
		if($billing_eleme[9] != $_POST['telephone'])
		{
		$telepho .=  $_POST['telephone'];
		}
		
		if($billing_eleme[10] != $_POST['fax'])
		{
		 $fax .= $_POST['fax'];
		}
	
	
        $alldata1 = array($pre , $fname, $lname,$cname,$strname,$city,$pcode.$reg,$couid,$telepho,$fax,$_POST['getshippingaddresscomment_status']);
		
		$alldata2 = array_filter($alldata1);
		
		$alldata  =  implode(",",$alldata2);
        $order->addStatusHistoryComment($alldata,$_POST['getorder_status']);
   
        $user = Mage::getSingleton('admin/session');  //get admin information
        $userId = $user->getUser()->getUserId(); //get admin user id 
        $userEmail = $user->getUser()->getEmail(); //get Admin user email
        $userFirstname = $user->getUser()->getFirstname(); //get first name of admin user
        $userLastname = $user->getUser()->getLastname();//get last name of admin user
        $userUsername = $user->getUser()->getUsername(); //get username  of admin user
		
        if ($data && $address->getId()) {
            $address->addData($data);
            try {
                $address->implodeStreetAddress()
                    ->save();
				$order->save();
               

                         if (!$this->getRequest()->isXmlHttpRequest()) {
            $this->_redirect('/');
        }


         $this->getResponse()->setBody($this->getLayout()->createBlock('orderedit/getaddressshippinglogupdate')
              ->setAddressid($addressId)
              ->toHtml());





        return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addException(
                    $e,
                    Mage::helper('sales')->__('An error occurred while updating the order address. The address has not been changed.')
                );
            }
        } else {

        }

      }



 public function getcustomorderstatuslogAction()
 {
            $orderId = $_POST['entity_id'];

            $this->getResponse()->setBody($this->getLayout()->createBlock('orderedit/getcustomorderstatuslog')
             // ->setAddressid($orderId)
              ->toHtml());

 }


 public function getstatuschangeAction()
 {
    
      $order = Mage::getModel('sales/order')->load($_POST['orderid']);
      $getstatus =  $_POST['status'];
      $output = "";
      switch($getstatus)
      {
            case "canceled";
            $order->setState(Mage_Sales_Model_Order::STATE_CANCELED, true)->save();
            break;

            case "closed";
            $state = Mage_Sales_Model_Order::STATE_CLOSED;
            $order->setData('state', $state);
            $order->setStatus($order->getConfig()->getStateDefaultStatus($state));
            $order->save();
			       break;

            case "complete";
            $order->setState(Mage_Sales_Model_Order::STATE_COMPLETE, true)->save();
            break;


            case "holded";
            $order->setState(Mage_Sales_Model_Order::STATE_HOLDED, true)->save();
            break;


            case "pending";
            $order->setState(Mage_Sales_Model_Order::STATE_NEW, true)->save();
            break;

            case "pending_payPal";
            $order->setState(Mage_Sales_Model_Order::STATE_PENDING_PAYMENT, true)->save();
            break;

             case "processing";
            $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
            break;
      }

      try {
      $order->save();
         $output .= "<strong>";
         $output .= $getstatus."</strong>";
         echo $output;
      }catch (Exception $e)
      {
          echo $e->getMessage();
      }

}

}



