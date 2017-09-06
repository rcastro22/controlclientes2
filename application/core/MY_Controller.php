<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	//aqui el viewdata lo paso como atributo y extiendo de la clase CI_Controller
	protected $view_data = array();

	function __construct()
	{
		//este constructor es necesario para mandar a llamar la clase padre
		//ya que alli es donde se crea la clase loader
		parent::__construct();

		
	

		//esto sirve para que me salga estadisticas y consultas 
		//$this->output->enable_profiler((ENVIRONMENT=='development'));
	}

	protected function load_partials()
	{
		//aqui carga al view data el header y lo cargo como string gracias al ultimo
		//parametro qu estoy poniendo aca como true si no lo pongo no lo devuelve como
		//cadena
		$this->view_data['assets'] = $this->load->view('partials/assets',null,true);
		//esto hace que en el header lleve incluido el view_data gracias la parametro $this->view_data
		//$this->view_data['logout'] = $this->load->view('partials/logout',null,true);
		$this->view_data['footer'] = $this->load->view('partials/footer',null,true);
		$this->view_data['headerprincipal'] = $this->load->view('partials/headerprincipal',$this->view_data,true);
		$this->view_data['headercat'] = $this->load->view('partials/headercat',$this->view_data,true);
		$this->view_data['headermov'] = $this->load->view('partials/headermov',$this->view_data,true);
		$this->view_data['headerrep'] = $this->load->view('partials/headerrep',$this->view_data,true);
		$this->view_data['headeradmin'] = $this->load->view('partials/headeradmin',$this->view_data,true);
		$this->view_data['headerclave'] = $this->load->view('partials/headerclave',$this->view_data,true);
		
	}



}