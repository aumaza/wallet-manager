<?php 	error_reporting(E_ALL ^ E_NOTICE);
      	ini_set('display_errors', 1);

		include "../connection/connection.php";
		include "../core/lib/lib_system.php";
    include "lib_password.php";



?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Wallet Manager - Cambio de Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>

</head>
<body style = "background: #FF4433;"><br>


	
	<?php

    $onePassword = new Password();

		if($conn){
			$onePassword->formResetPassword();
		}else{
			flyerConnFailure();
		}


	?>

<script type="text/javascript" src="lib_password.js"></script>

</body>
</html>
