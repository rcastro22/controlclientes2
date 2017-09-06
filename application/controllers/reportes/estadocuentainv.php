<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class estadocuentainv extends MY_Controller
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

	public function repEstadoCuentaInv()
	{
		$this->view_data['page_title']=  'Estado de Cuenta Inversionista';
		$this->view_data['activo']=  'estadocuenta';
		$this->load_partials();
		$this->load->view('reportes/estadocuentainv',$this->view_data);
	}

	//public function index($page=1)
	public function getPagosRealizadosInv($idproyecto=-1,$idinversionista=-1,$idaporte=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getPagosRealizadosInv($idproyecto,$idinversionista,$idaporte);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}

	
	//public function index($page=1)
	public function getEncabezadoInv($idproyecto=-1,$idinversionista=-1,$idaporte=-1)
	{
		$this->load->model('mreporte');
		$encabezado = $this->mreporte->getEncabezadoEstadoCuentaInv($idproyecto,$idinversionista,$idaporte);	
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($encabezado));
	}

	

}