<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition End User License Agreement
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magento.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Sales
 * @copyright Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license http://www.magento.com/license/enterprise-edition
 */

/**
 * Quote entity resource model
 *
 * @category   Mage
 * @package    Mage_Sales
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Sales_Model_Entity_Quote_Address extends Mage_Eav_Model_Entity_Abstract
{
    public function __construct()
    {
        $resource = Mage::getSingleton('core/resource');
        $this->setType('quote_address')->setConnection(
            $resource->getConnection('sales_read'),
            $resource->getConnection('sales_write')
        );
    }

    public function collectTotals(Mage_Sales_Model_Quote_Address $address)
    {
        $attributes = $this->loadAllAttributes()->getAttributesByCode();
        foreach ($attributes as $attrCode=>$attr) {
            $backend = $attr->getBackend();
            if (method_exists($backend, 'collectTotals')) {
                $backend->collectTotals($address);
            }
        }
        return $this;
    }

    public function fetchTotals(Mage_Sales_Model_Quote_Address $address)
    {
        $attributes = $this->loadAllAttributes()->getAttributesByCode();
        foreach ($attributes as $attrCode=>$attr) {
            $frontend = $attr->getFrontend();
            if (method_exists($frontend, 'fetchTotals')) {
                $frontend->fetchTotals($address);
            }
        }

        return $this;
    }
}
