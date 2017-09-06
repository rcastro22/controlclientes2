<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cliente extends MY_Controller
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
		$this->view_data['page_title']=  'Clientes';
		$this->view_data['activo']=  'clientes';
		$this->load_partials();
		$this->load->view('movimientos/clientes/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de clientes';
    	$this->view_data['activo']=  'clientes';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$datoscliente = new stdClass();
				$this->view_data['datoscliente']=$datoscliente;

				$datoscliente->idcliente=$this->input->post('idcliente');
				$datoscliente->nombre=$this->input->post('nombre');
				$datoscliente->apellido=$this->input->post('apellido');
				$datoscliente->idtipoidentificacion=$this->input->post('tipoidentificaciones');
				$datoscliente->dpi=$this->input->post('dpi');
				$datoscliente->fecnacimiento=$this->input->post('fecnacimiento');
				$datoscliente->profesion=$this->input->post('profesion');
				$datoscliente->nacionalidad=$this->input->post('nacionalidad');
				$datoscliente->estadocivil=$this->input->post('estadocivil');
				$datoscliente->dirresidencia=$this->input->post('dirresidencia');
				$datoscliente->telefono=$this->input->post('telefono');
				$datoscliente->celular=$this->input->post('celular');
				$datoscliente->nit=$this->input->post('nit');
				$datoscliente->correo=$this->input->post('correo');
				$datoscliente->lugartrabajo=$this->input->post('lugartrabajo');
				$datoscliente->dirtrabajo=$this->input->post('dirtrabajo');
				$datoscliente->tiempolabor=$this->input->post('tiempolabor');
				$datoscliente->ingresos=$this->input->post('ingresos');
				$datoscliente->puesto=$this->input->post('puesto');
				$datoscliente->otrosingresos=$this->input->post('otrosingresos');
				$datoscliente->concepto=$this->input->post('concepto');

				$this->load->view('movimientos/clientes/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('nombre','Nombre','required');
				$this->form_validation->set_rules('apellido','Apellido','required');
				$this->form_validation->set_rules('tipoidentificaciones','Tipo Identificación');
				$this->form_validation->set_rules('dpi','DPI','required|numeric|min_length[13]|max_length[13]');
				$this->form_validation->set_rules('fecnacimiento','Fecha de nacimiento','required');
				$this->form_validation->set_rules('profesion','Profesión','required');
				$this->form_validation->set_rules('nacionalidad','Nacionalidad','required');
				$this->form_validation->set_rules('estadocivil','Estado civil');
				$this->form_validation->set_rules('dirresidencia','Dirección de residencia','required');
				$this->form_validation->set_rules('telefono','Telefono','required');
				$this->form_validation->set_rules('celular','Celular','required');
				$this->form_validation->set_rules('nit','Nit','required');
				$this->form_validation->set_rules('correo','Correo electrónico','valid_email');
				$this->form_validation->set_rules('lugartrabajo','Lugar de trabajo','required');
				$this->form_validation->set_rules('dirtrabajo','Dirección de trabajo','required');
				$this->form_validation->set_rules('tiempolabor','Tiempo de laborar');
				$this->form_validation->set_rules('ingresos','Ingresos');
				$this->form_validation->set_rules('puesto','Puesto');
				$this->form_validation->set_rules('otrosingresos','Otros ingresos');
				$this->form_validation->set_rules('concepto','Concepto');
				if($this->form_validation->run()==FALSE)
				{
					$datoscliente = new stdClass();	

					$datoscliente->nombre=$this->input->post('nombre');
					$datoscliente->apellido=$this->input->post('apellido');
					$datoscliente->idtipoidentificacion=$this->input->post('tipoidentificaciones');
					$datoscliente->dpi=$this->input->post('dpi');
					$datoscliente->fecnacimiento=$this->input->post('fecnacimiento');
					$datoscliente->profesion=$this->input->post('profesion');
					$datoscliente->nacionalidad=$this->input->post('nacionalidad');
					$datoscliente->estadocivil=$this->input->post('estadocivil');
					$datoscliente->dirresidencia=$this->input->post('dirresidencia');
					$datoscliente->telefono=$this->input->post('telefono');
					$datoscliente->celular=$this->input->post('celular');
					$datoscliente->nit=$this->input->post('nit');
					$datoscliente->correo=$this->input->post('correo');
					$datoscliente->lugartrabajo=$this->input->post('lugartrabajo');
					$datoscliente->dirtrabajo=$this->input->post('dirtrabajo');
					$datoscliente->tiempolabor=$this->input->post('tiempolabor');
					$datoscliente->ingresos=$this->input->post('ingresos');
					$datoscliente->puesto=$this->input->post('puesto');
					$datoscliente->otrosingresos=$this->input->post('otrosingresos');
					$datoscliente->concepto=$this->input->post('concepto');

					$this->view_data['datoscliente']=$datoscliente;
					$this->load->view('movimientos/clientes/nuevo',$this->view_data);
				}
				else
				{
					$this->load->model('mcliente');
					$inserto=$this->mcliente->grabar(array(
						   'nombre'=>$this->input->post('nombre'),
						   'apellido'=>$this->input->post('apellido'),
						   'idtipoidentificacion'=>$this->input->post('tipoidentificaciones'),
						   'dpi'=>$this->input->post('dpi'),
						   'fecnacimiento'=>date('Y-m-d',strtotime($this->input->post('fecnacimiento'))),
						   'profesion'=>$this->input->post('profesion'),
						   'nacionalidad'=>$this->input->post('nacionalidad'),
						   'estadocivil'=>$this->input->post('estadocivil'),
						   'dirresidencia'=>$this->input->post('dirresidencia'),
						   'telefono'=>$this->input->post('telefono'),
						   'celular'=>$this->input->post('celular'),
						   'nit'=>$this->input->post('nit'),
						   'email'=>$this->input->post('correo'),
						   'lugartrabajo'=>$this->input->post('lugartrabajo'),
						   'dirtrabajo'=>$this->input->post('dirtrabajo'),
						   'tiempolabor'=>$this->input->post('tiempolabor'),
						   'ingresos'=>$this->input->post('ingresos'),
						   'puesto'=>$this->input->post('puesto'),
						   'otrosingresos'=>$this->input->post('otrosingresos'),
						   'concepto'=>$this->input->post('concepto'),
						   //Auditoria
						   'CreadoPor'=>$this->session->userdata('user_id'),
						   'FechaCreado'=>date("Y-m-d H:i:s"),
						   'ModificadoPor'=>$this->session->userdata('user_id'),
						   'FechaModificado'=>date("Y-m-d H:i:s")
						   ),$err);
              		if($inserto)
					{
						redirect('movimientos/cliente/listado');
					}
					else
                    {
                    	$datoscliente = new stdClass();	
						
						$datoscliente->nombre=$this->input->post('nombre');
						$datoscliente->apellido=$this->input->post('apellido');
						$datoscliente->idtipoidentificacion=$this->input->post('tipoidentificaciones');
						$datoscliente->dpi=$this->input->post('dpi');
						$datoscliente->fecnacimiento=$this->input->post('fecnacimiento');
						$datoscliente->profesion=$this->input->post('profesion');
						$datoscliente->nacionalidad=$this->input->post('nacionalidad');
						$datoscliente->estadocivil=$this->input->post('estadocivil');
						$datoscliente->dirresidencia=$this->input->post('dirresidencia');
						$datoscliente->telefono=$this->input->post('telefono');
						$datoscliente->celular=$this->input->post('celular');
						$datoscliente->nit=$this->input->post('nit');
						$datoscliente->correo=$this->input->post('correo');
						$datoscliente->lugartrabajo=$this->input->post('lugartrabajo');
						$datoscliente->dirtrabajo=$this->input->post('dirtrabajo');
						$datoscliente->tiempolabor=$this->input->post('tiempolabor');
						$datoscliente->ingresos=$this->input->post('ingresos');
						$datoscliente->puesto=$this->input->post('puesto');
						$datoscliente->otrosingresos=$this->input->post('otrosingresos');
						$datoscliente->concepto=$this->input->post('concepto');
						$this->view_data['datoscliente']=$datoscliente;

                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('movimientos/clientes/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($idcliente=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de cliente';
    	$this->view_data['activo']= 'clientes';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('mcliente');
				$datoscliente = $this->mcliente->getClienteId($idcliente);
        		$this->view_data['datoscliente']=$datoscliente;
				$this->load->view('movimientos/clientes/edit',$this->view_data);
				break;
			case 'POST':
				$this->form_validation->set_rules('nombre','Nombre','required');
				$this->form_validation->set_rules('apellido','Apellido','required');
				$this->form_validation->set_rules('tipoidentificaciones','Tipo Identificación');
				$this->form_validation->set_rules('dpi','DPI','required|numeric|min_length[13]|max_length[13]');
				$this->form_validation->set_rules('fecnacimiento','Fecha de nacimiento','required');
				$this->form_validation->set_rules('profesion','Profesión','required');
				$this->form_validation->set_rules('nacionalidad','Nacionalidad','required');
				$this->form_validation->set_rules('estadocivil','Estado civil');
				$this->form_validation->set_rules('dirresidencia','Dirección de residencia','required');
				$this->form_validation->set_rules('telefono','Telefono','required');
				$this->form_validation->set_rules('celular','Celular','required');
				$this->form_validation->set_rules('nit','Nit','required');
				$this->form_validation->set_rules('correo','Correo electrónico','valid_email');
				$this->form_validation->set_rules('lugartrabajo','Lugar de trabajo','required');
				$this->form_validation->set_rules('dirtrabajo','Dirección de trabajo','required');
				$this->form_validation->set_rules('tiempolabor','Tiempo de laborar');
				$this->form_validation->set_rules('ingresos','Ingresos');
				$this->form_validation->set_rules('puesto','Puesto');
				$this->form_validation->set_rules('otrosingresos','Otros ingresos');
				$this->form_validation->set_rules('concepto','Concepto');
				if($this->form_validation->run()==FALSE)
				{
					$datoscliente = new stdClass();					
					$datoscliente->idcliente=$this->input->post('idcliente');
					$datoscliente->nombre=$this->input->post('nombre');
					$datoscliente->apellido=$this->input->post('apellido');
					$datoscliente->idtipoidentificacion=$this->input->post('tipoidentificaciones');
					$datoscliente->dpi=$this->input->post('dpi');
					$datoscliente->fecnacimiento=$this->input->post('fecnacimiento');
					$datoscliente->profesion=$this->input->post('profesion');
					$datoscliente->nacionalidad=$this->input->post('nacionalidad');
					$datoscliente->estadocivil=$this->input->post('estadocivil');
					$datoscliente->dirresidencia=$this->input->post('dirresidencia');
					$datoscliente->telefono=$this->input->post('telefono');
					$datoscliente->celular=$this->input->post('celular');
					$datoscliente->nit=$this->input->post('nit');
					$datoscliente->correo=$this->input->post('correo');
					$datoscliente->lugartrabajo=$this->input->post('lugartrabajo');
					$datoscliente->dirtrabajo=$this->input->post('dirtrabajo');
					$datoscliente->tiempolabor=$this->input->post('tiempolabor');
					$datoscliente->ingresos=$this->input->post('ingresos');
					$datoscliente->puesto=$this->input->post('puesto');
					$datoscliente->otrosingresos=$this->input->post('otrosingresos');
					$datoscliente->concepto=$this->input->post('concepto');
					$this->view_data['datoscliente']=$datoscliente;
					$this->load->view('movimientos/clientes/edit',$this->view_data);
				}
				else
				{
					$this->load->model('mcliente');
					$err="";
					$siactualizo=$this->mcliente->modificar($this->input->post('idcliente'),
						    array(
							   'nombre'=>$this->input->post('nombre'),
							   'apellido'=>$this->input->post('apellido'),
							   'idtipoidentificacion'=>$this->input->post('tipoidentificaciones'),
							   'dpi'=>$this->input->post('dpi'),
							   'fecnacimiento'=>date('Y-m-d',strtotime($this->input->post('fecnacimiento'))),
							   'profesion'=>$this->input->post('profesion'),
							   'nacionalidad'=>$this->input->post('nacionalidad'),
							   'estadocivil'=>$this->input->post('estadocivil'),
							   'dirresidencia'=>$this->input->post('dirresidencia'),
							   'telefono'=>$this->input->post('telefono'),
							   'celular'=>$this->input->post('celular'),
							   'nit'=>$this->input->post('nit'),
							   'email'=>$this->input->post('correo'),
							   'lugartrabajo'=>$this->input->post('lugartrabajo'),
							   'dirtrabajo'=>$this->input->post('dirtrabajo'),
							   'tiempolabor'=>$this->input->post('tiempolabor'),
							   'ingresos'=>$this->input->post('ingresos'),
							   'puesto'=>$this->input->post('puesto'),
							   'otrosingresos'=>$this->input->post('otrosingresos'),
							   'concepto'=>$this->input->post('concepto'),
							   // Auditoria
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
						        ),$err);
                    
                    $datoscliente = new stdClass();					
					$datoscliente->nombre=$this->input->post('nombre');
					$datoscliente->apellido=$this->input->post('apellido');
					$datoscliente->idtipoidentificacion=$this->input->post('tipoidentificaciones');
					$datoscliente->dpi=$this->input->post('dpi');
					$datoscliente->fecnacimiento=$this->input->post('fecnacimiento');
					$datoscliente->profesion=$this->input->post('profesion');
					$datoscliente->nacionalidad=$this->input->post('nacionalidad');
					$datoscliente->estadocivil=$this->input->post('estadocivil');
					$datoscliente->dirresidencia=$this->input->post('dirresidencia');
					$datoscliente->telefono=$this->input->post('telefono');
					$datoscliente->celular=$this->input->post('celular');
					$datoscliente->nit=$this->input->post('nit');
					$datoscliente->correo=$this->input->post('correo');
					$datoscliente->lugartrabajo=$this->input->post('lugartrabajo');
					$datoscliente->dirtrabajo=$this->input->post('dirtrabajo');
					$datoscliente->tiempolabor=$this->input->post('tiempolabor');
					$datoscliente->ingresos=$this->input->post('ingresos');
					$datoscliente->puesto=$this->input->post('puesto');
					$datoscliente->otrosingresos=$this->input->post('otrosingresos');
					$datoscliente->concepto=$this->input->post('concepto');
					$this->view_data['datoscliente']=$datoscliente;
                    if ($siactualizo)
                    {
                    	redirect('movimientos/cliente/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('movimientos/clientes/edit',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($idcliente=-1)
 	{
 		$this->load->model('mcliente');
		$sielimino=$this->mcliente->borrar(array('idcliente'=>$idcliente),$err);
        

		if ($sielimino)
        {
        	redirect('movimientos/cliente/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Clientes';
    		$this->view_data['activo']= 'clientes';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('movimientos/clientes/listado',$this->view_data);
        }
	}
	
	//public function index($page=1)
	public function getCliente()
	{
		$this->load->model('mcliente');
		$cliente = $this->mcliente->getClientes();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($cliente));
	}

	public function getClientePorProyecto($idproyecto=-1)
	{
		$this->load->model('mcliente');
		$clientes = $this->mcliente->getClientesPorProyecto($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($clientes));
	}
}