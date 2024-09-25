// ESTRUCTURA TABLE
 $(document).ready(function(){
      $('#serviciosTable').DataTable({
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
                messageTop: 'Listado de Servicios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                messageTop: 'Listado de Servicios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'pdf',
                text: 'Export PDF',
                messageTop: 'Listado de Servicios',
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
                messageTop: 'Listado de Servicios',
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
    $('#add_servicio').click(function(){

        const form = document.querySelector('#fr_new_servicio_ajax');

        const descripcion = document.querySelector('#descripcion');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('descripcion', descripcion.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"add_new_servicio.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registro Agregado Exitosamente</p></div>';
                     document.getElementById('messageNewServicio').innerHTML = mensaje;
                     console.log(values);
                     $('#descripcion').val('');
                     setTimeout(function() { window.opener.location.reload(); }, 2000);
                     setTimeout(function() { $(".close").click(); }, 3000);

                     }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar guardar el registro</p></div>';
                        document.getElementById('messageNewServicio').innerHTML = mensaje;
                        console.log(formData);
                        $('#descripcion').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 9){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Registro Existente</p></div>';
                        document.getElementById('messageNewServicio').innerHTML = mensaje;
                        console.log(formData);
                        $('#descripcion').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Debe ingresar tipo de servicio</p></div>';
                        document.getElementById('messageNewServicio').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageNewServicio').innerHTML = mensaje;
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


// GUARDAR SERVICIO
$(document).ready(function(){
    $('#update_servicio').click(function(){

        const form = document.querySelector('#fr_update_servicio_ajax');

        const id = document.querySelector('#id');
        const descripcion = document.querySelector('#descripcion');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('id', id.value);
        formData.append('descripcion', descripcion.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"update_servicio.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registro Actualizado Exitosamente</p></div>';
                     document.getElementById('messageUpdateServicio').innerHTML = mensaje;
                     console.log(values);
                     setTimeout(function() { window.opener.location.reload(); }, 2000);
                     setTimeout(function() { $(".close").click(); }, 3000);
                     setTimeout(function() { window.close(); }, 4000);


                     }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar actualizar el registro</p></div>';
                        document.getElementById('messageUpdateServicio').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 9){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Registro Existente</p></div>';
                        document.getElementById('messageUpdateServicio').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Debe ingresar tipo de servicio</p></div>';
                        document.getElementById('messageUpdateServicio').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageUpdateServicio').innerHTML = mensaje;
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
 function callNewServicio(){
    var ancho = 600;
    var alto = 350;
    var left = (screen.width / 2) - (ancho / 2);
    var top = (screen.height / 2) - (alto / 2);
    let params = `scrollbars=yes,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=${ancho},height=${alto},left=${left},top=${top}`;
    window.open("../lib/servicios/form_new_servicio.php", "new_servicio", params);

}


function callEditServicio(id){
    console.log(id);
    var ancho = 600;
    var alto = 350;
    var left = (screen.width / 2) - (ancho / 2);
    var top = (screen.height / 2) - (alto / 2);
    let params = `scrollbars=yes,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=${ancho},height=${alto},left=${left},top=${top}`;
    window.open("../lib/servicios/form_update_servicio.php?id="+id+"", "edit_servicios", params);

}
