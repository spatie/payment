<?php

namespace Spatie\Payment\Gateways\Europabank;

use Validator;
use Spatie\Payment\Exceptions\PaymentVerificationFailedException;

class PaymentGatewayResponseValidator
{
    protected $currentOrderId;
    protected $gatewayResponse;

    public function __construct($currentOrderId, $gatewayResponse)
    {
        $this->currentOrderId = $currentOrderId;
        $this->gatewayResponse = $gatewayResponse;
    }

    public function validate()
    {
        $this->doesGatewayResponseHaveAllNecessaryFields();
        $this->validateUid();
        $this->validateOrderId();
        $this->validateHash();

        return true;
    }

    /**
     * Check if all necessary fields are present in the gateway-response.
     *
     * @throws PaymentVerificationFailedException
     */
    private function doesGatewayResponseHaveAllNecessaryFields()
    {
        $rules =
            [
                'Uid' => 'required',
                'Id' => 'required',
                'Hash' => 'required',
                'Orderid' => 'required',
                'Status' => 'required',
            ];

        if (Validator::make($this->gatewayResponse, $rules)->fails()) {
            throw new PaymentVerificationFailedException('The gateway response did not contain the necessary fields');
        }
    }

    /**
     * Validate the uid.
     *
     * @throws PaymentVerificationFailedException
     */
    private function validateUid()
    {
        if ($this->gatewayResponse['Uid'] != config('payment.europabank.uid')) {
            throw new PaymentVerificationFailedException('Uid was not correct');
        }
    }

    /**
     * Validate if the order id from the gatewayresponse is equal to the current order id.
     *
     * @throws PaymentVerificationFailedException
     */
    private function validateOrderId()
    {
        if ($this->gatewayResponse['Orderid'] != $this->currentOrderId) {
            throw new PaymentVerificationFailedException('The order id from the gateway response was not equal to the current order id');
        }
    }

    /**
     * Verify if the hash value given by the gateway matched the hash calculated
     * from the gateway response.
     *
     * @throws PaymentVerificationFailedException
     */
    private function validateHash()
    {
        if ($this->gatewayResponse['Hash'] != $this->computeHash()) {
            throw new PaymentVerificationFailedException('The hash value given by the gateway does not match the hash calculated from the gateway response');
        }
    }

    /**
     * Compute the hash for the gateway response.
     *
     * @return string
     */
    private function computeHash()
    {
        return strtoupper(
            sha1(
                $this->gatewayResponse['Id'].
                $this->gatewayResponse['Orderid'].
                config('payment.europabank.clientSecret')
            )
        );
    }
}
