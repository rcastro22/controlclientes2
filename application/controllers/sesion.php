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

	 public function crear(){
	 	$this->load->model('mproyecto');
		
		$listadoProyectos = $this->mproyecto->getProyectos();
		
		/*echo '<br><pre>';
			print_r($listadoProyectos);
		echo '</pre>';*/

		foreach ($listadoProyectos as $key => $proyecto) {
			//echo $proyecto->idproyecto.'<br>';
			//if ($key == 2){
			  $a = $this->enviarRecordatorio($proyecto->idproyecto);
			  echo $a.'<br>';
			 //}


		}//endforeach
		echo '<br><pre>';
			print_r($listadoProyectos);
		echo '</pre>';
		
		//mkdir("/opt/lampp/htdocs/controlclientes2/myDir".time(), 0777);
		//echo 'walter';
		//exit;
	}//end function crear()

	public function enviarRecordatorio($idproyecto)
	{
		$nuevolist = Array();
		//$nuevolist = Array(0 => (object)Array('id'=> '321313', 'username'=>'roberto'));
		//array_push($nuevolist, (object)Array('id'=> '321313', 'username'=>'roberto'));
		//array_push($nuevolist, (object)Array('id'=> '1434213', 'username'=>'antonio'));
		//$object = (object)$nuevolist;

		//print_r($nuevolist);

		//echo $object->username;
		$this->load->model('mcliente');
		$this->load->model('mnegociacion');
		$listadoClientes = $this->mcliente->getClientesPorProyecto($idproyecto);

		//print_r($listadoClientes);
		$contador = 0;
		$contadortotal = 0;
		$mensaje = "";
		
		foreach ($listadoClientes as $listCliente) {
			//echo $listCliente->idcliente." ";
			$listadoNegociaciones = $this->mnegociacion->getNegociacionesProyectoCliente($listCliente->idcliente,$idproyecto);
			foreach ($listadoNegociaciones as $listNegociacion) {
				//echo "->".$listNegociacion->idnegociacion." ";
				$contadortotal++;
				$mensaje = $this->enviarMail($listNegociacion->idnegociacion); 
				if($mensaje == ""){
					$contador++;
				}
				else{
					array_push($nuevolist, (object)Array('idcliente'=> $listCliente->idcliente, 'nombrecliente'=>$listCliente->nombre.' '.$listCliente->apellido, 'idnegociacion'=>$listNegociacion->idnegociacion, 'alerta'=>$mensaje));
				}
			}
		}
		//echo $contador;
		$this->view_data['page_title']=  'Recordatorio de pago';
		$this->view_data['activo']=  "recordatorio";
		$this->view_data['nuevolist'] = str_replace(array("\""), "'",json_encode($nuevolist));
		$this->view_data['mensaje']="Se han enviado correctamente la cantidad de ".$contador." de ".$contadortotal." correos electronicos. <br> Los correos no enviados se detallan a continuación";
	                    	$this->view_data['tipoAlerta']="alert-success";
		//$this->load_partials();
		//$this->load->view('movimientos/recordatoriopago/resultado',$this->view_data);
	    return $contador;

	}	


	public function enviarMail($idnegociacion)
   	{
	   	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	   	$this->load->model('mnegociacion');
	   	$datosmail = $this->mnegociacion->getDatosEmail($idnegociacion);
	   	$datospago = "";
	   	$email = "";
	   	$hayDatos = false;
	   	$proyecto = 0;
		$nombreProyecto = "";
		$textocorreo = "";  

	   	foreach ($datosmail as $datos) {
	   		$hayDatos = true;
	   		$email = $datos->email;
	   		$proyecto = $datos->idproyecto;
	   		$nombreProyecto = $datos->nombre;
			$textocorreo = $datos->textocorreo;

	   		switch ($proyecto) {
		   		case 1:
		   			$simboloMoneda = "$";
		   			break;
		   		case 5:
		   			$simboloMoneda = "Q";
		   			break;
		   		default:
		   			$simboloMoneda = "$";
		   			break;
		   	}

	   		//$datospago .= $simboloMoneda.number_format(($simboloMoneda=="$" ? $datos->pagocalculado : round($datos->pagocalculado * 7.7,2)),2,".",",")." correspodiente al mes de ".$meses[intval(Date('m',strtotime($datos->fechalimitepago)))-1]." ".Date('Y',strtotime($datos->fechalimitepago)).", ";

	   	}

	   	//if($hayDatos == false)
	   	//{
	   	//	return "No existen pagos pendietes a la fecha";
	   	//}

	   	if($email == "")
	   	{
	   		return "No existe correo electrónico configurado para envío de recordatorio";
	   	}

	   	if($hayDatos == true)
	   	{
		   	$emailReceptor=$email;
		   	$asunto="Recordatorio de pago";
		   	switch ($proyecto) {
		   		case 1:
		   			$cuentaDeposito = "en dólares: 270033640 a nombre de Herocha S.A.";
		   			break;
		   		case 5:
		   			$cuentaDeposito = "en quetzales: 270028996 a nombrbe de '13 avenida 11-55 zona 2, S.A.'";
		   			break;
		   		default:
		   			$cuentaDeposito = "en dólares: 270033640 a nombre de Herocha S.A.";
		   			break;
		   	}
		   	/*$mensaje=utf8_decode("Estimado cliente, le recordamos su pago de enganche de ".$datospago." agradecemos su colaboración para poder emitir el recibo
		   	          correspondiente, si usted ya realizó este pago, favor hacer caso omiso 
		   	          de este correo.
		   	         <br/><br/>
		   	          Cuenta No. 46-5001754-6 a nombre de Herocha S.A.");*/

		   	$mensaje="
<html>
<head>
  <title>Recordatorio de cumpleaños para Agosto</title>
</head>
<body>
	<table width='100%''>
		<tr>
			<th align='left'><IMG SRC='http://sistema.sursur.net/controlclientes/assets/img/logosur.jpg' WIDTH=60 HEIGHT=60 ALT='LogoSur'></th>
			<th align='right'><h2>Recordatorio de Pago</h2></th>
	    </tr>
	</table>
	<hr size=1 />
	<p>
		".$textocorreo."
	</p>
</body>
</html>
";
			$this->load->library("email");

			//configuracion para gmail
			$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'infosursur@gmail.com',
			'smtp_pass' => 'desarrolladorasur',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
			);    

			//cargamos la configuración para enviar con gmail
			$this->email->initialize($configGmail);



				$emailReceptor = 'correodewaltercorado@gmail.com';
			$this->email->from('infosursur@gmail.com');
			$this->email->to($emailReceptor);
			$this->email->subject($asunto);
			$this->email->message($mensaje);
			$this->email->send();
			
			


			return "";
		}

		
	}



}
