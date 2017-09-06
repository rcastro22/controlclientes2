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
							
							<form action="<?php echo site_url('movimientos/cliente/edit'); ?>" method="post">
				
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">
							
								<div class="row">
									<div class="col-lg-1">
										<div class="form-group <?php if(form_error('idcliente')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Cliente: </label>
											<input class="form-control" readonly type="text" name="idcliente" id="idcliente" value="<?php echo $datoscliente->idcliente; ?>" maxlength="30">
											<?php echo form_error('idcliente','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-5">
										<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nombre: </label>
											<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $datoscliente->nombre; ?>" maxlength="40">
											<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('apellido')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Apellido: </label>
											<input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $datoscliente->apellido; ?>" maxlength="40">
											<?php echo form_error('apellido','<div class="help-block" >','</div>'); ?>
										</div>
									</div>									
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('dpi')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> DPI: </label>
											<input class="form-control" type="text" name="dpi" id="dpi" value="<?php echo $datoscliente->dpi; ?>" maxlength="13">
											<?php echo form_error('dpi','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('fecnacimiento')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Fecha de nacimiento: </label>
											<input class="form-control" type="text" name="fecnacimiento" id="fecnacimiento" value="<?php echo $datoscliente->fecnacimiento; ?>" maxlength="30">
											<?php echo form_error('fecnacimiento','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('profesion')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Profesión: </label>
											<input class="form-control" type="text" name="profesion" id="profesion" value="<?php echo $datoscliente->profesion; ?>" maxlength="100">
											<?php echo form_error('profesion','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('nacionalidad')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nacionalidad: </label>
											<input class="form-control" type="text" name="nacionalidad" id="nacionalidad" value="<?php echo $datoscliente->nacionalidad; ?>" maxlength="30">
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
											<input class="form-control" type="text" name="estadocivil" id="estadocivil" value="<?php echo $datoscliente->estadocivil; ?>" maxlength="1">
											<?php echo form_error('estadocivil','<div class="help-block" >','</div>'); ?>
										</div>
									</div>-->
								</div>

								<div class="row">
									<div class="col-lg-10">
										<div class="form-group <?php if(form_error('dirresidencia')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Dirección de residencia: </label>
											<input class="form-control" type="text" name="dirresidencia" id="dirresidencia" value="<?php echo $datoscliente->dirresidencia; ?>" maxlength="100">
											<?php echo form_error('dirresidencia','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('telefono')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Teléfono: </label>
											<input class="form-control" type="tel" name="telefono" id="telefono" value="<?php echo $datoscliente->telefono; ?>" maxlength="30">
											<?php echo form_error('telefono','<div class="help-block" >','</div>'); ?>
										</div>
									</div>									
								</div>

								<div class="row">
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('celular')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Celular: </label>
											<input class="form-control" type="text" name="celular" id="celular" value="<?php echo $datoscliente->celular; ?>" maxlength="30">
											<?php echo form_error('celular','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('nit')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nit: </label>
											<input class="form-control" type="text" name="nit" id="nit" value="<?php echo $datoscliente->nit; ?>" maxlength="15">
											<?php echo form_error('nit','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('lugartrabajo')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Lugar de trabajo: </label>
											<input class="form-control" type="text" name="lugartrabajo" id="lugartrabajo" value="<?php echo $datoscliente->lugartrabajo; ?>" maxlength="100">
											<?php echo form_error('lugartrabajo','<div class="help-block" >','</div>'); ?>
										</div>
									</div>									
								</div>

								<div class="row">
									<div class="col-lg-8">
										<div class="form-group <?php if(form_error('dirtrabajo')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Dirección de trabajo: </label>
											<input class="form-control" type="text" name="dirtrabajo" id="dirtrabajo" value="<?php echo $datoscliente->dirtrabajo; ?>" maxlength="100">
											<?php echo form_error('dirtrabajo','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('tiempolabor')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Tiempo de laborar: </label>
											<input class="form-control" type="text" name="tiempolabor" id="tiempolabor" value="<?php echo $datoscliente->tiempolabor; ?>" maxlength="10">
											<?php echo form_error('tiempolabor','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('ingresos')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Ingresos: </label>
											<div class="input-group">
											<span class="input-group-addon">$.</span>
											<input class="form-control" type="text" name="ingresos" id="ingresos" value="<?php echo $datoscliente->ingresos; ?>" maxlength="10">
											<?php echo form_error('ingresos','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
									</div>									
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('puesto')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Puesto: </label>
											<input class="form-control" type="text" name="puesto" id="puesto" value="<?php echo $datoscliente->puesto; ?>" maxlength="75">
											<?php echo form_error('puesto','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('otrosingresos')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Otros ingresos: </label>
											<div class="input-group">
											<span class="input-group-addon">$.</span>
											<input class="form-control" type="text" name="otrosingresos" id="otrosingresos" value="<?php echo $datoscliente->otrosingresos; ?>" maxlength="10">
											<?php echo form_error('otrosingresos','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group <?php if(form_error('concepto')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Concepto: </label>
											<input class="form-control" type="text" name="concepto" id="concepto" value="<?php echo $datoscliente->concepto; ?>" maxlength="100">
											<?php echo form_error('concepto','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								</div>
								
								<div style="text-align:center">
									<button class="btn btn-lg btn-negro">Modificar</button>
								</div>
							</form>


						</div>
    				
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script>
	<script src="<?php echo base_url().'assets/js/movimientos/clientes/nuevo.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=nombre]').focus();
		$('#fecnacimiento').datepicker({'format':'yyyy-mm-dd'});
	</script>