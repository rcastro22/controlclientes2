<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class econsulta extends MY_Controller
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
		$this->view_data['page_title']=  'Usuarios';
		$this->view_data['activo']=  'usuarios';
		$this->load_partials();
		$this->load->view('admin/usuario/listado',$this->view_data);
	}
    
    public function consulta()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Ejecutar consulta';
    	$this->view_data['activo']=  '';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				if($this->session->userdata('user_id') == 'programacion')
					$this->load->view('admin/econsulta/consulta',$this->view_data);	
				else
					redirect('menu');
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('clave','clave','required');
				$this->form_validation->set_rules('consulta','consulta','required');
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('admin/econsulta/consulta',$this->view_data);
				}
				else
				{
					$err = "";
					$this->load->model('musuario');
					if($this->session->userdata('user_id') == 'programacion' && $this->musuario->validar($this->session->userdata('user_id'),sha1($this->input->post('clave'))))
					{
						
						$this->load->model('meconsulta');
						$inserto=$this->meconsulta->execQ($this->input->post('consulta'),$err);
	              		if($err)
						{
							$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->load->view('admin/econsulta/consulta',$this->view_data);
							
						}
						else
	                    {
	                    	redirect('admin/econsulta/consulta');
	                    }
	                }
	                else
					{
						$this->view_data['mensaje']="Error: Contraseña incorrecta: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('admin/econsulta/consulta',$this->view_data);
					}
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }
	
	//public function index($page=1)
	public function getUsuario()
	{
		$this->load->model('musuarioadmin');
		$usuario = $this->musuarioadmin->getUsuarios();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($usuario));
	}
}