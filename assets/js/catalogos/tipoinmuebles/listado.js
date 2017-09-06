var base_url;
var tipoInmuebleEliminar;
$(document).ready(function()
{


	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/tipoinmueble/getTipoInmuebles');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idtipoinmueble = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/tipoinmueble/edit/"+idtipoinmueble;	
														}
														if (operacion=='Eliminar')
														{	
														    tipoInmuebleEliminar=idtipoinmueble;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   	    
	                                   		window.location=base_url+"catalogos/tipoinmueble/borrar/"+tipoInmuebleEliminar;
	                                   });