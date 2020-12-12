<?php
require_once("Openpay.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {	

    Openpay::setProductionMode(false); 
    $openpay = Openpay::getInstance('mklwynufmke2y82injra', 'sk_e8bd01b6ec2f434089ddf536725654bb');

    //echo $customerID = $_POST["customerID"];
    //echo '<br>';
    //echo $openPayId = $_POST["subs"];
    $customer = $openpay->customers->get($_POST["customerID"]);
    $subscription = $customer->subscriptions->get($_POST["subs"]);
    $subscription->delete();
    //echo '<br>';
    //echo $subscription->id;
    $status=1;
	
	

	echo '<form action="../cancelarSubscripcion/" id="finish" method="post">';
	if ($status==1) {
        echo '<input type="hidden" name="stat" value="1">';
		echo '<input type="hidden" name="idPayment" value="'.$_POST["idPayment"].'">';
		echo '<input type="hidden" name="idExtra" value="'.$_POST["idExtra"].'">';
		echo '<input type="hidden" name="emailUser" value="'.$_POST["emailUser"].'">';
	}elseif ($status==2) {
		echo '<input type="hidden" name="stat" value="2">';
	}elseif ($status==3) {
		echo '<input type="hidden" name="stat" value="3">';
	}elseif ($status==4) {
		echo '<input type="hidden" name="stat" value="4">';
	}elseif ($status==5) {
		echo '<input type="hidden" name="stat" value="5">';
	}elseif ($status==6) {
		echo '<input type="hidden" name="stat" value="6">';
	}else{
		echo '<input type="hidden" name="stat" value="6">';
	}
	echo '</form>';
	//echo $status;
	echo '<script type="text/javascript">
	  document.getElementById("finish").submit();
	</script>';
}
	
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}

?>
