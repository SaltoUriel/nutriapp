<?php 
    include_once ("coneccion.php");
    
    if(   (isset($_POST['dieta']) && isset($_POST['usuario']) && isset($_POST['action']))
        ||(isset($_POST['id']) && isset($_POST['action']))
        ||(isset($_POST['id']) && isset($_POST['dieta']) && isset($_POST['action'])) ){
        $action = $_POST['action'];
        switch($action){
            case "insert" : $ObjectDashboardDietaSemana->insertSabado($_POST['dieta'], $_POST['usuario']); break; 
            case "edit" :   $ObjectDashboardDietaSemana->editSabado($_POST['id'], $_POST['dieta']); break;
            case "delete" : $ObjectDashboardDietaSemana->deleteSabado($_POST['id']); break;
            
        }
    }
   
?>