<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pagosaporte extends MY_Controller
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

	public function listado($idaporte=-1)
	{
		$this->load->model('maporte');
		$datosaporte = $this->maporte->getAporteId($idaporte);
		$this->view_data['datosaporte']=$datosaporte;

		$this->view_data['page_title']=  'Pagos de inversion';
		$this->view_data['activo']=  'aporte';
		$this->view_data['idaporte']= $idaporte;
		$this->load_partials();
		$this->load->view('movimientos/pagosaporte/listado',$this->view_data);
	}
	

	public function getPagos($idaporte=-1)
	{
		$this->load->model('mpagoaporte');
		$aporte = $this->mpagoaporte->getPagos($idaporte);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($aporte));
	}
	
}