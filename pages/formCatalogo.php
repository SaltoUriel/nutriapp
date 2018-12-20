<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Index</title>


    <link href="../css/navbar.css" rel="stylesheet">
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
               
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <h1 class="page-header"><i class="glyphicon glyphicon-apple"></i>Frutas</h1>  
                    </div>
                    &nbsp;
                      <?php 
                            $id = 0;
                            $nombre = "";
                            $porcion = "";
                            $editar = false;
                            if(isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['porcion'])){
                                $id = $_GET['id'];
                                $nombre = $_GET['nombre'];
                                $porcion = $_GET['porcion'];
                                $editar = true;
                            }                           
                      ?>                          
                      <script type="text/javascript">
                          window.addEventListener('load', calculos, false);
                            function calculos() {
                                var editar = "<?php echo $editar ?>";
                                if(editar){
                                    document.getElementById('tituloAgregar').style.display = 'none';
                                    document.getElementById('tituloEditar').style.display = 'block';
                                    document.getElementById('btn-Agregar').style.display = 'none';
                                    document.getElementById('btn-Editar').style.display = 'block';
                                }else{
                                    document.getElementById('tituloAgregar').style.display = 'block';
                                    document.getElementById('tituloEditar').style.display = 'none';
                                    document.getElementById('btn-Agregar').style.display = 'block';
                                    document.getElementById('btn-Editar').style.display = 'none';
                                }
                            
                                console.log(editar);
                            }
                      </script>
                <!-- ... Your content goes here ... --> 
                
                    <div class="container-fluid">
                        <div class="row center-block">
                            
                            <div class="col-md-6 col-md-offset-2 well well-sm">  
                            <h3 id="tituloAgregar">Agregar frutas al catálogo</h3> 
                            <h3 id="tituloEditar">Editar <?php echo $nombre; ?> </h3> 
                                    &nbsp;                                       
                                    <form class="form-horizontal" role="form" action="" method="POST">
                                    &nbsp;
                                        <div class="form-group">
                                            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $nombre ?>" type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="porcion" class="col-sm-2 control-label">Porcion</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $porcion; ?>" type="text" class="form-control" id="porcion" name="porcion" placeholder="Porcion" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <div class="col-sm-offset-2">
                                                <div class="col-sm-6">
                                                    <button id="btn-Agregar" name="btn-Agregar" type="submit" class="btn btn-success">Agregar</button>
                                                    <button id="btn-Editar" name="btn-Editar" type="submit" class="btn btn-success">Guardar</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a type="submit" name = "salir"  id="salir" class="btn btn-danger" href="fruta.php">Cacelar</a>                                    
                                                </div>
                                        </div>
                                            
                                        </div>
                                        <?php if(isset($_POST['nombre']) && isset($_POST['porcion']) && isset($_POST['btn-Agregar'])){
                                                    $ObjectDashboard->insertarFruta($_POST['nombre'], $_POST['porcion']);
                                                
                                                }else{
                                                    if(isset($_POST['nombre']) && isset($_POST['porcion']) && isset($_POST['btn-Editar'])){
                                                        $ObjectDashboard->editarFruta($_POST['nombre'], $_POST['porcion'],$id);
                                                       
                                                    }
                                                }   
                                    ?>
                                    </form>
                                   
                                
                            </div>
                        </div>
                        
                    </div>
                    
                    
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
    <script src="../js/jquery.datetimepicker.full.min.js"></script>
</body>
</html>
