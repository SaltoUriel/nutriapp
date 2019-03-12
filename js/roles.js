$(document).ready(function() {
   $('#btn-add').attr('disabled', true);
   
   var nuevoRol = $('#nivel-rol');
   $('#tableRoles').DataTable({
        "bLengthChange": false
    });        
   
    function validaNivelRol(){
        var rolTexto = nuevoRol.val();
        if(rolTexto.length > 0){
            $('#btn-add').attr('disabled', false);         
        }else{
            $('#btn-add').attr('disabled', true);
        }
    }

    nuevoRol.keyup(function(){
        validaNivelRol();
    });

   


    $('.activo-edit').click(function(){
        var idrol = $(this).data('idrol');
        
        var activoI = document.getElementById("I"+idrol).value;
        var registro = "I"+idrol;
       if( activoI == 1 ) {
            activoI = 0; 
        }else{
            activoI = 1; 
        }
        $.ajax({ 
            type: "POST",
            url: "../php/getRoles.php",
            data:{ rol: idrol, activo: activoI, action:"update" },
            success: function(e) {
                if(e.trim() === "Ok"){
                    if(activoI == 1){
                        document.getElementById(registro).checked = true;
                        document.getElementById(registro).value = 1;
                    }else{
                        document.getElementById(registro).checked = false;
                        document.getElementById(registro).value = 0;
                    }
                }
            }
        });    

    });
    
    

   $('#btn-add').click(function(){
       var nivelRol =  document.getElementById("nivel-rol").value;
       var activoI;
       if( $('#activo-rol-new').is(':checked') ) {
            activoI = 1; 
        }else{
            activoI = 0; 
        }
        
       $.ajax({ 
            type: "POST",
            url: "../php/getRoles.php",
            data:{ nivel: nivelRol, activo: activoI, action:"insert" },
            beforeSend: function(){
                
            },
            success: function(e) { 
                $("#"+e.trim()).remove();
                window.location.replace('roles.php');
            }
        });    
    });

    $('.btn-permisos').click(function(){
        var idRol = $(this).data('rol');
        $('#formPermisos').empty();

        $.ajax({
            type: "POST",
            url:"../php/getRoles.php",
            data: {rol: idRol, action: "showPermisos" },
            success: function(e){
                $('#formPermisos').append(e);
                $('#showPermisos').modal("show");
            }

        });

    });

    $('#btn-guardarRoles').click(function(){
        $('#showPermisos').modal("hide");


        
    });
});

