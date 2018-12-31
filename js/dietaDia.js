$(document).ready(function() {
    $('#tableDietasDia').DataTable();           
     

    $('#btn-select-desayuno').click(function(){        
        $('#showDesayunoModal').modal('show');       
    });

    $('#btn-select-almuerzo').click(function(){        
        $('#showAlmuerzoModal').modal('show');       
    });

    $('#btn-select-comida').click(function(){        
        $('#showComidaModal').modal('show');       
    });

    $('#btn-select-colacionUno').click(function(){        
        $('#showColacionModal').modal('show');       
    });

    $('#btn-select-colacionDos').click(function(){        
        $('#showColacionDosModal').modal('show');       
    });

    $('#btn-select-cena').click(function(){        
        $('#showCenaModal').modal('show');       
    });
   
    $('#btn-select-desayuno-edit').click(function(){        
        $('#showDesayunoModal').modal('show');       
    });

    $('#btn-select-almuerzo-edit').click(function(){        
        $('#showAlmuerzoModal').modal('show');       
    });

    $('#btn-select-comida-edit').click(function(){        
        $('#showComidaModal').modal('show');       
    });

    $('#btn-select-colacionUno-edit').click(function(){        
        $('#showColacionModal').modal('show');       
    });

    $('#btn-select-colacionDos-edit').click(function(){        
        $('#showColacionDosModal').modal('show');       
    });

    $('#btn-select-cena-edit').click(function(){        
        $('#showCenaModal').modal('show');       
    });
   
    $('#btn-guardar').click(function(){
        document.getElementById('input-desayuno-text').innerHTML = "Agregar un desayuno";
        document.getElementById('input-desayuno-id').value = 0;
        document.getElementById('input-almuerzo-text').innerHTML = "Agregar almuerzo";
        document.getElementById('input-almuerzo-id').value = 0;
        document.getElementById('input-comida-text').innerHTML = "Agregar comida";
        document.getElementById('input-comida-id').value = 0;
        document.getElementById('input-cena-text').innerHTML = "Agregar cena";
        document.getElementById('input-cena-id').value = 0;
        document.getElementById('input-colacionUno-text').innerHTML = "Agreagr colacion";
        document.getElementById('input-colacionUno-id').value = 0;
        document.getElementById('input-colacionDos-text').innerHTML = "Agregar colacion";
        document.getElementById('input-colacionDos-id').value = 0;
        $('#insertModal').modal("show");
    });


    $('.add-desayuno').click(function(){
        var idDesayuno = $(this).data('iddesayuno');
        var horaDesayuno = $(this).data('hora');
        
        document.getElementById('input-desayuno-text').innerHTML = horaDesayuno;
        document.getElementById('input-desayuno-id').value = idDesayuno;
        document.getElementById('input-desayuno-text-edit').innerHTML = horaDesayuno;
        document.getElementById('input-desayuno-id-edit').value = idDesayuno;
       $("#showDesayunoModal").modal("hide");
       
    });

    $('.add-almuerzo').click(function(){
        var idAlmuerzo = $(this).data('idalmuerzo');
        var horaAlmuerzo = $(this).data('hora');
        
        document.getElementById('input-almuerzo-text').innerHTML = horaAlmuerzo;
        document.getElementById('input-almuerzo-id').value = idAlmuerzo;
        document.getElementById('input-almuerzo-text-edit').innerHTML = horaAlmuerzo;
        document.getElementById('input-almuerzo-id-edit').value = idAlmuerzo;
       $("#showAlmuerzoModal").modal("hide");
       
    });

    $('.add-comida').click(function(){
        var idComida = $(this).data('idcomida');
        var horacomida = $(this).data('hora');
        
        document.getElementById('input-comida-text').innerHTML = horacomida;
        document.getElementById('input-comida-id').value = idComida;
        document.getElementById('input-comida-text-edit').innerHTML = horacomida;
        document.getElementById('input-comida-id-edit').value = idComida;
       $("#showComidaModal").modal("hide");
       
    });
    
    $('.add-cena').click(function(){
        var idCena = $(this).data('idcena');
        var horaCena = $(this).data('hora');
        
        document.getElementById('input-cena-text').innerHTML = horaCena;
        document.getElementById('input-cena-id').value = idCena;
        document.getElementById('input-cena-text-edit').innerHTML = horaCena;
        document.getElementById('input-cena-id-edit').value = idCena;
       $("#showCenaModal").modal("hide");
       
    });

    $(".add-colacion-uno").click(function(){
        var idColacionUno = $(this).data('idcolacionuno');
        var horaColacionUno = $(this).data('hora');
        
        document.getElementById('input-colacionUno-text').innerHTML = horaColacionUno;
        document.getElementById('input-colacionUno-id').value = idColacionUno;
        document.getElementById('input-colacionUno-text-edit').innerHTML = horaColacionUno;
        document.getElementById('input-colacionUno-id-edit').value = idColacionUno;
       $("#showColacionModal").modal("hide");
       
    });

    $(".add-colacion-dos").click(function(){
        var idcolacionDos = $(this).data('idcolaciondos');
        var horaColacion = $(this).data('hora');
        
        document.getElementById('input-colacionDos-text').innerHTML = horaColacion;
        document.getElementById('input-colacionDos-id').value = idcolacionDos;
        document.getElementById('input-colacionDos-text-edit').innerHTML = horaColacion;
        document.getElementById('input-colacionDos-id-edit').value = idcolacionDos;
       $("#showColacionDosModal").modal("hide");
       
    });



    $('.eliminar').click(function(){
                
         var service = $(this).parent().attr('data');
            console.log(service);
         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro? podría alterar otros registros.', function(){
                 var dataString = service;
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getDietaDia.php",
                     data:{ id: dataString, action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarCena').click(function(){
         var desayunoI = document.getElementById("input-desayuno-id") .value;
         var almuerzoI = document.getElementById("input-almuerzo-id").value;
         var colacionUnoI = document.getElementById("input-colacionUno-id").value;
         var comidaI = document.getElementById('input-comida-id').value;
         var colacionDosI = document.getElementById('input-colacionDos-id').value;
         var cenaI = document.getElementById('input-cena-id').value;
         var idUsuario = document.getElementById('idUsuario').value;
         
        if(desayunoI == null || almuerzoI == null || cenaI == null || colacionUnoI.length == 0 || comidaI.length == 0 || colacionDosI.length == 0 ){
            alert("Campos vacios...")
        }else{
             $.ajax({ 
                 type: "POST",
                 url: "../php/getDietaDia.php",
                 data:{ desayuno: desayunoI, almuerzo: almuerzoI, colacionUno: colacionUnoI, comida: comidaI, colacionDos: colacionDosI, cena:cenaI, usuario: idUsuario, action: "insert" },
                 success: function(e) { 
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('dietaDia.php');
                 }
             });
        }
     });
     
     $('.editar').click(function(){
        var desayuno = $(this).data('iddesayuno');
        var horaDesayuno = $(this).data('horadesayuno');
        var almuerzo = $(this).data('idalmuerzo');
        var horaAlmuerzo = $(this).data('horaalmuerzo');
        var colacionUno = $(this).data('idcolacionuno');
        var horaColacionUno = $(this).data('horacolacionuno');
        var comida = $(this).data('idcomida');
        var horaComida = $(this).data('horacomida');
        var colacionDos = $(this).data('idcolaciondos');
        var horaColacionDos = $(this).data('horacolaciondos');
        var cena = $(this).data('idcena');
        var horaCena = $(this).data('horacena');
        var dietaDia = $(this).data('dietadia');
        

        document.getElementById('input-desayuno-text-edit').innerHTML = horaDesayuno;
        document.getElementById('input-desayuno-id-edit').value = desayuno;

        document.getElementById('input-almuerzo-text-edit').innerHTML = horaAlmuerzo;
        document.getElementById('input-almuerzo-id-edit').value = almuerzo;

        document.getElementById('input-colacionUno-text-edit').innerHTML = horaColacionUno;
        document.getElementById('input-colacionUno-id-edit').value =  colacionUno;

        document.getElementById('input-comida-text-edit').innerHTML = horaComida;
        document.getElementById('input-comida-id-edit').value =  comida;

        document.getElementById('input-colacionDos-text-edit').innerHTML = horaColacionDos;
        document.getElementById('input-colacionDos-id-edit').value =  colacionDos;

        document.getElementById('input-cena-text-edit').innerHTML = horaCena;
        document.getElementById('input-cena-id-edit').value =  cena;

        
        $('#editModal').modal('show');

        $('#btn-editarDietaDia').click(function(){
            
            var desayunoI = document.getElementById("input-desayuno-id-edit") .value;
            var almuerzoI = document.getElementById("input-almuerzo-id-edit").value;
            var colacionUnoI = document.getElementById("input-colacionUno-id-edit").value;
            var comidaI = document.getElementById('input-comida-id-edit').value;
            var colacionDosI = document.getElementById('input-colacionDos-id-edit').value;
            var cenaI = document.getElementById('input-cena-id-edit').value;
            
            $.ajax({ 
                type: "POST",
                url: "../php/getDietaDia.php",
                data:{id: dietaDia, desayuno: desayunoI, almuerzo: almuerzoI, colacionUno: colacionUnoI, comida: comidaI, colacionDos: colacionDosI, cena:cenaI, action: "edit" },
                success: function(e) { 
                    $('#insertModal').modal('hide');
                    alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                    window.location.replace('dietaDia.php');
                }
            });
           
        });  
        
     });

 });

