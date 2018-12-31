<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
   
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Dieta día</title>

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
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/alertify.min.css" rel="stylesheet">
    <link href="../css/default.min.css" rel="stylesheet">
    <link href="../css/cards.css" rel="stylesheet">
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
                                                  
                                <h1>Dieta día</h1>  
                            </div>
                            
                        </div>
                        <div class="col-lg-6 page-header">
                            <h1 class=""> <button type="button" class="btn btn-success col-md-offset-7" id="btn-guardar" >Crear dieta</button> </h1>
                        </div>
                    </div>
                    <!-- ... Your content goes here ... --> 
                    <div class="row ">
                        <table id="tableDietasDia" class="table table-striped">
                            <thead class="thead-light center">
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Desayuno</th>
                                    <th scope="col">Almuerzo</th>
                                    <th scope="col">Colacion</th>
                                    <th scope="col">Comida</th>
                                    <th scope="col">Colacion</th>
                                    <th scope="col">Cena</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ObjectDashboardDieta->mostrarListaDietaDia(); ?>
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
                    <h4 class="modal-title" id="exampleModalLabel">Crear dieta día</h4>
                </div>
                <div class="modal-body">
                    <form>                        
                        <div class="input-group">
                            <p id="input-desayuno-text" type="text" class="form-control">Selecciona un desayuno</p>
                            <input id="input-desayuno-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-desayuno">Desayuno</button>
                                </span>
                        </div>
                        <br>
                        <div class="input-group">
                            <p id="input-almuerzo-text" type="text" class="form-control">Selecciona un almuerzo</p>
                            <input id="input-almuerzo-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-almuerzo">Almuerzo</button>
                                </span>
                        </div>                            
                        <br>
                        <div class="input-group">
                            <p id="input-colacionUno-text" type="text" class="form-control">Selecciona colacion</p>
                            <input id="input-colacionUno-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-colacionUno">Colacion uno</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-comida-text" type="text" class="form-control">Selecciona un Comida</p>
                            <input id="input-comida-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-comida">Comida</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-colacionDos-text" type="text" class="form-control">Selecciona Colacion</p>
                            <input id="input-colacionDos-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-colacionDos">Colacion Dos</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-cena-text" type="text" class="form-control">Selecciona un Cena</p>
                            <input id="input-cena-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-cena">Cena</button>
                                </span>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardarCena" >Guardar</button>                   
                </div>
            </div>
        </div>  
    </div>

   <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Editar comdia</h4>
                </div>
                <div class="modal-body">
                    <form>                        
                        <div class="input-group">
                            <p id="input-desayuno-text-edit" type="text" class="form-control">Selecciona un desayuno</p>
                            <input id="input-desayuno-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-desayuno-edit">Desayuno</button>
                                </span>
                        </div>
                        <br>
                        <div class="input-group">
                            <p id="input-almuerzo-text-edit" type="text" class="form-control">Selecciona un almuerzo</p>
                            <input id="input-almuerzo-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-almuerzo-edit">Almuerzo</button>
                                </span>
                        </div>                            
                        <br>
                        <div class="input-group">
                            <p id="input-colacionUno-text-edit" type="text" class="form-control">Selecciona colacion</p>
                            <input id="input-colacionUno-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-colacionUno-edit">Colacion uno</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-comida-text-edit" type="text" class="form-control">Selecciona un Comida</p>
                            <input id="input-comida-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-comida-edit">Comida</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-colacionDos-text-edit" type="text" class="form-control">Selecciona Colacion</p>
                            <input id="input-colacionDos-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-colacionDos-edit">Colacion Dos</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-cena-text-edit" type="text" class="form-control">Selecciona un Cena</p>
                            <input id="input-cena-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-cena-edit">Cena</button>
                                </span>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-editarDietaDia" >Guardar</button>                   
                </div>
            </div>
        </div>  
    </div>
    
    

    <div class="modal fade" id="showDesayunoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Desayunos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDieta->mostrarDesayunosSeleccion(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showAlmuerzoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Almuerzos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDieta->mostrarAlmuerzoSeleccion(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                      
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showComidaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Comidas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDieta->mostrarComidaSeleccion(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showColacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Colaciones</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDieta->mostrarColacionUnoSeleccion(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                             
                </div>
            </div>
        </div>  
    </div>
    
    <div class="modal fade" id="showColacionDosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Colaciones</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDieta->mostrarColacionDosSeleccion(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showCenaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Cenas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDieta->mostrarCenaSeleccion(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <script src="../js/dietaDia.js"></script>
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
