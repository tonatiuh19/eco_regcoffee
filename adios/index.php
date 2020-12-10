<?php
	session_start();
	session_unset();
	session_destroy();
	header("location: ../");
	echo '<script type="text/javascript">
		    window.localStorage.clear();
		</script>';
?>
