var base_url;
var newArray = [];

$(document).ready(function()
{
	base_url = $('base').attr('href');

	cargarListado();

	$("#gvBuscar").tabla(base_url+'movimientos/pagos/getPagos/'+$('#idnegociacion').val());
});

function cargarListado($idnegociacion = 158) {
	$.get(
			base_url + 'movimientos/listacomprobacion/getListado/' + $("#idnegociacion").val()
		)
		.done(function (data) {

			$.each(data,function (i,linea) {
				var divRow = $(document.createElement('div'));
				var divForm = $(document.createElement('div'));
				var divCol = $(document.createElement('div'));
				var divCheck = $(document.createElement('div'));
				var label = $(document.createElement('label'));
				var input = $(document.createElement('input'));

				var divFecha1 = $(document.createElement('div'));
				var divFecha2 = $(document.createElement('div'));
				var inputFecha = $(document.createElement('input'));
				var span1 = $(document.createElement('span'));
				var span2 = $(document.createElement('span'));

				divRow.addClass("row");
				divForm.addClass("form-group");
				divCol.addClass("col-sm-offset-2 col-sm-4");
				divCheck.addClass("checkbox");
				
				input.attr("type", "checkbox");
				input.attr("id", linea.iddocumento);

				divFecha1.addClass("col-sm-2");
				divFecha2.addClass("input-group");
				divFecha2.addClass("date");
				inputFecha.attr("type", "text");
				inputFecha.attr("readonly","true");
				inputFecha.attr("id","fecha"+linea.iddocumento);
				inputFecha.addClass("form-control");
				span1.addClass("input-group-addon");
				span2.addClass("glyphicon glyphicon-calendar");

				if(linea.existe == 1) {
					input.attr("checked","true");
					inputFecha.removeAttr("readonly");
					inputFecha.val(linea.fecha);

					newArray.push({ idnegociacion: $("#idnegociacion").val(), iddocumento: linea.iddocumento, entregadoc: linea.existe, fecentregadoc: linea.fecha});
				}
					

				label.append(input);
				label.append(linea.descripcion);
				divCheck.append(label);
				divCol.append(divCheck);
				span1.append(span2);
				divFecha2.append(inputFecha);
				divFecha2.append(span1);
				divFecha1.append(divFecha2);
				divForm.append(divCol);
				divForm.append(divFecha1);
				divRow.append(divForm);
				$("#" + 'lista' ).append(divRow);

				
			})

			habilitarFunciones();
			
		})
		.fail(function (data) {
			console.log('error listado')
		});
}





$(document).on('click','#guardar',function()
{
	
	guardarCambios();
});




function habilitarFunciones() {
	$('.date').datetimepicker({'format':'YYYY-MM-DD'});

	$('input[type=checkbox]').on('change',function(){
		var fechaCheck = $("#fecha"+$(this).prop("id"));
		
		if($(this).prop("checked") == true)
		{
			fechaCheck.removeAttr("readonly");
			fechaCheck.val(moment().format("YYYY-MM-DD"));
			newArray.push({ idnegociacion: $("#idnegociacion").val(), iddocumento: $(this).prop("id"), entregadoc: 1, fecentregadoc: fechaCheck.val()});		
		}
		else {
			fechaCheck.attr("readonly","true");
			fechaCheck.val("");
			quitarDocumento($(this).prop("id"))
		}
	});

	$('.date').on('dp.change',function(){
		var checkId = $(this).parent().parent().children(":eq(0)").children(":eq(0)").children(":eq(0)").children(":eq(0)").prop("id");
		//console.log($(this).parent().parent().children(":eq(0)").children(":eq(0)").children(":eq(0)").children(":eq(0)").prop("id"));
		if(!existeDocumento(checkId)) {
			newArray.push({ idnegociacion: $("#idnegociacion").val(), iddocumento: checkId, entregadoc: 1, fecentregadoc: $("#fecha"+checkId).val()});
		}
	});
}

function existeDocumento($checkId)
{
	var length = newArray.length;
	var existe=false;
	for(i=0;i<length;i++)
	{
		if(newArray[i].iddocumento==$checkId)
		{
			newArray[i].fecentregadoc = $("#fecha"+$checkId).val();
			existe=true;
			break;
		}
	}
    return existe;
}

function quitarDocumento($checkId) {
	newArray = $.grep(newArray, function (obj)
    {
        if (obj.iddocumento == $checkId)
        {
            return false;
        }
        return true;
    })
}



function guardarCambios()
{
	$.ajax({
	  type: 'POST',
	  url: base_url + 'movimientos/listacomprobacion/grabarDocumentos',
	  data: {arreglo: newArray, idnegociacion : $('#idnegociacion').val()},
	  success: function (msg) {
	  	if(msg != ""){
	  		//$('#myModal').show(false);
	  		alert(msg);
	  	}
	  	else{
	  		window.location=base_url+"movimientos/listacomprobacion/listado/"+$("#idnegociacion").val();
	  	}
	  }

	})
	/*.done(function(data){
		alert(data);
	})*/;

}
