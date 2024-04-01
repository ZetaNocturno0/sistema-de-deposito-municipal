<?php

require_once("DBManager.class.php");

class Pagadores{
	private $idpagador;///
	private $nombres;
	private $apepaterno;
	private $apematerno;
	private $dni;
	///////////////////////////////////////////
public function Crear($vnom,$vapepat,$vapemat,$vdni)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_pagador(id_pagador,pagador_nombre,pagador_apellido_paterno,pagador_apellido_materno,pagador_dni) VALUES(null,'".$vnom."','".$vapepat."','".$vapemat."','".$vdni."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorCriterio($vconductor)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_pagador where(pagador_nombre LIKE CONCAT('%','".$vconductor."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_pagador"	=> $rs->fields["id_pagador"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"pagador_apellido_paterno" 	=> $rs->fields["pagador_apellido_paterno"],
									"pagador_apellido_materno" => $rs->fields["pagador_apellido_materno"],
									"pagador_dni" 	=> $rs->fields["pagador_dni"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
		
	public function BuscarPorCodigo($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_pagador where(id_pagador = '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idpagador=$rs->fields["id_pagador"];
				$this->nombres=$rs->fields["pagador_nombre"];				
				$this->apepaterno=$rs->fields["pagador_apellido_paterno"];				 
				$this->apematerno=$rs->fields["pagador_apellido_materno"];
				$this->dni=$rs->fields["pagador_dni"];
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function BuscarPorDni($vcod)
	{
		$db = new DBManager('root', '');
		$conn = $db->getConnection();
		$result = $conn->query("SELECT id_pagador FROM tb_pagador WHERE(pagador_dni = '".$vcod."')");
		if ($result === false) {
			throw new Exception("Error en la consulta: " . $conn->error);
		}
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row['id_pagador'];
		}
		$result->close();
		$db->closeConnection();
		return implode(',', $data);			
	}
	
	public function Actualizar($vidprov,$vnom,$vapepat,$vapemat,$vdni)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_pagador set pagador_nombre = '".$vnom."', pagador_apellido_paterno = '".$vapepat."', pagador_apellido_materno = '".$vapemat."', pagador_dni ='".$vdni."' where (id_pagador=".$vidprov.")"))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	
	////////////////////////////////*/
		
	public function ListaTotal()
	{
		$vector=null;
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_pagador");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                $vector[$row]=array("id_pagador"	=> $rs->fields["id_pagador"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"pagador_apellido_paterno" 	=> $rs->fields["pagador_apellido_paterno"],
									"pagador_apellido_materno" => $rs->fields["pagador_apellido_materno"],
									"pagador_dni" 	=> $rs->fields["pagador_dni"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	////////////////////////////
	public function ListaPaginada($vcli,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM tb_pagador WHERE ( pagador_nombre LIKE CONCAT('%','".$vcli."','%') ) ORDER BY pagador_nombre ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_pagador"	=> $rs->fields["id_pagador"],
									"pagador_nombre" 	=> $rs->fields["pagador_nombre"],
									"pagador_apellido_paterno" 	=> $rs->fields["pagador_apellido_paterno"],
									"pagador_apellido_materno" => $rs->fields["pagador_apellido_materno"],
									"pagador_dni" 	=> $rs->fields["pagador_dni"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	//////////////////////////////
	public function Eliminar($vcod)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM tb_pagador WHERE (id_pagador=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	///////////////////////////////////////*/	
	public function getIdpagador(){ return $this->idpagador;}
	public function getNombres(){ return $this->nombres;}
	public function getApepaterno(){ return $this->apepaterno;}
	public function getApematerno(){ return $this->apematerno;}
	public function getDni(){ return $this->dni;}
	
}
?>