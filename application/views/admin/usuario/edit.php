<?php echo $headeradmin;?>
   <div class="row" style="display:<?php if (!isset($mensaje) || $mensaje=="") echo "none"; ?>">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="alert <?php echo $tipoAlerta;?>">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<?php echo $mensaje;?>	
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3" >
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading" > <?php echo $page_title;?> 
			  			<!--<button id="resetpass" class="btn btn-warning pull-right" style="padding-top: 0; padding-bottom: 0; vertical-align: middle;">Reiniciar contraseña</button>-->
			  		</div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('admin/usuario/edit'); ?>" method="post">
				
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">
							
								<div class="form-group <?php if(form_error('idusario')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Código: </label>
									<input class="form-control" readonly type="text" name="idusuario" id="idusuario" value="<?php echo $datosusuario->idusuario; ?>" maxlength="30">
									<?php echo form_error('idusuario','<div class="help-block" >','</div>'); ?>
								</div>
								<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Nombre: </label>
									<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $datosusuario->nombre; ?>" maxlength="30">
									<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
								</div>
								<div class="form-group <?php if(form_error('apellido')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Apellido: </label>
									<input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $datosusuario->apellido; ?>" maxlength="30">
									<?php echo form_error('apellido','<div class="help-block" >','</div>'); ?>
								</div>
								
								<label class="control-label" for="name"> Tipo de usuario: </label>
								<div>

									<label class="radio-inline">
									 	<input type="radio" name="tipusuario" id="inlineRadio1" value="0" checked="true"> Usuario
									</label>
									<label class="radio-inline">
									  	<input type="radio" name="tipusuario" id="inlineRadio2" value="2"> Ventas
									</label>
									<label class="radio-inline">
									  	<input type="radio" name="tipusuario" id="inlineRadio3" value="1"> Administrador
									</label>
								</div>

								<input class="form-control" type="hidden" name="tusuario" id="tusuario" value="<?php echo $datosusuario->tipousuario; ?>" maxlength="30">

								<!--<div class="checkbox">
								    <label>
										
										<input id="tipousuario" type="checkbox"> Usuario Administrador
								    </label>
								</div>-->
								
								<!--<div class="form-group <?php if(form_error('clave')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Contraseña: </label>
									<input class="form-control" type="password" name="clave" id="clave" value="<?php echo $datosusuario->clave; ?>" maxlength="30">
									<?php echo form_error('clave','<div class="help-block" >','</div>'); ?>
								</div>-->
								<br/>
								<div style="text-align:center">
									<button class="btn btn-lg btn-negro" id="modificar" name="modificar">Modificar</button>

									<button class="btn btn-lg btn-info" id="cambiarclave" name="cambiarclave" >Cambiar contraseña</button>
								</div>
							</form>


						</div>
    				
				</div>
			</div>
		</div>
	<div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[value=' + $('#tusuario').val() + ']').attr('checked','true');

		$('input[name=nombre]').focus();

		$('input[name=tipusuario]').on('change',function() {
			$('#tusuario').val($(this).val());
		})

	</script>