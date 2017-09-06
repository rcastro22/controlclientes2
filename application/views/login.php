
<html>
	<head> 
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $page_title; ?></title>
    	<!--esto es para que pueda obtener los js. la ruta inicial-->
    	<base href='<?php echo base_url();?>' />
    	<?php echo $assets;?>
	</head>
	<body>
		<br/><br/>
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-4 col-sm-offset-3 col-lg-offset-4">
					<form action ="<?php echo site_url('sesion/index');?>" method="post" class="well form-horizontal" role="form">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="row" style="text-align:center;">
							<h2 style="color:black;">Sistema Control de Clientes</h2>
							<img src="assets/img/logosur.jpg" width='25%' align='center'/>
							<br>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon">Usuario</span>
							<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario">
						</div>
						<br/>
						<div class="input-group">	
							<span class="input-group-addon">Clave&nbsp;&nbsp;&nbsp;</span>
							<input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su clave">
						</div>
						<br/>
						<div class="form-group text-center"><button class="btn btn-negro">Ingresar</button></div>
						<br>
						<?php if (isset($login_error)):?>
							<div class="alert alert-danger text-center">
								<span><?php echo $login_error; ?></span>
							</div>
						<?php endif; ?>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>