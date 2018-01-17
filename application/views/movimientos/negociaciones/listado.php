<?php echo $headermov;?>
<div class="container">
</div>
	<div class="row" style="display:<?php if (!isset($mensaje) || $mensaje=="") echo "none"; ?>">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="alert <?php if (isset($tipoAlerta) && $tipoAlerta!="") echo $tipoAlerta;?>">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<?php  if (isset($mensaje) && $mensaje!="") echo $mensaje;?>	
			</div>
		</div>
	</div>
	<div class="row hidden">
		<div class="col-lg-10 col-lg-offset-1" >
			<div class="panel panel-default">
		  	<!-- Default panel contents -->
		  		<div class="panel-heading panel-heading-extras" > Datos cliente  </div>
		  			<div class="panel-body">
						<!--<form action="<?php echo site_url('movimientos/negociacion/pago'); ?>" method="post">-->
						
							<div>
								<div class="col-lg-6 form-horizontal">
									<div class="form-group">
										<label class="control-label col-lg-3" for="name"> Proyecto: </label>						
										<div class="col-lg-9">
											<input type="hidden" name="hproyecto" id="hproyecto" value="" />
											<select class="form-control" name="proyectos" id="proyectos"></select>		
										</div>
									</div>
								</div>
								<div class="col-lg-6 form-horizontal">
									<div class="form-group">
										<label class="control-label col-lg-3" for="name"> Cliente: </label>						
										<div class="col-lg-9">
											<input type="hidden" name="hcliente" id="hcliente" value="<?php echo $idcliente; ?>" />
											<select class="form-control" readonly name="ddcliente" id="ddcliente"></select>		
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
		  			<a href="<?php echo base_url().'movimientos/negociacion/nuevo/'.$idcliente;?>" class="btn btn-negro pull-right" style="padding-top: 0; padding-bottom: 0; vertical-align: middle;">Nueva negociación</a>
		  		</div>
	  			<div class="panel-body" style="overflow-x: auto">
	  				<div class="row">
	  					
	  						<div class="col-lg-1 col-xs-4 ">
				  				<label class="checkbox-inline">
									<input type="checkbox" id="CR" value="1"> Creados
								</label>
							</div>
							<?php if($datosusuario->tipousuario != '2') echo '
							<div class="col-lg-1 col-xs-4">
							<label class="checkbox-inline">
								<input type="checkbox" id="AP" value="2"> Aprobados
							</label>
							</div>
							<div class="col-lg-1 col-xs-4">
							<label class="checkbox-inline">
								<input type="checkbox" id="RS" value="3"> Resindidos
							</label>
							</div>
							'; ?> 
					</div>
					<br/>
					<div class="form-search pull-right input-group" data-tabla="gvBuscar">
						<span class="input-group-addon">Buscar</span>
                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
        			</div>	
					<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" data-seleccion="true" id="gvBuscar">
						<thead>
		    				<tr>
	              				<th data-tipo="string" data-campo="idnegociacion" data-alineacion="izquierda" style="text-align:center">NEGOCIACIÓN</th>
	              				<th data-tipo="string" data-campo="cliente" data-alineacion="izquierda" style="text-align:center">CLIENTE</th>
	              				<th class="hidden" data-tipo="string" data-campo="nombreinmueble" data-alineacion="izquierda" style="text-align:center">TIPO</th>
	              				<th class="hidden" data-tipo="string" data-campo="idinmueble" data-alineacion="izquierda" style="text-align:center">INMUEBLE</th>
	              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fecha" data-alineacion="izquierda" style="text-align:center">FECHA</th>
	              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="precioventa" data-alineacion="derecha" style="text-align:center">PRECIO</th>
	              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="reserva" data-alineacion="derecha" style="text-align:center">RESERVA</th>
	              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="enganche" data-alineacion="derecha" style="text-align:center">ENGANCHE</th>
	              				<th data-tipo="string" data-campo="banco" data-alineacion="derecha" style="text-align:center">BANCO</th>
	              				<th data-tipo="string" data-campo="status" data-alineacion="izquierda" style="text-align:center">ESTADO</th>
	              				<th data-tipo="string" data-campo="CreadoPor" data-alineacion="izquierda" style="text-align:center">CREADO POR</th>
	              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="FechaCreado" data-alineacion="izquierda" style="text-align:center">FECHA CREADO</th>
	              				<!--<th data-boton="Ver" data-alineacion="centro" style="text-align:center">NEGOCIACIÓN</th>-->	   
	              				<!--<th data-boton="Modificar" data-alineacion="centro" style="text-align:center"></th>-->

	              				<?php if($datosusuario->tipousuario != '2') echo '
	              				<th data-boton="Pagar" class-boton="btn-primary" data-alineacion="centro" style="text-align:center"></th>
	              				<th data-boton="Rescindir" data-alineacion="centro" style="text-align:center"></th>
								'; ?>  
								<!--<?php if($datosusuario->tipousuario != '2') echo '
	              				<th data-boton="Cuotas" data-alineacion="centro" style="text-align:center"></th>
	              				<th data-boton="Pagar" class-boton="btn-primary" data-alineacion="centro" style="text-align:center"></th>
	              				<th data-boton="Rescindir" data-alineacion="centro" style="text-align:center"></th>
	              				<th data-boton="Detalle pagos" data-alineacion="centro" style="text-align:center"></th>
								'; ?>  -->
	              				
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
		        <p>Seguro que desea rescindir la negociación? &hellip;</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="button" id="botonEliminar" name="botonEliminar" class="btn btn-primary">Rescindir</button>
		      </div>
		    </div><!-- /.modal-content -->
	  	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/movimientos/negociaciones/listado.js';?>"></script> 

<?php echo $footer;?>

<script>
	$('input[type=checkbox]').attr('checked','true');
</script>


			


