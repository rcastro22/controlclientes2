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
						<form action="<?php echo site_url('movimientos/aporte/nuevo'); ?>" method="post">											

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<input type="hidden" name="hproyecto" id="hproyecto" value="<?php echo $datosaporte->idproyecto; ?>" />
										<label class="control-label" for="name"> Proyecto: </label>
										<select class="form-control" name="proyectos" id="proyectos"></select>										
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<input type="hidden" name="hinversionista" id="hinversionista" value="<?php echo $datosaporte->idinversionista; ?>" />
										<label class="control-label" for="name"> Inversionista: </label>
										<select class="form-control" name="inversionista" id="inversionista"></select>										
									</div>
								</div>								
							</div>
							
							
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group <?php if(form_error('fecha')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Fecha: </label>
										<input class="form-control" type="text" name="fecha" id="fecha" value="<?php echo set_value('fecha'); ?>" maxlength="10">
										<?php echo form_error('fecha','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
						
								<div class="col-lg-2">
									<div class="form-group <?php if(form_error('periodomeses')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Período (meses): </label>
										<input class="form-control" type="text" name="periodomeses" id="periodomeses" value="<?php echo set_value('periodomeses'); ?>" maxlength="10">
										<?php echo form_error('periodomeses','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							
								<div class="col-lg-3">
									<div class="form-group <?php if(form_error('monto')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Monto: </label>
										<div class="input-group">
										<span id="spanmonto" name="spanmonto" class="input-group-addon">$.</span>
										<input class="form-control" type="text" name="monto" id="monto" value="<?php echo set_value('monto'); ?>" maxlength="10">
										</div>
										<?php echo form_error('monto','<div class="help-block" >','</div>'); ?>										
									</div>
								</div>
							
								<div class="col-lg-2">
									<div class="form-group <?php if(form_error('interes')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Interés (%): </label>
										<input class="form-control" type="text" name="interes" id="interes" value="<?php echo set_value('interes'); ?>" maxlength="10">
										<?php echo form_error('interes','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							
								<div class="col-lg-3">
									<div class="form-group <?php if(form_error('formapagomeses')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Forma de pago interés (meses): </label>
										<input class="form-control" type="text" name="formapagomeses" id="formapagomeses" value="<?php echo set_value('formapagomeses'); ?>" maxlength="10">
										<?php echo form_error('formapagomeses','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>

							<div style="text-align:center">
								<!--<input type="button" class="btn btn-lg btn-negro" id="guardar" value="Guardar y generar pagos de la negociación"> -->
								<button class="btn btn-lg btn-negro" id="guardar">Guardar y generar pagos del aporte</button>
							</div>
						</form>


					</div>
    				
				</div>
			</div>
		</div>
	</div>

	<div>
		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title">Confirmación</h4>
			      </div>
			      <div class="modal-body">
			        <p>Desea agregar otro registro? &hellip;</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" id="botonListado" name="botonListado" class="btn btn-default" data-dismiss="modal">No</button>
			        <button type="button" id="botonRedirigir" name="botonredirigir" class="btn btn-primary">Si</button>
			      </div>
			    </div><!-- /.modal-content -->
		  	</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
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
	<script src="<?php echo base_url().'assets/js/movimientos/aportes/nuevo.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('select[name=proyectos]').focus();
		$('#fecha').datepicker({'format':'yyyy-mm-dd'});
	</script>

