<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">

		<!-- esta linea fue agregada para que lo pueda obtener el jquery de galileo.js-->
		<!--<base href='<?php echo base_url();?>' />-->

		<?php echo $assets;?>
		<title><?php echo $page_title; ?></title>
    <!--esto es para que pueda obtener los js. la ruta inicial-->
    <base href='<?php echo base_url();?>' />

	</head>
	<body style="padding-top:70px;">
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <!-- Collect the nav links, forms, and other content fo r toggling -->

      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <a class="navbar-brand" style="padding-top: 4px; padding-bottom: 0; vertical-align: middle;">
        <img src="<?php echo base_url() . 'assets/img/logosur.jpg'; ?>" alt="Logo"
          style="height: 50px;" class="pull-left"/>
        </a>
        <p style="float: left;padding: 15px 15px;font-size: 18px;line-height: 20px;color:white;">
          SISTEMA DE CONTROL DE CLIENTES
        </p> 
      
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $usuario;?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('clave/cambiar');?>">Cambiar contraseña</a></li>
              <li><a href="<?php echo site_url('sesion/finalizar');?>">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>