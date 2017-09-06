var base_url;
var clienteEliminar;
$(document).ready(function()
{
	base_url=$('base').attr('href');

	if($('#proyectos').length > 0)
		cargarProyectos();


	cargarDetalleNegociacion2();
	
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
			$option.html('Seleccionar proyecto');
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
		$("#recordatorio").attr("disabled",true);
	}
	else{
		//$("#gvBuscar").tabla(base_url+'movimientos/cliente/getClientePorProyecto/'+$('#hproyecto').val());
		$("#recordatorio").attr("disabled",false);
	}
});


$(document).on('click','#enviarRecordatorio',function()
	                                   {
	                                   		window.location=base_url+"movimientos/recordatoriopago/enviarRecordatorio/"+$('#hproyecto').val();
	                                   });


function cargarDetalleNegociacion2()
{
	$("#hproyecto").val($('#hproyecto').val().replace(/'/g,"\"")); // cambia la comilla simple (') por comilla doble (")
	newArray = $.parseJSON($('#hproyecto').val());
	llenarTablaLocal("gvProductos", $.parseJSON(JSON.stringify(newArray)));
}

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