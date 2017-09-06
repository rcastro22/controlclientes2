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
			  		<div class="panel-heading" > 
			  			<?php echo $page_title;?> 
			  			<input class="form-control" type="text" name="cambiodia" id="cambiodia" readonly="true">
			  		 </div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('admin/tipocambio/nuevo'); ?>" method="post">
								<div class="form-group <?php if(form_error('valorcambio')) echo 'has-error'; ?>">
									<label class="control-label" for="name"> Valor cambio del día (Q): </label>
									<input class="form-control" type="text" name="valorcambio" id="valorcambio" value="<?php echo set_value('valorcambio'); ?>" maxlength="4">
									<?php echo form_error('valorcambio','<div class="help-block" >','</div>'); ?>
								</div>
								
								<div style="text-align:center">
									<button style="display:block"id='btnGuardar' name='btnGuardar' class="btn btn-lg btn-negro">Guardar</button>
								</div>
							</form>


						</div>
    				
				</div>
			</div>
		</div>
	<div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/admin/tipocambio/nuevo.js';?>"></script>
	<?php echo $footer;?>
	