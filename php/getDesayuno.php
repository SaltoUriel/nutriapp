<?php 
    include_once ("coneccion.php");
    if(    (isset($_POST['id']) && isset($_POST['action'])) 
        || (isset($_POST['alimento']) && isset($_POST['descripcion']) && isset($_POST['hora']) && isset($_POST['usuario'])) 
        || (isset($_POST['id']) && isset($_POST['alimento']) && isset($_POST['descripcion']) && isset($_POST['action'])) ){

        $action = $_POST['action'];

        switch($action){
            case "delete" : $ObjectDashboardDieta->deleteDesayuno($_POST['id']);  break;
            case "insert" : $ObjectDashboardDieta->insertDesayuno($_POST['alimento'], $_POST['descripcion'], $_POST['hora'], $_POST['usuario'] ); break;
            case "update" : $ObjectDashboardDieta->updateDesayuno($_POST['id'], $_POST['alimento'], $_POST['descripcion'], $_POST['hora']);break;
        }
    }

?>