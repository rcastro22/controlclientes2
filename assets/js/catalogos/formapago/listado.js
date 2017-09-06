var base_url;
var formapagoEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/formapago/getFormaPago');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idformapago = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/formapago/edit/"+idformapago;	
														}
														if (operacion=='Eliminar')
														{	
														    formapagoEliminar=idformapago;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"catalogos/formapago/borrar/"+formapagoEliminar;
	                                   });