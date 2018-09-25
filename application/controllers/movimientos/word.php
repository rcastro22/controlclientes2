<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class word extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('download', 'file', 'url', 'html', 'form'));
		$this->folder = 'PruebasWord/';
		if(!$this->session->userdata('logged_in'))
		{
			redirect('sesion');
		}
		else
		{
			$this->view_data['usuario']= $this->session->userdata('user_id');
		}
	}

	public function prueba($idnegociacion)
	{
		require_once str_replace("\\","/",FCPATH).'application/PHPWord.php';
		// Configuracion zona horaria
		date_default_timezone_set("America/Guatemala");		
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");		

		try {
			// Obtencion de datos
			$this->load->model('mword');
			$datosCliente = $this->mword->getContratoReserva($idnegociacion);			

			// Declaracion y uso del documento word
			$PHPWord = new PHPWord();
			$document = $PHPWord->loadTemplate(str_replace("\\","/",FCPATH).'PlantillasWord/ContratoReserva3.docx');			

			// Variables
			$nombrecompleto = "";

			// Substitucion de datos
			foreach ($datosCliente as $dato) {
				$nombrecompleto = utf8_decode($dato->nombre." ".$dato->apellido);
				$document->setValue('FechaInicial',intval(Date('d'))." de ".$meses[intval(Date('m'))-1]." de ".strtolower($this->toText(Date('Y'))));
				$document->setValue('NombreCliente',$nombrecompleto);
				$document->setValue('Edad',strtolower($this->toText($this->edad($dato->fecnacimiento))));
				$document->setValue('EstadoCivil',$dato->estadocivil);
				$document->setValue('Profesion',utf8_decode($dato->profesion));
				$document->setValue('FechaDocumento',intval(Date('d'))." de ".$meses[intval(Date('m'))-1]." de ".Date('Y'));
			}			
			// Fin substitucion

			// Guarda y cierra el documento
			$filename = tempnam(sys_get_temp_dir(), "PHPWord");
			$document->save($filename);
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=ContratoReserva-".$idnegociacion.".docx");
			readfile($filename);
			unlink($filename);
		} catch (Exception $e) {
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}



	public function contratoReservaOld($idnegociacion)

	{

		require_once str_replace("\\","/",FCPATH).'application/PHPWord.php';

		// Configuracion zona horaria

		date_default_timezone_set("America/Guatemala");		

		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");		



		try {

			// Obtencion de datos

			$this->load->model('mword');

			$datosCliente = $this->mword->getContratoReserva($idnegociacion);

			$datosInmuebles = $this->mword->getDetInmueblesNegociacion($idnegociacion);

			$precioMt2Inmueble = $this->mword->getMontoMt2TipoInmueble($idnegociacion);



			// Declaracion y uso del documento word

			$PHPWord = new PHPWord();

			$document = $PHPWord->loadTemplate(str_replace("\\","/",FCPATH).'PlantillasWord/ContratoReserva4.docx');			

			





			// Variables

			$nombrecompleto = "";

			$monedacontrato = 0;

			$tipocambioneg = 0;



			// Substitucion de datos

			foreach ($datosCliente as $dato) {



				$monedacontrato = $dato->monedacontrato;			

				$tipocambioneg = $dato->tipocambioneg;



				$nombrecompleto = utf8_decode($dato->nombre." ".$dato->apellido);

				

				$document->setValue('FechaInicial',intval(Date('d'))." de ".$meses[intval(Date('m'))-1]." de ".strtolower($this->toText(Date('Y'))));

				$document->setValue('dia',intval(Date('d')));

				$document->setValue('mes',$meses[intval(Date('m'))-1]);

				$document->setValue('anio',Date('Y'));



				$document->setValue('NombreCliente',$nombrecompleto);

				/*$word->ActiveDocument->Bookmarks("NombreCliente2")->Range->Text = $nombrecompleto;

				$word->ActiveDocument->Bookmarks("NombreCliente3")->Range->Text = $nombrecompleto;

				$word->ActiveDocument->Bookmarks("NombreCliente4")->Range->Text = $nombrecompleto;

				$word->ActiveDocument->Bookmarks("NombreCliente5")->Range->Text = $nombrecompleto;

				$word->ActiveDocument->Bookmarks("NombreCliente6")->Range->Text = $nombrecompleto;*/

				$document->setValue('Edad',strtolower($this->toText($this->edad($dato->fecnacimiento))));

				$document->setValue('EstadoCivil',$dato->estadocivil);

				$document->setValue('Profesion',utf8_decode($dato->profesion));

				$document->setValue('Nacionalidad',$dato->nacionalidad);

				$document->setValue('Domicilio',utf8_decode($dato->dirresidencia));

				$document->setValue('Correo',utf8_decode($dato->email));

				$document->setValue('DPI',$dato->dpi);

				//$word->ActiveDocument->Bookmarks("DPI2")->Range->Text = $dato->dpi;

				$document->setValue('FechaDocumento',intval(Date('d'))." de ".$meses[intval(Date('m'))-1]." de ".Date('Y'));

				if($dato->clientejuridico == 1) {

					$document->setValue('Propio',"en nombre propio.");

					$document->setValue('Representante',"");

				}else if($dato->clientejuridico == 2) {

					$document->setValue('Propio',$dato->especifiquejuridico);

					$document->setValue('Representante',$dato->nombramientojuridico);

				}				

				else {

					$document->setValue('Propio',"");

					$document->setValue('Representante',"");

				}



				$document->setValue('Enganche',utf8_decode($this->conversionMonto($monedacontrato,$dato->enganche,$tipocambioneg,1).","));				

				$document->setValue('PrecioVenta',utf8_decode($this->conversionMonto($monedacontrato,$dato->precioventa,$tipocambioneg,0)));

			}





			$inmueblesTxt = '';

			$contador = 0;

			foreach ($datosInmuebles as $inmueble) {

				$contador++;

				if($contador == 1)

					$inmueblesTxt = $inmueblesTxt."\n".$inmueble->tipo." ".$inmueble->idinmueble." modelo:".$inmueble->modelo;

				else

					$inmueblesTxt = $inmueblesTxt."\n".$inmueble->tipo." ".$inmueble->idinmueble." modelo:".$inmueble->modelo;

			}

			$document->setValue('DetalleInmuebles',$inmueblesTxt);





			$detallePrecioTxt = '';

			$contador = 0;

			foreach ($precioMt2Inmueble as $detalleprecio) {

				$contador++;

				if($contador == 1) {

					$detallePrecioTxt = $detallePrecioTxt . $this->conversionMonto($monedacontrato,$detalleprecio->suma,$tipocambioneg,0) . ", por metro cuadrado de " . $detalleprecio->nombretipo;

				}

				else {

					$detallePrecioTxt = $detallePrecioTxt . " y " . $this->conversionMonto($monedacontrato,$detalleprecio->suma,$tipocambioneg,0) . ", por metro cuadrado de " . $detalleprecio->nombretipo;

				}

				if($detalleprecio->tipo == 1) {

					$detallePrecioTxt = $detallePrecioTxt . " (sin incluir impuestos) ";

				}

			}

			$document->setValue('DetallePrecioMt2',$detallePrecioTxt);

			// Fin substitucion





			// Guarda y cierra el documento

			$filename = tempnam(sys_get_temp_dir(), "PHPWord");

			$document->save($filename);

			header("Content-type: application/vnd.ms-word");

			header("Content-Disposition: attachment;Filename=ContratoReserva-".$idnegociacion.".docx");

			readfile($filename);

			unlink($filename);

		

		} catch (Exception $e) {

		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";

		}





	}







	public function contratoReserva($idnegociacion)

	{

		require_once str_replace("\\","/",FCPATH).'application/PHPWord.php';

		// Configuracion zona horaria

		date_default_timezone_set("America/Guatemala");		

		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");		



		try {

			// Obtencion de datos

			$this->load->model('mword');

			$datosCliente = $this->mword->getContratoReserva($idnegociacion);

			if(!$datosCliente) {
				$datosCliente = $this->mword->getContratoReservaTemporal($idnegociacion);
			}

			$datosInmuebles = $this->mword->getDetInmueblesNegociacion($idnegociacion);

			$precioMt2Inmueble = $this->mword->getMontoMt2TipoInmueble($idnegociacion);



			// Declaracion y uso del documento word

			$PHPWord = new PHPWord();

			$document = $PHPWord->loadTemplate(str_replace("\\","/",FCPATH).'PlantillasWord/FormularioReservaFABRA.docx');			

			

			$datosInmueble = $this->mword->getContratoReservaInmueble($idnegociacion);





			// Variables

			$nombrecompleto = "";

			$monedacontrato = 0;

			$tipocambioneg = 0;



			/// **************** CLIENTE ******************

			foreach ($datosCliente as $dato) {



				$monedacontrato = $dato->monedacontrato;			

				$tipocambioneg = $dato->tipocambioneg;



				$nombrecompleto = utf8_decode($dato->nombre." ".$dato->apellido);

				

				$document->setValue('Fecha',intval(Date('d'))." de ".$meses[intval(Date('m'))-1]." de ".strtolower($this->toText(Date('Y'))));

				



				$document->setValue('Proyecto',utf8_decode($dato->proyecto));

				$document->setValue('TipoInmueble',utf8_decode($datosInmueble->nombre));

				$document->setValue('NumeroInmueble',utf8_decode($datosInmueble->idinmueble));

				$document->setValue('MtsCuadInmueble',utf8_decode($datosInmueble->tamano));



				$document->setValue('NombreCliente',utf8_decode($dato->nombre));

				$document->setValue('ApellidoCliente',utf8_decode($dato->apellido));

				$document->setValue('Nit',$dato->nit);

				$document->setValue('DiaNac',Date('d',strtotime($dato->fecnacimiento)));

				$document->setValue('MesNac',Date('m',strtotime($dato->fecnacimiento)));

				$document->setValue('AnioNac',Date('Y',strtotime($dato->fecnacimiento)));

				$document->setValue('Edad',$this->edad($dato->fecnacimiento));

				$document->setValue('EstadoCivil',utf8_decode($dato->estadocivil));

				$document->setValue('Dpi',$dato->dpi);

				$document->setValue('Profesion',utf8_decode($dato->profesion));

				$document->setValue('Correo',utf8_decode($dato->email));

				$document->setValue('Celular',utf8_decode($dato->celular));

				$document->setValue('Telefono',utf8_decode($dato->telefono));

				$document->setValue('Domicilio',utf8_decode($dato->dirresidencia));



				$document->setValue('LugarTrabajo',utf8_decode($dato->lugartrabajo));

				$document->setValue('TiempoLabor',utf8_decode($dato->tiempolabor));

				$document->setValue('DirTrabajo',utf8_decode($dato->dirtrabajo));

				$document->setValue('Puesto',utf8_decode($dato->puesto));

				$document->setValue('Ingresos',utf8_decode($dato->ingresos));

				$document->setValue('OtrosIngreso',utf8_decode($dato->otrosingresos));



				$document->setValue('NoCuotas',$dato->nocuotas.' cuotas');

				$document->setValue('Enganche',utf8_decode($this->conversionMonto($monedacontrato,$dato->enganche,$tipocambioneg,0)));				

				$document->setValue('PrecioVenta',utf8_decode($this->conversionMonto($monedacontrato,$dato->precioventa,$tipocambioneg,0)));

			}



			/// **************** OTROS COMPRADORES ******************

			$datosCliente = $this->mword->getContratoReservaOtrCompradores($idnegociacion);
			//echo json_encode($datosCliente);
			if($datosCliente)
			{
					$document->setValue('NombreClienteOtr',utf8_decode($datosCliente->nombre));
					$document->setValue('ApellidoClienteOtr',utf8_decode($datosCliente->apellido));
					$document->setValue('NitOtr',$datosCliente->nit);
					$document->setValue('DiaNacOtr',Date('d',strtotime($datosCliente->fecnacimiento)));
					$document->setValue('MesNacOtr',Date('m',strtotime($datosCliente->fecnacimiento)));
					$document->setValue('AnioNacOtr',Date('Y',strtotime($datosCliente->fecnacimiento)));
					$document->setValue('EdadOtr',$this->edad($datosCliente->fecnacimiento));
					$document->setValue('EstadoCivilOtr',utf8_decode($datosCliente->estadocivil));
					$document->setValue('DpiOtr',$datosCliente->dpi);
					$document->setValue('ProfesionOtr',utf8_decode($datosCliente->profesion));
					$document->setValue('CorreoOtr',utf8_decode($datosCliente->email));
					$document->setValue('CelularOtr',utf8_decode($datosCliente->celular));
					$document->setValue('TelefonoOtr',utf8_decode($datosCliente->telefono));
					$document->setValue('DomicilioOtr',utf8_decode($datosCliente->dirresidencia));


					$document->setValue('LugarTrabajoOtr',utf8_decode($datosCliente->lugartrabajo));
					$document->setValue('TiempoLaborOtr',utf8_decode($datosCliente->tiempolabor));
					$document->setValue('DirTrabajoOtr',utf8_decode($datosCliente->dirtrabajo));
					$document->setValue('PuestoOtr',utf8_decode($datosCliente->puesto));
					$document->setValue('IngresosOtr',utf8_decode($datosCliente->ingresos));
					$document->setValue('OtrosIngresoOtr',utf8_decode($datosCliente->otrosingresos));
			}

			else

			{
				$datosCliente = $this->mword->getContratoReservaOtrCompradoresTemp($idnegociacion);
				//echo json_encode($datosCliente);
				if($datosCliente)
				{
						$document->setValue('NombreClienteOtr',utf8_decode($datosCliente->nombre));
						$document->setValue('ApellidoClienteOtr',utf8_decode($datosCliente->apellido));
						$document->setValue('NitOtr',$datosCliente->nit);
						$document->setValue('DiaNacOtr',Date('d',strtotime($datosCliente->fecnacimiento)));
						$document->setValue('MesNacOtr',Date('m',strtotime($datosCliente->fecnacimiento)));
						$document->setValue('AnioNacOtr',Date('Y',strtotime($datosCliente->fecnacimiento)));
						$document->setValue('EdadOtr',$this->edad($datosCliente->fecnacimiento));
						$document->setValue('EstadoCivilOtr',utf8_decode($datosCliente->estadocivil));
						$document->setValue('DpiOtr',$datosCliente->dpi);
						$document->setValue('ProfesionOtr',utf8_decode($datosCliente->profesion));
						$document->setValue('CorreoOtr',utf8_decode($datosCliente->email));
						$document->setValue('CelularOtr',utf8_decode($datosCliente->celular));
						$document->setValue('TelefonoOtr',utf8_decode($datosCliente->telefono));
						$document->setValue('DomicilioOtr',utf8_decode($datosCliente->dirresidencia));


						$document->setValue('LugarTrabajoOtr',utf8_decode($datosCliente->lugartrabajo));
						$document->setValue('TiempoLaborOtr',utf8_decode($datosCliente->tiempolabor));
						$document->setValue('DirTrabajoOtr',utf8_decode($datosCliente->dirtrabajo));
						$document->setValue('PuestoOtr',utf8_decode($datosCliente->puesto));
						$document->setValue('IngresosOtr',utf8_decode($datosCliente->ingresos));
						$document->setValue('OtrosIngresoOtr',utf8_decode($datosCliente->otrosingresos));
				}
				else
				{

					$document->setValue('NombreClienteOtr','');

					$document->setValue('ApellidoClienteOtr','');

					$document->setValue('NitOtr','');

					$document->setValue('DiaNacOtr','');

					$document->setValue('MesNacOtr','');

					$document->setValue('AnioNacOtr','');

					$document->setValue('EdadOtr','');

					$document->setValue('EstadoCivilOtr','');

					$document->setValue('DpiOtr','');

					$document->setValue('ProfesionOtr','');

					$document->setValue('CorreoOtr','');

					$document->setValue('CelularOtr','');

					$document->setValue('TelefonoOtr','');

					$document->setValue('DomicilioOtr','');



					$document->setValue('LugarTrabajoOtr','');

					$document->setValue('TiempoLaborOtr','');

					$document->setValue('DirTrabajoOtr','');

					$document->setValue('PuestoOtr','');

					$document->setValue('IngresosOtr','');

					$document->setValue('OtrosIngresoOtr','');
				}
			}



			$inmueblesTxt = '';

			$contador = 0;

			foreach ($datosInmuebles as $inmueble) {

				$contador++;

				if($contador == 1)

					$inmueblesTxt = $inmueblesTxt."\n".$inmueble->tipo." ".$inmueble->idinmueble." modelo:".$inmueble->modelo;

				else

					$inmueblesTxt = $inmueblesTxt."\n".$inmueble->tipo." ".$inmueble->idinmueble." modelo:".$inmueble->modelo;

			}

			$document->setValue('DetalleInmuebles',$inmueblesTxt);





			$detallePrecioTxt = '';

			$contador = 0;

			foreach ($precioMt2Inmueble as $detalleprecio) {

				$contador++;

				if($contador == 1) {

					$detallePrecioTxt = $detallePrecioTxt . $this->conversionMonto($monedacontrato,$detalleprecio->suma,$tipocambioneg,0) . ", por metro cuadrado de " . $detalleprecio->nombretipo;

				}

				else {

					$detallePrecioTxt = $detallePrecioTxt . " y " . $this->conversionMonto($monedacontrato,$detalleprecio->suma,$tipocambioneg,0) . ", por metro cuadrado de " . $detalleprecio->nombretipo;

				}

				if($detalleprecio->tipo == 1) {

					$detallePrecioTxt = $detallePrecioTxt . " (sin incluir impuestos) ";

				}

			}

			$document->setValue('DetallePrecioMt2',$detallePrecioTxt);

			// Fin substitucion





			// Guarda y cierra el documento

			$filename = tempnam(sys_get_temp_dir(), "PHPWord");

			$document->save($filename);

			header("Content-type: application/vnd.ms-word");

			header("Content-Disposition: attachment;Filename=ContratoReserva-".$idnegociacion.".docx");

			readfile($filename);

			unlink($filename);

		

		} catch (Exception $e) {

		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";

		}





	}




	public function contratoPromesaCompraventa($idnegociacion)
	{
		require_once str_replace("\\","/",FCPATH).'application/PHPWord.php';
		// Configuracion zona horaria
		date_default_timezone_set("America/Guatemala");		
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");				

		try {
			// Obtencion de datos
			$this->load->model('mword');
			$datosCliente = $this->mword->getContratoReserva($idnegociacion);
			if(!$datosCliente) {
				$datosCliente = $this->mword->getContratoReservaTemporal($idnegociacion);
			}
			$datosInmuebles = $this->mword->getDetInmueblesNegociacion($idnegociacion);
			$precioMt2Inmueble = $this->mword->getMontoMt2TipoInmueble($idnegociacion);


			// Declaracion y uso del documento word
			$PHPWord = new PHPWord();
			$document = $PHPWord->loadTemplate(str_replace("\\","/",FCPATH).'PlantillasWord/ContratoPromesaCompraventa5.docx');

			// Variables
			$nombrecompleto = "";
			$nombrefirma = "";
			$monedacontrato = 0;
			$tipocambioneg = 0;
			$textoclientes = "";
			$precioventamonto = 0;
			$reservamonto = 0;
			$bancomonto = 0;


			// Substitucion de datos
			$document->setValue("FechaInicial",utf8_decode(strtolower($this->toText(intval(Date('d'))))." de ".strtolower($meses[intval(Date('m'))-1])." del año ".strtolower($this->toText(Date('Y')))));
			//$document->setValue("FechaInicial",utf8_decode(intval(Date('d'))." de ".strtolower($meses[intval(Date('m'))-1])));
			//$document->setValue("FechaDocumento",utf8_decode(intval(Date('d'))." de ".strtolower($meses[intval(Date('m'))-1])." del año ".strtolower($this->toText(Date('Y')))));
			$document->setValue("Dia",utf8_decode(strtolower($this->toText(intval(Date('d'))))));
			$document->setValue("Mes",utf8_decode(strtolower($meses[intval(Date('m'))-1])));
			$document->setValue("Anio",utf8_decode(strtolower($this->toText(Date('Y')))));


			/// **************** PROYECTO Y REPRESENTANTE ******************
			$this->load->model('mproyecto');
			$datosProyecto = $this->mproyecto->getProyectoPorNegociacion($idnegociacion);
			$document->setValue('NombreEdificio',utf8_decode($datosProyecto->nombreedificio));
			$document->setValue('NombreEdificio2',utf8_decode($datosProyecto->nombreedificio));
			$document->setValue("EntidadVendedora",utf8_decode(strtoupper($datosProyecto->entidadvendedora)));
			//$document->setValue("EntidadVendedorah",iconv('ISO-8859-1','UTF-8//TRANSLIT',$datosProyecto->entidadvendedora));
			$document->setValue("EntidadVendedorah",utf8_decode($this->quitar_tildes($datosProyecto->entidadvendedora)));

			$document->setValue('NombreRep',utf8_decode($datosProyecto->nombre_rep));
			$document->setValue('NombreRep2',utf8_decode(strtoupper($datosProyecto->nombre_rep)));
			$document->setValue('AniosRep',utf8_decode(strtolower($this->toText($this->edad($datosProyecto->fechanac_rep)))));
			$document->setValue('estadocivilrep',utf8_decode($datosProyecto->estadocivil_rep));
			$document->setValue('dpiRepLetras',utf8_decode(strtolower($this->dpiEnLetras($datosProyecto->dpi_rep))));
			$document->setValue('dpiRep',utf8_decode($this->dpiFormato($datosProyecto->dpi_rep)));
			$document->setValue('descRep',utf8_decode(strtoupper($datosProyecto->descripcion_rep)));

			$document->setValue('fechaActaNotarial',utf8_decode(strtolower($this->toText(Date('d',strtotime($datosProyecto->fechaactanotarial))))." de ".strtolower($meses[intval(Date('m',strtotime($datosProyecto->fechaactanotarial)))-1])." del año ".strtolower($this->toText(Date('Y',strtotime($datosProyecto->fechaactanotarial))))));
			$document->setValue('Notario',utf8_decode($datosProyecto->notario));
			$document->setValue('registroLetras',utf8_decode(strtolower($this->toText($datosProyecto->registro))));
			$document->setValue('registroNumero',utf8_decode(number_format(str_replace(",","",$datosProyecto->registro),0,".",",")));
			$document->setValue('folioLetras',utf8_decode(strtolower($this->toText($datosProyecto->folio_reg))));
			$document->setValue('folioNumero',utf8_decode(number_format($datosProyecto->folio_reg,0,".",",")));
			$document->setValue('libroLetras',utf8_decode(strtolower($this->toText($datosProyecto->libro_reg))));
			$document->setValue('libroNumero',utf8_decode($datosProyecto->libro_reg));
			$document->setValue('fechaRegistro',utf8_decode(strtolower($this->toText(Date('d',strtotime($datosProyecto->fecha_reg))))." de ".strtolower($meses[intval(Date('m',strtotime($datosProyecto->fecha_reg)))-1])." del año ".strtolower($this->toText(Date('Y',strtotime($datosProyecto->fecha_reg))))));
			$document->setValue('tipoCambio',utf8_decode(strtoupper($this->toText($datosProyecto->valortipocambio)." Quetzales con ".$this->toText(round((($datosProyecto->valortipocambio)-intval($datosProyecto->valortipocambio))*100))." centavos (Q. ".number_format(($datosProyecto->valortipocambio),2,".",",").")")));

			//inmueblesPrecioTxt = $inmueblesPrecioTxt."El precio por ".($cantIn > 1 ? "el " : "los ").$inmueble->tipo." es de ".strtoupper($this->toText($sumaCantIn)).strtoupper(($monedacontrato == 2 ? " quetzales con" : " dólares de los Estados Unidos de América con ")).strtoupper($this->toText(round((($sumaCantIn)-intval($sumaCantIn))*100)))." centavos ";
			//				$inmueblesPrecioTxt = $inmueblesPrecioTxt."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format(($sumaCantIn),2,".",",").")";


			if($datosProyecto->idproyecto == 6)
			{
				$document->setValue('fincaProy',utf8_decode(""));
				$document->setValue('folioProy',utf8_decode(""));
				$document->setValue('libroProy',utf8_decode(""));
			}
			else {
				$document->setValue('fincaProy',utf8_decode($datosProyecto->finca));
				$document->setValue('folioProy',utf8_decode($datosProyecto->folio));
				$document->setValue('libroProy',utf8_decode($datosProyecto->libro));
			}

			$document->setValue('areaProy',utf8_decode(number_format(floatval(str_replace(",","",$datosProyecto->area)),2,".",",")));
			$document->setValue('direccionProy',utf8_decode($datosProyecto->direccion));

			/// **************** CLIENTES ******************
			foreach ($datosCliente as $dato) {
				$monedacontrato = $dato->monedacontrato;			
				$tipocambioneg = $dato->tipocambioneg;				 

				$nombrecompleto = $dato->nombre." ".$dato->apellido;	
				$nombrefirma = $nombrecompleto;						

				$textoclientes = $nombrecompleto.", de ".strtolower($this->toText($this->edad($dato->fecnacimiento)))." años, ".$dato->estadocivil.", ".$dato->profesion;
				$textoclientes = $textoclientes.", ".$dato->nacionalidad.", con domicilio en el departamento de ".$dato->depdirres.", y me identifico con el Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) número ";
				$textoclientes = $textoclientes.strtolower($this->dpiEnLetras($dato->dpi))." (".$this->dpiFormato($dato->dpi)."), extendido por el Registro Nacional de las Personas de la República de Guatemala, y comparezco ";
				if($dato->clientejuridico == 1) {
					$textoclientes = $textoclientes."en nombre propio.";					
				}else if($dato->clientejuridico == 2) {					
					$textoclientes = $textoclientes."en su calidad de ".$dato->especifiquejuridico." calidad que acredita con ".$dato->nombramientojuridico.".";
				}
				$textoclientes = $textoclientes." En el curso del presente contrato se me podrá denominar simplemente como el \"PROMITENTE COMPRADOR\".";				

				$document->setValue("Direccion2",utf8_decode($dato->dirresidencia));
				$document->setValue('Correo',utf8_decode($dato->email));
				$document->setValue('NombreCliente',utf8_decode($nombrecompleto));
				$document->setValue('DPI',utf8_decode(strtolower($this->dpiEnLetras($dato->dpi))." (".$this->dpiFormato($dato->dpi).")"));

				// Asignacion de variables
				$precioventamonto = $dato->precioventa;
				$reservamonto = $dato->reserva;
				$bancomonto = $dato->financiamientobanco;			


				//// pagos calculados y fecha de vencimiento
				$this->load->model('mdetallepago');
				$pagosCant = $this->mdetallepago->getCantidadPagos($idnegociacion);
				//if($pagosCant->pagos < 24) {
					$document->setValue('plazoVencimiento',utf8_decode("el ".strtolower($this->toText(Date('d',strtotime($datosProyecto->fechavencimiento))))." de ".strtolower($meses[intval(Date('m',strtotime($datosProyecto->fechavencimiento)))-1])." del año ".strtolower($this->toText(Date('Y',strtotime($datosProyecto->fechavencimiento))))));
				/*}	
				else
				{
					$datoUltimoPago = $this->mdetallepago->getDetalleNoPago($idnegociacion,$pagosCant->pagos);
					$document->setValue('plazoVencimiento',utf8_decode("el ".strtolower($this->toText(Date('d',strtotime($datoUltimoPago->fechalimitepago))))." de ".strtolower($meses[intval(Date('m',strtotime($datoUltimoPago->fechalimitepago)))-1])." del año ".strtolower($this->toText(Date('Y',strtotime($datoUltimoPago->fechalimitepago))))));
				}*/
			}

			// Otros clientes
			$datosCliente = $this->mword->getContratoPromesa1($idnegociacion);
			foreach ($datosCliente as $dato) {

				$textoclientes = $textoclientes."</w:t></w:r></w:p><w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='6'/></w:numPr><w:ind w:left='375' w:hanging='349'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr></w:pPr><w:r><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr><w:t>";

				$nombrecompleto = $dato->nombre." ".$dato->apellido;
				/*$nombrefirma = $nombrefirma."</w:t></w:r></w:p>    <w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr></w:pPr><w:r><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr><w:t>".$nombrecompleto;*/
				$nombrefirma = $nombrefirma."</w:t></w:r></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'>					
					<w:r>
						<w:rPr>
							<w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/>
							<w:b/>
							<w:sz w:val='21'/>
							<w:szCs w:val='21'/>
						</w:rPr>
					<w:t>".$nombrecompleto;

				$textoclientes = $textoclientes.$nombrecompleto.", de ".strtolower($this->toText($this->edad($dato->fecnacimiento)))." años, ".$dato->estadocivil.", ".$dato->profesion;
				$textoclientes = $textoclientes.", ".$dato->nacionalidad.", con domicilio en ".$dato->dirresidencia.", y me identifico con el Documento Personal de Identificación con Código Único de Identificación número ";
				$textoclientes = $textoclientes.$dato->dpi.", extendido por el Registro Nacional de las Personas de la República de Guatemala, y comparezco ";
				if($dato->clientejuridico == 1) {
					$textoclientes = $textoclientes."en nombre propio.";					
				}else if($dato->clientejuridico == 2) {					
					$textoclientes = $textoclientes."en su calidad de ".$dato->especifiquejuridico." calidad que acredita con ".$dato->nombramientojuridico.".";
				}
				$textoclientes = $textoclientes." En el curso del presente contrato se me podrá denominar simplemente como \"PROMITENTE COMPRADOR\".";				
			}

			// Otros clientes temporales
			$datosCliente = $this->mword->getContratoPromesa1Temp($idnegociacion);
			foreach ($datosCliente as $dato) {

				$textoclientes = $textoclientes."</w:t></w:r></w:p><w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='6'/></w:numPr><w:ind w:left='375' w:hanging='349'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr></w:pPr><w:r><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr><w:t>";

				$nombrecompleto = $dato->nombre." ".$dato->apellido;
				
				$nombrefirma = $nombrefirma."</w:t></w:r></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'></w:p>
				<w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'>					
					<w:r>
						<w:rPr>
							<w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/>
							<w:b/>
							<w:sz w:val='21'/>
							<w:szCs w:val='21'/>
						</w:rPr>
					<w:t>".$nombrecompleto;

				$textoclientes = $textoclientes.$nombrecompleto.", de ".strtolower($this->toText($this->edad($dato->fecnacimiento)))." años, ".$dato->estadocivil.", ".$dato->profesion;
				$textoclientes = $textoclientes.", ".$dato->nacionalidad.", con domicilio en ".$dato->dirresidencia.", y me identifico con el Documento Personal de Identificación con Código Único de Identificación número ";
				$textoclientes = $textoclientes.$dato->dpi.", extendido por el Registro Nacional de las Personas de la República de Guatemala, y comparezco ";
				if($dato->clientejuridico == 1) {
					$textoclientes = $textoclientes."en nombre propio.";					
				}else if($dato->clientejuridico == 2) {					
					$textoclientes = $textoclientes."en su calidad de ".$dato->especifiquejuridico." calidad que acredita con ".$dato->nombramientojuridico.".";
				}
				$textoclientes = $textoclientes." En el curso del presente contrato se me podrá denominar simplemente como el \"PROMITENTE COMPRADOR\".";				
			}

			$document->setValue('NombreFirma',utf8_decode($nombrefirma));
			$document->setValue("Clientes",utf8_decode($textoclientes));


			///*********************** INMUEBLES *******************
			/*$inmueblesTxt = '';
			$contador = 0;

			$tipoIn = 0;
			$Ordinals = array("PRIMER","SEGUNDO","TERCER","CUARTO","QUINTO","SEXTO","SEPTIMO","OCTAVO","NOVENO","DECIMO");
			foreach ($datosInmuebles as $inmueble) {
				if($tipoIn == 0)
					$tipoIn = $inmueble->idtipoinmueble;
				else {
					if($inmueble->idtipoinmueble != $tipoIn) {						
						$tipoIn = $inmueble->idtipoinmueble;
						$inmueblesTxt = rtrim($inmueblesTxt)."; ";
					}
				}

				preg_match("/^([a-zA-Z])/", $inmueble->idinmueble, $letras); preg_match("/([[:digit:]]+)$/", $inmueble->idinmueble, $numeros);
				$nueLetras = ($letras == null ? "" : $letras[1]);
				$inmueblesTxt = $inmueblesTxt.$inmueble->tipo." número ".$nueLetras." ".strtolower($this->toText($numeros[1]))." ";
				$strNivel = "";

				if($inmueble->sotano > 0) { $strNivel = "nivel"; }
				else if($inmueble->sotano < 0) { $strNivel = "sótano"; }
				else if($inmueble->sotano == "PB") { $strNivel = "Planta Baja"; }

				if($tipoIn == 1) {
					$inmueblesTxt = $inmueblesTxt.str_replace("FABRA", "",strtoupper($inmueble->modelo)) ." ";
					$inmueblesTxt = $inmueblesTxt."(".$inmueble->idinmueble." ".str_replace("FABRA", "",strtoupper($inmueble->modelo)).") del ".strtolower($Ordinals[abs($inmueble->sotano)-1])." ".$strNivel." (".abs($inmueble->sotano).")";
				}
				else {
					$inmueblesTxt = $inmueblesTxt."(".$inmueble->idinmueble.") del ".strtolower($Ordinals[abs($inmueble->sotano)-1])." ".$strNivel." (".abs($inmueble->sotano)."), ";
				}
			}

			$document->setValue("Inmuebles",utf8_decode($inmueblesTxt));*/

			$inmueblesTxt = "";
			$inmueblesPrecioTxt = "";
			$tipoIn = 0;
			$cantIn = 0;
			$sumaCantIn = 0;
			$montosetenta = 0;
			$montotreinta = $precioventamonto;
			$preciomt2 = 0;
			foreach ($datosInmuebles as $inmueble) {
				if($tipoIn == 0)
					$tipoIn = $inmueble->idtipoinmueble;
				else {
					if($inmueble->idtipoinmueble != $tipoIn) {						
						
						if(!($tipoIn == 1 || $tipoIn == 8)) {
						$inmueblesTxt = rtrim($inmueblesTxt)."\n";
						$inmueblesTxt = $inmueblesTxt."</w:t></w:r></w:p><w:p w:rsidR='00836A8B' w:rsidRPr='00F90BEB' w:rsidRDefault='001333A8' w:rsidP='00227771'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='2'/><w:numId w:val='2'/></w:numPr><w:tabs><w:tab w:val='left' w:pos='851'/></w:tabs><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr></w:pPr><w:r w:rsidRPr='00F90BEB'><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr><w:t>";

						

						if($tipoIn != 1) {
							$inmueblesTxt = $inmueblesTxt.$cantIn." ".$inmueble->tipo." '".$inmueble->modelo."'";
							
							$sumaCantIn = $sumaCantIn*0.7;
							

							$cantIn = 0;
							$sumaCantIn = 0;
						}
						}
						$tipoIn = $inmueble->idtipoinmueble;
					}
				}

				preg_match("/^([a-zA-Z])/", $inmueble->idinmueble, $letras); preg_match("/([[:digit:]]+)$/", $inmueble->idinmueble, $numeros);
				$nueLetras = ($letras == null ? "" : $letras[1]);
				//$inmueblesTxt = $inmueblesTxt.$inmueble->tipo." No. ".$nueLetras." ".strtolower($this->toText($numeros[1]))." ";
				
				$strNivel = "";

				/*if($inmueble->sotano > 0) { $strNivel = "nivel"; }
				else if($inmueble->sotano < 0) { $strNivel = "sótano"; }
				else if($inmueble->sotano == "PB") { $strNivel = "Planta Baja"; }

				if($tipoIn == 1) {
					$inmueblesTxt = $inmueblesTxt.str_replace("FABRA", "",strtoupper($inmueble->modelo)) ." (".$inmueble->idinmueble." ".str_replace("FABRA", "",strtoupper($inmueble->modelo)).") ";					
				}
				else {
					$inmueblesTxt = $inmueblesTxt."(".$inmueble->idinmueble.") ";					
				}*/
				if($tipoIn == 1 || $tipoIn == 8) {
					$inmueblesTxt = $inmueblesTxt.$inmueble->tipo." ".$numeros[1]." ";
					$inmueblesTxt = $inmueblesTxt."ubicado en el nivel ".$inmueble->sotano." del edificio ".strtoupper($datosProyecto->nombreedificio).", con área de ".number_format($inmueble->tamano,2,".",",")." m2";

					if($inmueble->preciometro2 > $preciomt2) {
						$preciomt2 = $inmueble->preciometro2;
					}
				}
				else {
					$cantIn++;
					$sumaCantIn += $inmueble->valor;

				}

				$inmueblesPrecioTxt = $inmueblesPrecioTxt."</w:t></w:r><w:r w:rsidR='002507D8'><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr><w:t>.</w:t></w:r></w:p><w:p w:rsidR='00836A8B' w:rsidRPr='002507D8' w:rsidRDefault='00E01270' w:rsidP='00BF49FB'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:ind w:left='1080'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr></w:pPr><w:r><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr><w:t>";

				$montosetenta = round(($inmueble->preciobase+$inmueble->gastoslegales) * 0.7 * 1.12,2);
				//$montotreinta = $montotreinta + round(($inmueble->preciobase+$inmueble->gastoslegales) * 0.3 * 1.03,2);
				$montotreinta = round($montotreinta - $montosetenta,2);

				// convierte montosetenta a quetzales si la moneda es Q
				$montosetenta = round(($monedacontrato == 2 ? $montosetenta*$datosProyecto->valortipocambio : $montosetenta),2);

				if($datosProyecto->tipocalculo == "1"){
					$inmueblesPrecioTxt = $inmueblesPrecioTxt."El precio por el ".$inmueble->tipo." número ".$numeros[1]." es de ".strtoupper($this->toText($montosetenta)).strtoupper(($monedacontrato == 2 ? " quetzales con " : " dólares de los Estados Unidos de América con ")).strtoupper($this->toText(round((($montosetenta)-intval($montosetenta))*100))).strtoupper(" centavos ").strtoupper(($monedacontrato == 2 ? "" : "de dólar "));
					$inmueblesPrecioTxt = $inmueblesPrecioTxt."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format(($montosetenta),2,".",",").")";
				}
				else {
					$inmueblesPrecioTxt = $inmueblesPrecioTxt."El precio por el ".$inmueble->tipo." número ".$numeros[1]." es de "."__________________________________________".strtoupper(($monedacontrato == 2 ? " quetzales con " : " dólares de los Estados Unidos de América con "))."__________________".strtoupper(" centavos ").strtoupper(($monedacontrato == 2 ? "" : "de dólar "));
					$inmueblesPrecioTxt = $inmueblesPrecioTxt."(".($monedacontrato == 2 ? "Q " : "US$ ")."___,___.__".")";
				}
					
				/*$inmueblesTxt = $inmueblesTxt."con un área ".($tipoIn == 1 ? "(incluyendo balcones, terrazas, etc.) " : "")."de ".strtolower($this->toText($inmueble->tamano))." punto ".strtolower($this->toText(round(($inmueble->tamano-intval($inmueble->tamano))*100)))." metros cuadrados (".$inmueble->tamano." m2). ";*/

			}
			if($cantIn > 0) {
				$inmueblesTxt = $inmueblesTxt."</w:t></w:r></w:p><w:p w:rsidR='00836A8B' w:rsidRPr='00F90BEB' w:rsidRDefault='001333A8' w:rsidP='00227771'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='2'/><w:numId w:val='2'/></w:numPr><w:tabs><w:tab w:val='left' w:pos='851'/></w:tabs><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr></w:pPr><w:r w:rsidRPr='00F90BEB'><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr><w:t>";

				$inmueblesTxt = $inmueblesTxt.$cantIn." ".$inmueble->tipo." '".$inmueble->modelo."'";
				
				

				$cantIn = 0;
				$sumaCantIn = 0;
			}
			$inmueblesTxt = $inmueblesTxt."</w:t></w:r></w:p><w:p w:rsidR='00836A8B' w:rsidRPr='00F90BEB' w:rsidRDefault='001333A8' w:rsidP='00227771'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='2'/><w:numId w:val='2'/></w:numPr><w:tabs><w:tab w:val='left' w:pos='851'/></w:tabs><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr></w:pPr><w:r w:rsidRPr='00F90BEB'><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr><w:t>";
			$inmueblesTxt = $inmueblesTxt."1 título acción de la entidad que se dedicará a brindar el mantenimiento a las áreas comunes del Edificio ".$datosProyecto->nombreedificio;


			$document->setValue("DetalleInmueb",utf8_decode($inmueblesTxt));			
			$document->setValue("PInmueb",utf8_decode($inmueblesPrecioTxt));

			$montoApart = $this->conversionMonto($monedacontrato,0.00,$tipocambioneg,0);
			$montoBodeg = $this->conversionMonto($monedacontrato,0.00,$tipocambioneg,0);
			foreach ($precioMt2Inmueble as $detalleprecio) {
				if($detalleprecio->tipo == 1 || $detalleprecio->tipo == 8) {
					$montoApart = $this->conversionMonto($monedacontrato,$detalleprecio->suma,$tipocambioneg,0);
				}
				if($detalleprecio->tipo == 3) {
					$montoBodeg = $this->conversionMonto($monedacontrato,$detalleprecio->suma,$tipocambioneg,0);
				}
			}
			$document->setValue("ApartMt2",$montoApart);
			$document->setValue("BodegMt2",$montoBodeg);

			if($precioventamonto != 0) {
				$precioventamonto = round(($monedacontrato == 2 ? $precioventamonto*$datosProyecto->valortipocambio : $precioventamonto),2);
				$precioventatext = strtolower($this->toText($precioventamonto)).($monedacontrato == 2 ? " quetzales con " : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round((($precioventamonto)-intval($precioventamonto))*100)))." centavos ".($monedacontrato == 2 ? "" : "de dólar ");
				$precioventatext = $precioventatext."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format($precioventamonto,2,".",",").")";
				$document->setValue("PrecioVenta",utf8_decode($precioventatext));

				/*$pinmueblestext = strtolower($this->toText($precioventamonto*0.7)).($monedacontrato == 2 ? " quetzales con" : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round((($precioventamonto*0.7)-intval($precioventamonto*0.7))*100)))." centavos ";
				$pinmueblestext = $pinmueblestext."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format(($precioventamonto*0.7),2,".",",").")";
				$document->setValue("PInmueb",utf8_decode($pinmueblestext));*/
				if($datosProyecto->tipocalculo == "1"){
					$montotreinta = round(($monedacontrato == 2 ? $montotreinta*$datosProyecto->valortipocambio : $montotreinta),2);
					$pacciontext = strtolower($this->toText($montotreinta)).($monedacontrato == 2 ? " quetzales con " : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round((($montotreinta)-intval($montotreinta))*100)))." centavos ".($monedacontrato == 2 ? "" : "de dólar ");
					$pacciontext = $pacciontext."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format(($montotreinta),2,".",",").")";
				}
				else {
					$pacciontext = "________________________________________".($monedacontrato == 2 ? " quetzales con " : " dólares de los Estados Unidos de América con ")."___________________"." centavos ".($monedacontrato == 2 ? "" : "de dólar ");
					$pacciontext = $pacciontext."(".($monedacontrato == 2 ? "Q " : "US$ ")."___,___.__".")";
				}
				$document->setValue("PAccion",utf8_decode($pacciontext));

				$parrastext = strtolower($this->toText($precioventamonto*0.1)).($monedacontrato == 2 ? " quetzales con " : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round((($precioventamonto*0.1)-intval($precioventamonto*0.1))*100)))." centavos ".($monedacontrato == 2 ? "" : "de dólar ");
				$parrastext = $parrastext."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format(($precioventamonto*0.1),2,".",",").")";
				$document->setValue("PArras",utf8_decode($parrastext));

			}

			$preciomt2txt = ($monedacontrato == 2 ? "Q " : "US$ ").number_format(($preciomt2),2,".",",");
			$document->setValue("PrecioMt2",utf8_decode($preciomt2txt));			
			
			////////////************************* PAGOS ***********************

			$reservatext = "";
			if($reservamonto != 0) {
				$reservamonto = round(($monedacontrato == 2 ? $reservamonto*$datosProyecto->valortipocambio : $reservamonto),2);
				$reservatext = "El monto de ".strtolower($this->toText($reservamonto)).($monedacontrato == 2 ? " quetzales con" : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round(($reservamonto-intval($reservamonto))*100)))." centavos ".($monedacontrato == 2 ? "" : "de dólar ");
				$reservatext = $reservatext."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format($reservamonto,2,".",",").") realizado en concepto de reserva.";
				$reservatext = $reservatext."\n";

				$reservatext = $reservatext."</w:t></w:r></w:p><w:p w:rsidR='00A3647A' w:rsidRPr='00022E66' w:rsidRDefault='007505C5'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='5'/></w:numPr><w:tabs><w:tab w:val='left' w:pos='851'/><w:tab w:val='left' w:pos='1200'/></w:tabs><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr></w:pPr><w:r w:rsidRPr='00022E66'><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr><w:t>";
			}

			//// Este inciso se elimino del contrato, correo 15-03-2018
			/*$primerpago = $this->mword->getContratoPromesa2($idnegociacion);
			if($primerpago->pagocalculado != 0) {
				$reservatext = $reservatext."El día de hoy se recibe la cantidad de ".strtolower($this->toText($primerpago->pagocalculado)).($monedacontrato == 2 ? " quetzales con" : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round(($primerpago->pagocalculado-intval($primerpago->pagocalculado))*100)))." centavos ";;
				$reservatext = $reservatext."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format($primerpago->pagocalculado,2,".",",").")";
				$reservatext = $reservatext."\n";

				$reservatext = $reservatext."</w:t></w:r></w:p><w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='5'/></w:numPr><w:ind w:left='1200' w:hanging='349'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr></w:pPr><w:r><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr><w:t>";
			}*/

			$detallepagos = $this->mword->getContratoPromesa3($idnegociacion);
			$contador = 0;

			foreach ($detallepagos as $detpago) {
				$contador++;
				$reservatext = $reservatext.strtolower($this->toText($detpago->cantidad))." pagos iguales y consecutivos por la cantidad de ".strtolower($this->toText(round(($monedacontrato == 2 ? $detpago->pagocalculado*$datosProyecto->valortipocambio : $detpago->pagocalculado),2))).($monedacontrato == 2 ? " quetzales con" : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round((round(($monedacontrato == 2 ? $detpago->pagocalculado*$datosProyecto->valortipocambio : $detpago->pagocalculado),2)-intval(round(($monedacontrato == 2 ? $detpago->pagocalculado*$datosProyecto->valortipocambio : $detpago->pagocalculado),2)))*100)))." centavos ".($monedacontrato == 2 ? "" : "de dólar ")." (".($monedacontrato == 2 ? "Q " : "US$ ").number_format(round(($monedacontrato == 2 ? $detpago->pagocalculado*$datosProyecto->valortipocambio : $detpago->pagocalculado),2),2,".",",")."), ";
			}

			if($contador > 0) {
				$reservatext = $reservatext." empezando en el mes de ";
				$fechaprimerpago = $this->mword->getContratoPromesa4($idnegociacion);
				$reservatext = $reservatext.strtolower($meses[intval(Date('m',strtotime($fechaprimerpago->fechalimitepago)))-1])." ".Date('Y',strtotime($fechaprimerpago->fechalimitepago));
				$reservatext = $reservatext."\n";

				$reservatext = $reservatext."</w:t></w:r></w:p><w:p w:rsidR='00A3647A' w:rsidRPr='00022E66' w:rsidRDefault='007505C5'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='5'/></w:numPr><w:tabs><w:tab w:val='left' w:pos='851'/><w:tab w:val='left' w:pos='1200'/></w:tabs><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr></w:pPr><w:r w:rsidRPr='00022E66'><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='18'/><w:szCs w:val='18'/></w:rPr><w:t>";
			}

			//$reservatext = $reservatext."</w:t></w:r></w:p><w:p w:rsidR='00FB4413' w:rsidRDefault='00FB4413'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:ind w:left='720'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:eastAsia='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr></w:pPr></w:p><w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='8'/></w:numPr><w:ind w:left='840' w:hanging='480'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr></w:pPr><w:r><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:b/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr><w:t>";

			//$reservatext = $reservatext."</w:t></w:r></w:p><w:p w:rsidR='00FB4413' w:rsidRDefault='001C2841'><w:pPr><w:pStyle w:val='Cuerpo'/><w:widowControl w:val='0'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='6'/></w:numPr><w:ind w:left='1200' w:hanging='349'/><w:jc w:val='both'/><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr></w:pPr><w:r><w:rPr><w:rFonts w:ascii='Arial Narrow' w:hAnsi='Arial Narrow' w:cs='Arial Narrow'/><w:sz w:val='21'/><w:szCs w:val='21'/></w:rPr><w:t>";

			if($bancomonto != 0) {
				$bancomonto = round(($monedacontrato == 2 ? $bancomonto*$datosProyecto->valortipocambio : $bancomonto),2);
				$reservatext = $reservatext."Al momento de firmar la compra venta definitiva ".strtolower($this->toText($bancomonto)).($monedacontrato == 2 ? " quetzales con" : " dólares de los Estados Unidos de América con ").strtolower($this->toText(round(($bancomonto-intval($bancomonto))*100)))." centavos ".($monedacontrato == 2 ? "" : "de dólar ");
				$reservatext = $reservatext."(".($monedacontrato == 2 ? "Q " : "US$ ").number_format($bancomonto,2,".",",").")";
				$reservatext = $reservatext."\n";
			}

			//$reservatext = $reservatext."Se pacta que las arras del presente contrato constituirá un veinte por ciento (20%) del valor de los bienes prometidos en venta, sin incluir impuestos, equivalente a "."[MONTO]";
			//$reservatext = $reservatext.". Si el incumplimiento se diera antes de que el PROMINENTE COMPRADOR haya abonado la suma pactada en arras, será la suma efectivamente pagada a dicha fecha la que constituirá las arras del presente contrato.";

			$document->setValue("Reserva",utf8_decode($reservatext));
			// Fin substitucion de datos

			// Guarda y cierra el documento
			$filename = tempnam(sys_get_temp_dir(), "PHPWord");
			$document->save($filename);
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=ContratoPromesaCompraventa-".$idnegociacion.".docx");
			readfile($filename);
			unlink($filename);
		} catch (Exception $e) {
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}




	public function minutaCompraventa($idnegociacion)
	{
		require_once str_replace("\\","/",FCPATH).'application/PHPWord.php';
		// Configuracion zona horaria
		date_default_timezone_set("America/Guatemala");		
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");		

		try {
			$PHPWord = new PHPWord();
			$document = $PHPWord->loadTemplate(str_replace("\\","/",FCPATH).'PlantillasWord/MinutaCV.docx');			

			$this->load->model('mword');

			//////////////////  CLIENTES  /////////////////
			$datosCliente = $this->mword->getContratoReserva($idnegociacion);
			if(!$datosCliente) {
				$datosCliente = $this->mword->getContratoReservaTemporal($idnegociacion);
			}
			$textoclientes = "";
			$tipocambioneg = 0;
			foreach ($datosCliente as $dato) {
				$monedacontrato = $dato->monedacontrato;	
				if($monedacontrato == 1){
					$this->load->model('mtipocambio');
					$tipocambiodia = $this->mtipocambio->getTipoCambioDia();
					$tipocambioneg = $tipocambiodia[0]->valor;
				}
				else {
					$tipocambioneg = $dato->tipocambioneg;				 
				}

				$nombrecompleto = $dato->nombre." ".$dato->apellido;	
				$nombrefirma = $nombrecompleto;						
				
				$textoclientes = $nombrecompleto.", de ".strtolower($this->toText($this->edad($dato->fecnacimiento)))." años, ".$dato->estadocivil.", ".$dato->profesion;
				$textoclientes = $textoclientes.", ".$dato->nacionalidad.", con domicilio en ".$dato->dirresidencia.", quien por no ser de mi anterior conocimiento, se identifica con el Documento Personal de Identificación con Código Único de Identificación número (";
				$textoclientes = $textoclientes.$dato->dpi."), extendido por el Registro Nacional de las Personas de la República de Guatemala, ";
				
				
				if($dato->clientejuridico == 1 || $dato->clientejuridico == null) {
					$textoclientes = $textoclientes."y tiene número de identificación tributario ".$dato->nit."; ";					
				}else if($dato->clientejuridico == 2) {					
					$textoclientes = $textoclientes."El señor (a) ".$nombrecompleto." comparece en su calidad de ".$dato->especifiquejuridico.", calidad que acredita con el Acta Notarial en la cual se hizo constar su nombramiento autorizada en ".$dato->nombramientojuridico.", el día ".$dato->fechanombramiento." por el Notario ".$dato->notarionombramiento.", la cual se encuentra inscrita en el Registro Mercantil General de la Republica de Guatemala bajo en número de Registro ".$this->toText($dato->registro)." (".$dato->registro."), folio ".$this->toText($dato->folio)." (".$dato->folio.") del libro ".$this->toText($dato->libro)." (".$dato->libro.") de Auxiliares de Comercio, que tengo a la vista, y se encuentra facultado por _____________, calidad que acredita con el _____________, y la entidad tiene número tributario ".$dato->nitjuridico." ";
				}
				$textoclientes = $textoclientes."y en el curso del presente contrato se me podrá denominar simplemente como \"LA PARTE COMPRADORA\".";				
				
				$document->setValue("PrecioVenta",utf8_decode($this->toText(round($dato->precioventa*$tipocambioneg,2),true)." QUETZALES (Q.".number_format($dato->precioventa*$tipocambioneg,2,".",",").")"));
				$document->setValue('PrecioIva',utf8_decode($this->toText(round($dato->precioventa*$tipocambioneg*0.12,2),true)." QUETZALES (Q.".number_format($dato->precioventa*$tipocambioneg*0.12,2,".",",").")"));
				$document->setValue('PrecioTotal',utf8_decode($this->toText(round($dato->precioventa*$tipocambioneg*1.12,2),true)." QUETZALES (Q.".number_format($dato->precioventa*$tipocambioneg*1.12,2,".",",").")"));
				$document->setValue('PrecioTotalDolares',utf8_decode($this->toText(round($dato->precioventa*1.12,2),true)." DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (US$.".number_format($dato->precioventa*1.12,2,".",",").")"));

				$document->setValue('NombresCliente',$nombrecompleto);
				

				// Asignacion de variables
				$precioventamonto = $dato->precioventa;
				$reservamonto = $dato->reserva;
				$bancomonto = $dato->financiamientobanco;				
			}
			$document->setValue("Propietarios",utf8_decode($textoclientes));

			////////////////  INMUEBLES  /////////////////////
			$datosInmuebles = $this->mword->getDetInmueblesNegociacion($idnegociacion);
			$letras = array("A. ","B. ","C. ","D. ","E. ","F. ","G. ","H. ","I. ","J. ","K. ","L. ");
			$contInmueb = 0;
			$textoInmuebles = "";
			$textoInmueblesPrecio = "";
			foreach ($datosInmuebles as $dato) {
				$textoInmuebles = $textoInmuebles." ".$letras[$contInmueb]."Finca ".$this->toText($dato->finca)." (".$dato->finca."), Folio ".$this->toText($dato->folio)." (".$dato->folio.") del Libro ".$this->toText($dato->libro)." E (".$dato->libro." E) de Propiedad Horizontal de Guatemala, consiste en ".$dato->tipo." ".$dato->idinmueble.", que tiene un área registral de ".$this->toText($dato->tamano,true)." metros cuadrados (".$dato->tamano." mts2), las medidas y colindancias que constan en su inscripción de dominio;";

				$valorInmueble = $dato->valor * $tipocambioneg;
				$textoInmueblesPrecio = $textoInmueblesPrecio." ".$letras[$contInmueb]."Finca ".$this->toText($dato->finca)." (".$dato->finca."), Folio ".$this->toText($dato->folio)." (".$dato->folio.") del Libro ".$this->toText($dato->libro)." E (".$dato->libro." E) de Propiedad Horizontal de Guatemala, por una cantidad de ".$this->toText($valorInmueble,true)." QUETZALES (Q.".number_format($valorInmueble,2,".",",").");";

				$contInmueb++;
			}
			$document->setValue("Inmuebles",utf8_decode($textoInmuebles));
			$document->setValue("Inmuebles2",utf8_decode($textoInmueblesPrecio));	


			////////////////  FORMA DE PAGO  //////////////////
			//$formapago = $this->mword->getFormaPagoNegociacion($idnegociacion);
			//$document->setValue("FormaPago",utf8_decode($formapago->descripcion));


			// Guarda y cierra el documento
			$filename = tempnam(sys_get_temp_dir(), "PHPWord");
			$document->save($filename);
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=MinutaCV-".$idnegociacion.".docx");
			readfile($filename);
			unlink($filename);

		} catch (Exception $e) {
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}


	public function edad($fecha){
	    $fecha = str_replace("/","-",$fecha);

	    list($Y,$m,$d) = explode("-",$fecha);
    	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	    
	    /*$fecha = date('Y/m/d',strtotime($fecha));
	    $hoy = date('Y/m/d');
	    		echo $hoy - $fecha;
		exit();
	    $edad = $hoy - $fecha;
	    return $edad;*/
	}

	public function conversionMonto($moneda,$monto,$tipocambio,$textomoneda) {
		$montoRetorno = "";
		if($moneda == 2) {
			$montoRetorno = "Q".number_format(round($monto*$tipocambio,2),2,".",",");	
			if($textomoneda == 1){
				$montoRetorno = $montoRetorno." quetzales";
			}			
		}
		else {
			$montoRetorno = "$".number_format($monto,2,".",",");
			if($textomoneda == 1){
				$montoRetorno = $montoRetorno." dólares de los Estados Unidos de América";
			}
		}

		return $montoRetorno;
	}

	function quitar_tildes($cadena) {
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		$texto = str_replace($no_permitidas, $permitidas ,$cadena);
		return $texto;
	}

	public function dpiEnLetras($value) {
		$enLetras = "";
		$bloques = "";
		for ($i=0; $i < 3; $i++) { 
			switch ($i) {
				case 0:
					$bloques = substr($value,0,4);
					$value = substr($value,4,strlen($value)-4);
					break;

				case 1:
					$bloques = substr($value,0,5);
					$value = substr($value,5,strlen($value)-4);
					$enLetras .= ", ";
					break;

				case 2:
					$bloques = substr($value,0,4);
					$value = substr($value,4,strlen($value)-4);
					$enLetras .= ", ";
					if(substr($bloques,0,1) == "0") {
						$enLetras .= $this->toText(0)." ";
					}
					break;
			}

			$enLetras .= $this->toText(strval($bloques));

		}
		
		return $enLetras;
	}

	public function dpiFormato($value) {
		$conFormato = "";
		$bloques = "";
		for ($i=0; $i < 3; $i++) { 
			switch ($i) {
				case 0:
					$bloques = substr($value,0,4);
					$value = substr($value,4,strlen($value)-4);
					break;

				case 1:
					$bloques = substr($value,0,5);
					$value = substr($value,5,strlen($value)-5);
					$conFormato .= " ";
					break;

				case 2:
					$bloques = substr($value,0,4);
					$value = substr($value,4,strlen($value)-4);
					$conFormato .= " ";
					break;
			}

			$conFormato .= $bloques;

		}
		
		return $conFormato;
	}

	public function toText($value, $wdecimal = false){
        $Num2Text = "";
        $separate = explode(".",$value);
        $value = floor($value);

        if ($value == 0) $Num2Text = "cero";
        else if ($value == 1) $Num2Text = "uno";
        else if ($value == 2) $Num2Text = "dos";
        else if ($value == 3) $Num2Text = "tres";
        else if ($value == 4) $Num2Text = "cuatro";
        else if ($value == 5) $Num2Text = "cinco";
        else if ($value == 6) $Num2Text = "seis";
        else if ($value == 7) $Num2Text = "siete";
        else if ($value == 8) $Num2Text = "ocho";
        else if ($value == 9) $Num2Text = "nueve";
        else if ($value == 10) $Num2Text = "diez";
        else if ($value == 11) $Num2Text = "once";
        else if ($value == 12) $Num2Text = "doce";
        else if ($value == 13) $Num2Text = "trece";
        else if ($value == 14) $Num2Text = "catorce";
        else if ($value == 15) $Num2Text = "quince";
        else if ($value == 16) $Num2Text = "dieciséis";
        else if ($value < 20) $Num2Text = "dieci" . $this->toText($value - 10);
        else if ($value == 20) $Num2Text = "veinte";
        else if ($value == 22) $Num2Text = "veintidós";
        else if ($value == 23) $Num2Text = "veintitrés";
        else if ($value == 26) $Num2Text = "veintiséis";
        else if ($value < 30) $Num2Text = "veinti" . $this->toText($value - 20);
        else if ($value == 30) $Num2Text = "treinta";
        else if ($value == 40) $Num2Text = "cuarenta";
        else if ($value == 50) $Num2Text = "cincuenta";
        else if ($value == 60) $Num2Text = "sesenta";
        else if ($value == 70) $Num2Text = "setenta";
        else if ($value == 80) $Num2Text = "ochenta";
        else if ($value == 90) $Num2Text = "noventa";
        else if ($value < 100) $Num2Text = $this->toText(floor($value / 10) * 10) . " y " . $this->toText($value % 10);
        else if ($value == 100) $Num2Text = "cien";
        else if ($value < 200) $Num2Text = "ciento " . $this->toText($value - 100);
        else if (($value == 200) || ($value == 300) || ($value == 400) || ($value == 600) || ($value == 800)) $Num2Text = $this->toText(floor($value / 100) ) . "cientos";
        else if ($value == 500) $Num2Text = "quinientos";
        else if ($value == 700) $Num2Text = "setecientos";
        else if ($value == 900) $Num2Text = "novecientos";
        else if ($value < 1000) $Num2Text = $this->toText(floor($value / 100) * 100) . " " . $this->toText($value % 100);
        else if ($value == 1000) $Num2Text = "mil";
        else if ($value < 2000) $Num2Text = "mil " . $this->toText($value % 1000);
        else if ($value < 1000000)
        {
            $Num2Text = $this->toText(floor($value / 1000)) . " mil";
            if (($value % 1000) > 0) $Num2Text = $Num2Text . " " . $this->toText($value % 1000);
        }
        else if ($value == 1000000) $Num2Text = "un millón";
        else if ($value < 2000000) $Num2Text = "un millón " . $this->toText($value % 1000000);
        else if ($value < 1000000000000)
        {
            $Num2Text = $this->toText(floor($value / 1000000)) . " millones ";
            if (($value - floor($value / 1000000) * 1000000) > 0) $Num2Text = $Num2Text . " " . $this->toText($value - floor($value / 1000000) * 1000000);
        }
        else if ($value == 1000000000000) $Num2Text = "un billón";
        else if ($value < 2000000000000) $Num2Text = "un billón " . $this->toText($value - floor($value / 1000000000000) * 1000000000000);
        else
        {
            $Num2Text = $this->toText(floor($value / 1000000000000)) . " billones";
            if (($value - floor($value / 1000000000000) * 1000000000000) > 0) $Num2Text = $Num2Text . " " . $this->toText($value - floor($value / 1000000000000) * 1000000000000);
        }


        if($wdecimal == true){
        	
        	$decimalNumber = floor($separate[0]);
        	if($decimalNumber != 0 && isset($separate[1])) {
        		$Num2Text = $Num2Text." punto ".$this->toText($separate[1]);
        	}
        }
        //echo $value."-".$Num2Text;
        return $Num2Text;
    }
    
}
