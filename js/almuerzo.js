$(document).ready(function() {
    $('#tableAlmuerzos').DataTable();           
      
   
     var proteina ;
     var grasa;
     var verdura;
     var cereal;
   
    $('.eliminar').click(function(){
         var parent = $(this).parent().attr('id');
       
         var service = $(this).parent().attr('data');
            console.log(service);
         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro? podría alterar otros registros.', function(){
                 var dataString = service;
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getDieta.php",
                     data:{ id: dataString, action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarAlmuerzo').click(function(){
         
         var horaI = document.getElementById("recipient-hora").value;
         var proteinaI = document.getElementById("recipient-proteina").value;
         var grasaI = document.getElementById('recipient-grasa').value;
         var verduraI = document.getElementById('recipient-verdura').value;
         var cerealI = document.getElementById('recipient-cereal').value;
         var idUsuario = document.getElementById('idUsuario').value;
         var horaFinal = horaI+":00";
         
        if(horaFinal == null || proteinaI == null || grasaI.length == 0 || verduraI.length == 0 || cerealI.length == 0 ){
            alert("Campos vacios...")
        }else{
             $.ajax({ 
                 type: "POST",
                 url: "../php/getDieta.php",
                 data:{ hora: horaFinal, proteina: proteinaI, grasa: grasaI, verdura: verduraI, cereal: cerealI, usuario: idUsuario, action: "insert" },
                 success: function(e) { 
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('almuerzo.php');
                 }
             });
        }
     });
     
     $('.editar').click(function(){
        var idAlmuerzo = $(this).data('idalmuerzo');
        var horaAlmuerzo = $(this).data('horaarmuerzo');
        proteina = $(this).data('proteina');
        grasa = $(this).data('grasa');
        verdura = $(this).data('verdura');
        cereal = $(this).data('cereal');

        
        document.getElementById("recipient-hora-editar").value = horaAlmuerzo;
        var selectProteina = document.getElementById("recipient-proteina-editar");
        for(var index = 0; index<selectProteina.length; index++){
            if(selectProteina[index].value == proteina){
                selectProteina.selectedIndex = index;
            }
        }
        
        var selectGrasa = document.getElementById("recipient-grasa-editar");
        for(var index = 0; index < selectGrasa.length; index++){
            if(selectGrasa[index].value == grasa){
                selectGrasa.selectedIndex = index;
            }
        }

        var selectVerdura = document.getElementById("recipient-verdura-editar");
        for(var index = 0; index < selectVerdura.length; index++){
            if(selectVerdura[index].value == verdura){
                selectVerdura.selectedIndex = index;
            }
        }

        var selectCereal = document.getElementById("recipient-cereal-editar");
        for(var index = 0; index < selectCereal.length; index++){
            if(selectCereal[index].value == cereal){
                selectCereal.selectedIndex = index;
            }
        };

        $('#editModal').modal('show');
        
        $('#btn-editarAlmuerzo').click(function(){
            
            var horaI = document.getElementById("recipient-hora-editar").value;
            var proteinaI = document.getElementById("recipient-proteina-editar").value;
            var grasaI = document.getElementById('recipient-grasa-editar').value;
            var verduraI = document.getElementById('recipient-verdura-editar').value;
            var cerealI = document.getElementById('recipient-cereal-editar').value;
                        
            $.ajax({ 
                type: "POST",
                url: "../php/getDieta.php",
                data:{ id: idAlmuerzo, proteina: proteinaI, grasa: grasaI, verdura: verduraI, cereal: cerealI, hora: horaI, action: "edit" },
                success: function(e) {                     
                    $('#editModal').modal('hide');
                    alertify.notify(e.trim()+' se actualizó al catálogo de verduras', 'success', 10, function(){  console.log('dismissed'); });
                    window.location.replace('almuerzo.php');                    
                }
            });
        });  
        
     });

 });

