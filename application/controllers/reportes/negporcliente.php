<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class negporcliente extends MY_Controller
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

	public function repNegPorCliente()
	{
		$this->view_data['page_title']=  'Clientes morosos';
		$this->view_data['activo']=  'negporcliente';
		$this->load_partials();
		$this->load->view('reportes/negporcliente',$this->view_data);
	}

	//public function index($page=1)
	public function getNegPorCliente($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$datos = $this->mreporte->negPorCliente($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($datos));
	}

	//public function index($page=1)
	public function getClientesMorososTotales($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$clientes = $this->mreporte->getClientesMorososTotales($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($clientes));
	}
}