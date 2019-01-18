<?php 
    include_once ("coneccion.php");
    
    if(   (isset($_POST['nivel']) && isset($_POST['activo']) && isset($_POST['action']))
        ||(isset($_POST['id']) && isset($_POST['action']))
        ||(isset($_POST['rol']) && isset($_POST['activo']) && isset($_POST['action'])) ){
        $action = $_POST['action'];
        switch($action){
            case "insert" : $ObjectDashboardConfiguracion->insertRoles($_POST['nivel'], $_POST['activo']); break; 
            case "update" :   $ObjectDashboardConfiguracion->updateRoles($_POST['rol'], $_POST['activo']); break;            
        }
    }
   
?>