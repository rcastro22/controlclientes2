var base_url;
var negociacionAnular;
var correlativoAnular;

function cargarClientes()
{
	$.get(
			base_url + 'movimientos/cliente/getCliente'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.idcliente == $('#hcliente').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idcliente);
				$option.html(linea.nombre);
				$('#cliente').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error clientes!!!');
		});
}


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idpago = $(this).parent().siblings(":eq(1)").text();
														var idneg = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														var estado = $(this).parent().siblings(":eq(8)").text();
														if(estado != 'AC')
														{
															alert('El estado del pago no es valido para esta operación')
														}
														else
														{															
															if (operacion=='Anular')
															{	
															    negociacionAnular=idneg;
															    correlativoAnular=idpago;
																$('#myModal').modal('toggle');
															}															
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"movimientos/pagos/anular/"+negociacionAnular+"/"+correlativoAnular;
	                                   });


$(document).ready(function()
{
	//alert("<?php echo $tipoAlerta ?>");

	base_url = $('base').attr('href');

	if($('#cliente').length > 0)
		cargarClientes();
	//alert(base_url+'movimientos/pagos/getPagos/'+$('#idnegociacion').val());
	$("#gvBuscar").tabla(base_url+'movimientos/pagos/getPagos/'+$('#idnegociacion').val());
});