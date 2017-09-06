<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class tipoidentificacion extends MY_Controller
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

    //el offset lo agregue cuando hice la paginacion
    //luego quite el $page=1 cuando hice el ordenamiento
	//public function index($page=1)
	public function listado()
	{

		$this->view_data['page_title']=  'Listado de Tipos de Identificación';
		$this->view_data['activo']=  'identificacion';
		$this->load_partials();
		$this->load->view('catalogos/tipoidentificacion/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de Tipos de Identificación';
    	$this->view_data['activo']=  'identificacion';
		$this->load_partials();
		

		switch ($method) 
		{
			case 'GET':
				$this->load->view('catalogos/tipoidentificacion/nuevo',$this->view_data);	

				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//pongo mis reglas de validación.
			   
				$this->form_validation->set_rules('nombre','nombre','required');
				
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('catalogos/tipoidentificacion/nuevo',$this->view_data);

				}
				else
				{
					$this->load->model('MTipoIdentificacion');
					//madno al save el arreglo con los campos a insertar
					//cambio la instruccion que comente por la otra cuando agregue typography
					/*$this->projects->save(array(
						   'name'=>$this->input->post('name'),
						   'description'=>$this->input->post('description')));
                    */

					$inserto=$this->MTipoIdentificacion->grabar(array(
						   'nombre'=>$this->input->post('nombre'),
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
                    
					if($inserto)
					{
						redirect('catalogos/tipoidentificacion/listado');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/tipoidentificacion/nuevo',$this->view_data);
                    }

					



				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idtipoidentificacion=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de Tipos de Identificación';
    	$this->view_data['activo']= 'identificacion';
		$this->load_partials();
		

		switch ($method) 
		{
			case 'GET':

				$this->load->model('MTipoIdentificacion');
				$datostipoidentificacion = $this->MTipoIdentificacion->getIdentificacion($idtipoidentificacion);

				$this->view_data['datostipoidentificacion']=$datostipoidentificacion;
				$this->load->view('catalogos/tipoidentificacion/edit',$this->view_data);
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//pongo mis reglas de validación.
			    //$bancoid=$this->input->post('BancoId');
			    $idtipoidentificacion=$this->input->post('idtipoidentificacion');
			    //$this->form_validation->set_rules('BancoId','Código','required');
				$this->form_validation->set_rules('nombre','nombre','required');
				
				
				//tambien lo quite porque lo hice en le archivo language
				//esto cambia el mensaje de validacion para solo esta pantalla y solo este campo
				//y en %s colocara lo que pongamos en el segundo parametro de la set_rules de descripcion
                //$this->form_validation->set_message('required','El campo %s es obligatrio');

                //quite esto porque ya lo maneja la vista.
				//$this->form_validation->set_error_delimiters('<li class="error">','</li>');

				if($this->form_validation->run()==FALSE)
				{

					$datostipoidentificacion = new stdClass();
					$datostipoidentificacion->idtipoidentificacion = $this->input->post('idtipoidentificacion');
					$datostipoidentificacion->nombre= $this->input->post('nombre');
				

								
					$this->view_data['datostipoidentificacion']=$datostipoidentificacion;
					$this->load->view('catalogos/tipoidentificacion/edit',$this->view_data);
					//$this->load->view('catalogos/bancos/nuevo',$this->view_data);
				}
				else
				{
					
					//cargo primero el modelo para poder tener acceso al metodo save.
					$this->load->model('MTipoIdentificacion');
					$err="";
					$siactualizo=$this->MTipoIdentificacion->modificar($this->input->post('idtipoidentificacion'),array(
						   'nombre'=>$this->input->post('nombre'),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
                    
                    $datostipoidentificacion = new stdClass();
					$datostipoidentificacion->idtipoidentificacion = $this->input->post('idtipoidentificacion');
					$datostipoidentificacion->nombre= $this->input->post('nombre');
					$this->view_data['datostipoidentificacion']=$datostipoidentificacion;

                    if ($siactualizo)
                    {
                    	//$this->view_data['mensaje']="Registro actualizado !!!";
                    	//$this->view_data['tipoAlerta']="alert-success";
                    	redirect('catalogos/tipoidentificacion/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/tipoidentificacion/edit',$this->view_data);
                    }
                    //carga la vista.
                    
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($identificacionEliminar=-1)
 	{
 		$this->load->model('MTipoIdentificacion');
		$sielimino=$this->MTipoIdentificacion->borrar(array('idtipoidentificacion'=>$identificacionEliminar),$err);
                    
        if ($sielimino)
        {
        	redirect('catalogos/tipoidentificacion/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Listado de Tipos de Identificación';
		$this->view_data['activo']=  'identificacion';
		$this->load_partials();
        	
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/tipoidentificacion/listado',$this->view_data);
        }
			

	}
	//public function index($page=1)
	public function getIdentificaciones()
	{
		//console.log("hola");
		//cargo el modelo de projects
		$this->load->model('MTipoIdentificacion');
		//agrege los campos de orden y direccion
		$identificaciones = $this->MTipoIdentificacion->getIdentificaciones();
		//print_r($bancos);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($identificaciones));

	}



}