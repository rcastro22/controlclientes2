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

	public function listado()
	{
		$this->view_data['page_title']=  'Inversionista';
		$this->view_data['activo']=  'inversionista';
		$this->load_partials();
		$this->load->view('catalogos/inversionista/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de inversionista';
    	$this->view_data['activo']=  'inversionista';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->view('catalogos/inversionista/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('nombre','Nombre','required');
				$this->form_validation->set_rules('direccion','Direccion','required');
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('catalogos/inversionista/nuevo',$this->view_data);
				}
				else
				{
					$this->load->model('minversionista');
					$inserto=$this->minversionista->grabar(array(
						   'nombre'=>$this->input->post('nombre'),
						   'direccion'=>$this->input->post('direccion'),
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
              		if($inserto)
					{
						redirect('catalogos/inversionista/listado');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/inversionista/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idinversionista=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de Inversionistas';
    	$this->view_data['activo']= 'inversionista';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('minversionista');
				$datosinversionista = $this->minversionista->getInversionistaId($idinversionista);
        		$this->view_data['datosinversionista']=$datosinversionista;
				$this->load->view('catalogos/inversionista/edit',$this->view_data);
				break;
			case 'POST':
				$this->form_validation->set_rules('nombre','nombre','required');
				$this->form_validation->set_rules('direccion','direccion','required');
				if($this->form_validation->run()==FALSE)
				{
					$datosinversionista = new stdClass();
					$datosinversionista->idinversionista=$this->input->post('idinversionista');
					$datosinversionista->nombre=$this->input->post('nombre');
					$datosinversionista->direccion=$this->input->post('direccion');
					$this->view_data['datosinversionista']=$datosinversionista;
					$this->load->view('catalogos/inversionista/edit',$this->view_data);
				}
				else
				{
					$this->load->model('minversionista');
					$err="";
					$siactualizo=$this->minversionista->modificar($this->input->post('idinversionista'),
						    array(
							   'nombre'=>$this->input->post('nombre'),
							   'direccion'=>$this->input->post('direccion'),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
						        ),$err);
                    
                    $datosinversionista = new stdClass();
					$datosinversionista->idinversionista=$this->input->post('idinversionista');
					$datosinversionista->nombre=$this->input->post('nombre');
					$datosinversionista->direccion=$this->input->post('direccion');
					$this->view_data['datosinversionista']=$datosinversionista;
                    if ($siactualizo)
                    {
                    	redirect('catalogos/inversionista/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/inversionista/edit',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($idinversionista=-1)
 	{
 		$this->load->model('minversionista');
		$sielimino=$this->minversionista->borrar(array('idinversionista'=>$idinversionista),$err);
        

		if ($sielimino)
        {
        	redirect('catalogos/inversionista/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Inversionistas';
    		$this->view_data['activo']= 'inversionista';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/inversionista/listado',$this->view_data);
        }
	}
	
	//public function index($page=1)
	public function getInversionista()
	{
		$this->load->model('minversionista');
		$inversionista = $this->minversionista->getInversionistas();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($inversionista));
	}
}