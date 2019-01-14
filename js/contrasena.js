$(document).ready(function(){
    
    //variables
    var valida = false;
    var pass1 = $('#contrasena-uno');
    var pass2 = $('#contrasena-dos');
    var confirmacion = "Las contraseñas si coinciden";
    var longitud = "La contraseña es muy corta";
    var negacion = "No coinciden las contraseñas";
    var vacio = "La contraseña no puede estar vacía";
    //oculto por defecto el elemento span
    var span = $('<span></span>').insertAfter(pass2);
    span.addClass('spanClass');
    span.hide();
    
    //función que comprueba las dos contraseñas
    function coincidePassword(){
        var valor1 = pass1.val();
        var valor2 = pass2.val();
        //muestro el span
        span.show().removeClass();
        //condiciones dentro de la función
        if(valor1 != valor2){
            span.text(negacion).addClass('negacion');	
           
        }
        if(valor1.length==0 || valor1==""){
            span.text(vacio).addClass('negacion');
            
        }
        if(valor1.length<6){
            span.text(longitud).addClass('negacion');
            
        }
        if(valor1.length!=0 && valor1==valor2 && valor1.length>6){
            span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
            valida = true;
        }
    }
    //ejecuto la función al soltar la tecla
    pass2.keyup(function(){
        coincidePassword();
    });

    var idUsuario = document.getElementById('idUsuario').value;
    $('#btn-cambiarContrasena').click(function(){
        if(valida){
            var password = $('#contrasena-dos').val();
            span.hide();
            $.ajax({ 
                type: "POST",
                url: "../php/getContrasena.php",
                data:{usuario: idUsuario, contrasena: password, action: "updatePass" },
                success: function(e) { 
                    alertify.notify('Contraseña actualizada con éxito', 'success', 10, function(){  
                        console.log('dismissed'); 
                    });
                    $('#formContrasena')[0].reset();                    
                }
            });
            
        }
    });

});