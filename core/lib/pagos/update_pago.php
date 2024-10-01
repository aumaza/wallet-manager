<?php session_start();
            include "../../../connection/connection.php";
            include "lib_pagos.php";

            if($conn){

                // se crea el objeto
                $nPago = new Pagos();

                // se capturan los datos
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                $id_empresa = mysqli_real_escape_string($conn,$_POST['id_empresa']);
                $id_servicio = mysqli_real_escape_string($conn,$_POST['id_servicio']);
                $fecha_vencimiento = mysqli_real_escape_string($conn,$_POST['fecha_vencimiento']);
                $fecha_pago_realizado = mysqli_real_escape_string($conn,$_POST['fecha_pago_realizado']);
                $monto_pagar = mysqli_real_escape_string($conn,$_POST['monto_pagar']);
                $monto_pagado = mysqli_real_escape_string($conn,$_POST['monto_pagado']);

                if(($id_empresa == '') ||
                            ($id_servicio == '') ||
                                ($fecha_vencimiento == '') ||
                                    ($fecha_pago_realizado == '') ||
                                        ($monto_pagar == '') ||
                                            ($monto_pagado == '')){
                                            echo 5; // hay campos sin completar
                }else{
                    $nPago->updatePago($nPago,$id,$id_empresa,$id_servicio,$fecha_vencimiento,$fecha_pago_realizado,$monto_pagar,$monto_pagado,$conn,$dbname);
                }
            }else{
                echo 7; // sin conexion
            }


?>
