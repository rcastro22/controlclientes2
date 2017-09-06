<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class msesion extends CI_Model {
	
	public function start($user_id)
	{
		
		//esto es si quiero cambiar algun paramtero del config desde aqui.
		//cambiando el arreglo correspondiente.
		//$this->load->library('session',array('sess_expire_on_close'=>false));

		//se carga la libreria de session
		$this->load->library('session');
		//esto agrega este indice mas al arreglo normal de la session se puede ver
		//el arreglo de sesion en la documentacio de codeigniter

		$this->session->set_userdata('logged_in',true);
		$this->session->set_userdata('user_id',$user_id);

		

	}

    public function end()
    {
    	$this->load->library('session');
    	$this->session->sess_destroy();
    }	
}