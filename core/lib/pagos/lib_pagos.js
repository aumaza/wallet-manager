// ESTRUCTURA TABLE
 $(document).ready(function(){
      $('#pagosTable').DataTable({
        "order": [[0, "asc"]],
        "responsive":     true,
        "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "deferRender": true,
        "dom":  "Bfrtip",
        buttons: [
            {
                extend: 'excel',
                text: 'Export Excel',
                messageTop: 'Listado de Pagos',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                messageTop: 'Listado de Pagos',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'pdf',
                text: 'Export PDF',
                messageTop: 'Listado de Pagos',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'print',
                text: 'Imprimir',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '8pt' );


                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
                messageTop: 'Listado de Pagos',
                autoPrint: false,
                exportOptions: {
                    columns: ':visible',
                }

            },
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "fixedColumns": true,
      "language":{
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrada de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search": "Buscar:",
        "zeroRecords":    "No se encontraron registros coincidentes",
        "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });
});

// GUARDAR SERVICIO
$(document).ready(function(){
    $('#add_pago').click(function(){

        const form = document.querySelector('#fr_add_pago_ajax');

        const user_id = document.querySelector('#user_id');
        const id_empresa = document.querySelector('#id_empresa');
        const id_servicio = document.querySelector('#id_servicio');
        const fecha_vencimiento = document.querySelector('#fecha_vencimiento');
        const fecha_pago_realizado = document.querySelector('#fecha_pago_realizado');
        const monto_pagar = document.querySelector('#monto_pagar');
        const monto_pagado = document.querySelector('#monto_pagado');
        const my_file = document.querySelector('#my_file');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('user_id', user_id.value);
        formData.append('id_empresa', id_empresa.value);
        formData.append('id_servicio', id_servicio.value);
        formData.append('fecha_vencimiento', fecha_vencimiento.value);
        formData.append('fecha_pago_realizado', fecha_pago_realizado.value);
        formData.append('monto_pagar', monto_pagar.value);
        formData.append('monto_pagado', monto_pagado.value);
        formData.append('my_file', my_file.value[0]);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"add_new_pago.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registro Agregado Exitosamente</p></div>';
                     document.getElementById('messageNewPago').innerHTML = mensaje;
                     console.log(values);
                     $('#empresa_id').val('');
                     $('#servicio_id').val('');
                     $('#fecha_vencimiento').val('');
                     $('#fecha_pago_realizado').val('');
                     $('#monto_pagar').val('');
                     $('#monto_pagado').val('');
                     $('#my_file').val('');
                     setTimeout(function() { window.opener.location.reload(); }, 2000);
                     setTimeout(function() { $(".close").click(); }, 3000);

                     }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar guardar el registro</p></div>';
                        document.getElementById('messageNewPago').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);

                    }else if(r == 9){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Registro Existente</p></div>';
                        document.getElementById('messageNewPago').innerHTML = mensaje;
                        console.log(formData);
                        $('#id_empresa').val('');
                        $('#id_servicio').val('');
                        $('#fecha_vencimiento').val('');
                        $('#fecha_pago_realizado').val('');
                        $('#monto_pagar').val('');
                        $('#monto_pagado').val('');
                        $('#my_file').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);

                    }else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Hay campos sin completar</p></div>';
                        document.getElementById('messageNewPago').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 3){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Verifique los permisos del directorio!</p></div>';
                        document.getElementById('messageNewPago').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 4){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sólo se permiten archivos PDF</p></div>';
                        document.getElementById('messageNewPago').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageNewPago').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }

                    else if(r == ''){
                        //console.log(formData);
                    }
            },

        });

        return false;
    });
});


 // CALLERS
 function callNewPago(){
    var ancho = 800;
    var alto = 800;
    var left = (screen.width / 2) - (ancho / 2);
    var top = (screen.height / 2) - (alto / 2);
    let params = `scrollbars=yes,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=${ancho},height=${alto},left=${left},top=${top}`;
    window.open("../lib/pagos/form_new_pago.php", "new_pago", params);

}


function callEditPago(id){
    console.log(id);
    var ancho = 800;
    var alto = 600;
    var left = (screen.width / 2) - (ancho / 2);
    var top = (screen.height / 2) - (alto / 2);
    let params = `scrollbars=yes,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=${ancho},height=${alto},left=${left},top=${top}`;
    window.open("../lib/pagos/form_update_pago.php?id="+id+"", "edit_pago", params);

}
