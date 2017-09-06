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
			  		<div class="panel-heading" > <?php echo $page_title;?>  </div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('movimientos/cliente/nuevo'); ?>" method="post">
				
								<!--<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">
								-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nombre: </label>
											<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value('nombre'); ?>" maxlength="40">
											<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('apellido')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Apellido: </label>
											<input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo set_value('apellido'); ?>" maxlength="40">
											<?php echo form_error('apellido','<div class="help-block" >','</div>'); ?>
										</div>
									</div>									
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('dpi')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> DPI: </label>
											<input class="form-control" type="text" name="dpi" id="dpi" value="<?php echo set_value('dpi'); ?>" maxlength="13">
											<?php echo form_error('dpi','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('fecnacimiento')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Fecha de nacimiento: </label>
											<input class="form-control" type="text" name="fecnacimiento" id="fecnacimiento" value="<?php echo set_value('fecnacimiento'); ?>" maxlength="30">
											<?php echo form_error('fecnacimiento','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('profesion')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Profesión: </label>
											<input class="form-control" type="text" name="profesion" id="profesion" value="<?php echo set_value('profesion'); ?>" maxlength="100">
											<?php echo form_error('profesion','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('nacionalidad')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nacionalidad: </label>
											<input class="form-control" type="text" name="nacionalidad" id="nacionalidad" value="<?php echo set_value('nacionalidad'); ?>" maxlength="30">
											<?php echo form_error('nacionalidad','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<input type="hidden" name="hestadocivil" id="hestadocivil" value="<?php echo $datoscliente->estadocivil; ?>" />
											<label class="control-label" for="name"> Estado civil: </label>
											<select class="form-control" name="estadocivil" id="estadocivil"></select>										
										</div>
									</div>
									<!--<div class="col-lg-4">
										<div class="form-group <?php if(form_error('estadocivil')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Estado civil: </label>
											<input class="form-control" type="text" name="estadocivil" id="estadocivil" value="<?php echo set_value('estadocivil'); ?>" maxlength="1">
											<?php echo form_error('estadocivil','<div class="help-block" >','</div>'); ?>
										</div>
									</div>-->

								</div>

								<div class="row">
									<div class="col-lg-10">
										<div class="form-group <?php if(form_error('dirresidencia')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Dirección de residencia: </label>
											<input class="form-control" type="text" name="dirresidencia" id="dirresidencia" value="<?php echo set_value('dirresidencia'); ?>" maxlength="100">
											<?php echo form_error('dirresidencia','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('telefono')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Teléfono: </label>
											<input class="form-control" type="tel" name="telefono" id="telefono" value="<?php echo set_value('telefono'); ?>" maxlength="30">
											<?php echo form_error('telefono','<div class="help-block" >','</div>'); ?>
										</div>
									</div>									
								</div>

								<div class="row">
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('celular')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Celular: </label>
											<input class="form-control" type="text" name="celular" id="celular" value="<?php echo set_value('celular'); ?>" maxlength="30">
											<?php echo form_error('celular','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('nit')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nit: </label>
											<input class="form-control" type="text" name="nit" id="nit" value="<?php echo set_value('nit'); ?>" maxlength="15">
											<?php echo form_error('nit','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('lugartrabajo')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Lugar de trabajo: </label>
											<input class="form-control" type="text" name="lugartrabajo" id="lugartrabajo" value="<?php echo set_value('lugartrabajo'); ?>" maxlength="100">
											<?php echo form_error('lugartrabajo','<div class="help-block" >','</div>'); ?>
										</div>
									</div>									
								</div>

								<div class="row">
									<div class="col-lg-8">
										<div class="form-group <?php if(form_error('dirtrabajo')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Dirección de trabajo: </label>
											<input class="form-control" type="text" name="dirtrabajo" id="dirtrabajo" value="<?php echo set_value('dirtrabajo'); ?>" maxlength="100">
											<?php echo form_error('dirtrabajo','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('tiempolabor')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Tiempo de laborar: </label>
											<input class="form-control" type="text" name="tiempolabor" id="tiempolabor" value="<?php echo set_value('tiempolabor'); ?>" maxlength="10">
											<?php echo form_error('tiempolabor','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('ingresos')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Ingresos: </label>
											<div class="input-group">
											<span class="input-group-addon">$.</span>
											<input class="form-control" type="text" name="ingresos" id="ingresos" value="<?php echo set_value('ingresos'); ?>" maxlength="10">
											<?php echo form_error('ingresos','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
									</div>									
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('puesto')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Puesto: </label>
											<input class="form-control" type="text" name="puesto" id="puesto" value="<?php echo set_value('puesto'); ?>" maxlength="75">
											<?php echo form_error('puesto','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('otrosingresos')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Otros ingresos: </label>
											<div class="input-group">
											<span class="input-group-addon">$.</span>
											<input class="form-control" type="text" name="otrosingresos" id="otrosingresos" value="<?php echo set_value('otrosingresos'); ?>" maxlength="10">
											<?php echo form_error('otrosingresos','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('concepto')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Concepto: </label>
											<input class="form-control" type="text" name="concepto" id="concepto" value="<?php echo set_value('concepto'); ?>" maxlength="100">
											<?php echo form_error('concepto','<div class="help-block" >','</div>'); ?>
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
	var algo = "<?php echo $nuevo ?>";		
	
	if(algo == "preguntar")
	{
		$('#myModal').modal('toggle');
	}
		
	</script>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/movimientos/clientes/nuevo.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=nombre]').focus();
		$('#fecnacimiento').datepicker({'format':'yyyy-mm-dd'});
	</script>
