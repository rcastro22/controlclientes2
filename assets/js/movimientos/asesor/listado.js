var base_url;
base_url=$('base').attr('href');

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
			$option.html('Seleccione proyecto');
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


$(document).ready(function()
{
	
	base_url = $('base').attr('href');

	if($('#proyectos').length > 0)
		cargarProyecto();

});


$(document).on('click','#gvBuscar>tbody>tr>td>button',function()
													{
														var idproyecto = $(this).parent().siblings(":eq(0)").text();
														var idasesor = $(this).parent().siblings(":eq(1)").text();
														var idnegociacion = $(this).parent().siblings(":eq(2)").text();
														
														var operacion = $(this).text();
														if (operacion=='Pagos')
														{
															window.location=base_url+"movimientos/asesor/pagos/"+idnegociacion;	
														}
														
													});

$("#proyectos").change(function() {   
	$("#gvBuscar").tabla(base_url+'movimientos/asesor/getNegociacionesAsesores/'+$("#proyectos").val());
 // alert( "cambio de proyecto" );

});
