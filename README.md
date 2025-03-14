## Instalation

    composer require inverseschool/omnipay-sanaacart

## Example

###### Purchase

#### The result will be a redirect to the gateway or bank.

```php
    $gateway->setAgentKey('xxxxxxxxxxxx');
   
    $response = $gateway->purchase([
        'amount' => $amount,
        'orderId' => 'Merchant-Ref-X',
        'callbackUrl' => 'https://www.example.com/return',
    ])->send();

    // Process response
    if ($response->isSuccessful() && $response->isRedirect()) {
        // store the transaction reference to use in completePurchase()
        $transactionReference = $response->getTransactionReference();
        // Redirect to offsite payment gateway
        $response->redirect();
    } else {
        // Payment failed: display message to customer
        echo $response->getMessage();
    }

```

### Complete Purchase (Verify)

Verify an order by `Transaction Reference`:

```php
    // Send purchase complete request
    
    $response = $gateway->completePurchase([
        'transactionReference' => $refNum,
    ])->send();
    
    if (!$response->isSuccessful() || $response->isCancelled()) {
        // Payment failed: display message to customer
        echo $response->getMessage();
    } else {
        // Payment was successful
        print_r($response);
    }
```




