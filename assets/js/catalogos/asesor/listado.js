var base_url;
var asesorEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/asesor/getAsesor');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idasesor = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/asesor/edit/"+idasesor;	
														}
														if (operacion=='Eliminar')
														{	
														    asesorEliminar=idasesor;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"catalogos/asesor/borrar/"+asesorEliminar;
	                                   });