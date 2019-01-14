<?php 
    include_once ("coneccion.php");
    
    if( isset($_POST['usuario']) && isset($_POST['contrasena']) && isset($_POST['action'])){
        $action = $_POST['action'];
        switch($action){
            case "updatePass" : $ObjectDashboard->updatePass($_POST['usuario'], $_POST['contrasena']); 
            break; 
        }
    }
   
?>