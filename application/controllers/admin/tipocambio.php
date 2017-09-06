<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class tipocambio extends MY_Controller
{

   
	function __construct()
	{
		parent::__construct();
		//esto tambien si se gusta se puede agregar en el autoload y ya no seria necesario aqui
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

    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Tipo de cambio del día';
		$this->view_data['activo']=  'tipocambio';
		$this->load_partials();
		

		switch ($method) 
		{
			case 'GET':
				$this->load->view('admin/tipocambio/nuevo',$this->view_data);
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//pongo mis reglas de validación.
			   
				$this->form_validation->set_rules('valorcambio','cambio del día','required');
				
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('admin/tipocambio/nuevo',$this->view_data);

				}
				else
				{
					$this->load->model('MTipoCambio');

					$inserto=$this->MTipoCambio->grabar(array(
						   'valor'=>$this->input->post('valorcambio'),
						   'fecha'=>date("Y-m-d H:i:s"),
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
                    
					if($inserto)
					{
						redirect('admin/tipocambio/nuevo');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('admin/tipocambio/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	//public function index($page=1)
	public function getTipoCambioDia()
	{
		$this->load->model('MTipoCambio');
		$tipo = $this->MTipoCambio->getTipoCambioDia();
				
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($tipo));

	}



}