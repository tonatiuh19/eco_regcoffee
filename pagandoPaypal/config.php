<?php
define('ProPayPal', 0);
if(ProPayPal){
	define("PayPalClientId", "*********************");
	define("PayPalSecret", "*********************");
	define("PayPalBaseUrl", "https://api.paypal.com/v1/");
	define("PayPalENV", "production");
} else {
	define("PayPalClientId", "ARHUUeNT_WdabZnL3AH6e5WY5sEDlj_wJawH1a7c7PkATfN3ZwyDTo0xOmAVUyDpLtO6skYM3Ooikl71");
	define("PayPalSecret", "EChDV9reG_PooeIbETe62ScIBWRl7Tv1HEe6SIk9c33vH8hDkUHXVUoKD3pttcNU2C_9Ho5HRP0f2C1L");
	define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
	define("PayPalENV", "sandbox");
}
?>