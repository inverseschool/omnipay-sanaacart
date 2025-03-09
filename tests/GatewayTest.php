<?php


namespace Omnipay\SanaaCart\Tests;

use Omnipay\SanaaCart\Gateway;
use Omnipay\SanaaCart\Message\CreateTokenResponse;
use Omnipay\Tests\TestCase;

class GatewayTest extends TestCase
{

    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * @var array<string, integer|string|boolean>
     */
    protected $params;


    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setAgentKey('ASDSA78ASDAS8DAS798AS7D98A7S9');
    }


    public function testPurchaseSuccess(): void
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $paramValue = [
            'amount' => 1000,
            'orderId' => '1qaz@WSX',
            'callbackUrl' => 'http://mysite.com/receipt',
        ];

        /** @var CreateTokenResponse $response */
        $response = $this->gateway->purchase($paramValue)->send();
        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals('259b47f5-c273-4a8a-8a4a-b7e58bbde539',$response->getTransactionReference());
        self::assertEquals('https://cpg.saanacart.ir/payment/pay/259b47f5-c273-4a8a-8a4a-b7e58bbde539', $response->getRedirectUrl());
    }

}