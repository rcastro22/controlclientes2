var base_url;
base_url=$('base').attr('href');

var newArray = [];	// Array de totales
var newArray2 = [];	// Array de titulos
var newArray3 = [];	// Array de montos por linea
var cantidadMeses = 0;
var nb_mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

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

$("#btnConsultar").click(function() {   
	
	// GENERA LOS ENCABEZADOS
	$.get(
			base_url+'reportes/flujopagosefecproy/getFlujoRangoCuotas/'+$("#proyectos").val()	
			// El metodo getFlujoRangoCuotas obtiene dos fechas: fechamin y fechamax	
		)
		.done(function(data)
		{
			$.each(data,function(i,linea)
			{
                // Elimina los encabezados si hubiera
				$("#reporte > thead > tr").remove();
				// Crea el tr del encabezado
				var tr = $(document.createElement('tr'));
				$("#reporte > thead").append(tr);				
				// Se crea el encabezado de NEGOCIACION
				var th = $(document.createElement('th'));
				th.html("NEGOCIACIÓN");
				$("#reporte > thead > tr").append(th);
				// Se crea el encabezado de CLIENTE
				var th = $(document.createElement('th'));
				th.html("CLIENTE");
				$("#reporte > thead > tr").append(th);

				// Obtiene y descompone en mes y año la fecha minima (fechamin)
				if(linea.fechamin != null)
				{				
					var fechatxt = linea.fechamin;
					var fechadiv = fechatxt.split("-");
					var fecha = new Date(fechadiv[0],fechadiv[1]-1,fechadiv[2]);
					var mes = fecha.getMonth();
					mes += 1;
					var anio = fecha.getYear();
					if ( anio < 1900 ) {
						anio = 1900 + fecha.getYear();
					}
				}
				else
				{
					var mes = 1;
					var anio = 1899;
				}

				// Obtiene y descompone en mes y año la fecha maxima (fechamax)
				if(linea.fechamax != null)
				{
					var fechamaxtxt = linea.fechamax;
					var fechamaxdiv = fechamaxtxt.split("-");
					var fechamax = new Date(fechamaxdiv[0],fechamaxdiv[1]-1,fechamaxdiv[2]);
					var mesmax = fechamax.getMonth();
					mesmax += 1;
					var aniomax = fechamax.getYear();
					if ( aniomax < 1900 ) {
						aniomax = 1900 + fechamax.getYear();
					}
				}
				else
				{
					var mesmax = 1;
					var aniomax = 1899;
				}

				// Obtiene y descompone en mes y año la fecha minima (fechamin)
				var fechaminrestxt = linea.fechaminres;
				var fechaminresdiv = fechaminrestxt.split("-");
				var fechaminres = new Date(fechaminresdiv[0],fechaminresdiv[1]-1,fechaminresdiv[2]);
				var mesminres = fechaminres.getMonth();
				mesminres += 1;
				var aniominres = fechaminres.getYear();
				if ( aniominres < 1900 ) {
					aniominres = 1900 + fechaminres.getYear();
				}

				// Obtiene y descompone en mes y año la fecha maxima (fechamax)
				var fechamaxrestxt = linea.fechamax;
				var fechamaxresdiv = fechamaxrestxt.split("-");
				var fechamaxres = new Date(fechamaxresdiv[0],fechamaxresdiv[1]-1,fechamaxresdiv[2]);
				var mesmaxres = fechamaxres.getMonth();
				mesmaxres += 1;
				var aniomaxres = fechamaxres.getYear();
				if ( aniomaxres < 1900 ) {
					aniomaxres = 1900 + fechamaxres.getYear();
				}

				if(aniominres < anio)
				{
					anio = aniominres;
					mes = mesminres;
				}
				else
				{
					if(aniominres == anio)
					{
						if(mesminres < mes)
						{
							anio = aniominres;
							mes = mesminres;
						}
					}
				}

				// Se van generando los titulos 1 en 1 hasta llegar a la fecha maxima
				var contador = 0;
				do{
					contador++;
					var th = $(document.createElement('th'));
					
					th.html(nb_mes[mes-1] + '-' + anio);

					// Se guarda en un arrary los titulos generados
					newArray2.push(nb_mes[mes-1] + '-' + anio);

					mes += 1;
					if(mes > 12){ mes = 1; anio += 1; }

					$("#reporte > thead > tr").append(th);
					
					newArray[contador-1] = 0;					
				}while(mes !=  mesmax || anio != aniomax);	// Mientras que el año y mes sean diferentes al de la ultima fecha

				// INICIO: se genera el titulo de la ultima fecha
				contador++;
				var th = $(document.createElement('th'));
				
				th.html(nb_mes[mes-1] + '-' + anio);

				newArray2.push(nb_mes[mes-1] + '-' + anio);

				mes += 1;
				if(mes > 12){ mes = 1; anio += 1; }

				$("#reporte > thead > tr").append(th);

				newArray[contador-1] = 0;
				// FIN: se genera el titulo de la ultima fecha

				// Guardo la cantidad de meses que se generaron
				cantidadMeses = contador;

				// Se crean los ultimos titulos de BANCO Y TOTOAL
				contador++;
				var th = $(document.createElement('th'));
				th.html("BANCO");
				newArray2.push("BANCO");
				$("#reporte > thead > tr").append(th);
				newArray[contador-1] = 0;
				
				contador++;
				var th = $(document.createElement('th'));
				th.html("TOTAL");
				newArray2.push("TOTAL");
				$("#reporte > thead > tr").append(th);
				newArray[contador-1] = 0;
			})
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});

	// GENERA LOS DATOS
	var idnegociacion = "";
	var idinmueble = "";
	var cliente = "";
	var cont = 0;
	var cont2 = 0;
	var sumNeg = 0;
	var monto = 0;
	var financiamientobanco = 0;
	var facturabanco = "";
	var entroReserva = false;
	var tr = $(document.createElement('tr'));	
	$.get(
			base_url+'reportes/flujopagosefecproy/getFlujoPagosEfecProy/'+$("#proyectos").val()		
		)
		.done(function(data)
		{			
			// Elimina el cuerpo de la tabla si hubiera
			$("#reporte > tbody > tr").remove();
			$.each(data,function(i,linea)
			{
				// En cada linea de datos se trae el idnegociacion, si el idnegociacion cambia es una nueva linea, 
				// sino es se agregan los td a la linea en curso
				if(idnegociacion != linea.idnegociacion)
				{
					if(idnegociacion != "")
					{
						// Al cambiar de negociacion, antes de pasar a la nueva linea se agrega el total de la linea
						// y el monto banco

						// Esta parte es para rellenar con vacios hasta llegar a la parte del total
						for(y=cont;y<cantidadMeses;y++)
						{
							var td = $(document.createElement('td'));
							if(newArray3[y] == 0)
								td.html('');
							else	
								td.html(newArray3[y].toFixed(2));
							tr.append(td);
							$("#reporte > tbody").append(tr);
						}

						// Si hay datos en Facturabanco se agrega el monto del banco
						//if(facturabanco != ""){
							total = parseFloat(newArray[cantidadMeses]) + parseFloat(financiamientobanco);
							newArray[cantidadMeses] = total.toFixed(2);
							sumNeg = parseFloat(sumNeg) + parseFloat(financiamientobanco);
							var td = $(document.createElement('td'));
							td.html(financiamientobanco);
							tr.append(td);
							$("#reporte > tbody").append(tr);	
						/*}
						else{
							var td = $(document.createElement('td'));
							td.html("");
							tr.append(td);
							$("#reporte > tbody").append(tr);	
						}*/

						// Se agrega el total de la linea
						total = parseFloat(newArray[cantidadMeses+1]) + parseFloat(sumNeg);
						newArray[cantidadMeses+1] = total.toFixed(2);
						var td = $(document.createElement('td'));
						var strong = $(document.createElement('strong'));
						strong.html(sumNeg.toFixed(2))
						td.html(strong);
						tr.append(td);
						$("#reporte > tbody").append(tr);

					}

					// Al cambiar de negociacion se genera una nueva linea y reinicia los contadores.
					cont = 0;
					sumNeg = 0;
					newArray3 = new Array();
					for(a=0;a<cantidadMeses;a++)
					{
						newArray3[a] = 0.00;
					}
					entroReserva = false;

					facturabanco = linea.facturabanco;
					financiamientobanco = linea.financiamientobanco;

					tr = $(document.createElement('tr'));
					$("#reporte > tbody").append(tr);

					idnegociacion = linea.idnegociacion;
					clinete = linea.idcliente;
					
					var td = $(document.createElement('td'));
					td.html(linea.idnegociacion);
					tr.append(td);

					var td = $(document.createElement('td'));
					td.html(linea.nombre);
					tr.append(td);
				}

				if(entroReserva == false)
				{					
					for(xx = 0;xx<cantidadMeses;xx++ )
					{
						// Obtiene la fecha de la reserva descompuesta en mes y año
						var fechareservatxt = linea.fechareserva;
						if(fechareservatxt != "" && fechareservatxt != null)
						{
							var fechareservadiv = fechareservatxt.split("-");
							var fechareserva = new Date(fechareservadiv[0],fechareservadiv[1]-1,fechareservadiv[2]);

							var mesreserva = fechareserva.getMonth();
							mesreserva += 1;
							var anioreserva = fechareserva.getYear();
							if ( anioreserva < 1900 ) {
								anioreserva = 1900 + fechareserva.getYear();
							}
						}

						if(newArray2[xx] == nb_mes[mesreserva-1]+'-'+anioreserva && entroReserva == false)
						{
							total = parseFloat(newArray[xx]) + parseFloat(linea.reserva);						
							monto = parseFloat(linea.reserva);
							entroReserva = true;
							newArray[xx] = total.toFixed(2);
							newArray3[xx] = parseFloat(newArray3[xx]) + monto;
							sumNeg = parseFloat(sumNeg) + parseFloat(monto.toFixed(2));
							break;
						}				
					}
				}

				// Recorre desde 0 hasta la cantidad de meses y donde valla cazando las fechas de los pagos va colocando los montos de pago,
				// si no caza coloca el campo vacio
				for(xx = 0;xx<cantidadMeses;xx++ )
				{
					// Obtiene la fecha descompuesta en mes y año del pago
					if(linea.fecha != null)
					{
						var fechatxt = linea.fecha;
						var fechadiv = fechatxt.split("-");
						var fecha = new Date(fechadiv[0],fechadiv[1]-1,fechadiv[2]);

						var mes = fecha.getMonth();
						mes += 1;
						var anio = fecha.getYear();
						if ( anio < 1900 ) {
							anio = 1900 + fecha.getYear();
						}
					}
					else
					{
						var mes = 1;
						var anio = 1899;
					}

					
					//alert(total);
					// Si la fecha del pago obtenida coincide con la fecha guardada en el array imprime el monto
					//alert(newArray2[xx]+'***'+nb_mes[mes-1]+'-'+anio);
					if(newArray2[xx] == nb_mes[mes-1]+'-'+anio)
					{																		
						// Si coincide la fecha de la reserva con la del pago suma el monto de reserva al total guardado
						
							total = parseFloat(newArray[xx]) + parseFloat(linea.pagoefectuado);
							//total = parseFloat(newArray[cont]);
							monto = parseFloat(linea.pagoefectuado);
						
						newArray[xx] = total.toFixed(2);
						newArray3[xx] = parseFloat(newArray3[xx]) + monto;
						
						// Si coincide la fecha de la reserva con la del pago suma el monto de reserva al monto del mes
						//if(/*linea.reciboreserva != "" && linea.reciboreserva != null &&*/ newArray2[cont] == nb_mes[mesreserva-1]+'-'+anioreserva){
						/*	monto = parseFloat(linea.pagoefectuado) + parseFloat(linea.reserva);
						}
						else{
							monto = parseFloat(linea.pagoefectuado);
						}*/

						sumNeg = parseFloat(sumNeg) + parseFloat(monto.toFixed(2));

						// Coloca el monto obtenido en el td
						/*var td = $(document.createElement('td'));
						td.html(monto.toFixed(2));
						tr.append(td);
						$("#reporte > tbody").append(tr);
						cont++;*/
						break;
					}
					/*else	// si no coincide la fecha crea el td vacio
					{
						if(cont < cantidadMeses)
						{
						var td = $(document.createElement('td'));
						td.html('');
						tr.append(td);
						$("#reporte > tbody").append(tr);	
						}
					}
					cont++;*/
				}	
			})

			// Se agrega el total de la linea y el monto banco de la ultima linea generada
			for(y=cont;y<cantidadMeses;y++)
			{
				var td = $(document.createElement('td'));
				if(newArray3[y] == 0)
					td.html('');
				else	
					td.html(newArray3[y]);
				tr.append(td);
				$("#reporte > tbody").append(tr);
			}
			//if(facturabanco != ""){
				total = parseFloat(newArray[cantidadMeses]) + parseFloat(financiamientobanco);
				newArray[cantidadMeses] = total.toFixed(2);
				sumNeg = parseFloat(sumNeg) + parseFloat(financiamientobanco);
				var td = $(document.createElement('td'));
				td.html(financiamientobanco);
				tr.append(td);
				$("#reporte > tbody").append(tr);	
			/*}
			else{
				var td = $(document.createElement('td'));
				td.html("");
				tr.append(td);
				$("#reporte > tbody").append(tr);	
			}*/
			total = parseFloat(newArray[cantidadMeses+1]) + parseFloat(sumNeg);
			newArray[cantidadMeses+1] = total.toFixed(2);
			var td = $(document.createElement('td'));
			var strong = $(document.createElement('strong'));
			strong.html(sumNeg.toFixed(2))
			td.html(strong);
			tr.append(td);
			$("#reporte > tbody").append(tr);
			// Hasta aqui son los datos de cada cliente

			// Aqui se crea la ultima linea que son los Totales
			var tr = $(document.createElement('tr'));
			$("#reporte > tbody").append(tr);	
				var td = $(document.createElement('td'));
				var strong = $(document.createElement('strong'));
				strong.html("TOTAL");
				td.html(strong);
				tr.append(td);

				var td = $(document.createElement('td'));
				td.html("");
				tr.append(td);

			// Aqui se recorrel el primer array el cual iba guardando los totales de cada mes y luego se imprimen 
			for(x=0;x<newArray.length;x++){				
				var td = $(document.createElement('td'));
				strong = $(document.createElement('strong'));
				strong.html(newArray[x]);
				td.html(strong);
				tr.append(td);
			}
		})
		.fail(function(data)
		{
			console.log('error proyectos!!!');
		});


		
		
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
	                                        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#divexp').html()));
   											e.preventDefault();
	                                   });

