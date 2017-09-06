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
		<div class="col-lg-10 col-lg-offset-1">
			<div class="panel panel-default">
		  		<div class="panel-heading"> 
		  			
		  				<div style="text-align:center;">
		  					<?php echo $page_title;?> del Proyecto: 
		  				</div>
		  				<div>
		  					 <select class="form-control"   name="proyectos" id="proyectos"></select>
		  				</div>
		  			
		  		</div>
	  			<div class="panel-body">
					<div class="form-search pull-right input-group" data-tabla="gvBuscar">
						<span class="input-group-addon">Buscar</span>
                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
        			</div>	
						<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscar">
						<thead>
		    				<tr>
	              				<th data-tipo="string" class="hidden" data-campo="idproyecto" data-alineacion="izquierda" style="text-align:center">ID PROYECTO</th>
	              				<th data-tipo="string" data-campo="idasesor" data-alineacion="izquierda" style="text-align:center">ID ASESOR</th>
	              				<th data-tipo="string" data-campo="idnegociacion" data-alineacion="izquierda" style="text-align:center">ID NEGOCIACION</th>
	              				<th data-tipo="string" data-campo="apellido" data-alineacion="izquierda" style="text-align:center">APELLIDO</th>
	              				<th data-tipo="string" data-campo="nombre" data-alineacion="izquierda" style="text-align:center">NOMBRE</th>
	              				<th data-tipo="decimal"  data-campo="comision" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">COMISION</th>
	              				<th data-tipo="decimal"  data-campo="pagado" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">PAGADO</th>
	              				<th data-tipo="string" data-campo="status" data-alineacion="izquierda" style="text-align:center">STATUS</th>
	              				<th data-boton="Pagos" data-alineacion="centro" style="text-align:center"></th>
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
<script src="<?php echo base_url().'assets/js/movimientos/asesor/listado.js';?>"></script> 

<?php echo $footer;?>