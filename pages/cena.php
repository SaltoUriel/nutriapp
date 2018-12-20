<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
   
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Cena</title>

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
    <!-- Custom onts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/alertify.min.css" rel="stylesheet">
    <link href="../css/default.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/jquery.datetimepicker.css" type="text/css">

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
                
                    <div class="col-lg-12 center-block">
                        <div class="col-lg-6 page-header">
                            <div class="col-lg-2 align-baseline">
                                
                                <img class="text-icon" src="../img/fruta.png">
                            </div>
                            <div class="col-lg-3">
                                                
                                <h1>Cena</h1> 
                            </div>
                            
                        </div>
                        <div class="col-lg-6 page-header">
                            <h1 class=""> <a type="button" class="btn btn-success col-md-offset-7" data-toggle="modal" data-target="#insertModal" id="btn-guardar" >Crear cena</a> </h1>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Tipo de Cena
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a id="cenaUno" href="#">Lacteo-Cereal</a></li>
                                <li><a id="cenaDos" href="#">Proteina-Cereal</a></li>
                            </ul>
                        </div>
                    </div><br>
                    
                    <!-- ... Your content goes here ... --> 
                    <div class="row ">
                        <table id="tableCenasUno" class="table table-striped">
                            <thead class="thead-light center">
                                <tr>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Tipo Cena</th>
                                    <th scope="col">Cereal</th>
                                    <th scope="col">Lácteo</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ObjectDashboardDieta->mostrarListaCenaUno(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row ">
                        <table id="tableCenasDos" class="table table-striped">
                            <thead class="thead-light center">
                                <tr>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Tipo Cena</th>
                                    <th scope="col">Proteina</th>
                                    <th scope="col">Verdura</th>
                                    <th scope="col">Cereal</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ObjectDashboardDieta->mostrarListaCenaDos(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Crear almuerzo</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-hora" class="control-label">Hora:</label>
                            <input type="time" class="form-control" min="07:00" max="08:00" step="3600" id="recipient-hora">
                        </div>
                        <div class="form-group">
                            <label for="recipient-proteina" class="control-label">Proteína:</label>
                            <select id="recipient-proteina" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionProteina(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-grasa" class="control-label">Grasa:</label>
                            <select id="recipient-grasa" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionGrasa(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-verdura" class="control-label">Verdura:</label>
                            <select id="recipient-verdura" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionVerdura(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-cereal" class="control-label">Cereal:</label>
                            <select id="recipient-cereal" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionCereal(); ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardarAlmuerzo" >Guardar</button>                   
                </div>
            </div>
        </div>  
    </div>
   
   <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Editar almuerzo</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-hora-editar" class="control-label">Hora:</label>
                            <input type="time" class="form-control" min="07:00" max="08:00" step="3600" id="recipient-hora-editar">
                        </div>
                        <div class="form-group">
                            <label for="recipient-proteina-editar" class="control-label">Proteína:</label>
                            <select id="recipient-proteina-editar" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionProteina(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-grasa-editar" class="control-label">Grasa:</label>
                            <select id="recipient-grasa-editar" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionGrasa(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-verdura-editar" class="control-label">Verdura:</label>
                            <select id="recipient-verdura-editar" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionVerdura(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-cereal-editar" class="control-label">Cereal:</label>
                            <select id="recipient-cereal-editar" class="form-control">
                                <?php $ObjectDashboardDieta->seleccionCereal(); ?>
                            </select>
                        </div>
                     
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-editarAlmuerzo" >Guardar</button>                   
                </div>
            </div>
        </div>  
    </div>
    


    
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
    <script src="../js/cena.js">  </script>
    
</body>
</html>
