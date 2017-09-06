<?php echo $headermov;?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
		  		<div class="panel-heading"> 
		  			<div class="row">
		  				<div class="col-sm-2">
		  						<?php echo $page_title;?>
		  				</div>
		  				<div class="col-sm-2 col-sm-offset-6">
		  						Tipo de cambio:
		  				</div>
		  				<div class="col-sm-2">
		  						<input class="form-control" type="text" id="txtTipoCambio" name="txtTipoCambio"   readonly="true"/>
		  				</div>
		  			</div>
		  		</div>
	  			<div class="panel-body" style="overflow-x: auto">
	  				<div class="row" style="display:<?php if (!isset($mensaje) || $mensaje=="") echo "none"; ?>">
						<div class="col-lg-10 col-lg-offset-1">
							<div class="alert <?php echo $tipoAlerta;?>">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<?php echo $mensaje;?>	
							</div>
						</div>
					</div>
					
	  				<form action="<?php echo site_url('movimientos/asesor/grabarComision'); ?>" method="post">
		  				<div class="well">

			  				<div class="row">
			  					<div class="col-sm-1">
			  						<label class="control-label">
			  						Proyecto:
			  						</label>
			  					</div>
			  					<div class="col-sm-4 <?php if(form_error('nomproyecto')) echo 'has-error'; ?>">
			  						<input type="hidden" name="idnegociacion" id="idnegociacion" style="width:100%;" value="<?php echo $idnegociacion; ?>">
			  						<input type="hidden" name="idproyecto" id="idproyecto" style="width:100%;">
			  						<input class="form-control" type="text" name="nomproyecto" id="nomproyecto" style="width:100%;" readonly="true">	
			  						<?php echo form_error('nomproyecto','<div class="help-block" >','</div>'); ?>							
								</div>
								<div class="col-sm-1">
									<label class="control-label">
			  						Asesor:
			  						</label>
			  					</div>
			  					<div class="col-sm-4 <?php if(form_error('nomasesor')) echo 'has-error'; ?>">
			  						<input type="hidden" name="idasesor" id="idasesor" style="width:100%;">
			  						<input class="form-control" type="text" name="nomasesor" id="nomasesor" style="width:100%;" readonly="true">	
			  						<?php echo form_error('nomasesor','<div class="help-block" >','</div>'); ?>							
								</div>
								<div class="col-sm-1">
									<label class="control-label">
			  						Negociacion:
			  						</label>
			  					</div>
			  					<div class="col-sm-1 <?php if(form_error('idinmueble')) echo 'has-error'; ?>">
			  						<input class="form-control" type="text" name="idinmueble" id="idinmueble" style="width:100%;" readonly="true">	
			  						<?php echo form_error('idinmueble','<div class="help-block" >','</div>'); ?>						
								</div>
			  				</div>
			  				<br/>
			  				<div class="row">
				  				<div class="col-lg-2">
				  					<label class="control-label">
				  					Total Comisión:
				  					</label>
				  				</div>
				  				<div class="col-lg-2">
				  					<div class="input-group">
			  							<span class="input-group-addon">$
			  							</span>
				  						<input class="form-control"  type="text" name="totalcomision" id="totalcomision" style="width:100%;" readonly="true">
				  					</div>
				  				</div>
				  				<div class="col-lg-2">
				  					<label class="control-label">
				  					Total Pagado:
				  					</label>
				  				</div>
				  				<div class="col-lg-2">
				  					<div class="input-group">
			  							<span class="input-group-addon">$
			  							</span>
				  						<input class="form-control" type="text" name="totalpagado" id="totalpagado" style="width:100%;" readonly="true">
				  					</div>
				  				</div>
				  				<div class="col-lg-2">
				  					<label class="control-label">
				  					Status:
				  					</label>
				  				</div>
				  				<div class="col-lg-2">
				  					
				  					<input class="form-control" type="text" name="status" id="status" style="width:100%;" readonly="true">
				  					
				  				</div>
			  				</div>

			  			</div>
		  					<div class="row">
			  					<div class="col-sm-1">
			  						Serie:
			  					</div>
			  					<div class="col-sm-2 <?php if(form_error('noserie')) echo 'has-error'; ?>">
			  						<input class="form-control" type="text" name="noserie" id="noserie" style="width:100%;" value="<?php if (isset($varinserto)) {echo '';}else{echo set_value('noserie');} ?>" maxlength="10" >	
			  						<?php echo form_error('noserie','<div class="help-block" >','</div>'); ?>							
								</div>
								<div class="col-sm-1">
			  						Factura:
			  					</div>
			  					<div class="col-sm-2 <?php if(form_error('nofactura')) echo 'has-error'; ?>">
			  						<input class="form-control" type="text" name="nofactura" id="nofactura" style="width:100%;" value="<?php if (isset($varinserto)) {echo '';}else{echo set_value('nofactura');} ?>" maxlength="30">
			  						<?php echo form_error('nofactura','<div class="help-block" >','</div>'); ?>							
								</div>
								<div class="col-sm-1">
			  						Monto:
			  					</div>
			  					<div class="col-sm-2 <?php if(form_error('monto')) echo 'has-error'; ?>">
			  						<!--<input type="text" name="monto" id="monto" style="width:100%;" value="<?php echo set_value('varinserto'); ?>" maxlength="30">-->
			  						<div class="input-group">
			  							<span id="spanmonto" name="spanmonto" class="input-group-addon">$
			  							</span>
			  							<input class="form-control" type="text" name="monto" id="monto" style="width:100%;" value="<?php if (isset($varinserto)) {echo '';}else{echo set_value('monto');} ?>" maxlength="30">
			  						</div>
			  						<?php echo form_error('monto','<div class="help-block" >','</div>'); ?>							
								</div>

								<div class="col-sm-1">
			  						Fecha:
			  					</div>
								<div class="col-sm-2 <?php if(form_error('dpfechapago')) echo 'has-error'; ?>">
			  						<input class="form-control" type="text" name="dpfechapago" id="dpfechapago" value="<?php if (isset($varinserto)) {echo '';}else{echo set_value('dpfechapago');} ?>"  maxlength="10">
			  						<?php echo form_error('dpfechapago','<div class="help-block" >','</div>'); ?>							
								</div>

								<div class="col-sm-1">
			  						<button id="btnAgregar" class="btn btn-sm btn-negro">Agregar</button>						
								</div>

		  					</div>	 
		  								
		  				</form>		

		  			<br/>
					<div class="form-search pull-right input-group" data-tabla="gvBuscar" style="display:none;">
						<span class="input-group-addon">Buscar</span>
                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
        			</div>	
						<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscar">
						<thead>
		    				<tr>
	              				<th data-tipo="string" class="hidden" data-campo="idcorrelativo" data-alineacion="izquierda" style="text-align:center">CORRELATIVO</th>
	              				<th data-tipo="datetime" data-formato="dd/MM/yyyy"  data-campo="fechapago" data-alineacion="izquierda" style="text-align:center">FECHA PAGO</th>
	              				<th data-tipo="string" data-campo="noserie" data-alineacion="izquierda" style="text-align:center">No. SERIE</th>
	              				<th data-tipo="string" data-campo="nofactura" data-alineacion="izquierda" style="text-align:center">No. FACTURA</th>
	              				<th data-tipo="decimal"  data-campo="monto" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MONTO</th>
	              				<th data-boton="Eliminar" data-alineacion="centro" style="text-align:center"></th>
	              				
	         				</tr>
		 				</thead>
	    				<tbody>
	    				</tbody>
					</table>
				</div>
				<div style="text-align:center">
					<div class="pagination">
						<ul class="pagination pagination-centered" data-tabla="gvBuscar" data-cantidad="10" data-grupo="8"></ul>
						</div>
					</div>
				</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
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
		        <p>Seguro que desea eliminar el registro? &hellip;</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="button" id="botonEliminar" name="botonEliminar" class="btn btn-primary">Eliminar</button>
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
<script src="<?php echo base_url().'assets/js/movimientos/asesor/pagos.js';?>"></script> 

<?php echo $footer;?>
<script>
	
	$('#dpfechapago').datepicker({'format':'yyyy-mm-dd'});
</script>