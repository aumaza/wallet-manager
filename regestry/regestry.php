<?php 	error_reporting(E_ALL ^ E_NOTICE);
      	ini_set('display_errors', 1);

		include "../connection/connection.php";
		include "../core/lib/lib_system.php";
    include "lib_regestry.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wallet Manager - Registro de Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>

</head>
<body style = "background: #F4C430;"><br>

	
	<?php

    $oneRegestry = new Regestry();

		if($conn){
			$oneRegestry->formRegestry();
		}else{
			flyerConnFailure();
		}


	?>

<script type="text/javascript" src="lib_regestry.js"></script>

</body>
</html>
