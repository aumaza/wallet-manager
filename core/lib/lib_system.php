<?php


/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/wallet-manager/skeleton/css/bootstrap.min.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/bootstrap-theme.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/bootstrap-theme.min.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/scrolling-nav.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/font-awesome.min.css" >
		<link rel="stylesheet" href="/wallet-manager/core/main/main.css" >
			
		<link rel="stylesheet" href="/wallet-manager/skeleton/Chart.js/Chart.min.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/Chart.js/Chart.css" >
		
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/jquery.dataTables.min.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/buttons.dataTables.min.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/buttons.bootstrap.min.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/css/jquery.dataTables-1.11.5.min.css" >
		<link rel="stylesheet" href="/wallet-manager/skeleton/dataTables/fixedColumns.dataTables.min.css" >
		
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	    
	    <script src="/wallet-manager/skeleton/js/jquery-3.4.1.min.js"></script>
	    <script src="/wallet-manager/skeleton/js/jquery-3.5.1.min.js"></script>
		<script src="/wallet-manager/skeleton/js/bootstrap.min.js"></script>
		
		<script src="/wallet-manager/skeleton/js/jquery.dataTables.min.js"></script>
		<script src="/wallet-manager/skeleton/dataTables/DataTables/js/jquery.dataTables1.min.js"></script>
		<script src="/wallet-manager/skeleton/dataTables/DataTables/js/dataTables.fixedColumns.min.js"></script>
		
		<script src="/wallet-manager/skeleton/js/dataTables.editor.min.js"></script>
		<script src="/wallet-manager/skeleton/js/dataTables.select.min.js"></script>
		<script src="/wallet-manager/skeleton/js/dataTables.buttons.min.js"></script>
		<script src="/wallet-manager/skeleton/dataTables/DataTables/js/buttons.colVis.min.js"></script>
		
		<script src="/wallet-manager/skeleton/js/jszip.min.js"></script>
		<script src="/wallet-manager/skeleton/js/pdfmake.min.js"></script>
		<script src="/wallet-manager/skeleton/js/vfs_fonts.js"></script>
		<script src="/wallet-manager/skeleton/js/buttons.html5.min.js"></script>
		<script src="/wallet-manager/skeleton/js/buttons.bootstrap.min.js"></script>
		<script src="/wallet-manager/skeleton/js/buttons.print.min.js"></script>
		
		<script src="/wallet-manager/skeleton/Chart.js/Chart.min.js"></script>
		<script src="/wallet-manager/skeleton/Chart.js/Chart.bundle.min.js"></script>
		<script src="/wallet-manager/skeleton/Chart.js/Chart.bundle.js"></script>
		<script src="/wallet-manager/skeleton/Chart.js/Chart.js"></script>';
}


function formLogIn(){

		echo '<div class="container">
					<div class="jumbotron">
					<h1><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Wallet Manager</h1>
					<p>Ingrese sus datos</p><hr>
  
				   <form id="fr_login_ajax" method="POST">
				    <div class="form-group">
				      <label for="email">Usuario:</label>
				      <input type="email" class="form-control" id="user" name="user" placeholder="Ingrese su email">
				    </div>
				    <div class="form-group">
				      <label for="pwd">Password:</label>
				      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Ingrese su password">
				    </div><br>
				    
				    <div class="alert alert-info">
					    <button type="submit" class="btn btn-default btn-block" id="login" name="login"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Ingresar</button>
					    <button type="reset" class="btn btn-default btn-block"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Limpiar Formulario</button>
				    </div>
				  </form><hr>
				  
				  <div id="messageLogIn"></div>

				</div>
				</div>';

}


/*
** Funcion de validación de ingreso
*/
function logIn($user,$pass,$conn,$db_basename){

    mysqli_select_db($conn,$db_basename);
    
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass;
	
	$sql_1 = "select password from wm_usuarios where user = '$user'";
	$query_1 = mysqli_query($conn,$sql_1);
	while($row = mysqli_fetch_array($query_1)){
        $hash = $row['password'];
	}
	
    
    
	$sql = "SELECT * FROM wm_usuarios where user = '$user' and role = 1";
	$q = mysqli_query($conn,$sql);
	
	$query = "SELECT * FROM wm_usuarios where user = '$user' and role = 0";
	$retval = mysqli_query($conn,$query);
	
	
	
	if(!$q && !$retval){	
			echo 7; // CONNECTION FAILURE
			
			}
		
			if(($user = mysqli_fetch_assoc($retval)) && (password_verify($pass,$hash))){
				

				echo -1; // USER BLOCK
			}

			else if(($user = mysqli_fetch_assoc($q)) && (password_verify($pass,$hash))){

				if(strcmp($_SESSION["user"], 'root@gmail.com') == 0){

					echo 1; // LOGIN SUCCESSFULLY
				
				
			}else{
				echo 1; // LOGIN SUCESSFULLY
				
			}
			}else{
				echo 2; // USER OR PASSWORD INCORRECT
				}
}


function flyerConnFailure(){

		echo '<div class="container">
				  <div class="jumbotron">
				    <h1><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Atención</h1><hr>
				    <div class="alert alert-danger">    
				    	<p><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Sin Conexión a la Base de Datos. Contactese con el Administrador.</p>
				    </div><hr>
				  </div>';

}


function logOut($nombre){
    
    echo '<div class="container"> 
    			<div class="jumbotron">
                <h1 align=center>Hasta Luego '.$nombre.'</h1><hr>
                <p align=center><img src="logout.gif"  class="img-reponsive img-rounded"></p><hr>
                <meta http-equiv="refresh" content="4;URL=../../logout.php "/>
            </div>
            </div>';

}

function home($nombre){

	echo '<div class="container">
    			<div class="jumbotron">
    			<footer class="container-fluid text-center">
					  <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Wallet Manager
					</footer><hr>';
					if($nombre == ''){
                        echo '<p align=center><img src="core/img/wallet_home.jpg"  class="img-reponsive img-rounded" style="width:60%"></p><hr>';
                    }
                    if($nombre != ''){
                        echo '<p align=center><img src="../img/wallet_home.jpg"  class="img-reponsive img-rounded" style="width:60%"></p><hr>';
                    }

                	echo '<footer class="container-fluid text-center">
					  Develop by <a href="mailto:develslack@gmail.com">Slackzone Development</a>
					</footer>
          		</div>
            </div>';
}

function about(){

    echo '<div class="container">
                <div class="jumbotron">
                <h2><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Acerca de...</h2><hr>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Tecnologías</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                        </u>
                        <li>Bootstrap 3.4</li>
                        <li>PHP 7.4 o superior</li>
                        <li>Mysql 10.3 o superior</li>
                        <li>JavaScript</li>
                        </u>
                        </div>
                    </div>
                    </div>
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Desarrolladores</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                        <ul>
                        <li>Augusto Maza</li>
                        </ul>
                        </div>
                    </div>
                    </div>
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Descripción</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                        <ul>
                        <li>Aplicación para llevar la cuenta y administración de gastos personales.</li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                </div>';

}

/*
** GUARDAR LOS ERRORES DE MYSQL
*/
function mysqlErrorLogs($error){

      $fileName = "mysql_error.log";
      $date = date("d-m-Y H:i:s");
      $message = 'Error: '.$error.' - '.$date;

        if (file_exists($fileName)){

        $file = fopen($fileName, 'a');
        fwrite($file, "\n".$date);
        fclose($file);
        //chmod($file, 0777);

        }else{
            $file = fopen($fileName, 'w');
            fwrite($file, $message);
            fclose($file);
            //chmod($file, 0777);
            }

}


?>
