<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class flujopagosproyectado extends MY_Controller
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

	public function repFlujoPagosProy()
	{
		$this->view_data['page_title']=  'Proyecciones de flujo';
		$this->view_data['activo']=  'flujoproyectado';
		$this->load_partials();
		$this->load->view('reportes/flujopagosproyectado',$this->view_data);
	}

	//public function index($page=1)
	public function getFlujoMaxCuotas($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getFlujoPagosProyectadosMaxCuotas($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}

	public function getFlujoRangoCuotas($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getFlujoPagosProyectadosRangoCuotas($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}

	//public function index($page=1)
	public function getFlujoPagosProyectados($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getFlujoPagosProyectados($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}
}