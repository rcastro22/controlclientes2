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
			  	<!-- Default panel contents -->
			  		<div class="panel-heading" > <?php echo $page_title;?>  </div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('catalogos/inmueble/nuevo'); ?>" method="post">
				
								<!--<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">
								-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<input type="hidden" name="hproyecto" id="hproyecto" value="<?php echo $datosinmueble->idproyecto; ?>" />
											<label class="control-label" for="name"> Código proyecto: </label>
											<select class="form-control" name="proyectos" id="proyectos"></select>										
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('idinmueble')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Código inmueble: </label>
											<input class="form-control" type="text" name="idinmueble" id="idinmueble" value="<?php echo set_value('idinmueble'); ?>" maxlength="20">
											<?php echo form_error('idinmueble','<div class="help-block" >','</div>'); ?>
										</div>
									</div>									
								</div>
								<div class="row">
									<div class="col-lg-6">										
										<div class="form-group">
											<input type="hidden" name="htipoinmueble" id="htipoinmueble" value="<?php echo $datosinmueble->idtipoinmueble; ?>" />
											<label class="control-label" for="name"> Código tipo inmueble: </label>
											<select class="form-control" name="tiposinmueble" id="tiposinmueble"></select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="hidden" name="hmodelo" id="hmodelo" value="<?php echo $datosinmueble->idmodelo; ?>" />
											<label class="control-label" for="name"> Código modelo: </label>
											<select class="form-control" name="modelos" id="modelos"></select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('tamano')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Tamaño (metros cuadrados): </label>
											<input class="form-control" type="text" name="tamano" id="tamano" value="<?php echo set_value('tamano'); ?>" maxlength="10">
											<?php echo form_error('tamano','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('preciometro2')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Precio metro cuadrado: </label>
											<input class="form-control" type="text" name="preciometro2" id="preciometro2" value="<?php echo set_value('preciometro2'); ?>" maxlength="10">
											<?php echo form_error('preciometro2','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('dormitorios')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Dormitorios: </label>
											<input class="form-control" type="text" name="dormitorios" id="dormitorios" value="<?php echo set_value('dormitorios'); ?>" maxlength="10">
											<?php echo form_error('dormitorios','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('sotano')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nivel: </label>
											<input class="form-control" type="text" name="sotano" id="sotano" value="<?php echo set_value('sotano'); ?>" maxlength="5">
											<?php echo form_error('sotano','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								</div>

								<div class="row">
                  					<div class="col-lg-4 ">
	                  					<div class="form-group <?php if(form_error('finca')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Finca: </label>
											<input class="form-control" type="text" name="finca" id="finca" value="<?php echo set_value('finca'); ?>" maxlength="10">
											<?php echo form_error('finca','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4">
	                  					<div class="form-group <?php if(form_error('folio')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Folio: </label>
											<input class="form-control" type="text" name="folio" id="folio" value="<?php echo set_value('folio'); ?>" maxlength="10">
											<?php echo form_error('folio','<div class="help-block" >','</div>'); ?>
										</div>
									</div>	
									<div class="col-lg-4">
	                  					<div class="form-group <?php if(form_error('libro')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Libro: </label>
											<input class="form-control" type="text" name="libro" id="libro" value="<?php echo set_value('libro'); ?>" maxlength="10">
											<?php echo form_error('libro','<div class="help-block" >','</div>'); ?>
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
	<script type="text/javascript">
	var nuevo = "<?php echo $nuevo ?>";		
	
	if(nuevo == "preguntar") 
	{
		$('#myModal').modal('toggle');
	}
		
	</script>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/catalogos/inmueble/nuevo.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=idinmueble]').focus();
	</script>
