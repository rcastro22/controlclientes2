<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inmueble extends MY_Controller
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
		$this->view_data['page_title']=  'Inmuebles';
		$this->view_data['activo']=  'inmueble';
		$this->load_partials();
		$this->load->view('catalogos/inmueble/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de inmueble';
    	$this->view_data['activo']=  'inmueble';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$datosinmueble = new stdClass();
				$this->view_data['datosinmueble']=$datosinmueble;

				$datosinmueble->idinmueble=$this->input->post('idinmueble');
				$datosinmueble->idproyecto=$this->input->post('idproyecto');
				$datosinmueble->idtipoinmueble=$this->input->post('idtipoinmueble');
				$datosinmueble->idmodelo=$this->input->post('idmodelo');
				$datosinmueble->tamano=$this->input->post('tamano');
				$datosinmueble->preciometro2=$this->input->post('preciometro2');
				$datosinmueble->dormitorios=$this->input->post('dormitorios');
				$datosinmueble->sotano=$this->input->post('sotano');
				$datosinmueble->finca=$this->input->post('finca');
				$datosinmueble->folio=$this->input->post('folio');
				$datosinmueble->libro=$this->input->post('libro');

				$this->load->view('catalogos/inmueble/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('idinmueble','Código inmueble','required');
				$this->form_validation->set_rules('proyectos','Código proyecto');
				$this->form_validation->set_rules('idtipoinmueble','Código tipo inmueble');
				$this->form_validation->set_rules('idmodelo','Código modelo');
				$this->form_validation->set_rules('tamano','Tamaño','numeric|required');
				$this->form_validation->set_rules('preciometro2','Precio Metro cuadrado','numeric|required');
				$this->form_validation->set_rules('dormitorios','Dormitorios','numeric|required');
				$this->form_validation->set_rules('sotano','Nivel','required|alphanumeric');
				$this->form_validation->set_rules('finca','Finca','required|numeric');
				$this->form_validation->set_rules('folio','Folio','required|numeric');
				$this->form_validation->set_rules('libro','Libro','required|numeric');
				if($this->form_validation->run()==FALSE)
				{
					$datosinmueble = new stdClass();	

					$datosinmueble->idinmueble=$this->input->post('idinmueble');
					$datosinmueble->idproyecto=$this->input->post('idproyecto');
					$datosinmueble->idtipoinmueble=$this->input->post('idtipoinmueble');
					$datosinmueble->idmodelo=$this->input->post('modelos');
					$datosinmueble->tamano=$this->input->post('tamano');
					$datosinmueble->preciometro2=$this->input->post('preciometro2');
					$datosinmueble->dormitorios=$this->input->post('dormitorios');
					$datosinmueble->sotano=$this->input->post('sotano');
					$datosinmueble->finca=$this->input->post('finca');
					$datosinmueble->folio=$this->input->post('folio');
					$datosinmueble->libro=$this->input->post('libro');

					$this->view_data['datosinmueble']=$datosinmueble;
					$this->load->view('catalogos/inmueble/nuevo',$this->view_data);
				}
				else
				{
					$this->load->model('minmueble');
					$inserto=$this->minmueble->grabar(array(
						   'idinmueble'=>$this->input->post('idinmueble'),
						   'idproyecto'=>$this->input->post('proyectos'),
						   'idtipoinmueble'=>($this->input->post('tiposinmueble')=="" ? 0 : $this->input->post('tiposinmueble')),
						   'idmodelo'=>$this->input->post('modelos'),
						   'tamano'=>($this->input->post('tamano')=="" ? 0 : $this->input->post('tamano')),
						   'preciometro2'=>($this->input->post('preciometro2')=="" ? 0 : $this->input->post('preciometro2')),
						   'dormitorios'=>($this->input->post('dormitorios')=="" ? 0 : $this->input->post('dormitorios')),
						   'sotano'=>$this->input->post('sotano'),
						   'finca'=>$this->input->post('finca'),
						   'folio'=>$this->input->post('folio'),
						   'libro'=>$this->input->post('libro'),
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
              		if($inserto)
					{
						$datosinmueble = new stdClass();	
						$datosinmueble->idinmueble="";
						$datosinmueble->idproyecto="";
						$datosinmueble->idtipoinmueble="";
						$datosinmueble->idmodelo="";
						$datosinmueble->tamano="";
						$datosinmueble->preciometro2="";
						$datosinmueble->dormitorios="";
						$datosinmueble->sotano="";
						$datosinmueble->finca="";
						$datosinmueble->folio="";
						$datosinmueble->libro="";
						$this->view_data['datosinmueble']=$datosinmueble;

						$this->view_data["nuevo"]="preguntar";
						$this->load->view('catalogos/inmueble/nuevo',$this->view_data);
						//redirect('catalogos/inmueble/listado');
					}
					else
                    {
                    	$err = "Es posible que el registro ya exista";

                    	$datosinmueble = new stdClass();	
						$datosinmueble->idinmueble=$this->input->post('idinmueble');
						$datosinmueble->idproyecto=$this->input->post('idproyecto');
						$datosinmueble->idtipoinmueble=$this->input->post('idtipoinmueble');
						$datosinmueble->idmodelo=$this->input->post('idmodelo');
						$datosinmueble->tamano=$this->input->post('tamano');
						$datosinmueble->preciometro2=$this->input->post('preciometro2');
						$datosinmueble->dormitorios=$this->input->post('dormitorios');
						$datosinmueble->sotano=$this->input->post('sotano');
						$datosinmueble->finca=$this->input->post('finca');
						$datosinmueble->folio=$this->input->post('folio');
						$datosinmueble->libro=$this->input->post('libro');
						$this->view_data['datosinmueble']=$datosinmueble;

                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/inmueble/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idinmueble=-1, $idproyecto=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de inmueble';
    	$this->view_data['activo']= 'inmueble';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('minmueble');
				$datosinmueble = $this->minmueble->getInmuebleId($idinmueble,$idproyecto);
        		$this->view_data['datosinmueble']=$datosinmueble;
				$this->load->view('catalogos/inmueble/edit',$this->view_data);
				break;
			case 'POST':
				$this->form_validation->set_rules('idinmueble','Código inmueble','required');
				$this->form_validation->set_rules('idproyecto','Código proyecto');
				$this->form_validation->set_rules('idtipoinmueble','Código tipo inmueble');
				$this->form_validation->set_rules('idmodelo','Código modelo');
				$this->form_validation->set_rules('tamano','Tamaño','numeric|required');
				$this->form_validation->set_rules('preciometro2','Precio metro cuadrado','numeric|required');
				$this->form_validation->set_rules('dormitorios','Dormitorios','numeric|required');
				$this->form_validation->set_rules('sotano','Sotano','required|alphanumeric');
				$this->form_validation->set_rules('finca','Finca','required|numeric');
				$this->form_validation->set_rules('folio','Folio','required|numeric');
				$this->form_validation->set_rules('libro','Libro','required|numeric');
				if($this->form_validation->run()==FALSE)
				{
					$datosinmueble = new stdClass();					
					$datosinmueble->idinmueble=$this->input->post('idinmueble');
					$datosinmueble->idproyecto=$this->input->post('idproyecto');
					$datosinmueble->idtipoinmueble=$this->input->post('idtipoinmueble');
					$datosinmueble->idmodelo=$this->input->post('idmodelo');
					$datosinmueble->tamano=$this->input->post('tamano');
					$datosinmueble->preciometro2=$this->input->post('preciometro2');
					$datosinmueble->dormitorios=$this->input->post('dormitorios');
					$datosinmueble->sotano=$this->input->post('sotano');
					$datosinmueble->finca=$this->input->post('finca');
					$datosinmueble->folio=$this->input->post('folio');
					$datosinmueble->libro=$this->input->post('libro');
					$this->view_data['datosinmueble']=$datosinmueble;
					$this->load->view('catalogos/inmueble/edit',$this->view_data);
				}
				else
				{
					$this->load->model('minmueble');
					$err="";
					$siactualizo=$this->minmueble->modificar($this->input->post('idinmueble'),$this->input->post('proyectos'),
						    array(
							   'idtipoinmueble'=>($this->input->post('tiposinmueble')=="" ? 0 : $this->input->post('tiposinmueble')),
							   'idmodelo'=>$this->input->post('modelos'),
							   'tamano'=>($this->input->post('tamano')=="" ? 0 : $this->input->post('tamano')),
							   'preciometro2'=>($this->input->post('preciometro2')=="" ? 0 : $this->input->post('preciometro2')),
							   'dormitorios'=>($this->input->post('dormitorios')=="" ? 0 : $this->input->post('dormitorios')),
							   'sotano'=>$this->input->post('sotano'),
							   'finca'=>$this->input->post('finca'),
						   		'folio'=>$this->input->post('folio'),
						   		'libro'=>$this->input->post('libro'),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
						        ),$err);
                    
                    $datosinmueble = new stdClass();					
					$datosinmueble->idinmueble=$this->input->post('idinmueble');
					$datosinmueble->idproyecto=$this->input->post('idproyecto');
					$datosinmueble->idtipoinmueble=$this->input->post('idtipoinmueble');
					$datosinmueble->idmodelo=$this->input->post('idmodelo');
					$datosinmueble->tamano=$this->input->post('tamano');
					$datosinmueble->tamano=$this->input->post('preciometro2');
					$datosinmueble->dormitorios=$this->input->post('dormitorios');
					$datosinmueble->sotano=$this->input->post('sotano');
					$datosinmueble->finca=$this->input->post('finca');
					$datosinmueble->folio=$this->input->post('folio');
					$datosinmueble->libro=$this->input->post('libro');
					$this->view_data['datosinmueble']=$datosinmueble;
                    if ($siactualizo)
                    {
                    	redirect('catalogos/inmueble/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/inmueble/edit',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($idinmueble=-1,$idproyecto=-1)
 	{
 		$this->load->model('minmueble');

 		$datosInmuebleEnUso = $this->minmueble->inmuebleEnUso($idinmueble,$idproyecto);
 		$idnegociacion = $datosInmuebleEnUso->idnegociacion;

 		if(!$idnegociacion)
 		{
			$sielimino=$this->minmueble->borrar(array('idinmueble'=>$idinmueble,'idproyecto'=>$idproyecto),$err);
	        

			if ($sielimino)
	        {
	        	redirect('catalogos/inmueble/listado');
	        }
	        else
	        {
	        	$this->view_data['page_title']=  'Inmuebles';
	    		$this->view_data['activo']= 'inmueble';
				$this->load_partials();
	        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
	            $this->view_data['tipoAlerta']="alert-danger";
	            $this->load->view('catalogos/inmueble/listado',$this->view_data);
	        }
    	}
    	else
    	{
			$this->view_data['page_title']=  'Inmuebles';
    		$this->view_data['activo']= 'inmueble';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: El inmueble se encuentra en uso en la negociación ".$idnegociacion;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/inmueble/listado',$this->view_data);		
    	}
	}
	
	//public function index($page=1)
	public function getInmueble()
	{
		$this->load->model('minmueble');
		$inmueble = $this->minmueble->getInmuebles();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($inmueble));
	}

	public function getInmuebleDisponible($idproyecto=-1)
	{
		$this->load->model('minmueble');
		$inmueble = $this->minmueble->getInmueblesDisponibles($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($inmueble));
	}

	public function getInmuebleId($idinmueble=-1)
	{
		$this->load->model('minmueble');
		$inmueble = $this->minmueble->getInmuebleIdResult($idinmueble);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($inmueble));
	}
}