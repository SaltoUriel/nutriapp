<?php 
    include_once ("coneccion.php");

    if(  (isset($_POST['id']) && isset($_POST['action'])) 
       ||(isset($_POST['hora']) && isset($_POST['fruta']) && isset($_POST['usuario']) && isset($_POST['action']))
       ||(isset($_POST['id']) && isset($_POST['hora']) && isset($_POST['fruta']) && isset($_POST['action'])) ){

        $action = $_POST['action'];
        switch($action){
            case "delete" : $ObjectDashboardDieta->deleteColacionUno($_POST['id']); break;
            case "insert" : $ObjectDashboardDieta->insertColacionUno($_POST['hora'], $_POST['fruta'], $_POST['usuario']); break;
            case "edit" : $ObjectDashboardDieta->updateColacionUno($_POST['id'], $_POST['hora'], $_POST['fruta']); break;
        }
       }

?>