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
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione Proyecto');
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


$(document).on('click','#botonConvertir',function()
	                                   {
	                                   	    varTipoCambio=$('#txtTipoCambio').val();
	                                   	    varQuetzales = $('#txtQuetzales').val();
	                                   	    varCampo=$('#txtNomCampo').val();
	                                   	 	varDolares=varQuetzales/varTipoCambio;
	                                   	    varDolares=varDolares.toFixed(2);
	                                   	    
	                                   	    $('#'+varCampo).val(varDolares);
	                                   	    $('#txtQuetzales').val('');
	                                   	    //$('#monto').val(varDolares);
	                                   	    $('#modalConversion').modal('toggle');

	                                   	    recalcularMontos();
	                                   });

function traerTipoCambio()
{
	var $option ='';
	$.get(
			base_url + 'admin/tipocambio/getTipoCambioDia'	
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				$option=linea.valor;
				$('#txtTipoCambio').val($option);
				
				if (isNaN($('#txtTipoCambio').val()))
				{
					$('#txtTipoCambio').val('0.00');
				}
			})
			 
		})
		.fail(function(data)
		{
			console.log('error!!!');
		});
}

$(document).on('click','#spanmonto',function()
	                                   {
	                                   	    $('#txtNomCampo').val('monto');
	                                   		$('#modalConversion').modal('toggle');
	                                   });
$(document).ready(function()
{
	//alert("<?php echo $tipoAlerta ?>");

	base_url = $('base').attr('href');

	traerTipoCambio();


	if($('#proyectos').length > 0)
		cargarProyecto();
	if($('#inversionista').length > 0)
		cargarInversionistas();

});



