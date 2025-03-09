<?php

namespace Omnipay\SanaaCart\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class CreateTokenRequest
 */
class CreateTokenRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    protected function getHttpMethod(): string
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
    public function getData(): array
    {
        // Validate required parameters before return data
        $this->validate('amount', 'orderId');

        return [
            'orderId' => $this->getOrderId(),
            'amount' => $this->getAmount(),
            'callbackUrl' => $this->getCallBackUrl()
        ];
    }

    public function getTerminalId(): ?string
    {
        return $this->getParameter('terminalId');
    }

    /**
     * @param string $endpoint
     * @return string
     */
    protected function createUri(string $endpoint): string
    {
        return $endpoint . '/api/cpg/pay';
    }

    /**
     * @param array $data
     * @return CreateTokenResponse
     */
    protected function createResponse(array $data): CreateTokenResponse
    {
        return new CreateTokenResponse($this, $data);
    }
}
