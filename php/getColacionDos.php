
<?php 
    include_once ("coneccion.php");

    if(  (isset($_POST['id']) && isset($_POST['action'])) 
       ||(isset($_POST['hora']) && isset($_POST['fruta']) && isset($_POST['usuario']) && isset($_POST['action']))
       ||(isset($_POST['id']) && isset($_POST['hora']) && isset($_POST['fruta']) && isset($_POST['action'])) ){

        $action = $_POST['action'];
        switch($action){
            case "delete" : $ObjectDashboardDieta->deleteColacionDos($_POST['id']); break;
            case "insert" : $ObjectDashboardDieta->insertColacionDos($_POST['hora'], $_POST['fruta'], $_POST['usuario']); break;
            case "edit" : $ObjectDashboardDieta->updateColacionDos($_POST['id'], $_POST['hora'], $_POST['fruta']); break;
        }
       }

?>