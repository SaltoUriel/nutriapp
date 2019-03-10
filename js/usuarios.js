$(document).ready(function() {
    
    var rol;
   $('#tableUsuarios').DataTable();        
   

    $('.btn-permisos').click(function(){
        rol = $(this).data('rol');
        console.log(rol);
       $('#showPermisos').modal("show");
    });

    
    $('#btn-addUsuario').click(function(){
        var nombreInput =  document.getElementById("recipient-name").value;
        var correoInput =  document.getElementById("recipient-correo").value;
        var rolInput =  document.getElementById("recipient-rol").value;

        var gif = "<i class='fas fa-sync fa-spin'></i>";
        var contrasenaInput = "123456";
         console.log(nombreInput);
        $.ajax({ 
             type: "POST",
             url: "../php/getUsuario.php",
             data:{ nombre: nombreInput, correo: correoInput, rol:rolInput, activo: 1, contrasena: contrasenaInput, action:"insert" },
             beforeSend: function(){
               $("#btn-addUsuario").text("");
               $("#btn-addUsuario").append(gif);
             },
             success: function(e) { 
                window.location.replace('usuarios.php');
             }
         });    
    });
    

    $('.activo-edit').click(function(){

        var idUsario = $(this).data('idusuario');
        var activoI = document.getElementById("I"+idUsario).value;
        var registro = "I"+idUsario;
       if( activoI == 1 ) {
            activoI = 0; 
        }else{
            activoI = 1; 
        }
        $.ajax({ 
            type: "POST",
            url: "../php/getUsuario.php",
            data:{ usuario: idUsario, activo: activoI, action:"updateActivo" },
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
    
});

