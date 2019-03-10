<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
   
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Semanas</title>

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
                        <table id="tableDietaSemana" class="table table-striped">
                            <thead class="thead-light center">
                                <tr>
                                    <th scope="col">Lunes</th>
                                    <th scope="col">Martes</th>
                                    <th scope="col">Miercoles</th>
                                    <th scope="col">Jueves</th>
                                    <th scope="col">Viernes</th>
                                    <th scope="col">Sábado</th>
                                    <th scope="col">Domingo</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ObjectDashboardDietaSemana->mostrarListaSemana(); ?>
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
                            <p id="input-lunes-text" type="text" class="form-control">Agregar dieta para el lunes</p>
                            <input id="input-lunes-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-lunes">Agregar</button>
                                </span>
                        </div>
                        <br>
                        <div class="input-group">
                            <p id="input-martes-text" type="text" class="form-control">Selecciona dieta para el dia martes</p>
                            <input id="input-martes-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-martes">Agregar</button>
                                </span>
                        </div>                            
                        <br>
                        <div class="input-group">
                            <p id="input-miercoles-text" type="text" class="form-control">Selecciona dieta para el dia miercoles</p>
                            <input id="input-miercoles-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-miercoles">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-jueves-text" type="text" class="form-control">Selecciona un Comida</p>
                            <input id="input-jueves-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-jueves">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-viernes-text" type="text" class="form-control">Agregar dieta para el viernes</p>
                            <input id="input-viernes-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-viernes">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-sabado-text" type="text" class="form-control">Agregar dieta para el sabado</p>
                            <input id="input-sabado-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-sabado">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-domingo-text" type="text" class="form-control">Agregar dieta para el domingo</p>
                            <input id="input-domingo-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-domingo">Agregar</button>
                                </span>
                        </div>
                        <br>
                        <div class="input-group">
                            <p id="input-tipo-dieta-text" type="text" class="form-control">Agregar el tipo de dieta</p>
                            <input id="input-tipo-dieta-id" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-tipo-dieta">Agregar</button>
                                </span>
                        </div>  
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardarSemana" >Guardar</button>                   
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
                            <p id="input-lunes-text-edit" type="text" class="form-control">Agregar dieta para el lunes</p>
                            <input id="input-lunes-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-lunes-edit">Agregar</button>
                                </span>
                        </div>
                        <br>
                        <div class="input-group">
                            <p id="input-martes-text-edit" type="text" class="form-control">Selecciona dieta para el dia martes</p>
                            <input id="input-martes-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-martes-edit">Agregar</button>
                                </span>
                        </div>                            
                        <br>
                        <div class="input-group">
                            <p id="input-miercoles-text-edit" type="text" class="form-control">Selecciona dieta para el dia miercoles</p>
                            <input id="input-miercoles-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-miercoles-edit">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-jueves-text-edit" type="text" class="form-control">Selecciona un Comida</p>
                            <input id="input-jueves-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-jueves-edit">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-viernes-text-edit" type="text" class="form-control">Agregar dieta para el viernes</p>
                            <input id="input-viernes-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-viernes-edit">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-sabado-text-edit" type="text" class="form-control">Agregar dieta para el sabado</p>
                            <input id="input-sabado-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-sabado-edit">Agregar</button>
                                </span>
                        </div> 
                        <br>
                        <div class="input-group">
                            <p id="input-domingo-text-edit" type="text" class="form-control">Agregar dieta para el domingo</p>
                            <input id="input-domingo-id-edit" type="hidden">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="btn-select-domingo-edit">Agregar</button>
                                </span>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-editarSemana" >Guardar</button>                   
                </div>
            </div>
        </div>  
    </div>
    
    

    <div class="modal fade" id="showLunesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Dietas para el dia lunes</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaDietasLunesSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showMartesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Dietas para el Martes</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaDietasMartesSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                      
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showMiercolesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Dietas para el Miercoles</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaDietasMiercolesSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showJuevesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Dietas para el Jueves</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaDietasJuevesSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                             
                </div>
            </div>
        </div>  
    </div>
    
    <div class="modal fade" id="showViernesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Dietas para el dia Viernes</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaDietasViernesSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showSabadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Dietas para el dia Sabado</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaDietasSabadoSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>



    <div class="modal fade" id="showDomingoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Dietas para el dia Domingo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaDietasDomingoSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="showTipoDietaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Tipos de dietas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $ObjectDashboardDietaSemana->mostrarListaTipoDietasSelection(); ?> 
                    </div>                
                    
                </div>
                <div class="modal-footer">
                                       
                </div>
            </div>
        </div>  
    </div>




    <script src="../js/semana.js"></script>
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
