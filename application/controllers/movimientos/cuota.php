<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cuota extends MY_Controller
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

	}

	public function listado($idnegociacion=-1)
	{
		$this->load->model('mdetallepago');
		$datosdetallepago = $this->mdetallepago->getCuotas($idnegociacion);
		$monto = $datosdetallepago->saldo + $this->input->post("pagocalculado");
		//$saldo = $datosdetallepago->saldo + $this->input->post("pagocalculado");
		/*$this->load->model('mdetfactura');
    	$datosdetfactura = $this->mdetfactura->getTotalFactura($idfactura);
    	$monto = $datosdetfactura->monto;*/

		$this->view_data['page_title']=  'Cuotas';
		$this->view_data['activo']=  'negociaciones';
		$this->view_data['idnegociacion']= $idnegociacion;
		$this->view_data['montototal']= $monto;
		$this->load_partials();
		$this->load->view('movimientos/cuota/listado',$this->view_data);
	}
    
    public function nuevo($idnegociacion=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de cuota';
    	$this->view_data['activo']=  'negociaciones';
    	$this->view_data['idnegociacion']= $idnegociacion;
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$datoscuota = new stdClass();
				$this->view_data['datoscuota']=$datoscuota;

				$datoscuota->fechalimitepago=$this->input->post('fechalimitepago');
				$datoscuota->pagocalculado=$this->input->post('pagocalculado');
				$datoscuota->moracalculada=$this->input->post('moracalculada');		

				$this->load->view('movimientos/cuota/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				// falta validaciones para combos
				$this->form_validation->set_rules('fechalimitepago','Fecha pago');

				$this->form_validation->set_rules('pagocalculado','Cuota calculada','required|numeric');
				$this->form_validation->set_rules('moracalculada','Mora calculada','numeric');			
				
				if($this->form_validation->run()==FALSE)
				{
					$datoscuota = new stdClass();	

					$datoscuota->fechalimitepago=$this->input->post('fechalimitepago');
					$datoscuota->pagocalculado=$this->input->post('pagocalculado');
					$datoscuota->moracalculada=$this->input->post('moracalculada');			

					$this->view_data['datoscuota']=$datoscuota;
					$this->load->view('movimientos/cuota/nuevo',$this->view_data);
				}
				else
				{
					$datoscuota = new stdClass();	

					$datoscuota->fechalimitepago=$this->input->post('fechalimitepago');
					$datoscuota->pagocalculado=$this->input->post('pagocalculado');
					$datoscuota->moracalculada=$this->input->post('moracalculada');
					$this->view_data['datoscuota']=$datoscuota;

					$err="";
					$this->load->model('mdetallepago');
					$datosdetallepago = $this->mdetallepago->getCuotas($idnegociacion);
					$saldo = round($datosdetallepago->saldo + $this->input->post("pagocalculado"),2);					

					$this->load->model('mnegociacion');
					$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
					$saldoenganche = round($datosnegociacion->saldoenganche,2);
					

					if($saldo > $saldoenganche){
						$err = "La suma de montos de las cuotas no puede ser mayor al saldo de enganche";
					}

					if($err=="")
					{
						$this->load->model('mdetallepago');
						$datosdetallepago = $this->mdetallepago->getCantidadPagos($idnegociacion);
						$pagos = $datosdetallepago->pagos;

						$this->load->model('mdetallepago');
						$inserto=$this->mdetallepago->grabar(array(
							   'idnegociacion'=>$idnegociacion,
							   'nopago'=>$pagos+1,
							   'fechalimitepago'=>date('Y-m-d',strtotime($this->input->post('fechalimitepago'))),
							   'pagocalculado'=>$this->input->post('pagocalculado'),
							   'pagoefectuado'=>0,
							   'moracalculada'=>$this->input->post('moracalculada'),
							   //'moracalculada'=>$saldo,
							   'morapagada'=>0,
							   //Auditoria
							   'CreadoPor'=>$this->session->userdata('user_id'),
							   'FechaCreado'=>date("Y-m-d H:i:s"),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
							   ),$err);

	              		if($inserto)
						{
							redirect('movimientos/cuota/listado/'.$idnegociacion);
						}
						else
	                    {
	                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/cuota/nuevo',$this->view_data);
	                    }
	                }
                	else
                	{
                			$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/cuota/nuevo',$this->view_data);
                	}
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idnegociacion=-1,$nopago=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de cuota';
    	$this->view_data['activo']=  'negociaciones';
    	$this->view_data['idnegociacion'] =$idnegociacion;
    	$this->view_data['nopagos'] = $nopago;
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('mdetallepago');
				$datoscuota = $this->mdetallepago->getDetalleNoPago($idnegociacion,$nopago);
        		$this->view_data['datoscuota']=$datoscuota;
				$this->load->view('movimientos/cuota/edit',$this->view_data);
				break;
			case 'POST':
				// falta validaciones para combos
				$this->form_validation->set_rules('fechalimitepago','Fecha pago');

				$this->form_validation->set_rules('pagocalculado','Cuota calculada','required|numeric');
				$this->form_validation->set_rules('moracalculada','Mora calculada','numeric');	
				if($this->form_validation->run()==FALSE)
				{
					$datoscuota = new stdClass();					
					$datoscuota->nopago=$this->input->post("nopago");
					$datoscuota->fechalimitepago=$this->input->post('fechalimitepago');
					$datoscuota->pagocalculado=$this->input->post('pagocalculado');
					$datoscuota->moracalculada=$this->input->post('moracalculada');	
					$this->view_data['datoscuota']=$datoscuota;
					$this->load->view('movimientos/cuota/edit',$this->view_data);
				}
				else
				{
					$datoscuota = new stdClass();		
                    $datoscuota->nopago=$this->input->post("nopago");
					$datoscuota->fechalimitepago=$this->input->post('fechalimitepago');
					$datoscuota->pagocalculado=$this->input->post('pagocalculado');
					$datoscuota->moracalculada=$this->input->post('moracalculada');	
					$this->view_data['datoscuota']=$datoscuota;					

					$err="";
					$this->load->model('mdetallepago');
					$datosdetallepago = $this->mdetallepago->getCuotas2($idnegociacion,$nopago);
					$saldo = round($datosdetallepago->saldo + $this->input->post("pagocalculado"),2);					

					$this->load->model('mnegociacion');
					$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
					$saldoenganche = round($datosnegociacion->saldoenganche,2);

					if($saldo > $saldoenganche){
						$err = "La suma de montos de las cuotas no puede ser mayor al saldo de enganche";
					}
					if($err=="")
					{
						$this->load->model('mdetallepago');
						$err="";
						$siactualizo=$this->mdetallepago->modificar($idnegociacion,$nopago,
							    array(
								   'fechalimitepago'=>date('Y-m-d',strtotime($this->input->post('fechalimitepago'))),
								   'pagocalculado'=>$this->input->post('pagocalculado'),
								   'moracalculada'=>$this->input->post('moracalculada'),
								   // Auditoria
								   'ModificadoPor'=>$this->session->userdata('user_id'),
								   'FechaModificado'=>date("Y-m-d H:i:s")
							        ),$err);
	                    
	                    
	                    if ($siactualizo)
	                    {	                    	
	                    	redirect('movimientos/cuota/listado/'.$idnegociacion);
	                    }
	                    else
	                    {
	                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/cuota/edit',$this->view_data);
	                    }
                	}
                	else
                	{
                			$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('movimientos/cuota/edit',$this->view_data);
                	}
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($idnegociacion=-1)
 	{
 		$this->load->model('mdetallepago');
		$datosdetallepago = $this->mdetallepago->getCantidadPagos($idnegociacion);
		$pagos = $datosdetallepago->pagos;

		$sielimino=$this->mdetallepago->borrar($idnegociacion,$pagos,$err);
        

		if ($sielimino)
        {
        	$this->load->model('mnegociacion');
			$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
        	redirect('movimientos/cuota/listado/'.$idnegociacion);
        }
        else
        {
        	$this->view_data['page_title']=  'Cuotas';
    		$this->view_data['activo']= 'clientes';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('movimientos/cuota/listado',$this->view_data);
        }
	}
	
}