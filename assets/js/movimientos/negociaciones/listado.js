var base_url;
var negociacionEliminar;
var idproyecto;


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
				$option.html(linea.nombre);
				$('#ddcliente').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error clientes!!!');
		});
}

function cargarProyectos()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectosPorCliente/'+$('#hcliente').val()
		)
		.done(function(data)
		{
			var $option ='';
			var contador = 0;
			$.each(data,function(i,linea)
			{				
				contador += 1;
				if(contador == 1){idproyecto = linea.idproyecto;}
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
			
			$.ajax({
			  type: 'POST',
			  url: base_url + 'movimientos/negociacion/getNegociacionProyectoCliente',
			  data: {idcliente: $('#hcliente').val(), idproyecto : idproyecto},
			  success: function (msg) {
			  }
			})
			.done(function(data){
				llenarTablaLocal("gvBuscar",$.parseJSON(JSON.stringify(data)));
			});
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
		
}

$(document).on('change','#proyectos',function(){
	$('#hproyecto').val($('#proyectos').val());

	if($('#hproyecto').val() == "" || $('#hproyecto').val() == null){
		$("#gvBuscar").tabla(base_url+'movimientos/negociacion/getNegociacion/'+$('#hcliente').val());
	}
	else {
		$.ajax({
		  type: 'POST',
		  url: base_url + 'movimientos/negociacion/getNegociacionProyectoCliente',
		  data: {idcliente: $('#hcliente').val(), idproyecto : $('#hproyecto').val()},
		  success: function (msg) {
		  	//window.location=base_url+"movimientos/negociacion/listado/"+$("#cliente").val();
		  	//alert(msg);
		  }

		})
		.done(function(data){
			//alert(base_url+'movimientos/negociacion/getNegociacion/'+$('#hcliente').val());
			//alert(JSON.stringify(data));
			//alert( $.parseJSON(JSON.stringify(data)));
			//$("#gvBuscar").tabla($.parseJSON(JSON.stringify(data)));
			llenarTablaLocal("gvBuscar",$.parseJSON(JSON.stringify(data)));
		});
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

$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idnegociacion = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														var estado = $(this).parent().siblings(":eq(8)").text();
														if(estado == 'RS')
														{
															alert('El estado de la negociación no es valido para esta operación')
														}
														else
														{
															if (operacion=='Modificar')
															{
																window.location=base_url+"movimientos/negociacion/edit/"+idnegociacion;	
															}
															if (operacion=='Rescindir')
															{	
															    negociacionEliminar=idnegociacion;
																$('#myModal').modal('toggle');
															}
															if (operacion=='Pagar')
															{
																window.location=base_url+"movimientos/negociacion/pago/"+idnegociacion;	
															}
															if (operacion=='Cuotas')
															{
																window.location=base_url+"movimientos/cuota/listado/"+idnegociacion;	
															}
															if (operacion=='Detalle pagos')
															{
																window.location=base_url+"movimientos/pagos/listado/"+idnegociacion;	
															}
														}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"movimientos/negociacion/borrar/"+negociacionEliminar;
	                                   });


$(document).ready(function()
{
	base_url=$('base').attr('href');

	//if($('#ddcliente').length > 0)
	//	cargarClientes();
	//if($('#proyectos').length > 0)
	//	cargarProyectos();

	$("#gvBuscar").tabla(base_url+'movimientos/negociacion/getNegociacion/'+$('#hcliente').val());


	$('input[type=checkbox]').on('change',function(){
		var opciones = "0";

		$('input[type=checkbox]:checked').each(
		    function() {
		        opciones += $(this).val();
		    }
		);
		console.log($('#hcliente').val());

		if($('#hcliente').val() != "")
			$idcliente = $('#hcliente').val();
		else
			$idcliente = -1;
		//$idcliente = ($('#hcliente').val() != "" : $('#hcliente').val() ? -1); 

		$("#gvBuscar").tabla(base_url+"movimientos/negociacion/getNegociacion/"+$idcliente+"/"+opciones);
	});

	
});