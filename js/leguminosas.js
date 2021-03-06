$(document).ready(function() {
    $('#tableLeguminosas').DataTable();         
      
    $('.eliminar').click(function(){
         var parent = $(this).parent().attr('id');
       
         var service = $(this).parent().attr('data');

         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro?', function(){
                 var dataString = service;
             
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getCrud.php",
                     data:{ id: dataString, nombreTabla: "leguminosa", action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarLeguminosa').click(function(){
         
         var nombreI = document.getElementById("recipient-name").value;
         var porcionI = document.getElementById('recipient-porcion').value;
         
         if(nombreI == null || porcionI == null || nombreI.length == 0 || porcionI.length == 0 || /^\s+$/.test(nombreI) || /^\s+$/.test(nombreI) ){
            alert("Campos vacios...")
        }else{
             $.ajax({ 
                 type: "POST",
                 url: "../php/getCrud.php",
                 data:{ nombre: nombreI, porcion: porcionI, nombreTabla: "leguminosa", action: "insert" },
                 success: function(e) { 
                     $("#"+e.trim()).remove();
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim()+' se agrego al catálogo de frutas', 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('leguminosas.php');
                     
                 }
             });
        }
     });

     $('.editar').click(function(){
        
        var idI = $(this).parent().attr('data');
        
         var nombreId = "N"+idI;
         var porcionId = "P"+idI;
         var nombreI = document.getElementById(nombreId).innerText;
         var porcionI = document.getElementById(porcionId).innerText;
          
         $('#recipient-nameEdit').val(nombreI);
         $('#recipient-porcionEdit').val(porcionI);
                        
         $('#editModal').modal('show');

         $('#btn-editarLeguminosa').click(function(){
            
            var nombreI = document.getElementById("recipient-nameEdit").value;
            var porcionI = document.getElementById('recipient-porcionEdit').value;
            
            $.ajax({ 
                type: "POST",
                url: "../php/getCrud.php",
                data:{ id: idI, nombre: nombreI, porcion: porcionI, nombreTabla: "leguminosa", action: "edit" },
                success: function(e) { 
                    
                    $('#editModal').modal('hide');
                    alertify.notify(e.trim()+' se actualizó al catálogo de frutas', 'success', 10, function(){  console.log('dismissed'); });
                    window.location.replace('leguminosas.php');
                    
                }
            });
            
                 
         });
         
     });
 } );