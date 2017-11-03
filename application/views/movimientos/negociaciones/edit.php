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
					<li role="presentation" class="active"><a href="<?php echo base_url().'movimientos/negociacion/edit/'.$datosnegociacion->idnegociacion;?>">General</a></li>
					<li role="presentation"><a href="<?php echo base_url().'movimientos/listacomprobacion/listado/'.$datosnegociacion->idnegociacion;?>">CheckList</a></li>
					<li role="presentation" class="<?php if($datosusuario->tipousuario == '2') echo 'hidden' ?>"><a href="<?php echo base_url().'movimientos/cuota/listado/'.$datosnegociacion->idnegociacion;?>">Cuotas</a></li>
					<li role="presentation" class="<?php if($datosusuario->tipousuario == '2') echo 'hidden' ?>"><a href="<?php echo base_url().'movimientos/pagos/listado/'.$datosnegociacion->idnegociacion;?>">Detlle de pagos</a></li>
					<li role="presentation" class="<?php if($datosusuario->tipousuario == '2') echo 'hidden' ?>"><a href="<?php echo base_url().'movimientos/negociacion/pago/'.$datosnegociacion->idnegociacion;?>">Pagar</a></li>
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						  Funciones <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li role="presentation"><a href="#" data-toggle="modal" data-target="#modalContratos">Contratos</a></li>
							<li role="presentation" class="<?php if($datosusuario->tipousuario == '2') echo 'hidden' ?>"><a href="#" data-toggle="modal" data-target="#modalEmail">Enviar recordatorio</a></li>
							<li role="separator" class="divider <?php if($datosnegociacion->status != 'Creada' || $datosusuario->tipousuario == '2') echo 'hidden'; ?>"></li>
							<li role="presentation" class="<?php if($datosnegociacion->status != 'Creada' || $datosusuario->tipousuario == '2') echo 'hidden'; ?>"><a href="#"  data-toggle="modal" data-target="#modalAprobar">Aprobar</a></li>						  
						</ul>
					</li>
				</ul>
				<br/>
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading panel-heading-extras" > <?php echo $page_title;?>  
			  		<button type="button" class="btn btn-primary btn-sm	 pull-right hidden" style="padding-top: 0; padding-bottom: 0; vertical-align: middle;" data-toggle="modal" data-target="#modalContratos">
			  			Contratos
			  		</button>
			  		</div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('movimientos/negociacion/edit'); ?>" method="post">
				
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">

								<input type="hidden" name="tablainmuebles" id="tablainmuebles" value="<?php echo $datosnegociacion->tablai; ?>" />


								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<input type="hidden" name="hproyecto" id="hproyecto" value="<?php echo $datosnegociacion->idproyecto; ?>" />
											<label class="control-label" for="name"> Proyecto: </label>
											<select class="form-control" disabled="true" name="proyectos" id="proyectos"></select>											
										</div>
									</div>	
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('idnegociacion')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Negociacion: </label>
											<input class="form-control" readonly type="text" name="idnegociacion" id="idnegociacion" value="<?php echo $datosnegociacion->idnegociacion; ?>" maxlength="30">
											<?php echo form_error('idnegociacion','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Status: </label>
											<input class="form-control" disabled="true" type="text" name="status" id="status" value="<?php echo $datosnegociacion->status; ?>" maxlength="10">
											<?php echo form_error('status','<div class="help-block" >','</div>'); ?>
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
															<input type="hidden" name="hcliente" id="hcliente" value="<?php echo $datosnegociacion->idcliente; ?>" />
															<label class="control-label" for="name"> Cliente: </label>
															<select class="form-control hidden" readonly name="cliente" id="cliente"></select>
															<input type="hidden" name="cboCliente" id="cboCliente" >
														</div>
													</div>		
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
															<label class="control-label" for="name">Nombres *: </label>
															<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $datosnegociacion->nombre; ?>" maxlength="30" >
															<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('apellido')) echo 'has-error'; ?>">
															<label class="control-label" for="name">Apellidos *: </label>
															<input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $datosnegociacion->apellido; ?>" maxlength="30" >
															<?php echo form_error('apellido','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<input type="hidden" name="hcliente" id="hcliente" value="<?php echo $datosnegociacion->idcliente; ?>" />
															<label class="control-label"c for="name"> Otros dueños: </label>
															<input type="button" class="form-control btn btn-sm btn-negro" name="otrosduenos" id="otrosduenos" value="Otros dueños..."/>									
														</div>
													</div>									
												</div>
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('nit')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Nit *: </label>
															<input type="text" class="form-control" name="nit" id="nit" value="<?php echo $datosnegociacion->nit; ?>" maxlength="30" >
															<?php echo form_error('nit','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('fecnacimiento')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Fecha de nacimiento *: </label>
															<div class='input-group date' id='dpFecha'>
																<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="<?php echo $datosnegociacion->fecnacimiento; ?>" maxlength="30" >
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
															<input type="text" readonly class="form-control" name="edad" id="edad" value="" />
															<?php echo form_error('edad','<div class="help-block" >','</div>'); ?>
														</div>
													</div>					
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('dpi')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> DPI *: </label>
															<input type="text" class="form-control" name="dpi" id="dpi" value="<?php echo $datosnegociacion->dpi; ?>" maxlength="13" />
															<?php echo form_error('dpi','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('estadocivil')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Estado civil *: </label>
															<input type="text" class="form-control" name="estadocivil" id="estadocivil" value="<?php echo $datosnegociacion->estadocivil; ?>" />
															<?php echo form_error('estadocivil','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('profesion')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Profesión *: </label>
															<input type="text" class="form-control" name="profesion" id="profesion" value="<?php echo $datosnegociacion->profesion; ?>" />
															<?php echo form_error('profesion','<div class="help-block" >','</div>'); ?>
														</div>
													</div>	
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('correo')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Correo Electrónico *: </label>
															<input type="text" class="form-control" name="correo" id="correo" value="<?php echo $datosnegociacion->correo; ?>" />
															<?php echo form_error('correo','<div class="help-block" >','</div>'); ?>
														</div>
													</div>					
												</div>

												<div class="row">
													<div class="col-lg-2">
														<div class="form-group <?php if(form_error('telefono')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Teléfono *: </label>
															<input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $datosnegociacion->telefono; ?>" maxlength="8">
															<?php echo form_error('telefono','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group <?php if(form_error('celular')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Celular *: </label>
															<input type="text" class="form-control" name="celular" id="celular" value="<?php echo $datosnegociacion->celular; ?>" maxlength="8">
															<?php echo form_error('celular','<div class="help-block" >','</div>'); ?>
														</div>
													</div>	
													<div class="col-lg-8">
														<div class="form-group <?php if(form_error('direccion')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Dirección *: </label>
															<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $datosnegociacion->direccion; ?>" />
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
															<label class="control-label" for="name">Empresa *: </label>
															<input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $datosnegociacion->empresa; ?>" />
															<?php echo form_error('empresa','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group <?php if(form_error('tiempolabor')) echo 'has-error'; ?>">
															<label class="control-label" for="name">Tiempo de laborar *: </label>
															<input type="text" class="form-control" name="tiempolabor" id="tiempolabor" value="<?php echo $datosnegociacion->tiempolabor; ?>" />
															<?php echo form_error('tiempolabor','<div class="help-block" >','</div>'); ?>
														</div>
													</div>							
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group <?php if(form_error('dirtrabajo')) echo 'has-error'; ?>">
															<label class="control-label" for="name">Dirección de trabajo *: </label>
															<input type="text" class="form-control" name="dirtrabajo" id="dirtrabajo" value="<?php echo $datosnegociacion->dirtrabajo; ?>" />
															<?php echo form_error('dirtrabajo','<div class="help-block" >','</div>'); ?>
														</div>
													</div>							
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('puesto')) echo 'has-error'; ?>">
															<label class="control-label" for="name">Puesto *: </label>
															<input type="text" class="form-control" name="puesto" id="puesto" value="<?php echo $datosnegociacion->puesto; ?>" />
															<?php echo form_error('puesto','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('ingresos')) echo 'has-error'; ?>">
															<label class="control-label" for="name">Ingresos mensuales: </label>
															<input type="text" class="form-control" name="ingresos" id="ingresos" value="<?php echo $datosnegociacion->ingresos; ?>" />
															<?php echo form_error('ingresos','<div class="help-block" >','</div>'); ?>
														</div>
													</div>		
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('otrosingresos')) echo 'has-error'; ?>">
															<label class="control-label" for="name">Otros ingresos: </label>
															<input type="text" class="form-control" name="otrosingresos" id="otrosingresos" value="<?php echo $datosnegociacion->otrosingresos; ?>" />
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
															<input class="form-control" readonly="true" type="text" name="especifiquejuridico" id="especifiquejuridico" value="<?php echo $datosnegociacion->especifiquejuridico; ?>" maxlength="50">
															<?php echo form_error('especifiquejuridico','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group <?php if(form_error('nombramientojuridico')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Nombramiento *: </label>
															<input class="form-control" type="text" readonly="true" name="nombramientojuridico" id="nombramientojuridico" value="<?php echo $datosnegociacion->nombramientojuridico; ?>" maxlength="100">
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
													<div class="col-lg-11">
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<input type="hidden" name="hinmueble" id="hinmueble" value="<?php echo $datosnegociacion->idinmueble; ?>" />
																	<label class="control-label" for="name"> Inmueble: </label>
																	<select class="form-control" name="inmueble" id="inmueble"></select>										
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
									                        <table class="table table-bordered table-condensed table-striped" id="gvProductos" data-orden="true" data-filtro="true" data-fuente="dtLlenar" data-seleccion="false">
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
									                                <strong><input style="display:none;" class="form-control form-control input-lg" type="text" name="txtTotalDecimal" id="txtTotalDecimal" style="text-align:right" readonly="true" value=""></strong>
									                            </div>
									                            <div class="col-md-5">
									                                <div id="circulo"></div>
									                            </div>
									                            <!--<div class="col-md-3" >
									                                <div class="form-group">
									                                    <label class="control-label" for="conversion">Precio:</label>
									                                    <div class="input-group">      
									                                        <span class="input-group-addon">$.</span>
									                                        <strong><input class="form-control form-control input-lg" type="text" name="txtTotal" id="txtTotal" style="text-align:right" readonly="true"></strong>
									                                    </div>
									                                </div>
									                            </div>-->
									                        </div>					                        
									                    </div> 
													</div>									
												</div>

												<div class="row">
													<div class="col-lg-offset-9 col-lg-3">
														<div class="form-group <?php if(form_error('montodescuento')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Monto descuento: </label>
															<div class="input-group">
															<span class="input-group-addon">$.</span>
															<input class="form-control" type="text" name="montodescuento" id="montodescuento" value="<?php echo $datosnegociacion->montodescuento; ?>" maxlength="10">
															</div>
															<?php echo form_error('montodescuento','<div class="help-block" >','</div>'); ?>										
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-offset-7 col-lg-5">
														<div class="form-group <?php if(form_error('descripciondescuento')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Descripción descuento: </label>
															
															<input class="form-control" type="text" name="descripciondescuento" id="descripciondescuento" value="<?php echo $datosnegociacion->descripciondescuento; ?>" maxlength="60">
															<?php echo form_error('descripciondescuento','<div class="help-block" >','</div>'); ?>										
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('precioventa')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Precio venta *: </label>
															<div class="input-group">
															<span class="input-group-addon">$.</span>
															<input class="form-control" readonly type="text" name="precioventa" id="precioventa" value="<?php echo $datosnegociacion->precioventa; ?>" maxlength="10">
															</div>
															<?php echo form_error('precioventa','<div class="help-block" >','</div>'); ?>										
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('reserva')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Reserva *: </label>
															<div class="input-group">
															<span class="input-group-addon">$.</span>
															<input class="form-control" type="text" name="reserva" id="reserva" value="<?php echo $datosnegociacion->reserva; ?>" maxlength="10">
															</div>
															<?php echo form_error('reserva','<div class="help-block" >','</div>'); ?>											
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group <?php if(form_error('reciboreserva')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Recibo reserva: </label>
															<input class="form-control" type="text" name="reciboreserva" id="reciboreserva" value="<?php echo $datosnegociacion->reciboreserva; ?>" maxlength="10">
															<?php echo form_error('reciboreserva','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group <?php if(form_error('fechareserva')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Fecha reserva: </label>
															<input class="form-control" type="text" name="fechareserva" id="fechareserva" value="<?php echo $datosnegociacion->fechareserva; ?>" maxlength="10">
															<?php echo form_error('fechareserva','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group <?php if(form_error('enganche')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Enganche *: </label>
															<div class="input-group">
															<span class="input-group-addon">$.</span>
															<input class="form-control" type="text" name="enganche" id="enganche" value="<?php echo $datosnegociacion->enganche; ?>" maxlength="10">
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
															<input class="form-control" readonly type="text" name="financiamientobanco" id="financiamientobanco" value="<?php echo $datosnegociacion->financiamientobanco; ?>" maxlength="10">
															</div>
															<?php echo form_error('financiamientobanco','<div class="help-block" >','</div>'); ?>									
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('saldoenganche')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Saldo enganche *: </label>
															<div class="input-group">
															<span class="input-group-addon">$.</span>
															<input class="form-control" readonly type="text" name="saldoenganche" id="saldoenganche" value="<?php echo $datosnegociacion->saldoenganche; ?>" maxlength="10">
															</div>
															<?php echo form_error('saldoenganche','<div class="help-block" >','</div>'); ?>											
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('nocuotas')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> No. Cuotas *: </label>
															<input class="form-control" type="text" name="nocuotas" id="nocuotas" value="<?php echo $datosnegociacion->nocuotas; ?>" maxlength="30">
															<?php echo form_error('nocuotas','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('cuotamensual')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Cuota mensual *: </label>
															<div class="input-group">
															<span class="input-group-addon">$.</span>
															<input class="form-control" readonly type="text" name="cuotamensual" id="cuotamensual" value="<?php echo $datosnegociacion->cuotamensual; ?>" maxlength="10">
															</div>
															<?php echo form_error('cuotamensual','<div class="help-block" >','</div>'); ?>											
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('fechaprimerpago')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Fecha primer pago *: </label>
															<input class="form-control" readonly type="text" name="fechaprimerpago" id="fechaprimerpago" value="<?php echo $datosnegociacion->fecha; ?>" maxlength="30">
															<?php echo form_error('fechaprimerpago','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group <?php if(form_error('banco')) echo 'has-error'; ?>">
															<label class="control-label" for="name"> Factura Banco: </label>
															<input class="form-control" type="text" name="banco" id="banco" value="<?php echo $datosnegociacion->facturabanco; ?>" maxlength="10">
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
															<input class="form-control" type="text" name="comision" id="comision" value="<?php echo $datosnegociacion->comision; ?>" maxlength="30">
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
															<label class="control-label" for="name"> Tipo cambio contrato *: </label>
															<input class="form-control" readonly="true" type="text" name="tipocambioneg" id="tipocambioneg" value="<?php echo $datosnegociacion->tipocambioneg; ?>" maxlength="50">
															<?php echo form_error('tipocambioneg','<div class="help-block" >','</div>'); ?>
														</div>
													</div>
													<div class="col-lg-4">
                                                        <div class="form-group <?php if(form_error('formapago')) echo 'has-error'; ?>">
                                                            <label class="control-label" for="name"> Forma de pago: </label>
                                                            <input class="form-control" readonly="true" type="hidden" name="formapago" id="formapago" value="<?php echo $datosnegociacion->formapago; ?>" maxlength="50">
                                                            <select class="form-control">
                                                              <option value="FHA">FHA</option>
                                                              <option value="contado">Contado</option>
                                                              <option value="creditobank">Credito bancario</option>
                                                            </select>
                                                            <?php echo form_error('formapago','<div class="help-block" >','</div>'); ?>
                                                        </div>
                                                    </div>
												</div>
												<div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group <?php if(form_error('plazocredito')) echo 'has-error'; ?>">
                                                            <label class="control-label" for="name"> plazo del credito: </label>
                                                            <input class="form-control" type="text" name="plazocredito" id="plazocredito" value="<?php echo $datosnegociacion->plazocredito; ?>" maxlength="30">
                                                            <?php echo form_error('plazocredito','<div class="help-block" >','</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group <?php if(form_error('tipofinanciamiento')) echo 'has-error'; ?>">
                                                            <label class="control-label" for="name"> Tipo de financiamiento: </label>
                                                            <input class="form-control" type="text" name="tipofinanciamiento" id="tipofinanciamiento" value="<?php echo $datosnegociacion->tipofinanciamiento; ?>" maxlength="10">
                                                            <?php echo form_error('tipofinanciamiento','<div class="help-block" >','</div>'); ?>                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group <?php if(form_error('entidadautorizada')) echo 'has-error'; ?>">
                                                            <label class="control-label" for="name"> Entidad autorizada: </label>
                                                            <input class="form-control" type="text" name="entidadautorizada" id="entidadautorizada" value="<?php echo $datosnegociacion->entidadautorizada; ?>" maxlength="10">
                                                            <?php echo form_error('entidadautorizada','<div class="help-block" >','</div>'); ?>                                     
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group <?php if(form_error('tasainteres')) echo 'has-error'; ?>">
                                                            <label class="control-label" for="name"> Tasa de interes: </label>
                                                            <input class="form-control" type="text" name="tasainteres" id="tasainteres" value="<?php echo $datosnegociacion->tasainteres; ?>" maxlength="10">
                                                            <?php echo form_error('tasainteres','<div class="help-block" >','</div>'); ?>                                       
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</div>
									</div>
								</div>
								<br/>

								<div style="text-align:center">
									<button class="btn btn-lg btn-negro" id="modificar">Modificar</button>
								</div>
								<div style="text-align:center">
									<input type="button" class="btn btn-lg btn-negro hidden" id="recordatorio" value="Enviar Recordatorio" data-toggle="modal" data-target="#modalEmail">
								</div>
							</form>
							<br><br><br>
							<div class="row table-responsive">
							<div class="form-search pull-right input-group" data-tabla="gvBuscar">
								<span class="input-group-addon hide">Buscar</span>
		                		<input type="hidden" class="search-query form-control" placeholder="Ingrese su búsqueda" />
		        			</div>	
							<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscar">
								<thead>
				    				<tr>
			              				<th class="hide" data-tipo="string" data-campo="idnegociacion" data-alineacion="izquierda" style="text-align:center">NEGOCIACIÓN</th>
			              				<th data-tipo="string" data-campo="nopago" data-alineacion="izquierda" style="text-align:center">NO. DE PAGO</th>
			              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fechalimitepago" data-alineacion="izquierda" style="text-align:center">FECHA PAGO</th>
			              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="pagocalculado" data-alineacion="derecha" style="text-align:center">MONTO CALCULADO</th>
			              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="pagoefectuado" data-alineacion="derecha" style="text-align:center">PAGO EFECTUADO</th>
			              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="moracalculada" data-alineacion="derecha" style="text-align:center">MORA CALCULADA</th>
			              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="morapagada" data-alineacion="derecha" style="text-align:center">MORA PAGADA</th>
			              				<!--<th data-boton="Ver" data-alineacion="centro" style="text-align:center">NEGOCIACIÓN</th>-->	     
			              				<!--<th data-boton="Modificar" data-alineacion="centro" style="text-align:center"></th>
			              				<th data-boton="Pagar" class-boton="btn-primary" data-alineacion="centro" style="text-align:center"></th>
			              				<th data-boton="Rescindir" data-alineacion="centro" style="text-align:center"></th>-->
			         				</tr>
				 				</thead>
			    				<tbody>
			    				</tbody>
							</table>
							</div>
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

	<!-- Modal -->
	<div class="modal fade" id="modalContratos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Contratos</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
		        <a href="<?php echo base_url().'movimientos/word/contratoReserva/'.$datosnegociacion->idnegociacion;?>" class="btn btn-negro pull-left col-lg-6 col-lg-offset-3" >Contrato de Reserva</a>
		           
	      	</div>
	      	<div class="row">
	      		<a href="<?php echo base_url().'movimientos/word/contratoPromesaCompraventa/'.$datosnegociacion->idnegociacion;?>" class="btn btn-negro pull-left col-lg-6 col-lg-offset-3" >Contrato de Promesa de Compraventa</a>
	      	</div>
	      	<div class="row">
	      		<a href="<?php echo base_url().'movimientos/word/minutaCompraventa/'.$datosnegociacion->idnegociacion;?>" class="btn btn-negro pull-left col-lg-6 col-lg-offset-3" >Minuta de Compraventa</a>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal E-mail -->
	<div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Recordatorio</h4>
	      </div>
	      <div class="modal-body">
		     <p>¿Esta seguro que desea enviar el recordatorio de pago?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <a href="<?php echo base_url().'movimientos/negociacion/enviarMail/'.$datosnegociacion->idnegociacion;?>" class="btn btn-primary" >Enviar recordatorio</a>
	        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalAprobar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Recordatorio</h4>
	      </div>
	      <div class="modal-body">
		     <p>¿Esta seguro que desea Aprobar la negociacion <?php echo $datosnegociacion->idnegociacion ?>?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <a href="<?php echo base_url().'movimientos/negociacion/aprobarNegociacion/'.$datosnegociacion->idnegociacion;?>" class="btn btn-primary" >Aprobar</a>
	        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
	      </div>
	    </div>
	  </div>
	</div>


	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script>
	<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/edit.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		//$('input[name=enganche]').focus();
		$('#dpFecha').datetimepicker({'format':'YYYY-MM-DD'});
		$('#fechaprimerpago').datepicker({'format':'yyyy-mm-dd'});
		$('#fechareserva').datepicker({'format':'yyyy-mm-dd'});
	</script>