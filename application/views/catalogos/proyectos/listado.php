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
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading panel-heading-extras" height="30px"> 
			  			<?php echo $page_title;?>  
			  			<a href="<?php echo base_url().'catalogos/proyecto/nuevo';?>" class="btn btn-negro pull-right" style="padding-top: 0; padding-bottom: 0; vertical-align: middle;">Nuevo</a>			  			
			  		</div>
		  			<div class="panel-body" style="overflow-x: auto">
		  				<!--<button type="button" id="btnExport" name="btnExport" class="btn btn-primary">Exportar</button>-->
                        
                        <div class="form-search pull-right input-group" data-tabla="gvBuscar">
							<span class="input-group-addon">Buscar</span>
	                		<input type="text" class="search-query form-control" placeholder="Ingrese lo que dese buscar" />
	        			</div>
	        			<!--<div id="divexp">-->
        				<table id="gvBuscar" class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar">
							<thead>
			    				<tr>
                      				<th data-tipo="int" data-campo="idproyecto" data-alineacion="centro" style="text-align:center">CODIGO</th>
                      				<th data-tipo="string" data-campo="nombre" data-alineacion="izquierda" style="text-align:center">NOMBRE</th>
                      				<th data-tipo="int" data-campo="dialimite" data-alineacion="derecha" style="text-align:center">DIA MORA</th>
                      				<th data-tipo="int" data-campo="porcentajemora" data-alineacion="derecha" style="text-align:center">MORA(%)</th>
                      				<th data-boton="Modificar" data-alineacion="centro" style="text-align:center"></th>
                      				<th data-boton="Eliminar" data-alineacion="centro" style="text-align:center"></th>
                 				</tr>
			 				</thead>
		    				<tbody>
		    				</tbody>
						</table>
						<!--</div>-->
					</div>
					<div style="text-align:center">
						<div class="pagination">
							<ul class="pagination pagination-centered" data-tabla="gvBuscar" data-cantidad="10" data-grupo="8" style="margin:0px 0px;"></ul>
   						</div>
   					</div>
	   			</div>
	    		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
			</div>
			<div class="col-lg-1">
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


	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
	<script src="<?php echo base_url().'assets/js/catalogos/proyectos/listado.js';?>"></script> 
<?php echo $footer;?>





