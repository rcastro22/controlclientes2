var base_url;
var clienteEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');

	if($('#proyectos').length > 0)
		cargarProyectos();

	$("#gvBuscar").tabla(base_url+'movimientos/cliente/getCliente');
	
});

function cargarProyectos()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectos'
		)
		.done(function(data)
		{
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Todos');
			$('#proyectos').append($option);
			$.each(data,function(i,linea)
			{				
				if (linea.idproyecto == $('#hproyecto').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idproyecto);
				$option.html(linea.nombre);
				$('#proyectos').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
		
}

$(document).on('change','#proyectos',function(){
	$('#hproyecto').val($('#proyectos').val());

	if($('#hproyecto').val() == "" || $('#hproyecto').val() == null || $('#hproyecto').val() == 0){
		$("#gvBuscar").tabla(base_url+'movimientos/cliente/getCliente');
	}
	else{
		$("#gvBuscar").tabla(base_url+'movimientos/cliente/getClientePorProyecto/'+$('#hproyecto').val());
	}
});

function llenarTablaLocal(Nombre, data) 
 {
    try 
    {
        var Fuente = $("#" + Nombre).attr("data-fuente");
        window[Fuente] = data;
        var Buscar = $("div.form-search[data-tabla=" + Nombre + "] > input");
        var Datos = FiltrarFilas(Buscar.val(), Fuente);
        OrdenarFilas(Datos, null, null, true);
        CalcularPaginas(Nombre, Datos);
        GenerarFilas(Nombre, Datos);
    }
    catch (e)
    {
        var Columnas = $("#" + Nombre + " > thead > tr > th").size();
        var tr = $(document.createElement('tr'));
        var td = $(document.createElement('td'));
        td.attr("colspan", Columnas);
        td.text("Ha ocurrido un problema al cargar la tabla." + e.message);
        tr.append(td);
        $("#" + Nombre + " > tbody").append(tr);
        $("div.pagination > ul[data-tabla=" + Nombre + "]").parent().hide();
    }
 };

/*$(function () {
                $('#fecnacimiento').datepicker();
            });*/



$(document).on('click','#gvBuscar>tbody>tr>td',function()
													{
														tipo = $(this).children().attr("class");
														//alert(tipo);
														var idcliente = $(this).siblings(":eq(0)").text();
														if(tipo != "btn btn-default" && tipo != "glyphicon glyphicon-trash")
														{
														
															window.location=base_url+"movimientos/cliente/edit/"+idcliente;	
														}	
														if(tipo == "glyphicon glyphicon-list-alt")
														{
															window.location=base_url+"movimientos/negociacion/listado/"+idcliente;
														}
														if(tipo == "glyphicon glyphicon-trash")
														{
															clienteEliminar=idcliente;
															$('#myModal').modal('toggle');
														}
														
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"movimientos/cliente/borrar/"+clienteEliminar;
	                                   });