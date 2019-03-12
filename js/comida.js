$(document).ready(function() {
    $('#tableComidas').DataTable();           
      
   
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
                     url: "../php/getComida.php",
                     data:{ id: dataString, action: "delete" },
                     success: function(e) { 
                         $("#"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });

     $('#btn-guardarComida').click(function(){
         
         var horaI = document.getElementById("recipient-hora").value;
         var proteinaI = document.getElementById("recipient-proteina").value;
         var grasaI = document.getElementById('recipient-grasa').value;
         var verduraI = document.getElementById('recipient-verdura').value;
         var cerealI = document.getElementById('recipient-cereal').value;
         var leguminosaI = document.getElementById('recipient-legumi').value;
         var idUsuario = document.getElementById('idUsuario').value;
         var horaFinal = horaI+":00";
         var gif = "<i class='fas fa-sync fa-spin'></i>";
        if(horaFinal == null || proteinaI == null || grasaI.length == 0 || verduraI.length == 0 || cerealI.length == 0 ){
            alert("Campos vacios...")
        }else{
             $.ajax({ 
                 type: "POST",
                 url: "../php/getComida.php",
                 data:{ hora: horaFinal, proteina: proteinaI, grasa: grasaI, verdura: verduraI, cereal: cerealI, leguminosa:leguminosaI, usuario: idUsuario, action: "insert" },
                 beforeSend: function(){
                    $("#btn-guardarComida").text("");
                    $("#btn-guardarComida").append(gif);
                  },
                 success: function(e) { 
                     $('#insertModal').modal('hide');
                     alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('comida.php');
                 }
             });
        }
     });
     
     $('.editar').click(function(){
        var idAlmuerzo = $(this).data('idcomida');
        var horaAlmuerzo = $(this).data('horacomida');
        proteina = $(this).data('proteina');
        grasa = $(this).data('grasa');
        verdura = $(this).data('verdura');
        cereal = $(this).data('cereal');
        leguminosa = $(this).data('leguminosa');
        var gif = "<i class='fas fa-sync fa-spin'></i>";
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
        }

        var selectLeguminosa = document.getElementById("recipient-legumi-editar");
        for(var index = 0; index < selectLeguminosa.length; index++){
            if(selectLeguminosa[index].value == leguminosa){
                selectLeguminosa.selectedIndex = index;
            }
        }

        $('#editModal').modal('show');

        $('#btn-editarComida').click(function(){
            
            var horaI = document.getElementById("recipient-hora-editar").value;
            var proteinaI = document.getElementById("recipient-proteina-editar").value;
            var grasaI = document.getElementById('recipient-grasa-editar').value;
            var verduraI = document.getElementById('recipient-verdura-editar').value;
            var cerealI = document.getElementById('recipient-cereal-editar').value;
            var leguminosaI = document.getElementById('recipient-legumi-editar').value;
            var horaFinal = horaI+":00";
            var gif = "<i class='fas fa-sync fa-spin'></i>";
            $.ajax({ 
                type: "POST",
                url: "../php/getComida.php",
                data:{ id: idAlmuerzo, proteina: proteinaI, grasa: grasaI, verdura: verduraI, cereal: cerealI, leguminosa: leguminosaI, hora: horaFinal, action: "edit" },
                beforeSend: function(){
                    $("#btn-editarComida").text("");
                    $("#btn-editarComida").append(gif);
                },
                success: function(e) { 
                    $('#editModal').modal('hide');
                    alertify.notify(e.trim()+' se actualizó al catálogo de verduras', 'success', 10, function(){  console.log('dismissed'); });
                    window.location.replace('comida.php');
                    
                }
            });
        });  
        
     });

 });

