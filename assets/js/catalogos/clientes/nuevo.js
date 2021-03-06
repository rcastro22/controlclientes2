var base_url;

function cargarVendedores()
{
	$.get(
			base_url + 'catalogos/vendedor/getVendedores'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.VendedorID == $('#hvendedor').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.VendedorID);
				$option.html(linea.VendedorNombre);
				$('#vendedores').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error vendedores!!!');
		});
}

function cargarListas()
{
	$.get(
			base_url + 'catalogos/vendedor/getListas'
				
		)
		.done(function(data)
		{
			
			$.each(data,function(i,linea)
			{
				var $option ='';
				if (linea.ListaID == $('#hlista').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.ListaID);
				$option.html(linea.ListaNombre);
				$('#listas').append($option);
			})

		})
		.fail(function(data)
		{
			console.log('error listas!!!');
		});
}

$(document).ready(function()
{
	
	base_url = $('base').attr('href');

	if($('#vendedores').length > 0)
		cargarVendedores();
	if($('#listas').length > 0)
		cargarListas();
	

});
