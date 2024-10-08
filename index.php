<?php    session_start();
                include "connection/connection.php";
                include "core/lib/lib_system.php";

                error_reporting(E_ALL ^ E_NOTICE);
                ini_set('display_errors', 1);

            //$php_version = phpversion();

       $varsession = $_SESSION['user'];

      if($conn){

        $sql = "select id, name, avatar from wm_usuarios where user = '$varsession'";
        mysqli_select_db($conn,$db_basename);
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
          $nombre = $row['name'];
          $user_id = $row['id'];
          $avatar = '..'.substr($row['avatar'], 7);

        }
      }else{
        echo 'CONNECTION FAILURE';
      }





?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Wallet Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>
<body style="background-color: #4169E1;">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Wallet Manager</a>
    </div>
    <ul class="nav navbar-nav">
      <li><button type="button" class="btn btn-success navbar-btn" onclick="callLogIn();">
                <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Ingresar</button></li>
      <li><button class="btn btn-danger navbar-btn" onclick="callPassword();">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Olvidé mi Password</button></li>
      <li><button class="btn btn-warning navbar-btn" onclick="callRegestry();">
                <span class="glyphicon glyphicon-flash" aria-hidden="true"></span> Registrarse</button></li>
      <li><button class="btn btn-info navbar-btn" onclick="callAbout();">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Acerca de...</button></li>
    </ul>
  </div>
</nav>

<?php

if($conn){
    home($nombre);
}else{
    flyerConnFailure();
}

?>

<script type="text/javascript" src="login.js"></script>
</body>
</html>
