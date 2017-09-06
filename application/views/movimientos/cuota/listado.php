<?php echo $headermov;?>
<div class="container">
	<div class="row" style="display:<?php if (!isset($mensaje) || $mensaje=="") echo "none"; ?>">
		<div class="col-12">
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
		  		<div class="panel-heading panel-heading-extras" > Datos cliente  </div>
		  			<div class="panel-body">
						<!--<form action="<?php echo site_url('movimientos/negociacion/pago'); ?>" method="post">-->
						
							<div>								
								<div class="col-lg-6 form-horizontal">
									<div class="form-group">
										<label class="control-label col-lg-3" for="name"> Negociación: </label>						
										<div class="col-lg-9">
											<input readonly type="text" class="form-control" name="idnegociacion" id="idnegociacion" value="<?php echo $idnegociacion; ?>" />												
										</div>
									</div>
								</div>	
								<div class="col-lg-4 form-horizontal">
									<div class="form-group">
										<label class="control-label col-lg-6" for="name"> Total saldo enganche: </label>						
										<div class="col-lg-6">
											<input readonly type="text" class="form-control" name="hmonto" id="hmonto" value="<?php echo $montototal; ?>" />
											<!--<select class="form-control" readonly name="dfactura" id="dfactura"></select>-->	
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
		<div class="col-lg-10 col-lg-offset-1">
			<div class="panel panel-default">
		  		<div class="panel-heading panel-heading-extras" height="30px"> 
		  			<?php echo $page_title;?>  
		  			<a class="btn btn-negro pull-right" style="padding-top: 0; padding-bottom: 0; vertical-align: middle;" id="eliminar">Eliminar cuota</a>&nbsp;&nbsp;
		  			<a href="<?php echo base_url().'movimientos/cuota/nuevo/'.$idnegociacion;?>" class="btn btn-negro pull-right" style="padding-top: 0; padding-bottom: 0; vertical-align: middle;">Nueva cuota</a>		  			
		  		</div>
	  			<div class="panel-body" style="overflow-x: auto">
					<div class="form-search pull-right input-group" data-tabla="gvBuscar">
						<span class="input-group-addon">Buscar</span>
                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
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
			              				<th data-boton="Modificar" data-alineacion="centro" style="text-align:center"></th>
			              				<!--<th data-boton="Pagar" class-boton="btn-primary" data-alineacion="centro" style="text-align:center"></th>
			              				<th data-boton="Rescindir" data-alineacion="centro" style="text-align:center"></th>-->
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
<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/movimientos/cuota/listado.js';?>"></script> 

<?php echo $footer;?>


			


