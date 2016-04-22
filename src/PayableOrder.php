<?php

namespace Spatie\Payment;

interface PayableOrder
{
    /**
     * @return string
     */
    public function getPaymentOrderId();

    /**
     * Should be in eurocents for most payments providers.
     *
     * @return float
     */
    public function getPaymentAmount();

    /**
     * @return string
     */
    public function getPaymentDescription();

    /**
     * @return string
     */
    public function getCustomerEmail();

    /**
     * @return string
     */
    public function getCustomerLanguage();
}
