<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asesor extends MY_Controller
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
		$this->view_data['page_title']=  'Asesores';
		$this->view_data['activo']=  'asesor';
		$this->load_partials();
		$this->load->view('catalogos/asesor/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de asesor';
    	$this->view_data['activo']=  'asesor';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->view('catalogos/asesor/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('nombre','Nombre','required');
				$this->form_validation->set_rules('apellido','Apellido','required');
				$this->form_validation->set_rules('direccion','Direccion','required');
				$this->form_validation->set_rules('telefono','Telefono','required|numeric|min_length[8]|max_length[8]');
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('catalogos/asesor/nuevo',$this->view_data);
				}
				else
				{
					$this->load->model('masesor');
					$inserto=$this->masesor->grabar(array(
						   'nombre'=>$this->input->post('nombre'),
						   'apellido'=>$this->input->post('apellido'),
						   'direccion'=>$this->input->post('direccion'),
						   'telefono'=>$this->input->post('telefono'),
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
              		if($inserto)
					{
						redirect('catalogos/asesor/listado');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/asesor/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idasesor=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de Asesores';
    	$this->view_data['activo']= 'asesor';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('masesor');
				$datosasesor = $this->masesor->getAsesorId($idasesor);
        		$this->view_data['datosasesor']=$datosasesor;
				$this->load->view('catalogos/asesor/edit',$this->view_data);
				break;
			case 'POST':
				$this->form_validation->set_rules('nombre','nombre','required');
				$this->form_validation->set_rules('apellido','apellido','required');
				$this->form_validation->set_rules('direccion','direccion','required');
				$this->form_validation->set_rules('telefono','telefono','required|numeric|min_length[8]|max_length[8]');
				if($this->form_validation->run()==FALSE)
				{
					$datosasesor = new stdClass();
					$datosasesor->idasesor=$this->input->post('idasesor');
					$datosasesor->nombre=$this->input->post('nombre');
					$datosasesor->apellido=$this->input->post('apellido');
					$datosasesor->direccion=$this->input->post('direccion');
					$datosasesor->telefono=$this->input->post('telefono');
					$this->view_data['datosasesor']=$datosasesor;
					$this->load->view('catalogos/asesor/edit',$this->view_data);
				}
				else
				{
					$this->load->model('masesor');
					$err="";
					$siactualizo=$this->masesor->modificar($this->input->post('idasesor'),
						    array(
							   'nombre'=>$this->input->post('nombre'),
							   'apellido'=>$this->input->post('apellido'),
							   'direccion'=>$this->input->post('direccion'),
							   'telefono'=>$this->input->post('telefono'),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
						        ),$err);
                    
                    $datosasesor = new stdClass();
					$datosasesor->idasesor=$this->input->post('idasesor');
					$datosasesor->nombre=$this->input->post('nombre');
					$datosasesor->apellido=$this->input->post('apellido');
					$datosasesor->direccion=$this->input->post('direccion');
					$datosasesor->telefono=$this->input->post('telefono');
					$this->view_data['datosasesor']=$datosasesor;
                    if ($siactualizo)
                    {
                    	redirect('catalogos/asesor/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/asesor/edit',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($idasesor=-1)
 	{
 		$this->load->model('masesor');
		$sielimino=$this->masesor->borrar(array('idasesor'=>$idasesor),$err);
        

		if ($sielimino)
        {
        	redirect('catalogos/asesor/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Asesores';
    		$this->view_data['activo']= 'asesor';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/asesor/listado',$this->view_data);
        }
	}
	
	//public function index($page=1)
	public function getAsesor()
	{
		$this->load->model('masesor');
		$asesor = $this->masesor->getAsesores();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($asesor));
	}
}