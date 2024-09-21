<?php session_start();

            include "../../../connection/connection.php";
            include "lib_empresas.php";

            if($conn){

                $nEmpresa = new Empresas();

                $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);

                if($descripcion == ''){
                    echo 5; // debe competar el campo
                }else{
                    $nEmpresa->addEmpresa($nEmpresa,$descripcion,$conn,$dbname);
                }

            }else{
                echo 7; // sin conexion a la base de datos
            }




?>
