<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//aqui quite que extendiera de CI_Controller y ahora
//le pongo de mi controlador MY_Controller
class edocta extends MY_Controller
{
	//http://localhost/controlclientes/ws/edocta/proyectos
	public function proyectos()
	{
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			// Get data
			$usuario = isset($_POST['usuario']) ? mysql_real_escape_string($_POST['usuario']) : "";
			//$email = isset($_POST['email']) ? mysql_real_escape_string($_POST['email']) : "";
			//$password = isset($_POST['pwd']) ? mysql_real_escape_string($_POST['pwd']) : "";
			//$status = isset($_POST['status']) ? mysql_real_escape_string($_POST['status']) : "";

			

			$json = array("status" => 1, "msg" => "Done User added!".$usuario);
	
				header('Content-type: application/json');
				echo json_encode($json);
				exit;

		}
	}
	/*public function prueba1()
	{
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			// Get data
			$name = isset($_POST['name']) ? mysql_real_escape_string($_POST['name']) : "";
			$email = isset($_POST['email']) ? mysql_real_escape_string($_POST['email']) : "";
			$password = isset($_POST['pwd']) ? mysql_real_escape_string($_POST['pwd']) : "";
			$status = isset($_POST['status']) ? mysql_real_escape_string($_POST['status']) : "";

			

			$json = array("status" => 1, "msg" => "Done User added!");
	
				header('Content-type: application/json');
				echo json_encode($json);

		}
	}*/
}