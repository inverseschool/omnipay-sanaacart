<?php

namespace Omnipay\SanaaCart\Message;

use Exception;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;
use RuntimeException;

/**
 * Class AbstractRequest
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'http://test-services.saanacart.ir';

    /**
     * @return string
     */
    abstract protected function getHttpMethod();

    /**
     * @param string $endpoint
     * @return string
     */
    abstract protected function createUri(string $endpoint);

    /**
     * @param array $data
     * @return AbstractResponse
     */
    abstract protected function createResponse(array $data);

    public function getAmount(): string
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value): self
    {
        return $this->setParameter('amount', $value);
    }

    /**
     * @return string
     */
    public function getAgentKey(): string
    {
        return $this->getParameter('agentKey');
    }
    public function setAgentKey(string $value): self
    {
        return $this->setParameter('agentKey', $value);
    }



    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->getParameter('orderId');
    }
    public function setOrderId(string $value): self
    {
        return $this->setParameter('orderId', $value);
    }

    public function getCallBackUrl(): string
    {
        return $this->getParameter('callbackUrl');
    }
    public function setCallBackUrl(string $value): self
    {
        return $this->setParameter('callbackUrl', $value);
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        if ($this->getTestMode()) {
            throw new \InvalidArgumentException('SanaaCart payment gateway does not support test mode.');
        }
        return $this->liveEndpoint;
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send.
     * @return ResponseInterface
     * @throws RuntimeException
     * @throws InvalidResponseException
     */
    public function sendData($data)
    {
        try {
            $body = json_encode($data);

            if ($body === false) {
                throw new RuntimeException('Err in access/refresh token.');
            }

            $httpResponse = $this->httpClient->request(
                $this->getHttpMethod(),
                $this->createUri($this->getEndpoint()),
                [
                    'Accept' => 'application/json',
                    'Content-type' => 'Application/json',
                    'AgentKey' => $this->getAgentKey(),
                ],
                $body
            );
            $json = $httpResponse->getBody()->getContents();
            $result = !empty($json) ? json_decode($json, true) : [];
            $result['httpStatus'] = $httpResponse->getStatusCode();
            return $this->response = $this->createResponse($result);
        } catch (Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
