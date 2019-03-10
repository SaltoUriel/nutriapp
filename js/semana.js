$(document).ready(function() {
    $('#tableDietaSemana').DataTable();           
     

    $('#btn-select-lunes').click(function(){        
        $('#showLunesModal').modal('show');       
    });

    $('#btn-select-martes').click(function(){        
        $('#showMartesModal').modal('show');       
    });

    $('#btn-select-miercoles').click(function(){        
        $('#showMiercolesModal').modal('show');       
    });

    $('#btn-select-jueves').click(function(){        
        $('#showJuevesModal').modal('show');       
    });

    $('#btn-select-viernes').click(function(){        
        $('#showViernesModal').modal('show');       
    });

    $('#btn-select-sabado').click(function(){        
        $('#showSabadoModal').modal('show');       
    });
   
    $('#btn-select-domingo').click(function(){        
        $('#showDomingoModal').modal('show');       
    });

    $('#btn-select-tipo-dieta').click(function(){        
        $('#showTipoDietaModal').modal('show');       
    });


    $('#btn-select-lunes-edit').click(function(){        
        $('#showLunesModal').modal('show');       
    });

    $('#btn-select-martes-edit').click(function(){        
        $('#showMartesModal').modal('show');       
    });

    $('#btn-select-miercoles-edit').click(function(){        
        $('#showMiercolesModal').modal('show');       
    });

    $('#btn-select-jueves-edit').click(function(){        
        $('#showJuevesModal').modal('show');       
    });

    $('#btn-select-viernes-edit').click(function(){        
        $('#showViernesModal').modal('show');       
    });

    $('#btn-select-sabado-edit').click(function(){        
        $('#showSabadoModal').modal('show');       
    });
    $('#btn-select-domingo-edit').click(function(){        
        $('#showDomingoModal').modal('show');       
    });
    $('#btn-select-tipo-dieta-edit').click(function(){        
        $('#showTipoDietaModal').modal('show');       
    });
   
    $('#btn-guardar').click(function(){
        document.getElementById('input-lunes-text').innerHTML = "Agregar un dieta del lunes";
        document.getElementById('input-lunes-id').value = 0;
        document.getElementById('input-martes-text').innerHTML = "Agregar un dieta del martes";
        document.getElementById('input-martes-id').value = 0;
        document.getElementById('input-miercoles-text').innerHTML = "Agregar un dieta del miercoles";
        document.getElementById('input-miercoles-id').value = 0;      
        document.getElementById('input-jueves-text').innerHTML = "Agregar un dieta del jueves";
        document.getElementById('input-jueves-id').value = 0;
        document.getElementById('input-viernes-text').innerHTML = "Agregar un dieta del viernes";
        document.getElementById('input-viernes-id').value = 0;
        document.getElementById('input-sabado-text').innerHTML = "Agregar un dieta del sabado";
        document.getElementById('input-sabado-id').value = 0;
        document.getElementById('input-domingo-text').innerHTML = "Agregar un dieta del domingo";
        document.getElementById('input-domingo-id').value = 0;
        document.getElementById('input-tipo-dieta-text').innerHTML = "Seleccionar tipo de dieta";
        document.getElementById('input-tipo-dieta-id').value = 0;
        $('#insertModal').modal("show");
    });


    $('.add-dieta-lunes').click(function(){
        var idLunes = $(this).data('idlunes');
        
        document.getElementById('input-lunes-text').innerHTML = "Dieta seleccionada";
        document.getElementById('input-lunes-id').value = idLunes;
        document.getElementById('input-lunes-text-edit').innerHTML = "Dieta seleccionada";
        document.getElementById('input-lunes-id-edit').value = idLunes;
       $("#showLunesModal").modal("hide");
       
    });

    $('.add-dieta-martes').click(function(){
        var idMartes = $(this).data('idmartes');
        
        document.getElementById('input-martes-text').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-martes-id').value = idMartes;
        document.getElementById('input-martes-text-edit').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-martes-id-edit').value = idMartes;
       $("#showMartesModal").modal("hide");
       
    });

    $('.add-dieta-miercoles').click(function(){
        var idMiercoles = $(this).data('idmiercoles');
        
        document.getElementById('input-miercoles-text').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-miercoles-id').value = idMiercoles;
        document.getElementById('input-miercoles-text-edit').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-miercoles-id-edit').value = idMiercoles;
       $("#showMiercolesModal").modal("hide");
       
    });
    
    $('.add-dieta-jueves').click(function(){
        var idJueves= $(this).data('idjueves');
        
        document.getElementById('input-jueves-text').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-jueves-id').value = idJueves;
        document.getElementById('input-jueves-text-edit').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-jueves-id-edit').value = idJueves;
       $("#showJuevesModal").modal("hide");
       
    });

    $(".add-dieta-viernes").click(function(){
        var idViernes = $(this).data('idviernes');      
        
        document.getElementById('input-viernes-text').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-viernes-id').value = idViernes;
        document.getElementById('input-viernes-text-edit').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-viernes-id-edit').value = idViernes;
       $("#showViernesModal").modal("hide");
       
    });

    $(".add-dieta-sabado").click(function(){
        var idSabado = $(this).data('idsabado');
                
        document.getElementById('input-sabado-text').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-sabado-id').value = idSabado;
        document.getElementById('input-sabado-text-edit').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-sabado-id-edit').value = idSabado;
       $("#showSabadoModal").modal("hide");
       
    });

    $(".add-dieta-domingo").click(function(){
        var idDomingo = $(this).data('iddomingo');
                
        document.getElementById('input-domingo-text').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-domingo-id').value = idDomingo;
        document.getElementById('input-domingo-text-edit').innerHTML = "Dieta Seleccionada";
        document.getElementById('input-domingo-id-edit').value = idDomingo;
       $("#showDomingoModal").modal("hide");
       
    });


    $(".add-dieta-tipo-dieta").click(function(){
        var idTipoDieta = $(this).data('iddieta');
        var nombreDieta = $(this).data('nombre');
        document.getElementById('input-tipo-dieta-text').innerHTML = nombreDieta;
        document.getElementById('input-tipo-dieta-id').value = idTipoDieta;
        
       $("#showTipoDietaModal").modal("hide");
       
    });

    $('.eliminar').click(function(){
                
         var semana = $(this).data('semana');
        
         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro? podría alterar otros registros.', function(){
                 
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getSemana.php",
                     data:{ id: semana, action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarSemana').click(function(){
         var lunesI = document.getElementById("input-lunes-id") .value;
         var martesI = document.getElementById("input-martes-id").value;
         var miercolesI = document.getElementById("input-miercoles-id").value;
         var juevesI = document.getElementById('input-jueves-id').value;
         var viernesI = document.getElementById('input-viernes-id').value;
         var sabadoI = document.getElementById('input-sabado-id').value;
         var domingoI = document.getElementById('input-domingo-id').value;
         var tipoDietaI = document.getElementById('input-tipo-dieta-id').value;
         var idUsuario = document.getElementById('idUsuario').value;
         
         var gif = "<i class='fas fa-sync fa-spin'></i>";

        if(domingoI == null || tipoDietaI == null || lunesI == null || martesI == null || miercolesI == null || juevesI.length == 0 || viernesI.length == 0 || sabadoI.length == 0 ){
            alert("Campos vacios...")
        }else{
             $.ajax({ 
                 type: "POST",
                 url: "../php/getSemana.php",
                 data:{ lunes: lunesI, martes: martesI, miercoles: miercolesI, jueves: juevesI, viernes: viernesI, sabado:sabadoI, domingo:domingoI, dieta: tipoDietaI, usuario: idUsuario, action: "insert" },
                 beforeSend: function(){
                    $("#btn-guardarSemana").text("");
                    $("#btn-guardarSemana").append(gif);
                  },
                 success: function(e) { 
                     alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('semana.php');
                 }
             });
        }
     });
     
     $('.editar').click(function(){

        var usuarioSesion = document.getElementById('idUsuario').value;
        var usuarioCreador = $(this).data('idusuario');
        if(usuarioSesion == usuarioCreador){
           
            var lunes = $(this).data('lunes');
            var martes = $(this).data('martes');
            var miercoles = $(this).data('miercoles');
            var jueves = $(this).data('jueves');
            var viernes = $(this).data('viernes');
            var sabado = $(this).data('sabado');
            var domingo = $(this).data('domingo');
            var semana = $(this).data('semana');
            
            

            document.getElementById('input-lunes-text-edit').innerHTML = "Seleccionar Nueva Dieta para el Lunes";
            document.getElementById('input-lunes-id-edit').value = lunes;

            document.getElementById('input-martes-text-edit').innerHTML = "Seleccionar Nueva Dieta para el Martes";
            document.getElementById('input-martes-id-edit').value = martes;

            document.getElementById('input-miercoles-text-edit').innerHTML = "Seleccionar Nueva Dieta para el Miercoles";
            document.getElementById('input-miercoles-id-edit').value =  miercoles;

            document.getElementById('input-jueves-text-edit').innerHTML = "Seleccionar Nueva Dieta para el Jueves";
            document.getElementById('input-jueves-id-edit').value =  jueves;

            document.getElementById('input-viernes-text-edit').innerHTML = "Seleccionar Nueva Dieta para el Viernes";
            document.getElementById('input-viernes-id-edit').value =  viernes;

            document.getElementById('input-sabado-text-edit').innerHTML = "Seleccionar Nueva Dieta para el Sábado";
            document.getElementById('input-sabado-id-edit').value =  sabado;

            document.getElementById('input-domingo-text-edit').innerHTML = "Seleccionar Nueva Dieta para el Domingo";
            document.getElementById('input-domingo-id-edit').value =  domingo;
            
            
            $('#editModal').modal('show');

            $('#btn-editarSemana').click(function(){
                
                var lunesI = document.getElementById("input-lunes-id-edit") .value;
                var martesI = document.getElementById("input-martes-id-edit").value;
                var miercolesI = document.getElementById("input-miercoles-id-edit").value;
                var juevesI = document.getElementById('input-jueves-id-edit').value;
                var viernesI = document.getElementById('input-viernes-id-edit').value;
                var sabadoI = document.getElementById('input-sabado-id-edit').value;
                var domingoI = document.getElementById('input-domingo-id-edit').value;
                
                $.ajax({ 
                    type: "POST",
                    url: "../php/getSemana.php",
                    data:{id: semana, lunes: lunesI, martes: martesI, miercoles: miercolesI, jueves: juevesI, viernes: viernesI, sabado:sabadoI, domingo: domingoI, action: "edit" },
                    success: function(e) { 
                        $('#editModal').modal('hide');
                        alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                        window.location.replace('semana.php');
                    }
                });
            
            });  
        }else{
            alert("No tienes permisos para editar este registro.");
        }

        
        
     });

 });

