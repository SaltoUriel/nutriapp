$(document).ready(function() {
    $('#tableColaciones').DataTable();         
      
    $('.eliminar').click(function(){
           
         var service = $(this).parent().attr('data');

         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro?', function(){
                 var dataString = service;
             
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getColacionDos.php",
                     data:{ id: dataString, action: "delete" },
                     success: function(e) { 
                         
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarColacion').click(function(){
         
         var horaI = document.getElementById('recipient-hora').value;
         var frutaI = document.getElementById('recipient-fruta').value;
         var idUsuario = document.getElementById('idUsuario').value;
         console.log(horaI);
             $.ajax({ 
                 type: "POST",
                 url: "../php/getColacionDos.php",
                 data:{ hora: horaI, fruta: frutaI, usuario:idUsuario, action: "insert" },
                 success: function(e) { 
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim()+' se agrego al catálogo de cereales', 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('colacionDos.php');
                     
                 }
             });
     });

     $('.editar').click(function(){
        
         var horaI = $(this).data('horacolacion');
         var frutaI = $(this).data('fruta');
         var idI = $(this).data('idcolacion');
            console.log(frutaI);
            console.log(horaI);
         document.getElementById("recipient-hora-editar").value = horaI;

         var selectFruta = document.getElementById("recipient-fruta-editar");
         for(var index = 0; index<selectFruta.length; index++){
             if(selectFruta[index].value == frutaI){
                selectFruta.selectedIndex = index;
             }
         }
         $('#editModal').modal('show');

         $('#btn-editarColacion').click(function(){
            
             var horaI = document.getElementById('recipient-hora-editar').value;
             var frutaI = document.getElementById("recipient-fruta-editar").value;
                         
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getColacionDos.php",
                     data:{ id: idI, hora: horaI, fruta:frutaI, action: "edit" },
                     success: function(e) {
                         $('#editModal').modal('hide');
                         alertify.notify(e.trim()+' se actualizó al catálogo de cereales', 'success', 10, function(){  console.log('dismissed'); });
                         window.location.replace('colacionDos.php');
                         
                     }
                 });
         });
         
     });
 } );