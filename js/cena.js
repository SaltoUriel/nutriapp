$(document).ready(function() {
    $('#tableCenasUno').DataTable();             
    $('#tableCenasDos').DataTable();
    $('#conTablaCenaDos').hide();
    var gif = "<i class='fas fa-sync fa-spin'></i>";
    document.getElementById('tipo-cena-texto').innerText += " "+document.getElementById('cenaUno').innerHTML;
    $('#cenaDos').click(function(){        
        $('#conTablaCenaDos').show();
        $('#conTablaCenaUno').hide();
        
        document.getElementById('tipo-cena-texto').innerText = "Cena "+document.getElementById('cenaDos').innerHTML;
    });

    $('#cenaUno').click(function(){
        $('#conTablaCenaUno').show();
        $('#conTablaCenaDos').hide();      
        
        document.getElementById('tipo-cena-texto').innerText = "Cena "+document.getElementById('cenaUno').innerHTML;
    });


    $('#btn-insert-modal').click(function(){
        
        var tipoCena = document.getElementById('tipo-cena-texto').innerText;
        
        if(tipoCena.trim() == "Cena Lacteo-Cereal"){
            $('#insertModalCenaDos').modal('hide');
            $('#insertModalCenaUno').modal('show');
        
        }else{
            $('#insertModalCenaUno').modal('hide');
            $('#insertModalCenaDos').modal('show');


        }
    });

     var proteina ;
     var grasa;
     var verdura;
     var cereal;
   
    $('.eliminarCenaUno').click(function(){
               
         var service = $(this).parent().attr('data');
            console.log(service);
         alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro? podría alterar otros registros.', function(){
                 var dataString = service;
                 $.ajax({ 
                     type: "POST",
                     url: "../php/getCenaUno.php",
                     data:{ id: dataString, action: "delete" },
                     success: function(e) { 
                         $("#uno"+e.trim()).remove();
                     }
                 });
                     
             alertify.success('Registro eliminado') }
         , function(){ });                
     });


     $('.eliminarCenaDos').click(function(){
               
        var service = $(this).parent().attr('data');
           console.log(service);
        alertify.confirm('Eliminar', '¿Estas seguro de eliminar el registro? podría alterar otros registros.', function(){
                var dataString = service;
                $.ajax({ 
                    type: "POST",
                    url: "../php/getCenaUno.php",
                    data:{ id: dataString, action: "delete" },
                    success: function(e) { 
                        $("#dos"+e.trim()).remove();
                    }
                });
                    
            alertify.success('Registro eliminado') }
        , function(){ });                
    });


     $('#btn-guardarCenaUno').click(function(){
         console.log("deekjj");
         var horaI = document.getElementById("recipient-hora-cena-uno").value;
         var tipoCenaI = document.getElementById("recipient-tipo-cena-uno").value;
         var cerealI = document.getElementById('recipient-cereal-cena-uno').value;
         var lacteoI = document.getElementById('recipient-lacteo-cena-uno').value;
         var idUsuario = document.getElementById('idUsuario').value;
         var horaFinal = horaI+":00";
         
        if(horaFinal == null || tipoCenaI == null || cerealI.length == 0 || lacteoI.length == 0 ){
            alert("Campos vacios...")
        }else{
             $.ajax({ 
                 type: "POST",
                 url: "../php/getCenaUno.php",
                 data:{ hora: horaFinal, tipoCena: tipoCenaI, cereal: cerealI, lacteo: lacteoI, usuario: idUsuario, action: "insertCenaUno" },
                 beforeSend: function(){
                    $("#btn-guardarCenaUno").text("");
                    $("#btn-guardarCenaUno").append(gif);
                },
                 success: function(e) { 
                     $('#insertModalCenaUno').modal('hide');
                     
                     alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                     window.location.replace('cena.php');
                 }
             });
        }
     });
     
     $('#btn-guardarCenaDos').click(function(){
         
        var horaI = document.getElementById("recipient-hora-cena-dos").value;
        var tipoCenaI = document.getElementById("recipient-tipo-cena-dos").value;
        var cerealI = document.getElementById('recipient-cereal-cena-dos').value;
        var proteinaI = document.getElementById('recipient-proteina-cena-dos').value;
        var verduraI = document.getElementById('recipient-verdura-cena-dos').value;
        var idUsuario = document.getElementById('idUsuario').value;
        var horaFinal = horaI+":00";
        
       if(horaFinal == null || tipoCenaI == null || cerealI.length == 0 || proteinaI.length == 0 || verduraI.length == 0 ){
           alert("Campos vacios...")
       }else{
            $.ajax({ 
                type: "POST",
                url: "../php/getCenaUno.php",
                data:{ hora: horaFinal, tipoCena: tipoCenaI, cereal: cerealI, proteina: proteinaI, verdura: verduraI, usuario: idUsuario, action: "insertCenaDos" },
                beforeSend: function(){
                    $("#btn-guardarCenaDos").text("");
                    $("#btn-guardarCenaDos").append(gif);
                },
                success: function(e) { 
                    $('#insertModalCenaDos').modal('hide');
                    alertify.notify(e.trim(), 'success', 5, function(){  console.log('dismissed'); });
                    window.location.replace('cena.php');
                }
            });
       }
    });
    


     $('.editarCenaUno').click(function(){
        var idCena = $(this).data('cena');
        var tipoCena = $(this).data('tipocena');
        var horaCena = $(this).data('horacena');
        var cereal = $(this).data('cereal');
        var lacteo = $(this).data('lacteo');
                
        document.getElementById("recipient-hora-cena-uno-editar").value = horaCena;

        document.getElementById("recipient-tipo-cena-uno-editar").value = tipoCena;
        var selectCereal = document.getElementById("recipient-cereal-cena-uno-editar");
        for(var index = 0; index<selectCereal.length; index++){
            if(selectCereal[index].value == cereal){
                selectCereal.selectedIndex = index;
            }
        }
        
        var selectLacteo = document.getElementById("recipient-lacteo-cena-uno-editar");
        for(var index = 0; index < selectLacteo.length; index++){
            if(selectLacteo[index].value == lacteo){
                selectLacteo.selectedIndex = index;
            }
        }


        $('#editModalCenaUno').modal('show');

        $('#btn-editarCenaUno').click(function(){
            
            var horaI = document.getElementById("recipient-hora-cena-uno-editar").value;
            var tipoCenaI = document.getElementById("recipient-tipo-cena-uno-editar").value;            
            var lacteoI = document.getElementById('recipient-lacteo-cena-uno-editar').value;
            var cerealI = document.getElementById('recipient-cereal-cena-uno-editar').value;
            var horaFinal = horaI+":00";
            
            $.ajax({ 
                type: "POST",
                url: "../php/getCenaUno.php",
                data:{ id: idCena, hora: horaFinal, tipoCena: tipoCenaI, cereal: cerealI, lacteo: lacteoI, action: "editCenaUno" },
                beforeSend: function(){
                    $("#btn-editarCenaUno").text("");
                    $("#btn-editarCenaUno").append(gif);
                },
                success: function(e) {                     
                    $('#editModalCenaUno').modal('hide');
                    alertify.notify(e.trim()+' se actualizó al catálogo de verduras', 'success', 10, function(){  console.log('dismissed'); });
                    window.location.replace('cena.php');
                    
                }
            });
        });  
        
     });

     $('.editarCenaDos').click(function(){
        var idCena = $(this).data('cena');
        var tipoCena = $(this).data('tipocena');
        var horaCena = $(this).data('horacena');
        var cereal = $(this).data('cereal');
        var proteina = $(this).data('proteina');
        var verdura = $(this).data('verdura');
                
        document.getElementById("recipient-hora-cena-dos-editar").value = horaCena;

        document.getElementById("recipient-tipo-cena-dos-editar").value = tipoCena;

        var selectCereal = document.getElementById("recipient-cereal-cena-dos-editar");
        for(var index = 0; index<selectCereal.length; index++){
            if(selectCereal[index].value == cereal){
                selectCereal.selectedIndex = index;
            }
        }
        
        var selectProteina = document.getElementById("recipient-proteina-cena-dos-editar");
        for(var index = 0; index < selectProteina.length; index++){
            if(selectProteina[index].value == proteina){
                selectProteina.selectedIndex = index;
            }
        }


        var selectVerdura = document.getElementById("recipient-verdura-cena-dos-editar");
        for(var index = 0; index < selectVerdura.length; index++){
            if(selectVerdura[index].value == verdura){
                selectVerdura.selectedIndex = index;
            }
        }


        $('#editModalCenaDos').modal('show');

        $('#btn-editarCenaDos').click(function(){
            
            var horaI = document.getElementById("recipient-hora-cena-dos-editar").value;
            var tipoCenaI = document.getElementById("recipient-tipo-cena-dos-editar").value;            
            var proteinaI = document.getElementById('recipient-proteina-cena-dos-editar').value;
            var cerealI = document.getElementById('recipient-cereal-cena-dos-editar').value;
            var verduraI = document.getElementById('recipient-verdura-cena-dos-editar').value;
            
            $.ajax({ 
                type: "POST",
                url: "../php/getCenaUno.php",
                data:{ id: idCena, hora: horaI, tipoCena: tipoCenaI, cereal: cerealI, proteina: proteinaI, verdura: verduraI, action: "editCenaDos" },
                beforeSend: function(){
                    $("#btn-editarCenaDos").text("");
                    $("#btn-editarCenaDos").append(gif);
                },
                success: function(e) {                     
                    $('#editModalCenaDos').modal('hide');
                    alertify.notify(e.trim()+' se actualizó al catálogo de cena', 'success', 10, function(){  console.log('dismissed'); });
                    window.location.replace('cena.php');
                    
                }
            });
        });  
        
     });

 });

