<?php
     include_once ("coneccion.php");
     if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['porcion'])){
        $ObjectDashboard->editarGrasa($_POST['id'], $_POST['nombre'], $_POST['porcion']);
     }
?>