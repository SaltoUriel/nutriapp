<?php 
    include_once ("coneccion.php");
    
    if(   (isset($_POST['desayuno']) && isset($_POST['almuerzo']) && isset($_POST['colacionUno']) && isset($_POST['comida']) && isset($_POST['colacionDos']) && isset($_POST['cena']) && isset($_POST['usuario']) && isset($_POST['action']))
       || (isset($_POST['id']) && isset($_POST['desayuno']) && isset($_POST['almuerzo']) && isset($_POST['colacionUno']) && isset($_POST['comida']) && isset($_POST['colacionDos']) && isset($_POST['cena']) && isset($_POST['action'])) 
       || (isset($_POST['id']) && isset($_POST['action'])) ){
        
            $action = $_POST['action'];
            switch($action){
                case "insert" : $ObjectDashboardDieta->insertDietaDia($_POST['desayuno'], $_POST['almuerzo'], $_POST['colacionUno'], $_POST['comida'], $_POST['colacionDos'], $_POST['cena'], $_POST['usuario'] ); 
                    break; 

                case "edit" :  $ObjectDashboardDieta->updateDietaDia($_POST['id'], $_POST['desayuno'], $_POST['almuerzo'], $_POST['colacionUno'], $_POST['comida'], $_POST['colacionDos'], $_POST['cena']); 
                  echo "dentro";  break;

                case "delete" : $ObjectDashboardDieta->deleteDietaDia($_POST['id']);  break;

            }
    }
   
?>