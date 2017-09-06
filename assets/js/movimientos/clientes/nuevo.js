var base_url;

function cargarEstadoCivil()
{
	var $option ='';
	$option = ($('#hestadocivil').val() == 'S' ? $('<option selected>') : $('<option>'));
	$option.val('S');
	$option.html('Soltero');
	$('#estadocivil').append($option);
	$option = ($('#hestadocivil').val() == 'C' ? $('<option selected>') : $('<option>'));
	$option.val('C');
	$option.html('Casado');
	$('#estadocivil').append($option);
}

function cargarTipoIdentificacion()
{

	$.get(
			base_url + 'catalogos/tipoidentificacion/getIdentificaciones'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.idtipoidentificacion == $('#htipoidentificacion').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idtipoidentificacion);
				$option.html(linea.nombre);
				$('#tipoidentificaciones').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error modelo!!!');
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

	                                   	    //recalcularMontos();
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

$(document).on('click','#spaningresos',function()
	                                   {
	                                   	    $('#txtNomCampo').val('ingresos');
	                                   		$('#modalConversion').modal('toggle');
	                                   });

$(document).on('click','#spanotrosing',function()
	                                   {
	                                   	    $('#txtNomCampo').val('otrosingresos');
	                                   		$('#modalConversion').modal('toggle');
	                                   });

$(document).ready(function()
{
	base_url = $('base').attr('href');

	traerTipoCambio();

	if($('#estadocivil').length > 0)
		cargarEstadoCivil();

	if($('#tipoidentificaciones').length > 0)
		cargarTipoIdentificacion();

});
