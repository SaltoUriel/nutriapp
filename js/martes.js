$(document).ready(function() {
    
    $('#tableDietasMartes').DataTable();           
    

    $('#btn-select-dieta').click(function(){        
        $('#showDietaDiaModal').modal('show');     
    });

    $('#btn-select-dieta-edit').click(function(){        
        $('#showDietaDiaModal').modal('show');     
    });

    $('#btn-guardar').click(function(){
        document.getElementById('input-dieta-dia-text').innerHTML = "Seleccionar Dieta";
        document.getElementById('input-dieta-dia-id').value = 0;
        
        document.getElementById('input-dieta-dia-text-edit').innerHTML = "Seleccionar Dieta";
        document.getElementById('input-dieta-dia-id-edit').value = 0;
        
       $('#insertModal').modal('show');
   });


    $('.add-dieta-dia').click(function(){
        var idDieta = $(this).data('iddietadia'); 
        document.getElementById('input-dieta-dia-text').innerHTML = "Dieta seleccionada";
        document.getElementById('input-dieta-dia-id').value = idDieta;
        
        document.getElementById('input-dieta-dia-text-edit').innerHTML = "Dieta seleccionada";
        document.getElementById('input-dieta-dia-id-edit').value = idDieta;
       $("#showDietaDiaModal").modal("hide");
       
    });   

    $('.eliminar').click(function(){
                
         var service = $(this).data('dieta');
            console.log(service);
         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro? podría alterar otros registros.', function(){
                 var dataString = service;
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getMartes.php",
                     data:{ id: dataString, action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarMartes').click(function(){
         var dietaI = document.getElementById("input-dieta-dia-id") .value;        
         var idUsuario = document.getElementById('idUsuario').value;
         
        if(dietaI == null || dietaI.length == 0 ){
            alert("Campos vacios...")
        }else{
             $.ajax({ 
                 type: "POST",
                 url: "../php/getMartes.php",
                 data:{ dieta: dietaI, usuario: idUsuario, action: "insert" },
                 success: function(e) { 
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('martes.php');
                 }
             });
        }
     });
     
     $('.editar').click(function(){
        var idLunes = $(this).data('dietamartes');      
        
        document.getElementById('input-dieta-dia-text-edit').innerHTML = "Seleccionar dieta nueva";
        document.getElementById('input-dieta-dia-id-edit').value = idLunes;
              
        $('#editModal').modal('show');

        $('#btn-editarMartes').click(function(){
            
            var dietaI = document.getElementById("input-dieta-dia-id-edit") .value;
           
            console.log(dietaI);
            $.ajax({ 
                type: "POST",
                url: "../php/getMartes.php",
                data:{id: idLunes, dieta: dietaI, action: "edit" },
                success: function(e) { 
                    $('#insertModal').modal('hide');                    
                    alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                    window.location.replace('martes.php');
                }
            });
           
        });  
        
     });

 });

