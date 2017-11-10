<?php echo $headermov;?>
   <div class="row" style="display:<?php if (!isset($mensaje) || $mensaje=="") echo "none"; ?>">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="alert <?php echo $tipoAlerta;?>">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<?php echo $mensaje;?>	
			</div>
		</div>
	</div>
	<div class="container">


		<div class="row" style="margin-bottom: 5px;">
			<div class="col-lg-2 col-lg-offset-5" >
				<input type="button" class="form-control btn btn-sm btn-negro" name="btnregresar" id="btnregresar" value="Regresar"/>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-lg-offset-2" >
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading" > <?php echo $page_title;?>  </div>
			  			<div class="panel-body">
			  				<form action="<?php echo site_url('movimientos/negociacion/otrosduenos'); ?>" method="post">
								<div class="row">
										<div class="col-lg-3">
											<div class="form-group <?php if(form_error('idnegociacion')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Negociacion: </label>
												<input class="form-control" readonly type="text" name="idnegociacion" id="idnegociacion" value="<?php echo $idnegociacion; ?>" maxlength="30">
												<?php echo form_error('idnegociacion','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
								</div>
								<div class="row">
									<div class="col-lg-8">
										<div class="form-group">
											<input type="hidden" name="hcliente" id="hcliente" value="" />
											<label class="control-label" for="name"> Cliente: </label>
											<select class="form-control"  name="cliente" id="cliente"></select>										
										</div>
									</div>	
									<div class="col-lg-4">
										<div class="form-group">
											<label class="control-label" for="name" style="color:white">Boton</label>
											<button  id="btnAgregar" name="btnAgregar" class="form-control btn-success"> Agregar</button>										
										</div>
									</div>								
								</div>
							</form>

							<div class="row">
								<div class="col-lg-12">
									<button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal" data-target="#newClientModal">Nuevo cliente</button>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">

			                        <div class="form-search pull-right" data-tabla="gvClientes" style="padding: 10px;display:none;" >
			                            <input type="text" class="search-query form-control" placeholder="Buscar" />
			                        </div>
			                        <table class="table table-bordered table-condensed table-hover table-striped" id="gvClientes" data-orden="true" data-filtro="true" data-fuente="dtLlenar" data-seleccion="true">
			                            <thead>
			                                <tr>
			                                	<th class="hide" data-tipo="string" data-campo="idnegociacion" data-alineacion="centro" style="text-align: center">idnegociacion</th>
			                                	<th data-tipo="string" data-campo="idcliente" data-alineacion="centro" style="text-align: center">Código</th>
			                                	<th class="hide" data-tipo="string" data-campo="tipocliente" data-alineacion="centro" style="text-align: center">tipocliente</th>
			                                    <th data-tipo="string" data-campo="nombre" data-alineacion="centro" style="text-align: center">Nombre</th>
			                                    <th data-tipo="string" data-campo="apellido" data-alineacion="centro" style="text-align: center">Apellido</th>	                                    
			                                    <th data-boton="borrar" data-alineacion="centro" style="text-align: center">Eliminar</th>
			                                </tr>                            
			                            </thead>
			                            <tbody>
			                            </tbody>
			                        </table>
			                        <div class="text-center" style="display:none;">
			                            <div class="pagination">
			                                <ul class="pagination" data-tabla="gvClientes" data-cantidad="10" data-grupo="8"></ul>
			                            </div>
			                        </div>
				        		</div>									
							</div>



					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title">Confirmación</h4>
			      </div>
			      <div class="modal-body">
			        <p>Seguro que desea eliminar el registro? &hellip;</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <button type="button" id="botonEliminar" name="botonEliminar" class="btn btn-primary">Eliminar</button>
			      </div>
			    </div><!-- /.modal-content -->
		  	</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<div class="modal fade" id="newClientModal">
			<div class="modal-dialog">
			    <div class="modal-content">
			    <form action="<?php echo site_url('movimientos/negociacion/otrosduenostemporal'); ?>" method="post">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title">Nuevo Cliente</h4>
			      </div>
			      <div class="modal-body">
			      	<input class="form-control" readonly type="hidden" name="idnegociacion" id="idnegociacion" value="<?php echo $idnegociacion; ?>" maxlength="30">
			      	<div class="row" style="display:<?php if (!isset($mensaje2) || $mensaje2=="") echo "none"; ?>">
						<div class="col-lg-12">
							<div class="alert <?php echo $tipoAlerta2;?>">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<?php echo $mensaje2;?>	
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
										<div class="col-lg-6">
											<div class="form-group <?php if(form_error('nombre')) echo 'has-error'; ?>">
												<label class="control-label" for="name">Nombres *: </label>
												<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo set_value('nombre'); ?>" maxlength="30" >
												<?php echo form_error('nombre','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group <?php if(form_error('apellido')) echo 'has-error'; ?>">
												<label class="control-label" for="name">Apellidos *: </label>
												<input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo set_value('apellido'); ?>" maxlength="30" >
												<?php echo form_error('apellido','<div class="help-block" >','</div>'); ?>
											</div>
										</div>							
									</div>

									<div class="row">
										<div class="col-lg-4">
											<div class="form-group <?php if(form_error('nit')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Nit *: </label>
												<input type="text" class="form-control" name="nit" id="nit" value="<?php echo set_value('nit'); ?>" maxlength="30" >
												<?php echo form_error('nit','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group <?php if(form_error('fecnacimiento')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Fecha de nacimiento *: </label>
												<input type="text" name="fecnacimiento" id="fecnacimiento" value="<?php echo set_value('fecnacimiento'); ?>">
												<!--<div class='input-group date' id='dpFecha'>
													<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="<?php echo set_value('fecnacimiento'); ?>" maxlength="30" >
													<span class="input-group-addon">
								                        <span class="glyphicon glyphicon-calendar"></span>
								                    </span>
								                </div>-->
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
									</div>

									<div class="row">
										<div class="col-lg-4">
											<div class="form-group <?php if(form_error('dpi')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> DPI *: </label>
												<input type="text" class="form-control" name="dpi" id="dpi" value="<?php echo set_value('dpi'); ?>" maxlength="13" />
												<?php echo form_error('dpi','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group <?php if(form_error('estadocivil')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Estado civil *: </label>
												<input type="text" class="form-control" name="estadocivil" id="estadocivil" value="<?php echo set_value('estadocivil'); ?>" />
												<?php echo form_error('estadocivil','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group <?php if(form_error('profesion')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Profesión *: </label>
												<input type="text" class="form-control" name="profesion" id="profesion" value="<?php echo set_value('profesion'); ?>" />
												<?php echo form_error('profesion','<div class="help-block" >','</div>'); ?>
											</div>
										</div>					
									</div>

									<div class="row">
										<div class="col-lg-6">
											<div class="form-group <?php if(form_error('correo')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Correo Electrónico *: </label>
												<input type="text" class="form-control" name="correo" id="correo" value="<?php echo set_value('correo'); ?>" />
												<?php echo form_error('correo','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group <?php if(form_error('telefono')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Teléfono *: </label>
												<input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo set_value('telefono'); ?>" maxlength="8">
												<?php echo form_error('telefono','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group <?php if(form_error('celular')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Celular *: </label>
												<input type="text" class="form-control" name="celular" id="celular" value="<?php echo set_value('celular'); ?>" maxlength="8">
												<?php echo form_error('celular','<div class="help-block" >','</div>'); ?>
											</div>
										</div>				
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group <?php if(form_error('direccion')) echo 'has-error'; ?>">
												<label class="control-label" for="name"> Dirección *: </label>
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
												<label class="control-label" for="name">Empresa *: </label>
												<input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo set_value('empresa'); ?>" />
												<?php echo form_error('empresa','<div class="help-block" >','</div>'); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group <?php if(form_error('tiempolabor')) echo 'has-error'; ?>">
												<label class="control-label" for="name">Tiempo de laborar *: </label>
												<input type="text" class="form-control" name="tiempolabor" id="tiempolabor" value="<?php echo set_value('tiempolabor'); ?>" />
												<?php echo form_error('tiempolabor','<div class="help-block" >','</div>'); ?>
											</div>
										</div>							
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group <?php if(form_error('dirtrabajo')) echo 'has-error'; ?>">
												<label class="control-label" for="name">Dirección de trabajo *	: </label>
												<input type="text" class="form-control" name="dirtrabajo" id="dirtrabajo" value="<?php echo set_value('dirtrabajo'); ?>" />
												<?php echo form_error('dirtrabajo','<div class="help-block" >','</div>'); ?>
											</div>
										</div>							
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group <?php if(form_error('puesto')) echo 'has-error'; ?>">
												<label class="control-label" for="name">Puesto *: </label>
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

								</div>
							</div>
						</div>
			     	 </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			        <button type="submit" id="botonGuardar" name="botonGuardar" class="btn btn-success">Guardar</button>
			      </div>
			    </form>
			    </div><!-- /.modal-content -->
		  	</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	<div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/otrosduenos.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/bootstrap-birthday.js';?>"></script>
	<script type="text/javascript">

		$("#fecnacimiento").bootstrapBirthday({
			dateFormat: "bigEndian",
			monthFormat: "long", 
			minAge: "15",
			maxAge: "80",
			onChange: function(){ 
				calcularEdad($("#fecnacimiento").val()); 
			} 
		});

	</script>

	<?php echo $footer;?>
		