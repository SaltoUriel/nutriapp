$(document).ready(function() {
    
   $('#tableRoles').DataTable({
        "bLengthChange": false
    });        
    
    $('.activo-edit').click(function(){
        var idrol = $(this).data('idrol');
        var activoI = document.getElementById(idrol).value;
       if( activoI == 1 ) {
            activoI = 0; 
        }else{
            activoI = 1; 
        }
        console.log(activoI);
        $.ajax({ 
            type: "POST",
            url: "../php/getRoles.php",
            data:{ rol: idrol, activo: activoI, action:"update" },
            success: function(e) {
                $("#"+e.trim()).remove();
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

