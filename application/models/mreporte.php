<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mreporte extends CI_Model 
{



	
    //trae los datos de las negociaciones que han hecho los asesores de un proyecto determinado
  public function getProyeccionFlujo($idproyecto)
  {   
    
        $txtQuery="select a.idnegociacion,a.idproyecto,c.nombre nomproyecto,a.idcliente,d.apellido,d.nombre,a.precioventa estimado,
                    (case when a.fechareserva is null or a.fechareserva='' then 0 else a.reserva end)+
                    (case when a.facturabanco is null or a.facturabanco='' then 0 else a.financiamientobanco end)+
                    sum(b.pagoefectuado+b.morapagada) real,
                    a.precioventa-
                    ((case when a.fechareserva is null or a.fechareserva='' then 0 else a.reserva end)+
                    (case when a.facturabanco is null or a.facturabanco='' then 0 else a.financiamientobanco end)+
                    sum(b.pagoefectuado+b.morapagada)) pendiente
                    from negociacion a,detallepago b,proyecto c,cliente d
                    where a.idnegociacion=b.idnegociacion 
                    and   a.idproyecto=c.idproyecto
                    and   a.idcliente=d.idcliente
                    and a.status<>'RS'
                    and a.idproyecto=".$idproyecto.
                    " group by a.idnegociacion,a.idproyecto,c.nombre,a.idcliente,d.apellido,d.nombre,a.precioventa
                    ";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }

  //trae los datos de las negociaciones que han hecho los asesores de un proyecto determinado
  public function getProyeccionFlujoTotales($idproyecto)
  {   
    
        $txtQuery="select idproyecto,
                  sum(t3.estimado) totalestimado,
                  sum(t3.real) totalreal,
                  sum(t3.pendiente) totalpendiente       
                  from
                  (select a.idproyecto,c.nombre nomproyecto,a.idcliente,
                         d.apellido,d.nombre,a.idinmueble,
                         a.precioventa estimado,
                         (case when a.fechareserva is null or a.fechareserva='' then 0 else a.reserva end)
                         +b.pagos
                         +(case when a.facturabanco is null or a.facturabanco='' then 0 else a.financiamientobanco end)
                         real,       
                         a.precioventa
                         -((case when a.fechareserva is null or a.fechareserva='' then 0 else a.reserva end)
                         +b.pagos
                         +(case when a.facturabanco is null or a.facturabanco='' then 0 else a.financiamientobanco end)
                          ) pendiente
                  from negociacion a,
                       (select t1.idnegociacion,sum(t1.pagoefectuado+t1.morapagada) pagos
                         from detallepago t1       
                         group by t1.idnegociacion   
                       ) b,     
                       proyecto c,     
                       cliente d
                  where a.idnegociacion=b.idnegociacion
                  and   a.idproyecto=c.idproyecto
                  and   a.idcliente=d.idcliente
                  AND   a.status<>'RS'
                  and   a.idproyecto=$idproyecto) t3
                  group by t3.idproyecto";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }






     //trae los datos de las negociaciones que han hecho los asesores de un proyecto determinado
  public function getClientesMorosos($idproyecto)
  {   
    
        $txtQuery="select t1.idnegociacion,t3.idproyecto,t3.nombre nomproyecto,
                   t4.idcliente,t4.nombre,t4.apellido,t2.idinmueble,
                   sum(ifnull(t1.moracalculada,0)) moracalculada,       
                   sum(ifnull(t1.morapagada,0)) morapagada,       
                   sum(ifnull(t1.diasmora,0)) diasmora ,      
                   sum(ifnull(t1.moracalculada,0))-sum(ifnull(t1.morapagada,0)) debemora,                   
                   t5.cantpendientes,t6.montopendiente
                   from detallepago t1,negociacion t2,proyecto t3,
                   cliente t4,
                   (select a.idnegociacion,b.idproyecto,count(*) cantpendientes
                          from detallepago a,
                               negociacion b
                          where a.idnegociacion=b.idnegociacion 
                          and   b.status<>'RS'
                          and   a.pagoefectuado<>a.pagocalculado
                          group by a.idnegociacion,b.idproyecto) t5,                                                    
                   (
                     select a.idnegociacion,b.idproyecto,sum(a.pagocalculado)-sum(a.pagoefectuado) montopendiente
                         from detallepago a,
                              negociacion b
                         where a.idnegociacion=b.idnegociacion 
                         and   b.status<>'RS'
                         group by a.idnegociacion,b.idproyecto                  
                   ) t6
                   where t1.idnegociacion=t2.idnegociacion
                   and   t2.idproyecto=t3.idproyecto
                   and   t2.idcliente = t4.idcliente
                   and   t1.moracalculada<>t1.morapagada                   
                   and   t2.idnegociacion=t5.idnegociacion                   
                   and   t2.idproyecto=t5.idproyecto                   
                   and   t2.idnegociacion=t6.idnegociacion                   
                   and   t2.idproyecto=t6.idproyecto
                   and   t3.idproyecto=$idproyecto
                   and   t2.status<>'RS'
                   group by t1.idnegociacion,t3.idproyecto,t3.nombre,t4.idcliente,t4.nombre,t4.apellido,t2.idinmueble,
                   t5.cantpendientes,t6.montopendiente
                   having ( sum(ifnull(t1.moracalculada,0))-sum(ifnull(t1.morapagada,0))>0)";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }


  //trae los datos de las negociaciones que han hecho los asesores de un proyecto determinado
  public function getClientesMorososTotales($idproyecto)
  {   
    
        $txtQuery="select t5.idproyecto,
                 sum(t5.moracalculada) moracalculadatotal,
                 sum(t5.morapagada) morapagadatotal,
                 sum(t5.debemora) debemoratotal
                  from
                  (
                  select t1.idnegociacion,t3.idproyecto,t3.nombre nomproyecto,
                         t4.idcliente,t4.nombre,t4.apellido,t2.idinmueble,
                         sum(ifnull(t1.moracalculada,0)) moracalculada,       
                         sum(ifnull(t1.morapagada,0)) morapagada,       
                         sum(ifnull(t1.diasmora,0)) diasmora ,      
                         sum(ifnull(t1.moracalculada,0))-sum(ifnull(t1.morapagada,0)) debemora
                  from detallepago t1,negociacion t2,proyecto t3,
                       cliente t4
                  where t1.idnegociacion=t2.idnegociacion
                  and   t2.idproyecto=t3.idproyecto
                  and   t2.idcliente = t4.idcliente
                  and   t1.moracalculada<>t1.morapagada
                  and   t3.idproyecto=$idproyecto
                  group by t1.idnegociacion,t3.idproyecto,t3.nombre,t4.idcliente,t4.nombre,t4.apellido,t2.idinmueble
                  ) t5
                  group by t5.idproyecto";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }


  //ERICK 
    //trae los datos de los pagos realizados por el cliente
  public function getPagosRealizados($idproyecto,$idcliente,$idnegociacion)
  {   
        
       $txtQuery="select a.fechapago,b.descripcion nomformapago, a.nodocumento,a.monto
                    from pago a,formapago b
                    where a.idformapago=b.idformapago
                    and a.status='AC'
                    and a.idnegociacion='".$idnegociacion."' " 
              ." order by a.idnegociacion,a.fechapago";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }


//ERICK 
    //trae los datos de los pagos realizados por el cliente
  public function getDatosEstadoCuenta($idproyecto,$idcliente,$idnegociacion)
  {   
        
        $txtQuery="select a.idnegociacion,
              a.idcliente,
              f.apellido || ' ' || f.nombre nomcliente,
              a.idproyecto,
              g.nombre nomproyecto,
              a.idinmueble,
              c.nombre nombreinmueble,
              a.idasesor,
              a.fecha,
              a.precioventa,
              a.reserva,
              a.enganche,
              a.saldoenganche,
              a.financiamientobanco,
              a.nocuotas,
              a.cuotamensual,
              a.comision,
              a.banco,
              a.status,
              d.fechapago,
              e.descripcion nomformapago,     
              d.nodocumento,
              d.monto              
              from negociacion a,inmueble b,tipoinmueble c,pago d,formapago e,
                   cliente f,proyecto g
              where a.idinmueble=b.idinmueble              
              and   a.idproyecto=b.idproyecto              
              and   b.idtipoinmueble=c.idtipoinmueble
              and   a.idnegociacion=d.idnegociacion                            
              and   d.idformapago=e.idformapago              
              and   a.idcliente=f.idcliente              
              and   a.idproyecto=g.idproyecto
              and a.status<>'RS'
              and a.idproyecto=".$idproyecto
              ." and a.idcliente=".$idcliente
              ." and a.idnegociacion='".$idnegociacion."' "           
              ." order by a.[idnegociacion],d.fechapago";


   

        $query= $this->db->query($txtQuery);
        return $query->result();
  }

  //ERICK 
    //trae los datos de los pagos realizados por el cliente
  public function getEncabezadoEstadoCuenta($idproyecto,$idcliente,$idnegociacion)
  {   
        
        $txtQuery="select c.idnegociacion idnegociacion,a.nomproyecto nomproyecto,b.nomcliente nomcliente,c.precioventa precioventa,
                   c.reserva reserva,c.fechareserva fechareserva,c.financiamientobanco financiamientobanco,c.facturabanco facturabanco
                   from 
                   (select nombre nomproyecto from proyecto  where idproyecto=".$idproyecto.") a,
                   (select apellido || ' ' || nombre nomcliente from cliente where idcliente=".$idcliente.") b,   
                   (select idnegociacion,precioventa,reserva,fechareserva,financiamientobanco,facturabanco from negociacion where idnegociacion=".$idnegociacion.") c";

     
        $query= $this->db->query($txtQuery);
        return $query->result();
  }

  
  //roberto
  public function getFlujoPagosProyectadosMaxCuotas($idproyecto)
  {   
    
        $txtQuery="select max(a.[nocuotas]) maxcuotas 
            from negociacion a
            where a.[status] = 'AC'
            and a.[idproyecto] = $idproyecto;";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }

  //roberto
  public function getFlujoPagosProyectados($idproyecto)
  {   
    
        $txtQuery="select 
                b.[idnegociacion]       
                ,b.[reserva]         
                ,b.[reciboreserva]        
                ,b.[fechareserva]        
                ,b.[facturabanco]
                ,b.[financiamientobanco]
                ,b.[idinmueble]
                ,b.[idcliente]
                ,c.[nombre] || ' ' || c.[apellido] nombre
                ,ifnull(a.[pagocalculado],0) pagocalculado
                ,ifnull(a.[fechalimitepago],Date('1899-12-30')) fecha
          from negociacion b  
          left outer join detallepago a on a.[idnegociacion] = b.[idnegociacion]                           
          left outer join cliente c on b.[idcliente] = c.[idcliente]
          where b.[status] = 'AC'
          and b.[idproyecto] = $idproyecto
          
          order by b.[idnegociacion], a.[fechalimitepago];";
          //and b.[idinmueble] = 'S61'
        $query= $this->db->query($txtQuery);
        return $query->result();
  }
  //roberto
  public function getFlujoPagosEfectuados($idproyecto)
  {   
    
        $txtQuery="select 
                b.[idnegociacion]       
                ,b.[reserva]         
                ,b.[reciboreserva]        
                ,b.[fechareserva]        
                ,b.[facturabanco]
                ,b.[financiamientobanco]
                ,b.[idinmueble]
                ,b.[idcliente]
                ,c.[nombre] || ' ' || c.[apellido] nombre
                ,ifnull(a.[monto],0) pagoefectuado
                ,ifnull(a.[fechapago],Date('1899-12-30')) fecha
          from negociacion b
          left outer join pago a on a.[idnegociacion] = b.[idnegociacion] and a.[status] = 'AC'                     
          left outer join cliente c on b.[idcliente] = c.[idcliente]
          where b.[status] = 'AC'          
          and b.[idproyecto] = $idproyecto
          
          order by b.[idnegociacion], a.[fechapago]; ";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }



  // 08-03-2015, roberto
  public function getFlujoPagosProyectadosRangoCuotas($idproyecto)
  {   
    
        $txtQuery="select Date(min(b.[fechalimitepago]),6||' hour') fechamin,Date(max(b.[fechalimitepago]),6||' hour') fechamax,
            Date(min(a.[fechareserva]),6||' hour') fechaminres,Date(max(a.[fechareserva]),6||' hour') fechamaxres
            from negociacion a            
            join detallepago b
            where a.[idnegociacion] = b.[idnegociacion] 
            and a.[status] = 'AC'            
            and a.[fechareserva] > Date('1899-12-30')
            and a.[idproyecto] = $idproyecto;";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }
  
  public function getComprasEstadoCuenta($idnegociacion)
  {
     $txtQuery="select idinmueble,valor
                from detallenegociacion
                where idnegociacion=".$idnegociacion;
                
        $query= $this->db->query($txtQuery);
        return $query->result();
  }

// 12-05-2015, roberto
  public function borrar_Reporte_EfecProy(&$err)
  {
    $this->db->query("delete from Reporte_EfecProy");  
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

  // 12-05-2015, roberto
  public function grabar_Efectuados_Reporte_EfecProy($idproyecto,&$err)
  {
    $this->db->query("delete from Reporte_EfecProy");

    $query = $this->db->query("select 
                b.[idnegociacion]       
                ,b.[reserva]         
                ,b.[reciboreserva]        
                ,b.[fechareserva]        
                ,b.[facturabanco]
                ,b.[financiamientobanco]
                ,b.[idcliente]
                ,c.[nombre] || ' ' || c.[apellido] nombre
                ,ifnull(round(a.[monto],2),0) pagoefectuado
                ,ifnull(a.[fechapago],Date('1899-12-30')) fecha
          from negociacion b
          left outer join pago a on a.[idnegociacion] = b.[idnegociacion] and a.[status] = 'AC'                     
          left outer join cliente c on b.[idcliente] = c.[idcliente]
          where b.[status] = 'AC'          
          and b.[idproyecto] = $idproyecto          
          --and b.[idnegociacion] = 6
          order by b.[idnegociacion], a.[fechapago];");

    foreach($query->result() as $row)
    {
      $this->db->insert('Reporte_EfecProy',$row);
    }


    $query = $this->db->query("select 
                b.[idnegociacion]       
                ,b.[reserva]         
                ,b.[reciboreserva]        
                ,b.[fechareserva]        
                ,b.[facturabanco]
                ,b.[financiamientobanco]
                ,b.[idcliente]
                ,c.[nombre] || ' ' || c.[apellido] nombre
                ,round(a.[pagocalculado]-a.[pagoefectuado],2) pagoefectuado
                ,a.[fechalimitepago] fecha
          from detallepago a
          join negociacion b                    
          join cliente c
          where a.[idnegociacion] = b.[idnegociacion]          
          and b.[idcliente] = c.[idcliente]
          and b.[status] = 'AC'
          and b.[idproyecto] = $idproyecto          
          and a.[pagocalculado] != a.[pagoefectuado]
          --and b.[idnegociacion] = 6
          order by a.[idnegociacion], a.[fechalimitepago];");

    foreach($query->result() as $row)
    {
      if(date('Y-m-d',strtotime($row->fecha)) < date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d')))) )
      {
        $row->fecha = date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
        //$row->fecha = date('Y-m-d');
      }
      $this->db->insert('Reporte_EfecProy',$row);
    }
  }

  //09-06-2015, roberto
  public function getFlujoPagosEfecProy($idproyecto)
  {   
    
        $txtQuery="select 
                b.[idnegociacion]       
                ,b.[reserva]         
                ,b.[reciboreserva]        
                ,b.[fechareserva]        
                ,b.[facturabanco]
                ,b.[financiamientobanco]
                ,b.[idcliente]
                ,b.nombre
                ,b.pagoefectuado
                ,b.fecha
          from Reporte_EfecProy b                  
          where b.idproyecto=$idproyecto
          order by b.[idnegociacion], b.[fecha]; ";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }


//ERICK 
    //trae los datos de los pagos realizados por el cliente
  public function getEncabezadoEstadoCuentaInv($idproyecto,$idinversionista,$idaporte)
  {   
        
        $txtQuery="select c.idaporte idaporte,a.nomproyecto nomproyecto,b.nominversionista nominversionista,c.fecha fecha,
                   c.periodomeses periodomeses,c.monto monto,c.interes interes,c.montopendiente montopendiente,
                   c.formapagomeses formapagomeses
                   from 
                   (select nombre nomproyecto from proyecto  where idproyecto=".$idproyecto.") a,
                   (select nombre nominversionista from inversionista where idinversionista=".$idinversionista.") b,   
                   (select idaporte,fecha,periodomeses,monto,interes,montopendiente,formapagomeses from aporte where idaporte=".$idaporte.") c";
        
        $query= $this->db->query($txtQuery);
        return $query->result();
  }

  //ERICK 
    //trae los datos de los pagos realizados por el cliente
  public function getPagosRealizadosInv($idproyecto,$idinversionista,$idaporte)
  {   
        
       $txtQuery="select a.fechapago,b.descripcion nomformapago, a.nodocumento,a.monto
                    from pagoaporte a,formapago b
                    where a.idformapago=b.idformapago
                    and a.status='AC'
                    and a.idaporte='".$idaporte."' " 
              ." order by a.idaporte,a.fechapago";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }

  //erick 27/01/2016
  public function getFlujoPagosEfectuadosInv($idproyecto)
  {   
       
        $txtQuery="select 
                b.[idaporte]       
                ,b.[idinversionista]
                ,c.[nombre]  nombre
                ,ifnull(a.[monto],0) pagoefectuado
                ,ifnull(a.[fechapago],Date('1899-12-30')) fecha
          from aporte b
          left outer join pagoaporte a on a.[idaporte] = b.[idaporte] and a.[status] = 'AC'                     
          left outer join inversionista c on b.[idinversionista] = c.[idinversionista]
          where b.[status] = 'AC'          
          and b.[idproyecto] = $idproyecto
          order by b.[idaporte], a.[fechapago]; ";
     
        $query= $this->db->query($txtQuery);
        return $query->result();
  }


 // eick 27/01/2016

  public function getFlujoPagosProyectadosRangoAportesInv($idproyecto)
  {   
    
        $txtQuery="select Date(min(sub1.[fechamin]),6||' hour') fechamin,Date(max(sub1.[fechamax]),6||' hour') fechamax
                    from (
                    select Date(min(b.[fechapago]),6||' hour') fechamin,Date(max(b.[fechapago]),6||' hour') fechamax
                                from aporte a            
                                join detallepagoinversion b
                                where a.[idaporte] = b.[idaporte] 
                                and a.[status] = 'AC'            
                                and a.[idproyecto] = $idproyecto    
                                                              

                    union all
                    select Date(min(b.[fechapago]),6||' hour') fechamin,Date(max(b.[fechapago]),6||' hour') fechamax
                                from aporte a            
                                join pagoaporte b
                                where a.[idaporte] = b.[idaporte] 
                                and a.[status] = 'AC'            
                                and a.[idproyecto] = $idproyecto 
                                
                    ) sub1 
                                      
                    ";

        $query= $this->db->query($txtQuery);
        return $query->result();
  }
  
  public function negPorCliente($idproyecto=-1)
  {
    $txtQuery="select 
            a.[idnegociacion]
            ,a.[idcliente]
            ,case a.idcliente
              when 0 then h.nombre
              else b.nombre
            end nombre
            ,case a.idcliente
              when 0 then h.apellido
              else b.apellido
            end apellido
            ,case a.idcliente
              when 0 then h.celular
              else b.celular
            end celular
            ,case a.idcliente
              when 0 then h.nit
              else b.nit
            end nit
            ,case a.idcliente
              when 0 then h.dpi
              else b.dpi
            end dpi
            ,a.[idproyecto]
            ,c.[nombre] nomproyecto
            ,a.[idasesor]
            ,d.[nombre] || ' ' || d.[apellido] nomasesor
            ,a.[fecha] fecprimerpago
            ,a.[precioventa]
            ,a.[reserva]
            ,a.[reciboreserva]
            ,a.[fechareserva]
            ,a.[enganche]
            ,a.[saldoenganche]
            ,a.[financiamientobanco]
            ,a.[nocuotas]
            ,a.[cuotamensual]
            ,a.[comision]
            ,a.[banco]
            ,a.[facturabanco]
            ,a.[status]
            ,case a.[clientejuridico]
              when 2 then 'SI'
              else 'NO'
            end clientejuridico
            ,a.[especifiquejuridico]
            ,a.[nombramientojuridico]
            ,case a.[monedacontrato]
              when 1 then 'Dólares ($)'
              when 2 then 'Quetzales (Q)'
              else 'Dólares ($)'
            end monedacontrato
            ,a.[tipocambioneg]
            ,a.[formapago]
            ,a.[plazocredito]
            ,a.[tipofinanciamiento]
            ,a.[entidadautorizada]
            ,e.[idinmueble]
            ,e.[valor]       
            ,f.[idtipoinmueble]
            ,f.[idmodelo]       
            ,g.[nombre] nomtipoinmueble
          from 
            negociacion a 
            left outer join cliente b on a.idcliente=b.idcliente
            left outer join clientetemporal h on a.idnegociacion = h.idnegociacion
            join proyecto c on a.idproyecto = c.idproyecto
            left join asesor d on a.idasesor = d.idasesor
            join detallenegociacion e on a.idnegociacion=e.[idnegociacion]
            join inmueble f on e.[idinmueble]=f.idinmueble and a.[idproyecto]=f.idproyecto
            join tipoinmueble g on f.[idtipoinmueble]=g.idtipoinmueble
          where 
            a.[status] in ('CR','AP')
            and a.idproyecto = $idproyecto
          order by 
            a.[idproyecto]
            ,a.idcliente
            ,a.idnegociacion";

    $query= $this->db->query($txtQuery);
    return $query->result();
  }

}

