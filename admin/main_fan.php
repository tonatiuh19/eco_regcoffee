<?php
require_once('../admin/header.php');
?>
Hola
<?php
require_once('../admin/footer.php');
$session_value=basename(dirname(__FILE__));
?>
<script type="text/javascript">
	var myTitle='<?php echo $session_value;?>';
	document.title = 'Regalame un Cafe';
</script>