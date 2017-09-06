<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inversionista extends MY_Controller
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

	
	public function getInversionistasPorProyecto($idproyecto=-1)
	{
		$this->load->model('minversionista');
		$inversionistas = $this->minversionista->getInversionistasPorProyecto($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($inversionistas));
	}
}