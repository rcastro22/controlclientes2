<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class proyeccionflujo extends MY_Controller
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

	public function repProyeccionFlujo()
	{
		$this->view_data['page_title']=  'Proyecciones de flujo';
		$this->view_data['activo']=  'flujo';
		$this->load_partials();
		$this->load->view('reportes/proyeccionflujo',$this->view_data);
	}

	//public function index($page=1)
	public function getProyeccionFlujo($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getProyeccionFlujo($idproyecto);	
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
}