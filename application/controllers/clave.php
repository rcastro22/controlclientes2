<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class clave extends MY_Controller
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
		//cargo la funcion de MY_Controller
		//esta linea la comente porque la pase para cada funcion al agregarle
		//la funcionalidad de los titulos
		//-----$this->load_partials();
	    
	    //$this->view_data['active-section'] = 'projects';
	}


    //el offset lo agregue cuando hice la paginacion
    //luego quite el $page=1 cuando hice el ordenamiento
	//public function index($page=1)
	public function cambiar()
	{
		$this->view_data['page_title']=  'Cambio de clave';
		$this->view_data['activo']=  'inicio';
		$method = $this->input->server('REQUEST_METHOD');
		$this->load_partials();

		switch ($method) 
		{
			case 'GET':
				$this->load->view('clave/cambiar',$this->view_data);
				break;
			
			case 'POST':
			   
				$this->form_validation->set_rules('claveactual','clave actual','required');
				$this->form_validation->set_rules('clavenueva','clave nueva','required');
				$this->form_validation->set_rules('claveconfirmar','confirmacion','required');

				if($this->form_validation->run()===FALSE)
				{
					$this->view_data['claveactual']=$this->input->post('claveactual');
					$this->view_data['clavenueva']=$this->input->post('clavenueva');
					$this->view_data['claveconfirmar']=$this->input->post('claveconfirmar');
					$this->load->view('clave/cambiar',$this->view_data);
				
				}
				else
				{

					$this->load->model('musuario');
										
					if($this->musuario->validar($this->session->userdata('user_id'),sha1($this->input->post('claveactual'))))
					{
						if ($this->input->post('clavenueva')==$this->input->post('claveconfirmar'))
						{
							$this->load->model('msesion');
							$user=$this->musuario->obtenerUsuario($this->session->userdata('user_id'));


							
							$this->load->model('musuarioadmin');
							$err="";
							$siactualizo=$this->musuarioadmin->modificar($user->idusuario,
						    array(
							   'clave'=>sha1($this->input->post('clavenueva')),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
						        ),$err);
							
							$this->msesion->end();
							redirect('sesion');



						}
						else
						{
							$this->view_data['login_error']="La clave nueva no coincide con la confirmación";
							$this->load->view('clave/cambiar',$this->view_data);
						}
					}
					else
					{
						$this->view_data['login_error']="La clave actual no coincide";
						$this->load->view('clave/cambiar',$this->view_data);
					}
					
				}
				break;
			default:
				# code.
				break;
		}
	}
    
   


}
