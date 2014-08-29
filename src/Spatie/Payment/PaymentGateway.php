<?php namespace Spatie\Payment;

/**
 * Interface PaymentGateWay
 * @package Spatie\Payment
 */
interface PaymentGateway {

    const PAYMENT_RESULT_OK = 'authorized';
    const PAYMENT_RESULT_DECLINED = 'declined';
    const PAYMENT_RESULT_CANCELLED_BY_CARDHOLDER = 'cancelledByCardHolder';
    const PAYMENT_RESULT_FAILED = 'failed';
    const PAYMENT_TIMED_OUT = 'timeout';

    /**
     * Set the order to be paid
     *
     * @param $order
     * @return PaymentGateway
     */
    public function setOrder(PayableOrder $order);

    /**
     * Get the payment form
     *
     * @return string
     */
    public function getPaymentForm();


    /**
     * Validate the response given by the payment gateway
     * If gatewayResponse is null, Input::all() will be used
     *
     * @param $orderId
     * @param array $gatewayResponse
     * @return bool
     */
    public function validateGatewayResponse($orderId, $gatewayResponse = null);


    /**
     * Determine the result of the payment
     * If gatewayResponse is null, Input::all() will be used
     *
     * @param null $gatewayResponse
     * @return string
     */
    public function getPaymentResult($gatewayResponse = null);


}