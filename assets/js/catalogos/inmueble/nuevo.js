var base_url;

function cargarProyecto()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectos'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

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

function cargarTipoInmueble()
{
	$.get(
			base_url + 'catalogos/tipoinmueble/getTipoInmuebles'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.idtipoinmueble == $('#htipoinmueble').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idtipoinmueble);
				$option.html(linea.nombre);
				$('#tiposinmueble').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error tipo inmueble!!!');
		});
}

function cargarModelo()
{
	$.get(
			base_url + 'catalogos/modelo/getModelos'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.idmodelo == $('#hmodelo').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idmodelo);
				$option.html(linea.nombre);
				$('#modelos').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error modelo!!!');
		});
}

$(document).on('click','#botonRedirigir',function()
	                                   {
	                                   		window.location=base_url+"catalogos/inmueble/nuevo";
	                                   });

$(document).on('click','#botonListado',function()
	                                   {
	                                   		window.location=base_url+"catalogos/inmueble/listado";
	                                   });

$(document).ready(function()
{
	//alert("<?php echo $tipoAlerta ?>");

	base_url = $('base').attr('href');

	if($('#proyectos').length > 0)
		cargarProyecto();
	if($('#tiposinmueble').length > 0)
		cargarTipoInmueble();
	if($('#modelos').length > 0)
		cargarModelo();

});
