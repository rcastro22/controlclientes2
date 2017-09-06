<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aporte extends MY_Controller
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
			$this->view_data['usuario']= $this->session->userdata('user_id');
		}

	}

	public function listado($idcliente=-1)
	{
		$this->view_data['page_title']=  'Aportes';
		$this->view_data['activo']=  'aporte';
		$this->load_partials();
		$this->load->view('movimientos/aportes/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de aportes';
    	$this->view_data['activo']=  'aporte';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$datosaporte = new stdClass();
				$this->view_data['datosaporte']=$datosaporte;

				$datosaporte->idproyecto=$this->input->post('proyectos');
				$datosaporte->idinversionista=$this->input->post('inversionista');
				$datosaporte->fecha=$this->input->post('fecha');
				$datosaporte->periodomeses=$this->input->post('periodomeses');
				$datosaporte->monto=$this->input->post('monto');
				$datosaporte->interes=$this->input->post('interes');
				$datosaporte->formapagomeses=$this->input->post('formapagomeses');				

				$this->load->view('movimientos/aportes/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton				
				// falta validaciones para combos
				$this->form_validation->set_rules('proyectos','Proyectos');
				$this->form_validation->set_rules('inversionista','inversionista');

				$this->form_validation->set_rules('fecha','Fecha','required');
				$this->form_validation->set_rules('periodomeses','Periodo','required|integer');
				$this->form_validation->set_rules('monto','Monto','required|numeric');
				$this->form_validation->set_rules('interes','Interes','required|numeric');
				$this->form_validation->set_rules('formapagomeses','Forma de pago','required|integer');
				//Falta validacion para asesor
				
				if($this->form_validation->run()==FALSE)
				{
					$datosaporte = new stdClass();	

					$datosaporte->idproyecto=$this->input->post('proyectos');
					$datosaporte->idinversionista=$this->input->post('inversionista');
					$datosaporte->fecha=$this->input->post('fecha');
					$datosaporte->periodomeses=$this->input->post('periodomeses');
					$datosaporte->monto=$this->input->post('monto');
					$datosaporte->interes=$this->input->post('interes');
					$datosaporte->formapagomeses=$this->input->post('formapagomeses');

					$this->view_data['datosaporte']=$datosaporte;				
					$this->load->view('movimientos/aportes/nuevo',$this->view_data);
				}
				else 	// SI la validacion fue correcta
				{					
					$datosaporte = new stdClass();	

					$datosaporte->idproyecto=$this->input->post('proyectos');
					$datosaporte->idinversionista=$this->input->post('inversionista');
					$datosaporte->fecha=$this->input->post('fecha');
					$datosaporte->periodomeses=$this->input->post('periodomeses');
					$datosaporte->monto=$this->input->post('monto');
					$datosaporte->interes=$this->input->post('interes');
					$datosaporte->formapagomeses=$this->input->post('formapagomeses');

					$this->view_data['datosaporte']=$datosaporte;				

					$lineas = round($this->input->post('periodomeses')/$this->input->post('formapagomeses'),0,PHP_ROUND_HALF_DOWN);

					$err="";

					if($this->input->post('formapagomeses') > $this->input->post('periodomeses'))	
					{
						$err = "La forma de pago no puede ser mayor al numero de periodos";
					}

					if($err=="")
					{
						// Inserta la negociacion
						$this->load->model('maporte');
						$inserto=$this->maporte->grabar(array(
							   'idproyecto'=>$this->input->post('proyectos'),
							   'idinversionista'=>$this->input->post('inversionista'),
							   'fecha'=>date('Y-m-d',strtotime($this->input->post('fecha'))),
							   'periodomeses'=>$this->input->post('periodomeses'),							   
							   'monto'=>$this->input->post('monto'),
							   'montopendiente'=>$this->input->post('monto'),
							   'interes'=>$this->input->post('interes'),
							   'formapagomeses'=>$this->input->post('formapagomeses'),							   
							   //Auditoria
							   /*'CreadoPor'=>$this->session->userdata('user_id'),
							   'FechaCreado'=>date("Y-m-d H:i:s"),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")*/
							   ),$err);
	              		if($inserto)
						{
							// Inserta las cuotas
							$this->load->model('maporte');
							$datosAporteMax = $this->maporte->getMaxAporte();
							$fecha = strtotime($this->input->post('fecha'));
							//Inserta detalle de pago de inversionistas
							$lineas = round($this->input->post('periodomeses')/$this->input->post('formapagomeses'),0,PHP_ROUND_HALF_DOWN);

							//Variables fijas
							$periodo = round($this->input->post('periodomeses'),2);
							$formapago = round($this->input->post('formapagomeses'),2);
							$capital = round($this->input->post('monto'),2);
							$porcentInteresAnual = round($this->input->post('interes'),2);
							$porcentInteresMensual = ($porcentInteresAnual/(12/$formapago))/100;

							//Variables calculadas
							//$interesCalculado = round(($capital * (($porcentInteresAnual / 100) / 12)) * ($lineas),2);
							$interesCalculado = round((($capital * ($porcentInteresAnual / 100) * $this->input->post('periodomeses')) / 12) / $lineas,2);

							// Inserto los datos
							for($x=1;$x<=$lineas;$x++)
							{
								$this->load->model('mdetallepagoinversion');
								$inserto2=$this->mdetallepagoinversion->grabar(array(
									   'idaporte'=>$datosAporteMax->maximo,
									   'nopago'=>$x,
									   'fechapago'=>date('Y-m-d',$fecha),
									   'pagocalculado'=>$interesCalculado,
									   'pagoefectuado'=>0,
									   //Auditoria
									   'CreadoPor'=>$this->session->userdata('user_id'),
									   'FechaCreado'=>date("Y-m-d H:i:s"),
									   'ModificadoPor'=>$this->session->userdata('user_id'),
									   'FechaModificado'=>date("Y-m-d H:i:s")
									   ),$err);

								$fecha = strtotime('+'.$formapago.' month',$fecha);
							}					

							redirect('movimientos/aporte/listado/');
						}
						else
	                    {
	                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/aportes/nuevo',$this->view_data);
	                    }
	                }
                	else
                	{
            			$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('movimientos/aportes/nuevo',$this->view_data);
                	}
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idaporte=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de aportes';
    	$this->view_data['activo']=  'aporte';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('maporte');
				$datosaporte = $this->maporte->getAporteId($idaporte);
        		$this->view_data['datosaporte']=$datosaporte;
				$this->load->view('movimientos/aportes/edit',$this->view_data);
				break;
			case 'POST':
				// falta validaciones para combos
				$this->form_validation->set_rules('proyectos','Proyectos');
				$this->form_validation->set_rules('inversionista','inversionista');

				$this->form_validation->set_rules('fecha','Fecha','required');
				$this->form_validation->set_rules('periodomeses','Periodo','required|integer');
				$this->form_validation->set_rules('monto','Monto','required|numeric');
				$this->form_validation->set_rules('montopendiente','Saldo capital','required|numeric');
				$this->form_validation->set_rules('interes','Interes','required|numeric');
				$this->form_validation->set_rules('formapagomeses','Forma de pago','required|integer');

				if($this->form_validation->run()==FALSE)
				{
					$datosaporte = new stdClass();	

					$datosaporte->idaporte=$this->input->post('idaporte');
					$datosaporte->idproyecto=$this->input->post('proyectos');
					$datosaporte->idinversionista=$this->input->post('inversionista');
					$datosaporte->fecha=$this->input->post('fecha');
					$datosaporte->periodomeses=$this->input->post('periodomeses');
					$datosaporte->monto=$this->input->post('monto');
					$datosaporte->montopendiente=$this->input->post('montopendiente');
					$datosaporte->interes=$this->input->post('interes');
					$datosaporte->formapagomeses=$this->input->post('formapagomeses');

					$this->view_data['datosaporte']=$datosaporte;				
					$this->load->view('movimientos/aportes/nuevo',$this->view_data);
				}
				else
				{
					$datosaporte = new stdClass();	

					$datosaporte->idaporte=$this->input->post('idaporte');
					$datosaporte->idproyecto=$this->input->post('proyectos');
					$datosaporte->idinversionista=$this->input->post('inversionista');
					$datosaporte->fecha=$this->input->post('fecha');
					$datosaporte->periodomeses=$this->input->post('periodomeses');
					$datosaporte->monto=$this->input->post('monto');
					$datosaporte->montopendiente=$this->input->post('montopendiente');
					$datosaporte->interes=$this->input->post('interes');
					$datosaporte->formapagomeses=$this->input->post('formapagomeses');

					$this->view_data['datosaporte']=$datosaporte;

					$this->load->model('mdetallepagoinversion');
					$datosdetallepagoinversion = $this->mdetallepagoinversion->getCantidadPagosEfectuados($this->input->post('idaporte'));
					$pagosefectuados = $datosdetallepagoinversion->pagosefectuados;
					$lineas = round($this->input->post('periodomeses')/$this->input->post('formapagomeses'),0,PHP_ROUND_HALF_DOWN);

					$err="";
					if($lineas < $pagosefectuados)	
					{
						$err = "El número de cuotas no puede ser menor a la cantidad de pagos efectuados";
					}

					if($this->input->post('formapagomeses') > $this->input->post('periodomeses'))	
					{
						$err = "La forma de pago no puede ser mayor al numero de periodos";
					}

					if($err=="")
					{

						$this->load->model('maporte');
						$err="";
						$siactualizo=$this->maporte->modificar($this->input->post('idaporte'),
							    array(
							    	'idproyecto'=>$this->input->post('proyectos'),
								   'idinversionista'=>$this->input->post('inversionista'),
								   'fecha'=>date('Y-m-d',strtotime($this->input->post('fecha'))),
								   'periodomeses'=>$this->input->post('periodomeses'),							   
								   'monto'=>$this->input->post('monto'),
								   'montopendiente'=>$this->input->post('monto'),
								   'interes'=>$this->input->post('interes'),
								   'formapagomeses'=>$this->input->post('formapagomeses'),
								   // Auditoria
								   //'ModificadoPor'=>$this->session->userdata('user_id'),
								   //'FechaModificado'=>date("Y-m-d H:i:s")
							        ),$err);
	                    
	                    
	                    if ($siactualizo)
	                    {	                    	
							$this->load->model('maporte');
							// Obtiene el Id del aporte
							$idaporte = $this->input->post('idaporte');
							// Calcula la cantidad de lineas a insertar
							$lineas = round($this->input->post('periodomeses')/$this->input->post('formapagomeses'),0,PHP_ROUND_HALF_DOWN);

							// Si el numero de cuotas es mayor a los pagos efectuados
	                    	if($lineas > $pagosefectuados)
	                    	{	                    		
								//Variables fijas
								$periodo = round($this->input->post('periodomeses'),2);
								$formapago = round($this->input->post('formapagomeses'),2);
								$capital = round($this->input->post('monto'),2);
								$porcentInteresAnual = round($this->input->post('interes'),2);
								//$porcentInteresMensual = ($porcentInteresAnual/(12/$formapago))/100;

								// obtener la ultima fecha
								$nopag = 0;
								if($pagosefectuados == 0) {
									$fecha = strtotime($this->input->post('fecha'));
								}
								else {
									$nopag = $pagosefectuados;
									$datosdetpaginversionid = $this->mdetallepagoinversion->getDetallePagoInversionId($this->input->post('idaporte'),$nopag);
									foreach ($datosdetpaginversionid as $paginversionid) 
									
									if(is_null($paginversionid->fechapago)){
										$fecha = strtotime($this->input->post('fecha'));	
									}
									else {
										$fecha = strtotime($paginversionid->fechapago);
										$fecha = strtotime('+'.$formapago.' month',$fecha);	
									}							
								}


								// Obtengo el monto total pagado
								$datosdetallepagoinversion = $this->mdetallepagoinversion->getMontoCalculadoPagado($this->input->post('idaporte'));
								// Obtengo el saldo del capital
								$saldocapital = $this->input->post('montopendiente');
								// Calculo el nuevo monto: Saldo dividido las cuotas totales menos las cuotas pagadas
								//$interesCalculado = round(($saldocapital * (($porcentInteresAnual / 100) / 12)) * ($lineas - $pagosefectuados),2);
								$interesCalculado = round((($saldocapital * ($porcentInteresAnual / 100) * $this->input->post('periodomeses')) / 12) / ($lineas - $pagosefectuados),2);

								// Borro los pagos que no has sido pagados
								$this->mdetallepagoinversion->borrar($this->input->post('idaporte'),$pagosefectuados+1,$err);
								
								// Inserto los nuevos pagos
								for($x=$pagosefectuados+1;$x<=$lineas;$x++)
								{
									$this->load->model('mdetallepagoinversion');
									$inserto2=$this->mdetallepagoinversion->grabar(array(
										   'idaporte'=>$idaporte,
										   'nopago'=>$x,
										   'fechapago'=>date('Y-m-d',$fecha),
										   'pagocalculado'=>$interesCalculado,
										   'pagoefectuado'=>0,
										   //Auditoria
										   'CreadoPor'=>$this->session->userdata('user_id'),
										   'FechaCreado'=>date("Y-m-d H:i:s"),
										   'ModificadoPor'=>$this->session->userdata('user_id'),
										   'FechaModificado'=>date("Y-m-d H:i:s")
										   ),$err);

									$fecha = strtotime('+'.$formapago.' month',$fecha);
								}
							}
	                    	
	                    	redirect('movimientos/aporte/listado/');
	                    }
	                    else
	                    {
	                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/aportes/edit',$this->view_data);
	                    }
                	}
                	else
                	{
                			$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/aportes/edit',$this->view_data);
                	}
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


    //public function index($page=1)
	public function getAporte($idproyecto=-1)
	{
		$this->load->model('maporte');
		$aporte = $this->maporte->getAportes($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($aporte));
	}

	public function getDetallePagoInversion($idaporte=-1)
	{
		$this->load->model('mdetallepagoinversion');
		$aporte = $this->mdetallepagoinversion->getDetallePagoInversion($idaporte);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($aporte));
	}


    public function pago($idaporte=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Realizar pago';
    	$this->view_data['activo']=  'aporte';
		$this->load_partials();
		$this->load->model('maporte');
		$datosaporte = $this->maporte->getAporteId($idaporte);
		$this->view_data['datosaporte']=$datosaporte;
		$this->load->view('movimientos/aportes/pago',$this->view_data);
    }


	public function grabarNuevoPago()
    {	

    	$montoTotal = $_POST['monto'];
    	$idaporte=$_POST['idaporte'];
    	$tipopago=$_POST['tipopago'];
        $arreglo = $_POST['arreglo'];

        if($tipopago == "interes")
        {
	        $this->load->model('mdetallepagoinversion');
	        $datosaporte = $this->mdetallepagoinversion->getSaldo($idaporte);
	        $saldo = $datosaporte->saldo;

	        if($montoTotal <= $saldo) // si el monto a pagar no sobrepasa al saldo
	        {
	        	// Inserta el pago
			    $this->load->model('mpagoaporte');
				$inserto=$this->mpagoaporte->grabar($arreglo,"IN",$err);
		        if($inserto)
				{
					// si inserta bien el pago, actualiza las cuotas pagadas
					$this->load->model('mdetallepagoinversion');
					$datosaporte = $this->mdetallepagoinversion->getDetallePagoInversion($idaporte);

					// Recorre las cuotas
					foreach ($datosaporte as $detPago) {
						$moraporpagar = 0;
						$pagoporpagar = 0;

						// Si no sea a pagado completamente la cuota
						if($detPago->pagocalculado != $detPago->pagoefectuado)
						{						

								// Si el abono cubre el total de la cuota, se paga el total de la cuota, sino solo el monto del abono
								$pagoporpagar = ($detPago->pagocalculado - $detPago->pagoefectuado > $montoTotal ? $montoTotal : $detPago->pagocalculado - $detPago->pagoefectuado);

								if($pagoporpagar > 0){
									$err="";
									$siactualizo=$this->mdetallepagoinversion->modificar($idaporte,$detPago->nopago,
										    array(
											   'pagoefectuado'=>$pagoporpagar + $detPago->pagoefectuado,
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
	    else if($tipopago == "capital")
	    {
	    	// Obtengo los datos del aporte
	    	$this->load->model('maporte');
			$datosaporte = $this->maporte->getAporteId($idaporte);
			// Obtengo el saldo del capital
			$saldocapital = $datosaporte->montopendiente - $montoTotal;
			// Calculo el nuevo saldo del capital
			$this->maporte->modificar($idaporte,
			    array('montopendiente'=>$saldocapital),$err);
			// Inserto el pago efectuado
			$this->load->model('mpagoaporte');
				$inserto=$this->mpagoaporte->grabar($arreglo,"CP",$err);

			// Recalcular cuotas de interes
			$datosaporte = $this->maporte->getAporteId($idaporte);			

			$this->load->model('mdetallepagoinversion');
			$datosdetallepagoinversion = $this->mdetallepagoinversion->getCantidadPagosEfectuados($this->input->post('idaporte'));
			$pagosefectuados = $datosdetallepagoinversion->pagosefectuados;
			$lineas = round($datosaporte->periodomeses/$datosaporte->formapagomeses,0,PHP_ROUND_HALF_DOWN);

			$datosdetallepagoinversion = $this->mdetallepagoinversion->getMontoCalculadoPagado($idaporte);
			$saldocapital = $datosaporte->montopendiente;
			//$interesCalculado = round(($saldocapital * (($datosaporte->interes / 100) / 12)) * ($lineas - $pagosefectuados),2);
			$interesCalculado = round((($saldocapital * ($datosaporte->interes / 100) * $datosaporte->periodomeses) / 12) / ($lineas - $pagosefectuados),2);

			// obtener la ultima fecha
			$nopag = 0;
			if($pagosefectuados == 0) {
				$fecha = strtotime($datosaporte->fecha);
			}
			else {
				$nopag = $pagosefectuados;
				$datosdetpaginversionid = $this->mdetallepagoinversion->getDetallePagoInversionId($idaporte,$nopag);
				foreach ($datosdetpaginversionid as $paginversionid) 
				if(is_null($paginversionid->fechapago)){
					$fecha = strtotime($datosaporte->fecha);	
				}
				else {
					$fecha = strtotime($paginversionid->fechapago);
					$fecha = strtotime('+'.$datosaporte->formapagomeses.' month',$fecha);	
				}	
			}

			// Borro los pagos que no has sido pagados
			$this->mdetallepagoinversion->borrar($idaporte,$pagosefectuados+1,$err);
			
			// Inserto los nuevos pagos
			for($x=$pagosefectuados+1;$x<=$lineas;$x++)
			{
				$this->load->model('mdetallepagoinversion');
				$inserto2=$this->mdetallepagoinversion->grabar(array(
					   'idaporte'=>$idaporte,
					   'nopago'=>$x,
					   'fechapago'=>date('Y-m-d',$fecha),
					   'pagocalculado'=>$interesCalculado,
					   'pagoefectuado'=>0,
					   //Auditoria
					   'CreadoPor'=>$this->session->userdata('user_id'),
					   'FechaCreado'=>date("Y-m-d H:i:s"),
					   'ModificadoPor'=>$this->session->userdata('user_id'),
					   'FechaModificado'=>date("Y-m-d H:i:s")
					   ),$err);

				$fecha = strtotime('+'.$datosaporte->formapagomeses.' month',$fecha);
			}


	    }
	}


	public function borrar($idnegociacion=-1)
 	{
 		$this->load->model('mnegociacion');
		$sielimino=$this->mnegociacion->borrar($idnegociacion,$err);
        

		if ($sielimino)
        {
        	$this->load->model('mnegociacion');
			$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
        	redirect('movimientos/negociacion/listado/'.$datosnegociacion->idcliente);
        }
        else
        {
        	$this->view_data['page_title']=  'Negociaciones';
    		$this->view_data['activo']= 'clientes';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('movimientos/clientes/listado',$this->view_data);
        }
	}

	//erick
	public function getAportesProyectoInversionistaNoRS($idproyecto=-1,$idinversionista=-1)
	{
		
		$this->load->model('maporte');
		$aporte = $this->maporte->getAportesProyectoInversionistaNoRS($idinversionista,$idproyecto);	
		//echo json_encode($aporte);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($aporte));
	}	

}