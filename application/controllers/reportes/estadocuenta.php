<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class estadocuenta extends MY_Controller
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

	public function repEstadoCuenta()
	{
		$this->view_data['page_title']=  'Estado de Cuenta';
		$this->view_data['activo']=  'flujo';
		$this->load_partials();
		$this->load->view('reportes/estadocuenta',$this->view_data);
	}

	//public function index($page=1)
	public function getPagosRealizados($idproyecto=-1,$idcliente=-1,$idnegociacion=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getPagosRealizados($idproyecto,$idcliente,$idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}

	//public function index($page=1)
	public function getProyeccionFlujoTotales($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getProyeccionFlujoTotales($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}

	//public function index($page=1)
	public function getEncabezado($idproyecto=-1,$idcliente=-1,$idnegociacion=-1)
	{
		$this->load->model('mreporte');
		$encabezado = $this->mreporte->getEncabezadoEstadoCuenta($idproyecto,$idcliente,$idnegociacion);	
		//print_r($encabezado);
		//exit;

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($encabezado));
	}

	//public function index($page=1)
	public function getComprasEstadoCuenta($idnegociacion=-1)
	{
		$this->load->model('mreporte');
		$encabezado = $this->mreporte->getComprasEstadoCuenta($idnegociacion);	
		//print_r($encabezado);

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($encabezado));
	}

}