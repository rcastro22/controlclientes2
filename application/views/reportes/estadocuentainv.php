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
	  					Inversionista: 
	  				</div>
	  				<div>
	  					 <select class="form-control"   name="inversionistas" id="inversionistas"></select>
	  				</div>
	  				<br/>
	  				<div style="text-align:center;">
	  					Aporte: 
	  				</div>
	  				<div>
	  					 <select class="form-control"   name="aportes" id="aportes"></select>
	  				</div>
	  				<br/>
	  				<div style="text-align:center;">
	  					 <button id="btnConsultar" class="btn btn-sm btn-negro">Consultar</button>
	  				</div>
		  		</div>
	  			<div class="panel-body" style="overflow-x: auto">
					<div class="form-search pull-right input-group" data-tabla="gvPagosRealizados" style="display:none;">
						<span class="input-group-addon">Buscar</span>
                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
        			</div>	
        			<div style="text-align:center;">
        				<button type="button" id="btnExport" name="btnExport" class="btn btn-primary">Exportar Excel</button>
	        			</div>
	        			    <div id="divexp" name="divexp">
								
								<!-----codigo para la tabla de encabezado de reportes-->
	        			    	<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvEncabezado">
									<thead>
										<tr>
											<td colspan=8 style="text-align:center;">DATOS REPORTE</td>
										</tr>
					    				<tr>
					    					<th data-tipo="string" data-campo="nomproyecto" data-alineacion="izquierda" style="text-align:center">PROYECTO</th>
				              				<th data-tipo="string" data-campo="nominversionista" data-alineacion="izquierda" style="text-align:center">INVERSIONISTA</th>
				              				<th data-tipo="string" data-campo="idaporte" data-alineacion="izquierda" style="text-align:center">APORTE</th>
				              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fecha" data-alineacion="izquierda" style="text-align:center">FECHA</th>
				              				<th data-tipo="decimal" data-campo="monto" data-alineacion="izquierda" style="text-align:center" data-formato="#,##0.00">MONTO</th>
				              				<th data-tipo="decimal" data-campo="interes" data-alineacion="izquierda" style="text-align:center" data-formato="#,##0.00">INTERES(%)</th>
				              				<th data-tipo="int" data-campo="periodomeses" data-alineacion="izquierda" style="text-align:center" data-formato="#,##0.00">PERIODO(MESES)</th>
				              				<th data-tipo="int" data-campo="formapagomeses" data-alineacion="izquierda" style="text-align:center" data-formato="#,##0.00">FORMA PAGO(MESES)</th>
				              			</tr>
				 					</thead>
			    					<tbody>
			    					</tbody>
								</table>

								<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvPagosRealizados">
									<thead>
										<tr>
											<td colspan=4 style="text-align:center;">DETALLE DE PAGOS</td>
										</tr>
					    				<tr>
				              				
				              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fechapago" data-alineacion="izquierda" style="text-align:center">FECHA DE PAGO</th>
				              				<th data-tipo="string" data-campo="nomformapago" data-alineacion="izquierda" style="text-align:center">FORMA PAGO</th>
				              				<th data-tipo="string" data-campo="nodocumento" data-alineacion="izquierda" style="text-align:center">DOCUMENTO</th>
				              				<th data-tipo="decimal"  data-campo="monto" data-alineacion="derecha" style="text-align:right" data-formato="#,##0.00">MONTO</th>
				              			</tr>
				 					</thead>
			    					<tbody>
			    					</tbody>
								</table>


								<!-----codigo para la tabla de totales-->
								
								<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvDetallePagos">
									<thead>
										<tr>
											<td colspan=6 style="text-align:center;">ESTADO DE CUENTA</td>
										</tr>
					    				<tr>
				              				<th class="hide" data-tipo="string" data-campo="idaporte" data-alineacion="izquierda" style="text-align:center">APORTE</th>
			              					<th data-tipo="string" data-campo="nopago" data-alineacion="izquierda" style="text-align:center">NO. DE PAGO</th>
			              					<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="pagocalculado" data-alineacion="derecha" style="text-align:center">MONTO CALCULADO</th>
			              					<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="pagoefectuado" data-alineacion="derecha" style="text-align:center">PAGO EFECTUADO</th>
			              					</tr>
				 					</thead>
			    					<tbody>
			    					</tbody>
								</table>
								
								<!-- fin codigo para la tabla de totales-->

							</div>
						</div>

   						<!--div buscar y paginacion de la tabla de totales que no necestio exportar-->
   						<div class="form-search pull-right input-group" data-tabla="gvDetallePagos" style="display:none;">
									<span class="input-group-addon">Buscar</span>
			                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
			        	</div>	
			        	<div style="text-align:center;display:none;">
							<div class="pagination">
								<ul class="pagination pagination-centered" data-tabla="gvDetallePagos" data-cantidad="100" data-grupo="8"></ul>
							</div>
						</div>
						<!-- fin div buscar y paginacion de la tabla de totales que no necesito exportar-->

 						
 						<!--div buscar y paginacion de la tabla de encabezado que no necestio exportar-->
   						<div class="form-search pull-right input-group" data-tabla="gvEncabezado" style="display:none;">
									<span class="input-group-addon">Buscar</span>
			                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
			        	</div>	
			        	<div style="text-align:center;display:none;">
							<div class="pagination">
								<ul class="pagination pagination-centered" data-tabla="gvEncabezado" data-cantidad="100" data-grupo="8"></ul>
							</div>
						</div>
						<!-- fin div buscar y paginacion de la tabla de totales que no necesito exportar-->

						<!--div buscar y paginacion de la tabla de compras que no necestio exportar-->
   						<div class="form-search pull-right input-group" data-tabla="gvCompras" style="display:none;">
									<span class="input-group-addon">Buscar</span>
			                		<input type="text" class="search-query form-control" placeholder="Ingrese su búsqueda" />
			        	</div>	
			        	<div style="text-align:center;display:none;">
							<div class="pagination">
								<ul class="pagination pagination-centered" data-tabla="gvCompras" data-cantidad="100" data-grupo="8"></ul>
							</div>
						</div>
						<!-- fin div buscar y paginacion de la tabla de compras que no necesito exportar-->

						<div style="text-align:center">
							<div class="pagination">
								<ul class="pagination pagination-centered" data-tabla="gvPagosRealizados" data-cantidad="10000" data-grupo="8"></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
		</div>
	</div>
</div>

<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/reportes/estadocuentainv/estadocuentainv.js';?>"></script> 

<?php echo $footer;?>