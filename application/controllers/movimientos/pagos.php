<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pagos extends MY_Controller
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

	public function listado($idnegociacion=-1)
	{
		$this->load->model('mnegociacion');
		$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
		$this->view_data['datosnegociacion']=$datosnegociacion;

		$this->view_data['page_title']=  'Pagos';
		$this->view_data['activo']=  'clientes';
		$this->view_data['idnegociacion']= $idnegociacion;
		$this->load_partials();
		$this->load->view('movimientos/pagos/listado',$this->view_data);
	}

	public function anular($idnegociacion=-1,$idcorrelativo=-1)
	{
		// Obtiene la ultima cuota cancelada
		$this->load->model('mdetallepago');
		$datosdetallepago = $this->mdetallepago->getCantidadPagosEfectuadosAn($idnegociacion);
		$pagosefectuados = $datosdetallepago->pagosefectuados;

		// Obtiene el registro del pago anulado
		$this->load->model('mpago');
		$datospago = $this->mpago->getPagoId($idnegociacion,$idcorrelativo);
		$totalpago = $datospago->monto;

		if($pagosefectuados > 0)
		{
			do
			{
				$montocalc = 0;

				$this->load->model('mdetallepago');
				$datosdetallepago = $this->mdetallepago->getDetalleNoPago($idnegociacion,$pagosefectuados);

				if($datosdetallepago->pagoefectuado > $totalpago){
					$montocalc = $totalpago;
				}
				else{
					$montocalc = $datosdetallepago->pagoefectuado;
				}

				// actualiza

				$siactualizo=$this->mdetallepago->modificar($idnegociacion,$pagosefectuados,
										    array(
											   'pagoefectuado'=>$datosdetallepago->pagoefectuado - $montocalc,
											   // Auditoria
											   'ModificadoPor'=>$this->session->userdata('user_id'),
											   'FechaModificado'=>date("Y-m-d H:i:s")
										        ),$err);

				if($siactualizo){
					$totalpago = $totalpago - $montocalc;
				}

				if($totalpago > 0 && $datosdetallepago->morapagada > 0)
				{
					$montocalc = 0;

					if($datosdetallepago->morapagada > $totalpago){
						$montocalc = $totalpago;
					}
					else{
						$montocalc = $datosdetallepago->morapagada;
					}

					// actualiza
					$siactualizo=$this->mdetallepago->modificar($idnegociacion,$pagosefectuados,
										    array(
											   'morapagada'=>$datosdetallepago->morapagada - $montocalc,
											   // Auditoria
											   'ModificadoPor'=>$this->session->userdata('user_id'),
											   'FechaModificado'=>date("Y-m-d H:i:s")
										        ),$err);

					if($siactualizo){
						$totalpago = $totalpago - $montocalc;
					}
				}

				$pagosefectuados = $pagosefectuados -1;
			}while ($totalpago > 0);

			$this->load->model('mnegociacion');
			$datosnegociacion=$this->mnegociacion->getNegociacionId($idnegociacion);

			$siactualizo=$this->mpago->modificar($idnegociacion,$idcorrelativo,
									array(
										'status'=>'AN',
										// Auditoria
									   'ModificadoPor'=>$this->session->userdata('user_id'),
									   'FechaModificado'=>date("Y-m-d H:i:s")
										),$err);

			if($siactualizo){
				redirect('movimientos/negociacion/listado/'.$datosnegociacion->idcliente);
			}
		}
		else
		{
			$err="";
			$this->load->model('mnegociacion');
			$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
			$this->view_data['datosnegociacion']=$datosnegociacion;

			$this->view_data['page_title']=  'Pagos';
			$this->view_data['activo']=  'clientes';
			$this->view_data['idnegociacion']= $idnegociacion;
			$this->load_partials();
			
			$this->view_data['mensaje']="Error: No se pudo anular el registro ".$err;
        	$this->view_data['tipoAlerta']="alert-danger";
        	$this->load->view('movimientos/pagos/listado',$this->view_data);
		}
	}

	public function getPagos($idnegociacion=-1)
	{
		$this->load->model('mpago');
		$pago = $this->mpago->getPagos($idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($pago));
	}
	
}