<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <!-- <a class="navbar-brand" href="#">Startmin</a> -->
        </div>
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i><?php @session_start(); echo $_SESSION['username']; ?><b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                  <!--   <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li> -->
                    <!-- <li class="divider"></li> -->
                    <li><a href="../php/logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir de sesión</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation" style="overflow: auto;">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu" >
                    <li>
                        <a href="index" class="active"><!-- <i class="fa fa-globe fa-fw"></i>  --> <center>Dashboard</center></a>
                    </li>
                    <?php  @session_start(); echo utf8_decode($_SESSION['navbar']); ?>
                </ul>
            </div>
        </div>
    </nav>

    