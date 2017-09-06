<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class flujopagosefecproy extends MY_Controller
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
		$this->view_data['page_title']=  'Pagado y Proyeccion de flujo';
		$this->view_data['activo']=  'flujoefecproy';
		$this->load_partials();
		$this->load->view('reportes/flujopagosefecproy',$this->view_data);
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
	public function getFlujoPagosEfecProy($idproyecto=-1)
	{
		$this->load->model('mreporte');
		//Borra los datos de la tabla Reporte_EfecProy
		//$this->mreporte->borrar_Reporte_EfecProy($err);
		$this->mreporte->grabar_Efectuados_Reporte_EfecProy($idproyecto,$err);	// inserta los datos en la tabla temporal
		//$this->mreporte->grabar_Efectuados_Reporte_EfecProy($idproyecto,$err);
		//$proyeccion = $this->mreporte->getFlujoPagosEfectuados($idproyecto);
		$proyeccion = $this->mreporte->getFlujoPagosEfecProy($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyeccion));
	}
}