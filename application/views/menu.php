<?php echo $headerprincipal;?>
	<div class="container">
		<div class="row" style="width:60%;margin:auto">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title" style="text-align:center;">Menú Principal</h3>
			  </div>
			  <div class="panel-body" style="text-align:center;">
			  	
				<div class="row">
					<a  href="<?php echo base_url().'catalogos/menucat';?>"  class="btn btn-default btn-md" role="button"
						style="<?php if($datosusuario->tipousuario != '1' && $datosusuario->tipousuario != '0') echo 'display:none'; ?>">
					  <i class="glyphicon glyphicon-list"></i>
					  <span>&nbsp;&nbsp;&nbsp;Catálogos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</a>
					<a  href="<?php echo base_url().'movimientos/menumov';?>" class="btn btn-default btn-md" role="button">
					  <i class="glyphicon glyphicon-transfer"></i>
					  <span>&nbsp;Movimientos&nbsp;&nbsp;</span>
					</a>
					<a  href="<?php echo base_url().'reportes/menurep';?>" class="btn btn-default btn-md" role="button"
						style="<?php if($datosusuario->tipousuario != '1' && $datosusuario->tipousuario != '0') echo 'display:none'; ?>">
					  <i class="glyphicon glyphicon-tags"></i>
					  <span>&nbsp;&nbsp;&nbsp;&nbsp;Reportes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</a>
					

					<a  href="<?php echo base_url().'admin/menuadmin';?>" class="btn btn-default btn-md" role="button" 
						style="<?php if($datosusuario->tipousuario != '1') echo 'display:none'; ?>">
					  <i class="glyphicon glyphicon-cog"></i>
					  <span>Administración</span>
					</a>
				</div>
				<br/>
				<div class="row">
					<img src="<?php echo base_url() . 'assets/img/portadafabra.png'; ?>" alt="Logo"
	         				 style="height: 300px;" class="img-responsive img-rounded"/>
				</div>
			  </div>
		</div>
	</div>
</div>
<?php echo $footer;?>