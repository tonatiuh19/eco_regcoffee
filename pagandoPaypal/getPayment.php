<?php


date_default_timezone_set('America/Mexico_City');
require_once('../admin/paypal/autoload.php');
use PayPal\Api\Payment;
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

try {
    $payment = Payment::get('PAYID-L7VLP5Q6D932142KN461621R', $apiContext);
    echo $payment;
} catch (Exception $ex) {


    //ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
    exit(1);
}


 //ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);

return $payment;
?>