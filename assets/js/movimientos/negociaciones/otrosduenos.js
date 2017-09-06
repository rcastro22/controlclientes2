var base_url;
var idclienteeliminar;



function cargarClientes()
{
	$.get(
			base_url + 'movimientos/cliente/getCliente'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.idcliente == $('#hcliente').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idcliente);
				$option.html(linea.nombre+ ' '+linea.apellido);
				$('#cliente').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error clientes!!!');
		});
}



$(document).ready(function()
{
	//alert("<?php echo $tipoAlerta ?>");

	base_url = $('base').attr('href');
	if($('#cliente').length > 0)
		cargarClientes();


	$("#gvClientes").tabla(base_url+'movimientos/negociacion/getCompradores/'+$("#idnegociacion").val());

});

$(document).on('click','#btnregresar',function()
	                                   {
	                                   		window.location=base_url+"movimientos/negociacion/edit/"+$("#idnegociacion").val();
	                                   });


$(document).on("click", "#gvClientes > tbody > tr > td > a > .glyphicon-trash", function (event)
{	
	//var idnegociacion = $(this).parent().siblings(":eq(0)").text();
	var idcliente = $(this).parent().parent().siblings(":eq(1)").text();
	var operacion = $(this).text();
	idclienteeliminar=idcliente;
	$('#myModal').modal('toggle');
	
});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   	
	                                   		window.location=base_url+"movimientos/negociacion/borrarComprador/"+$("#idnegociacion").val()+"/"+idclienteeliminar;
	                                   });