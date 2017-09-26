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
				<ul class="nav nav-tabs">
					<li role="presentation"><a href="<?php echo base_url().'movimientos/negociacion/edit/'.$datosnegociacion->idnegociacion;?>">General</a></li>
					<li role="presentation"><a href="<?php echo base_url().'movimientos/listacomprobacion/listado/'.$datosnegociacion->idnegociacion;?>">CheckList</a></li>
					<li role="presentation"><a href="<?php echo base_url().'movimientos/cuota/listado/'.$datosnegociacion->idnegociacion;?>">Cuotas</a></li>
					<li role="presentation"><a href="<?php echo base_url().'movimientos/pagos/listado/'.$datosnegociacion->idnegociacion;?>">Detlle de pagos</a></li>
					<li role="presentation" class="active"><a href="<?php echo base_url().'movimientos/negociacion/pago/'.$datosnegociacion->idnegociacion;?>">Pagar</a></li>
				</ul>
				<br/>
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading panel-heading-extras" > Datos negociación  </div>
			  			<div class="panel-body">
							<!--<form action="<?php echo site_url('movimientos/negociacion/pago'); ?>" method="post">-->
							
								<div>
									<div class="col-lg-4 form-horizontal">
										<div class="form-group <?php if(form_error('idnegociacion')) echo 'has-error'; ?>">
											<label class="col-lg-5 control-label" for="name"> Negociacion: </label>
											<div class="col-lg-7">
												<input class="form-control" readonly type="text" name="idnegociacion" id="idnegociacion" value="<?php echo $datosnegociacion->idnegociacion; ?>" maxlength="30">
												<?php echo form_error('idnegociacion','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
									</div>
									<!--<div class="col-lg-4">
										<div class="form-group <?php if(form_error('reserva')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Reserva: </label>
											<input class="form-control" type="text" name="reserva" id="reserva" value="<?php echo $datosnegociacion->reserva; ?>" maxlength="10">
											<?php echo form_error('reserva','<div class="help-block" >','</div>'); ?>
										</div>
									</div>-->
									<div class="col-lg-4 col-lg-offset-4 form-horizontal">
										<div class="form-group">
											<input type="hidden" name="hcliente" id="hcliente" value="<?php echo $datosnegociacion->idcliente; ?>" />
											<label class="col-lg-5 control-label" for="name"> Cliente: </label>
											<div class="col-lg-7">
												<select class="form-control" readonly name="cliente" id="cliente"></select>										
											</div>
										</div>
									</div>										
								</div>
							<!--</form>-->
						</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1" >
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading" > 
			  			
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
							<!--<form action="<?php echo site_url('movimientos/negociacion/pago'); ?>" method="post">-->
							
				
								<!--<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">
								-->
								
								<div class="row">
									<div class="col-lg-11">
										<div class="row">
											<div class="col-lg-3">
												<div class="form-group">
													<input type="hidden" name="hformapago" id="hformapago" value="<?php echo $datosnegociacion->idproyecto; ?>" />
													<label class="control-label" for="name"> Forma de pago: </label>
													<select class="form-control" name="formapago" id="formapago"></select>										
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group <?php if(form_error('nodocumento')) echo 'has-error'; ?>">
													<label class="control-label" for="name"> No. de documento: </label>
													<input class="form-control" type="text" name="nodocumento" id="nodocumento" value="<?php echo set_value('nodocumento'); ?>" maxlength="10">
													<?php echo form_error('nodocumento','<div class="help-block" >','</div>'); ?>
												</div>
											</div>					
											<div class="col-lg-3">
												<div class="form-group <?php if(form_error('monto')) echo 'has-error'; ?>">
													<label class="control-label" for="name"> Valor pago: </label>
													<div class="input-group">
														<span id="spanmonto" name="spanmonto" class="input-group-addon">$.</span>
														<strong><input class="form-control" type="text" name="monto" id="monto" value="<?php echo set_value('monto'); ?>" maxlength="10"></strong>
														<?php echo form_error('monto','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
											</div>	
											<div class="col-lg-3">
												<div class="form-group <?php if(form_error('fechapago')) echo 'has-error'; ?>">
													<label class="control-label" for="name"> Fecha*: </label>
													<input class="form-control" type="text" name="fechapago" id="fechapago" value="<?php echo set_value('fechapago'); ?>" maxlength="30">
													<?php echo form_error('fechapago','<div class="help-block" >','</div>'); ?>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group <?php if(form_error('observaciones')) echo 'has-error'; ?>">
													<label class="control-label" for="name"> Observaciones: </label>													
													<input class="form-control" type="text" name="observaciones" id="observaciones" value="<?php echo set_value('observaciones'); ?>" maxlength="60">
													<?php echo form_error('observaciones','<div class="help-block" >','</div>'); ?>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-1">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group <?php if(form_error('boton')) echo 'has-error'; ?>">
													<label class="control-label" for="name"></label>
													<button id="btnAgregar" name="btnAgregar" class="btn btn-sm btn btn-success">Agregar</button>
												</div>
											</div>						
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-11">
										<div>
					                        <div class="form-search pull-right" data-tabla="gvProductos" style="padding: 10px;display:none;" >
					                            <input type="text" class="search-query form-control" placeholder="Buscar" />
					                        </div>
					                        <table class="table table-bordered table-condensed table-hover table-striped" id="gvProductos" data-orden="true" data-filtro="true" data-fuente="dtLlenar" data-seleccion="true">
					                            <thead>
					                                <tr>
					                                	<th class="hide" data-tipo="string" data-campo="idnegociacion" data-alineacion="centro" style="text-align: center">Código negociacion</th>
					                                	<th class="hide" data-tipo="string" data-campo="idformapago" data-alineacion="centro" style="text-align: center">Código forma de pago</th>
					                                    <th data-tipo="string" data-campo="formapago" data-alineacion="centro" style="text-align: center">Forma de pago</th>
					                                    <th data-tipo="string" data-campo="nodocumento" data-alineacion="centro" style="text-align: center">No. de documento</th>
					                                    <th data-tipo="decimal" data-formato="#,###,###.##" data-campo="monto" data-alineacion="centro" style="text-align: center">Monto</th>
					                                    <th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fechapago" data-alineacion="centro" style="text-align:center">FECHA PAGO</th>
					                                    <th data-tipo="string" data-campo="observaciones" data-alineacion="centro" style="text-align: center">Observaciones</th>					                                    
					                                    <th data-boton="borrar" data-alineacion="centro" style="text-align: center">Eliminar</th>
					                                </tr>                            
					                            </thead>
					                            <tbody>
					                            </tbody>
					                        </table>
					                        <div class="text-center" style="display:none;">
					                            <div class="pagination">
					                                <ul class="pagination" data-tabla="gvProductos" data-cantidad="10" data-grupo="8"></ul>
					                            </div>
					                        </div>
					                        <div class="row">
					                            <div class="col-md-7">
					                                <strong><input style="display:none;" class="form-control form-control input-lg" type="text" name="txtTotalDecimal" id="txtTotalDecimal" style="text-align:right" readonly="true"></strong>
					                            </div>
					                            <div class="col-md-2">
					                                <div id="circulo"></div>
					                            </div>
					                            <div class="col-md-3" >
					                                <div class="form-group">
					                                    <label class="control-label" for="conversion">Precio:</label>
					                                    <div class="input-group">      
					                                        <span class="input-group-addon">$.</span>
					                                        <strong><input class="form-control form-control input-lg" type="text" name="txtTotal" id="txtTotal" style="text-align:right" readonly="true"></strong>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>					                        
					                    </div> 
									</div>									
								</div>

								

								<div style="text-align:center">
									<button class="btn btn-lg btn-negro" id="registrar">Registrar pago</button>
								</div>
							<!--</form>-->


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
			        <p>Desea registrar el pago? &hellip;</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" id="botonCancelar" name="botonListado" class="btn btn-default" data-dismiss="modal">No</button>
			        <button type="button" id="botonGuardar" name="botonredirigir" class="btn btn-primary">Si</button>
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
	<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/pago.js';?>"></script> 

	<script>
		//$('input[name=proyectos]').focus();
		$('#fechapago').datepicker({'format':'yyyy-mm-dd'});
	</script>
	
	<?php echo $footer;?>
