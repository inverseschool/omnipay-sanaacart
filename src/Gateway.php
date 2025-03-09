<?php

namespace Omnipay\SanaaCart;

use Omnipay\Common\AbstractGateway;
use Omnipay\SanaaCart\Message\CreateTokenRequest;
use Omnipay\SanaaCart\Message\VerifyOrderRequest;

class Gateway extends  AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName(): string
    {
        return 'SanaaCart';
    }

    /**
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'agentKey' => '',
        ];
    }

    /**
     * @inheritDoc
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        return $this;
    }

    public function getAgentKey(): string
    {
        return $this->getParameter('agentKey');
    }
    public function setAgentKey(string $value): self
    {
        return $this->setParameter('agentKey', $value);
    }

    /**
     * @inheritDoc
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest(CreateTokenRequest::class, $options);
    }

    /**
     * @inheritDoc
     */
    public function completePurchase(array $options = [])
    {
        return $this->createRequest(VerifyOrderRequest::class, $options);
    }
}