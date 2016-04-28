<?php
/**
 * Medvslav_Shipping extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Medvslav
 * @package        Medvslav_Shipping
 * @copyright      Copyright (c) 2016
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Medvslav_Shipping model
 *
 * @category    Medvslav
 * @package     Medvslav_Shipping
 * @author      Medvslav
 */
class Medvslav_Shipping_Model_Shippingmethod extends Mage_Shipping_Model_Carrier_Abstract 
implements Mage_Shipping_Model_Carrier_Interface 
{
    protected $_code = 'medvslav_shipping';
 
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!Mage::getStoreConfig('carriers/'.$this->_code.'/active')) {
            return false;
        }
         
 
        $handling = Mage::getStoreConfig('carriers/'.$this->_code.'/handling');
        $result = Mage::getModel('shipping/rate_result');
        $show = true;
        if($show){ // This if condition is just to demonstrate how to return success and error in shipping methods
 
            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setMethod($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));
            $method->setMethodTitle($this->getConfigData('name'));
            $method->setPrice($this->getConfigData('price'));
            $method->setCost($this->getConfigData('price'));
            $result->append($method);
 
        }else{
            $error = Mage::getModel('shipping/rate_result_error');
            $error->setCarrier($this->_code);
            $error->setCarrierTitle($this->getConfigData('name'));
            $error->setErrorMessage($this->getConfigData('specificerrmsg'));
            $result->append($error);
        }
        return $result;
    }
    
    public function getAllowedMethods()
    {
        return array('medvslav_shipping'=>$this->getConfigData('name'));
    }

}
