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
          REPORTES
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
            <!--<li class="<?php echo $activo=='flujo'?'active':''; ?>"><a href="<?php echo base_url().'reportes/proyeccionflujo/repProyeccionFlujo';?>">Proyección del flujo</a></li>-->
            <li class="<?php echo $activo=='morosos'?'active':''; ?>"><a href="<?php echo base_url().'reportes/clientesmorosos/repClientesMorosos';?>">Clientes morosos</a></li>
            <li class="<?php echo $activo=='flujoproyectado'?'active':''; ?>"><a href="<?php echo base_url().'reportes/flujopagosproyectado/repFlujoPagosProy';?>">Flujo de pagos proyectados</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Flujo de Pagos Efectuados<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="<?php echo $activo=='flujoefectuado'?'active':''; ?>"><a href="<?php echo base_url().'reportes/flujopagosefectuado/repFlujoPagosProy';?>">Clientes</a></li>
                <li class="<?php echo $activo=='flujoefectuadoinv'?'active':''; ?>"><a href="<?php echo base_url().'reportes/flujopagosefectuado/repFlujoPagosProyInv';?>">Inversionistas</a></li>
              </ul>
            </li>
            
            <li class="<?php echo $activo=='flujoefecproy'?'active':''; ?>"><a href="<?php echo base_url().'reportes/flujopagosefecproy/repFlujoPagosProy';?>">Flujo de pagos</a></li>
            
          
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Estados de cuenta<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="<?php echo $activo=='estadocuenta'?'active':''; ?>"><a href="<?php echo base_url().'reportes/estadocuenta/repEstadoCuenta';?>">Estado de cuenta</a></li>
                <li class="<?php echo $activo=='estadocuenta'?'active':''; ?>"><a href="<?php echo base_url().'reportes/estadocuentainv/repEstadoCuentaInv';?>">Estado de cuenta inversionistas</a></li>
              </ul>
            </li>
      
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

