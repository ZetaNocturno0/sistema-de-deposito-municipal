<?php
/** 
 * Class: infracion.class.php
 * 
 * Esta clase permitirá el registro y actualización de las descripcions 
 * 
 * @version 	
 * @author		Diego Zagaceta 
 * @copyright	Copyright (c) 2022 
 */

require_once("DBManager.class.php");

class Internamiento{
	private $num;
	private $fecha;
	private $idpapeleta;
	private $motor;
	private $horaing;
	private $obs;
	private $idestadovehiculo;
	private $idestadopago;
	private $idusuario;
	
	public function Correlativo()
	{
		$vCorre2 = 1;		
		$vCont = 1;
		$vCeros = "";
		$delta_ceros = 0;
		$AnoSiguiente = 0;
		$AnoActual = 0;
		$fecha = getdate();
		
		$db= new DBManager('root','');	
		$rs=$db->execute("SELECT id_internamiento FROM tb_internamiento ORDER BY id_internamiento;");
		
		//Entra a este bloque si existe algun valor en el campo INroOrd		
		if($rs->lastRow())
		{			
			
		
			$vCorre1 = substr($rs->fields['id_internamiento'],0,5);//variable que almacena los 4 primeros caracteres de INroOrd
			$vCorre2 = substr($rs->fields['id_internamiento'],6); //extraigo los ultimos 5 caracteres de INroOrd 			
			
			$vCorre1 = intval($vCorre1); //obtengo el valor entero
			$vCorre2 = intval($vCorre2); //obtengo el valor entero
							
			$vCorre2++;//se incrementa en 1, es decir el correlativo
			
			//verifico si el correlativo llega a ocupar los 5 digitos
		 	$delta_ceros = 6 - strlen($vCorre2);
			
			if( $delta_ceros == 0 )// Si en el codigo  correlativo ya no existen ceros que poner es decir vCorre2 = 10000
			{
				//Si es que he pasado al siguiente año
				$AnoActual = intval($fecha['year']);
				if($AnoActual>$vCorre1)
				{   
					$AnoSiguiente = $vCorre1+=1;
					return $AnoSiguiente."0000001";
				}
				else{

						return ($vCorre1.$vCorre2);
					}			
			}
			
			if( $delta_ceros < 0 /*-1*/)// Si en el codigo correlativo ya no existen ceros que poner y ya llego al limite, en este caso delta_ceros = -1
			{
				$AnoSiguiente = $vCorre1+=1;
				return $AnoSiguiente."0000001";
			}
			
			if( $delta_ceros > 0) // Si en el codigo correlativo existen ceros que poner
			{
			
				//Si es que he pasado al siguiente año
				$AnoActual = intval($fecha['year']);
				if($AnoActual>$vCorre1)
				{   
					$AnoSiguiente = $vCorre1+=1;
					return $AnoSiguiente."0000001";
				}
				else{
						for($i=1; $i<$delta_ceros; $i++)
						{
							$vCont++;//contador de ceros
						}			
						$vCeros=str_pad($vCeros,$vCont,'0',STR_PAD_RIGHT);//rellenar de ceros al lado derecho		
						return($vCorre1.$vCeros.$vCorre2);
					}			
			}			

		}else{ 
				//Caso contrario esta vacio el campo al inicio de las acciones				
				return ($fecha['year']."000000".$vCorre2);				
			 }

		$rs->close();
		$db->closeConnection();//opcional			
	}
	public function BuscarPorCodigo($vcodmarc)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select id_internamiento,DATE_FORMAT(internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,id_papeleta,internamiento_motor_serie,internamiento_hora_ingreso,internamiento_observacion,id_estado_vehiculo,internamiento_estado,id_usuario from tb_internamiento where (id_internamiento = '".$vcodmarc."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
               $this->num=$rs->fields["id_internamiento"];
				$this->fecha=$rs->fields["internamiento_fecha_ingreso"];
				$this->idpapeleta=$rs->fields["id_papeleta"];
				$this->motor=$rs->fields["internamiento_motor_serie"];
				$this->horaing=$rs->fields["internamiento_hora_ingreso"];
				$this->obs=$rs->fields["internamiento_observacion"];
				$this->idestadovehiculo=$rs->fields["id_estado_vehiculo"];
				$this->idestadopago=$rs->fields["internamiento_estado"];
				$this->idusuario=$rs->fields["id_usuario"];
				$rs->nextRow(); // Nota: nextRow() Esta situado			
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function Filtrar($fechai,$fechaf)//  pra reportes
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');	
		$fechai = implode("-", array_reverse(explode("-", $fechai)));
		$fechaf = implode("-", array_reverse(explode("-", $fechaf)));		
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre,u.usuario_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color inner join tb_clase_vehiculo as cl on p.id_clase_vehiculo=cl.id_clase_vehiculo inner join tb_usuario as u on i.id_usuario=u.id_usuario WHERE internamiento_fecha_ingreso BETWEEN '".$fechai."' AND '".$fechaf."'");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],
									"usuario_nombre"	=> $rs->fields["usuario_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}	
	
	public function ListarPorPlaca($vnum)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre,u.usuario_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color inner join tb_clase_vehiculo as cl on p.id_clase_vehiculo=cl.id_clase_vehiculo inner join tb_usuario as u on i.id_usuario=u.id_usuario where(p.papeleta_placa LIKE CONCAT('%','".$vnum."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],
									"usuario_nombre"	=> $rs->fields["usuario_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorPapeleta($vnum)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre,u.usuario_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color inner join tb_clase_vehiculo as cl on p.id_clase_vehiculo=cl.id_clase_vehiculo inner join tb_usuario as u on i.id_usuario=u.id_usuario where(p.papeleta_numero ='".$vnum."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],
									"usuario_nombre"	=> $rs->fields["usuario_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	public function ListarTodo()
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre,u.usuario_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color inner join tb_clase_vehiculo as cl on p.id_clase_vehiculo=cl.id_clase_vehiculo inner join tb_usuario as u on i.id_usuario=u.id_usuario where i.internamiento_estado=2 ");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],
									"usuario_nombre"	=> $rs->fields["usuario_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function Verificar($vcodmarc)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select id_internamiento,DATE_FORMAT(internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,id_papeleta,internamiento_motor_serie,internamiento_hora_ingreso,internamiento_observacion,id_estado_vehiculo,internamiento_estado,id_usuario from tb_internamiento where (id_papeleta = ".$vcodmarc.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->num=$rs->fields["id_internamiento"];
				$this->fecha=$rs->fields["internamiento_fecha_ingreso"];
				$this->idpapeleta=$rs->fields["id_papeleta"];
				$this->motor=$rs->fields["internamiento_motor_serie"];
				$this->horaing=$rs->fields["internamiento_hora_ingreso"];
				$this->obs=$rs->fields["internamiento_observacion"];
				$this->idestadovehiculo=$rs->fields["id_estado_vehiculo"];
				$this->idestadopago=$rs->fields["internamiento_estado"];
				$this->idusuario=$rs->fields["id_usuario"];
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function ListarSinCancelar()
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color inner join tb_clase_vehiculo as cl on p.id_clase_vehiculo=cl.id_clase_vehiculo(i.internamiento_estado =2)");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorEstado($v)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color inner join tb_clase_vehiculo as cl on p.id_clase_vehiculo=cl.id_clase_vehiculo where(i.internamiento_estado ='".$v."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorFecha($fecha)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$fecha = implode("-", array_reverse(explode("-", $fecha)));	
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color where(i.internamiento_fecha_ingreso ='".$fecha."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("select i.id_internamiento,DATE_FORMAT(i.internamiento_fecha_ingreso,'%d-%m-%Y') AS internamiento_fecha_ingreso,i.id_papeleta,i.internamiento_motor_serie,i.internamiento_hora_ingreso,i.internamiento_observacion,i.id_estado_vehiculo,i.internamiento_estado,i.id_usuario,p.papeleta_numero,p.id_conductor,p.id_infraccion,p.papeleta_placa,p.id_marca,p.id_policia,p.id_color,p.id_clase_vehiculo,f.infraccion_codigo,m.marca_nombre,c.color_nombre,cl.clase_vehiculo_nombre from tb_internamiento as i inner join tb_papeleta as p on i.id_papeleta=p.id_papeleta inner join tb_infraccion f on p.id_infraccion=f.id_infraccion inner join tb_marca as m on p.id_marca = m.id_marca inner join tb_colores as c on p.id_color=c.id_color where ( i.id_internamiento LIKE CONCAT('%','".$vpro."','%') ) ORDER BY i.id_internamiento ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"internamiento_fecha_ingreso" 	=> $rs->fields["internamiento_fecha_ingreso"],
									"id_papeleta"	=> $rs->fields["id_papeleta"],
									"internamiento_motor_serie"	=> $rs->fields["internamiento_motor_serie"],
									"internamiento_hora_ingreso"	=> $rs->fields["internamiento_hora_ingreso"],
									"internamiento_observacion"	=> $rs->fields["internamiento_observacion"],
									"id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],
									"internamiento_estado"	=> $rs->fields["internamiento_estado"],
									"id_usuario"	=> $rs->fields["id_usuario"],
									"papeleta_numero"	=> $rs->fields["papeleta_numero"],
									"id_conductor"	=> $rs->fields["id_conductor"],
									"id_infraccion"	=> $rs->fields["id_infraccion"],
									"papeleta_placa"	=> $rs->fields["papeleta_placa"],
									"id_marca"	=> $rs->fields["id_marca"],
									"id_policia"	=> $rs->fields["id_policia"],
									"id_color"	=> $rs->fields["id_color"],
									"id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],
									"infraccion_codigo"	=> $rs->fields["infraccion_codigo"],
									"marca_nombre"	=> $rs->fields["marca_nombre"],
									"color_nombre"	=> $rs->fields["color_nombre"],
									"clase_vehiculo_nombre"	=> $rs->fields["clase_vehiculo_nombre"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function Crear($num,$fecha,$idpapeleta,$motor,$horaing,$obs,$idestadovehiculo,$idestadopago,$idusuario)
	{
		$resp=false;		
		$db= new DBManager('root','');
		//$fecha = implode("-", array_reverse(explode("-", $fecha)));		
		if($db->_execute("INSERT INTO tb_internamiento(id_internamiento,internamiento_fecha_ingreso,id_papeleta,internamiento_motor_serie,internamiento_hora_ingreso,internamiento_observacion,id_estado_vehiculo,internamiento_estado,id_usuario) VALUES('".$num."','".$fecha."','".$idpapeleta."','".$motor."','".$horaing."','".$obs."',".$idestadovehiculo.",".$idestadopago.",".$idusuario.")"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	public function Actualizar($num,$fecha,$idpapeleta,$motor,$horaing,$obs,$idestadovehiculo,$idestadopago,$idusuario)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_internamiento set internamiento_fecha_ingreso='".$fecha."',id_papeleta='".$idpapeleta."',internamiento_motor_serie='".$motor."',internamiento_hora_ingreso='".$horaing."',internamiento_observacion='".$obs."',id_estado_vehiculo=".$idestadovehiculo.",internamiento_estado=".$idestadopago.",id_usuario=".$idusuario." where (id_internamiento='".$num."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	public function ActualizarEstadopago($num,$e)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_internamiento set internamiento_estado=".$e." where (id_internamiento='".$num."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}	

	public function getnum(){ return $this->num;}
	public function getfecha(){ return $this->fecha;}
	public function getidpapeleta(){ return $this->idpapeleta;}
	public function getmotor(){ return $this->motor;}
	public function gethoraing(){ return $this->horaing;}
	public function getobs(){ return $this->obs;}
	public function getidestadovehiculo(){ return $this->idestadovehiculo;}
	public function getidestadopago(){ return $this->idestadopago;}
	public function getidusuario(){ return $this->idusuario;}
	
}
?>