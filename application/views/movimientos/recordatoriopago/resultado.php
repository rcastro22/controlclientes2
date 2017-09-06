<?php echo $headermov;?>
<div class="container">
	<div class="row">
		<dir class="col-lg-2 col-lg-offset-5">
			<a href="<?php echo base_url().'movimientos/recordatoriopago/listado/';?>" class="btn btn-primary" >Regresar</a>
		</dir>
	</div>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1" >
			<div class="panel panel-default">
		  	<!-- Default panel contents -->
		  		<div class="panel-heading panel-heading-extras" > </div>
		  			<div class="panel-body">
							<div>
								<div class="row" style="display:<?php if (!isset($mensaje) || $mensaje=="") echo "none"; ?>">
									<div class="col-12 ">
										<div class="alert <?php echo $tipoAlerta;?>">
											<a href="#" class="close" data-dismiss="alert">&times;</a>
											<?php echo $mensaje;?>	
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-lg-offset-3 form-horizontal">
									<div class="form-group">					
										<div class="col-lg-12">
											<label class="col-12" style="text-align: center;">Lista de correos electronicos no enviados</label>
											<input type="hidden" name="hproyecto" id="hproyecto" value="<?php echo $nuevolist; ?>" />		
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-lg-12">
										<div>
					                        <div class="form-search pull-right" data-tabla="gvProductos" style="padding: 10px;display:none;" >
					                            <input type="text" class="search-query form-control" placeholder="Buscar" />
					                        </div>
					                        <table class="table table-bordered table-condensed table-hover table-striped" id="gvProductos" data-orden="true" data-filtro="true" data-fuente="dtLlenar" data-seleccion="true">
					                            <thead>
					                                <tr>
					                                	<!--<th class="hide" data-tipo="string" data-campo="idnegociacion" data-alineacion="centro" style="text-align: center">Código negociacion</th>-->
					                                	<th data-tipo="string" data-campo="idcliente" data-alineacion="centro" style="text-align: center">Cliente</th>
					                                	<th data-tipo="string" data-campo="nombrecliente" data-alineacion="centro" style="text-align: center">Nombre</th>
					                                    <th data-tipo="string" data-campo="idnegociacion" data-alineacion="centro" style="text-align: center">Negociacion</th>
					                                    <th data-tipo="string" data-campo="alerta" data-alineacion="centro" style="text-align: center">Motivo</th>
					                              
					                                </tr>                            
					                            </thead>
					                            <tbody>
					                            </tbody>
					                        </table>
					                        <div class="text-center" style="display:none;">
					                            <div class="pagination">
					                                <ul class="pagination" data-tabla="gvProductos" data-cantidad="100" data-grupo="8"></ul>
					                            </div>
					                        </div>
					                        <div class="row">
					                            <div class="col-md-7">
					                                <strong><input style="display:none;" class="form-control form-control input-lg" type="text" name="txtTotalDecimal" id="txtTotalDecimal" style="text-align:right" readonly="true" value=""></strong>
					                            </div>
					                            <div class="col-md-5">
					                                <div id="circulo"></div>
					                            </div>
					                            <!--<div class="col-md-3" >
					                                <div class="form-group">
					                                    <label class="control-label" for="conversion">Precio:</label>
					                                    <div class="input-group">      
					                                        <span class="input-group-addon">$.</span>
					                                        <strong><input class="form-control form-control input-lg" type="text" name="txtTotal" id="txtTotal" style="text-align:right" readonly="true"></strong>
					                                    </div>
					                                </div>
					                            </div>-->
					                        </div>					                        
					                    </div> 
									</div>									
								</div>


							</div>
					</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/movimientos/recordatoriopago/resultado.js';?>"></script> 

<?php echo $footer;?>


			


