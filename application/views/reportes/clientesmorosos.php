<?php echo $headerrep;?>
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
		  				<br/>
		  				<div style="text-align:center;">
		  					 <button id="btnConsultar" class="btn btn-sm btn-negro">Consultar</button>
		  				</div>
		  		</div>
	  			<div class="panel-body" style="overflow-x: auto">
					<div class="form-search pull-right input-group" data-tabla="gvBuscar">
						<span class="input-group-addon">Buscar</span>
                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
        			</div>	
        			<div style="text-align:center;">
        				<button type="button" id="btnExport" name="btnExport" class="btn btn-primary">Exportar Excel</button>
        			</div>
    			    <div id="divexp" name="divexp">
						<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscar">
						<thead>
		    				<tr>
		    					
	              				<th data-tipo="string" class="hidden" data-campo="idproyecto" data-alineacion="izquierda" style="text-align:center">ID PROYECTO</th>
	              				<th data-tipo="string" data-campo="nomproyecto" data-alineacion="izquierda" style="text-align:center">PROYECTO</th>
	              				<th data-tipo="string" class="hidden" data-campo="idcliente" data-alineacion="izquierda" style="text-align:center">ID CLIENTE</th>
	              				<th data-tipo="string" data-campo="apellido" data-alineacion="izquierda" style="text-align:center">APELLIDO</th>
	              				<th data-tipo="string" data-campo="nombre" data-alineacion="izquierda" style="text-align:center">NOMBRE</th>
	              				<!--<th data-tipo="string" data-campo="idinmueble" data-alineacion="izquierda" style="text-align:center">INMUEBLE</th>-->
	              				<th data-tipo="string" data-campo="idnegociacion" data-alineacion="izquierda" style="text-align:center">NEGOCIACION</th>
	              				<th data-tipo="decimal"  data-campo="moracalculada" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MORA A PAGAR</th>
	              				<th data-tipo="decimal"  data-campo="morapagada" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MORA PAGADA</th>
	              				<th data-tipo="int"  data-campo="diasmora" data-alineacion="derecha" style="text-align:right" >DÍAS MORA</th>
	              				<th data-tipo="decimal"  data-campo="debemora" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">DEBE MORA</th>
	              				<th data-tipo="decimal"  data-campo="cantpendientes" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">CUOTAS PENDIENTES</th>
	              				<th data-tipo="decimal"  data-campo="montopendiente" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MONTO PENDIENTE</th>
	         				</tr>
		 				</thead>
	    				<tbody>
	    				</tbody>
						</table>


						<!-----codigo para la tabla de totales-->
							
							<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscarTotales">
								<thead>
				    				<tr>
			              				<th data-tipo="string" class="hidden" data-campo="idproyecto" data-alineacion="izquierda" style="text-align:center">ID PROYECTO</th>
			              				<th data-tipo="decimal"  data-campo="moracalculadatotal" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">TOTAL MORA CALCULADA</th>
			              				<th data-tipo="decimal"  data-campo="morapagadatotal" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">TOTAL MORA PAGADA</th>
			              				<th data-tipo="decimal"  data-campo="debemoratotal" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">TOTAL DEBE MORA</th>
			         				</tr>
			 					</thead>
		    					<tbody>
		    					</tbody>
							</table>
							
							<!-- fin codigo para la tabla de totales-->

					</div>
				</div>

				<!--div buscar y paginacion de la tabla de totales que no necestio exportar-->
				<div class="form-search pull-right input-group" data-tabla="gvBuscarTotales" style="display:none;">
							<span class="input-group-addon">Buscar</span>
	                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
	        	</div>	
	        	<div style="text-align:center;display:none;">
					<div class="pagination">
						<ul class="pagination pagination-centered" data-tabla="gvBuscarTotales" data-cantidad="10" data-grupo="8"></ul>
					</div>
				</div>
				<!-- fin div buscar y paginacion de la tabla de totales que no necesito exportar-->

				<div style="text-align:center;display:none;">
					<div class="pagination">
						<ul class="pagination pagination-centered" data-tabla="gvBuscar" data-cantidad="10000" data-grupo="8"></ul>
						</div>
					</div>
				</div>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
			</div>
		</div>
</div>

<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/reportes/clientesmorosos/clientesmorosos.js';?>"></script> 

<?php echo $footer;?>