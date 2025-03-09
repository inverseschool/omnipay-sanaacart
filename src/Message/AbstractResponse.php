<?php


namespace Omnipay\SanaaCart\Message;

/**
 * Class AbstractResponse
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * @var array
     */
    protected $errorCodes = [
        '100' => 'خطای داخلی نرم افزار',
        '101' => 'تعداد در خواست ها در دقیقه از حد مجاز بیشتر شده است',
        '103' => 'مقدار HttpMethod درخواست اشتباه می باشد',
        '104' => 'پارامتر ضروری ارسال نشده است',
        '105' => 'Api غیر فعال است',
        '106' => 'دامنه درخواست مورد نظر معتبر نمی باشد',
        '107' => 'آی پی درخواست مورد نظر معتبر نمی باشد',
        '108' => 'پارامتر های ارسال شده نامعتبر می باشد',
        '114' => 'version_code معتبر نمی باشد',
        '150' => 'AgentKey ارسال نشده است',
        '151' => 'TransactionAmount ارسال نشده است',
        '152' => 'CustomerMobileNumber ارسال نشده است',
        '153' => 'CallbackUrl ارسال نشده است',
        '155' => 'تنظیمات درگاه پرداخت برای پذیرنده مورد نظر ثبت نشده است',
        '156' => 'پذیرنده مورد نظر فعال نمی باشد',
        '157' => 'تنظیمات درگاه پرداخت پذیرنده مورد نظر فعال نمی باشد',
        '158' => 'IP پذیرنده معتبر نمی باشد',
        '159' => 'TransactionCode ارسال نشده است',
        '160' => 'TransactionCode معتبر نمی باشد',
        '161' => 'مدت زمان فعال بودن تراکنش مورد نظر سپری شده است',
        '162' => 'وضعیت تراکنش معتبر نمی باشد',
        '163' => 'عدم امکان لغو سفارش',


    ];


    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return $this->errorCodes[(string)$this->getErrorCode()] ?? parent::getMessage();
    }

    public function getErrorCode()
    {
        return $this->data['errorCode'] ?? ($this->data['ResultCode'] ?? parent::getCode());
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        return $this->data['status'] ?? parent::getCode();
    }

    public function getResultCode()
    {
        return $this->data['ResultCode'] ?? null;
    }

    /**
     * Http status code
     *
     * @return int A response code from the payment gateway
     */
    public function getHttpStatus(): int
    {
        return (int)($this->data['httpStatus'] ?? null);
    }
}
