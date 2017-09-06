var base_url;
var inmuebleEliminar;
var proyectoinmEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/inmueble/getInmueble');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idinmueble = $(this).parent().siblings(":eq(0)").text();
														var idproyecto = $(this).parent().siblings(":eq(1)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/inmueble/edit/"+idinmueble+"/"+idproyecto;	
														}
														if (operacion=='Eliminar')
														{	
														    inmuebleEliminar=idinmueble;
														    proyectoinmEliminar=idproyecto;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"catalogos/inmueble/borrar/"+inmuebleEliminar+"/"+proyectoinmEliminar;
	                                   });