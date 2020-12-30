<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
date_default_timezone_set('America/Mexico_City');
require_once('../admin/paypal/autoload.php');
// Use below for direct download installation
// require __DIR__  . '/PayPal-PHP-SDK/autoload.php';
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AR-nXPqa88NuwUJl-y_EdvesUVNSV0s6J4K9l25hf6fINGpUHvrUSrnPV-gx-Uo6l1cu3yCgpcwa7NsY',     // ClientID
        'EGMMVVY1nCHxBcdGQ1A9O9gjqTwfvgLUAHIaNkH47PefhfSARZgHEi3CkRjONo5gvE28LUO3N1ViA4BG'      // ClientSecret
    )
);
$apiContext->setConfig(
    array(
      'log.LogEnabled' => true,
      'log.FileName' => 'PayPal.log',
      'log.LogLevel' => 'DEBUG'
    )
);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://example.com/your_redirect_url.html")
    ->setCancelUrl("https://example.com/your_cancel_url.html");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

// 4. Make a Create Call and print the values
try {
    $payment->create($apiContext);
    echo $payment;


    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    //https://example.com/your_redirect_url.html?paymentId=PAYID-L7VKDBQ6SD19490NW7289059&token=EC-3NJ49324J78463157&PayerID=2MWEB7JMC7TVE
    //https://example.com/your_redirect_url.html?paymentId=PAYID-L7VKD6Y7LW655880N952872D&token=EC-9JX12780TV8899150&PayerID=2MWEB7JMC7TVE
    //https://example.com/your_redirect_url.html?paymentId=PAYID-L7VLP5Q6D932142KN461621R&token=EC-7MU151116J907740D&PayerID=2MWEB7JMC7TVE
    echo $ex->getData();
}

$approvalUrl = $payment->getApprovalLink();
return $payment;
?>