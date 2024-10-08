<?php

class Pagos{

    // PROPIEDADES
    private $id_usuario = '';
    private $id_empresa = '';
    private $id_servicio = '';
    private $fecha_vencimiento = '';
    private $fecha_pago_realizado = '';
    private $monto_pagar = '';
    private $monto_pagado = '';
    private $comprobante_pago = '';
    private $file_path = '';

    // CONSTRUCTOR
    function __construct(){
            $this->id_usuario = '';
            $this->id_empresa = '';
            $this->id_servicio = '';
            $this->fecha_vencimiento = '';
            $this->fecha_pago_realizado = '';
            $this->monto_pagar = '';
            $this->monto_pagado = '';
            $this->comprobante_pago = '';
            $this->file_path = '';
    }

    // SETTERS
    private function setIdUsuario($var){
        $this->id_usuario = $var;
    }

    private function setIdEmpresa($var){
        $this->id_empresa = $var;
    }

    private function setIdServicio($var){
        $this->id_servicio = $var;
    }

    private function setFechaVencimiento($var){
        $this->fecha_vencimiento = $var;
    }

    private function setFechaPago($var){
        $this->fecha_pago_realizado = $var;
    }

    private function setMontoPagar($var){
        $this->monto_pagar = $var;
    }

    private function setMontoPagado($var){
        $this->monto_pagado = $var;
    }

    private function setComprobantePago($var){
        $this->comprobante_pago = $var;
    }

    private function setFilePath($var){
        $this->file_path = $var;
    }


    // GETTERS
    private function getIdUsuario($var){
        return $this->id_usuario = $var;
    }

    private function getIdEmpresa($var){
        return $this->id_empresa = $var;
    }

    private function getIdServicio($var){
        return $this->id_servicio = $var;
    }

    private function getFechaVencimiento($var){
        return $this->fecha_vencimiento = $var;
    }

    private function getFechaPago($var){
        return $this->fecha_pago_realizado = $var;
    }

    private function getMontoPagar($var){
        return $this->monto_pagar = $var;
    }

    private function getMontoPagado($var){
        return $this->monto_pagado = $var;
    }

    private function getComprobantePago($var){
        return $this->comprobante_pago = $var;
    }

    private function getFilePath($var){
        return $this->file_path = $var;
    }


    // METODOS
    public function listPagos($nPago,$user_id,$conn,$dbname){

        if($conn){

                if($user_id == 1){

                    $sql = "select id, (select name from wm_usuarios where id = wm_pagos.id_usuario) as usuario, (select descripcion from wm_empresas where id = wm_pagos.id_empresa ) as empresa, (select descripcion from wm_servicios where id = wm_pagos.id_servicio) as servicio, fecha_vencimiento, fecha_pago_realizado, monto_pagar, monto_pagado, comprobante_pago, file_path from wm_pagos";
                    mysqli_select_db($conn,$dbase);
                    $resultado = mysqli_query($conn,$sql);
                }

                if($user_id != 1){

                    $sql = "select id, (select name from wm_usuarios where id = wm_pagos.id_usuario) as usuario, (select descripcion from wm_empresas where id = wm_pagos.id_empresa ) as empresa, (select descripcion from wm_servicios where id = wm_pagos.id_servicio) as servicio, fecha_vencimiento, fecha_pago_realizado, monto_pagar, monto_pagado, comprobante_pago, file_path from wm_pagos where id_usuario = '$user_id'";
                    mysqli_select_db($conn,$dbase);
                    $resultado = mysqli_query($conn,$sql);
                }

                //mostramos fila x fila
                $count = 0;
                echo '<div class="container-fluid">
                            <div class="jumbotron">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <img src="../img/icons/actions/view-loan.png"  class="img-reponsive img-rounded" alt="img" /> <strong>Pagos</strong>
                                </div>
                            </div><hr>

                            <button type="button" class="btn btn-primary btn-sm" id="new_pago" onclick="callNewPago();">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Pago</button>

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalCalcularTotalMensual">
                                <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Calcular Total Mensual</button>
                            <hr>';


                echo "<table class='display compact' style='width:100%' id='pagosTable'>";


                echo "<thead>
                                <th class='text-nowrap text-center'><span class='label label-default'>Usuario</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Empresa</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Tipo Servicio</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Fecha Vencimiento</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Fecha Pago Realizado</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Monto a Pagar</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Monto Pagado</span></th>
                                <th class='text-nowrap text-center'><span class='label label-warning'>Acciones</span></th>
                            </thead>";


                while($fila = mysqli_fetch_array($resultado)){
                        // Listado normal
                        echo "<tr>";
                        echo "<td align=center>".$nPago->getIdUsuario($fila['usuario'])."</td>";
                        echo "<td align=center>".$nPago->getIdEmpresa($fila['empresa'])."</td>";
                        echo "<td align=center>".$nPago->getIdServicio($fila['servicio'])."</td>";
                        echo "<td align=center>".$nPago->getFechaVencimiento($fila['fecha_vencimiento'])."</td>";
                        echo "<td align=center>".$nPago->getFechaPago($fila['fecha_pago_realizado'])."</td>";
                        echo "<td align=center>$".$nPago->getMontoPagar($fila['monto_pagar'])."</td>";
                        echo "<td align=center>$".$nPago->getMontoPagado($fila['monto_pagado'])."</td>";
                        echo '<td class="text-nowrap" align=center>
                                        <button type="button" class="btn btn-warning" value="'.$fila['id'].'"  onclick="callEditPago(this.value);">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>';

                                        if($nPago->getComprobantePago($fila['comprobante_pago']) == ''){
                                            echo '<button type="button" class="btn btn-primary" value="'.$fila['id'].'"  onclick="callUploadComprobante(this.value);">
                                                <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Subir Comprobante</button>';
                                        }
                                        if($nPago->getComprobantePago($fila['comprobante_pago']) != ''){
                                            echo '<a href="../lib/pagos/view_comprobante.php?id='.$fila['id'].'"><button type="button" class="btn btn-info" target="_blank">
                                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Comprobante</button></a>';
                                        }

                        echo '<button type="button" class="btn btn-default" onclick="callWhatsapp();" target="_blank">
                                            <img src="../img/whatsappx22.png"  class="img-reponsive img-rounded"> Whatsapp</button>';

                        echo '</td>';
                                $count++;
                    }

                    echo "</table>";
                    echo "<hr>";
                    echo '<div class="alert alert-info">
                                    <span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
                                    <strong>Cantidad de Registros:</strong>  ' .$count.'
                                </div><hr>';

                    echo '</div>
                               </div>';
                    }else{
                        echo 'Connection Failure...';
                    }

                mysqli_close($conn);

    } // END OF FUNCTION


    public function formCalcularTotalMensual($nPago,$fecha_desde,$fecha_hasta,$conn,$dbname){

        if($conn){

                /*$sql = "select monto_pagar, (select descripcion from wm_servicios where id = wm_pagos.id_servicio) as servicio from wm_pagos where  id_servicio in (1,2,3,5,13,16) and fecha_vencimiento between '$fecha_desde' and '$fecha_hasta' group by id_servicio";*/

                $sql = "with servicios as (
                                select monto_pagar, (select descripcion from wm_servicios where id = wm_pagos.id_servicio) as servicio from wm_pagos where  id_servicio in (1,2,3,5,13,16) and fecha_vencimiento between '$fecha_desde' and '$fecha_hasta')
                                select monto_pagar, servicio from servicios
                                union
                                select sum(monto_pagar), 'Total' from servicios";

                mysqli_select_db($conn,$dbase);
                $resultado = mysqli_query($conn,$sql);

                //mostramos fila x fila
                $count = 0;
                echo '<div class="container-fluid">
                            <div class="jumbotron">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <img src="../img/icons/actions/view-income-categories.png"  class="img-reponsive img-rounded" alt="img" />
                                    <strong>Total Mensual Período: '.$fecha_desde.' a '.$fecha_hasta.'</strong>
                                </div>
                            </div><hr>';

                echo "<table class='display compact' style='width:100%' id='totalMensualTable'>";


                echo "<thead>
                                <th class='text-nowrap text-center'><span class='label label-default'>Importe</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Servicio</span></th>
                                <th class='text-nowrap text-center'></th>
                            </thead>";


                while($fila = mysqli_fetch_array($resultado)){
                        // Listado normal
                        echo "<tr>";

                        if($nPago->getIdServicio($fila['servicio']) == 'Total'){
                            echo "<td align=center><span class='label label-success'> $".$nPago->getMontoPagar($fila['monto_pagar'])."</span></td>";
                            echo "<td align=center><span class='label label-success'> ".$nPago->getIdServicio($fila['servicio'])."</span></td>";
                        }else{
                            echo "<td align=center>$".$nPago->getMontoPagar($fila['monto_pagar'])."</td>";
                            echo "<td align=center>".$nPago->getIdServicio($fila['servicio'])."</td>";
                        }
                        echo '<td class="text-nowrap" align=center></td>';
                                $count++;
                    }

                    echo "</table>";
                    echo "<hr>";
                    echo '<div class="alert alert-info">
                                    <span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
                                    <strong>Cantidad de Servicios a Pagar:</strong>  ' .$count.'
                                </div><hr>';

                    echo '</div>
                               </div>';
                    }else{
                        echo 'Connection Failure...';
                    }

                mysqli_close($conn);

    } // END OF FUNCTION


// FORMULARIOS

public function formNewPago($user_id,$conn,$dbname){

    echo '<div class="container">
                    <div class="jumbotron">
                    <h2><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Añadir Pago</h2><hr>

                    <form id="fr_add_pago_ajax" method="POST" enctype="multipart/form-data">

                        <input type="hidden" id="user_id" name="user_id" value="'.$user_id.'">

                        <div class="form-group">
				                <label for="id_empresa"><span class="badge">Empresas</span></label>
				                <select class="form-control" id="id_empresa" name="id_empresa">
				                <option value="" disabled selected>Seleccionar</option>';


				                    $query = "SELECT id, descripcion FROM wm_empresas order by descripcion ASC";
				                    mysqli_select_db($conn,$db_basename);
				                    $res = mysqli_query($conn,$query);

				                    if($res){
				                        while ($valores = mysqli_fetch_array($res)){
				                        	echo '<option value="'.$valores['id'].'">'.$valores['descripcion'].'</option>';
				                        }
				                    }


						      	echo '</select>
						        </div>

                        <div class="form-group">
				                <label for="id_servicio"><span class="badge">Servicios</span></label>
				                <select class="form-control" id="id_servicio" name="id_servicio">
				                <option value="" disabled selected>Seleccionar</option>';


				                    $query = "SELECT id, descripcion FROM wm_servicios order by descripcion ASC";
				                    mysqli_select_db($conn,$db_basename);
				                    $res = mysqli_query($conn,$query);

				                    if($res){
				                        while ($valores = mysqli_fetch_array($res)){
				                        	echo '<option value="'.$valores['id'].'">'.$valores['descripcion'].'</option>';
				                        }
				                    }

				                    mysqli_close($conn);

						      	echo '</select>
						        </div>

                        <div class="form-group">
                        <label for="fecha_vencimiento"><span class="badge"> Fecha Vencimiento </span></label>
                        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
                        </div>

                        <div class="form-group">
                        <label for="fecha_pago_realizado"><span class="badge"> Fecha Pago Realizado </span></label>
                        <input type="date" class="form-control" id="fecha_pago_realizado" name="fecha_pago_realizado">
                        </div>

                        <div class="form-group">
                        <label for="monto_pagar"><span class="badge"> Monto a Pagar </span></label>
                        <input type="text" class="form-control" id="monto_pagar" name="monto_pagar" placeholder="$">
                        </div>

                        <div class="form-group">
                        <label for="monto_pagado"><span class="badge"> Monto Pagado </span></label>
                        <input type="text" class="form-control" id="monto_pagado" name="monto_pagado" placeholder="$">
                        </div>

                        <div class="form-group">
                        <label for="file"><span class="badge"> Comprobante Pago </span></label>
                        <input type="file" class="form-control" id="my_file" name="my_file">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="add_pago">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>
                    </form><hr>

                    <div id="messageNewPago" ></div>

                    </div>
                    </div>';

} // END OF FUNCTION


public function formEditPago($nPago,$id,$conn,$dbname){

    mysqli_select_db($conn,$dbname);
    $sql = "select * from wm_pagos where id = '$id'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);

    echo '<div class="container">
                    <div class="jumbotron">
                    <h2><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar Pago</h2><hr>

                    <form id="fr_update_pago_ajax" method="POST">

                        <input type="hidden" id="id" name="id" value="'.$id.'">

                        <div class="form-group">
				                <label for="id_empresa"><span class="badge">Empresas</span></label>
				                <select class="form-control" id="id_empresa" name="id_empresa">
				                <option value="" disabled selected>Seleccionar</option>';


				                    $query = "SELECT id, descripcion FROM wm_empresas order by descripcion ASC";
				                    mysqli_select_db($conn,$db_basename);
				                    $res = mysqli_query($conn,$query);

				                    if($res){
				                        while ($valores = mysqli_fetch_array($res)){
				                        	echo '<option value="'.$valores['id'].'" '.($nPago->getIdEmpresa($row['id_empresa']) == $valores['id'] ? 'selected' : '').'>'.$valores['descripcion'].'</option>';
				                        }
				                    }


						      	echo '</select>
						        </div>

                        <div class="form-group">
				                <label for="id_servicio"><span class="badge">Servicios</span></label>
				                <select class="form-control" id="id_servicio" name="id_servicio">
				                <option value="" disabled selected>Seleccionar</option>';


				                    $query = "SELECT id, descripcion FROM wm_servicios order by descripcion ASC";
				                    mysqli_select_db($conn,$db_basename);
				                    $res = mysqli_query($conn,$query);

				                    if($res){
				                        while ($valores = mysqli_fetch_array($res)){
				                        	echo '<option value="'.$valores['id'].'" '.($nPago->getIdServicio($row['id_servicio']) == $valores['id'] ? 'selected' : '') .'>'.$valores['descripcion'].'</option>';
				                        }
				                    }

				                    mysqli_close($conn);

						      	echo '</select>
						        </div>

                        <div class="form-group">
                        <label for="fecha_vencimiento"><span class="badge"> Fecha Vencimiento </span></label>
                        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="'.$nPago->getFechaVencimiento($row['fecha_vencimiento']).'">
                        </div>

                        <div class="form-group">
                        <label for="fecha_pago_realizado"><span class="badge"> Fecha Pago Realizado </span></label>
                        <input type="date" class="form-control" id="fecha_pago_realizado" name="fecha_pago_realizado" value="'.$nPago->getFechaPago($row['fecha_pago_realizado']).'">
                        </div>

                        <div class="form-group">
                        <label for="monto_pagar"><span class="badge"> Monto a Pagar </span></label>
                        <input type="text" class="form-control" id="monto_pagar" name="monto_pagar" placeholder="$" value="'.$nPago->getMontoPagar($row['monto_pagar']).'">
                        </div>

                        <div class="form-group">
                        <label for="monto_pagado"><span class="badge"> Monto Pagado </span></label>
                        <input type="text" class="form-control" id="monto_pagado" name="monto_pagado" placeholder="$" value="'.$nPago->getMontoPagado($row['monto_pagado']).'">
                        </div>

                        <button type="submit" class="btn btn-success btn-block" id="update_pago">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
                    </form><hr>

                    <div id="messageUpdatePago" ></div>

                    </div>
                    </div>';

} // END OF FUNCTION


public function formUploadComprobante($id,$conn,$dbname){

    echo '<div class="container">
                    <div class="jumbotron">
                    <h2><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Subir Comprobante</h2><hr>

                    <form id="fr_upload_comprobante_ajax" method="POST">

                        <input type="hidden" id="id" name="id" value="'.$id.'">

                        <div class="form-group">
                        <label for="file"><span class="badge"> Comprobante Pago </span></label>
                        <input type="file" class="form-control" id="my_file" name="my_file">
                        </div>

                        <button type="submit" class="btn btn-success btn-block" id="upload_comprobante">
                            <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Subir</button>
                    </form><hr>

                    <div id="messageUploadComprobante" ></div>

                    </div>
                    </div>';

} // END OF FUNCTION

// PERSISTENCIA

public function addPago($nPago,$user_id,$id_empresa,$id_servicio,$fecha_vencimiento,$fecha_pago_realizado,$monto_pagar,$monto_pagado,$my_file,$conn,$dbname){

    mysqli_select_db($conn,$dbname);
    $sql = "select * from wm_pagos where id_usuario = $nPago->getIdUsuario('$user_id') and id_empresa = $nPago->getIdEmpresa('$id_empresa') and id_servicio = $nPago->getIdServicio('$id_servicio') and fecha_vencimiento = $nPago->getFechaVencimiento('$fecha_vencimiento')";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);

    if($rows == 0){

    if($my_file != ''){

                    			$targetDir = '../../comprobantes/';
								$fileName = $my_file;
								$targetFilePath = $targetDir . $fileName;

								$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

									   // Allow certain file formats
									    $allowTypes = array('pdf');

									    if(in_array($fileType, $allowTypes)){

									       // Upload file to server
									        if(move_uploaded_file($_FILES["my_file"]["tmp_name"], $targetFilePath)){


									        $sql_1 = "INSERT INTO wm_pagos ".
									                "(id_usuario,
									                  id_empresa,
									                  id_servicio,
									                  fecha_vencimiento,
									                  fecha_pago_realizado,
									                  monto_pagar,
                                                      monto_pagado,
                                                      comprobante_pago,
									                  file_path)".
									                "VALUES ".
									                  "($nPago->setIdUsuario('$user_id'),
									            	    $nPago->setIdEmpresa('$id_empresa'),
									            		$nPago->setIdServicio('$id_servicio'),
									            		$nPago->setFechaVencimiento('$fecha_vencimiento'),
									            		$nPago->setFechaPago('$fecha_pago_realizado'),
									            		$nPago->setMontoPagar('$monto_pagar'),
									            		$nPago->setMontoPagado('$monto_pagado'),
									            		$nPago->setComprobantePago('$fileName'),
									            		$nPago->setFilePath('$targetFilePath'))";

									        mysqli_select_db($conn,$dbname);
									        $query_1 = mysqli_query($conn,$sql_1);


									            if($query_1){
                                                        $success = 'Se ha guardado exitosamente registro en tabla wm_pagos';
                                                        $nPago->successMysqlPagos($success);
                                                        echo 1; // sea actualizo la base  y subio bien el archivo
									            }else{
                                                        $error = "Ocurrió un problema al intentar guardar registro en wm_pagos:  ".mysqli_error($conn);
                                                        $nPagos->errorMysqlPagos($error);
                                                        echo -1; // solo se subio el archivo
                                                }
									            }else{
                                                        echo 3; // verificar permisos del directorio
                                                }
									            }else{
                                                        echo 4; // solo archivos pdf
									            }

		                    	}if($my_file == ''){

		                    		$sql_2 = "INSERT INTO wm_pagos ".
									                "(id_usuario,
									                  id_empresa,
									                  id_servicio,
									                  fecha_vencimiento,
									                  fecha_pago_realizado,
									                  monto_pagar,
                                                      monto_pagado)".
									                "VALUES ".
									                  "($nPago->setIdUsuario('$user_id'),
									            	    $nPago->setIdEmpresa('$id_empresa'),
									            		$nPago->setIdServicio('$id_servicio'),
									            		$nPago->setFechaVencimiento('$fecha_vencimiento'),
									            		$nPago->setFechaPago('$fecha_pago_realizado'),
									            		$nPago->setMontoPagar('$monto_pagar'),
									            		$nPago->setMontoPagado('$monto_pagado'))";

									        mysqli_select_db($conn,$dbname);
									        $query_2 = mysqli_query($conn,$sql_2);


									            if($query_2){
												    $success = 'Se ha guardado exitosamente registro en tabla wm_pagos';
                                                    $nPago->successMysqlPagos($success);
                                                    echo 1; // registro insertado correctamente
                                                }else{
                                                    $error = "Ocurrió un problema al intentar guardar registro en wm_pagos:  ".mysqli_error($conn);
                                                    $nPagos->errorMysqlPagos($error);
												   echo -1; // hubo un problema al insertar el registro
                                                }
                                }
    }
    if($rows > 0){
        echo 9; // registro existente
    }
} // END OF FUNCTION


public function updatePago($nPago,$id,$id_empresa,$id_servicio,$fecha_vencimiento,$fecha_pago_realizado,$monto_pagar,$monto_pagado,$conn,$dbname){

        mysqli_select_db($conn,$dbname);
        $sql = "update wm_pagos set id_empresa = $nPago->setIdEmpresa('$id_empresa'), id_servicio = $nPago->setIdServicio('$id_servicio'), fecha_vencimiento = $nPago->setFechaVencimiento('$fecha_vencimiento'), fecha_pago_realizado = $nPago->setFechaPago('$fecha_pago_realizado'), monto_pagar = $nPago->setMontoPagar('$monto_pagar'), monto_pagado = $nPago->setMontoPagado('$monto_pagado') where id = '$id'";
        $query = mysqli_query($conn,$sql);

        if($query){
            $success = 'Se ha guardado exitosamente registro en tabla wm_pagos';
            $nPago->successMysqlPagos($success);
            echo 1; // actualizacion exitosa
        }else{
            $error = "Ocurrió un problema al intentar guardar registro en wm_pagos:  ".mysqli_error($conn);
            $nPagos->errorMysqlPagos($error);
            echo -1; // hubo un error al intentar alctualizar
        }
} // END OF FUNCTION

public function uploadComprobante($nPago,$id,$my_file,$conn,$dbname){


                    			$targetDir = '../../comprobantes/';
								$fileName = $my_file;
								$targetFilePath = $targetDir . $fileName;

								$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

									   // Allow certain file formats
									    $allowTypes = array('pdf');

									    if(in_array($fileType, $allowTypes)){

									       // Upload file to server
									        if(move_uploaded_file($_FILES["my_file"]["tmp_name"], $targetFilePath)){


									        $sql_1 = "update wm_pagos set comprobante_pago = $nPago->setComprobantePago('$fileName'), file_path = $nPago->setFilePath('$targetFilePath') where id = '$id'";

									        mysqli_select_db($conn,$dbname);
									        $query_1 = mysqli_query($conn,$sql_1);


									            if($query_1){
                                                        $success = 'Se ha guardado exitosamente registro en tabla wm_pagos';
                                                        $nPago->successMysqlPagos($success);
                                                        echo 1; // sea actualizo la base  y subio bien el archivo
									            }else{
                                                        $error = "Ocurrió un problema al intentar guardar registro en wm_pagos:  ".mysqli_error($conn);
                                                        $nPagos->errorMysqlPagos($error);
                                                        echo -1; // solo se subio el archivo
                                                }
									            }else{
                                                        echo 3; // verificar permisos del directorio
                                                }
									            }else{
                                                        echo 4; // solo archivos pdf
									            }


} // END OF FUNCTION

public function modalCalcularTotalMensual(){

    echo '<div class="modal fade" id="myModalCalcularTotalMensual" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Calcular Total Mensual</h4>
                    </div>
                    <div class="modal-body">

                            <form action="#" method="POST">
                                <div class="form-group">
                                <label for="fecha_desde">Fecha Desde:</label>
                                <input type="date" class="form-control" id="fecha_desde" name="fecha_desde">
                                </div>
                                <div class="form-group">
                                <label for="fecha_hasta">Fecha Hasta:</label>
                                <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta">
                                </div>
                                <button type="submit" class="btn btn-success" name="calcular_total_mensual" onclick="callCalcularTotalMensual();">
                                    <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Calcular</button>
                            </form>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</button>
                    </div>
                </div>

                </div>
            </div>';

} // END OF FUNCTION

// MENEJO DE  ACTUALIZACION EXITOSA

    public function successMysqlPagos($success){

        $fileName = "pagos_mysql_success.log";
        $date = date("d-m-Y H:i:s");
        $message = 'Success: '.$success.' - '.$date;

        if (file_exists($fileName)){

        $file = fopen($fileName, 'a');
        fwrite($file, "\n".$date);
        fclose($file);
        chmod($file, 0777);

        }else{
            $file = fopen($fileName, 'w');
            fwrite($file, $message);
            fclose($file);
            chmod($file, 0777);
            }
    } // END OF FUNCTION

    // MANEJO DE ERRORES

    public function errorMysqlPagos($error){

        $fileName = "pagos_mysql_error.log";
        $date = date("d-m-Y H:i:s");
        $message = 'Error: '.$error.' - '.$date;

        if (file_exists($fileName)){

        $file = fopen($fileName, 'a');
        fwrite($file, "\n".$date);
        fclose($file);
        chmod($file, 0777);

        }else{
            $file = fopen($fileName, 'w');
            fwrite($file, $message);
            fclose($file);
            chmod($file, 0777);
            }
    } // END OF FUNCTION


} // END OF CLASS

?>
