<?php session_start();
            include "../../../connection/connection.php";
            include "lib_pagos.php";

            if($conn){

                // se crea el objeto
                $nPago = new Pagos();

                // se capturan los datos
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                $my_file = basename($_FILES["my_file"]["name"]);

                if(($id == '') || ($my_file == '')){
                        echo 5; // hay campos sin completar
                }else{
                    $nPago->uploadComprobante($nPago,$id,$my_file,$conn,$dbname);
                }
            }else{
                echo 7; // sin conexion
            }


?>
