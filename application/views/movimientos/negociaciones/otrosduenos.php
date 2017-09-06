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
									<div class="col-lg-2">
										<div class="form-group">
											<label class="control-label" for="name"></label>
											<button  id="btnAgregar" name="btnAgregar" class="form-control"> Agregar</select>										
										</div>
									</div>								
								</div>
							</form>

							<div class="row">
								<div class="col-lg-11">

			                        <div class="form-search pull-right" data-tabla="gvClientes" style="padding: 10px;display:none;" >
			                            <input type="text" class="search-query form-control" placeholder="Buscar" />
			                        </div>
			                        <table class="table table-bordered table-condensed table-hover table-striped" id="gvClientes" data-orden="true" data-filtro="true" data-fuente="dtLlenar" data-seleccion="true">
			                            <thead>
			                                <tr>
			                                	<th class="hide" data-tipo="string" data-campo="idnegociacion" data-alineacion="centro" style="text-align: center">idnegociacion</th>
			                                	<th data-tipo="string" data-campo="idcliente" data-alineacion="centro" style="text-align: center">Código</th>
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
	<div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/otrosduenos.js';?>"></script> 

	<?php echo $footer;?>
		