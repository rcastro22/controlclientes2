var base_url;
var negociacionEliminar;
var idproyecto;


function cargarProyectos()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectos'
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
			
			
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
		
}


$(document).on('change','#proyectos',function(){
	$('#hproyecto').val($('#proyectos').val());

	if($('#hproyecto').val() == "" || $('#hproyecto').val() == null || $('#hproyecto').val() == 0){
		$("#gvBuscar").tabla(base_url+'movimientos/aporte/getAporte');
	}
	else{
		$("#gvBuscar").tabla(base_url+'movimientos/aporte/getAporte/'+$('#hproyecto').val());
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
														var idaporte = $(this).parent().siblings(":eq(0)").text();
														var operacion = $(this).text();
														var estado = $(this).parent().siblings(":eq(8)").text();
														/*if(estado != 'AC')
														{
															alert('El estado de la negociación no es valido para esta operación')
														}
														else
														{*/
															if (operacion=='Modificar')
															{
																window.location=base_url+"movimientos/aporte/edit/"+idaporte;	
															}
															if (operacion=='Rescindir')
															{	
															    negociacionEliminar=idaporte;
																$('#myModal').modal('toggle');
															}
															if (operacion=='Pagar')
															{
																window.location=base_url+"movimientos/aporte/pago/"+idaporte;	
															}
															if (operacion=='Cuotas')
															{
																window.location=base_url+"movimientos/cuota/listado/"+idaporte;	
															}
															if (operacion=='Detalle pagos')
															{
																window.location=base_url+"movimientos/pagosaporte/listado/"+idaporte;	
															}
														//}
														//alert("hola"+carrera);
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"movimientos/negociacion/borrar/"+negociacionEliminar;
	                                   });


$(document).ready(function()
{
	base_url=$('base').attr('href');

	if($('#ddcliente').length > 0)
		cargarClientes();
	if($('#proyectos').length > 0)
		cargarProyectos();

	$("#gvBuscar").tabla(base_url+'movimientos/aporte/getAporte');
	
});