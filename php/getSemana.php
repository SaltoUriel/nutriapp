<?php 
    include_once ("coneccion.php");
    
    if(   (isset($_POST['lunes']) && isset($_POST['martes']) && isset($_POST['miercoles']) && isset($_POST['jueves']) && isset($_POST['viernes']) && isset($_POST['sabado']) && isset($_POST['domingo']) && isset($_POST['dieta']) && isset($_POST['usuario']) && isset($_POST['action']))
       || (isset($_POST['id']) && isset($_POST['lunes']) && isset($_POST['martes']) && isset($_POST['miercoles']) && isset($_POST['jueves']) && isset($_POST['viernes']) && isset($_POST['sabado'])  && isset($_POST['domingo']) && isset($_POST['action'])) 
       || (isset($_POST['id']) && isset($_POST['action'])) ){
        
            $action = $_POST['action'];
            switch($action){
                case "insert" : $ObjectDashboardDietaSemana->insertDietaSemana( $_POST['dieta'], $_POST['lunes'], $_POST['martes'], $_POST['miercoles'], $_POST['jueves'], $_POST['viernes'], $_POST['sabado'], $_POST['domingo'], $_POST['usuario'] ); 
                    break; 

                case "edit" :  $ObjectDashboardDietaSemana->updateDietaSemana($_POST['id'], $_POST['lunes'], $_POST['martes'], $_POST['miercoles'], $_POST['jueves'], $_POST['viernes'], $_POST['sabado'], $_POST['domingo']); 
                  echo "dentro";  break;

                case "delete" : $ObjectDashboardDietaSemana->deleteDietaSemana($_POST['id']);  break;

            }
    }
   
?>