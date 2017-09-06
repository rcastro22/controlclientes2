<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class menu extends MY_Controller
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

    //el offset lo agregue cuando hice la paginacion
    //luego quite el $page=1 cuando hice el ordenamiento
	//public function index($page=1)
	public function index()
	{				
		$tipousuarioId = "";
		$this->load->model('musuarioadmin');
		$datosusuario = $this->musuarioadmin->getUsuarioLogin($this->session->userdata('user_id'));

		$this->view_data['page_title']=  'Menu principal';
		$this->view_data['datosusuario'] = $datosusuario;
		$this->load_partials();
		$this->load->view('menu',$this->view_data);
	}
    
    



}
