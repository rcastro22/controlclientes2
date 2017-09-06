<?php echo $headercat;?>
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
			<div class="col-lg-10 col-lg-offset-1" >
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading" > <?php echo $page_title;?>  </div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('catalogos/proyecto/edit'); ?>" method="post">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
												value="<?php echo $this->security->get_csrf_hash(); ?>">
								<div class="row">
									<div class="col-lg-3 col-lg-offset-1">
										<div class="form-group <?php if(form_error('idproyecto')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Código: </label>
											<input class="form-control" readonly type="text" name="idproyecto" id="idproyecto" value="<?php echo $datosproyecto->idproyecto; ?>" maxlength="30">
											<?php echo form_error('idproyecto','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-7 col-lg-offset-1">
										<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Nombre: </label>
											<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $datosproyecto->nombre; ?>" maxlength="30">
											<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								</div>
								<div class="row">
	                  					<div class="col-lg-3  col-lg-offset-1">
		                  					<div class="form-group <?php if(form_error('dialimite')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Día inicio mora: </label>
												<input class="form-control" type="text" name="dialimite" id="dialimite" value="<?php echo $datosproyecto->dialimite; ?>" maxlength="2">
												<?php echo form_error('dialimite','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-3  col-lg-offset-1">
		                  					<div class="form-group <?php if(form_error('porcentajemora')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Porcentaje de mora (%): </label>
												<input class="form-control" type="text" name="porcentajemora" id="porcentajemora" value="<?php echo $datosproyecto->porcentajemora; ?>" maxlength="6">
												<?php echo form_error('porcentajemora','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-3  col-lg-offset-1">
	                  					<div class="form-group <?php if(form_error('valortipocambio')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Tipo de cambio: </label>
											<input class="form-control" type="text" name="valortipocambio" id="valortipocambio" value="<?php echo $datosproyecto->valortipocambio; ?>" maxlength="6">
											<?php echo form_error('valortipocambio','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									</div>
								<div class="row">
                  					<div class="col-lg-3 col-lg-offset-1">
	                  					<div class="form-group <?php if(form_error('finca')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Finca: </label>
											<input class="form-control" type="text" name="finca" id="finca" value="<?php echo $datosproyecto->finca; ?>" maxlength="10">
											<?php echo form_error('finca','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-3  col-lg-offset-1">
	                  					<div class="form-group <?php if(form_error('folio')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Folio: </label>
											<input class="form-control" type="text" name="folio" id="folio" value="<?php echo $datosproyecto->folio; ?>" maxlength="10">
											<?php echo form_error('folio','<div class="help-block" >','</div>'); ?>
										</div>
									</div>	
									<div class="col-lg-3  col-lg-offset-1">
	                  					<div class="form-group <?php if(form_error('libro')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Libro: </label>
											<input class="form-control" type="text" name="libro" id="libro" value="<?php echo $datosproyecto->libro; ?>" maxlength="10">
											<?php echo form_error('libro','<div class="help-block" >','</div>'); ?>
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
	<div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=nombre]').focus();
	</script>