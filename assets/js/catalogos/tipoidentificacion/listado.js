var base_url;
var identificacionEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/tipoidentificacion/getIdentificaciones');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idtipoidentificacion = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/tipoidentificacion/edit/"+idtipoidentificacion;	
														}
														if (operacion=='Eliminar')
														{	
														    identificacionEliminar=idtipoidentificacion;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"catalogos/tipoidentificacion/borrar/"+identificacionEliminar;
	                                   });