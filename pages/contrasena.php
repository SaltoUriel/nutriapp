<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
   
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Index</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">

    <link href="../css/formPassword.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/alertify.min.css" rel="stylesheet">
    <link href="../css/default.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery.datetimepicker.css" type="text/css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('../modules/navbar.php'); ?>
        <?php 
            include '../php/coneccion.php';
            if(!$ObjectDashboard->checkSession()){
            echo '<script language = javascript> self.location = "javascript:history.back(-1);" </script>';
            exit;
            }
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <input type="hidden" id="idUsuario" value="<?php @session_start(); echo $_SESSION['idusuarios']; ?>">
                <div class="row">               
                    
                    <!-- ... Your content goes here ... --> 
                    <div class="row">
                    <br>
                    <br>
                    <div class="testbox">
                        <h1>Cambiar Contraseña</h1>
                        <form action="/" id="formContrasena">
                            <hr>                            
                            <label id="icon" for="contrasena-uno"><i class="icon-shield"></i></label>
                            <input type="password" name="contrasena-uno" id="contrasena-uno" placeholder="Contraseña" required/>
                            <hr>
                            <label id="icon" for="contrasena-dos"><i class="icon-shield"></i></label>
                            <input type="password" name="contrasena-dos" id="contrasena-dos" placeholder="Confirmar Contraseña" required/>
                            <hr>
                            <a id="btn-cambiarContrasena" href="#" class="button">Guardar</a>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    

    <script src="../js/contrasena.js"></script>
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>
    <script src="../js/dataTables/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="../js/jquery.datetimepicker.full.min.js"></script>
</body>
</html>
