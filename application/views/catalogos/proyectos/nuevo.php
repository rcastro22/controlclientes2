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
							
							<form action="<?php echo site_url('catalogos/proyecto/nuevo'); ?>" method="post">
								<div class="row">
									<div class="col-lg-10 col-lg-offset-1">
										<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> nombre: </label>
											<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value('nombre'); ?>" maxlength="30">
											<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
										</div>
									<div>
								</div>
								<div class="row">
                  					<div class="col-lg-3 ">
	                  					<div class="form-group <?php if(form_error('dialimite')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Día del mes en que inicia la mora: </label>
											<input class="form-control" type="text" name="dialimite" id="dialimite" value="<?php echo set_value('dialimite'); ?>" maxlength="2">
											<?php echo form_error('dialimite','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-3  col-lg-offset-1">
	                  					<div class="form-group <?php if(form_error('porcentajemora')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Porcentaje de mora (%): </label>
											<input class="form-control" type="text" name="porcentajemora" id="porcentajemora" value="<?php echo set_value('porcentajemora'); ?>" maxlength="6">
											<?php echo form_error('porcentajemora','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4  col-lg-offset-1">
	                  					<div class="form-group <?php if(form_error('valortipocambio')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Tipo de cambio: </label>
											<input class="form-control" type="text" name="valortipocambio" id="valortipocambio" value="<?php echo set_value('valortipocambio'); ?>" maxlength="6">
											<?php echo form_error('valortipocambio','<div class="help-block" >','</div>'); ?>
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
									<div class="col-lg-3  col-lg-offset-1">
	                  					<div class="form-group <?php if(form_error('folio')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Folio: </label>
											<input class="form-control" type="text" name="folio" id="folio" value="<?php echo set_value('folio'); ?>" maxlength="10">
											<?php echo form_error('folio','<div class="help-block" >','</div>'); ?>
										</div>
									</div>	
									<div class="col-lg-3  col-lg-offset-1">
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
	<div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=nombre]').focus();
	</script>
