<?php 
    include_once ("coneccion.php");
    
    if(    (isset($_POST['hora']) && isset($_POST['proteina']) && isset($_POST['grasa']) && isset($_POST['verdura']) && isset($_POST['cereal']) && isset($_POST['leguminosa']) && isset($_POST['usuario']) && isset($_POST['action'])) 
        || (isset($_POST['id']) && isset($_POST['action']))
        || (isset($_POST['id']) && isset($_POST['proteina']) && isset($_POST['grasa']) && isset($_POST['verdura']) && isset($_POST['cereal']) && isset($_POST['leguminosa']) && isset($_POST['hora']) && isset($_POST['action'])) ){
        
            $action = $_POST['action'];
            switch($action){
                case "insert" : $ObjectDashboardDieta->insertComida($_POST['hora'], $_POST['proteina'], $_POST['grasa'], $_POST['verdura'], $_POST['cereal'], $_POST['leguminosa'], $_POST['usuario'] ); 
                    break; 

                case "edit" :  $ObjectDashboardDieta->updateComida($_POST['id'], $_POST['hora'], $_POST['proteina'], $_POST['grasa'], $_POST['verdura'], $_POST['cereal'], $_POST['leguminosa']); 
                    break;

                case "delete" : $ObjectDashboardDieta->deleteComida($_POST['id']);  break;

            }
    }
   
?>