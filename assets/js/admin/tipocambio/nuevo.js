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
				$('#cambiodia').val($option);
				
				if (isNaN($('#cambiodia').val()))
				{
					$('#cambiodia').val('0.00');
				}
				/*if ($('#cambiodia').val()!='')
			    {
			    	$('#btnGuardar').hide();
			    }*/
			})
			 
		})
		.fail(function(data)
		{
			console.log('error!!!');
		});



}


$(document).ready(function()
{
	
	base_url = $('base').attr('href');
    traerTipoCambio();
    
});

