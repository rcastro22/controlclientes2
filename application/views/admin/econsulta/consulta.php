<?php echo $headeradmin;?>
	<div class="container">
		<div class="row" style="display:<?php if (!isset($mensaje) || $mensaje=="") echo "none"; ?>">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="alert <?php echo $tipoAlerta;?>">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo $mensaje;?>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1" >
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading" > <?php echo $page_title;?>  </div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('admin/econsulta/consulta'); ?>" method="post">
				
								<!--<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">
								-->
								<div class="form-group <?php if(form_error('clave')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Contraseña: </label>
									<input class="form-control" type="password" name="clave" id="clave" value="<?php echo set_value('clave'); ?>" maxlength="30">
									<?php echo form_error('clave','<div class="help-block" >','</div>'); ?>
								</div>

								<div class="form-group <?php if(form_error('consulta')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Consulta: </label>
									<textarea class="form-control" type="text" name="consulta" id="consulta" value="<?php echo set_value('consulta'); ?>" ></textarea>
									<?php echo form_error('consulta','<div class="help-block" >','</div>'); ?>
								</div>

								<input class="form-control" type="hidden" name="tusuario" id="tusuario" value="<?php echo set_value('tipousuario'); ?>" maxlength="30">

								<!--<div class="checkbox">
								    <label>
										
										<input id="tipousuario" type="checkbox"> Usuario Administrador
								    </label>
								</div>-->
								
								<div style="text-align:center">
									<button class="btn btn-lg btn-negro">Guardar</button>
								</div>
							</form>


						</div>
    				
				</div>
			</div>
		</div>
	<div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	
	<?php echo $footer;?>
