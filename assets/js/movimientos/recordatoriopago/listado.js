var base_url;
var clienteEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');

	if($('#proyectos').length > 0)
		cargarProyectos();

	
});

function cargarProyectos()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectos'
		)
		.done(function(data)
		{
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccionar proyecto');
			$('#proyectos').append($option);
			$.each(data,function(i,linea)
			{				
				if (linea.idproyecto == $('#hproyecto').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idproyecto);
				$option.html(linea.nombre);
				$('#proyectos').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
		
}

$(document).on('change','#proyectos',function(){
	$('#hproyecto').val($('#proyectos').val());

	if($('#hproyecto').val() == "" || $('#hproyecto').val() == null || $('#hproyecto').val() == 0){
		$("#recordatorio").attr("disabled",true);
	}
	else{
		//$("#gvBuscar").tabla(base_url+'movimientos/cliente/getClientePorProyecto/'+$('#hproyecto').val());
		$("#recordatorio").attr("disabled",false);
	}
});


$(document).on('click','#enviarRecordatorio',function()
	                                   {
	                                   		window.location=base_url+"movimientos/recordatoriopago/enviarRecordatorio/"+$('#hproyecto').val();
	                                   });

