<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class sesion extends MY_Controller
{

   
	function __construct()
	{
		parent::__construct();
		//cargo la funcion de MY_Controller
		//esta linea la comente porque la pase para cada funcion al agregarle
		//la funcionalidad de los titulos
		//-----$this->load_partials();
	    
	    //$this->view_data['active-section'] = 'projects';
	}


    //el offset lo agregue cuando hice la paginacion
    //luego quite el $page=1 cuando hice el ordenamiento
	//public function index($page=1)
	public function index()
	{
		$this->view_data['page_title']=  'Acceso al sistema de Control de clientes';
		
		$method = $this->input->server('REQUEST_METHOD');
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->view('login',$this->view_data);
				break;
			
			case 'POST':
			   
				$this->form_validation->set_rules('usuario','Usuario','required');
				$this->form_validation->set_rules('password','Contraseña','required');

				if($this->form_validation->run()===FALSE)
				{
					$this->view_data['login_error']="Usuario o Contraseña incorrectos.";
					$this->load->view('login',$this->view_data);
				
				}
				else
				{

					//$this->view_data['login_error']="Usuario o Contraseña incorrectos.";
					$this->load->model('musuario');
					$varUsuario=$this->input->post('usuario');
					if($this->musuario->validar($this->input->post('usuario'),sha1($this->input->post('password'))))
					{
						

						$this->load->model('msesion');
					    
						$user=$this->musuario->obtenerUsuario($varUsuario);
                        
						$this->msesion->start($user->login);

						// C A L C U L O    D E    M O R A
						$this->load->model('mdetallepago');
						$detallemora=$this->mdetallepago->getPendientesPago();

						foreach ($detallemora as $registromora) 
						{
							$err = "";
							$moracalculada = round($registromora->mora,2);
							$insertomora = $this->mdetallepago->modificar($registromora->idnegociacion,$registromora->nopago,
														array(
													   'moracalculada'=>$moracalculada,
													   'diasmora'=>$registromora->diasmora,
													   // Auditoria
													   'ModificadoPor'=>$this->session->userdata('user_id'),
													   'FechaModificado'=>date("Y-m-d H:i:s")
												        ),$err);
						}

						redirect('menu');
					}
					else
					{
						$this->view_data['login_error']="Usuario o Contraseña incorrectos";
						$this->load->view('login',$this->view_data);
					}
					
				}
				break;
			default:
				# code.
				break;
		}
	}
    
    public function finalizar()
	{

		$this->load->model('msesion');
		$this->msesion->end();
		redirect('sesion');
	}



}
