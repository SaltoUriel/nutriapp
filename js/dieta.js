$(document).ready(function() {
    $('#tableTipoDieta').DataTable();         
      
    $('.eliminar').click(function(){
         var dieta = $(this).data('dieta');
       
         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro?', function(){                 
             
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getTipoDieta.php",
                     data:{ id: dieta, action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                    }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarDieta').click(function(){
         
         var nombreI = document.getElementById("recipient-nombre").value;
         var semanasI = document.getElementById('recipient-semanas').value;
         
             $.ajax({ 
                 type: "POST",
                 url: "../php/getTipoDieta.php",
                 data:{ nombre: nombreI, semanas: semanasI, action: "insert" },
                 success: function(e) { 
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim()+' se agrego al catálogo de frutas', 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('dieta.php');
                     
                 }
             });
     });

     $('.editar').click(function(){
         var dieta = $(this).data('iddieta');

         var nombre = $(this).data('nombre');
         var semanas = $(this).data('semanas');
          
         $('#recipient-nombre-edit').val(nombre);
         $('#recipient-semanas-edit').val(semanas);
                        
         $('#editModal').modal('show');

         $('#btn-editarDieta').click(function(){
            
            var nombreI = document.getElementById("recipient-nombre-edit").value;
            var semanasI = document.getElementById('recipient-semanas-edit').value;
             
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getTipoDieta.php",
                     data:{ id: dieta, nombre: nombreI, semanas: semanasI, action: "edit" },
                     success: function(e) {                          
                         $('#editModal').modal('hide');
                         alertify.notify(e.trim()+' se actualizó al catálogo de frutas', 'success', 10, function(){  console.log('dismissed'); });
                         window.location.replace('dieta.php');                         
                     }
                 });
         });
         
     });
 } );