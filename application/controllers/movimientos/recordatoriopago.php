<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class recordatoriopago extends MY_Controller
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
			$this->load->model('musuarioadmin');
			$datosusuario = $this->musuarioadmin->getUsuarioLogin($this->session->userdata('user_id'));

			$this->view_data['usuario']= $this->session->userdata('user_id');
			$this->view_data['datosusuario'] = $datosusuario;
		}

	}

	public function listado()
	{
		$this->view_data['page_title']=  'Recordatorio de pago';
		$this->view_data['activo']=  'recordatorio';
		$this->load_partials();
		$this->load->view('movimientos/recordatoriopago/listado',$this->view_data);
	}

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
		$this->load_partials();
		$this->load->view('movimientos/recordatoriopago/resultado',$this->view_data);
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

	   	foreach ($datosmail as $datos) {
	   		$hayDatos = true;
	   		$email = $datos->email;
	   		$proyecto = $datos->idproyecto;
	   		$nombreProyecto = $datos->nombre;

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
		Estimado cliente, el presente se le envía con el fin de recordarle el pago de su cuota correspondiente al enganche del proyecto ".$nombreProyecto.".
		<br/><br/>
		Le rogamos realizar el pago antes del 5 de cada mes.
		<br/><br/>
		Si usted ya hizo su pago, favor hacer caso omiso a este correo.
		<br/><br/>
		Nuestra satisfacción es nuestro compromiso.  Muchas gracias por la atención al mismo.
		<br/><br/>
		Banco Industrial
		<br/>
		Cuenta ".$cuentaDeposito."
	</p>
	<hr size=1 />
	<p>
		Si usted ya realizó este pago, favor hacer caso omiso de este correo.
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




			$this->email->from('infosursur@gmail.com');
			$this->email->to($emailReceptor);
			$this->email->subject($asunto);
			$this->email->message($mensaje);
			$this->email->send();


			return "";
		}

		
	}
}