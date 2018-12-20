<?php 
    include_once ("coneccion.php");
    
    if((isset($_POST['id']) && isset($_POST['nombreTabla']) && isset($_POST['action'])) || 
        (isset($_POST['nombre']) && isset($_POST['porcion']) && isset($_POST['nombreTabla']) && isset($_POST['action'])) ||
        (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['porcion']) && isset($_POST['nombreTabla']) && isset($_POST['action']))   ){
        $action = $_POST['action'];
        switch($action){
            case "insert" : $ObjectDashboard->insertarCatalogo($_POST['nombreTabla'], $_POST['nombre'], $_POST['porcion']); break; 
            case "edit" :   $ObjectDashboard->editarFruta($_POST['id'], $_POST['nombre'], $_POST['porcion'], $_POST['nombreTabla']); break;
            case "delete" : $ObjectDashboard->borrarCatalogo($_POST['id'], $_POST['nombreTabla']); break;
            case "read" : break;
        }
    }
   
?>