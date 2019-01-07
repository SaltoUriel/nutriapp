<?php 
    include_once ("coneccion.php");
    
    if(    (isset($_POST['hora']) && isset($_POST['tipoCena']) && isset($_POST['cereal']) && isset($_POST['lacteo']) && isset($_POST['usuario']) && isset($_POST['action']))
        || (isset($_POST['hora']) && isset($_POST['tipoCena']) && isset($_POST['cereal']) && isset($_POST['proteina']) && isset($_POST['verdura']) && isset($_POST['usuario']) && isset($_POST['action'])) 
        || (isset($_POST['id']) && isset($_POST['action']))
        || (isset($_POST['id']) && isset($_POST['hora']) && isset($_POST['tipoCena']) && isset($_POST['cereal']) && isset($_POST['lacteo']) && isset($_POST['action']))
        || (isset($_POST['id']) && isset($_POST['hora']) && isset($_POST['tipoCena']) && isset($_POST['cereal']) && isset($_POST['proteina']) && isset($_POST['verdura']) && isset($_POST['action'])) 
        ){
        
            $action = $_POST['action'];
            switch($action){
                case "insertCenaUno" : $ObjectDashboardDieta->insertCenaUno($_POST['hora'], $_POST['tipoCena'], $_POST['cereal'], $_POST['lacteo'], $_POST['usuario'] ); 
                    break; 
                
                case "insertCenaDos" : $ObjectDashboardDieta->insertCenaDos($_POST['hora'], $_POST['tipoCena'], $_POST['cereal'], $_POST['proteina'], $_POST['verdura'], $_POST['usuario'] ); 
                    break; 

                case "editCenaUno" :  $ObjectDashboardDieta->updateCenaUno($_POST['id'], $_POST['hora'], $_POST['tipoCena'], $_POST['cereal'], $_POST['lacteo']); 
                    break;

                case "editCenaDos" :  $ObjectDashboardDieta->updateCenaDos($_POST['id'], $_POST['hora'], $_POST['tipoCena'], $_POST['cereal'], $_POST['proteina'], $_POST['verdura']); 
                      
                break;
                case "delete" : $ObjectDashboardDieta->deleteCena($_POST['id']);  break;

            }
    }
   
?>