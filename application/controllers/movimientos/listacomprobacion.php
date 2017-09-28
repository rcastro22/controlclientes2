<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class listacomprobacion extends MY_Controller
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
			$this->load->model('musuarioadmin');
			$datosusuario = $this->musuarioadmin->getUsuarioLogin($this->session->userdata('user_id'));

			$this->view_data['usuario']= $this->session->userdata('user_id');
			$this->view_data['datosusuario'] = $datosusuario;
		}

	}

	public function listado($idnegociacion=-1)
	{
		$this->load->model('mnegociacion');
		$datosnegociacion = $this->mnegociacion->getNegociacionId($idnegociacion);
		$this->view_data['datosnegociacion']=$datosnegociacion;

		$this->view_data['page_title']=  'Lista de comprobación de documentos';
		$this->view_data['activo']=  'negociaciones';
		$this->view_data['idnegociacion']= $idnegociacion;
		$this->load_partials();
		$this->load->view('movimientos/listacomprobacion/listado',$this->view_data);
	}

	public function getListado($idnegociacion)
	{
		$this->load->model('mlistacomprobacion');
		$clientes = $this->mlistacomprobacion->getLista($idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($clientes));
	}


	public function grabarDocumentos()
    {	

    	$idnegociacion=$_POST['idnegociacion'];


        $this->load->model('mdocumentos_negociacion');
        $sielimino=$this->mdocumentos_negociacion->borrar(array('idnegociacion'=>$idnegociacion),$err);
		if ($sielimino)
        {
        	if(isset($_POST['arreglo'])) {
        		$arreglo = $_POST['arreglo'];
	        	$inserto=$this->mdocumentos_negociacion->grabar($arreglo,$err);
	        	if (!$inserto)
	        	{
	        		echo $err;
	        	}
	        }
        }
    	else
    	{
    		echo $err;
    	}
	}
	
}