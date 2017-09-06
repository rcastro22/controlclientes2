var base_url;
var clienteEliminar;

$(document).ready(function()
{
	base_url=$('base').attr('href');
	$("#gvBuscar").tabla(base_url+'catalogos/cliente/getClientes');
	
});

$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
{
	var clientenit = $(this).parent().siblings(":eq(0)").text();
	var operacion = $(this).text();
	if (operacion=='Modificar')
	{
		window.location=base_url+"catalogos/cliente/edit/"+clientenit;
	}
	if (operacion=='Eliminar')
	{	
		clienteEliminar=clientenit;
		$('#myModal').modal('toggle');
	}
});

$(document).on('click','#botonEliminar',function()
{
		window.location=base_url+"catalogos/cliente/borrar/"+clienteEliminar;
});