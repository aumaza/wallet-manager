<?php

class Servicios{

    // PROPIEDADES
    private $descripcion = '';

    // CONSTRUCTOR DESPARAMETRIZADO
    function __construct(){
        $this->descripcion = '';
    }

    // SETTERS
    private function setDescripcion($var){
        $this->descripcion = $var;
    }

    // GETTERS
    private function getDescripcion($var){
        return $this->descripcion = $var;
    }

    // METODOS
public function listServicios($nServicio,$conn,$dbname){

        if($conn){

                $sql = "SELECT * FROM wm_servicios";
                mysqli_select_db($conn,$dbase);
                $resultado = mysqli_query($conn,$sql);

                //mostramos fila x fila
                $count = 0;
                echo '<div class="container-fluid">
                            <div class="jumbotron">
                            <h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Servicios [ Listado ]</h2><hr>
                            <button type="button" class="btn btn-primary" id="new_servicio" onclick="callNewServicio();">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Servicio</button><hr>';


                echo "<table class='display compact' style='width:100%' id='serviciosTable'>";


                echo "<thead>
                                <th class='text-nowrap text-center'><span class='label label-default'>Tipo Servicio</span></th>
                                <th class='text-nowrap text-center'><span class='label label-warning'>Acciones</span></th>
                            </thead>";


                while($fila = mysqli_fetch_array($resultado)){
                        // Listado normal
                        echo "<tr>";
                        echo "<td align=center>".$nServicio->getDescripcion($fila['descripcion'])."</td>";
                        echo '<td class="text-nowrap" align=center>
                                        <button type="button" class="btn btn-warning" value="'.$fila['id'].'"  onclick="callEditServicio(this.value);">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
                                    </td>';
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


    // FORMULARIOS
    public function formNewServicio(){

        echo '<div class="container">
                        <div class="jumbotron">
                        <h2><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Servicio</h2><hr>

                        <form id="fr_new_servicio_ajax" method="POST">

                            <div class="form-group">
                            <label for="descripcion">Tipo de Servicio:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                            </div>

                            <button type="submit" class="btn btn-primary" id="add_servicio">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>

                        </form>

                        <div id="messageNewServicio"></div>

                        </div>
                        </div>';

    } // END OF FUNCTION

    // FORMULARIOS
    public function formEditServicio($nServicio,$id,$conn,$dbname){

        mysqli_select_db($conn,$dbname);
        $sql = "select * from wm_servicios where id = '$id'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);

        echo '<div class="container">
                        <div class="jumbotron">
                        <h2><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar Servicio</h2><hr>

                        <form id="fr_update_servicio_ajax" method="POST">

                            <input type="hidden" id="id" name="id" value="'.$id.'">

                            <div class="form-group">
                            <label for="descripcion">Tipo de Servicio:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="'.$nServicio->getDescripcion($row['descripcion']).'">
                            </div>

                            <button type="submit" class="btn btn-primary" id="update_servicio">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>

                        </form>

                        <div id="messageUpdateServicio"></div>

                        </div>
                        </div>';

    } // END OF FUNCTION

    // PERSISTENCIA
    public function addServicio($nServicio,$descripcion,$conn,$dbname){

        mysqli_select_db($conn,$dbanme);
        $sql = "select * from wm_servicios where descripcion = $nServicio->getDescripcion('$descripcion')";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($query);

        if($rows <= 0){

            $sql_1 = "insert into wm_servicios ".
                             "(descripcion) ".
                             "VALUES ".
                             "($nServicio->setDescripcion('$descripcion'))";

            $query_1 = mysqli_query($conn,$sql_1);

            if($query_1){
                $success = "se ha guardado registro con exito en la tabla wm_servicios!";
                $nServicio->successMysqlServicios($success);
                echo 1; // registro guardado exitosamente
            }else{
                $error = "Se ha producido un error al intentar guardar el registro en la tabla wm_servicios ".mysqli_error($conn);
                $nServicio->errorMysqlServicios($error);
                echo -1; // hubo un problema al intentar guardar el registro
            }
        }
        if($rows > 0){
            echo 9; // registro existente
        }
} // END OF FUNCTION


public function updateServicio($nServicio,$id,$descripcion,$conn,$dbname){

        mysqli_select_db($conn,$dbanme);
        $sql = "select * from wm_servicios where descripcion = $nServicio->getDescripcion('$descripcion')";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($query);

        if($rows <= 0){

            $sql_1 = "update wm_servicios set descripcion = $nServicio->setDescripcion('$descripcion') where id = '$id'";

            $query_1 = mysqli_query($conn,$sql_1);

            if($query_1){
                $success = "se ha guardado registro con exito en la tabla wm_servicios!";
                $nServicio->successMysqlServicios($success);
                echo 1; // registro guardado exitosamente
            }else{
                $error = "Se ha producido un error al intentar guardar el registro en la tabla wm_servicios ".mysqli_error($conn);
                $nServicio->errorMysqlServicios($error);
                echo -1; // hubo un problema al intentar guardar el registro
            }
        }
        if($rows > 0){
            echo 9; // registro existente
        }
} // END OF FUNCTION

// MANEJO DE  ACTUALIZACION EXITOSA

    public function successMysqlServicios($success){

        $fileName = "servicios_mysql_success.log";
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
    }

    // MANEJO DE ERRORES

    public function errorMysqlServicios($error){

        $fileName = "servicios_mysql_error.log";
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
