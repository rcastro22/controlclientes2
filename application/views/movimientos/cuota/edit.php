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
			  		<div class="panel-heading panel-heading-extras" > <?php echo $page_title;?>  </div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('movimientos/cuota/edit/'.$idnegociacion.'/'.$nopagos); ?>" method="post">
				
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">

								<div class="row">								
									<div class="col-lg-12">
										<div class="form-group <?php if(form_error('nopago')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Número de pago: </label>
											<input class="form-control" readonly type="text" name="nopago" id="nopago" value="<?php echo $datoscuota->nopago; ?>" maxlength="30">
											<?php echo form_error('nopago','<div class="help-block" >','</div>'); ?>
										</div>
									</div>								
								</div>

								<div class="row">								
									<div class="col-lg-12">
										<div class="form-group <?php if(form_error('fechalimitepago')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Fecha limite: </label>
											<input class="form-control" type="text" name="fechalimitepago" id="fechalimitepago" value="<?php echo $datoscuota->fechalimitepago; ?>" maxlength="30">
											<?php echo form_error('fechalimitepago','<div class="help-block" >','</div>'); ?>
										</div>
									</div>								
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="form-group <?php if(form_error('pagocalculado')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Pago calculado: </label>
											<input class="form-control" type="text" name="pagocalculado" id="pagocalculado" value="<?php echo $datoscuota->pagocalculado; ?>" maxlength="30">
											<?php echo form_error('pagocalculado','<div class="help-block" >','</div>'); ?>
										</div>
									</div>														
								</div>

								<div class="row">								
									<div class="col-lg-12">
										<div class="form-group <?php if(form_error('moracalculada')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Mora calculada: </label>
											<input class="form-control" type="text" name="moracalculada" id="moracalculada" value="<?php echo $datoscuota->moracalculada; ?>" maxlength="30">
											<?php echo form_error('moracalculada','<div class="help-block" >','</div>'); ?>
										</div>
									</div>								
								</div>								
								
								<div style="text-align:center">
									<button class="btn btn-lg btn-negro" id="modificar">Modificar</button>
								</div>
							</form>
							
						</div>
    					<div style="text-align:center">
							<div class="pagination">
								<ul class="pagination pagination-centered" data-tabla="gvBuscar" data-cantidad="10" data-grupo="8"></ul>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script>
	<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/edit.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=enganche]').focus();
		$('#fechalimitepago').datepicker({'format':'yyyy-mm-dd'});
	</script>