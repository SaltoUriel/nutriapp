<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Startmin - Bootstrap Admin Theme</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
       
    </head>
    <body>

        <!-- Form-->
        <div class="form">
                       
        <div class="form-toggle"></div>
        <div class="form-panel one">
            <div class="form-header">
            <h1>NutriApp</h1>
            </div>
            <div class="form-content">
            <form method="post">
                <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="correo" required="required" autofocus/>
                </div>
                <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="contrasena" required="required"/>
                </div>
                <div class="form-group">
                <label class="form-remember">
                    <input type="checkbox"/>Remember Me
                </label><a class="form-recovery" href="#">Forgot Password?</a>
                </div>
                <div class="form-group">
                <button type="submit" href="index.php"name="login">Iniciar Sesión</button>
                         <?php 
                            if(isset($_POST) && isset($_POST['login'])) {
                                include_once 'php/coneccion.php';
                                $ObjectDashboard->login($_POST);
                            }
                        ?>
                </div>
            </form>
            </div>
        </div>
        <div class="form-panel two">
            <div class="form-header">
            <h1>Registrar nuevo usuario</h1>
            </div>
            <div class="form-content">
            <form>
                <div class="form-group">
                <label for="username">Nombre completo</label>
                <input type="text" id="username" name="username" required="required"/>
                </div>
                <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required="required"/>
                </div>
                <div class="form-group">
                <label for="cpassword">Confirmar contraseña</label>
                <input type="password" id="cpassword" name="cpassword" required="required"/>
                </div>
                <div class="form-group">
                <label for="email">Correo electronico</label>
                <input type="email" id="email" name="email" required="required"/>
                </div>
                <div class="form-group">
                <button type="submit">Registar</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        

        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>
