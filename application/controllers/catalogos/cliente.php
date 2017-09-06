<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
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
		$this->view_data['page_title']=  'Listado de Clientes';
		$this->view_data['activo']=  'proyectos';
		$this->load_partials();
		$this->load->view('catalogos/clientes/listado',$this->view_data);
	}
    
    public function nuevo()
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Creación de Clientes';
    	$this->view_data['activo']=  'clientes';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
			    $datosclientes = new stdClass();
			    $this->view_data['datosclientes']=$datosclientes;
			    $datosclientes->ClienteVendedorID= $this->input->post('vendedores');
			    $datosclientes->ClienteListaID=$this->input->post('listas');
				$this->load->view('catalogos/clientes/nuevo',$this->view_data);	
				break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('ClienteNombre','Nombre','required');
				$this->form_validation->set_rules('ClienteDireccion','Direccion','required');
				$this->form_validation->set_rules('ClienteNit','Nit','required');
				$this->form_validation->set_rules('ClienteSaldoInicial','Saldo Inicial');
				$this->form_validation->set_rules('ClienteCreditoLimite','Límite de Crédito','required|numeric');
				$this->form_validation->set_rules('ClienteCreditoDias','Días de Crédito','required|numeric');
				$this->form_validation->set_rules('ClienteTelefonos','Telefonos');
				$this->form_validation->set_rules('ClienteContacto','Contacto');
				$this->form_validation->set_rules('ClienteComision','Comisión');
				$this->form_validation->set_rules('ClienteListaID','Lista de precios');
				$this->form_validation->set_rules('ClienteEmail','Email');
				$this->form_validation->set_rules('ClienteObservaciones','Observaciones');
				$this->form_validation->set_rules('ClienteComision','Comisión');
				$this->form_validation->set_rules('ClienteStatus','Status');
				if($this->form_validation->run()==FALSE)
				{
					$datosclientes = new stdClass();
					$datosclientes->ClienteVendedorID= $this->input->post('vendedores');
					$datosclientes->ClienteListaID= $this->input->post('listas');
					$this->view_data['datosclientes']=$datosclientes;
					$this->load->view('catalogos/clientes/nuevo',$this->view_data);
				}
				else
				{
					$this->load->model('mcliente');
					$inserto=$this->mcliente->grabar(array(
						   'ClienteNombre'=>$this->input->post('ClienteNombre'),
						   'ClienteDireccion'=>$this->input->post('ClienteDireccion'),
						   'ClienteTelefonos'=>($this->input->post('ClienteTelefonos')=="" ? null : $this->input->post('ClienteTelefonos')),
						   'ClienteNit'=>$this->input->post('ClienteNit'),
						   'ClienteContacto'=>($this->input->post('ClienteContacto')=="" ? null : $this->input->post('ClienteContacto')),
						   'ClienteComision'=>($this->input->post('ClienteComision')=="" ? 0 : $this->input->post('ClienteComision')),
						   'ClienteSaldoInicial'=>$this->input->post('ClienteSaldoInicial'),
						   'ClienteCreditoLimite'=>$this->input->post('ClienteCreditoLimite'),
						   'ClienteCreditoDias'=>$this->input->post('ClienteCreditoDias'),
						   'ClienteStatus'=>($this->input->post('ClienteStatus')=="" ? 0 : $this->input->post('ClienteStatus')),
						   'ClienteListaID'=>$this->input->post('listas'),
						   'ClienteVendedorID'=>$this->input->post('vendedores'),
						   'ClienteEmail'=>($this->input->post('ClienteEmail')=="" ? null : $this->input->post('ClienteEmail')),
						   'ClienteObservaciones'=>($this->input->post('ClienteObservaciones')=="" ? null : $this->input->post('ClienteObservaciones')),
						   ),$err);
              		if($inserto)
					{
						redirect('catalogos/cliente/listado');
					}
					else
                    {
                    	$datosclientes = new stdClass();
						$datosclientes->ClienteVendedorID= $this->input->post('vendedores');
						$datosclientes->ClienteListaID= $this->input->post('listas');
						$this->view_data['datosclientes']=$datosclientes;
                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/clientes/nuevo',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }

	public function edit($clientenit=-1)
    {
    	$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Modificación de Clientes';
    	$this->view_data['activo']= 'clientes';
		$this->load_partials();
		switch ($method) 
		{
			case 'GET':
				$this->load->model('mcliente');
				$datoscliente = $this->mcliente->getCliente($clientenit);
        		$this->view_data['datoscliente']=$datoscliente;
				$this->load->view('catalogos/clientes/edit',$this->view_data);
				break;
			case 'POST':
				$this->form_validation->set_rules('ClienteNombre','Nombre','required');
				$this->form_validation->set_rules('ClienteDireccion','Direccion','required');
				$this->form_validation->set_rules('ClienteNit','Nit','required');
				$this->form_validation->set_rules('ClienteSaldoInicial','Saldo Inicial','required|numeric');
				$this->form_validation->set_rules('ClienteCreditoLimite','Límite de Crédito','required|numeric');
				$this->form_validation->set_rules('ClienteCreditoDias','Días de Crédito','required|numeric');
				$this->form_validation->set_rules('ClienteTelefonos','Telefonos');
				$this->form_validation->set_rules('ClienteContacto','Contacto');
				$this->form_validation->set_rules('ClienteComision','Comisión');
				$this->form_validation->set_rules('ClienteListaID','Lista de precios');
				$this->form_validation->set_rules('ClienteEmail','Email');
				$this->form_validation->set_rules('ClienteObservaciones','Observaciones');
				$this->form_validation->set_rules('ClienteStatus','Status');
				if($this->form_validation->run()==FALSE)
				{
					$datoscliente = new stdClass();
					$datoscliente->ClienteNombre= $this->input->post('ClienteNombre');
					$datoscliente->ClienteListaID= $this->input->post('listas');
					$datoscliente->ClienteVendedorID= $this->input->post('vendedores');
					$datoscliente->ClienteApellido= $this->input->post('ClienteApellido');
					$datoscliente->ClienteDireccion= $this->input->post('ClienteDireccion');
					$datoscliente->ClienteNit= $this->input->post('ClienteNit');
					$datoscliente->ClienteSaldoInicial= ($this->input->post('ClienteSaldoInicial')=="" ? null : $this->input->post('ClienteSaldoInicial'));
					$datoscliente->ClienteCreditoLimite= ($this->input->post('ClienteCreditoLimite')=="" ? null : $this->input->post('ClienteCreditoLimite'));
					$datoscliente->ClienteCreditoDias= ($this->input->post('ClienteCreditoDias')=="" ? null : $this->input->post('ClienteCreditoDias'));
					$datoscliente->ClienteTelefonos= $this->input->post('ClienteTelefonos');
					$datoscliente->ClienteContacto= $this->input->post('ClienteContacto');
					$datoscliente->ClienteComision= ($this->input->post('ClienteComision')=="" ? null : $this->input->post('ClienteComision'));
					$datoscliente->ClienteEmail= $this->input->post('ClienteEmail');
					$datoscliente->ClienteObservaciones= $this->input->post('ClienteObservaciones');
					$datoscliente->ClienteStatus= ($this->input->post('ClienteStatus')=="" ? null : $this->input->post('ClienteStatus'));
					$this->view_data['datoscliente']=$datoscliente;
					$this->load->view('catalogos/clientes/edit',$this->view_data);
				}
				else
				{
					$this->load->model('mcliente');
					$err="";
					$siactualizo=$this->mcliente->modificar($this->input->post('ClienteNit'),
						    array(
						   'ClienteNombre'=>$this->input->post('ClienteNombre'),
						   'ClienteDireccion'=>$this->input->post('ClienteDireccion'),
						   'ClienteTelefonos'=>$this->input->post('ClienteTelefonos'),
						   'ClienteContacto'=>$this->input->post('ClienteContacto'),
						   'ClienteVendedorID'=>$this->input->post('vendedores'),
						   'ClienteListaID'=>$this->input->post('listas'),
						   'ClienteComision'=>($this->input->post('ClienteComision')=="" ? null : $this->input->post('ClienteComision')),
						   'ClienteSaldoInicial'=>($this->input->post('ClienteSaldoInicial')=="" ? null : $this->input->post('ClienteSaldoInicial')),
						   'ClienteCreditoLimite'=>($this->input->post('ClienteCreditoLimite')=="" ? null : $this->input->post('ClienteCreditoLimite')),
						   'ClienteCreditoDias'=>($this->input->post('ClienteCreditoDias')=="" ? null : $this->input->post('ClienteCreditoDias')),
						   'ClienteStatus'=>($this->input->post('ClienteStatus')=="" ? null : $this->input->post('ClienteStatus')),
						   'ClienteEmail'=>$this->input->post('ClienteEmail'),
						   'ClienteObservaciones'=>$this->input->post('ClienteObservaciones')
						         ),$err);
                    
                    $datoscliente = new stdClass();
					$datoscliente->ClienteNombre= $this->input->post('ClienteNombre');
					$datoscliente->ClienteListaID= $this->input->post('listas');
					$datoscliente->ClienteVendedorID= $this->input->post('vendedores');
					$datoscliente->ClienteDireccion= $this->input->post('ClienteDireccion');
					$datoscliente->ClienteNit= $this->input->post('ClienteNit');
					$datoscliente->ClienteSaldoInicial= ($this->input->post('ClienteSaldoInicial')=="" ? null : $this->input->post('ClienteSaldoInicial'));
					$datoscliente->ClienteCreditoLimite= ($this->input->post('ClienteCreditoLimite')=="" ? null : $this->input->post('ClienteCreditoLimite'));
					$datoscliente->ClienteCreditoDias= ($this->input->post('ClienteCreditoDias')=="" ? null : $this->input->post('ClienteCreditoDias'));
					$datoscliente->ClienteTelefonos= $this->input->post('ClienteTelefonos');
					$datoscliente->ClienteContacto= $this->input->post('ClienteContacto');
					$datoscliente->ClienteComision= ($this->input->post('ClienteComision')=="" ? null : $this->input->post('ClienteComision'));
					$datoscliente->ClienteListaID= ($this->input->post('ClienteLista')=="" ? null : $this->input->post('ClienteLista'));
					$datoscliente->ClienteEmail= $this->input->post('ClienteEmail');
					$datoscliente->ClienteObservaciones= $this->input->post('ClienteObservaciones');
					$datoscliente->ClienteStatus= ($this->input->post('ClienteStatus')=="" ? null : $this->input->post('ClienteStatus'));
					$this->view_data['datoscliente']=$datoscliente;
                    if ($siactualizo)
                    {
                    	redirect('catalogos/cliente/listado');
                    }
                    else
                    {
                    	$this->view_data['mensaje']="Error: No se pudo actualizar el registro ".$err;
                    	$this->view_data['tipoAlerta']="alert-danger";
                    	$this->load->view('catalogos/clientes/edit',$this->view_data);
                    }
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
    }


	public function borrar($clienteEliminar=-1)
 	{
 		$this->load->model('MCliente');
		$sielimino=$this->MCliente->borrar(array('ClienteNit'=>$clienteEliminar),$err);
        

		if ($sielimino)
        {
        	redirect('catalogos/cliente/listado');
        }
        else
        {
        	$this->view_data['page_title']=  'Listado de Clientes';
    		$this->view_data['activo']= 'clientes';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->load->view('catalogos/clientes/listado',$this->view_data);
        }
	}
	
	//public function index($page=1)
	public function getClientes()
	{
		$this->load->model('mcliente');
		$clientes = $this->mcliente->getClientes();	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($clientes));
	}
}