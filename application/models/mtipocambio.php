<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoCambio extends CI_Model {


	
	//trae datos del banco recibido pro parametro
	public function getTipoCambioDia()
	{		

		/*$txtQuery="select a.valor
				from tipocambio a
				where date(a.fecha)=date('now')";*/

		$txtQuery="select a.valor
					from tipocambio a
					order by a.fecha desc 
					limit 1";


        $query= $this->db->query($txtQuery);
        return $query->result();
	}
	
	public function grabar($data,&$err)
	{

		//graba el arreglo en la base de datos
		//banco es la tabla y $data el arreglo de campos

		$this->db->insert("tipocambio",$data);

		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="")
		{
			return true;
			//return $this->db->insert_id();
		} 
		else
		{
			return false;
		}
	}

}