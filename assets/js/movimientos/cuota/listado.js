var base_url;
var negociacionEliminar;
var idproyecto;


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
														var nopago = $(this).parent().siblings(":eq(1)").text();
														var operacion = $(this).text();
														var estado = $(this).parent().siblings(":eq(7)").text();
														/*if(estado != 'AC')
														{
															alert('El estado de la negociación no es valido para esta operación')
														}
														else
														{*/
															if (operacion=='Modificar')
															{
																window.location=base_url+"movimientos/cuota/edit/"+idnegociacion+"/"+nopago;	

																//llamar();
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
														//}
														//alert("hola"+carrera);
													});

$(document).on('click','#eliminar',function(){
	negociacionEliminar=$("#idnegociacion").val();
	$('#myModal').modal('toggle');
});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		window.location=base_url+"movimientos/cuota/borrar/"+negociacionEliminar;
	                                   });


$(document).ready(function()
{
	base_url=$('base').attr('href');

	/*if($('#ddcliente').length > 0)
		cargarClientes();
	if($('#proyectos').length > 0)
		cargarProyectos();*/


	$("#gvBuscar").tabla(base_url+'movimientos/negociacion/getDetallePago/'+$('#idnegociacion').val());

	



	llamar();
	
});


function llamar () {
	$("#gvBuscar>tbody>tr").each(function (index) {
                 var campo1, campo2, campo3;
                 $(this).children("td").each(function (index2) {
                     switch (index2) {
                         /*case 0:
                             campo1 = $(this).text();
                             break;
                        case 1:
                            campo2 = $(this).text();
                            break;
                        case 2:
                            campo3 = $(this).text();
                            break;*/
                        case 7:
                        	$(this).remove("button");
                    }
                $(this).css("background-color", "#ECF8E0");
                })
            //alert(campo1 + ' - ' + campo2 + ' - ' + campo3);
            //alert("hola");
            });
}