<?php
require_once("Openpay.php");

Openpay::setId('mklwynufmke2y82injra');
Openpay::setApiKey('sk_e8bd01b6ec2f434089ddf536725654bb');


if ($_POST["payType"]=="1") {	
	echo '<div id="overlayer"></div>
	<div class="loader">
	  <div class="spinner-border text-primary" role="status">
		<span class="sr-only">Cargando...</span>
	  </div>
	</div>';
	$customer = array(
		'name' => $_POST["uname"],
		'email' => $_POST["email"]);

		//$customer = $openpay->customers->add($customer);
	$description = $_POST["descripcion"]."|".$_POST["coffeeQuantity"];
	$mon = trim($_POST["amount"], '$');
	$mon = str_replace( ',', '', $mon );
	$chargeData = array(
		'method' => 'card',
		'source_id' => $_POST["token_id"],
		    'amount' => $mon, // formato númerico con hasta dos dígitos decimales.
		    'description' => $description,
		    'device_session_id' => $_POST["deviceIdHiddenFieldName"],
		    'customer' => $customer
		);
	$status=0;
	try {
		//Openpay::setProductionMode(false);
		$openpay = Openpay::getInstance('mklwynufmke2y82injra', 'sk_e8bd01b6ec2f434089ddf536725654bb');
		$charge = $openpay->charges->create($chargeData);
		$charge->id;
		//echo "<br>";
		$charge->status;
		//echo "<br>";

		$status=1;
	} catch (OpenpayApiTransactionError $e) {
		/*echo 'ERROR on the transaction: ' . $e->getMessage() .
			' error code: ' . $e->getErrorCode() .
			', error category: ' . $e->getCategory() .
			', HTTP code: '. $e->getHttpCode() .
			', request ID: ' . $e->getRequestId();*/
		$status=2;
	} catch (OpenpayApiRequestError $e) {
		//echo 'ERROR on the request: ' . $e->getMessage();
		$status=3;
	} catch (OpenpayApiConnectionError $e) {
		//echo 'ERROR while connecting to the API: ' . $e->getMessage();
		$status=4;
	} catch (OpenpayApiAuthError $e) {
		//echo 'ERROR on the authentication: ' . $e->getMessage();
		$status=5;
	} catch (OpenpayApiError $e) {
		//echo 'ERROR on the API: ' . $e->getMessage();
		$status=6;
	} catch (Exception $e) {
		//echo 'Error on the script: ' . $e->getMessage();
		$status=6;
	}

	

	echo '<form action="../gracias/" id="finish" method="post">';
	if ($status==1) {
		echo '<input type="hidden" name="stat" value="1">';
		echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
		echo '<input type="hidden" name="idPay" value="'.$charge->id.'">';
		echo '<input type="hidden" name="typeB" value="'.$charge->card->type.'">';
		echo '<input type="hidden" name="brand" value="'.$charge->card->brand.'">';
		echo '<input type="hidden" name="cardNo" value="'.$charge->card->card_number.'">';
		echo '<input type="hidden" name="bank" value="'.$charge->card->bank_name.'">';
		echo '<input type="hidden" name="status" value="'.$charge->status.'">';
		echo '<input type="hidden" name="date" value="'.$charge->operation_date.'">';
		echo '<input type="hidden" name="amount" value="'.$charge->amount.'">';
		echo '<input type="hidden" name="amountF" value="'.$charge->fee->amount.'">';
		echo '<input type="hidden" name="amountT" value="'.$charge->fee->tax.'">';
		echo '<input type="hidden" name="description" value="'.$charge->description.'">';
		echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
		echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
		echo '<input type="hidden" name="isPublic" value="'.$_POST["privatePublic"].'">';
		echo '<input type="hidden" name="type" value="1">';
		echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		echo '<input type="hidden" name="questAnswer" value="'.$_POST["questAnswer"].'">';
	}elseif ($status==2) {
		echo '<input type="hidden" name="stat" value="2">';
		echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
		echo '<input type="hidden" name="description" value="'.$e->getMessage().'">';
		echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
		echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
		echo '<input type="hidden" name="isPublic" value="'.$_POST["privatePublic"].'">';
		echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
	}elseif ($status==3) {
		echo '<input type="hidden" name="stat" value="3">';
		echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
		echo '<input type="hidden" name="description" value="'.$e->getMessage().'">';
		echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
		echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
		echo '<input type="hidden" name="isPublic" value="'.$_POST["privatePublic"].'">';
		echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
	}elseif ($status==4) {
		echo '<input type="hidden" name="stat" value="4">';
		echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
		echo '<input type="hidden" name="description" value="'.$e->getMessage().'">';
		echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
		echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
		echo '<input type="hidden" name="isPublic" value="'.$_POST["privatePublic"].'">';
		echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
	}elseif ($status==5) {
		echo '<input type="hidden" name="stat" value="5">';
		echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
		echo '<input type="hidden" name="description" value="'.$e->getMessage().'">';
		echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
		echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
		echo '<input type="hidden" name="isPublic" value="'.$_POST["privatePublic"].'">';
		echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
	}elseif ($status==6) {
		echo '<input type="hidden" name="stat" value="6">';
		echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
		echo '<input type="hidden" name="description" value="'.$e->getMessage().'">';
		echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
		echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
		echo '<input type="hidden" name="isPublic" value="'.$_POST["privatePublic"].'">';
		echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
	}else{
		echo '<input type="hidden" name="stat" value="6">';
		echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
		echo '<input type="hidden" name="description" value="'.$e->getMessage().'">';
		echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
		echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
		echo '<input type="hidden" name="isPublic" value="'.$_POST["privatePublic"].'">';
		echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
	}
	echo '</form>';
	//echo $status;
	echo '<script type="text/javascript">
	  document.getElementById("finish").submit();
	</script>';
}elseif ($_POST["payType"]=="2") {
	
	echo "Entre";

}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}

?>
