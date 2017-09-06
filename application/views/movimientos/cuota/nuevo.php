<?php echo $headermov;?>
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
			  		<div class="panel-heading"> 
			  			<div class="row">
			  				<div class="col-sm-4">
			  						<?php echo $page_title;?>
			  				</div>
			  				<div class="col-sm-2 col-sm-offset-4">
			  						Tipo de cambio:
			  				</div>
			  				<div class="col-sm-2">
			  						<input class="form-control" type="text" id="txtTipoCambio" name="txtTipoCambio"   readonly="true"/>
			  				</div>
		  				</div>
			  		</div>
		  			<div class="panel-body">
						<form action="<?php echo site_url('movimientos/cuota/nuevo/'.$idnegociacion); ?>" method="post">
							<div class="row">								
								<div class="col-lg-12">
									<div class="form-group <?php if(form_error('fechalimitepago')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Fecha limite: </label>
										<input class="form-control" type="text" name="fechalimitepago" id="fechalimitepago" value="<?php echo set_value('fechalimitepago'); ?>" maxlength="30">
										<?php echo form_error('fechalimitepago','<div class="help-block" >','</div>'); ?>
									</div>
								</div>								
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="form-group <?php if(form_error('pagocalculado')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Pago calculado: </label>
										<input class="form-control" type="text" name="pagocalculado" id="pagocalculado" value="<?php echo set_value('pagocalculado'); ?>" maxlength="30">
										<?php echo form_error('pagocalculado','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<!--<div class="col-lg-6">
									<div class="form-group <?php if(form_error('pagoefectuado')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Pago efectuado: </label>
										<input class="form-control" readonly type="text" name="pagoefectuado" id="pagoefectuado" value="<?php echo set_value('pagoefectuado'); ?>" maxlength="30">
										<?php echo form_error('pagoefectuado','<div class="help-block" >','</div>'); ?>
									</div>
								</div>-->						
							</div>

							<div class="row">								
								<div class="col-lg-12">
									<div class="form-group <?php if(form_error('moracalculada')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Mora calculada: </label>
										<input class="form-control" type="text" name="moracalculada" id="moracalculada" value="<?php echo set_value('moracalculada'); ?>" maxlength="30">
										<?php echo form_error('moracalculada','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<!--<div class="col-lg-4">
									<div class="form-group <?php if(form_error('morapagada')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Mora pagada: </label>
										<input class="form-control" readonly type="text" name="morapagada" id="morapagada" value="<?php echo set_value('morapagada'); ?>" maxlength="30">
										<?php echo form_error('morapagada','<div class="help-block" >','</div>'); ?>
									</div>
								</div>-->
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

	<div>
		<div class="modal fade" id="modalConversion">
			<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title">Conversión Q -> $</h4>
			      </div>
			      <div class="modal-body">
			      	<div>
				      	<label>Quetzales:</label>
				        <input class="form-control" id="txtQuetzales" name="txtQuetzalez" type="number"/>
				      
				        <input id="txtNomCampo" name="txtNomCampo" type="hidden"/>
			    	</div>
			      </div>
			      <div class="modal-footer">
			        
			        <button type="button" id="botonConvertir" name="botonConvertir" class="btn btn-primary">Convertir</button>
			      </div>
			    </div><!-- /.modal-content -->
		  	</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/nuevo.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=proyectos]').focus();
		$('#fechalimitepago').datepicker({'format':'yyyy-mm-dd'});
	</script>

