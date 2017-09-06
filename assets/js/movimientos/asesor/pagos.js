var base_url;
var correlativoEliminar;
var idnegociacion
base_url=$('base').attr('href');




function traerDatosNegociacion($idnegociacion)
{
	
	
	var $option ='';
	$.get(
			base_url + 'movimientos/asesor/getDatosNegociacion/'+$idnegociacion		
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
				$option=linea.idproyecto;
				$('#idproyecto').val($option);
				
				$option=linea.nomproyecto;
				$('#nomproyecto').val($option);

				$option=linea.idasesor;
				$('#idasesor').val($option);

				$option=linea.nomasesor;
				$('#nomasesor').val($option);
				$option=linea.idnegociacion;
				$('#idinmueble').val($option);

				$option=linea.comision;
				$('#totalcomision').val($option);
				$('#totalcomision').val(parseFloat($option).toFixed(2));
				if (isNaN($('#totalcomision').val()))
				{
					$('#totalcomision').val('0.00');
				}
				
				$option=linea.pagado;
				$('#totalpagado').val($option);
				$('#totalpagado').val(parseFloat($option).toFixed(2));
				if (isNaN($('#totalpagado').val()))
				{
					$('#totalpagado').val('0.00');
				}

				$option=linea.status;
				$('#status').val($option);

			})
			 
		})
		.fail(function(data)
		{
			console.log('error!!!');
		});
}


$(document).ready(function()
{
	
	base_url = $('base').attr('href');
    traerTipoCambio();
    traerDatosNegociacion($('#idnegociacion').val());

	//$("#gvBuscar").tabla(base_url+'movimientos/asesor/getPagosAsesor/'+$("#idnegociacion").val());
	$("#gvBuscar").tabla(base_url+'movimientos/asesor/getPagosAsesor/'+$('#idnegociacion').val());
	
});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idcorrelativo = $(this).parent().siblings(":eq(0)").text();
														idnegociacion = $('#idnegociacion').val();
														var status=$("#status").val();
														//alert(status);
														var operacion = $(this).text();
														if (status!='RS')
														{
															if (operacion=='Eliminar')
															{
																correlativoEliminar=idcorrelativo;
																$('#myModal').modal('toggle');
																//window.location=base_url+"movimientos/asesor/eliminarComision/"+idcorrelativo+'/'+idnegociacion;	
															}
														}
														
													});

$(document).on('click','#botonEliminar',function()
	                                   {
	                                   		//window.location=base_url+"catalogos/proyecto/borrar/"+proyectoEliminar;
	                                   		window.location=base_url+"movimientos/asesor/eliminarComision/"+correlativoEliminar+'/'+idnegociacion;
	                                   });

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
			base_url + 'admin/tipocambio/getTipoCambioDia'	
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