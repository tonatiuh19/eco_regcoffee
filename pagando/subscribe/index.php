<?php
require_once("../Openpay.php");
require_once('../../../admin/cn.php');

Openpay::setId('my5osdjarjverf8pvgd7');
Openpay::setApiKey('sk_9252628a92d04854b9602f975da5da78');
$sql = "SELECT name, last_name FROM users WHERE email='".$_POST["email"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
	while($row = $result->fetch_assoc()) {
		$name = $row["name"];
		$last_name = $row["last_name"];
	}
} else {
	echo "0 results";
}
$full = $name." ".$last_name;
$type = $_POST["payType"];


$openpay = Openpay::getInstance('my5osdjarjverf8pvgd7', 'sk_9252628a92d04854b9602f975da5da78');
$customerData = array(
	'name' => $full,
	'email' => $_POST["email"]
);

$customer2 = $openpay->customers->add($customerData);


$openpay = Openpay::getInstance('my5osdjarjverf8pvgd7', 'sk_9252628a92d04854b9602f975da5da78');
$cardDataRequest = array(
	'holder_name' => $_POST["holder_name"],
	'card_number' => $_POST["card_number"],
	'cvv2' => $_POST["cvv2"],
	'expiration_month' => $_POST["expiration_month"],
	'expiration_year' => $_POST["expiration_year"]);

$customer = $openpay->customers->get($customer2->id);
$card = $customer->cards->add($cardDataRequest);

$todayVisit = date("Y-m-d H:i:s");

if ($type=="1") {
	$subscriptionDataRequest = array(
	'plan_id' => 'pr0cduz0zwklqlqalnk6',
	'card_id' => $card->id);
}elseif ($type=="2") {
	$subscriptionDataRequest = array(
	'plan_id' => 'p0bn6tfpnkeokfgxkyjr',
	'card_id' => $card->id);
}elseif ($type=="3") {
	$subscriptionDataRequest = array(
	'plan_id' => 'p3nazi8x3ofdih45tunq',
	'card_id' => $card->id);
}






//echo $subscription->id;

$status=0;
try {
		//Openpay::setProductionMode(false);
	$openpay = Openpay::getInstance('my5osdjarjverf8pvgd7', 'sk_9252628a92d04854b9602f975da5da78');
	$customer = $openpay->customers->get($customer2->id);
	$subscription = $customer->subscriptions->add($subscriptionDataRequest);

	$status=10;
	$sql = "INSERT INTO subscriptions (user_email, start_date, id_adresss, active, type)
	VALUES ('".$_POST["email"]."', '".$todayVisit."', '".$_POST["adres"]."', '1', '".$type."')";

	if ($conn->query($sql) === TRUE) {
		echo '<form action="../../../status/" id="finish" method="post">';
		echo '<input type="hidden" name="stat" value="10">';
		echo '<input type="hidden" name="cart" value="'.$type.'">';
		echo '<input type="hidden" name="adress" value="'.$_POST["adres"].'">';
		echo '</form>';
		echo '<script type="text/javascript">
		document.getElementById("finish").submit();
		</script>';
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
} catch (OpenpayApiTransactionError $e) {
		/*echo 'ERROR on the transaction: ' . $e->getMessage() .
			' error code: ' . $e->getErrorCode() .
			', error category: ' . $e->getCategory() .
			', HTTP code: '. $e->getHttpCode() .
			', request ID: ' . $e->getRequestId();*/
			$status=2;
			echo '<form action="../../status/" id="finish" method="post">';
			echo '<input type="hidden" name="stat" value="2">';
			echo '<input type="hidden" name="cart" value="'.$_POST["description"].'">';
			echo '</form>';
			echo '<script type="text/javascript">
			document.getElementById("finish").submit();
			</script>';
		} catch (OpenpayApiRequestError $e) {
		//echo 'ERROR on the request: ' . $e->getMessage();
			$status=3;
			echo '<form action="../../status/" id="finish" method="post">';
			echo '<input type="hidden" name="stat" value="2">';
			echo '<input type="hidden" name="cart" value="'.$_POST["description"].'">';
			echo '</form>';
			echo '<script type="text/javascript">
			document.getElementById("finish").submit();
			</script>';
		} catch (OpenpayApiConnectionError $e) {
		//echo 'ERROR while connecting to the API: ' . $e->getMessage();
			$status=4;
			echo '<form action="../../status/" id="finish" method="post">';
			echo '<input type="hidden" name="stat" value="2">';
			echo '<input type="hidden" name="cart" value="'.$_POST["description"].'">';
			echo '</form>';
			echo '<script type="text/javascript">
			document.getElementById("finish").submit();
			</script>';
		} catch (OpenpayApiAuthError $e) {
		//echo 'ERROR on the authentication: ' . $e->getMessage();
			$status=5;
			echo '<form action="../../status/" id="finish" method="post">';
			echo '<input type="hidden" name="stat" value="2">';
			echo '<input type="hidden" name="cart" value="'.$_POST["description"].'">';
			echo '</form>';
			echo '<script type="text/javascript">
			document.getElementById("finish").submit();
			</script>';
		} catch (OpenpayApiError $e) {
		//echo 'ERROR on the API: ' . $e->getMessage();
			$status=6;
			echo '<form action="../../status/" id="finish" method="post">';
			echo '<input type="hidden" name="stat" value="2">';
			echo '<input type="hidden" name="cart" value="'.$_POST["description"].'">';
			echo '</form>';
			echo '<script type="text/javascript">
			document.getElementById("finish").submit();
			</script>';
		} catch (Exception $e) {
		//echo 'Error on the script: ' . $e->getMessage();
		}

		
		?>
