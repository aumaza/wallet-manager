<?php
      	error_reporting(E_ALL ^ E_NOTICE);
      	ini_set('display_errors', 1);

		include "connection/connection.php";
		include "core/lib/lib_system.php";



?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Wallet Manager - Acerca de...</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>
<body style="background-color: #0096FF;"><br>


<?php

if($conn){
    about();
}else{
    flyerConnFailure();
}

?>

<script type="text/javascript" src="login.js"></script>
</body>
</html>
