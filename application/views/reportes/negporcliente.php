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
        			<div style="text-align:center;">
        				<button type="button" id="btnExport" name="btnExport" class="btn btn-primary">Exportar Excel</button>
        			</div>
    			    <div id="divexp" name="divexp">
						<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscar">
						<thead>
		    				<tr>
		    					<th data-tipo="string" data-campo="idnegociacion" data-alineacion="centro" style="text-align:center">NEGOCIACIÓN</th>
	              				<th data-tipo="string" class="hidden" data-campo="idproyecto" data-alineacion="izquierda" style="text-align:center">ID PROYECTO</th>
	              				<th data-tipo="string" data-campo="nomproyecto" data-alineacion="izquierda" style="text-align:center">PROYECTO</th>
	              				<th data-tipo="string" class="hidden" data-campo="idcliente" data-alineacion="izquierda" style="text-align:center">ID CLIENTE</th>
	              				<th data-tipo="string" data-campo="nombre" data-alineacion="izquierda" style="text-align:center">NOMBRE</th>
	              				<th data-tipo="string" data-campo="apellido" data-alineacion="izquierda" style="text-align:center">APELLIDO</th>
	              				<th data-tipo="string" data-campo="celular" data-alineacion="izquierda" style="text-align:center">CELULAR</th>
	              				<th data-tipo="string" data-campo="nit" data-alineacion="izquierda" style="text-align:center">NIT</th>
	              				<th data-tipo="string" data-campo="dpi" data-alineacion="izquierda" style="text-align:center">DPI</th>
	              				<th data-tipo="string" class="hidden" data-campo="idasesor" data-alineacion="izquierda" style="text-align:center">ID ASESOR</th>
	              				<th data-tipo="string" data-campo="nomasesor" data-alineacion="izquierda" style="text-align:center">ASESOR</th>
	              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fecprimerpago" data-alineacion="izquierda" style="text-align:center">FECHA PRIMER PAGO</th>
	              				<th data-tipo="decimal" data-campo="precioventa" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">PRECIO VENTA</th>
	              				<th data-tipo="decimal" data-campo="reserva" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">RESERVA</th>
	              				<th data-tipo="string" data-campo="reciboreserva" data-alineacion="izquierda" style="text-align:center">RECIBO RESERVA</th>
	              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fechareserva" data-alineacion="izquierda" style="text-align:center">FECHA RESERVA</th>
	              				<th data-tipo="decimal" data-campo="enganche" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">ENGANCHE</th>
	              				<th data-tipo="decimal" data-campo="saldoenganche" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">SALDO ENGANCHE</th>
	              				<th data-tipo="decimal" data-campo="financiamientobanco" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">FINANCIAMIENTO BANCO</th>
	              				<th data-tipo="int" data-campo="nocuotas" data-alineacion="izquierda" style="text-align:center">NO. CUOTAS</th>
	              				<th data-tipo="decimal" data-campo="cuotamensual" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">CUOTA MENSUAL</th>
	              				<th data-tipo="decimal" data-campo="comision" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">COMISION</th>
	              				<th data-tipo="decimal" data-campo="banco" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">BANCO</th>
	              				<th data-tipo="string" data-campo="facturabanco" data-alineacion="izquierda" style="text-align:center">FACTURA BANCO</th>
	              				<th data-tipo="string" data-campo="status" data-alineacion="izquierda" style="text-align:center">STATUS</th>
	              				<th data-tipo="string" data-campo="clientejuridico" data-alineacion="izquierda" style="text-align:center">CLIENTE JURIDICO</th>
	              				<th data-tipo="string" data-campo="especifiquejuridico" data-alineacion="izquierda" style="text-align:center">ESPECIFIQUE JURIDICO</th>
	              				<th data-tipo="string" data-campo="nombramientojuridico" data-alineacion="izquierda" style="text-align:center">NOMBRAMIENTO JURIDICO</th>
	              				<th data-tipo="string" data-campo="monedacontrato" data-alineacion="izquierda" style="text-align:center">MONEDA</th>
	              				<th data-tipo="decimal" data-campo="tipocambioneg" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">TIPO DE CAMBIO</th>
	              				<th data-tipo="string" data-campo="formapago" data-alineacion="izquierda" style="text-align:center">FORMA DE PAGO</th>
	              				<th data-tipo="string" data-campo="plazocredito" data-alineacion="izquierda" style="text-align:center">PLAZO DE CREDITO</th>
	              				<th data-tipo="string" data-campo="tipofinanciamiento" data-alineacion="izquierda" style="text-align:center">TIPO DE FINANCIAMIENTO</th>
	              				<th data-tipo="string" data-campo="entidadautorizada" data-alineacion="izquierda" style="text-align:center">ENTIDAD AUTORIZADA</th>
	              				<th data-tipo="string" data-campo="idinmueble" data-alineacion="izquierda" style="text-align:center">ID INMUEBLE</th>
	              				<th data-tipo="decimal" data-campo="valor" data-alineacion="derecha" data-formato="#,##0.00" style="text-align:center">VALOR</th>
	              				<th data-tipo="string" data-campo="idtipoinmueble" data-alineacion="izquierda" style="text-align:center">ID TIPO INMUEBLE</th>
	              				<th data-tipo="string" data-campo="idmodelo" data-alineacion="izquierda" style="text-align:center">ID MODELO</th>
	              				<th data-tipo="string" data-campo="nomtipoinmueble" data-alineacion="izquierda" style="text-align:center">MODELO</th>
	              				<!--<th data-tipo="string" data-campo="idinmueble" data-alineacion="izquierda" style="text-align:center">INMUEBLE</th>
	              				<th data-tipo="decimal"  data-campo="moracalculada" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MORA A PAGAR</th>
	              				<th data-tipo="decimal"  data-campo="morapagada" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MORA PAGADA</th>
	              				<th data-tipo="int"  data-campo="diasmora" data-alineacion="derecha" style="text-align:right" >DÍAS MORA</th>
	              				<th data-tipo="decimal"  data-campo="debemora" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">DEBE MORA</th>
	              				<th data-tipo="decimal"  data-campo="cantpendientes" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">CUOTAS PENDIENTES</th>
	              				<th data-tipo="decimal"  data-campo="montopendiente" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MONTO PENDIENTE</th>-->
	         				</tr>
		 				</thead>
	    				<tbody>
	    				</tbody>
						</table>


						<!-----codigo para la tabla de totales-->
							
							
							
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
<script src="<?php echo base_url().'assets/js/reportes/negporcliente/negporcliente.js';?>"></script> 

<?php echo $footer;?>