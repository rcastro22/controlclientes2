var base_url;
var newArray = [];

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
				$('#cliente').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error clientes!!!');
		});
}

function cargarFormaPago()
{
	$.get(
			base_url + 'catalogos/formapago/getFormaPago'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.iformapago == $('#hformapago').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idformapago);
				$option.html(linea.descripcion);
				$('#formapago').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error forma pago!!!');
		});
}

$(document).ready(function()
{
	//alert("<?php echo $tipoAlerta ?>");

	base_url = $('base').attr('href');
	traerTipoCambio();
	if($('#cliente').length > 0)
		cargarClientes();
	if($('#formapago').length > 0)
		cargarFormaPago();

	$("#formapago").focus();
});

$(document).on('click','#btnAgregar',function()
{
	var varCodFormaPago=$('#formapago').val();
	var varDescripcionFormapago=$('#formapago option:selected').text();
	var varNodocumento=$('#nodocumento').val();
	var varMonto=$('#monto').val();
	var varObservaciones=$('#observaciones').val();
	//var varfechapago = new Date();
	var varfechapago =$('#fechapago').val();
	/////
	var varCostoGalon=$('#txtCostoGalon').val();
	var varTipoPeso=$('input:radio[name=rTipoMedida]:checked').val();
	var varGrOz=varTipoPeso==1?"Gramos":"Onzas"
	var varConversion=0;
	if(varCodFormaPago=="" || varCodFormaPago==null || varMonto =="")
	{
		 $('#divAlerta1').empty();
		 $('#divAlerta1').append("No se puede agregar el pago, todos los campos son obligatorios");
		 $('#divAlerta1').show();
	}
	else
	{
			$('#divAlerta1').hide();
			
			if($('#txtTotalDecimal').val()=="")
			{
				$('#txtTotalDecimal').val("0");	
			}
			varTotal = parseFloat($('#txtTotalDecimal').val())+parseFloat(varMonto);
			if (!existeProducto(newArray))
			{
				newArray.push({ idnegociacion: $("#idnegociacion").val(), idformapago: varCodFormaPago, formapago: varDescripcionFormapago, nodocumento: varNodocumento, monto: varMonto, observaciones: varObservaciones, status: "AC", fechapago: varfechapago });
	        	llenarTablaLocal("gvProductos", $.parseJSON(JSON.stringify(newArray)));
	        	$('#txtTotalDecimal').val(varTotal.toFixed(6));
	        	$('#txtTotal').val(varTotal.toFixed(2));

	        	$('#nodocumento').val("");
				$('#monto').val("");
				$('#observaciones').val("");
        	}
	}
	//txtTotal.focus();

	$("#formapago").focus();
});

function existeProducto(array)
{
	var length = array.length;
	var existe=false;
	for(i=0;i<length;i++)
	{
		if(array[i].idformapago==$('#formapago').val() && array[i].idnegociacion==$('#idnegociacion').val())
		{
			existe=true;
			break;
		}
	}
    return existe;
}

$(document).on("click", "#gvProductos > tbody > tr > td > a > .glyphicon-trash", function (event)
{	
	var varidnegociacion = obtenerValorCol(this, "idnegociacion");
    var varCodFormaPago = obtenerValorCol(this, "idformapago");
    var varDescripcionFormapago= obtenerValorCol(this, "formapago");
	var varNodocumento= obtenerValorCol(this, "nodocumento");
    var varMonto = obtenerValorCol(this,"monto");
    varMonto = varMonto.replace(',','');
    var varObservaciones= obtenerValorCol(this, "observaciones");
    newArray = $.grep(newArray, function (obj)
    {
        if (obj.idnegociacion == varidnegociacion && obj.idformapago == varCodFormaPago)
        {
            return false;
        }
        return true;
    })
    varTotal = parseFloat($('#txtTotalDecimal').val())-parseFloat(varMonto);
    $('#txtTotalDecimal').val(varTotal);
    $('#txtTotal').val(varTotal.toFixed(2));
    llenarTablaLocal("gvProductos", $.parseJSON(JSON.stringify(newArray)));    
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

 $(document).on('click','#registrar',function()
{
	$('#myModal').modal('toggle');
});

 $(document).on('click','#botonGuardar',function()
{
	//if ($('#txtLineaDesc').val()!="" && $('#txtNombreFormula').val()!="" && $('#grupos').val()!="" )
	//{
		 //$('#divAlertaModal').empty();
		 //$('#divAlertaModal').append("Color grabado con éxito");
		 //$('#divAlertaModal').show();
		 // $('#circulo').css('background','#'+$('#txtReferencia').val());
		 //$('#divMuestra').css('background','#'+$('#txtReferencia').val());
		 //$('#imgMuestra').attr('title','Color aproximado #'+$('#txtReferencia').val());
		 grabarNuevoPago();
	//}
	//else
	//{
	//	 $('#divAlertaModal').empty();
	//	 $('#divAlertaModal').append("Para garabar debe ingresar todos los valores");
	//	 $('#divAlertaModal').show();
	//}
});

 function grabarNuevoPago()
{
	varTotal = parseFloat($('#txtTotalDecimal').val())

	$.ajax({
	  type: 'POST',
	  url: base_url + 'movimientos/negociacion/grabarNuevoPago',
	  data: {arreglo: newArray, idnegociacion : $('#idnegociacion').val(), monto: varTotal},
	  success: function (msg) {
	  	if(msg != ""){
	  		$('#myModal').show(false);
	  		alert(msg);
	  	}
	  	else{
	  		window.location=base_url+"movimientos/negociacion/listado/"+$("#cliente").val();
	  	}
	  }

	})
	/*.done(function(data){
		alert(data);
	})*/;

}

// Obtener otra columna de la misma fila

function obtenerValorCol(btn, Campo)
{
    var Indice = $(btn).parent().parent().parent().parent().prev().find("tr > th[data-campo=" + Campo + "]").index();

    var codigo = $(btn).parent().parent().parent().children('td:eq(' + Indice + ')').text();

    return codigo;
}


$(document).on('click','#spanmonto',function()
	                                   {
	                                   	    $('#txtNomCampo').val('monto');
	                                   		$('#modalConversion').modal('toggle');
	                                   });


$(document).on('click','#botonConvertir',function()
	                                   {
	                                   	    varTipoCambio=$('#txtTipoCambio').val();
	                                   	    varQuetzales = $('#txtQuetzales').val();
	                                   	    varCampo=$('#txtNomCampo').val();
	                                   	 	varDolares=varQuetzales/varTipoCambio;
	                                   	    varDolares=varDolares.toFixed(2);
	                                   	    
	                                   	    $('#'+varCampo).val(varDolares);
	                                   	    $('#txtQuetzales').val('');
	                                   	    //$('#monto').val(varDolares);
	                                   	    $('#modalConversion').modal('toggle');
	                                   });

function traerTipoCambio()
{
	var $option ='';
	$.get(
			base_url + 'catalogos/tipocambio/getTipoCambioDia'	
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				$option=linea.valor;
				$('#txtTipoCambio').val($option);
				
				if (isNaN($('#txtTipoCambio').val()))
				{
					$('#txtTipoCambio').val('0.00');
				}
			})
			 
		})
		.fail(function(data)
		{
			console.log('error!!!');
		});
}
 
