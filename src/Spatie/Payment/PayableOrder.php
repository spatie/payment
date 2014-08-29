<?php namespace Spatie\Payment;

interface PayableOrder {

    /**
     * @return string
     */
    public function getPaymentOrderId();

    /**
     * @return double
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