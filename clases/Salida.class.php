<?php
require_once("DBManager.class.php");

class Salida{
	private $num;
	private $monto;
	private $idpagador;
	private $recibo;
	private $fecha;
	private $horasal;
	private $idusuario;
	
	public function BuscarPorCodigo($vnum)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_salida where (id_internamiento = '".$vnum."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->num=$rs->fields["id_internamiento"];
   			    $this->monto=$rs->fields["salida_monto"];   			    
				$this->nombrepag=$rs->fields["id_pagador"];
				$this->recibo=$rs->fields["recibo_numero"]; 
				$this->fecha=$rs->fields["salida_fecha"];
				$this->fecha=$rs->fields["salida_hora"]; 
				$this->idusuario=$rs->fields["id_usuario"];     			    
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function BuscarFecha($vcod)
	{
		$db = new DBManager('root', '');
		$conn = $db->getConnection();
		$result = $conn->query("SELECT salida_fecha, salida_hora FROM tb_salida WHERE id_internamiento = '".$vcod."'");
		if ($result === false) {
			throw new Exception("Error en la consulta: " . $conn->error);
		}
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row; // Guardamos todo el registro devuelto por la consulta
		}
		$result->close();
		$db->closeConnection();
		return implode('', array_map(function($row) { return $row['salida_fecha']; }, $data));

 // Devolvemos el array sin convertirlo en una cadena
	}
	
	public function BuscarHora($vcod)
	{
		$db = new DBManager('root', '');
		$conn = $db->getConnection();
		$result = $conn->query("SELECT salida_fecha, salida_hora FROM tb_salida WHERE id_internamiento = '".$vcod."'");
		if ($result === false) {
			throw new Exception("Error en la consulta: " . $conn->error);
		}
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row; // Guardamos todo el registro devuelto por la consulta
		}
		$result->close();
		$db->closeConnection();
		return implode('', array_map(function($row) { return $row['salida_hora']; }, $data));

 // Devolvemos el array sin convertirlo en una cadena
	}
	
	public function Filtrar($fechai,$fechaf)//  pra reportes
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');	
		$fechai = implode("-", array_reverse(explode("-", $fechai)));
		$fechaf = implode("-", array_reverse(explode("-", $fechaf)));		
		$rs=$db->execute("SELECT s.id_internamiento,s.salida_monto,s.id_pagador,s.recibo_numero,DATE_FORMAT(s.salida_fecha,'%d-%m-%Y') AS salida_fecha,s.salida_hora,s.id_usuario,i.id_internamiento,i.id_papeleta,p.id_papeleta,p.papeleta_placa,p.papeleta_numero,u.usuario_nombre,i.internamiento_estado,i.id_papeleta,c.color_nombre,d.pagador_nombre,d.pagador_apellido_paterno,d.pagador_apellido_materno,d.pagador_dni  FROM tb_salida AS s INNER JOIN tb_internamiento AS i ON s.id_internamiento = i.id_internamiento INNER JOIN tb_papeleta AS p ON i.id_papeleta = p.id_papeleta inner join tb_usuario as u on s.id_usuario=u.id_usuario INNER JOIN tb_colores AS c ON p.id_color = c.id_color INNER JOIN tb_pagador AS d ON s.id_pagador = d.id_pagador WHERE salida_fecha BETWEEN '".$fechai."' AND '".$fechaf."'");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"salida_monto" 	=> $rs->fields["salida_monto"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"pagador_apellido_paterno" 	=> $rs->fields["pagador_apellido_paterno"],
									"pagador_apellido_materno" 	=> $rs->fields["pagador_apellido_materno"],
									"pagador_dni" 	=> $rs->fields["pagador_dni"],
									"recibo_numero" 	=> $rs->fields["recibo_numero"],
									"salida_fecha" 	=> $rs->fields["salida_fecha"],
									"salida_hora" 	=> $rs->fields["salida_hora"],
									"papeleta_numero" 	=> $rs->fields["papeleta_numero"],
									"papeleta_placa" 	=> $rs->fields["papeleta_placa"],
									"color_nombre" 	=> $rs->fields["color_nombre"],
									"internamiento_estado" 	=> $rs->fields["internamiento_estado"],
									"id_usuario" 	=> $rs->fields["id_usuario"],
									"usuario_nombre" 	=> $rs->fields["usuario_nombre"]);
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
		$rs=$db->execute("SELECT s.id_internamiento,s.salida_monto,s.id_pagador,s.recibo_numero,DATE_FORMAT(s.salida_fecha,'%d-%m-%Y') AS salida_fecha,s.salida_hora,s.id_usuario,i.id_internamiento,i.id_papeleta,p.id_papeleta,p.papeleta_placa,p.papeleta_numero,u.usuario_nombre,i.internamiento_estado,i.id_papeleta,c.color_nombre,d.pagador_nombre,d.pagador_apellido_paterno,d.pagador_apellido_materno,d.pagador_dni  FROM tb_salida AS s INNER JOIN tb_internamiento AS i ON s.id_internamiento = i.id_internamiento INNER JOIN tb_papeleta AS p ON i.id_papeleta = p.id_papeleta inner join tb_usuario as u on s.id_usuario=u.id_usuario INNER JOIN tb_colores AS c ON p.id_color = c.id_color INNER JOIN tb_pagador AS d ON s.id_pagador = d.id_pagador WHERE(p.papeleta_placa ='".$vnum."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"salida_monto" 	=> $rs->fields["salida_monto"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"pagador_apellido_paterno" 	=> $rs->fields["pagador_apellido_paterno"],
									"pagador_apellido_materno" 	=> $rs->fields["pagador_apellido_materno"],
									"pagador_dni" 	=> $rs->fields["pagador_dni"],
									"recibo_numero" 	=> $rs->fields["recibo_numero"],
									"salida_fecha" 	=> $rs->fields["salida_fecha"],
									"salida_hora" 	=> $rs->fields["salida_hora"],
									"papeleta_numero" 	=> $rs->fields["papeleta_numero"],
									"papeleta_placa" 	=> $rs->fields["papeleta_placa"],
									"color_nombre" 	=> $rs->fields["color_nombre"],
									"internamiento_estado" 	=> $rs->fields["internamiento_estado"],
									"id_usuario" 	=> $rs->fields["id_usuario"],
									"usuario_nombre" 	=> $rs->fields["usuario_nombre"]);
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
		$rs=$db->execute("SELECT s.id_internamiento,s.salida_monto,s.id_pagador,s.recibo_numero,DATE_FORMAT(s.salida_fecha,'%d-%m-%Y') AS salida_fecha,s.salida_hora,s.id_usuario,i.id_internamiento,i.id_papeleta,p.id_papeleta,p.papeleta_placa,p.papeleta_numero,u.usuario_nombre,i.internamiento_estado,i.id_papeleta,c.color_nombre,d.pagador_nombre,d.pagador_apellido_paterno,d.pagador_apellido_materno,d.pagador_dni  FROM tb_salida AS s INNER JOIN tb_internamiento AS i ON s.id_internamiento = i.id_internamiento INNER JOIN tb_papeleta AS p ON i.id_papeleta = p.id_papeleta inner join tb_usuario as u on s.id_usuario=u.id_usuario INNER JOIN tb_colores AS c ON p.id_color = c.id_color INNER JOIN tb_pagador AS d ON s.id_pagador = d.id_pagador WHERE(p.papeleta_numero ='".$vnum."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"salida_monto" 	=> $rs->fields["salida_monto"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"pagador_apellido_paterno" 	=> $rs->fields["pagador_apellido_paterno"],
									"pagador_apellido_materno" 	=> $rs->fields["pagador_apellido_materno"],
									"pagador_dni" 	=> $rs->fields["pagador_dni"],
									"recibo_numero" 	=> $rs->fields["recibo_numero"],
									"salida_fecha" 	=> $rs->fields["salida_fecha"],
									"salida_hora" 	=> $rs->fields["salida_hora"],
									"papeleta_numero" 	=> $rs->fields["papeleta_numero"],
									"papeleta_placa" 	=> $rs->fields["papeleta_placa"],
									"color_nombre" 	=> $rs->fields["color_nombre"],
									"internamiento_estado" 	=> $rs->fields["internamiento_estado"],
									"id_usuario" 	=> $rs->fields["id_usuario"],
									"usuario_nombre" 	=> $rs->fields["usuario_nombre"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarTodo()
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("SELECT s.id_internamiento,s.salida_monto,s.id_pagador,s.recibo_numero,DATE_FORMAT(s.salida_fecha,'%d-%m-%Y') AS salida_fecha,s.salida_hora,s.id_usuario,i.id_internamiento,i.id_papeleta,p.id_papeleta,p.papeleta_placa,p.papeleta_numero,u.usuario_nombre,i.internamiento_estado,i.id_papeleta,c.color_nombre,d.pagador_nombre,d.pagador_apellido_paterno,d.pagador_apellido_materno,d.pagador_dni  FROM tb_salida AS s INNER JOIN tb_internamiento AS i ON s.id_internamiento = i.id_internamiento INNER JOIN tb_papeleta AS p ON i.id_papeleta = p.id_papeleta inner join tb_usuario as u on s.id_usuario=u.id_usuario INNER JOIN tb_colores AS c ON p.id_color = c.id_color INNER JOIN tb_pagador AS d ON s.id_pagador = d.id_pagador;");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"salida_monto" 	=> $rs->fields["salida_monto"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"pagador_apellido_paterno" 	=> $rs->fields["pagador_apellido_paterno"],
									"pagador_apellido_materno" 	=> $rs->fields["pagador_apellido_materno"],
									"pagador_dni" 	=> $rs->fields["pagador_dni"],
									"recibo_numero" 	=> $rs->fields["recibo_numero"],
									"salida_fecha" 	=> $rs->fields["salida_fecha"],
									"salida_hora" 	=> $rs->fields["salida_hora"],
									"papeleta_numero" 	=> $rs->fields["papeleta_numero"],
									"papeleta_placa" 	=> $rs->fields["papeleta_placa"],
									"color_nombre" 	=> $rs->fields["color_nombre"],
									"internamiento_estado" 	=> $rs->fields["internamiento_estado"],
									"id_usuario" 	=> $rs->fields["id_usuario"],
									"usuario_nombre" 	=> $rs->fields["usuario_nombre"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorDni($vnommarc)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_salida where(salida_pagador_dni ='".$vnommarc."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"salida_monto" 	=> $rs->fields["salida_monto"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"recibo_numero" 	=> $rs->fields["recibo_numero"],
									"salida_fecha" 	=> $rs->fields["salida_fecha"],
									"salida_hora" 	=> $rs->fields["salida_hora"],
									"id_usuario" 	=> $rs->fields["id_usuario"]);
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
		$rs=$db->execute("SELECT * FROM tb_salida WHERE ( id_internamiento LIKE CONCAT('%','".$vpro."','%') ) ORDER BY id_internamiento ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_internamiento"	=> $rs->fields["id_internamiento"],
   			    					"salida_monto" 	=> $rs->fields["salida_monto"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"recibo_numero" 	=> $rs->fields["recibo_numero"],
									"salida_fecha" 	=> $rs->fields["salida_fecha"],
									"salida_hora" 	=> $rs->fields["salida_hora"],
									"id_usuario" 	=> $rs->fields["id_usuario"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function Crear($n,$m,$ip,$rec,$f,$h,$idu)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_salida(id_internamiento,salida_monto,id_pagador,recibo_numero,salida_fecha,salida_hora,id_usuario) VALUES('".$n."','".$m."','".$ip."','".$rec."','".$f."','".$h."','".$idu."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	/*public function Actualizar($vcod,$vnommarc)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update  infraccion set descripcion = '".$vnommarc."' where (codinfra=".$vcod.")"))   
		{
			$resp=true;
		}
		return $resp;		
	}	*/

	public function getNum(){ return $this->num;}
	public function getMonto(){ return $this->monto;}	
	public function getIdpagador(){ return $this->idpagador;}
	public function getRecibo(){ return $this->recibo;}	
	public function getFecha(){ return $this->fecha;}
	public function getHorasal(){ return $this->horasal;}
	public function getIdUsuario(){ return $this->idusuario;}
}
?>