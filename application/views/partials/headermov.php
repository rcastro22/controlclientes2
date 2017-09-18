<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title><?php echo $page_title; ?></title>
    <!--esto es para que pueda obtener los js. la ruta inicial-->
    <base href='<?php echo base_url();?>' />
    <?php echo $assets;?>
	</head>
	<body style="padding-top:70px;">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <!-- Collect the nav links, forms, and other content fo r toggling -->

      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">-->
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <p style="float: left;padding: 15px 15px;font-size: 18px;line-height: 20px;color:white;">
          MOVIMIENTOS
        </p>
      </div>


     <!-- <div class="container">-->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <a class="navbar-brand" style="padding-top: 4px; padding-bottom: 0; vertical-align: middle;">
          <img src="<?php echo base_url() . 'assets/img/logosur.jpg'; ?>" alt="Logo"
            style="height: 50px;" class="pull-left visible-lg visible-md"/>
          </a>
         
          <ul class="nav navbar-nav">
            <li class="<?php echo $activo=='inicio'?'active':''; ?>"><a href="<?php echo base_url().'menu';?>">
              <i class="glyphicon glyphicon-home"></i>
              <span>Inicio</span></a>
            </li>
            <li class="<?php echo $activo=='clientes'?'active':''; ?>"><a href="<?php echo base_url().'movimientos/cliente/listado';?>" style="<?php if($datosusuario->tipousuario != '1' && $datosusuario->tipousuario != '0') echo 'display:none'; ?>">Clientes</a></li>
            <li class="<?php echo $activo=='negociaciones'?'active':''; ?>"><a href="<?php echo base_url().'movimientos/negociacion/listado';?>">Negociaciones</a></li>
            <li class="<?php echo $activo=='asesores'?'active':''; ?>"><a href="<?php echo base_url().'movimientos/asesor/listado';?>" style="<?php if($datosusuario->tipousuario != '1' && $datosusuario->tipousuario != '0') echo 'display:none'; ?>">Asesores</a></li>
            <li class="<?php echo $activo=='aporte'?'active':''; ?>"><a href="<?php echo base_url().'movimientos/aporte/listado';?>" style="<?php if($datosusuario->tipousuario != '1' && $datosusuario->tipousuario != '0') echo 'display:none'; ?>">Inversionistas</a></li>
            <li class="<?php echo $activo=='aporte'?'active':''; ?>"><a href="<?php echo base_url().'movimientos/recordatoriopago/listado';?>" style="<?php if($datosusuario->tipousuario != '1' && $datosusuario->tipousuario != '0') echo 'display:none'; ?>">Recordatorio de pago</a></li>
          </ul>
        
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $usuario;?><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('clave/cambiar');?>">Cambiar contraseña</a></li>
                <li><a href="<?php echo site_url('sesion/finalizar');?>">Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      <!--</div>-->
    </nav>

