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
		<div class="col-lg-12">
			<div class="panel panel-default">
		  		<div class="panel-heading panel-heading-extras" height="30px"> 
		  			<?echo $page_title;?>  
		  			<a href="<?php echo base_url().'catalogos/cliente/nuevo';?>" class="btn btn-negro pull-right" style="padding-top: 0; padding-bottom: 0; vertical-align: middle;">Nuevo</a>
		  		</div>
	  			<div class="panel-body">
					<div class="form-search pull-right input-group" data-tabla="gvBuscar">
						<span class="input-group-addon">Buscar</span>
                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
        			</div>	
						<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscar">
						<thead>
		    				<tr>
	              				<th data-tipo="string" data-campo="ClienteNit" data-alineacion="izquierda" style="text-align:center">NIT</th>
	              				<th data-tipo="string" data-campo="ClienteComercial" data-alineacion="izquierda" style="text-align:center">NOMBRE</th>
								<th class="hide" data-tipo="string" data-campo="ClienteNombre" data-alineacion="izquierda" style="text-align:center">NOMBRES</th>
	              				<th class="hide" data-tipo="string" data-campo="ClienteTelefonos" data-alineacion="izquierda" style="text-align:center">TELÉFONOS</th>
	              				<th class="hide" data-tipo="string" data-campo="ClienteContacto" data-alineacion="izquierda" style="text-align:center">CONTACTO</th>
								<th class="hide" data-tipo="bool" data-campo="ClienteComision" data-alineacion="centro" style="text-align:center">COMISIÓN</th>
	              				<th class="hide" data-tipo="decimal" data-campo="ClienteSaldoInicial" data-alineacion="derecha" style="text-align:center">SALDO</th>
	              				<th class="hide" data-tipo="decimal" data-campo="ClienteCreditoLimite" data-alineacion="derecha" style="text-align:center">LÍMITE CRÉDITO</th>
	              				<th class="hide" data-tipo="int" data-campo="ClienteCreditoDias" data-alineacion="derecha" style="text-align:center">DÍAS CRÉDITO</th>
	              				<th class="hide" data-tipo="int" data-campo="ClienteListaID" data-alineacion="centro" style="text-align:center">LISTA PRECIO</th>
	              				<th class="hide" data-tipo="string" data-campo="ListaNombre" data-alineacion="centro" style="text-align:center">LISTA DE PRECIOS</th>
	              				<th class="hide" data-tipo="bool" data-campo="ClienteStatus" data-alineacion="centro" style="text-align:center">STATUS</th>
	              				<th class="hide" data-tipo="int" data-campo="ClienteVendedorID" data-alineacion="izquierda" style="text-align:center">CODIGO VENDEDOR</th>
	              				<th class="hide" data-tipo="string" data-campo="VendedorNombre" data-alineacion="izquierda" style="text-align:center">VENDEDOR</th>
	              				<th class="hide" data-tipo="string" data-campo="ClienteEmail" data-alineacion="izquierda" style="text-align:center">E-MAIL</th>
	              				<th class="hide" data-tipo="string" data-campo="ClienteObservaciones" data-alineacion="derecha" style="text-align:center">OBSERVACIONES</th>
	              				<th data-tipo="decimal" data-campo="Saldo" data-alineacion="derecha" style="text-align:center" data-formato="#,##0.00">SALDO</th>
	              				<th data-boton="Ver..." data-alineacion="centro" style="text-align:center">Edo. Cuenta</th>
	              				<th data-boton="Ver..." data-alineacion="centro" style="text-align:center">Compras</th>
	              				<th data-boton="Modificar" data-alineacion="centro" style="text-align:center"></th>
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
<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/catalogos/clientes/listado.js';?>"></script> 
<?php echo $footer;?>


			


