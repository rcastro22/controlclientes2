<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class formapago extends MY_Controller
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

	public function listado()
	{
		$this->view_data['page_title']=  'Formas de Pago';
		$this->view_data['activo']=  'formapago';
		$this->load_partials();
		$this->load->view('catalogos/formapago/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Nueva forma de pago';
    	$this->view_data['activo']=  'formapago';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->view('catalogos/formapago/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('descripcion','descripcion','required');
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('catalogos/formapago/nuevo',$this->view_data);
				}
				else
				{
					$this->load->model('mformapago');
					$inserto=$this->mformapago->grabar(array(
						   'descripcion'=>$this->input->post('descripcion'),
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
              		if($inserto)
					{
						redirect('catalogos/formapago/listado');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/formapago/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idformapago=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de forma de pago';
    	$this->view_data['activo']= 'formapago';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('mformapago');
				$datosformapago = $this->mformapago->getformapagoId($idformapago);
        		$this->view_data['datosformapago']=$datosformapago;
				$this->load->view('catalogos/formapago/edit',$this->view_data);
				break;
			case 'POST':
				$this->form_validation->set_rules('descripcion','descripcion','required');
				if($this->form_validation->run()==FALSE)
				{
					$datosformapago = new stdClass();
					$datosformapago->idformapago=$this->input->post('idformapago');
					$datosformapago->descripcion=$this->input->post('descripcion');
					$this->view_data['datosformapago']=$datosformapago;
					$this->load->view('catalogos/formapago/edit',$this->view_data);
				}
				else
				{
					$this->load->model('mformapago');
					$err="";
					$siactualizo=$this->mformapago->modificar($this->input->post('idformapago'),
						    array(
							   'descripcion'=>$this->input->post('descripcion'),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
						        ),$err);
                    
                    $datosformapago = new stdClass();
					$datosformapago->idformapago=$this->input->post('idformapago');
					$datosformapago->descripcion= $this->input->post('descripcion');
					$this->view_data['datosformapago']=$datosformapago;
                    if ($siactualizo)
                    {
                    	redirect('catalogos/formapago/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/formapago/edit',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($idformapagoDel=-1)
 	{
 		$this->load->model('mformapago');
		$sielimino=$this->mformapago->borrar(array('idformapago'=>$idformapagoDel),$err);
        

		if ($sielimino)
        {
        	redirect('catalogos/formapago/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Formas de Pago';
    		$this->view_data['activo']= 'formapago';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/formapago/listado',$this->view_data);
        }
	}
	
	//public function index($page=1)
	public function getFormaPago()
	{
		$this->load->model('mformapago');
		$fpago = $this->mformapago->getFormaPago();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($fpago));
	}
}