<?php 
    include_once ("coneccion.php");
    
    if(   (isset($_POST['dieta']) && isset($_POST['usuario']) && isset($_POST['action']))
        ||(isset($_POST['id']) && isset($_POST['action']))
        ||(isset($_POST['id']) && isset($_POST['dieta']) && isset($_POST['action'])) ){
        $action = $_POST['action'];
        switch($action){
            case "insert" : $ObjectDashboardDietaSemana->insertMiercoles($_POST['dieta'], $_POST['usuario']); break; 
            case "edit" :   $ObjectDashboardDietaSemana->editMiercoles($_POST['id'], $_POST['dieta']); break;
            case "delete" : $ObjectDashboardDietaSemana->deleteMiercoles($_POST['id']); break;
            
        }
    }
   
?>