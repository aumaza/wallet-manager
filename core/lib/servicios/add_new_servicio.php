<?php session_start();
            include "../../../connection/connection.php";
            include "lib_servicios.php";

            if($conn){

                // creamos el objeto
                $nServicio = new Servicios();
                $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);

                if($descripcion == ''){
                    echo 5; // hay campos sin completar
                }else{
                    $nServicio->addServicio($nServicio,$descripcion,$conn,$dbname);
                }

            }else{
                echo 7; // sin conexion
            }



?>
