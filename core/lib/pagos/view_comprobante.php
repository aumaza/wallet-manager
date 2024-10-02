<?php session_start();
            include "../../../connection/connection.php";

            if($conn){

                $id = $_GET['id'];
                // realizamos la consulta
                mysqli_select_db($conn,$dbname);
                $sql = "select comprobante_pago, file_path from wm_pagos where id = '$id'";
                $query = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($query);
                $archivo = $row['comprobante_pago'];
                $path = $row['file_path'];

                        if(is_file($path)){

                            header('Content-Type: application/force-download');
                            header('Content-Disposition: attachment; filename='.$archivo);
                            header('Content-Transfer-Encoding: binary');
                            header('Content-Length: '.filesize($path));
                            readfile($path);

                        }


            }else{
                echo "Sin conexion a la base de datos";
            }



?>
