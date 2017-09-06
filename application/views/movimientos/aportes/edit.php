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
			<div class="col-lg-10 col-lg-offset-1" >
				<div class="panel panel-default">
			  	<!-- Default panel contents -->
			  		<div class="panel-heading panel-heading-extras" > <?php echo $page_title;?>  </div>
			  			<div class="panel-body">
							
							<form action="<?php echo site_url('movimientos/aporte/edit'); ?>" method="post">
				
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										value="<?php echo $this->security->get_csrf_hash(); ?>">								

								<div class="row">
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('idaporte')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Aporte: </label>
											<input class="form-control" readonly type="text" name="idaporte" id="idaporte" value="<?php echo $datosaporte->idaporte; ?>" maxlength="10">
											<?php echo form_error('idaporte','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
									<div class="col-lg-5">
										<div class="form-group">
											<input type="hidden" name="hproyecto" id="hproyecto" value="<?php echo $datosaporte->idproyecto; ?>" />
											<label class="control-label" for="name"> Proyecto: </label>
											<select class="form-control" readonly name="proyectos" id="proyectos"></select>										
										</div>
									</div>

									<div class="col-lg-5">
										<div class="form-group">
											<input type="hidden" name="hinversionista" id="hinversionista" value="<?php echo $datosaporte->idinversionista; ?>" />
											<label class="control-label" for="name"> Inversionista: </label>
											<select class="form-control" readonly name="inversionista" id="inversionista"></select>										
										</div>
									</div>								
								</div>
								
								
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('fecha')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Fecha: </label>
											<input class="form-control" type="text" name="fecha" id="fecha" value="<?php echo $datosaporte->fecha; ?>" maxlength="10">
											<?php echo form_error('fecha','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
							
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('periodomeses')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Período (meses): </label>
											<input class="form-control" type="text" name="periodomeses" id="periodomeses" value="<?php echo $datosaporte->periodomeses; ?>" maxlength="10">
											<?php echo form_error('periodomeses','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('monto')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Monto: </label>
											<div class="input-group">
											<span id="spanmonto" name="spanmonto" class="input-group-addon">$.</span>
											<input class="form-control" readonly type="text" name="monto" id="monto" value="<?php echo $datosaporte->monto; ?>" maxlength="10">
											</div>
											<?php echo form_error('monto','<div class="help-block" >','</div>'); ?>										
										</div>
									</div>

									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('montopendiente')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Saldo capital: </label>
											<div class="input-group">
											<span id="spanmontopendiente" name="spanmontopendiente" class="input-group-addon">$.</span>
											<input class="form-control" readonly type="text" name="montopendiente" id="montopendiente" value="<?php echo $datosaporte->montopendiente; ?>" maxlength="10">
											</div>
											<?php echo form_error('montopendiente','<div class="help-block" >','</div>'); ?>										
										</div>
									</div>
								
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('interes')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Interés (%): </label>
											<input class="form-control" type="text" name="interes" id="interes" value="<?php echo $datosaporte->interes; ?>" maxlength="10">
											<?php echo form_error('interes','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								
									<div class="col-lg-2">
										<div class="form-group <?php if(form_error('formapagomeses')) echo 'has-error'; ?>">
											<label class="control-label" for="name"> Pago (meses): </label>
											<input class="form-control" type="text" name="formapagomeses" id="formapagomeses" value="<?php echo $datosaporte->formapagomeses; ?>" maxlength="10">
											<?php echo form_error('formapagomeses','<div class="help-block" >','</div>'); ?>
										</div>
									</div>
								</div>
								
								<div style="text-align:center">
									<button class="btn btn-lg btn-negro" id="modificar">Modificar</button>
								</div>
							</form>
							<br><br><br>
							<div class="row table-responsive">
							<div class="form-search pull-right input-group" data-tabla="gvBuscar">
								<span class="input-group-addon hide">Buscar</span>
		                		<input type="hidden" class="search-query form-control" placeholder="Ingrese su búsqueda" />
		        			</div>	
							<table class="table table-striped table-bordered table-hover tabla" data-orden="true" data-filtro="true" data-fuente="dtLlenar" id="gvBuscar">
								<thead>
				    				<tr>
			              				<th class="hide" data-tipo="string" data-campo="idaporte" data-alineacion="izquierda" style="text-align:center">APORTE</th>
			              				<th data-tipo="string" data-campo="nopago" data-alineacion="izquierda" style="text-align:center">NO. DE PAGO</th>	
			              				<th data-tipo="datetime" data-formato="dd/MM/yyyy" data-campo="fechapago" data-alineacion="izquierda" style="text-align:center">FECHA PAGO</th>		              				
			              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="pagocalculado" data-alineacion="derecha" style="text-align:center">INTERÉS CALCULADO</th>
			              				<th data-tipo="decimal" data-formato="#,###,###.##" data-campo="pagoefectuado" data-alineacion="derecha" style="text-align:center">INTERÉS PAGADO</th>			              				
			              				<!--<th data-boton="Ver" data-alineacion="centro" style="text-align:center">NEGOCIACIÓN</th>-->	     
			              				<!--<th data-boton="Modificar" data-alineacion="centro" style="text-align:center"></th>
			              				<th data-boton="Pagar" class-boton="btn-primary" data-alineacion="centro" style="text-align:center"></th>
			              				<th data-boton="Rescindir" data-alineacion="centro" style="text-align:center"></th>-->
			         				</tr>
				 				</thead>
			    				<tbody>
			    				</tbody>
							</table>
							</div>
						</div>
    					<div style="text-align:center">
							<div class="pagination">
								<ul class="pagination pagination-centered" data-tabla="gvBuscar" data-cantidad="10" data-grupo="8"></ul>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url().'assets/js/tabla.js';?>"></script>
	<script src="<?php echo base_url().'assets/js/movimientos/aportes/edit.js';?>"></script> 
	
	<?php echo $footer;?>
	<script>
		$('select[name=proyectos]').focus();
		$('#fecha').datepicker({'format':'yyyy-mm-dd'});
	</script>