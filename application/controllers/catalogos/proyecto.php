<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class proyecto extends MY_Controller
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
		$this->view_data['page_title']=  'Listado de Proyectos';
		$this->view_data['activo']=  'proyectos';
		$this->load_partials();
		$this->load->view('catalogos/proyectos/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de Proyectos';
    	$this->view_data['activo']=  'proyectos';
		$this->load_partials();
		

		switch ($method) 
		{
			case 'GET':
				$datosproyecto = new stdClass();
				$this->view_data['datosproyecto']=$datosproyecto;
				$datosproyecto->estadocivil_rep= $this->input->post('estadocivil_rep');
				$this->load->view('catalogos/proyectos/nuevo',$this->view_data);	

				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//pongo mis reglas de validación.
				$this->form_validation->set_rules('nombre','nombre','required');
				$this->form_validation->set_rules('dialimite','Dia inicio mora','required|numeric');
				$this->form_validation->set_rules('porcentajemora','porcentaje de mora','required|numeric');
				$this->form_validation->set_rules('valortipocambio','Tipo de cambio','required|numeric');
				$this->form_validation->set_rules('finca','Finca','numeric');
				$this->form_validation->set_rules('folio','Folio','numeric');
				$this->form_validation->set_rules('libro','Libro','numeric');

				$this->form_validation->set_rules('nombre_rep','Representante','required');
				$this->form_validation->set_rules('fechanac_rep','Fecha de Nacimiento','required');
				$this->form_validation->set_rules('estadocivil_rep','Estado civil');
				$this->form_validation->set_rules('dpi_rep','DPI','required|numeric');
				$this->form_validation->set_rules('descripcion_rep','Descripcion de puesto','required');
				$this->form_validation->set_rules('nombreedificio','Nombre del Edificio','required');
				$this->form_validation->set_rules('entidadvendedora','Entidad vendedora','required');
				$this->form_validation->set_rules('notario','Notario','required');
				$this->form_validation->set_rules('registro','Registro','required');
				$this->form_validation->set_rules('folio_reg','Folio','required');
				$this->form_validation->set_rules('libro_reg','Libro','required');
				$this->form_validation->set_rules('fecha_reg','Fecha del registro','required');
				$this->form_validation->set_rules('area','Area m2','required');
				$this->form_validation->set_rules('direccion','Direccion','required');
				$this->form_validation->set_rules('fechaactanotarial','Fecha del acta notarial','required');
	
				if($this->form_validation->run()==FALSE)
				{
					$this->load->view('catalogos/proyectos/nuevo',$this->view_data);

				}
				else
				{

					//typography esto es para que grabe html
					//$this->load->library('typography');
					//$nombre=$this->typography->auto_typography($this->input->post('BancoNombre'));

					//enviar datos al modelo
					//redireccionar al detalle con el id
					//cargo primero el modelo para poder tener acceso al metodo save.
					$this->load->model('MProyecto');
					//madno al save el arreglo con los campos a insertar
					//cambio la instruccion que comente por la otra cuando agregue typography
					/*$this->projects->save(array(
						   'name'=>$this->input->post('name'),
						   'description'=>$this->input->post('description')));
                    */
					//date_default_timezone_set ('America/Guatemala');
					
					$inserto=$this->MProyecto->grabar(array(
						   'nombre'=>$this->input->post('nombre'),
						   'dialimite'=>$this->input->post('dialimite'),
						   'porcentajemora'=>$this->input->post('porcentajemora'),
						   'valortipocambio'=>$this->input->post('valortipocambio'),
						   'fechatipocambio'=>date("Y-m-d H:i:s"),
						   'finca'=>$this->input->post('finca'),
						   'folio'=>$this->input->post('folio'),
						   'libro'=>$this->input->post('libro'),

						   'nombre_rep'=>$this->input->post('nombre_rep'),
						   'fechanac_rep'=>$this->input->post('fechanac_rep'),
						   'estadocivil_rep'=>$this->input->post('estadocivil_rep'),
						   'dpi_rep'=>$this->input->post('dpi_rep'),
						   'descripcion_rep'=>$this->input->post('descripcion_rep'),
						   'nombreedificio'=>$this->input->post('nombreedificio'),
						   'entidadvendedora'=>$this->input->post('entidadvendedora'),
						   'notario'=>$this->input->post('notario'),
						   'registro'=>$this->input->post('registro'),
						   'folio_reg'=>$this->input->post('folio_reg'),
						   'libro_reg'=>$this->input->post('libro_reg'),
						   'fecha_reg'=>$this->input->post('fecha_reg'),
						   'area'=>$this->input->post('area'),
						   'direccion'=>$this->input->post('direccion'),
						   'fechaactanotarial'=>$this->input->post('fechaactanotarial'),

						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
                    
					if($inserto)
					{
						redirect('catalogos/proyecto/listado');
					}
					else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/proyecto/nuevo',$this->view_data);
                    }

					



				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idproyecto=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de Proyectos';
    	$this->view_data['activo']= 'proyectos';
		$this->load_partials();
		

		switch ($method) 
		{
			case 'GET':

				$this->load->model('MProyecto');
				$datosproyecto = $this->MProyecto->getProyecto($idproyecto);
        		$this->view_data['datosproyecto']=$datosproyecto;
				$this->load->view('catalogos/proyectos/edit',$this->view_data);
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				//pongo mis reglas de validación.
			    //$bancoid=$this->input->post('BancoId');
			    $bancoid=$this->input->post('idproyecto');
			    //$this->form_validation->set_rules('BancoId','Código','required');
				$this->form_validation->set_rules('nombre','nombre','required');
				$this->form_validation->set_rules('dialimite','Dia inicio mora','required|numeric');
				$this->form_validation->set_rules('porcentajemora','porcentaje de mora','required|numeric');
				$this->form_validation->set_rules('valortipocambio','Tipo de cambio','required|numeric');
				$this->form_validation->set_rules('finca','Finca','required|numeric');
				$this->form_validation->set_rules('folio','Folio','required|numeric');
				$this->form_validation->set_rules('libro','Libro','required|numeric');

				$this->form_validation->set_rules('nombre_rep','Representante','required');
				$this->form_validation->set_rules('fechanac_rep','Fecha de Nacimiento','required');
				$this->form_validation->set_rules('estadocivil_rep','Estado civil');
				$this->form_validation->set_rules('dpi_rep','DPI','required|numeric');
				$this->form_validation->set_rules('descripcion_rep','Descripcion de puesto','required');
				$this->form_validation->set_rules('nombreedificio','Nombre del Edificio','required');
				$this->form_validation->set_rules('entidadvendedora','Entidad vendedora','required');
				$this->form_validation->set_rules('notario','Notario','required');
				$this->form_validation->set_rules('registro','Registro','required');
				$this->form_validation->set_rules('folio_reg','Folio','required');
				$this->form_validation->set_rules('libro_reg','Libro','required');
				$this->form_validation->set_rules('fecha_reg','Fecha del registro','required');
				$this->form_validation->set_rules('area','Area m2','required');
				$this->form_validation->set_rules('direccion','Direccion','required');
				$this->form_validation->set_rules('fechaactanotarial','Fecha del acta notarial','required');
	

				if($this->form_validation->run()==FALSE)
				{

					$datosproyecto = new stdClass();
					$datosproyecto->idproyecto = $this->input->post('idproyecto');
					$datosproyecto->nombre= $this->input->post('nombre');
					$datosproyecto->dialimite= $this->input->post('dialimite');
					$datosproyecto->porcentajemora= $this->input->post('porcentajemora');
					$datosproyecto->valortipocambio=$this->input->post('valortipocambio');
					$datosproyecto->finca= $this->input->post('finca');
					$datosproyecto->folio= $this->input->post('folio');
					$datosproyecto->libro= $this->input->post('libro');
				
					$datosproyecto->nombre_rep= $this->input->post('nombre_rep');
					$datosproyecto->fechanac_rep= $this->input->post('fechanac_rep');
					$datosproyecto->estadocivil_rep= $this->input->post('estadocivil_rep');
					$datosproyecto->dpi_rep= $this->input->post('dpi_rep');
					$datosproyecto->descripcion_rep= $this->input->post('descripcion_rep');
					$datosproyecto->nombreedificio= $this->input->post('nombreedificio');
					$datosproyecto->entidadvendedora= $this->input->post('entidadvendedora');
					$datosproyecto->notario= $this->input->post('notario');
					$datosproyecto->registro= $this->input->post('registro');
					$datosproyecto->folio_reg= $this->input->post('folio_reg');
					$datosproyecto->libro_reg= $this->input->post('libro_reg');
					$datosproyecto->fecha_reg= $this->input->post('fecha_reg');
					$datosproyecto->area= $this->input->post('area');
					$datosproyecto->direccion= $this->input->post('direccion');
					$datosproyecto->fechaactanotarial= $this->input->post('fechaactanotarial');
				
				
					$this->view_data['datosproyecto']=$datosproyecto;
					$this->load->view('catalogos/proyectos/edit',$this->view_data);
					//$this->load->view('catalogos/bancos/nuevo',$this->view_data);
				}
				else
				{
					
					//cargo primero el modelo para poder tener acceso al metodo save.
					$this->load->model('MProyecto');
					$err="";
					$siactualizo=$this->MProyecto->modificar($this->input->post('idproyecto'),array(
						   'nombre'=>$this->input->post('nombre'),
						   'dialimite'=>$this->input->post('dialimite'),
						   'porcentajemora'=>$this->input->post('porcentajemora'),
						   'valortipocambio'=>$this->input->post('valortipocambio'),
						   'fechatipocambio'=>date("Y-m-d H:i:s"),
						   'finca'=>$this->input->post('finca'),
						   'folio'=>$this->input->post('folio'),
						   'libro'=>$this->input->post('libro'),

						   'nombre_rep'=>$this->input->post('nombre_rep'),
						   'fechanac_rep'=>$this->input->post('fechanac_rep'),
						   'estadocivil_rep'=>$this->input->post('estadocivil_rep'),
						   'dpi_rep'=>$this->input->post('dpi_rep'),
						   'descripcion_rep'=>$this->input->post('descripcion_rep'),
						   'nombreedificio'=>$this->input->post('nombreedificio'),
						   'entidadvendedora'=>$this->input->post('entidadvendedora'),
						   'notario'=>$this->input->post('notario'),
						   'registro'=>$this->input->post('registro'),
						   'folio_reg'=>$this->input->post('folio_reg'),
						   'libro_reg'=>$this->input->post('libro_reg'),
						   'fecha_reg'=>$this->input->post('fecha_reg'),
						   'area'=>$this->input->post('area'),
						   'direccion'=>$this->input->post('direccion'),
						   'fechaactanotarial'=>$this->input->post('fechaactanotarial'),

						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
                    
                    $datosproyecto = new stdClass();
					$datosproyecto->idproyecto = $this->input->post('idproyecto');
					$datosproyecto->nombre= $this->input->post('nombre');
					$datosproyecto->dialimite= $this->input->post('dialimite');
					$datosproyecto->porcentajemora= $this->input->post('porcentajemora');
					$datosproyecto->valortipocambio=$this->input->post('valortipocambio');
					$datosproyecto->finca= $this->input->post('finca');
					$datosproyecto->folio= $this->input->post('folio');
					$datosproyecto->libro= $this->input->post('libro');

					$datosproyecto->nombre_rep= $this->input->post('nombre_rep');
					$datosproyecto->fechanac_rep= $this->input->post('fechanac_rep');
					$datosproyecto->estadocivil_rep= $this->input->post('estadocivil_rep');
					$datosproyecto->dpi_rep= $this->input->post('dpi_rep');
					$datosproyecto->descripcion_rep= $this->input->post('descripcion_rep');
					$datosproyecto->nombreedificio= $this->input->post('nombreedificio');
					$datosproyecto->entidadvendedora= $this->input->post('entidadvendedora');
					$datosproyecto->notario= $this->input->post('notario');
					$datosproyecto->registro= $this->input->post('registro');
					$datosproyecto->folio_reg= $this->input->post('folio_reg');
					$datosproyecto->libro_reg= $this->input->post('libro_reg');
					$datosproyecto->fecha_reg= $this->input->post('fecha_reg');
					$datosproyecto->area= $this->input->post('area');
					$datosproyecto->direccion= $this->input->post('direccion');
					$datosproyecto->fechaactanotarial= $this->input->post('fechaactanotarial');

					$this->view_data['datosproyecto']=$datosproyecto;

                    if ($siactualizo)
                    {
                    	//$this->view_data['mensaje']="Registro actualizado !!!";
                    	//$this->view_data['tipoAlerta']="alert-success";
                    	redirect('catalogos/proyecto/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/proyectos/edit',$this->view_data);
                    }
                    //carga la vista.
                    
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($proyectoEliminar=-1)
 	{
 		$this->load->model('MProyecto');
		$sielimino=$this->MProyecto->borrar(array('idproyecto'=>$proyectoEliminar),$err);
                    
        if ($sielimino)
        {
        	redirect('catalogos/proyecto/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Listado de Proyectos';
		$this->view_data['activo']=  'proyectos';
		$this->load_partials();
        	
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/proyectos/listado',$this->view_data);
        }
			

	}
	//public function index($page=1)
	public function getProyectos()
	{
		//echo "hola controlador";
		//exit;
		//cargo el modelo de projects
		$this->load->model('MProyecto');
		//agrege los campos de orden y direccion
		$proyectos = $this->MProyecto->getProyectos();
		//print_r($bancos);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyectos));
	}

	public function getProyectosPorCliente($idcliente=-1)
	{
		$this->load->model('MProyecto');
		$proyectos = $this->MProyecto->getProyectosPorCliente($idcliente);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyectos));
	}

	//public function index($page=1)
	public function getProyecto($idproyecto=-1)
	{
		//cargo el modelo de projects
		$this->load->model('MProyecto');
		//agrege los campos de orden y direccion
		$proyecto = $this->MProyecto->getProyecto($idproyecto);
		//print_r($bancos);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($proyecto));
	}


	public function getTipoCambioDia($idproyecto)
	{
		$this->load->model('MProyecto');
		$tipo = $this->MProyecto->getTipoCambioDia($idproyecto);
				
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($tipo));

	}



}