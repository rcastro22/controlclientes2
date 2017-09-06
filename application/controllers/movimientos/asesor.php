<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asesor extends MY_Controller
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
		$this->view_data['page_title']=  'Listado Asesores';
		$this->view_data['activo']=  'asesores';
		$this->load_partials();
		$this->load->view('movimientos/asesores/listado',$this->view_data);
	}
    
    //public function index($page=1)
	public function getNegociacionesAsesores($idproyecto=-1)
	{
		$this->load->model('masesor');
		$asesor = $this->masesor->getNegociacionesAsesores($idproyecto);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($asesor));
	}

	public function pagos($idnegociacion=-1)
	{
		$this->view_data['page_title']=  'Pagos de comisión';
		$this->view_data['activo']=  'asesores';
		$this->view_data['idnegociacion']=  $idnegociacion;
		
		$this->load_partials();
		$this->load->view('movimientos/asesores/pagos',$this->view_data);

	}
	
	public function getPagosAsesor($idnegociacion=-1)
	{
		$this->load->model('masesor');
		$asesor = $this->masesor->getPagosAsesor($idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($asesor));
	}

	public function getDatosNegociacion($idnegociacion=-1)
	{
		$this->load->model('masesor');
		$asesor = $this->masesor->getDatosNegociacion($idnegociacion);	
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($asesor));
	}

	public function grabarComision()
	{
		$method = $this->input->server('REQUEST_METHOD');
    	$this->view_data['page_title']=  'Pagos de comisión';
    	$this->view_data['activo']=  'asesor';
		$this->load_partials();
		switch ($method) 
		{
			//case 'GET':
			//	$this->load->view('catalogos/asesor/nuevo',$this->view_data);	
			//	break;
			case 'POST':  //aqui entra cuando le clic al boton
				$this->form_validation->set_rules('nomproyecto','Proyecto','required');
				$this->form_validation->set_rules('nomasesor','Asesor','required');
				$this->form_validation->set_rules('idinmueble','Inmueble','required');
				$this->form_validation->set_rules('dpfechapago','Fecha de pago','required');
				$this->form_validation->set_rules('noserie','Número de serie','required');
				$this->form_validation->set_rules('nofactura','Número de factura','required');
				$this->form_validation->set_rules('monto','monto','required|numeric');

				if($this->form_validation->run()==FALSE)
				{
					//echo "error 1";
					//exit;
					$this->view_data['idnegociacion']=$this->input->post('idnegociacion');
				    $this->load->view('movimientos/asesores/pagos',$this->view_data);
					//redirect('movimientos/asesor/pagos/1');
				}

				else
				{
					$varTotalComision=$this->input->post('totalcomision');
					$varTotalPagado  =$this->input->post('totalpagado');
					$varMonto =$this->input->post('monto');
					$varStatus = $this->input->post('status');
					//echo $varTotalPagado+$varMonto;
					//echo $varTotalComision;
					//exit;
					if($varStatus=='AC')
					{
						if(($varTotalPagado+$varMonto)>$varTotalComision)
						{
							$this->view_data['page_title']=  'Pagos de comisión';
	    					$this->view_data['activo']= 'asesor';
							$this->load_partials();
	                    	$this->view_data['mensaje']="Error: El monto sobre pasa la cantidad total de la comisión: ";
	                    	$this->view_data['tipoAlerta']="alert-danger";
	                    	$this->view_data['idnegociacion']=$this->input->post('idnegociacion');
					    	$this->load->view('movimientos/asesores/pagos',$this->view_data);	
						}
						else
						{
							$this->load->model('masesor');
							$inserto=$this->masesor->grabarComision(array(
							   'idnegociacion'=>$this->input->post('idnegociacion'),
							   'idasesor'=>$this->input->post('idasesor'),
							   'fechapago'=>$this->input->post('dpfechapago'),
							   'noserie'=>$this->input->post('noserie'),
							   'nofactura'=>$this->input->post('nofactura'),
							   'monto'=>$this->input->post('monto'),
							   'CreadoPor'=>$this->session->userdata('user_id'),
							   'FechaCreado'=>date("Y-m-d H:i:s"),
							   'ModificadoPor'=>$this->session->userdata('user_id'),
							   'FechaModificado'=>date("Y-m-d H:i:s")
							   ),$err);
	              			if($inserto)
							{
								$this->view_data['page_title']=  'Pagos de comisión';
	    						$this->view_data['activo']= 'asesor';
								$this->load_partials();
	        					$this->view_data['idnegociacion']=$this->input->post('idnegociacion');
	        					$this->view_data['varinserto']='1';
								$this->load->view('movimientos/asesores/pagos',$this->view_data);
							}
							else
	                    	{
		                    	$this->view_data['page_title']=  'Pagos de comisión';
		    					$this->view_data['activo']= 'asesor';
								$this->load_partials();
		                    	$this->view_data['mensaje']="Error: No se pudo insertar el registro: ".$err;
		                    	$this->view_data['tipoAlerta']="alert-danger";
		                    	$this->load->view('movimientos/asesores/pagos/'+$this->input->post('idnegociacion'),$this->view_data);
	                    	}	
						}
					}
					else
					{
						$this->view_data['page_title']=  'Pagos de comisión';
	    				$this->view_data['activo']= 'asesor';
						$this->load_partials();
	                    $this->view_data['mensaje']="Error: la negociación esta resindida por lo cual no puede efectuar pagos. ";
	                    $this->view_data['tipoAlerta']="alert-danger";
	                    $this->view_data['idnegociacion']=$this->input->post('idnegociacion');
					    $this->load->view('movimientos/asesores/pagos',$this->view_data);	
					}
					
				}
				break;
			default:
				die("Invalid Method");
				break;
		}
	}
	

	public function eliminarComision($idcorrelativo=-1,$idnegociacion=-1)
 	{
 		$this->load->model('masesor');
		$sielimino=$this->masesor->EliminarComision(array('idcorrelativo'=>$idcorrelativo),$err);
        

		if ($sielimino)
        {
        	$this->view_data['page_title']=  'Pagos de comisión';
    		$this->view_data['activo']= 'asesor';
			$this->load_partials();
        	$this->view_data['idnegociacion']=$idnegociacion;
			$this->load->view('movimientos/asesores/pagos',$this->view_data);
        }
        else
        {
        	$this->view_data['page_title']=  'Pagos de comisión';
    		$this->view_data['activo']= 'asesor';
			$this->load_partials();
        	$this->view_data['mensaje']="Error: No se pudo eliminar el registro: ".$err;
            $this->view_data['tipoAlerta']="alert-danger";
            $this->view_data['idnegociacion']=$idnegociacion;
			$this->load->view('movimientos/asesores/pagos',$this->view_data);
        }
	}

}