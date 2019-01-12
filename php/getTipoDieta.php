<?php 
    include_once ("coneccion.php");
    
    if(   (isset($_POST['nombre']) && isset($_POST['semanas']) && isset($_POST['action']))
        ||(isset($_POST['id']) && isset($_POST['action']))
        ||(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['semanas']) && isset($_POST['action'])) ){
        $action = $_POST['action'];
        switch($action){
            case "insert" : $ObjectDashboardDietaSemana->insertTipoDieta($_POST['nombre'], $_POST['semanas']); break; 
            case "edit" :   $ObjectDashboardDietaSemana->editTipoDieta($_POST['id'], $_POST['nombre'], $_POST['semanas']); break;
            case "delete" : $ObjectDashboardDietaSemana->deleteTipoDieta($_POST['id']); break;
            
        }
    }
   
?>