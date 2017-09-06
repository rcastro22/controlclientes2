var base_url;
var usuarioEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'admin/usuario/getUsuario');
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idusuario = $(this).parent().siblings(":eq(0)").text();
														var login = $(this).parent().siblings(":eq(3)").text();
														var operacion = $(this).text();
														if (operacion=='Modificar')
														{
															window.location=base_url+"admin/usuario/edit/"+idusuario;	
														}														
														if (operacion=='Eliminar')
														{	
															if(login=="admin"){
																alert("El usuario 'admin' no se puede eliminar")
															}
															else{
														    	usuarioEliminar=idusuario;
																$('#myModal').modal('toggle');
															}
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"admin/usuario/borrar/"+usuarioEliminar;
	                                   });