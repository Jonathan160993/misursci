<?php

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mi Sur SCI |Sistema de Control de Inventario| </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../publico/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../publico/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../publico/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../publico/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../publico/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../publico/img/favicon.ico">
    
   
    <link rel="stylesheet" type="text/css" href="../publico/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../publico/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../publico/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../publico/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Mi</b>Sur</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Mi Sur</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!--img src="../publico/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"-->
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                 <!--     <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                    <p>
                     www.misursci.com || Siatema de Control de Inventario
                    </p>
                  </li>
                      <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuarioajax.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            <?php
            if ($_SESSION['escritorio']==1) 
            {
              echo '<li>
              <a href="#">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>';
            }
            ?>  
            
            <?php  //seciones para mostrar
            if ($_SESSION['almacen']==1) 
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="productov.php"><i class="fa fa-circle-o"></i>Productos</a></li>
                <li><a href="materias.php"><i class="fa fa-circle-o"></i> Materias Primas</a></li>
              </ul>
            </li>';
            }
            ?>  

            <?php
            if ($_SESSION['administracion']==1) 
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Adminstracion</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Clientev.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="Rutav.php"><i class="fa fa-circle-o"></i> Ruta</a></li>
                <li><a href="Zonav.php"><i class="fa fa-circle-o"></i> Zonas</a></li>
              </ul>
            </li>';
            }
            ?>
            
            <?php
            if ($_SESSION['empleados']==1) 
            {
              echo '  <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Empleados</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Ventav.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="Clientev.php"><i class="fa fa-circle-o"></i> Clientes Nuevos</a></li>
              </ul>
            </li> ';
            }
            ?>  


            <?php
            if ($_SESSION['acceso']==1) 
            {
              echo '<li class="treeview">                                                                    
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Usuariov.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="Permisosv.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                
              </ul>
            </li>';
            }
            ?>  
            
                               
            <?php
            if($_SESSION['acceso']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Cventasv.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
              </ul>
            </li>';
            }
            ?>
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>