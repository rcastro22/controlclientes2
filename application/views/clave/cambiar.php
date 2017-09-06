<?php echo $headerclave;?>
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-4 col-sm-offset-3 col-lg-offset-4">
				<form action ="<?php echo site_url('clave/cambiar');?>" method="post" class="well form-horizontal" role="form">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div class="row" style="text-align:center;">
						<h2 style="color:black;">Cambiar contraseña</h2>
						
					</div>
					<br>
					<div class="form-group <?php if(form_error('claveactual')) echo 'has-error'; ?>">
						<div class="input-group">
							<span class="input-group-addon">Clave Actual</span>
							<input type="password" class="form-control" id="claveactual" name="claveactual" value="<?php echo set_value('claveactual'); ?>" placeholder="Ingrese clave actual">
						</div>
						<?php echo form_error('claveactual','<div class="help-block" >','</div>'); ?>
					</div>
					
					<div class="form-group <?php if(form_error('clavenueva')) echo 'has-error'; ?>">
						<div class="input-group">	
							<span class="input-group-addon">Clave Nueva</span>
							<input type="password" class="form-control" id="clavenueva" name="clavenueva" value="<?php echo set_value('clavenueva'); ?>" placeholder="Ingrese su nueva clave">
						</div>
						<?php echo form_error('clavenueva','<div class="help-block" >','</div>'); ?>
					</div>
					
					<div class="form-group <?php if(form_error('claveconfirmar')) echo 'has-error'; ?>">
						<div class="input-group">	
							<span class="input-group-addon">Confirmar&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="password" class="form-control" id="claveconfirmar" name="claveconfirmar" value="<?php echo set_value('claveconfirmar'); ?>" placeholder="Confirmar clave nueva">
						</div>
						<?php echo form_error('claveconfirmar','<div class="help-block" >','</div>'); ?>
					</div>
					
					<div class="form-group text-center"><button class="btn btn-negro">Cambiar</button></div>
					<br>
					<?php if (isset($login_error)):?>
						<div class="alert alert-danger text-center">
							<span><?php echo $login_error; ?></span>
						</div>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>	
<?php echo $footer;?>
	

