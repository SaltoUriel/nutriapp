$(document).ready(function() {
    
   $('#tableRoles').DataTable({
        "bLengthChange": false
    });        
   

    $('.btn-permisos').click(function(){
       $('#showPermisos').modal("show");
    });




    $('.activo-edit').click(function(){
        var idrol = $(this).data('idrol');
        
        var activoI = document.getElementById("I"+idrol).value;
       if( activoI == 1 ) {
        console.log(activoI);    
        activoI = 0; 
        }else{
            console.log(activoI);
            activoI = 1; 
        }
        console.log(activoI);
        $.ajax({ 
            type: "POST",
            url: "../php/getRoles.php",
            data:{ rol: idrol, activo: activoI, action:"update" },
            success: function(e) {
                alert(e);
                window.location.replace('roles.php');
            }
        });    

    });
    
   $('#btn-add').click(function(){
       var nivelRol =  document.getElementById("nivel-rol").value;
       var activoI;
       if( $('#someSwitchOptionSuccess').is(':checked') ) {
            activoI = 1; 
        }else{
            activoI = 0; 
        }
        
       $.ajax({ 
            type: "POST",
            url: "../php/getRoles.php",
            data:{ nivel: nivelRol, activo: activoI, action:"insert" },
            success: function(e) { 
                $("#"+e.trim()).remove();
                window.location.replace('roles.php');
            }
        });    
    });
});

