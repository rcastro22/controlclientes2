var base_url;
var asesorEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/inversionista/getInversionista');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idinversionista = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/inversionista/edit/"+idinversionista;	
														}
														if (operacion=='Eliminar')
														{	
														    inversionistaEliminar=idinversionista;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"catalogos/inversionista/borrar/"+inversionistaEliminar;
	                                   });