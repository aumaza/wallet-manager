<?php session_start();
            include "../../../connection/connection.php";
            include "lib_pagos.php";

            if($conn){

                // se crea el objeto
                $nPago = new Pagos();

                // se capturan los datos
                $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
                $id_empresa = mysqli_real_escape_string($conn,$_POST['id_empresa']);
                $id_servicio = mysqli_real_escape_string($conn,$_POST['id_servicio']);
                $fecha_vencimiento = mysqli_real_escape_string($conn,$_POST['fecha_vencimiento']);
                $fecha_pago_realizado = mysqli_real_escape_string($conn,$_POST['fecha_pago_realizado']);
                $monto_pagar = mysqli_real_escape_string($conn,$_POST['monto_pagar']);
                $monto_pagado = mysqli_real_escape_string($conn,$_POST['monto_pagado']);
                $my_file = basename($_FILES["my_file"]["name"]);

                if(($user_id == '') ||
                        ($id_empresa == '') ||
                            ($id_servicio == '') ||
                                ($fecha_vencimiento == '') ||
                                    ($fecha_pago_realizado == '') ||
                                        ($monto_pagar == '') ||
                                            ($monto_pagado == '')){
                                            echo 5; // hay campos sin completar
                }else{
                    $nPago->addPago($nPago,$user_id,$id_empresa,$id_servicio,$fecha_vencimiento,$fecha_pago_realizado,$monto_pagar,$monto_pagado,$my_file,$conn,$dbname);
                }
            }else{
                echo 7; // sin conexion
            }


?>
