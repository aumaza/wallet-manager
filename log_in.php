<?php session_start();
            include "connection/connection.php";
            include "core/lib/lib_system.php";

      	error_reporting(E_ALL ^ E_NOTICE);
      	ini_set('display_errors', 1);





?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Wallet Manager - LOG-IN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>
<body style="background-color: #4CBB17;"><br>


<?php

if($conn){
    formLogIn();
}else{
    flyerConnFailure();
}

?>

<script type="text/javascript" src="login.js"></script>
</body>
</html>
