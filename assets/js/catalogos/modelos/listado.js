var base_url;
var modeloEliminar;
$(document).ready(function()
{


	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/modelo/getModelos');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idmodelo = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/modelo/edit/"+idmodelo;	
														}
														if (operacion=='Eliminar')
														{	
														    modeloEliminar=idmodelo;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"catalogos/modelo/borrar/"+modeloEliminar;
	                                   });

