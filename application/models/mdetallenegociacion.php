<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdetallenegociacion extends CI_Model {

	public function getDetalleNegociacion($idnegociacion)
	{		
		$query = $this->db->query("select a.iddetallenegociacion,
							a.idnegociacion,
							a.idinmueble,    
				              c.[nombre] tipo,
				              d.[nombre] modelo,          
							a.valor
							from detallenegociacion a	
				              join inmueble b on b.[idinmueble] = a.[idinmueble] 
				              join tipoinmueble c on b.[idtipoinmueble] = c.[idtipoinmueble]
				              join modelo d on b.[idmodelo] = d.[idmodelo]		
				              join negociacion e on a.[idnegociacion] = e.[idnegociacion]			
							where b.[idproyecto] = e.[idproyecto] 
							and a.idnegociacion = ".$idnegociacion);
		return $query->result();
	}	

	public function grabar($data,$idnegociacion,&$err)
	{
		foreach($data as $equipo)
	 		{
	 			$this->db->insert("detallenegociacion",array(
					   'idnegociacion'=>$idnegociacion,
					   'idinmueble'=>$equipo->idinmueble,
					   'valor'=>$equipo->monto,
					   //'idinmueble'=>$equipo['idinmueble'],
					   //'valor'=>$equipo['monto'],
					   // Auditoria
					   'creadopor'=>$this->session->userdata('user_id'),
					   'fechacreado'=>date("Y-m-d H:i:s"),
					   'modificadopor'=>$this->session->userdata('user_id'),
					   'fechamodificado'=>date("Y-m-d H:i:s")));

	 			//aqui va cada insert del detalle.
 				//echo $equipo['Producto'];
		 	}

		//$this->db->insert("pago",$data);	
		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="")
		{
			return true;
		} 
		else
		{
			return false;
		}
	}

	public function borrar($idnegociacion,&$err)
	{
		$this->db->query("delete from detallenegociacion
							where idnegociacion = ".$idnegociacion);	
		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="")
		{
			return true;
		} 
		else
		{
			return false;
		}
	}

	// 05-08-2015, RC, Para la validacion de que no se guarde mas de una vez el mismo inmueble
	public function buscaInmuebleActivo($idinmueble)
	{		
		$query = $this->db->query("select *
								from detallenegociacion a
								join negociacion b on a.idnegociacion = b.idnegociacion
								where a.idinmueble = ".$idinmueble."
								and b.status = 'AC'");
		if($query->num_rows() > 0)
			return 1;
		else
			return 0;
	}
}