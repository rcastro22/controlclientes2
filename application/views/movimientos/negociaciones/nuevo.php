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
			  		<div class="panel-heading"> 
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
						<form action="<?php echo site_url('movimientos/negociacion/nuevo'); ?>" method="post">
						
							<input type="hidden" name="tablainmuebles" id="tablainmuebles" value="<?php echo $datosnegociacion->tablai; ?>" />
							<input type="hidden" name="tablaotros" id="tablaotros" value="<?php echo $datosnegociacion->tablaotros; ?>" />

							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="hidden" name="hproyecto" id="hproyecto" value="<?php echo $datosnegociacion->idproyecto; ?>" />
										<label class="control-label" for="name"> Proyecto: </label>
										<select class="form-control" name="proyectos" id="proyectos"></select>										
									</div>
								</div>							
							</div>
							<div class="panel-group" id="accordion">
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Datos Generales del comprador</a>
										</h4>
									</div>
									<div id="collapse1" class="panel-collapse in" >
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-4">
													<div class="form-group">
														<input type="hidden" name="hcliente" id="hcliente" value="<?php echo ($idcliente != -1 ? $idcliente : $datosnegociacion->idcliente); ?>" />
														<label class="control-label" for="name"> Cliente: </label>
														<select class="form-control hidden" name="cliente" id="cliente"></select>									
														<input type="hidden" name="cboCliente" id="cboCliente" >
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Nombres: </label>
														<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo set_value('nombre'); ?>" maxlength="30" >
														<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('apellido')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Apellidos: </label>
														<input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo set_value('apellido'); ?>" maxlength="30" >
														<?php echo form_error('apellido','<div class="help-block" >','</div>'); ?>
													</div>
												</div>							
											</div>

											<div class="row">
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('nit')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Nit: </label>
														<input type="text" class="form-control" name="nit" id="nit" value="<?php echo set_value('nit'); ?>" maxlength="30" >
														<?php echo form_error('nit','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('fecnacimiento')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Fecha de nacimiento: </label>
														<div class='input-group date' id='dpFecha'>
															<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="<?php echo set_value('fecnacimiento'); ?>" maxlength="30" >
															<span class="input-group-addon">
										                        <span class="glyphicon glyphicon-calendar"></span>
										                    </span>
										                </div>
														<?php echo form_error('fecnacimiento','<div class="help-block" >','</div>'); ?>
													</div>
												</div>	
												<div class="col-lg-2">
													<div class="form-group <?php if(form_error('edad')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Edad: </label>
														<input type="text" readonly class="form-control" name="edad" id="edad" value="<?php echo set_value('edad'); ?>" />
														<?php echo form_error('edad','<div class="help-block" >','</div>'); ?>
													</div>
												</div>					
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('dpi')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> DPI: </label>
														<input type="text" class="form-control" name="dpi" id="dpi" value="<?php echo set_value('dpi'); ?>" maxlength="13" />
														<?php echo form_error('dpi','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('estadocivil')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Estado civil: </label>
														<input type="text" class="form-control" name="estadocivil" id="estadocivil" value="<?php echo set_value('estadocivil'); ?>" />
														<?php echo form_error('estadocivil','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('profesion')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Profesión: </label>
														<input type="text" class="form-control" name="profesion" id="profesion" value="<?php echo set_value('profesion'); ?>" />
														<?php echo form_error('profesion','<div class="help-block" >','</div>'); ?>
													</div>
												</div>	
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('correo')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Correo Electrónico: </label>
														<input type="text" class="form-control" name="correo" id="correo" value="<?php echo set_value('correo'); ?>" />
														<?php echo form_error('correo','<div class="help-block" >','</div>'); ?>
													</div>
												</div>					
											</div>

											<div class="row">
												<div class="col-lg-2">
													<div class="form-group <?php if(form_error('telefono')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Teléfono: </label>
														<input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo set_value('telefono'); ?>" maxlength="8">
														<?php echo form_error('telefono','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="form-group <?php if(form_error('celular')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Celular: </label>
														<input type="text" class="form-control" name="celular" id="celular" value="<?php echo set_value('celular'); ?>" maxlength="8">
														<?php echo form_error('celular','<div class="help-block" >','</div>'); ?>
													</div>
												</div>	
												<div class="col-lg-8">
													<div class="form-group <?php if(form_error('direccion')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Dirección: </label>
														<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo set_value('direccion'); ?>" />
														<?php echo form_error('direccion','<div class="help-block" >','</div>'); ?>
													</div>
												</div>					
											</div>
										</div>
									</div>
								</div>
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Datos Laborales del comprador</a>
										</h4>
									</div>
									<div id="collapse2" class="panel-collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group <?php if(form_error('empresa')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Empresa: </label>
														<input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo set_value('empresa'); ?>" />
														<?php echo form_error('empresa','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group <?php if(form_error('tiempolabor')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Tiempo de laborar: </label>
														<input type="text" class="form-control" name="tiempolabor" id="tiempolabor" value="<?php echo set_value('tiempolabor'); ?>" />
														<?php echo form_error('tiempolabor','<div class="help-block" >','</div>'); ?>
													</div>
												</div>							
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group <?php if(form_error('dirtrabajo')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Dirección de trabajo: </label>
														<input type="text" class="form-control" name="dirtrabajo" id="dirtrabajo" value="<?php echo set_value('dirtrabajo'); ?>" />
														<?php echo form_error('dirtrabajo','<div class="help-block" >','</div>'); ?>
													</div>
												</div>							
											</div>
											<div class="row">
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('puesto')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Puesto: </label>
														<input type="text" class="form-control" name="puesto" id="puesto" value="<?php echo set_value('puesto'); ?>" />
														<?php echo form_error('puesto','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('ingresos')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Ingresos mensuales: </label>
														<input type="text" class="form-control" name="ingresos" id="ingresos" value="<?php echo set_value('ingresos'); ?>" />
														<?php echo form_error('ingresos','<div class="help-block" >','</div>'); ?>
													</div>
												</div>		
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('otrosingresos')) echo 'has-error'; ?>">
														<label class="control-label" for="name">Otros ingresos: </label>
														<input type="text" class="form-control" name="otrosingresos" id="otrosingresos" value="<?php echo set_value('otrosingresos'); ?>" />
														<?php echo form_error('otrosingresos','<div class="help-block" >','</div>'); ?>
													</div>
												</div>					
											</div>
											<div class="row">
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('clientejuridico')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> En calidad de*: </label>
														<div class="form-control">
														<input  type="radio"  name="clientejuridico" id="clientejuridico" value="1" 
														<?php  

																	if($datosnegociacion->clientejuridico=="1")
																		echo "checked";
																	else if ($datosnegociacion->clientejuridico!="2")
																		echo "checked";

																	?>> Nombre Propio &nbsp;&nbsp;&nbsp;
														<input  type="radio"  name="clientejuridico" id="clientejuridico" value="2"
														<?php  
																	if($datosnegociacion->clientejuridico=="2")
																		echo "checked";
														?>> Jurídico
														</div>
														<?php echo form_error('clientejuridico','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('especifiquejuridico')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Especifíque *: </label>
														<input class="form-control" readonly="true" type="text" name="especifiquejuridico" id="especifiquejuridico" value="<?php echo set_value('especifiquejuridico'); ?>" maxlength="50">
														<?php echo form_error('especifiquejuridico','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('nombramientojuridico')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Nombramiento *: </label>
														<input class="form-control" type="text" readonly="true" name="nombramientojuridico" id="nombramientojuridico" value="<?php echo set_value('nombramientojuridico'); ?>" maxlength="100">
														<?php echo form_error('nombramientojuridico','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Condiciones de la negociación</a>
										</h4>
									</div>
									<div id="collapse3" class="panel-collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<input type="hidden" name="htipoinmueble" id="htipoinmueble" value="<?php echo $datosnegociacion->idtipoinmueble; ?>" />
														<label class="control-label hidden" for="name"> Tipo inmueble: </label>
														<select class="form-control hidden" readonly name="tiposinmueble" id="tiposinmueble"></select>				
													</div>
												</div>						
											</div>

											<div class="row">
												<div class="col-lg-4">
													<div class="form-group">
														<input type="hidden" name="hmodelo" id="hmodelo" value="<?php echo $datosnegociacion->idmodelo; ?>" />
														<label class="control-label hidden" for="name"> Modelo: </label>
														<select class="form-control hidden" readonly name="modelo" id="modelo"></select>										
													</div>
												</div>								
											</div>
											

											<div class="row">
												<div class="col-lg-11">
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<input type="hidden" name="hinmueble" id="hinmueble" value="<?php echo $datosnegociacion->idinmueble; ?>" />
																<label class="control-label" for="name"> Inmueble: </label>
																<select class="form-control hidden" name="inmueble" id="inmueble"></select>					
																<input type="hidden" name="cboInmueble" id="cboInmueble">
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group <?php if(form_error('monto')) echo 'has-error'; ?>">
																<label class="control-label" for="name"> Valor inmueble: </label>
																<div class="input-group">
																	<span id="spanmonto" name="spanmonto" class="input-group-addon">$.</span>
																	<strong><input class="form-control" type="text" name="monto" id="monto" value="<?php echo set_value('monto'); ?>" maxlength="10"></strong>
																	<?php echo form_error('monto','<div class="help-block" >','</div>'); ?>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-1">
													<div class="row">
														<div class="col-lg-12">
															<div class="form-group <?php if(form_error('boton')) echo 'has-error'; ?>">
																<label class="control-label" for="name"></label>
																<input type="button" value="Agregar" id="btnAgregar" name="btnAgregar" class="btn btn-sm btn btn-success">
																<!--<button id="btnAgregar" name="btnAgregar" class="btn btn-sm btn btn-success">Agregar</button>-->
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
								                        <table class="table table-bordered table-condensed table-hover table-striped" id="gvProductos" data-orden="true" data-filtro="true" data-fuente="dtLlenar" data-seleccion="false">
								                            <thead>
								                                <tr>
								                                	<!--<th class="hide" data-tipo="string" data-campo="idnegociacion" data-alineacion="centro" style="text-align: center">Código negociacion</th>-->
								                                	<th data-tipo="string" data-campo="idinmueble" data-alineacion="centro" style="text-align: center">Inmueble</th>
								                                    <th data-tipo="string" data-campo="tipo" data-alineacion="centro" style="text-align: center">Tipo inmueble</th>
								                                    <th data-tipo="string" data-campo="modelo" data-alineacion="centro" style="text-align: center">Modelo</th>
								                                    <th data-tipo="decimal" data-formato="#,###,###.##" data-campo="monto" data-alineacion="centro" style="text-align: center">Monto</th>
								                                    <!--<th data-tipo="string" data-campo="observaciones" data-alineacion="centro" style="text-align: center">Observaciones</th>-->				                                    
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
								                                <strong><input style="display:none;" class="form-control form-control input-lg" type="text" name="txtTotalDecimal" id="txtTotalDecimal" style="text-align:right" readonly="true" value="<?php echo $datosnegociacion->total_tablai; ?>"></strong>
								                            </div>
								                            <div class="col-md-5">
								                                <div id="circulo"></div>
								                            </div>
								                        </div>					                        
								                    </div> 
												</div>									
											</div>

											<div class="row">
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('precioventa')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Precio venta *: </label>
														<div class="input-group">
														<span class="input-group-addon">$.</span>
														<input readonly class="form-control" type="text" name="precioventa" id="precioventa" value="<?php echo set_value('precioventa'); ?>" maxlength="10">
														</div>
														<?php echo form_error('precioventa','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('reserva')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Reserva *: </label>
														<div class="input-group">
														<span id="spanreserva" name="spanreserva" class="input-group-addon">$.</span>
														<input class="form-control" type="text" name="reserva" id="reserva" value="<?php echo set_value('reserva'); ?>" maxlength="10">
														</div>
														<?php echo form_error('reserva','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
												<div class="col-lg-2">
													<div class="form-group <?php if(form_error('reciboreserva')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Recibo reserva: </label>
														<input class="form-control" type="text" name="reciboreserva" id="reciboreserva" value="<?php echo set_value('reciboreserva'); ?>" maxlength="10">
														<?php echo form_error('reciboreserva','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-2">
														<div class="form-group <?php if(form_error('fechareserva')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Fecha reserva: </label>
															<input class="form-control" type="text" name="fechareserva" id="fechareserva" value="<?php echo set_value('fechareserva'); ?>" maxlength="10">
															<?php echo form_error('fechareserva','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
												<div class="col-lg-2">
													<div class="form-group <?php if(form_error('enganche')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Enganche *: </label>
														<div class="input-group">
														<span id="spanenganche" name="spanenganche" class="input-group-addon">$.</span>
														<input class="form-control" type="text" name="enganche" id="enganche" value="<?php echo set_value('enganche'); ?>" maxlength="10">
														</div>
														<?php echo form_error('enganche','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('financiamientobanco')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Financiamiento banco: </label>
														<div class="input-group">
														<span class="input-group-addon">$.</span>
														<input class="form-control" readonly type="text" name="financiamientobanco" id="financiamientobanco" value="<?php echo set_value('financiamientobanco'); ?>" maxlength="10">
														</div>
														<?php echo form_error('financiamientobanco','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('saldoenganche')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Saldo enganche *: </label>
														<div class="input-group">
														<span class="input-group-addon">$.</span>
														<input class="form-control" readonly type="text" name="saldoenganche" id="saldoenganche" value="<?php echo set_value('saldoenganche'); ?>" maxlength="10">
														</div>
														<?php echo form_error('saldoenganche','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('nocuotas')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> No. Cuotas *: </label>
														<input class="form-control" type="text" name="nocuotas" id="nocuotas" value="<?php echo set_value('nocuotas'); ?>" maxlength="30">
														<?php echo form_error('nocuotas','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('cuotamensual')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Cuota mensual *: </label>
														<div class="input-group">
														<span class="input-group-addon">$.</span>
														<input class="form-control" readonly type="text" name="cuotamensual" id="cuotamensual" value="<?php echo set_value('cuotamensual'); ?>" maxlength="10">
														</div>
														<?php echo form_error('cuotamensual','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('fechaprimerpago')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Fecha primer pago *: </label>
														<input class="form-control" type="text" name="fechaprimerpago" id="fechaprimerpago" value="<?php echo set_value('fechaprimerpago'); ?>" maxlength="30">
														<?php echo form_error('fechaprimerpago','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('banco')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Factura banco: </label>
														<input class="form-control" type="text" name="banco" id="banco" value="<?php echo set_value('facturabanco'); ?>" maxlength="10">
														<?php echo form_error('banco','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<input type="hidden" name="hasesores" id="hasesores" value="<?php echo $datosnegociacion->idasesor; ?>" />
														<label class="control-label" for="name"> Asesor: </label>
														<select class="form-control" name="asesor" id="asesor"></select>										
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group <?php if(form_error('comision')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Comisión *: </label>
														<div class="input-group">
														<span class="input-group-addon">$.</span>
														<input class="form-control" type="text" name="comision" id="comision" value="<?php echo set_value('comision'); ?>" maxlength="30">
														</div>
														<?php echo form_error('comision','<div class="help-block" >','</div>'); ?>										
													</div>
												</div>
											</div>


											<div class="row">
												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('monedacontrato')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Tipo moneda para contrato: </label>
														<div class="form-control">
														<input  type="radio"  name="monedacontrato" id="monedacontrato" value="1" 
														<?php  

																	if($datosnegociacion->monedacontrato=="1")
																		echo "checked";
																	else if ($datosnegociacion->monedacontrato!="2")
																		echo "checked";

																	?>> Dólares ($) &nbsp;&nbsp;&nbsp;
														<input  type="radio"  name="monedacontrato" id="monedacontrato" value="2"
														<?php  

																	if($datosnegociacion->monedacontrato=="2")
																		echo "checked";


														?>> Quetzales (Q)
														</div>
														<?php echo form_error('monedacontrato','<div class="help-block" >','</div>'); ?>
													</div>
												</div>


												<div class="col-lg-4">
													<div class="form-group <?php if(form_error('tipocambioneg')) echo 'has-error'; ?>">
														<label class="control-label" for="name"> Tipo Cambio Contrato *: </label>
														<input class="form-control" readonly="true" type="text" name="tipocambioneg" id="tipocambioneg" value="<?php echo set_value('tipocambioneg'); ?>" maxlength="50">
														<?php echo form_error('tipocambioneg','<div class="help-block" >','</div>'); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br/>
							<div class="row" style="text-align:center">
								<!--<input type="button" class="btn btn-lg btn-negro" id="guardar" value="Guardar y generar pagos de la negociación"> -->
								<button class="btn btn-lg btn-negro" id="guardar">Guardar y generar pagos de la negociación</button>
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
	<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/nuevo.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('input[name=proyectos]').focus();
		$('#dpFecha').datetimepicker({'format':'YYYY-MM-DD'});
		$('#fechaprimerpago').datepicker({'format':'yyyy-mm-dd'});
		$('#fechareserva').datepicker({'format':'yyyy-mm-dd'});
	</script>

