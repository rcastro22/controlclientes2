<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class negociacion extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if(!$this->session->userdata('logged_in'))
		{
			redirect('sesion');
		}
		else
		{
			$this->load->model('musuarioadmin');
			$datosusuario = $this->musuarioadmin->getUsuarioLogin($this->session->userdata('user_id'));

			$this->view_data['usuario']= $this->session->userdata('user_id');
			$this->view_data['datosusuario'] = $datosusuario;
		}
			session_start();
	}

	public function listado($idcliente=-1)
	{
		
		$this->view_data['page_title']=  'Negociaciones';
		$this->view_data['activo']=  'negociaciones';
		$this->view_data['idcliente']= $idcliente;
		if(isset($_SESSION['Idnegociacionnueva']) && $_SESSION['Idnegociacionnueva'] != "") {
			$this->view_data['mensaje']= $_SESSION['Idnegociacionnueva'];
			$this->view_data['tipoAlerta']= "alert-success";
			$_SESSION['Idnegociacionnueva'] = "";
		}
		$this->load_partials();
		$this->load->view('movimientos/negociaciones/listado',$this->view_data);
	}
    
    public function nuevo($idcliente=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de negociación';
    	$this->view_data['activo']=  'negociaciones';
    	$this->view_data['idcliente']= $idcliente;
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$datosnegociacion = new stdClass();
				$this->view_data['datosnegociacion']=$datosnegociacion;

				$datosnegociacion->nombre=$this->input->post('nombre');
				$datosnegociacion->apellido=$this->input->post('apellido');
				$datosnegociacion->fecnacimiento=$this->input->post('fecnacimiento');
				$datosnegociacion->dpi=$this->input->post('dpi');
				$datosnegociacion->estadocivil=$this->input->post('estadocivil');
				$datosnegociacion->profesion=$this->input->post('profesion');
				$datosnegociacion->correo=$this->input->post('correo');
				$datosnegociacion->telefono=$this->input->post('telefono');
				$datosnegociacion->celular=$this->input->post('celular');
				$datosnegociacion->direccion=$this->input->post('direccion');
				$datosnegociacion->empresa=$this->input->post('empresa');
				$datosnegociacion->tiempolabor=$this->input->post('tiempolabor');
				$datosnegociacion->dirtrabajo=$this->input->post('dirtrabajo');
				$datosnegociacion->puesto=$this->input->post('puesto');
				$datosnegociacion->ingresos=$this->input->post('ingresos');
				$datosnegociacion->otrosingresos=$this->input->post('otrosingresos');

				$datosnegociacion->idproyecto=$this->input->post('proyectos');
				$datosnegociacion->idcliente=$this->input->post('cliente');

				$datosnegociacion->clientejuridico=$this->input->post('clientejuridico');
				$datosnegociacion->especifiquejuridico=$this->input->post('especifiquejuridico');
				$datosnegociacion->nombramientojuridico=$this->input->post('nombramientojuridico');

				$datosnegociacion->idinmueble=$this->input->post('inmueble');
				$datosnegociacion->idasesor=$this->input->post('asesor');
				$datosnegociacion->idtipoinmueble=$this->input->post('tiposinmueble');
				$datosnegociacion->idmodelo=$this->input->post('modelo');

				$datosnegociacion->tamano=$this->input->post('tamano');
				$datosnegociacion->dormitorios=$this->input->post('dormitorios');
				
				$datosnegociacion->precioventa=$this->input->post('precioventa');
				$datosnegociacion->reserva=$this->input->post('reserva');
				$datosnegociacion->reciboreserva=$this->input->post('reciboreserva');
				$datosnegociacion->fechareserva=$this->input->post('fechareserva');
				$datosnegociacion->enganche=$this->input->post('enganche');
				$datosnegociacion->saldoenganche=$this->input->post('saldoenganche');
				$datosnegociacion->saldoenganche=$this->input->post('financiamientobanco');
				$datosnegociacion->nocuotas=$this->input->post('nocuotas');
				$datosnegociacion->cuotamensual=$this->input->post('cuotamensual');			
				$datosnegociacion->comision=$this->input->post('comision');		
				$datosnegociacion->banco=$this->input->post('banco');		

				$datosnegociacion->monedacontrato=$this->input->post('monedacontrato');
				$datosnegociacion->tipocambioneg=$this->input->post('tipocambioneg');

				$datosnegociacion->formapago=$this->input->post('formapago');
                $datosnegociacion->plazocredito=$this->input->post('plazocredito');
                $datosnegociacion->tipofinanciamiento=$this->input->post('tipofinanciamiento');
                $datosnegociacion->entidadautorizada=$this->input->post('entidadautorizada');
                $datosnegociacion->tasainteres=$this->input->post('tasainteres');

				$datosnegociacion->tablai=str_replace(array("\""), "'", $this->input->post('tablainmuebles'));
				$datosnegociacion->tablaotros=str_replace(array("\""), "'", $this->input->post('tablaotros'));
				$datosnegociacion->total_tablai=$this->input->post('txtTotalDecimal');


				$datosnegociacion->otrosclientes=$this->input->post('otrosclientes');
				$this->load->view('movimientos/negociaciones/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//echo json_decode($this->input->post('test'));
				//exit();
				// falta validaciones para combos
				$this->form_validation->set_rules('proyectos','Proyectos');

				if($this->input->post('cliente') == '0') {
					$this->form_validation->set_rules('nombre','Nombres','required');
					$this->form_validation->set_rules('apellido','Apellidos','required');
					$this->form_validation->set_rules('nit','Nit','required');
					$this->form_validation->set_rules('fecnacimiento','Fecha de nacimiento','required');
					$this->form_validation->set_rules('dpi','DPI','required');
					$this->form_validation->set_rules('estadocivil','Estado civil','required');
					$this->form_validation->set_rules('profesion','Profesion','required');
					$this->form_validation->set_rules('correo','Correo','required');
					
					$this->form_validation->set_rules('telefono','Telefono','required');
					$this->form_validation->set_rules('celular','Celular','required');
					
					$this->form_validation->set_rules('direccion','Direccion','required');

					$this->form_validation->set_rules('empresa','Empresa','required');
					$this->form_validation->set_rules('tiempolabor','Tiempo de laborar','required');
					$this->form_validation->set_rules('dirtrabajo','Dirección de trabajo','required');
					$this->form_validation->set_rules('puesto','Puesto','required');
					$this->form_validation->set_rules('ingresos','Ingresos mensuales');
				} 

				/*$this->input->post('especifiquejuridico');
				$this->input->post('nombramientojuridico');*/
				if($this->input->post('clientejuridico')=="2")
				{
					$this->form_validation->set_rules('especifiquejuridico','Especifíque','required');
					$this->form_validation->set_rules('nombramientojuridico','Nombramiento','required');
				}
				
				if($this->input->post('monedacontrato')=="2")
				{
					$this->form_validation->set_rules('tipocambioneg','Tipo de cambio','required|numeric');
				}
				
				$this->form_validation->set_rules('precioventa','Precio Venta','required|numeric');
				$this->form_validation->set_rules('reserva','Reserva','required|numeric');
				$this->form_validation->set_rules('enganche','Enganche','required|numeric');
				$this->form_validation->set_rules('saldoenganche','Saldo enganche','required|numeric');
				$this->form_validation->set_rules('nocuotas','No. Cuotas','required|integer');
				$this->form_validation->set_rules('cuotamensual','Cuota mensual','required|numeric');
				$this->form_validation->set_rules('fechaprimerpago','Fecha primer pago','required');
				//Falta validacion para asesor
				$this->form_validation->set_rules('comision','Comision','required|numeric');
				$this->form_validation->set_rules('banco','Banco');
				
				if($this->form_validation->run()==FALSE)
				{
					$datosnegociacion = new stdClass();	

					$datosnegociacion->nombre=$this->input->post('nombre');
					$datosnegociacion->apellido=$this->input->post('apellido');
					$datosnegociacion->fecnacimiento=$this->input->post('fecnacimiento');
					$datosnegociacion->dpi=$this->input->post('dpi');
					$datosnegociacion->estadocivil=$this->input->post('estadocivil');
					$datosnegociacion->profesion=$this->input->post('profesion');
					$datosnegociacion->correo=$this->input->post('correo');
					$datosnegociacion->telefono=$this->input->post('telefono');
					$datosnegociacion->celular=$this->input->post('celular');
					$datosnegociacion->direccion=$this->input->post('direccion');
					$datosnegociacion->empresa=$this->input->post('empresa');
					$datosnegociacion->tiempolabor=$this->input->post('tiempolabor');
					$datosnegociacion->dirtrabajo=$this->input->post('dirtrabajo');
					$datosnegociacion->puesto=$this->input->post('puesto');
					$datosnegociacion->ingresos=$this->input->post('ingresos');
					$datosnegociacion->otrosingresos=$this->input->post('otrosingresos');

					$datosnegociacion->idproyecto=$this->input->post('proyectos');
					$datosnegociacion->idcliente=$this->input->post('cliente');

					$datosnegociacion->clientejuridico=$this->input->post('clientejuridico');
					$datosnegociacion->especifiquejuridico=$this->input->post('especifiquejuridico');
					$datosnegociacion->nombramientojuridico=$this->input->post('nombramientojuridico');


					$datosnegociacion->idinmueble=$this->input->post('inmueble');
					$datosnegociacion->idasesor=$this->input->post('asesor');
					$datosnegociacion->idtipoinmueble=$this->input->post('tiposinmueble');
					$datosnegociacion->idmodelo=$this->input->post('modelo');

					$datosnegociacion->tamano=$this->input->post('tamano');
					$datosnegociacion->dormitorios=$this->input->post('dormitorios');

					$datosnegociacion->fechaprimerpago=$this->input->post('fechaprimerpago');
					$datosnegociacion->precioventa=$this->input->post('precioventa');
					$datosnegociacion->reserva=$this->input->post('reserva');
					$datosnegociacion->reciboreserva=$this->input->post('reciboreserva');
					$datosnegociacion->fechareserva=$this->input->post('fechareserva');
					$datosnegociacion->enganche=$this->input->post('enganche');
					$datosnegociacion->saldoenganche=$this->input->post('saldoenganche');
					$datosnegociacion->saldoenganche=$this->input->post('financiamientobanco');
					$datosnegociacion->nocuotas=$this->input->post('nocuotas');
					$datosnegociacion->cuotamensual=$this->input->post('cuotamensual');
					$datosnegociacion->comision=$this->input->post('comision');		
					$datosnegociacion->banco=$this->input->post('banco');

					$datosnegociacion->monedacontrato=$this->input->post('monedacontrato');
      				$datosnegociacion->tipocambioneg=$this->input->post('tipocambioneg');

      				$datosnegociacion->formapago=$this->input->post('formapago');
                    $datosnegociacion->plazocredito=$this->input->post('plazocredito');
                    $datosnegociacion->tipofinanciamiento=$this->input->post('tipofinanciamiento');
                    $datosnegociacion->entidadautorizada=$this->input->post('entidadautorizada');
                    $datosnegociacion->tasainteres=$this->input->post('tasainteres');

                    $datosnegociacion->montodescuento=$this->input->post('montodescuento');
                    $datosnegociacion->descripciondescuento=$this->input->post('descripciondescuento');

										
					$datosnegociacion->tablai=str_replace(array("\""), "'", $this->input->post('tablainmuebles'));
					$datosnegociacion->tablaotros=str_replace(array("\""), "'", $this->input->post('tablaotros'));
					$datosnegociacion->total_tablai=$this->input->post('txtTotalDecimal');

					$datosnegociacion->otrosclientes=$this->input->post('otrosclientes');

					$this->view_data['datosnegociacion']=$datosnegociacion;					
					$this->load->view('movimientos/negociaciones/nuevo',$this->view_data);
				}
				else 	// SI la validacion fue correcta
				{					
					$datosnegociacion = new stdClass();	

					$datosnegociacion->nombre=$this->input->post('nombre');
                    $datosnegociacion->apellido=$this->input->post('apellido');
                    $datosnegociacion->fecnacimiento=$this->input->post('fecnacimiento');
                    $datosnegociacion->dpi=$this->input->post('dpi');
                    $datosnegociacion->estadocivil=$this->input->post('estadocivil');
                    $datosnegociacion->profesion=$this->input->post('profesion');
                    $datosnegociacion->correo=$this->input->post('correo');
                    $datosnegociacion->telefono=$this->input->post('telefono');
                    $datosnegociacion->celular=$this->input->post('celular');
                    $datosnegociacion->direccion=$this->input->post('direccion');
                    $datosnegociacion->empresa=$this->input->post('empresa');
                    $datosnegociacion->tiempolabor=$this->input->post('tiempolabor');
                    $datosnegociacion->dirtrabajo=$this->input->post('dirtrabajo');
                    $datosnegociacion->puesto=$this->input->post('puesto');
                    $datosnegociacion->ingresos=$this->input->post('ingresos');
                    $datosnegociacion->otrosingresos=$this->input->post('otrosingresos');

					$datosnegociacion->idproyecto=$this->input->post('proyectos');
					$datosnegociacion->idcliente=$this->input->post('cliente');
					$datosnegociacion->clientejuridico=$this->input->post('clientejuridico');
					$datosnegociacion->especifiquejuridico=$this->input->post('especifiquejuridico');
					$datosnegociacion->nombramientojuridico=$this->input->post('nombramientojuridico');

					$datosnegociacion->idinmueble=$this->input->post('inmueble');
					$datosnegociacion->idasesor=$this->input->post('asesor');
					$datosnegociacion->idtipoinmueble=$this->input->post('tiposinmueble');
					$datosnegociacion->idmodelo=$this->input->post('modelo');

					$datosnegociacion->tamano=$this->input->post('tamano');
					$datosnegociacion->dormitorios=$this->input->post('dormitorios');

					$datosnegociacion->fechaprimerpago=$this->input->post('fechaprimerpago');
					$datosnegociacion->precioventa=$this->input->post('precioventa');
					$datosnegociacion->reserva=$this->input->post('reserva');
					$datosnegociacion->reciboreserva=$this->input->post('reciboreserva');
					$datosnegociacion->fechareserva=$this->input->post('fechareserva');
					$datosnegociacion->enganche=$this->input->post('enganche');
					$datosnegociacion->saldoenganche=$this->input->post('saldoenganche');
					$datosnegociacion->saldoenganche=$this->input->post('financiamientobanco');
					$datosnegociacion->nocuotas=$this->input->post('nocuotas');
					$datosnegociacion->cuotamensual=$this->input->post('cuotamensual');
					$datosnegociacion->comision=$this->input->post('comision');		
					$datosnegociacion->banco=$this->input->post('banco');
					
					$datosnegociacion->monedacontrato=$this->input->post('monedacontrato');
					$datosnegociacion->tipocambioneg=$this->input->post('tipocambioneg');

					$datosnegociacion->formapago=$this->input->post('formapago');
                    $datosnegociacion->plazocredito=$this->input->post('plazocredito');
                    $datosnegociacion->tipofinanciamiento=$this->input->post('tipofinanciamiento');
                    $datosnegociacion->entidadautorizada=$this->input->post('entidadautorizada');
                    $datosnegociacion->tasainteres=$this->input->post('tasainteres');

                    $datosnegociacion->montodescuento=$this->input->post('montodescuento');
                    $datosnegociacion->descripciondescuento=$this->input->post('descripciondescuento');


					$datosnegociacion->tablai=str_replace(array("\""), "'", $this->input->post('tablainmuebles'));
					$datosnegociacion->tablaotros=str_replace(array("\""), "'", $this->input->post('tablaotros'));
					$datosnegociacion->total_tablai=$this->input->post('txtTotalDecimal');

					$datosnegociacion->otrosclientes=$this->input->post('otrosclientes');

					$this->view_data['datosnegociacion']=$datosnegociacion;				

					$err="";
					if($this->input->post('enganche') > $this->input->post('precioventa') || $this->input->post('reserva') > $this->input->post('precioventa'))	
					{
						$err = "El monto del enganche o reserva no puede ser mayor al precio de venta";
					}

					if($this->input->post('reserva') > $this->input->post('enganche'))	
					{
						$err = "El monto de reserva no puede ser mayor al monto de enganche";
					}

					if($this->input->post('edad') < 18)	
					{
						$err = "La edad del cliente debe ser mayor a 18 años";
					}

					if($err=="") {
						if($this->input->post('hcliente') == '0') {
							$this->load->model('mcliente');							
							$datosclientenit = $this->mcliente->getClienteIdByNit($this->input->post('nit'));

							if(isset($datosclientenit->nit) && $datosclientenit->nit != "") {
								$err = "El número de NIT ya existe en un cliente guardado";
							} 	
						}
					}

					if($err=="")
					{
						// Inserta la negociacion
						$this->load->model('mnegociacion');
						$inserto=$this->mnegociacion->grabar(array(
							   'idproyecto'=>$this->input->post('proyectos'),
							   'idcliente'=>$this->input->post('hcliente'),
							   'clientejuridico'=>$this->input->post('clientejuridico'),
							   'especifiquejuridico'=>$this->input->post('especifiquejuridico'),
							   'nombramientojuridico'=>$this->input->post('nombramientojuridico'),
							   'idinmueble'=>$this->input->post('inmueble'),
							   'idasesor'=>$this->input->post('asesor'),
							   'fecha'=>date('Y-m-d',strtotime($this->input->post('fechaprimerpago'))),
							   'precioventa'=>$this->input->post('precioventa'),
							   'reserva'=>$this->input->post('reserva'),
							   'reciboreserva'=>$this->input->post('reciboreserva'),
							   'fechareserva'=>$this->input->post('fechareserva'),
							   'enganche'=>$this->input->post('enganche'),
							   'saldoenganche'=>$this->input->post('saldoenganche'),
							   'financiamientobanco' =>$this->input->post('financiamientobanco'),
							   'nocuotas'=>$this->input->post('nocuotas'),
							   'cuotamensual'=>$this->input->post('cuotamensual'),
							   'comision'=>$this->input->post('comision'),
							   'facturabanco' =>$this->input->post('banco'),
							   'monedacontrato'=>$this->input->post('monedacontrato'),
							   'tipocambioneg'=>$this->input->post('tipocambioneg'),
							   'status'=>'CR',
							   'formapago'=>$this->input->post('formapago'),
                               'plazocredito'=>$this->input->post('plazocredito'),
                               'tipofinanciamiento'=>$this->input->post('tipofinanciamiento'),
                               'entidadautorizada'=>$this->input->post('entidadautorizada'),
                               'tasainteres'=>$this->input->post('tasainteres'),
                               'montodescuento'=>$this->input->post('montodescuento'),
                               'descripciondescuento'=>$this->input->post('descripciondescuento'),
							   //Auditoria
							   'CreadoPor'=>$this->session->userdata('user_id'),
							   'FechaCreado'=>date("Y-m-d H:i:s"),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
							   ),$err);
	              		if($inserto)
						{
							// Inserta las cuotas
							$this->load->model('mnegociacion');
							$datosnegociacionMax = $this->mnegociacion->getMaxNegociacion();
							$fecha = strtotime($this->input->post('fechaprimerpago'));
							//Inserta detalle de pago
							for($x=1;$x<=$this->input->post('nocuotas');$x++)
							{
								$this->load->model('mdetallepago');
								$inserto2=$this->mdetallepago->grabar(array(
									   'idnegociacion'=>$datosnegociacionMax->maximo,
									   'nopago'=>$x,
									   'fechalimitepago'=>date('Y-m-d',$fecha),
									   'pagocalculado'=>$this->input->post('cuotamensual'),
									   'pagoefectuado'=>0,
									   'moracalculada'=>0,
									   'morapagada'=>0,
									   //Auditoria
									   'CreadoPor'=>$this->session->userdata('user_id'),
									   'FechaCreado'=>date("Y-m-d H:i:s"),
									   'ModificadoPor'=>$this->session->userdata('user_id'),
									   'FechaModificado'=>date("Y-m-d H:i:s")
									   ),$err);

								$fecha = strtotime('+1 month',$fecha);
							}

							// Inserta cliente temporal
							if($this->input->post('cliente') == '0') {
								$this->load->model('mcliente');
								$inserto2=$this->mcliente->grabartemp(array(
										'idnegociacion'=>$datosnegociacionMax->maximo,
										'nombre'=>$this->input->post('nombre'),
										'apellido'=>$this->input->post('apellido'),
										//'idtipoidentificacion'=>$this->input->post('tipoidentificaciones'),
										'idtipoidentificacion'=>1,
										'dpi'=>$this->input->post('dpi'),
										'fecnacimiento'=>date('Y-m-d',strtotime($this->input->post('fecnacimiento'))),
										'profesion'=>$this->input->post('profesion'),
										//'nacionalidad'=>$this->input->post('nacionalidad'),
										'estadocivil'=>$this->input->post('estadocivil'),
										'dirresidencia'=>$this->input->post('direccion'),
										'telefono'=>$this->input->post('telefono'),
										'celular'=>$this->input->post('celular'),
										'nit'=>$this->input->post('nit'),
										'email'=>$this->input->post('correo'),
										'lugartrabajo'=>$this->input->post('empresa'),
										'dirtrabajo'=>$this->input->post('dirtrabajo'),
										'tiempolabor'=>$this->input->post('tiempolabor'),
										'ingresos'=>$this->input->post('ingresos'),
										'puesto'=>$this->input->post('puesto'),
										'otrosingresos'=>$this->input->post('otrosingresos'),
										//'concepto'=>$this->input->post('concepto'),
										//Auditoria
										'CreadoPor'=>$this->session->userdata('user_id'),
										'FechaCreado'=>date("Y-m-d H:i:s"),
										'ModificadoPor'=>$this->session->userdata('user_id'),
										'FechaModificado'=>date("Y-m-d H:i:s")
								),$err);
							}	

							$arreglo = json_decode($this->input->post('tablainmuebles'));
							//$arreglo = $_POST['arreglo'];
					    	$this->load->model('mdetallenegociacion');
							$inserto=$this->mdetallenegociacion->grabar($arreglo,$datosnegociacionMax->maximo,$err);
							//echo $arreglo;
							//exit();
							$_SESSION['Idnegociacionnueva'] = "Se ha creado la negociacion No. ".$datosnegociacionMax->maximo;
							redirect('movimientos/negociacion/listado/-1');
						}
						else
	                    {
	                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/negociaciones/nuevo',$this->view_data);
	                    }
	                }
                	else
                	{
                			$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/negociaciones/nuevo',$this->view_data);
                	}
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idnegociacion=-1, $msgError="", $tipoAlerta="")
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de negociación';
    	$this->view_data['activo']=  'negociaciones';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('mnegociacion');
				$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);

				$datosnegociacion->tablai="";
				$datosnegociacion->tablaotros="";
			    $datosnegociacion->total_tablai=$datosnegociacion->precioventa;
			    $this->load->model('mcliente');
			    if($datosnegociacion->idcliente == 0) {
        			$datoscliente = $this->mcliente->getClienteTemporal($idnegociacion);
        		}
        		else {
        			$datoscliente = $this->mcliente->getClienteId($datosnegociacion->idcliente);
        		}
        		$datosnegociacion->nit = $datoscliente->nit;
    			$datosnegociacion->nombre = $datoscliente->nombre;
    			$datosnegociacion->apellido = $datoscliente->apellido;
    			$datosnegociacion->fecnacimiento = $datoscliente->fecnacimiento;
    			$datosnegociacion->dpi = $datoscliente->dpi;
    			$datosnegociacion->estadocivil = $datoscliente->estadocivil;
    			$datosnegociacion->profesion = $datoscliente->profesion;
    			$datosnegociacion->correo = $datoscliente->correo;
    			$datosnegociacion->telefono = $datoscliente->telefono;
    			$datosnegociacion->celular = $datoscliente->celular;
    			$datosnegociacion->direccion = $datoscliente->dirresidencia;
    			$datosnegociacion->empresa = $datoscliente->lugartrabajo;
    			$datosnegociacion->tiempolabor = $datoscliente->tiempolabor;
    			$datosnegociacion->dirtrabajo = $datoscliente->dirtrabajo;
    			$datosnegociacion->puesto = $datoscliente->puesto;
    			$datosnegociacion->ingresos = $datoscliente->ingresos;
    			$datosnegociacion->otrosingresos = $datoscliente->otrosingresos;

        		$this->view_data['datosnegociacion']=$datosnegociacion; 	
        		if($msgError != "") {
        			$this->view_data['mensaje']=str_replace("_"," ",$msgError);
	               	$this->view_data['tipoAlerta']=$tipoAlerta;
	            }
				$this->load->view('movimientos/negociaciones/edit',$this->view_data);
				break;
			case 'POST':
				// falta validaciones para combos
				$this->form_validation->set_rules('proyectos','Proyectos');

				if($this->input->post('clientejuridico')=="2")
				{
					$this->form_validation->set_rules('especifiquejuridico','Especifíque','required');
					$this->form_validation->set_rules('nombramientojuridico','Nombramiento','required');
				}

				if($this->input->post('monedacontrato')=="2")
				{
					$this->form_validation->set_rules('tipocambioneg','Tipo de cambio','required|numeric');
				}

				$this->form_validation->set_rules('precioventa','Precio Venta','required|numeric');
				$this->form_validation->set_rules('reserva','Reserva','required|numeric');
				$this->form_validation->set_rules('enganche','Enganche','required|numeric');
				$this->form_validation->set_rules('saldoenganche','Saldo enganche','required|numeric');
				$this->form_validation->set_rules('nocuotas','No. Cuotas','required|integer');
				$this->form_validation->set_rules('cuotamensual','Cuota mensual','required|numeric');
				$this->form_validation->set_rules('fechaprimerpago','Fecha primer pago','required');
				//Falta validacion para asesor
				$this->form_validation->set_rules('comision','Comision','required|numeric');
				$this->form_validation->set_rules('banco','Banco');
				if($this->form_validation->run()==FALSE)
				{
					$datosnegociacion = new stdClass();					
					$datosnegociacion->idnegociacion=$this->input->post('idnegociacion');
					$datosnegociacion->idproyecto=$this->input->post('proyectos');

					$datosnegociacion->clientejuridico=$this->input->post('clientejuridico');
					$datosnegociacion->especifiquejuridico=$this->input->post('especifiquejuridico');
					$datosnegociacion->nombramientojuridico=$this->input->post('nombramientojuridico');

					$datosnegociacion->idcliente=$this->input->post('cliente');
					$datosnegociacion->idinmueble=$this->input->post('inmueble');
					$datosnegociacion->idasesor=$this->input->post('asesor');
					$datosnegociacion->idtipoinmueble=$this->input->post('tiposinmueble');
					$datosnegociacion->idmodelo=$this->input->post('modelo');

					$datosnegociacion->tamano=$this->input->post('tamano');
					$datosnegociacion->dormitorios=$this->input->post('dormitorios');

					$datosnegociacion->fecha=$this->input->post('fechaprimerpago');
					$datosnegociacion->precioventa=$this->input->post('precioventa');
					$datosnegociacion->reserva=$this->input->post('reserva');
					$datosnegociacion->reciboreserva=$this->input->post('reciboreserva');
					$datosnegociacion->fechareserva=$this->input->post('fechareserva');
					$datosnegociacion->enganche=$this->input->post('enganche');
					$datosnegociacion->saldoenganche=$this->input->post('saldoenganche');
					$datosnegociacion->financiamientobanco=$this->input->post('financiamientobanco');
					$datosnegociacion->nocuotas=$this->input->post('nocuotas');
					$datosnegociacion->cuotamensual=$this->input->post('cuotamensual');
					$datosnegociacion->comision=$this->input->post('comision');
					$datosnegociacion->facturabanco=$this->input->post('banco');
					$datosnegociacion->monedacontrato=$this->input->post('monedacontrato');
					$datosnegociacion->tipocambioneg=$this->input->post('tipocambioneg');

					$datosnegociacion->montodescuento=$this->input->post('montodescuento');
					$datosnegociacion->descripciondescuento=$this->input->post('descripciondescuento');

					$datosnegociacion->status=$this->input->post('status');

					$datosnegociacion->tablai=str_replace(array("\""), "'", $this->input->post('tablainmuebles'));
					$datosnegociacion->tablaotros=str_replace(array("\""), "'", $this->input->post('tablaotros'));
					//$atosnegociacion->total_tablai=$this->input->post('txtTotalDecimal');

					$this->view_data['datosnegociacion']=$datosnegociacion;
					$this->load->view('movimientos/negociaciones/edit',$this->view_data);
				}
				else
				{
					$datosnegociacion = new stdClass();		
                    $datosnegociacion->idnegociacion=$this->input->post('idnegociacion');			
					$datosnegociacion->idproyecto=$this->input->post('proyectos');
					$datosnegociacion->idcliente=$this->input->post('cliente');

					$datosnegociacion->clientejuridico=$this->input->post('clientejuridico');
					$datosnegociacion->especifiquejuridico=$this->input->post('especifiquejuridico');
					$datosnegociacion->nombramientojuridico=$this->input->post('nombramientojuridico');

					$datosnegociacion->idinmueble=$this->input->post('inmueble');
					$datosnegociacion->idasesor=$this->input->post('asesor');
					$datosnegociacion->idtipoinmueble=$this->input->post('tiposinmueble');
					$datosnegociacion->idmodelo=$this->input->post('modelo');

					$datosnegociacion->tamano=$this->input->post('tamano');
					$datosnegociacion->dormitorios=$this->input->post('dormitorios');

					$datosnegociacion->fecha=$this->input->post('fechaprimerpago');
					$datosnegociacion->precioventa=$this->input->post('precioventa');
					$datosnegociacion->reserva=$this->input->post('reserva');
					$datosnegociacion->reciboreserva=$this->input->post('reciboreserva');
					$datosnegociacion->fechareserva=$this->input->post('fechareserva');
					$datosnegociacion->enganche=$this->input->post('enganche');
					$datosnegociacion->saldoenganche=$this->input->post('saldoenganche');
					$datosnegociacion->financiamientobanco=$this->input->post('financiamientobanco');
					$datosnegociacion->nocuotas=$this->input->post('nocuotas');
					$datosnegociacion->cuotamensual=$this->input->post('cuotamensual');
					$datosnegociacion->comision=$this->input->post('comision');
					$datosnegociacion->facturabanco=$this->input->post('banco');

					$datosnegociacion->monedacontrato=$this->input->post('monedacontrato');
					$datosnegociacion->tipocambioneg=$this->input->post('tipocambioneg');

					$datosnegociacion->montodescuento=$this->input->post('montodescuento');
					$datosnegociacion->descripciondescuento=$this->input->post('descripciondescuento');

					$datosnegociacion->status=$this->input->post('status');

					$datosnegociacion->tablai=str_replace(array("\""), "'", $this->input->post('tablainmuebles'));
					$datosnegociacion->tablaotros=str_replace(array("\""), "'", $this->input->post('tablaotros'));
					//$datosnegociacion->total_tablai=$this->input->post('txtTotalDecimal');

					$this->view_data['datosnegociacion']=$datosnegociacion;

					$this->load->model('mdetallepago');
					$datosdetallepago = $this->mdetallepago->getCantidadPagosEfectuados($this->input->post('idnegociacion'));
					$pagosefectuados = $datosdetallepago->pagosefectuados;

					$err="";
					if($this->input->post('nocuotas') < $pagosefectuados)	
					{
						$err = "El número de cuotas no puede ser menor a la cantidad de pagos efectuados";
					}

					if($this->input->post('enganche') > $this->input->post('precioventa') || $this->input->post('reserva') > $this->input->post('precioventa'))	
					{
						$err = "El monto del enganche o reserva no puede ser mayor al precio de venta";
					}

					if($this->input->post('reserva') > $this->input->post('enganche'))	
					{
						$err = "El monto de reserva no puede ser mayor al monto de enganche";
					}

					if($err=="")
					{
						$this->load->model('mnegociacion');
						$err="";
						$siactualizo=$this->mnegociacion->modificar($this->input->post('idnegociacion'),
							    array(
							    	'idcliente'=>$this->input->post('cboCliente'),
							    	'clientejuridico'=>$this->input->post('clientejuridico'),
							   		'especifiquejuridico'=>$this->input->post('especifiquejuridico'),
							   		'nombramientojuridico'=>$this->input->post('nombramientojuridico'),
							    	'idasesor'=>$this->input->post('asesor'),
								   'fecha'=>date('Y-m-d',strtotime($this->input->post('fechaprimerpago'))),
								   'precioventa'=>$this->input->post('precioventa'),
								   'reserva'=>$this->input->post('reserva'),
								   'reciboreserva'=>$this->input->post('reciboreserva'),
							   	   'fechareserva'=>$this->input->post('fechareserva'),
								   'enganche'=>$this->input->post('enganche'),
								   'saldoenganche'=>$this->input->post('saldoenganche'),
								   'financiamientobanco' =>$this->input->post('financiamientobanco'),
								   'nocuotas'=>$this->input->post('nocuotas'),
								   'cuotamensual'=>$this->input->post('cuotamensual'),
								   'comision'=>$this->input->post('comision'),
								   'facturabanco'=>$this->input->post('banco'),
								   'monedacontrato'=>$this->input->post('monedacontrato'),
								   'tipocambioneg'=>$this->input->post('tipocambioneg'),
								   'montodescuento'=>$this->input->post('montodescuento'),
								   'descripciondescuento'=>$this->input->post('descripciondescuento'),
								   // Auditoria
								   'ModificadoPor'=>$this->session->userdata('user_id'),
								   'FechaModificado'=>date("Y-m-d H:i:s")
							        ),$err);
	                    
	                    
	                    if ($siactualizo)
	                    {
	                    	// 09-03-2015, Actualiza los inmuebles de la negociacion
	                    	$arreglo = json_decode($this->input->post('tablainmuebles'));
							//$arreglo = $_POST['arreglo'];							
					    	$this->load->model('mdetallenegociacion');
					    	$sielimino=$this->mdetallenegociacion->borrar($this->input->post('idnegociacion'),$err);
					    	if($sielimino)
								$inserto=$this->mdetallenegociacion->grabar($arreglo,$this->input->post('idnegociacion'),$err);

							// 09-03-2015, Actualiza los datos del cliente
	                    	
							
	                    	redirect('movimientos/negociacion/listado/-1');
	                    }
	                    else
	                    {
	                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/negociaciones/edit',$this->view_data);
	                    }
                	}
                	else
                	{
                			$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/negociaciones/edit',$this->view_data);
                	}
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

    public function pago($idnegociacion=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Realizar pago';
    	$this->view_data['activo']=  'negociaciones';
		$this->load_partials();
		$this->load->model('mnegociacion');
		$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
		$this->view_data['datosnegociacion']=$datosnegociacion;
		$this->load->view('movimientos/negociaciones/pago',$this->view_data);
    }


	public function borrar($idnegociacion=-1)
 	{
 		$this->load->model('mnegociacion');
		$sielimino=$this->mnegociacion->borrar($idnegociacion,$err);
        

		if ($sielimino)
        {
        	$this->load->model('mnegociacion');
			$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
        	redirect('movimientos/negociacion/listado/');
        }
        else
        {
        	$this->view_data['page_title']=  'Negociaciones';
    		$this->view_data['activo']= 'negociaciones';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('movimientos/clientes/listado',$this->view_data);
        }
	}
	
	//public function index($page=1)
	public function getNegociacion($idcliente=-1,$status="123")
	{
		$arr1 = str_split($status);
		$statusParm = "";
		foreach ($arr1 as $val) {
			switch ($val) {
				case '1':
					if(strlen($statusParm) == 0)	$statusParm .= "'CR'";
					else 	$statusParm .= ",'CR'";
					break;

				case '2':
					if(strlen($statusParm) == 0) 	$statusParm .= "'AP'";
					else 	$statusParm .= ",'AP'";
					break;

				case '3':
					if(strlen($statusParm) == 0) 	$statusParm .= "'RS'";
					else 	$statusParm .= ",'RS'";
					break;
				
				case '0':
					if(strlen($statusParm) == 0) 	$statusParm .= "''";
					else 	$statusParm .= ",''";
					break;
			}
		}

		if(strlen($statusParm) == 0)
			$statusParm = "'CR','AP','RS'";

		$this->load->model('mnegociacion');
		$negociacion = $this->mnegociacion->getNegociaciones($idcliente,$statusParm);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($negociacion));
	}

	
	public function getDetNegociacion($idnegociacion=-1)
	{
		$this->load->model('mdetallenegociacion');
		$negociacion = $this->mdetallenegociacion->getDetalleNegociacion($idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($negociacion));
	}

	public function getNegociacionProyectoCliente()
	{
		$idcliente = $_POST['idcliente'];
    	
        if(isset($_POST['idproyecto']))
        {
        	$idproyecto=$_POST['idproyecto'];	
        }
        else
        {
        	$idproyecto=0;
        }

		$this->load->model('mnegociacion');
		$negociacion = $this->mnegociacion->getNegociacionesProyectoCliente($idcliente,$idproyecto);	
		//echo json_encode($negociacion);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($negociacion));
	}

	public function getMaxNegociacion()
	{
		$this->load->model('mnegociacion');
		$negociacion = $this->mnegociacion->getMaxNegociaciones();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($negociacion));
	}

	public function getDetallePago($idnegociacion=-1)
	{
		$this->load->model('mdetallepago');
		$negociacion = $this->mdetallepago->getDetallePago($idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($negociacion));
	}

	public function grabarNuevoPago()
    {	

    	$montoTotal = $_POST['monto'];
    	$idnegociacion=$_POST['idnegociacion'];
        $arreglo = $_POST['arreglo'];

        $this->load->model('mdetallepago');
        $datosdetallepago = $this->mdetallepago->getSaldo($idnegociacion);
        $saldo = $datosdetallepago->saldo;

        if($montoTotal <= $saldo) // si el monto a pagar no sobrepasa al saldo
        {
        	// Inserta el pago
		    $this->load->model('mpago');
			$inserto=$this->mpago->grabar($arreglo,$err);
	        if($inserto)
			{
				// si inserta bien el pago, actualiza las cuotas pagadas
				$this->load->model('mdetallepago');
				$datosdetallepago = $this->mdetallepago->getDetallePago($idnegociacion);

				// Recorre las cuotas
				foreach ($datosdetallepago as $detPago) {
					$moraporpagar = 0;
					$pagoporpagar = 0;

					// Si no sea a pagado completamente la cuota o tiene mora pendiente
					if($detPago->pagocalculado != $detPago->pagoefectuado || $detPago->moracalculada != $detPago->morapagada)
					{
						// Si tiene mora pendiente
						if ($detPago->moracalculada != $detPago->morapagada) {
							// Si el abono cubre el total de la mora, se paga el total de la mora, sino solo el monto del abono
							$moraporpagar = ($detPago->moracalculada - $detPago->morapagada > $montoTotal ? $montoTotal : $detPago->moracalculada - $detPago->morapagada) ;

							if($moraporpagar > 0){
								$err="";
								$siactualizo=$this->mdetallepago->modificar($idnegociacion,$detPago->nopago,
									    array(
										   'morapagada'=>round($moraporpagar + $detPago->morapagada,2),
										   // Auditoria
										   'ModificadoPor'=>$this->session->userdata('user_id'),
										   'FechaModificado'=>date("Y-m-d H:i:s")
									        ),$err);
								if ($siactualizo) {
									$montoTotal = round($montoTotal - $moraporpagar,2);
								}
							}
						}
						// Si la cuota pendiente
						if ($detPago->pagocalculado != $detPago->pagoefectuado) {
							// Si el abono cubre el total de la cuota, se paga el total de la cuota, sino solo el monto del abono
							$pagoporpagar = ($detPago->pagocalculado - $detPago->pagoefectuado > $montoTotal ? $montoTotal : $detPago->pagocalculado - $detPago->pagoefectuado);

							if($pagoporpagar > 0){
								$err="";
								$siactualizo=$this->mdetallepago->modificar($idnegociacion,$detPago->nopago,
									    array(
										   'pagoefectuado'=>round($pagoporpagar + $detPago->pagoefectuado,2),
										   // Auditoria
										   'ModificadoPor'=>$this->session->userdata('user_id'),
										   'FechaModificado'=>date("Y-m-d H:i:s")
									        ),$err);
								if ($siactualizo) {
									$montoTotal = round($montoTotal - $pagoporpagar,2);
								}
							}
						}
					}
				}

				echo "";
				//redirect('catalogos/producto/listado');
			}
			else
	        {
	            echo "Error al actualizar el pago";	
	        }
    	}
    	else
    	{
    		echo "El monto a pagar es mayor al saldo de la negociación";
    	}
	}


	//erick
	public function getNegociacionesProyectoClienteNoRS($idproyecto=-1,$idcliente=-1)
	{
		
		$this->load->model('mnegociacion');
		$negociacion = $this->mnegociacion->getNegociacionesProyectoClienteNoRS($idcliente,$idproyecto);	
		//echo json_encode($negociacion);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($negociacion));
	}

    //ess 04-05-2016
	public function otrosduenos($idnegociacion=-1)
	{
    	$method = $this->input->server('REQUEST_METHOD');
		$this->view_data['page_title']=  'Otros Dueños';
		$this->view_data['activo']=  'negociaciones';
		$this->view_data['idnegociacion']= $idnegociacion;
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->view('movimientos/negociaciones/otrosduenos',$this->view_data);
				break;
			case 'POST':
			    //echo $this->input->post('idnegociacion');
			    //echo $this->input->post('cliente');

				// Inserta otros dueños
				$this->load->model('mnegociacion');
				$inserto=$this->mnegociacion->grabarOtrosDuenos(array(
					   'idnegociacion'=>$this->input->post('idnegociacion'),
					   'idcliente'=>$this->input->post('cliente'),
					   'CreadoPor'=>$this->session->userdata('user_id'),
					   'FechaCreado'=>date("Y-m-d H:i:s"),
					   'ModificadoPor'=>$this->session->userdata('user_id'),
					   'FechaModificado'=>date("Y-m-d H:i:s")
					   ),$err);

				$this->view_data['idnegociacion']= $this->input->post('idnegociacion');;
				$this->load->view('movimientos/negociaciones/otrosduenos',$this->view_data);
				break;

		}

	}

	public function getCompradores($idnegociacion=-1)
	{
		
		$this->load->model('mnegociacion');
		$compradores = $this->mnegociacion->getCompradores($idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($compradores));
	}



    public function borrarComprador($idnegociacion=-1,$idcliente=-1)
 	{
 		
 		$this->load->model('mnegociacion');
		$sielimino=$this->mnegociacion->borrarComprador(array('idnegociacion'=>$idnegociacion,'idcliente'=>$idcliente),$err);
       	redirect('movimientos/negociacion/otrosduenos/'.$idnegociacion);
  
	}

    //enviar correo erick 01-05-2017
	function enviarMail($idnegociacion)
   	{
	   	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	   	$this->load->model('mnegociacion');
	   	$datosmail = $this->mnegociacion->getDatosEmail($idnegociacion);
	   	$datospago = "";
	   	$email = "";
	   	$hayDatos = false;
	   	$proyecto = 0;

	   	foreach ($datosmail as $datos) {
	   		$hayDatos = true;
	   		$email = $datos->email;
	   		$proyecto = $datos->idproyecto;

	   		switch ($proyecto) {
		   		case 1:
		   			$simboloMoneda = "$";
		   			break;
		   		case 5:
		   			$simboloMoneda = "Q";
		   			break;
		   		default:
		   			$simboloMoneda = "$";
		   			break;
		   	}

	   		$datospago .= $simboloMoneda.number_format(($simboloMoneda=="$" ? $datos->pagocalculado : round($datos->pagocalculado * 7.7,2)),2,".",",")." correspodiente al mes de ".$meses[intval(Date('m',strtotime($datos->fechalimitepago)))-1]." ".Date('Y',strtotime($datos->fechalimitepago)).", ";

	   	}

	   	if($hayDatos == false)
	   	{
	   		$this->edit($idnegociacion,"No existen pagos pendietes a la fecha","alert-danger");
	   	}

	   	if($email == "")
	   	{
	   		$this->edit($idnegociacion,"No existe correo electrónico configurado para envío de recordatorio","alert-danger");
	   	}

	   	if($hayDatos == true)
	   	{
		   	$emailReceptor=$email;
		   	$asunto="Recordatorio de pago";
		   	switch ($proyecto) {
		   		case 1:
		   			$cuentaDeposito = "en dólares: 270033640 a nombre de Herocha S.A.";
		   			break;
		   		case 5:
		   			$cuentaDeposito = "en quetzales: 270028996 a nombrbe de '13 avenida 11-55 zona 2, S.A.'";
		   			break;
		   		default:
		   			$cuentaDeposito = "en dólares: 270033640 a nombre de Herocha S.A.";
		   			break;
		   	}
		   	/*$mensaje=utf8_decode("Estimado cliente, le recordamos su pago de enganche de ".$datospago." agradecemos su colaboración para poder emitir el recibo
		   	          correspondiente, si usted ya realizó este pago, favor hacer caso omiso 
		   	          de este correo.
		   	         <br/><br/>
		   	          Cuenta No. 46-5001754-6 a nombre de Herocha S.A.");*/

		   	$mensaje="
<html>
<head>
  <title>Recordatorio de cumpleaños para Agosto</title>
</head>
<body>
	<table width='100%''>
		<tr>
			<th align='left'><IMG SRC='http://sistema.sursur.net/controlclientes/assets/img/logosur.jpg' WIDTH=60 HEIGHT=60 ALT='LogoSur'></th>
			<th align='right'><h2>Recordatorio de Pago</h2></th>
	    </tr>
	</table>
	<hr size=1 />
	<p>
		Estimado Cliente,
		<br/><br/>
		Le recordamos que su pago de enganche de ".$datospago." agradecemos su colaboración para poder emitir el recibo correspondiente.
		<br/><br/>
		Banco Industrial
		<br/>
		Cuenta ".$cuentaDeposito."
	</p>
	<hr size=1 />
	<p>
		Si usted ya realizó este pago, favor hacer caso omiso de este correo.
	</p>
</body>
</html>
";
			$this->load->library("email");

			//configuracion para gmail
			$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'infosursur@gmail.com',
			'smtp_pass' => 'desarrolladorasur',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
			);    

			//cargamos la configuración para enviar con gmail
			$this->email->initialize($configGmail);




			$this->email->from('infosursur@gmail.com');
			$this->email->to($emailReceptor);
			$this->email->subject($asunto);
			$this->email->message($mensaje);
			$this->email->send();
		}

		$this->edit($idnegociacion,"Recordatorio enviado con exito!!","alert-success");
		
	}


	public function aprobarNegociacion($idnegociacion=-1)
 	{
 		
 		$this->load->model('mdocumentos_negociacion');
		$documentospendientes=$this->mdocumentos_negociacion->obtenerDocsPendientes($idnegociacion);

		$err="";
		$codigoCliente = 0;
		if($documentospendientes->docpendientes > 0) {
			redirect('movimientos/negociacion/edit/'.$idnegociacion.'/Debe_completar_la_documentacion/alert-danger');
		}
		else if($documentospendientes->docpendientes == 0) {
			$this->load->model('mnegociacion');
			$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);

			// si el cliente es temporal
		    $this->load->model('mcliente');
		    if($datosnegociacion->idcliente == 0) {
    			$datoscliente = $this->mcliente->getClienteTemporal($idnegociacion);

    			$inserto=$this->mcliente->grabar(array(
						   'nombre'=>$datoscliente->nombre,
						   'apellido'=>$datoscliente->apellido,
						   'idtipoidentificacion'=>$datoscliente->idtipoidentificacion,
						   'dpi'=>$datoscliente->dpi,
						   'fecnacimiento'=>$datoscliente->fecnacimiento,
						   'profesion'=>$datoscliente->profesion,
						   'nacionalidad'=>$datoscliente->nacionalidad,
						   'estadocivil'=>$datoscliente->estadocivil,
						   'dirresidencia'=>$datoscliente->dirresidencia,
						   'telefono'=>$datoscliente->telefono,
						   'celular'=>$datoscliente->celular,
						   'nit'=>$datoscliente->nit,
						   'email'=>$datoscliente->correo,
						   'lugartrabajo'=>$datoscliente->lugartrabajo,
						   'dirtrabajo'=>$datoscliente->dirtrabajo,
						   'tiempolabor'=>$datoscliente->tiempolabor,
						   'ingresos'=>$datoscliente->ingresos,
						   'puesto'=>$datoscliente->puesto,
						   'otrosingresos'=>$datoscliente->otrosingresos,
						   'concepto'=>$datoscliente->concepto,
						   //Auditoria
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err2);
    			if($inserto) {
    				$ultimoCliente = $this->mcliente->getUltimoCliente();
    				$codigoCliente = $ultimoCliente->idcliente;
    			}
    			else {

    				$err = $err2;
    			}
    		}
    		else {
    			$codigoCliente = $datosnegociacion->idcliente;
    		}
    		$siactualizo = false;
    		if($err == "" && $codigoCliente != 0)
    		{
    		// actualiza el status
			$siactualizo=$this->mnegociacion->modificar($idnegociacion,
				    array(
				    	'status'=>'AP',
				    	'idcliente'=>$codigoCliente,
					   	// Auditoria
					   	'ModificadoPor'=>$this->session->userdata('user_id'),
					   	'FechaModificado'=>date("Y-m-d H:i:s")
				        ),$err);
			}
			if($siactualizo) {
				redirect('movimientos/negociacion/edit/'.$idnegociacion.'/APROBADA/alert-success');
			} 
			else {
				redirect('movimientos/negociacion/edit/'.$idnegociacion.'/'.str_replace(' ', '_', $err).'/alert-danger');
			}

       	}	
  
	}

}