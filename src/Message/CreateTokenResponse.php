<?php


namespace Omnipay\SanaaCart\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class CreateOrderResponse
 */
class CreateTokenResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {

        return (int)$this->getHttpStatus() === 200 && !empty($this->getTransactionReference());
    }

    public function getTransactionReference()
    {
        return $this->data['TransactionCode'];
    }
    public function getRedirectUrl()
    {
        return $this->data['paymentUrl'];
    }

    public function isRedirect(): bool
    {
        return !is_null($this->data['paymentUrl']);
    }
}
