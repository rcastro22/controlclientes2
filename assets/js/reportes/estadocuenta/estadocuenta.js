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


function cargarClientes(idproyecto)
{
	$.get(
			base_url + 'movimientos/cliente/getClientePorProyecto/'+idproyecto		
		)
		.done(function(data)
		{
			
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione cliente');
			$('#clientes').append($option);
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
				$option.html(linea.apellido+ ' '+linea.nombre);
				$('#clientes').append($option);

				
			})
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
}

function cargarNegociaciones(idproyecto,idcliente)
{
	document.getElementById('negociaciones').options.length = 0;
    //$('#negociaciones');
	$.get(
			base_url + 'movimientos/negociacion/getNegociacionesProyectoClienteNoRS/'+idproyecto+'/'+idcliente	
		)
		.done(function(data)
		{
			
			var $option ='';
			$option =$('<option>');
			$option.val(0);
			$option.html('Seleccione negociacion');
			$('#negociaciones').append($option);
			$.each(data,function(i,linea)
			{
                
				if (linea.idnegociacion == $('#hnegociacion').val())
				{
					$option =$('<option selected>');
				}
				else
				{
					$option =$('<option>');
				}
				$option.val(linea.idnegociacion);
				$option.html(linea.idnegociacion);
				$('#negociaciones').append($option);

				
			})
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});
}


$("#btnConsultar").click(function() {   
	$("#gvPagosRealizados").tabla(base_url+'reportes/estadocuenta/getPagosRealizados/'+$("#proyectos").val()+'/'+$("#clientes").val()+'/'+$("#negociaciones").val());
	$("#gvDetallePagos").tabla(base_url+'movimientos/negociacion/getDetallePago/'+$("#negociaciones").val());
	$("#gvEncabezado").tabla(base_url+'reportes/estadocuenta/getEncabezado/'+$("#proyectos").val()+'/'+$("#clientes").val()+'/'+$("#negociaciones").val());
	$("#gvCompras").tabla(base_url+'reportes/estadocuenta/getComprasEstadoCuenta/'+$("#negociaciones").val());
});


$(document).on('change','#proyectos',function(){
	if($('#clientes').length > 0)
		cargarClientes($("#proyectos").val());	
});


$(document).on('change','#clientes',function(){
	if($('#negociaciones').length > 0)
		cargarNegociaciones($("#proyectos").val(),$("#clientes").val());	
});


$(document).ready(function()
{
	
	base_url = $('base').attr('href');

	if($('#proyectos').length > 0)
		cargarProyecto();

});



$(document).on('click','#btnExport',function(e)
	                                   {
	                                        //window.open('data:application/vnd.ms-excel,' + $('#tabla1').html());
	                                        window.open('data:application/vnd.ms-excel;name="excel",' + encodeURIComponent($('#divexp').html()));
   											e.preventDefault();
	                                   });

