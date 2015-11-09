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

				
require_once 'Mage/Adminhtml/controllers/Sales/Order/EditController.php';
class Grizzly_Orderedit_Adminhtml_Sales_Order_EditController extends Mage_Adminhtml_Sales_Order_EditController
{
   
    /**
     * Saving quote and create order
     */
    public function saveAction()
    {
    
      $data = $this->getRequest()->getPost('order');
       try {
            $this->_processActionData('save');
              
            $paymentData = $this->getRequest()->getPost('payment');
            if ($paymentData) {
                $paymentData['checks'] = Mage_Payment_Model_Method_Abstract::CHECK_USE_INTERNAL
                    | Mage_Payment_Model_Method_Abstract::CHECK_USE_FOR_COUNTRY
                    | Mage_Payment_Model_Method_Abstract::CHECK_USE_FOR_CURRENCY
                    | Mage_Payment_Model_Method_Abstract::CHECK_ORDER_TOTAL_MIN_MAX
                    | Mage_Payment_Model_Method_Abstract::CHECK_ZERO_TOTAL;
                $this->_getOrderCreateModel()->setPaymentData($paymentData);
                $this->_getOrderCreateModel()->getQuote()->getPayment()->addData($paymentData);
            }

            $order = $this->_getOrderCreateModel()
                ->setIsValidate(true)
                ->importPostData($this->getRequest()->getPost('order'))
                ->createOrder();
            
             $user = Mage::getSingleton('admin/session');  
        
        $userId = $user->getUser()->getUserId(); 
        
        $userEmail = $user->getUser()->getEmail();
        
        $userFirstname = $user->getUser()->getFirstname();
        
        $userLastname = $user->getUser()->getLastname();
        
        $userUsername = $user->getUser()->getUsername();
        
       
        $billingadd =  $data['billing_address']; 
        
       

         $comment = trim(strip_tags($data['comment']['customer_note']));  
         
                    $model = Mage::getModel('orderedit/orderedit');
                    $val = array();
                    $val['order_id'] = $order['increment_id'];
                    $val['user_id'] = $userId;
                    $val['user_email'] = $userEmail;
                    $val['statuslogord'] = $order->getStatus();
                    $val['usernameadmin'] = $userUsername;
                    
                    $val['userfirstname'] = $userFirstname;
                    $val['userlastname'] = $userLastname;
                    $val['content']=$comment; //get current comment
                    $model->setData($val);
                   $model->save();  
                    
                    
            $this->_getSession()->clear();
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The order has been created.'));
            if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
                $this->_redirect('*/sales_order/view', array('order_id' => $order->getId()));
            } else {
                $this->_redirect('*/sales_order/index');
            }
        } catch (Mage_Payment_Model_Info_Exception $e) {
            $this->_getOrderCreateModel()->saveQuote();
            $message = $e->getMessage();
            if( !empty($message) ) {
                $this->_getSession()->addError($message);
            }
            $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            $message = $e->getMessage();
            if( !empty($message) ) {
                $this->_getSession()->addError($message);
            }
            $this->_redirect('*/*/');
        }
        catch (Exception $e){
            $this->_getSession()->addException($e, $this->__('Order saving error: %s', $e->getMessage()));
            $this->_redirect('*/*/');
        }
    }
    
    

   
}
