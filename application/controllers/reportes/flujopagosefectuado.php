<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class flujopagosefectuado extends MY_Controller
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
		$this->view_data['activo']=  'flujoefectuado';
		$this->load_partials();
		$this->load->view('reportes/flujopagosefectuado',$this->view_data);
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
		$proyeccion = $this->mreporte->getFlujoPagosEfectuados($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}



    public function getFlujoRangoAportesInv($idproyecto=-1)
	{
		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getFlujoPagosProyectadosRangoAportesInv($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}

    //erick 20/01/2016 para el reporte de flujo de pagos inversionista
	public function repFlujoPagosProyInv()
	{
		$this->view_data['page_title']=  'Proyecciones de flujo Inversionistas';
		$this->view_data['activo']=  'flujoefectuadoinv';
		$this->load_partials();
		$this->load->view('reportes/flujopagosefectuadoinv',$this->view_data);
	}

    //erick 27/01/2016
	//public function index($page=1)
	public function getFlujoPagosProyectadosInv($idproyecto=-1)
	{

		$this->load->model('mreporte');
		$proyeccion = $this->mreporte->getFlujoPagosEfectuadosInv($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));

	}
}