<?php echo $headercat;?>
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
			  		<div class="panel-heading" > 
			  			<?echo $page_title;?>  
			  		</div>
		  			<div class="panel-body">
		  				<form action="<?php echo site_url('catalogos/cliente/nuevo'); ?>" method="post">
		  					<div class="row">
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteNit')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> NIT: </label>
										<input class="form-control" type="text" name="ClienteNit" id="ClienteNit" value="<?php echo set_value('ClienteNit'); ?>" maxlength="12">
										<?php echo form_error('ClienteNit','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-10" >
									<div class="form-group <?php if(form_error('ClienteNombre')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Nombre/Nombre Comercial: </label>
										<input class="form-control" type="text" name="ClienteNombre" id="ClienteNombre" value="<?php echo set_value('ClienteNombre'); ?>" maxlength="50">
										<?php echo form_error('ClienteNombre','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-7" >
									<div class="form-group <?php if(form_error('ClienteDireccion')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Dirección: </label>
										<input class="form-control" type="text" name="ClienteDireccion" id="ClienteDireccion" value="<?php echo set_value('ClienteDireccion'); ?>" maxlength="100">
										<?php echo form_error('ClienteDireccion','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-5" >
									<div class="form-group <?php if(form_error('ClienteTelefonos')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Teléfonos: </label>
										<input class="form-control" type="text" name="ClienteTelefonos" id="ClienteTelefonos" value="<?php echo set_value('ClienteTelefonos'); ?>" maxlength="100">
										<?php echo form_error('ClienteTelefonos','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="row">	
								<div class="col-lg-7" >
									<div class="form-group <?php if(form_error('ClienteContacto')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Contacto: </label>
										<input class="form-control" type="text" name="ClienteContacto" id="ClienteContacto" value="<?php echo set_value('ClienteContacto'); ?>" maxlength="100">
										<?php echo form_error('ClienteContacto','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-5" >
									<div class="form-group <?php if(form_error('ClienteEmail')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> E-Mail: </label>
										<input class="form-control" type="text" name="ClienteEmail" id="ClienteEmail" value="<?php echo set_value('ClienteEmail'); ?>" maxlength="100">
										<?php echo form_error('ClienteEmail','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteCreditoLimite')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Límite Crédito: </label>
										<input class="form-control" type="text" name="ClienteCreditoLimite" id="ClienteCreditoLimite" value="<?php echo set_value('ClienteCreditoLimite'); ?>" maxlength="10" style="text-align:right;">
										<?php echo form_error('ClienteCreditoLimite','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteCreditoDias')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Días Crédito: </label>
										<input class="form-control" type="text" name="ClienteCreditoDias" id="ClienteCreditoDias" value="<?php echo set_value('ClienteCreditoDias'); ?>" maxlength="4">
										<?php echo form_error('ClienteCreditoDias','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-3" >
									<div class="form-group">
										<input type="hidden" name="hlista" id="hlista" value="<?php echo $datosclientes->ClienteListaID; ?>" />
	                     				<label class="control-label" for="name"> Lista de Precios: </label>
	                     				<select class="form-control"  name="listas" id="listas"></select>
	                  				</div>
	                  			</div>
	                  			<div class="col-lg-3" >
									<div class="form-group">
										<input type="hidden" name="hvendedor" id="hvendedor" value="<?php echo $datosclientes->ClienteVendedorID; ?>" />
	                     				<label class="control-label" for="vendedor">Vendedor:</label>
	                     				<select class="form-control"  name="vendedores" id="vendedores"></select>
	                  				</div>
	                  			</div>
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteComision')) echo 'has-error'; ?>">
										<label class="control-label" for="name"  class="text-center"> Comisión: </label>
										<input class="form-control" type="checkbox" name="ClienteComision" id="ClienteComision" <?php  if(set_value('ClienteComision')=="1") echo "checked";?> value="1" maxlength="50" checked>
										<?php echo form_error('ClienteComision','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-10" >
									<div class="form-group <?php if(form_error('ClienteObservaciones')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Observaciones: </label>
										<textarea class="form-control" rows="3" name="ClienteObservaciones" id="ClienteObservaciones" value="<?php echo set_value('ClienteObservaciones'); ?>"></textarea>
										<!-- <input class="form-control" type="text" name="ClienteObservaciones" id="ClienteObservaciones" value="<?php echo set_value('ClienteObservaciones'); ?>" maxlength="255"> -->
										<?php echo form_error('ClienteObservaciones','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteStatus')) echo 'has-error'; ?>" >
										<label class="control-label" for="name"> Status: </label>
										<input class="form-control" type="checkbox" name="ClienteStatus" id="ClienteStatus" <?php  if(set_value('ClienteStatus')=="1") echo "checked";?> value="1" maxlength="50" checked>
										<?php echo form_error('ClienteStatus','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div style="text-align:center">
								<button class="btn btn-lg btn-negro">Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/catalogos/clientes/nuevo.js';?>"></script> 
<?php echo $footer;?>

