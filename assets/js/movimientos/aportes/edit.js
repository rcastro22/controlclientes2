var base_url;
var newArray = [];


function cargarProyecto()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectos'		
		)
		.done(function(data)
		{
			var $option ='';
			/*$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione Proyecto');
			$('#proyectos').append($option);*/
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
			//$('#proyectos').select2();
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
}

function cargarInversionistas()
{
	$.get(
			base_url + 'catalogos/inversionista/getInversionista'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.idinversionista == $('#hinversionista').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idinversionista);
				$option.html(linea.nombre);
				$('#inversionista').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error inversionistas!!!');
		});
}

$(document).ready(function()
{
	//alert("<?php echo $tipoAlerta ?>");

	base_url = $('base').attr('href');


	if($('#proyectos').length > 0)
		cargarProyecto();
	if($('#inversionista').length > 0)
		cargarInversionistas();

	$("#gvBuscar").tabla(base_url+'movimientos/aporte/getDetallePagoInversion/'+$('#idaporte').val());

});
