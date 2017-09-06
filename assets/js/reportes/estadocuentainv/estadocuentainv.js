var base_url;
base_url=$('base').attr('href');

function cargarProyecto()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectos'		
		)
		.done(function(data)
		{
			
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione proyecto');
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


function cargarInversionistas(idproyecto)
{
	//document.getElementById('inversionistas').options.length = 0;
	//$('#inversionistas').empty();
	$.get(
			base_url + 'movimientos/inversionista/getInversionistasPorProyecto/'+idproyecto		
		)
		.done(function(data)
		{
			
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione inversionista');
			$('#inversionistas').append($option);
			$.each(data,function(i,linea)
			{
                
				if (linea.idinversionista== $('#hinversionista').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idinversionista);
				$option.html(linea.nombre);
				$('#inversionistas').append($option);

				
			})
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
}

function cargarAportes(idproyecto,idinversionista)
{
	//$('#aportes').empty();
    //$('#negociaciones');
	$.get(
			base_url + 'movimientos/aporte/getAportesProyectoInversionistaNoRS/'+idproyecto+'/'+idinversionista	
		)
		.done(function(data)
		{
			
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione aporte');
			$('#aportes').append($option);
			$.each(data,function(i,linea)
			{
                
				if (linea.idaporte == $('#haporte').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idaporte);
				$option.html(linea.idaporte);
				$('#aportes').append($option);

				
			})
		})
		.fail(function(data)
		{
			console.log('error aportes!!!');
		});
}


$("#btnConsultar").click(function() {   
	$("#gvPagosRealizados").tabla(base_url+'reportes/estadocuentainv/getPagosRealizadosInv/'+$("#proyectos").val()+'/'+$("#inversionistas").val()+'/'+$("#aportes").val());
	$("#gvDetallePagos").tabla(base_url+'movimientos/aporte/getDetallePagoInversion/'+$("#aportes").val());
	$("#gvEncabezado").tabla(base_url+'reportes/estadocuentainv/getEncabezadoInv/'+$("#proyectos").val()+'/'+$("#inversionistas").val()+'/'+$("#aportes").val());
	//$("#gvCompras").tabla(base_url+'reportes/estadocuenta/getComprasEstadoCuenta/'+$("#negociaciones").val());
});


$(document).on('change','#proyectos',function()
{
	if($('#inversionistas').length > 0)
	{
		$('#inversionistas').empty();
		$('#aportes').empty();
		cargarInversionistas($("#proyectos").val());
	}
			
});


$(document).on('change','#inversionistas',function(){
	if($('#aportes').length > 0)
	{
		$('#aportes').empty();
		cargarAportes($("#proyectos").val(),$("#inversionistas").val());	
	}
});


$(document).ready(function()
{
	
	base_url = $('base').attr('href');

	if($('#proyectos').length > 0)
		cargarProyecto();

});



$(document).on('click','#btnExport',function(e)
	                                   {
	                                        //window.open('data:application/vnd.ms-excel,' + $('#tabla1').html());
	                                        window.open('data:application/vnd.ms-excel;name="excel",' + encodeURIComponent($('#divexp').html()));
   											e.preventDefault();
	                                   });

