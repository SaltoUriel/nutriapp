<?php 
    include_once ("coneccion.php");
    
    if( (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contrasena']) && isset($_POST['rol']) && isset($_POST['activo']) && isset($_POST['action']) )
        || (isset($_POST['usuario']) && isset($_POST['activo']) && isset($_POST['action']))){
        $action = $_POST['action'];
        switch($action){
            case "insert" : $ObjectDashboardConfiguracion->insertUsuario($_POST['nombre'], $_POST['correo'] , $_POST['contrasena'] , $_POST['rol'], $_POST['activo']); break; 
            case "updateActivo" : $ObjectDashboardConfiguracion->updateUsuarioActivo($_POST['usuario'],$_POST['activo']);   break;
                        
        }
    }
   
?>