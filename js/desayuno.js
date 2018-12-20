$(document).ready(function() {
    $('#tableDesayunos').DataTable();         
      
    $('.eliminar').click(function(){
         var parent = $(this).parent().attr('id');
       
         var service = $(this).parent().attr('data');

         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro?', function(){
                 var dataString = service;
             
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getDesayuno.php",
                     data:{ id: dataString, action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarDesayuno').click(function(){
         
         var alimentoI = document.getElementById("recipient-name").value;
         var descripcionI = document.getElementById('recipient-rescripcion').value;
         var horaI = document.getElementById('recipient-hora').value;
         var idUsuario = document.getElementById('idUsuario').value;
         console.log("dentro");
             $.ajax({ 
                 type: "POST",
                 url: "../php/getDesayuno.php",
                 data:{ alimento: alimentoI, descripcion: descripcionI, hora: horaI, usuario:idUsuario, action: "insert" },
                 success: function(e) { 
                     $("#"+e.trim()).remove();
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim()+' se agrego al catálogo de cereales', 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('desayuno.php');
                     
                 }
             });
     });

     $('.editar').click(function(){
        
        var alimentoI = $(this).parent().attr('tipoDesayuno');
        var idI = $(this).parent().attr('id');
        var descripcionI = $(this).parent().attr('descripcion');
        var horaI = $(this).parent().attr('hora');
                 
         $('#recipient-name-edit').val(alimentoI);
         $('#recipient-porcion-edit').val(descripcionI);
         $('#recipient-hora-edit').val(horaI);
                        
         $('#editModal').modal('show');

         $('#btn-editarDesayuno').click(function(){
            
            var alimentoI = document.getElementById("recipient-name-edit").value;
            var descripcionI = document.getElementById('recipient-porcion-edit').value;
            var horaI = document.getElementById('recipient-hora-edit').value;
             
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getDesayuno.php",
                     data:{ id: idI, alimento: alimentoI, descripcion: descripcionI, hora: horaI, action: "edit" },
                     success: function(e) { 
                         
                         $('#editModal').modal('hide');
                         alertify.notify(e.trim()+' se actualizó al catálogo de cereales', 'success', 10, function(){  console.log('dismissed'); });
                         window.location.replace('desayuno.php');
                         
                     }
                 });
         });
         
     });
 } );