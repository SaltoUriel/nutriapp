<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
   
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Roles</title>

    <link href="../css/swicht.css" rel="stylesheet">
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
                    <div class="page-header">
                        <h1 class=""><i class="glyphicon glyphicon-check"></i> Roles</h1>            
                    </div>                        
                </div>
                
                <!-- ... Your content goes here ... --> 
                <div class="row">
                    <div class="col-lg-12">
                        <form>                                
                            <div class="form-group col-lg-3">
                                <label for="nivel-rol" class="control-label">Nivel Rol</label>
                                <input type="text" class="form-control" id="nivel-rol" required>
                            </div>                            
                        
                            <div class="form-group col-lg-2">
                                <label for="activo-rol-new" class="control-label">Activo</label>                                                        
                                <div class="material-switch pull-center">
                                    <input id="activo-rol-new" name="activo-rol-new" type="checkbox"/>
                                    <label for="activo-rol-new" class="label-success"></label>
                                </div>  
                            </div>
                        
                            <div class="form-group col-lg-2">
                                <label for="btn-add" class="control-label"></label>
                                <a type="button" class="form-control btn btn-info" id="btn-add" required>
                                    <i class="glyphicon glyphicon-plus"></i>
                                </a>
                            </div>
                        </form>    
                    </div>
                </div>
                <div class="row ">                        
                    <table id="tableRoles" class="table table-striped">
                        <thead class="thead-light center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nivel</th>
                                <th scope="col">Fecha Creacion</th>
                                <th scope="col">Perimisos</th>
                                <th scope="col">Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ObjectDashboardConfiguracion->showRolesLista(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="showPermisos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Permisos</h4>
                </div>
                <div class="modal-body" id="permisoShow">
                <form id="formPermisos"> </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardarRoles" >Guardar</button>                    
                </div>
            </div>
        </div>  
    </div>
    


    <script src="../js/roles.js"></script>
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
