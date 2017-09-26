var base_url;
var newArray = [];

function cargarProyecto()
{
	$.get(
			base_url + 'catalogos/proyecto/getProyectos'		
		)
		.done(function(data)
		{
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione Proyecto');
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
			//$('#proyectos').select2();
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
}

function cargarClientes()
{
	var datosj = new Array();

	$.get(
			base_url + 'movimientos/cliente/getCliente'		
		)
		.done(function(data)
		{
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione Cliente');
			$('#cliente').append($option);
			$.each(data,function(i,linea)
			{	

				if (linea.idcliente == $('#hcliente').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idcliente);
				$option.html(linea.idcliente+' - '+linea.nombre+ ' '+linea.apellido);
				$('#cliente').append($option);
			})

			//console.log(data);
			datos = data;
            for (i = 0; i < datos.length; i++)
            {
                datosj[i] = { id: datos[i].idcliente, text: datos[i].idcliente + ' - ' + datos[i].nombre + ' ' + datos[i].apellido };
            }
            $("#cboCliente").select2({
            	placeholder: "Seleccione cliente",
                allowClear: true,
                data: datosj,
                width: '100%'
            });


		})
		.fail(function(data)
		{
			console.log('error clientes!!!');
		});
}

function cargarOtrosClientes()
{
	$.get(
			base_url + 'movimientos/cliente/getCliente'		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				var $option ='';

				if (linea.idcliente == $('#hotrosclientes').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idcliente);
				$option.html(linea.nombre+ ' '+linea.apellido);
				$('#otrosclientes').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error clientes!!!');
		});
}
function cargarTipoInmueble()
{
	$.get(
			base_url + 'catalogos/tipoinmueble/getTipoInmuebles'		
		)
		.done(function(data)
		{
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('');
			$('#tiposinmueble').append($option);
			$.each(data,function(i,linea)
			{
				if (linea.idtipoinmueble == $('#htipoinmueble').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idtipoinmueble);
				$option.html(linea.nombre);
				$('#tiposinmueble').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error tipo inmueble!!!');
		});
}

function cargarModelo()
{
	$.get(
			base_url + 'catalogos/modelo/getModelos'		
		)
		.done(function(data)
		{
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('');
			$('#modelo').append($option);
			$.each(data,function(i,linea)
			{
				if (linea.idmodelo == $('#hmodelo').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idmodelo);
				$option.html(linea.nombre);
				$('#modelo').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error modelo!!!');
		});
}

function cargarInmueble()
{
	var datosj = new Array();

	$.get(
			base_url + 'catalogos/inmueble/getInmuebleDisponible/'+$('#hproyecto').val()		
		)
		.done(function(data)
		{
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione Inmueble');
			$('#inmueble').append($option);
			$.each(data,function(i,linea)
			{
				if (linea.idinmueble == $('#hinmueble').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idinmueble);
				$option.html(linea.idinmueble);
				$('#inmueble').append($option);
			})


			//console.log(data);
			datos = data;
            for (i = 0; i < datos.length; i++)
            {
                datosj[i] = { id: datos[i].idinmueble, text: datos[i].idinmueble + ' - ' + datos[i].nombreTipoInmueble + ' - ' + datos[i].nombreModelo};
            }
            $("#cboInmueble").select2({
            	placeholder: "Seleccione inmueble",
                allowClear: true,
                data: datosj,
                width: '100%'
            });
		})
		.fail(function(data)
		{
			console.log('error inmueble!!!');
		});
}

function cargarDatosCliente() {
	$.get(
			base_url + 'movimientos/cliente/getClienteId/'+$('#hcliente').val()		
		)
		.done(function(data)
		{
			if($('#hcliente').val() != '0' && $('#hcliente').val() != '') {
				$('#nombre').val(data.nombre);
				$('#apellido').val(data.apellido);
				$('#nit').val(data.nit);
				$('#fecnacimiento').val(data.fecnacimiento);
				calcularEdad($('#fecnacimiento').val());
				$('#dpi').val(data.dpi);
				$('#estadocivil').val(data.estadocivil);
				$('#profesion').val(data.profesion);
				$('#correo').val(data.correo);
				$('#telefono').val(data.telefono);
				$('#celular').val(data.celular);
				$('#direccion').val(data.dirresidencia);
				$('#empresa').val(data.lugartrabajo);
				$('#tiempolabor').val(data.tiempolabor);
				$('#dirtrabajo').val(data.dirtrabajo);
				$('#puesto').val(data.puesto);
				$('#ingresos').val(data.ingresos);
				$('#otrosingresos').val(data.otrosingresos);

				$('#nombre').attr('readonly','true');
				$('#apellido').attr('readonly','true');
				$('#nit').attr('readonly','true');
				$('#fecnacimiento').attr('readonly','true');
				//$('#edad').attr('readonly','true');
				$('#dpi').attr('readonly','true');
				$('#estadocivil').attr('readonly','true');
				$('#profesion').attr('readonly','true');
				$('#correo').attr('readonly','true');
				$('#telefono').attr('readonly','true');
				$('#celular').attr('readonly','true');
				$('#direccion').attr('readonly','true');
				$('#empresa').attr('readonly','true');
				$('#tiempolabor').attr('readonly','true');
				$('#dirtrabajo').attr('readonly','true');
				$('#puesto').attr('readonly','true');
				$('#ingresos').attr('readonly','true');
				$('#otrosingresos').attr('readonly','true');
			}
			else {
				$('#nombre').val('');
				$('#apellido').val('');
				$('#nit').val('');
				$('#fecnacimiento').val('');
				$('#edad').val('');
				$('#dpi').val('');
				$('#estadocivil').val('');
				$('#profesion').val('');
				$('#correo').val('');
				$('#telefono').val('');
				$('#celular').val('');
				$('#direccion').val('');
				$('#empresa').val('');
				$('#tiempolabor').val('');
				$('#dirtrabajo').val('');
				$('#puesto').val('');
				$('#ingresos').val('');
				$('#otrosingresos').val('');

				$('#nombre').removeAttr('readonly');
				$('#apellido').removeAttr('readonly');
				$('#nit').removeAttr('readonly');
				$('#fecnacimiento').removeAttr('readonly');
				//$('#edad').removeAttr('readonly');
				$('#dpi').removeAttr('readonly');
				$('#estadocivil').removeAttr('readonly');
				$('#profesion').removeAttr('readonly');
				$('#correo').removeAttr('readonly');
				$('#telefono').removeAttr('readonly');
				$('#celular').removeAttr('readonly');
				$('#direccion').removeAttr('readonly');
				$('#empresa').removeAttr('readonly');
				$('#tiempolabor').removeAttr('readonly');
				$('#dirtrabajo').removeAttr('readonly');
				$('#puesto').removeAttr('readonly');
				$('#ingresos').removeAttr('readonly');
				$('#otrosingresos').removeAttr('readonly');
			}
		})
		.fail(function(data)
		{
			
			console.log('error inmueble!!!');
		});
}

function cargarAsesor()
{
	$.get(
			base_url + 'catalogos/asesor/getAsesor'
		)
		.done(function(data)
		{
			var $option ='';
			/*$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione Inmueble');
			$('#inmueble').append($option);*/
			$.each(data,function(i,linea)
			{
				if (linea.idasesor == $('#hasesores').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idasesor);
				//$option.html(linea.nombre);
				$option.html(linea.nombre+ ' '+linea.apellido);
				$('#asesor').append($option);
			})
		})
		.fail(function(data)
		{
			console.log('error asesor!!!');
		});
}

function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
        replace(/\u0008/g, '\\b').
        replace(/\t/g, '\\t').
        replace(/\n/g, '\\n').
        replace(/\f/g, '\\f').
        replace(/\r/g, '\\r').
        replace(/'/g, '\\\'').
        replace(/"/g, '\\"');
}

function cargarDetalleNegociacion2()
{
	$("#tablainmuebles").val($('#tablainmuebles').val().replace(/'/g,"\"")); // cambia la comilla simple (') por comilla doble (")
	newArray = $.parseJSON($('#tablainmuebles').val());
	llenarTablaLocal("gvProductos", $.parseJSON(JSON.stringify(newArray)));
}

$(document).on('change','#proyectos',function(){
	/*var sel = document.getElementById("inmueble");
	for(i=(sel.length-1); i>=0; i--)
	{
	   aBorrar = sel.options[0];
	   aBorrar.parentNode.removeChild(aBorrar);
	}*/
	$('#hproyecto').val($('#proyectos').val());
	document.getElementById('inmueble').options.length = 0;
	//$('#inmuebles').empty();
	cargarInmueble();
	traerTipoCambio();
});


$(document).on('change','#cliente',function(){
	$('#hcliente').val($('#cliente').val());
	//if($('#hcliente').val() != '0')
		cargarDatosCliente();
	/*else {
		
	}*/
});

$("#cboCliente").on("change",function(){
	$('#hcliente').val($('#cboCliente').val());
	cargarDatosCliente();
});

/* 21-09-2017, RC, Comentado porque ya no se usa
$(document).on('change','#inmueble',function(){
	$.get(
			base_url + 'catalogos/inmueble/getInmuebleId/'+$('#inmueble').val()		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				//alert(linea.nombreTipoInmueble);
				
				$('#tamano').val(linea.tamano);
				$('#dormitorios').val(linea.dormitorios);

				$('#htipoinmueble').val(linea.nombreTipoInmueble);
				$('#hmodelo').val(linea.nombreModelo);
			})
		})
		.fail(function(data)
		{
			console.log('error datos!!!');
		});
		$('#hinmueble').val($('#inmueble').val());
		document.getElementById('tiposinmueble').options.length = 0;
		cargarTipoInmueble();
		document.getElementById('modelo').options.length = 0;
		cargarModelo();
});*/

$("#cboInmueble").on("change",function(){
	$('#hinmueble').val($('#cboInmueble').val());
	$.get(
			base_url + 'catalogos/inmueble/getInmuebleId/'+$('#hinmueble').val()+'/'+$('#hproyecto').val()		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				//alert(linea.nombreTipoInmueble);
				
				$('#tamano').val(linea.tamano);
				$('#dormitorios').val(linea.dormitorios);

				$('#htipoinmueble').val(linea.nombreTipoInmueble);
				$('#hmodelo').val(linea.nombreModelo);
			})
		})
		.fail(function(data)
		{
			console.log('error datos!!!');
		});
});

function recalcularMontos()
{
	if($('#reserva').val() == ""){$('#reserva').val("0");}
	if($('#enganche').val() == ""){$('#enganche').val("0");}
	saldoenganche = parseFloat($('#enganche').val())-parseFloat($('#reserva').val());
	$('#saldoenganche').val((saldoenganche < 0 ? 0 : saldoenganche.toFixed(2)));
	financiamiento = parseFloat($('#precioventa').val())-parseFloat($('#enganche').val());
	$('#financiamientobanco').val((financiamiento < 0 ? 0 : financiamiento.toFixed(2)));

	if($('#nocuotas').val() == ""){$('#nocuotas').val("0");}

	if($('#nocuotas').val() > 0){
		if($('#saldoenganche').val() == ""){$('#saldoenganche').val("0");}
		cuotamensual = parseFloat($('#saldoenganche').val())/parseFloat($('#nocuotas').val());
		$('#cuotamensual').val(cuotamensual.toFixed(2));
	}
	else{
		$('#cuotamensual').val("0.00");
	}
}

$(document).on('change','#reserva',function(){
	recalcularMontos();
});

$(document).on('change','#enganche',function(){
	recalcularMontos();
});

$(document).on('change','#nocuotas',function(){
	recalcularMontos();
});

$(document).on('click','#botonRedirigir',function()
	                                   {
	                                   		window.location=base_url+"catalogos/inmueble/nuevo";
	                                   });

$(document).on('click','#botonListado',function()
	                                   {
	                                   		window.location=base_url+"catalogos/inmueble/listado";
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

	                                   	    recalcularMontos();
	                                   });

function traerTipoCambio()
{
	var $option ='';
	$.get(
			base_url + 'catalogos/proyecto/getTipoCambioDia/' + $('#hproyecto').val()
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				$option=linea.valortipocambio;
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


$(document).on('click','#spanreserva',function()
	                                   {
	                                   	    $('#txtNomCampo').val('reserva');
	                                   		$('#modalConversion').modal('toggle');
	                                   });

$(document).on('click','#spanenganche',function()
	                                   {
	                                   	    $('#txtNomCampo').val('enganche');
	                                   		$('#modalConversion').modal('toggle');
	                                   });
$(document).ready(function()
{
	//alert("<?php echo $tipoAlerta ?>");

	base_url = $('base').attr('href')//;

	//traerTipoCambio();

	if($('#hcliente').val().length > 0)
		cargarDatosCliente(); 


	if($('#proyectos').length > 0)
		cargarProyecto();
	if($('#cliente').length > 0)
		cargarClientes();
	if($('#otrosclientes').length > 0)
		cargarOtrosClientes();
	if($('#tiposinmueble').length > 0)
		cargarTipoInmueble();
	if($('#inmueble').length > 0)
		cargarInmueble();
	if($('#modelo').length > 0)
		cargarModelo();
	if($('#asesor').length > 0)
		cargarAsesor();

	if($('#tablainmuebles').val() != "")
		cargarDetalleNegociacion2();


	if($('input:radio[name=clientejuridico]:checked').val()=="2") //es individual
	{
		/*$("#especifiquejuridico").prop('disabled',false);
	 	$("#nombramientojuridico").prop('disabled',false);*/
	 	$("#especifiquejuridico").prop('readonly',false);
	 	$("#nombramientojuridico").prop('readonly',false);
	}

    if($('input:radio[name=monedacontrato]:checked').val()=="2") //es individual
	{
	
	 	$("#tipocambioneg").prop('readonly',false);
	 	
	}


});


$(document).on('click','#btnAgregar',function()
{
	var varCodInmueble=$('#hinmueble').val();
	//var varDescripcionFormapago=$('#formapago option:selected').text();
	//var varNodocumento=$('#nodocumento').val();
	var varMonto=$('#monto').val();
	//var varObservaciones=$('#observaciones').val();
	//var varfechapago = new Date();
	var varfechapago = "2014-11-29";
	/////
	var varCostoGalon=$('#txtCostoGalon').val();
	var varTipoPeso=$('input:radio[name=rTipoMedida]:checked').val();
	var varGrOz=varTipoPeso==1?"Gramos":"Onzas"
	var varConversion=0;
	if(varCodInmueble=="" || varCodInmueble==null || varMonto =="")
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
				newArray.push({ idnegociacion: $("#idnegociacion").val(), idinmueble: varCodInmueble, tipo: $('#htipoinmueble').val(), modelo:$('#hmodelo').val(), monto: varMonto });
	        	llenarTablaLocal("gvProductos", $.parseJSON(JSON.stringify(newArray)));
	        	$('#txtTotalDecimal').val(varTotal.toFixed(6));
	        	$('#precioventa').val(varTotal.toFixed(2));

	        	//$('#nodocumento').val("");
				$('#monto').val("");
				recalcularMontos();
				$("#tablainmuebles").val(JSON.stringify(newArray));
				//$('#observaciones').val("");
        	}
	}
	//txtTotal.focus();

	$("#cboInmueble").focus();
});

function existeProducto(array)
{
	var length = array.length;
	var existe=false;
	for(i=0;i<length;i++)
	{
		if(array[i].idinmueble==$('#hinmueble').val())// && array[i].idnegociacion==$('#idnegociacion').val())
		{
			existe=true;
			break;
		}
	}
    return existe;
}

$(document).on("click", "#gvProductos > tbody > tr > td > .glyphicon-trash", function (event)
{	
	//var varidnegociacion = obtenerValorCol(this, "idnegociacion");
    var varCodInmueble = obtenerValorCol(this, "idinmueble");
    //var varDescripcionFormapago= obtenerValorCol(this, "formapago");
	//var varNodocumento= obtenerValorCol(this, "nodocumento");
    var varMonto = obtenerValorCol(this,"monto");
    varMonto = varMonto.replace(',','');
    //var varObservaciones= obtenerValorCol(this, "observaciones");
    newArray = $.grep(newArray, function (obj)
    {
        if (obj.idinmueble == varCodInmueble) //&& obj.idformapago == varCodFormaPago)
        {
            return false;
        }
        return true;
    })
    varTotal = parseFloat($('#txtTotalDecimal').val())-parseFloat(varMonto);
    $('#txtTotalDecimal').val(varTotal);
    $('#precioventa').val(varTotal.toFixed(2));
    llenarTablaLocal("gvProductos", $.parseJSON(JSON.stringify(newArray)));  
    recalcularMontos();  
    $("#tablainmuebles").val(JSON.stringify(newArray));
});

function obtenerValorCol(btn, Campo)
{
    var Indice = $(btn).parent().parent().parent().prev().find("tr > th[data-campo=" + Campo + "]").index();

    var codigo = $(btn).parent().parent().children('td:eq(' + Indice + ')').text();

    return codigo;
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

 $(document).on('click','#guardar',function()
{
	$("#tablainmuebles").val(JSON.stringify(newArray));
	//alert(JSON.stringify(newArray));
	//$('#myModal').modal('toggle');
	//grabarNuevoPago();
});



$(document).on('click','#clientejuridico',function()
{
	
	if($('input:radio[name=clientejuridico]:checked').val()=="1") //es individual
	{
		$("#especifiquejuridico").prop('readonly',true);
 		$("#nombramientojuridico").prop('readonly',true);
 		$("#especifiquejuridico").val("");
 		$("#nombramientojuridico").val("");
	}
	else
	{
		$("#especifiquejuridico").prop('readonly',false);
	 	$("#nombramientojuridico").prop('readonly',false);
	}
	
});


$(document).on('click','#monedacontrato',function()
{

	if($('input:radio[name=monedacontrato]:checked').val()=="1") //es dolares
	{
		$("#tipocambioneg").prop('readonly',true);
 		$("#tipocambioneg").val("");
	}
	else
	{
		$("#tipocambioneg").prop('readonly',false);
		$("#tipocambioneg").val($("#txtTipoCambio").val());
	}
	
});

$(".glyphicon-calendar").hover(function () {
    $(this).popover('show');
},
   function () {
       $(this).popover('hide');
   }
  );

$("#dpFecha").on('dp.change', function () {
    calcularEdad($("#dpFecha > input").val());
});

/*$(document).on('change','#fecnacimiento',function(){
	alert('llego');
	calcularEdad($("#fecnacimiento").val());
});*/

function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    $("#edad").val(edad);
}


		
