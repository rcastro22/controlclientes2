<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class tipoinmueble extends MY_Controller
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
		$this->view_data['page_title']=  'Listado de Tipos de Inmueble';
		$this->view_data['activo']=  'tipoinmuebles';
		$this->load_partials();
		$this->load->view('catalogos/tipoinmueble/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de Tipos de Inmuebles';
    	$this->view_data['activo']=  'tipoinmuebles';
		$this->load_partials();
		

		switch ($method) 
		{
			case 'GET':
				$this->load->view('catalogos/tipoinmueble/nuevo',$this->view_data);	

				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//pongo mis reglas de validación.
			   
				$this->form_validation->set_rules('nombre','nombre','required');
				
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('catalogos/tipoinmueble/nuevo',$this->view_data);

				}
				else
				{

					//typography esto es para que grabe html
					//$this->load->library('typography');
					//$nombre=$this->typography->auto_typography($this->input->post('BancoNombre'));

					//enviar datos al modelo
					//redireccionar al detalle con el id
					//cargo primero el modelo para poder tener acceso al metodo save.
					$this->load->model('MTipoInmueble');
					//madno al save el arreglo con los campos a insertar
					//cambio la instruccion que comente por la otra cuando agregue typography
					/*$this->projects->save(array(
						   'name'=>$this->input->post('name'),
						   'description'=>$this->input->post('description')));
                    */

					$inserto=$this->MTipoInmueble->grabar(array(
						   'nombre'=>$this->input->post('nombre'),
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
                    
					if($inserto)
					{
						redirect('catalogos/tipoinmueble/listado');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/tipoinmueble/nuevo',$this->view_data);
                    }

					



				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idtipoinmueble=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de Tipos de Inmuebles';
    	$this->view_data['activo']= 'tipoinmuebles';
		$this->load_partials();
		

		switch ($method) 
		{
			case 'GET':

				$this->load->model('MTipoInmueble');
				$datostipoinmueble = $this->MTipoInmueble->getTipoInmueble($idtipoinmueble);
        		$this->view_data['datostipoinmueble']=$datostipoinmueble;
				$this->load->view('catalogos/tipoinmueble/edit',$this->view_data);
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//pongo mis reglas de validación.
			    //$bancoid=$this->input->post('BancoId');
			    $idtipoinmueble=$this->input->post('idtipoinmueble');
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

					$datostipoinmueble = new stdClass();
					$datostipoinmueble->idtipoinmueble = $this->input->post('idtipoinmueble');
					$datostipoinmueble->nombre= $this->input->post('nombre');
				

					/*$datosbanco=array(
						'BancoId' => $this->input->post('BancoId'),
						'BancoNombre' => $this->input->post('BancoNombre'));
					*/
				
					$this->view_data['datostipoinmueble']=$datostipoinmueble;
					$this->load->view('catalogos/tipoinmueble/edit',$this->view_data);
					//$this->load->view('catalogos/bancos/nuevo',$this->view_data);
				}
				else
				{
					
					//cargo primero el modelo para poder tener acceso al metodo save.
					$this->load->model('MTipoInmueble');
					$err="";
					$siactualizo=$this->MTipoInmueble->modificar($this->input->post('idtipoinmueble'),array(
						   'nombre'=>$this->input->post('nombre'),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
                    
                    $datostipoinmueble = new stdClass();
					$datostipoinmueble->idtipoinmueble= $this->input->post('idtipoinmueble');
					$datostipoinmueble->nombre= $this->input->post('nombre');
					$this->view_data['datostipoinmueble']=$datostipoinmueble;

                    if ($siactualizo)
                    {
                    	//$this->view_data['mensaje']="Registro actualizado !!!";
                    	//$this->view_data['tipoAlerta']="alert-success";
                    	redirect('catalogos/tipoinmueble/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/tipoinmueble/edit',$this->view_data);
                    }
                    //carga la vista.
                    
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($tipoInmuebleEliminar=-1)
 	{
 		$this->load->model('MTipoInmueble');
		$sielimino=$this->MTipoInmueble->borrar(array('idtipoinmueble'=>$tipoInmuebleEliminar),$err);
                    
        if ($sielimino)
        {
        	redirect('catalogos/tipoinmueble/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Listado de Tipos de Inmuebles';
		$this->view_data['activo']=  'tipoinmuebles';
		$this->load_partials();
        	
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/tipoinmueble/listado',$this->view_data);
        }
			

	}
	//public function index($page=1)
	public function getTipoInmuebles()
	{
		//echo "hola controlador";
		//exit;
		//cargo el modelo de projects
		$this->load->model('MTipoInmueble');
		//agrege los campos de orden y direccion
		$tipoinmuebles = $this->MTipoInmueble->getTipoInmuebles();
		//print_r($bancos);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($tipoinmuebles));
		

	}



}