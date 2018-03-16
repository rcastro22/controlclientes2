<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class meconsulta extends CI_Model {

	public function execQ($consulta)
	{		
		$this->db->simple_query($consulta);
	}

}