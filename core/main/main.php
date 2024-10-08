<?php session_start(); 
      
      error_reporting(E_ALL ^ E_NOTICE);
      ini_set('display_errors', 1);



      include "../../connection/connection.php";
      include "../lib/lib_system.php";
      include "lib_main.php";
      include "../lib/usuarios/lib_usuarios.php";
      include "../lib/empresas/lib_empresas.php";
      include "../lib/servicios/lib_servicios.php";
      include "../lib/pagos/lib_pagos.php";


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
  

  if($varsession == null || $varsession == ''){
        echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                <title>Wallet Manager - Main</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">';
                skeleton();
                echo '</head><body style = "background: #839192;">';
                echo '<br><div class="container">
                        <div class="alert alert-danger" role="alert">';
                echo '<p align="center"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Su sesión ha caducado. Por favor, inicie sesión nuevamente</p>';
                echo '<a href="../../logout.php"><hr><button type="buton" class="btn btn-default btn-block"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Iniciar</button></a>';  
                echo "</div></div>";
                die();
                echo '</body></html>';
  }


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Wallet Manager - Menú Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>


<body style="background-color: #4169E1;" onload="lock();">

<?php mainNavBar($nombre,$avatar); ?>

  
<div class="container-fluid">
 
  <?php

    if($conn){

        // MODALES
        modalAbout();
        modalDocumentation();

        // SALIR DEL SISTEMA
        if(isset($_POST['exit'])){
          logOut($nombre);
        }

        // HOME
        if(isset($_POST['home'])){
          home($nombre);
        }

        // USUARIOS
        // creamos el objeto
        $nUsuario = new Usuarios();

        if(isset($_POST['usuarios'])){
            $nUsuario->listUsuarios($nUsuario,$conn,$dbname);
        }
        if(isset($_POST['user_bio'])){
            $nUsuario->userBio($nUsuario,$user_id,$conn,$dbname);
        }

        // EMPRESAS
        // creamos el objeto
        $nEmpresa = new Empresas();

        if(isset($_POST['empresas'])){
            $nEmpresa->listEmpresas($nEmpresa,$conn,$dbname);
        }

        // SERVICIOS
        // creamos el objeto
        $nServicio = new Servicios();
        if(isset($_POST['servicios'])){
            $nServicio->listServicios($nServicio,$conn,$dbname);
        }

        // PAGOS
        // creamos el objeto
        $nPago = new Pagos();
        if(isset($_POST['pagos'])){
            $nPago->listPagos($nPago,$user_id,$conn,$dbname);
        }

        // MODAL CALCULAR TOTAL MENSUAL
        $nPago->modalCalcularTotalMensual();

        if(isset($_POST['calcular_total_mensual'])){
            $fecha_desde = mysqli_real_escape_string($conn,$_POST['fecha_desde']);
            $fecha_hasta = mysqli_real_escape_string($conn,$_POST['fecha_hasta']);
            $nPago->formCalcularTotalMensual($nPago,$fecha_desde,$fecha_hasta,$conn,$dbname);
        }

    }else{
      flyerConnFailure();
    }


  ?>


</div>

<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="../lib/usuarios/lib_usuarios.js"></script>
<script type="text/javascript" src="../lib/empresas/lib_empresas.js"></script>
<script type="text/javascript" src="../lib/servicios/lib_servicios.js"></script>
<script type="text/javascript" src="../lib/pagos/lib_pagos.js"></script>
</body>
</html>
