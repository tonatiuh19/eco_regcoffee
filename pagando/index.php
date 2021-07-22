<?php
require_once("conekta-php/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_YM6imXFrseD7FoCUZZjKxA");
\Conekta\Conekta::setApiVersion("2.0.0");
date_default_timezone_set('America/Mexico_City');
$today = date("Y-m-d H:i:s");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if ($_POST["payType"]=="1") {	
		echo '
		<div class="loader">
		<div class="spinner-border text-primary" role="status">
			<span class="sr-only">Cargando...</span>
		</div>
		</div>';

		$description = $_POST["descripcion"]."|".$_POST["coffeeQuantity"];
		$mon = trim($_POST["amount"], '$');
		$mon = str_replace( ',', '', $mon );
		$status=0;

		try{
			$order = \Conekta\Order::create(
				[
				"line_items" => [
					[
					"name" => $description,
					"unit_price" => $mon*100,
					"quantity" => 1
					]
					],
				"currency" => "MXN",
				"customer_info" => [
					"name" => 'Usuario Asombroso',
					"email" => $_POST["email"],
					"phone" => "5512345678"
				],
				
				"metadata" => ["reference" => "12987324097", "more_info" => "lalalalala"],
				"charges" => [
					[
					"payment_method" => [
						'token_id' => $_POST["conektaTokenId"],
						'type' => "card"
					] //payment_method - use customer's default - a card
						//to charge a card, different from the default,
						//you can indicate the card's source_id as shown in the Retry Card Section
					]
				]
				]
			);

			/*echo "ID: ". $order->id;
			echo "Status: ". $order->payment_status;
			echo "$". $order->amount/100 . $order->currency;
			echo "Order";
			echo $order->line_items[0]->quantity .
				"-". $order->line_items[0]->name .
				"- $". $order->line_items[0]->unit_price/100;
			echo "Payment info";
			echo "CODE:". $order->charges[0]->payment_method->auth_code;
			echo "Card info:".
				"- ". $order->charges[0]->payment_method->name .
				"- ". $order->charges[0]->payment_method->last4 .
				"- ". $order->charges[0]->payment_method->brand .
				"- ". $order->charges[0]->payment_method->type;*/
			
			$amountMon = $order->line_items[0]->unit_price/100;
			$fee = $order->charges[0]->fee/100;
			$status=1;
		} catch (\Conekta\ProcessingError $error){
			echo $error->getMessage();
			echo $status=2;
		} catch (\Conekta\ParameterValidationError $error){
			echo $error->getMessage();
			echo $status=2;
		} catch (\Conekta\Handler $error){
			echo $error->getMessage();
			echo $status=2;
		}

		if($_POST["flipswitch"] == 'on'){
			$isPublic = 1;
		}else{
			$isPublic = 0;
		}
		
		echo '<form action="../gracias/" id="finish" method="post">';
		if ($status==1) {
			echo '<input type="hidden" name="stat" value="1">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="idPay" value="'.$order->id.'">';
			echo '<input type="hidden" name="typeB" value="'.$order->charges[0]->payment_method->type.'">';
			echo '<input type="hidden" name="brand" value="'.$order->charges[0]->payment_method->brand.'">';
			echo '<input type="hidden" name="cardNo" value="'.$order->charges[0]->payment_method->last4.'">';
			echo '<input type="hidden" name="bank" value="'.$order->charges[0]->payment_method->account_type.'">';
			echo '<input type="hidden" name="status" value="'.$order->payment_status.'">';
			echo '<input type="hidden" name="date" value="'.$today.'">';
			echo '<input type="hidden" name="amount" value="'.$amountMon.'">';
			echo '<input type="hidden" name="amountF" value="'.$fee.'">';
			echo '<input type="hidden" name="amountT" value="0">';
			echo '<input type="hidden" name="description" value="'.$order->line_items[0]->name.'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="type" value="1">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
			echo '<input type="hidden" name="questAnswer" value="'.$_POST["questAnswer"].'">';
			echo '<input type="hidden" name="period_end_date" value="'.$order->charges[0]->created_at.'">';
			echo '<input type="hidden" name="confirmationM" value="'.$_POST["confirmationM"].'">';
			echo '<input type="hidden" name="emailHost" value="'.$_POST["emailHost"].'">';
		}elseif ($status==2) {
			echo '<input type="hidden" name="stat" value="2">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==3) {
			echo '<input type="hidden" name="stat" value="3">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==4) {
			echo '<input type="hidden" name="stat" value="4">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==5) {
			echo '<input type="hidden" name="stat" value="5">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==6) {
			echo '<input type="hidden" name="stat" value="6">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}else{
			echo '<input type="hidden" name="stat" value="6">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}
		echo '</form>';
		//echo $status;
		echo '<script type="text/javascript">
		document.getElementById("finish").submit();
		</script>';
	}elseif ($_POST["payType"]=="2") {
		
		try {
			$customer = \Conekta\Customer::create(
				[
					"name" => "Usuario Asombroso",
					"email" => $_POST["email"],
					"phone" => "+52181818181",
					"metadata" => ["reference" => "12987324097", "random_key" => "random value"],
					"payment_sources" => [
					[
						"type" => "card",
						'token_id' => $_POST["conektaTokenId"],
					]
					]
				]
			);
			$status=1;
		} catch (\Conekta\ProcessingError $error){
			//$error->getMesage();
			$status=2;
		} catch (\Conekta\ParameterValidationError $error){
			$error->getMessage();
			$status=2;
		} catch (\Conekta\Handler $error){
			$error->getMessage();
			$status=2;
		}

		if($_POST["flipswitch"] != 'on'){
			$isPublic = 1;
		}else{
			$isPublic = 0;
		}
		$today = date("Y-m-d H:i:s");
		echo '<form action="../gracias/" id="finish" method="post">';
		if ($status==1) {
			echo '<input type="hidden" name="stat" value="3">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="idPay" value="pending">';
			echo '<input type="hidden" name="typeB" value="">';
			echo '<input type="hidden" name="status" value="pending">';
			echo '<input type="hidden" name="date" value="'.$today.'">';
			echo '<input type="hidden" name="amount" value="pending">';
			echo '<input type="hidden" name="brand" value="">';
			echo '<input type="hidden" name="cardNo" value="">';
			echo '<input type="hidden" name="bank" value="">';
			echo '<input type="hidden" name="description" value="pending">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="type" value="1">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
			echo '<input type="hidden" name="questAnswer" value="'.$_POST["questAnswer"].'">';
			echo '<input type="hidden" name="period_end_date" value="pending">';
			echo '<input type="hidden" name="customerID" value="'.$customer->id.'">';
			echo '<input type="hidden" name="cardID" value="">';
			echo '<input type="hidden" name="confirmationM" value="'.$_POST["confirmationM"].'">';
			echo '<input type="hidden" name="titleExtra" value="'.$_POST["titleExtra"].'">';
			echo '<input type="hidden" name="active" value="1">';
			echo '<input type="hidden" name="emailHost" value="'.$_POST["emailHost"].'">';
		}elseif ($status==2) {
			echo '<input type="hidden" name="stat" value="2">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==3) {
			echo '<input type="hidden" name="stat" value="3">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==4) {
			echo '<input type="hidden" name="stat" value="4">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==5) {
			echo '<input type="hidden" name="stat" value="5">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}elseif ($status==6) {
			echo '<input type="hidden" name="stat" value="6">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}else{
			echo '<input type="hidden" name="stat" value="6">';
			echo '<input type="hidden" name="uname" value="'.$_POST["uname"].'">';
			echo '<input type="hidden" name="description" value="'.$error->getMessage().'">';
			echo '<input type="hidden" name="email" value="'.$_POST["email"].'">';
			echo '<input type="hidden" name="noteFan" value="'.$_POST["noteFan"].'">';
			echo '<input type="hidden" name="isPublic" value="'.$isPublic.'">';
			echo '<input type="hidden" name="id-extra" value="'.$_POST["id-extra"].'">';
		}
		echo '</form>';
		echo '<script type="text/javascript">
		document.getElementById("finish").submit();
		</script>';

	}elseif ($_POST["payType"]=="3") {
		require_once("../admin/cn.php");

		$idUser = $_POST["idUser"];
		$date = $_POST["date"];
		$amount = $_POST["amount"];
		$email = $_POST["payer_email"];
		$noteFan = $_POST["noteFan"];
		$idExtra = $_POST["order"];
		$questAnswer = $_POST["questAnswer"];
		$descripcionPay = $_POST["item_name"];
		$order = $_POST["order"];
		if($_POST["flipswitch"] == 'on'){
			$isPublic = 1;
		}else{
			$isPublic = 0;
		}

		$sqli = "INSERT INTO payments (id_user, id_paypal, type, brand, card_number, bank_name, status, date, amount, amount_fee, amount_tax, description, email_user, note_fan, isPublic_note_fan, id_extra, question_answer)
		VALUES ('$idUser', '', 'paypal', '', '', '', 'pending', '$date', '$amount', '', '', '$descripcionPay', '$email', '$noteFan', '$isPublic', '$idExtra', '$questAnswer')";

		if ($conn->query($sqli) === TRUE) {
			$last_id = $conn->insert_id;
			echo '<form name="frm_customer_detail" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST" id="finish">
				<input type="hidden" name="business" value="sb-47xwsh6651755@business.example.com">
				<input type="hidden" name="item_name" value="'.$descripcionPay.'"> 
				<input type="hidden" name="item_number" value="'.$last_id.'" >
				<input type="hidden" name="amount" value="'.$amount.'"> 
				<input type="hidden" name="currency_code" value="MXN">
				<input type="hidden" name="notify_url" value="https://regalameuncafe.com/pagandoPaypal/notify.php">
				<input type="hidden" name="return" value="https://regalameuncafe.com/grazie/?order='.$last_id.'">
				<input type="hidden" name="cancel_return" value="https://regalameuncafe.com/vuelveaintentar/?order='.$last_id.'">
				<input type="hidden" name="cmd" value="_xclick"> 
				<input type="hidden" name="order" value="'.$order.'">
				<input type="hidden" id="myAdress3" name="custom" value="">	
				<input type="hidden" name="payer_email" value="'.$email.'">
			</form>';
			echo '</form>';
			echo '<script type="text/javascript">
			document.getElementById("finish").submit();
			</script>';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
			
		
			
	}else{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.location.href='../';
			</SCRIPT>");
	}
} else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}
?>
