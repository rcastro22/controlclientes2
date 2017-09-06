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
			  		<div class="panel-heading" > <?php echo $page_title;?>  </div>
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
								<div class="checkbox">
								    <label>
										<input class="form-control" type="hidden" name="tusuario" id="tusuario" value="<?php echo $datosusuario->tipousuario; ?>" maxlength="30">
										<input id="tipousuario" type="checkbox"> Usuario Administrador
								    </label>
								</div>
								
								<!--<div class="form-group <?php if(form_error('clave')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Contraseña: </label>
									<input class="form-control" type="password" name="clave" id="clave" value="<?php echo $datosusuario->clave; ?>" maxlength="30">
									<?php echo form_error('clave','<div class="help-block" >','</div>'); ?>
								</div>-->
								
								<div style="text-align:center">
									<button class="btn btn-lg btn-negro">Modificar</button>
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
		if($('#tusuario').val() == "0"){
			document.getElementById('tipousuario').checked = false;
		}
		else if($('#tusuario').val() == "1"){
			document.getElementById('tipousuario').checked = true;
		}

		$('input[name=nombre]').focus();

		$('#tipousuario').on('change',function(){
			if(this.checked == false)
				$('#tusuario').val("0");
			else if(this.checked == true)
				$('#tusuario').val("1");
		})
	</script>