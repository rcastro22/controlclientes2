<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class mword extends CI_Model {



	public function getContratoReserva($idnegociacion)

	{		

		$query = $this->db->query("select
									    c.[nombre]       
									    ,c.[apellido]     
									    ,c.[fecnacimiento]    
									    ,case 
									          when c.[estadocivil] = 'C' then 'Casado' 
									          when c.[estadocivil] = 'S' then 'Soltero'           
									          else 'Soltero'
									    end estadocivil
									    ,c.[profesion]    
									    ,c.[nacionalidad]    
									    ,c.[dirresidencia]    
									    ,c.[dpi]
									    ,c.[email]
									    ,c.[nit]
									    ,c.[celular]
									    ,c.[telefono]
									    ,c.[lugartrabajo]
									    ,c.[tiempolabor]
									    ,c.[dirtrabajo]
									    ,c.[puesto]
									    ,c.[ingresos]
									    ,c.[otrosingresos]
									    ,n.[clientejuridico]                      
					                    ,n.[especifiquejuridico]                      
					                    ,n.[nombramientojuridico]
					                    ,n.[fechanombramiento]
							            ,n.[notarionombramiento]
							            ,n.[registro]
							            ,n.[folio]
							            ,n.[libro]
							            ,n.[nitjuridico]
					                    ,n.[monedacontrato]            
                      					,n.[enganche]
                      					,n.[precioventa]
                      					,n.[tipocambioneg]
                      					,n.[reserva]
                      					,n.[financiamientobanco]
                      					,n.[nocuotas]
                      					,n.[idformapago]
                      					,p.[nombre] proyecto
									from 
									    cliente c
									    ,negociacion n
									    ,proyecto p
									where 
									    c.[idcliente] = n.[idcliente]       
									    and n.[idnegociacion] = $idnegociacion
									    and p.idproyecto = n.idproyecto");
		return $query->result();
	}

	public function getContratoReservaTemporal($idnegociacion)

	{		

		$query = $this->db->query("select
									    c.[nombre]       
									    ,c.[apellido]     
									    ,c.[fecnacimiento]    
									    ,case 
									          when c.[estadocivil] = 'C' then 'Casado' 
									          when c.[estadocivil] = 'S' then 'Soltero'           
									          else 'Soltero'
									    end estadocivil
									    ,c.[profesion]    
									    ,c.[nacionalidad]    
									    ,c.[dirresidencia]    
									    ,c.[dpi]
									    ,c.[email]
									    ,c.[nit]
									    ,c.[celular]
									    ,c.[telefono]
									    ,c.[lugartrabajo]
									    ,c.[tiempolabor]
									    ,c.[dirtrabajo]
									    ,c.[puesto]
									    ,c.[ingresos]
									    ,c.[otrosingresos]
									    ,n.[clientejuridico]                      
					                    ,n.[especifiquejuridico]                      
					                    ,n.[nombramientojuridico]
					                    ,n.[fechanombramiento]
							            ,n.[notarionombramiento]
							            ,n.[registro]
							            ,n.[folio]
							            ,n.[libro]
							            ,n.[nitjuridico]
					                    ,n.[monedacontrato]            
                      					,n.[enganche]
                      					,n.[precioventa]
                      					,n.[tipocambioneg]
                      					,n.[reserva]
                      					,n.[financiamientobanco]
                      					,n.[nocuotas]
                      					,n.[idformapago]
                      					,p.[nombre] proyecto
									from 
									    clientetemporal c
									    ,negociacion n
									    ,proyecto p
									where 
									    c.[idnegociacion] = n.[idnegociacion]       
									    and n.[idnegociacion] = $idnegociacion
									    and p.idproyecto = n.idproyecto");
		return $query->result();
	}

	public function getContratoReservaInmueble($idnegociacion)
	{		
		$query = $this->db->query("
select
i.[idinmueble]
,ti.[nombre]
,i.[tamano]
from
negociacion n
,detallenegociacion dn
,inmueble i
,tipoinmueble ti
where
n.[idnegociacion] = dn.[idnegociacion]
and dn.[idinmueble] = i.[idinmueble]
and n.[idproyecto] = i.[idproyecto]
and i.[idtipoinmueble] = ti.[idtipoinmueble]
and n.[idnegociacion] = $idnegociacion");
		return $query->row();
	}


	public function getContratoReservaOtrCompradores($idnegociacion)
	{		
		$query = $this->db->query("select
									    c.[nombre]       
									    ,c.[apellido]     
									    ,c.[fecnacimiento]    
									    ,case 
									          when c.[estadocivil] = 'C' then 'Casado' 
									          when c.[estadocivil] = 'S' then 'Soltero'           
									          else 'Soltero'
									    end estadocivil
									    ,c.[profesion]    
									    ,c.[nacionalidad]    
									    ,c.[dirresidencia]    
									    ,c.[dpi]
									    ,c.[email]
									    ,c.[nit]
									    ,c.[celular]
									    ,c.[telefono]
									    ,c.[lugartrabajo]
									    ,c.[tiempolabor]
									    ,c.[dirtrabajo]
									    ,c.[puesto]
									    ,c.[ingresos]
									    ,c.[otrosingresos]
									    ,n.[clientejuridico]                      
							            ,n.[especifiquejuridico]                      
							            ,n.[nombramientojuridico]
							            ,n.[fechanombramiento]
							            ,n.[notarionombramiento]
							            ,n.[registro]
							            ,n.[folio]
							            ,n.[libro]
							            ,n.[nitjuridico]
							            ,n.[monedacontrato]            
				    					,n.[enganche]
				    					,n.[precioventa]
				    					,n.[tipocambioneg]
									from 
									    cliente c
									    ,negociacion n    
									    ,compradores o
									where 
									    c.[idcliente] = o.[idcliente]      
									    and n.[idnegociacion] = o.[idnegociacion] 
									    and o.[idnegociacion] = $idnegociacion");
		return $query->row();
	}

	public function getContratoPromesa1($idnegociacion)
	{		
		$query = $this->db->query("select
									    c.[nombre]       
									    ,c.[apellido]     
									    ,c.[fecnacimiento]    
									    ,case 
									          when c.[estadocivil] = 'C' then 'Casado' 
									          when c.[estadocivil] = 'S' then 'Soltero'           
									          else 'Soltero'
									    end estadocivil
									    ,c.[profesion]    
									    ,c.[nacionalidad]    
									    ,c.[dirresidencia]    
									    ,c.[dpi]
									    ,c.[email]
									    ,c.[nit]
									    ,c.[celular]
									    ,c.[telefono]
									    ,c.[lugartrabajo]
									    ,c.[tiempolabor]
									    ,c.[dirtrabajo]
									    ,c.[puesto]
									    ,c.[ingresos]
									    ,c.[otrosingresos]
									    ,n.[clientejuridico]                      
							            ,n.[especifiquejuridico]                      
							            ,n.[nombramientojuridico]
							            ,n.[fechanombramiento]
							            ,n.[notarionombramiento]
							            ,n.[registro]
							            ,n.[folio]
							            ,n.[libro]
							            ,n.[nitjuridico]
							            ,n.[monedacontrato]            
				    					,n.[enganche]
				    					,n.[precioventa]
				    					,n.[tipocambioneg]
									from 
									    cliente c
									    ,negociacion n    
									    ,compradores o
									where 
									    c.[idcliente] = o.[idcliente]      
									    and n.[idnegociacion] = o.[idnegociacion] 
									    and o.[idnegociacion] = $idnegociacion");
		return $query->result();
	}

	public function getContratoPromesa2($idnegociacion)
	{		
		$query = $this->db->query("select 
										a.[pagocalculado] 
									from 
										detallepago a
									where 
										a.[nopago] = 1
										and a.[idnegociacion] = $idnegociacion");
		return $query->row();
	}

	public function getContratoPromesa3($idnegociacion)
	{		
		$query = $this->db->query("select 
										count(*) cantidad
										,a.[pagocalculado] 
									from 
									    detallepago a
									where 
									    a.[nopago] > 1
									    and a.[idnegociacion] = $idnegociacion      
									group by
									    a.[pagocalculado]      
									order by
									    count(*) desc");
		return $query->result();
	}

	public function getContratoPromesa4($idnegociacion)
	{		
		$query = $this->db->query("select 
									    a.[fechalimitepago] 
									from 
									    detallepago a
									where 
									    a.[nopago] = 2
									    and a.[idnegociacion] = $idnegociacion");
		return $query->row();
	}

	public function getFormaPagoNegociacion($idnegociacion) {
		$query = $this->db->query("
select
      f.descripcion
from
    negociacion n
    ,formapago f
where
     n.idformapago = f.idformapago
     and n.idnegociacion = $idnegociacion
     ");
		return $query->row();
	}

	public function getDetInmueblesNegociacion($idnegociacion)
	{		
		$query = $this->db->query("select a.iddetallenegociacion,
								a.idnegociacion,
								a.idinmueble,    
					            c.[nombre] tipo,
					            d.[nombre] modelo,          
								a.[valor],
								b.[preciometro2],
								b.[sotano],
								b.[idtipoinmueble],
								b.[tamano],
								b.[finca],
								b.[folio],
								b.[libro]
							from detallenegociacion a	
								join inmueble b on b.[idinmueble] = a.[idinmueble] 
								join tipoinmueble c on b.[idtipoinmueble] = c.[idtipoinmueble]
								join modelo d on b.[idmodelo] = d.[idmodelo]		
								join negociacion e on a.[idnegociacion] = e.[idnegociacion]			
							where b.[idproyecto] = e.[idproyecto] 
								and a.idnegociacion = $idnegociacion
							order by b.[idtipoinmueble]");
		return $query->result();
	}

	public function getMontoMt2TipoInmueble($idnegociacion)
	{		
		$query = $this->db->query("select sum(b.[preciometro2]) suma, b.[idtipoinmueble] tipo, c.nombre nombretipo
							from detallenegociacion a	
				              join inmueble b on b.[idinmueble] = a.[idinmueble] 
				              join tipoinmueble c on b.[idtipoinmueble] = c.[idtipoinmueble]
				              join modelo d on b.[idmodelo] = d.[idmodelo]		
				              join negociacion e on a.[idnegociacion] = e.[idnegociacion]			
							where b.[idproyecto] = e.[idproyecto] 
							and a.idnegociacion = $idnegociacion
       						group by b.[idtipoinmueble];");
		return $query->result();
	}
	

}