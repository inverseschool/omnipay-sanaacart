<?php

namespace Omnipay\SanaaCart\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class VerifyOrderRequest
 */
class VerifyOrderRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData():array
    {
        return [
            'transactionCode' => $this->getTransactionReference()
        ];
    }

    /**
     * @param string $endpoint
     * @return string
     */
    protected function createUri(string $endpoint)
    {
        return $endpoint . '/api/cpg/confirm';
    }

    /**
     * @param array $data
     * @return VerifyOrderResponse
     */
    protected function createResponse(array $data)
    {
        return new VerifyOrderResponse($this, $data);
    }
}
