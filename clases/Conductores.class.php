<?php

require_once("DBManager.class.php");

class Conductores{
	private $idconductor;///
	private $nombres;
	private $apepaterno;
	private $apematerno;
	private $dni;
	///////////////////////////////////////////
public function Crear($vnom,$vapepat,$vapemat,$vdni)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_conductor(id_conductor,conductor_nombre,conductor_apellido_paterno,conductor_apellido_materno,conductor_dni) VALUES(null,'".$vnom."','".$vapepat."','".$vapemat."','".$vdni."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorCriterio($vconductor)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_conductor where(conductor_nombre LIKE CONCAT('%','".$vconductor."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_conductor"	=> $rs->fields["id_conductor"],
									"conductor_nombre" 	=> $rs->fields["conductor_nombre"],
									"conductor_apellido_paterno" 	=> $rs->fields["conductor_apellido_paterno"],
									"conductor_apellido_materno" => $rs->fields["conductor_apellido_materno"],
									"conductor_dni" 	=> $rs->fields["conductor_dni"]);
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
		$rs=$db->execute("select * from tb_conductor where(id_conductor = '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idconductor=$rs->fields["id_conductor"];
				$this->nombres=$rs->fields["conductor_nombre"];				
				$this->apepaterno=$rs->fields["conductor_apellido_paterno"];				 
				$this->apematerno=$rs->fields["conductor_apellido_materno"];
				$this->dni=$rs->fields["conductor_dni"];
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	
	public function Actualizar($vidprov,$vnom,$vapepat,$vapemat,$vdni)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_conductor set conductor_nombre = '".$vnom."', conductor_apellido_paterno = '".$vapepat."', conductor_apellido_materno = '".$vapemat."', conductor_dni ='".$vdni."' where (id_conductor=".$vidprov.")"))//si es exitosa la consulta			   
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
		$rs=$db->execute("select * from tb_conductor");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                $vector[$row]=array("id_conductor"	=> $rs->fields["id_conductor"],
									"conductor_nombre" 	=> $rs->fields["conductor_nombre"],
									"conductor_apellido_paterno" 	=> $rs->fields["conductor_apellido_paterno"],
									"conductor_apellido_materno" => $rs->fields["conductor_apellido_materno"],
									"conductor_dni" 	=> $rs->fields["conductor_dni"]);
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
		$rs=$db->execute("SELECT * FROM tb_conductor WHERE ( conductor_nombre LIKE CONCAT('%','".$vcli."','%') ) ORDER BY conductor_nombre ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_conductor"	=> $rs->fields["id_conductor"],
									"conductor_nombre" 	=> $rs->fields["conductor_nombre"],
									"conductor_apellido_paterno" 	=> $rs->fields["conductor_apellido_paterno"],
									"conductor_apellido_materno" => $rs->fields["conductor_apellido_materno"],
									"conductor_dni" 	=> $rs->fields["conductor_dni"]);
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
		if($db->_execute("DELETE FROM tb_conductor WHERE (id_conductor=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	///////////////////////////////////////*/	
	public function getIdconductor(){ return $this->idconductor;}
	public function getNombres(){ return $this->nombres;}
	public function getApepaterno(){ return $this->apepaterno;}
	public function getApematerno(){ return $this->apematerno;}
	public function getDni(){ return $this->dni;}
	
}
?>