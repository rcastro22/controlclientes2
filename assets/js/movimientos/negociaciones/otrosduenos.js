var base_url;
var idclienteeliminar;
var tipoclienteeliminar;



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

	calcularEdad($("#fecnacimiento").val());

	//$("#newClientModal").modal("show");

});

$(document).on('click','#btnregresar',function()
	                                   {
	                                   		window.location=base_url+"movimientos/negociacion/edit/"+$("#idnegociacion").val();
	                                   });


$(document).on("click", "#gvClientes > tbody > tr > td > .glyphicon-trash", function (event)
{	
	//var idnegociacion = $(this).parent().siblings(":eq(0)").text();
	var idcliente = $(this).parent().siblings(":eq(1)").text();
	var tipocliente = $(this).parent().siblings(":eq(2)").text();
	var operacion = $(this).text();
	idclienteeliminar=idcliente;
	tipoclienteeliminar=tipocliente;
	$('#myModal').modal('toggle');
	
});

$(document).on('click','#botonEliminar',function()
{
		if(tipoclienteeliminar == "1") {
			window.location=base_url+"movimientos/negociacion/borrarComprador/"+$("#idnegociacion").val()+"/"+idclienteeliminar;
		}
		else if(tipoclienteeliminar == "0") {
			window.location=base_url+"movimientos/negociacion/borrarCompradorTemporal/"+$("#idnegociacion").val()+"/"+idclienteeliminar;
		}
});


$(document).on('click','#botonGuardar',function()
{

});



function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    if(edad > 0)
    $("#edad").val(edad);
}