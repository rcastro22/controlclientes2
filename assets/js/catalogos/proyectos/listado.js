var base_url;
var proyectoEliminar;
$(document).ready(function()
{


	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/proyecto/getProyectos');
});

$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idproyecto = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"catalogos/proyecto/edit/"+idproyecto;	
														}
														if (operacion=='Eliminar')
														{	
														    proyectoEliminar=idproyecto;
															$('#myModal').modal('toggle');
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"catalogos/proyecto/borrar/"+proyectoEliminar;
	                                   });

/*$(document).on('click','#btnExport',function(e)
	                                   {
	                                        //window.open('data:application/vnd.ms-excel,' + $('#tabla1').html());
	                                        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#divexp').html()));
   											e.preventDefault();
	                                   });*/

