<?php
/**
 *  @author   Rosalynshop <info@rosalynshop.com>
 *  @copyright Copyright (c) 2019 Rosalynshop <https://rosalynshop.com>. All rights reserved.
 *  @license   Open Software License ("OSL") v. 3.0
 */

namespace RosalynShop\PriceDecimal\Model\Plugin;

/**
 * Class PriceCurrency
 * @package RosalynShop\PriceDecimal\Model\Plugin
 */
class PriceCurrency extends PriceFormatPluginAbstract
{

    /**
     * {@inheritdoc}
     */
    public function beforeFormat(
        \Magento\Directory\Model\PriceCurrency $subject,
        ...$args
    ) {
        if ($this->getConfig()->isEnable()) {
            // add the optional arg
            if (!isset($args[1])) {
                $args[1] = true;
            }
            // Precision argument
            $args[2] = $this->getPricePrecision();
        }

        return $args;
    }

    /**
     * @param \Magento\Directory\Model\PriceCurrency $subject
     * @param callable $proceed
     * @param $price
     * @param array ...$args
     * @return float
     */
    public function aroundRound(
        \Magento\Directory\Model\PriceCurrency $subject,
        callable $proceed,
        $price,
        ...$args
    ) {
        if ($this->getConfig()->isEnable()) {
            return round($price, $this->getPricePrecision());

        } else {
            return $proceed($price);
        }
    }

    /**
     * @param \Magento\Directory\Model\PriceCurrency $subject
     * @param array ...$args
     * @return array
     */
    public function beforeConvertAndFormat(
        \Magento\Directory\Model\PriceCurrency $subject,
        ...$args
    ) {
        if ($this->getConfig()->isEnable()) {
            // add the optional args
            $args[1] = isset($args[1])? $args[1] : null;
            $args[2] = intval($this->getPricePrecision());
        }

        return $args;
    }

    /**
     * @param \Magento\Directory\Model\PriceCurrency $subject
     * @param array ...$args
     * @return array
     */
    public function beforeConvertAndRound(
        \Magento\Directory\Model\PriceCurrency $subject,
        ...$args
    ) {
        if ($this->getConfig()->isEnable()) {
            //add optional args
            $args[1] = isset($args[1])? $args[1] : null;
            $args[2] = isset($args[2])? $args[2] : null;
            $args[3] = $this->getPricePrecision();
        }

        return $args;
    }
}
