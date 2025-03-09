<?php

namespace Omnipay\SanaaCart\Message;

/**
 * Class VerifyOrderResponse
 */
class VerifyOrderResponse extends AbstractResponse
{

    /**
     * @inheritDoc
     */
    public function isSuccessful(): bool
    {
        return $this->getHttpStatus() === 200 && (int)$this->getResultCode() === 1;
    }

    /**
     * @inheritDoc
     */
    public function isCancelled(): bool
    {
        return $this->getHttpStatus() === 200 && (int)$this->getResultCode() !== 1;
    }

    /**
     * A reference provided by the gateway to represent this transaction.
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['rrn'];
    }
}
