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
		  		<div class="panel-heading panel-heading-extras" > </div>
		  			<div class="panel-body">
							<div class="row">
								<div class="col-lg-6 col-lg-offset-3 form-horizontal">
									<div class="form-group">
										<label class="control-label col-lg-3" for="name"> Proyecto: </label>						
										<div class="col-lg-9">
											<input type="hidden" name="hproyecto" id="hproyecto" value="" />
											<select class="form-control" name="proyectos" id="proyectos"></select>		
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-lg-offset-3 form-horizontal">
									<div class="form-group">					
										<div class="col-lg-6 col-lg-offset-3">
											<input type="button" class="btn btn-lg btn-negro" id="recordatorio" value="Enviar Recordatorio" data-toggle="modal" data-target="#modalEmail" disabled="true">	
										</div>
									</div>
								</div>									
							</div>
					</div>
			</div>
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

	<div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Recordatorio</h4>
	      </div>
	      <div class="modal-body">
		     <p>¿Esta seguro que desea enviar el recordatorio de pago?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="button" id="enviarRecordatorio" name="enviarRecordatorio" class="btn btn-primary" >Enviar recordatorio</button>
	        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
	      </div>
	    </div>
	  </div>
	</div>
</div>
<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script> 
<script src="<?php echo base_url().'assets/js/movimientos/recordatoriopago/listado.js';?>"></script> 

<?php echo $footer;?>


			


