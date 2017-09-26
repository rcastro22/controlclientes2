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
		<div class="col-lg-10 col-lg-offset-1">
			<ul class="nav nav-tabs">
				<li role="presentation"><a href="<?php echo base_url().'movimientos/negociacion/edit/'.$idnegociacion;?>">General</a></li>
				<li role="presentation" class="active"><a href="<?php echo base_url().'movimientos/listacomprobacion/listado/'.$idnegociacion;?>">CheckList</a></li>
				<li role="presentation"><a href="<?php echo base_url().'movimientos/cuota/listado/'.$idnegociacion;?>">Cuotas</a></li>
				<li role="presentation"><a href="<?php echo base_url().'movimientos/pagos/listado/'.$idnegociacion;?>">Detlle de pagos</a></li>
				<li role="presentation"><a href="<?php echo base_url().'movimientos/negociacion/pago/'.$idnegociacion;?>">Pagar</a></li>
			</ul>
			<br/>
			<div class="panel panel-default">
		  		<div class="panel-heading panel-heading-extras" height="30px"> 
		  			<?php echo $page_title;?>  		  					  	
		  		</div>
	  			<div class="panel-body" style="overflow-x: auto">

	  				<div>								
						<div class="col-lg-6 form-horizontal">
							<div class="form-group">
								<label class="control-label col-lg-3 hidden" for="name"> Negociación: </label>						
								<div class="col-lg-9">
									<input readonly type="text" class="form-control hidden" name="idnegociacion" id="idnegociacion" value="<?php echo $idnegociacion; ?>" />												
								</div>
							</div>
						</div>	
						<div class="col-lg-6 form-horizontal">
								<div class="form-group">
									<input type="hidden" name="hcliente" id="hcliente" value="<?php echo $datosnegociacion->idcliente; ?>" />
									<label class="col-lg-3 control-label hidden" for="name"> Cliente: </label>
									<div class="col-lg-9">
										<select class="form-control hidden" readonly name="cliente" id="cliente"></select>										
									</div>
								</div>
							</div>										
					</div>

					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Documento de reserva COMPLETO y firmado por el vendedor y el cliente
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha1'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Proyección de fraccionamiento de enganche y financiamiento bancario, firmado por el vendedor y el cliente
						        </label>
						      </div>
						    </div>
						  <div class="col-sm-2">
								<div class='input-group date' id='dpFecha2'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Plano de arquitectura de los inmuebles
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha3'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Copia de DPI
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha4'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Copia de Carné de NIT y RTU
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha5'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Copia de cheque de reserva
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha6'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Indicar si es cliente FHA, crédito directo o al contado
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha7'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Acuerdos, descuentos o puntos extras acordados
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha8'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						  </div>
					</div>
					<div class="row">
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-4">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"> Listado de upgrades solicitados por el cliente, firmado por él y vendedor
						        </label>
						      </div>
						    </div>
						    <div class="col-sm-2">
								<div class='input-group date' id='dpFecha9'>
									<input type="text" class="form-control" name="fecnacimiento" id="fecnacimiento" value="" >
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
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
		        <p>Seguro que desea anular el pago? &hellip;</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="button" id="botonEliminar" name="botonEliminar" class="btn btn-primary">Anular</button>
		      </div>
		    </div><!-- /.modal-content -->
	  	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/movimientos/pagos/listado.js';?>"></script> 
<script type="text/javascript">
	$('.date').datetimepicker({'format':'YYYY-MM-DD'});
</script>
<?php echo $footer;?>


			


