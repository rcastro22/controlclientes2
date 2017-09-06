<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuario extends MY_Controller
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
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Nuevo usuario';
    	$this->view_data['activo']=  'usuarios';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->view('admin/usuario/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('nombre','nombre','required');
				$this->form_validation->set_rules('apellido','apellido','required');
				$this->form_validation->set_rules('login','login','required');
				$this->form_validation->set_rules('clave','clave','required');
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('admin/usuario/nuevo',$this->view_data);
				}
				else
				{
					$this->load->model('musuarioadmin');
					$inserto=$this->musuarioadmin->grabar(array(
						   'nombre'=>$this->input->post('nombre'),
						   'apellido'=>$this->input->post('apellido'),
						   'login'=>$this->input->post('login'),
						   'clave'=>sha1($this->input->post('clave')),
						   'tipousuario'=>$this->input->post('tusuario'),
						   //Auditoria
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
              		if($inserto)
					{
						redirect('admin/usuario/listado');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('admin/usuario/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idusuario=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de usuario';
    	$this->view_data['activo']= 'usuarios';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('musuarioadmin');
				$datosusuario = $this->musuarioadmin->getUsuarioId($idusuario);
        		$this->view_data['datosusuario']=$datosusuario;
				$this->load->view('admin/usuario/edit',$this->view_data);
				break;
			case 'POST':
				$this->form_validation->set_rules('nombre','nombre','required');
				$this->form_validation->set_rules('apellido','apellido','required');
				//$this->form_validation->set_rules('login','login','required');
				//$this->form_validation->set_rules('clave','clave','required');
				if($this->form_validation->run()==FALSE)
				{
					$datosusuario = new stdClass();
					$datosusuario->idusuario=$this->input->post('idusuario');
					$datosusuario->nombre=$this->input->post('nombre');
					$datosusuario->nombre=$this->input->post('apellido');
					//$datosusuario->nombre=$this->input->post('login');
					//$datosusuario->nombre=$this->input->post('clave');
					$this->view_data['datosusuario']=$datosusuario;
					$this->load->view('admin/usuario/edit',$this->view_data);
				}
				else
				{
					$this->load->model('musuarioadmin');
					$err="";
					$siactualizo=$this->musuarioadmin->modificar($this->input->post('idusuario'),
						    array(
							   'nombre'=>$this->input->post('nombre'),
							   'apellido'=>$this->input->post('apellido'),
							   'tipousuario'=>$this->input->post('tusuario'),
							   //'login'=>$this->input->post('login'),
							   //'clave'=>sha1($this->input->post('clave')),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
						        ),$err);
                    
                    $datosusuario = new stdClass();
					$datosusuario->idusuario=$this->input->post('idusuario');
					$datosusuario->nombre= $this->input->post('nombre');
					$datosusuario->apellido= $this->input->post('apellido');
					//$datosusuario->login= $this->input->post('apellido');
					//$datosusuario->clave= $this->input->post('clave');
					$this->view_data['datosusuario']=$datosusuario;
                    if ($siactualizo)
                    {
                    	redirect('admin/usuario/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('admin/usuario/edit',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($idusuario=-1)
 	{
 		$this->load->model('musuarioadmin');
		$sielimino=$this->musuarioadmin->borrar(array('idusuario'=>$idusuario),$err);
        

		if ($sielimino)
        {
        	redirect('admin/usuario/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Usuarios';
    		$this->view_data['activo']= 'usuarios';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('admin/usuario/listado',$this->view_data);
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