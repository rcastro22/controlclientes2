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
			  		<div class="panel-heading" > 
			  			<?echo $page_title;?>  
			  		</div>
			  		<div class="panel-body">
			  			<form action="<?php echo site_url('catalogos/cliente/edit'); ?>" method="post">
			  				<div class="row">
			  					<div class="col-lg-2" >
			  						<div class="form-group <?php if(form_error('ClienteNit')) echo 'has-error'; ?>">
			  							<label class="control-label" for="name"> NIT: </label>
			  							<input class="form-control" readonly type="text" name="ClienteNit" id="ClienteNit" value="<?php echo $datoscliente->ClienteNit; ?>" maxlength="12">
										<?php echo form_error('ClienteNit','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-10" >
									<div class="form-group <?php if(form_error('ClienteNombre')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Nombre/Nombre Comercial: </label>
										<input class="form-control" type="text" name="ClienteNombre" id="ClienteNombre" value="<?php echo $datoscliente->ClienteNombre; ?>" maxlength="50">
										<?php echo form_error('ClienteNombre','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-7" >
									<div class="form-group <?php if(form_error('ClienteDireccion')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Dirección: </label>
										<input class="form-control" type="text" name="ClienteDireccion" id="ClienteDireccion" value="<?php echo $datoscliente->ClienteDireccion; ?>" maxlength="100">
										<?php echo form_error('ClienteDireccion','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-5" >
									<div class="form-group <?php if(form_error('ClienteTelefonos')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Teléfonos: </label>
										<input class="form-control" type="text" name="ClienteTelefonos" id="ClienteTelefonos" value="<?php echo $datoscliente->ClienteTelefonos; ?>" maxlength="100">
										<?php echo form_error('ClienteTelefonos','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-7" >
									<div class="form-group <?php if(form_error('ClienteContacto')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Contacto: </label>
										<input class="form-control" type="text" name="ClienteContacto" id="ClienteContacto" value="<?php echo $datoscliente->ClienteContacto; ?>" maxlength="100">
										<?php echo form_error('ClienteContacto','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-5" >
									<div class="form-group <?php if(form_error('ClienteEmail')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> E-Mail: </label>
										<input class="form-control" type="text" name="ClienteEmail" id="ClienteEmail" value="<?php echo $datoscliente->ClienteEmail; ?>" maxlength="100">
										<?php echo form_error('ClienteEmail','<div class="help-block" >','</div>'); ?>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteCreditoLimite')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Límite Crédito: </label>
										<input class="form-control" type="text" name="ClienteCreditoLimite" id="ClienteCreditoLimite" style="text-align:right" value="<?php echo number_format($datoscliente->ClienteCreditoLimite,2); ?>" maxlength="10" data-alineacion="derecha">
										<?php echo form_error('ClienteCreditoLimite','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteCreditoDias')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Días Crédito: </label>
										<input class="form-control" type="text" name="ClienteCreditoDias" id="ClienteCreditoDias" style="text-align:right" value="<?php echo $datoscliente->ClienteCreditoDias; ?>" maxlength="4" data-alineacion="derecha">
										<?php echo form_error('ClienteCreditoDias','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-3" >
									<div class="form-group">
										<input type="hidden" name="hlista" id="hlista" value="<?php echo $datoscliente->ClienteListaID; ?>" />
	                     				<label class="control-label" for="name"> Lista de Precios: </label>
	                     				<select class="form-control"  name="listas" id="listas"></select>
	                  				</div>
	                  			</div>
	                  			<div class="col-lg-3" >
									<div class="form-group">
										<input type="hidden" name="hvendedor" id="hvendedor" value="<?php echo $datoscliente->ClienteVendedorID; ?>" />
	                     				<label class="control-label" for="vendedor">Vendedor</label>
	                     				<select class="form-control"  name="vendedores" id="vendedores"></select>
	                  				</div>
	                  			</div>
	                  			<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteComision')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Comisión: </label>
										<input class="form-control" type="checkbox" name="ClienteComision" id="ClienteComision" <?php  if($datoscliente->ClienteComision=="1") echo "checked";?> value="1" maxlength="50">
										<?php echo form_error('ClienteComision','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-10" >
									<div class="form-group <?php if(form_error('ClienteObservaciones')) echo 'has-error'; ?>">
										<label class="control-label" for="name"> Observaciones: </label>
										<textarea class="form-control" rows="3" name="ClienteObservaciones" id="ClienteObservaciones"><?php echo $datoscliente->ClienteObservaciones; ?></textarea>
										<?php echo form_error('ClienteObservaciones','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
								<div class="col-lg-2" >
									<div class="form-group <?php if(form_error('ClienteStatus')) echo 'has-error'; ?>" >
										<label class="control-label" for="name"> Status: </label>
										<input class="form-control" type="checkbox" name="ClienteStatus" id="ClienteStatus" <?php  if($datoscliente->ClienteStatus=="1") echo "checked";?> value="1" maxlength="50">
										<?php echo form_error('ClienteStatus','<div class="help-block" >','</div>'); ?>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-body">				
									<div class="row">
										<div class="col-lg-3" >
											<div class="form-group<?php if(form_error('ClienteSaldoInicial')) echo 'has-error'; ?>">
							                  <label class="control-label" for="name"> Saldo Inicial: </label>
							                  <div class="input-group">
							                    <span class="input-group-addon">Q.</span>
							                    <input class="form-control" type="text" name="ClienteSaldoInicial" id="ClienteSaldoInicial" style="text-align:right" value="<?php echo number_format($datoscliente->ClienteSaldoInicial,2); ?>" maxlength="10" readonly="true" style="text-align:right">
													<?php echo form_error('ClienteSaldoInicial','<div class="help-block" >','</div>'); ?>
							                  </div>
							                </div>
						                </div> 
										<div class="col-lg-3" >
						                	<label class="control-label" for="name"> Cargos: </label>
						                	<div class="input-group">
							                    <span class="input-group-addon">Q.</span>
							                    <input class="form-control" type="text" name="ClienteCargos" id="ClienteCargos" style="text-align:right" value="<?php echo number_format($datoscliente->Cargos,2); ?>" maxlength="10" readonly="true" style="text-align:right">
													<?php echo form_error('ClienteSaldoInicial','<div class="help-block" >','</div>'); ?>
												<span class="input-group-btn">
													<button class="btn btn-default" type="button">Ver...</button>
							                    </span>
						                  	</div>
						                </div>
						                <div class="col-lg-3" >
						                	<label class="control-label" for="name"> Abonos: </label>
						                	<div class="input-group">
						                		<span class="input-group-addon">Q.</span>
							                    <input class="form-control" type="text" name="ClienteAbonos" id="ClienteAbonos" style="text-align:right" value="<?php echo number_format($datoscliente->Abonos,2); ?>" maxlength="10" readonly="true" style="text-align:right">
												<span class="input-group-btn">
							                      <button class="btn btn-default" type="button">Ver...</button>
							                    </span>
						                  	</div>
						                </div>
						                <div class="col-lg-3" >
						                	<label class="control-label" for="name"> Saldo Actual: </label>
						                	<div class="input-group">
							                    <span class="input-group-addon">Q.</span>
							                    <input class="form-control" type="text" name="ClienteSaldo" id="ClienteSaldo" style="text-align:right" value="<?php echo number_format($datoscliente->Saldo,2); ?>" maxlength="10" readonly="true" style="text-align:right">
							                </div>
						                </div>
						                
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
	<script src="<?php echo base_url().'assets/js/catalogos/clientes/edit.js';?>"></script> 
	<?php echo $footer;?>