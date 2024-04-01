<?php

require_once("DBManager.class.php");

class Policia{
	private $idpolicia;///
	private $nombres;
	private $apepat;
	private $apemat;
	private $cip;
	///////////////////////////////////////////
public function Crear($vnom,$vapepat,$vapemat,$vcip)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_policia(id_policia,policia_nombre,policia_apellido_paterno,policia_apellido_materno,policia_cip) VALUES(null,'".$vnom."','".$vapepat."','".$vapemat."','".$vcip."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorCriterio($vpolicias)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_policia where(policia_nombre LIKE CONCAT('%','".$vpolicias."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_policia"	=> $rs->fields["id_policia"],
									"policia_nombre" 	=> $rs->fields["policia_nombre"],
									"policia_apellido_paterno" 	=> $rs->fields["policia_apellido_paterno"],
									"policia_apellido_materno" 	=> $rs->fields["policia_apellido_materno"],
									"policia_cip" 	=> $rs->fields["policia_cip"]);
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
		$rs=$db->execute("select * from tb_policia where(id_policia = '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idpolicia=$rs->fields["id_policia"];
				$this->nombres=$rs->fields["policia_nombre"];
				$this->apepat=$rs->fields["policia_apellido_paterno"];
				$this->apemat=$rs->fields["policia_apellido_materno"];			
				$this->cip=$rs->fields["policia_cip"];
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	
	public function Actualizar($vidprov,$vnom,$vapepat,$vapemat,$vcip)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_policia set policia_nombre = '".$vnom."', policia_apellido_paterno = '".$vapepat."', policia_apellido_materno = '".$vapemat."', policia_cip ='".$vcip."' where (id_policia=".$vidprov.")"))//si es exitosa la consulta			   
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
		$rs=$db->execute("select * from tb_policia");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                $vector[$row]=array("id_policia"	=> $rs->fields["id_policia"],
									"policia_nombre" 	=> $rs->fields["policia_nombre"],
									"policia_apellido_paterno" 	=> $rs->fields["policia_apellido_paterno"],
									"policia_apellido_materno" 	=> $rs->fields["policia_apellido_materno"],
									"policia_cip" 	=> $rs->fields["policia_cip"]);
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
		$rs=$db->execute("SELECT * FROM tb_policia WHERE ( policia_nombre LIKE CONCAT('%','".$vcli."','%') ) ORDER BY policia_nombre ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_policia"	=> $rs->fields["id_policia"],
									"policia_nombre" 	=> $rs->fields["policia_nombre"],
									"policia_apellido_paterno" 	=> $rs->fields["policia_apellido_paterno"],
									"policia_apellido_materno" 	=> $rs->fields["policia_apellido_materno"],
									"policia_cip" 	=> $rs->fields["policia_cip"]);
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
		if($db->_execute("DELETE FROM tb_policia WHERE (id_policia=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	///////////////////////////////////////*/	
	public function getIdpolicia(){ return $this->idpolicia;}
	public function getNombres(){ return $this->nombres;}
	public function getApePaterno(){ return $this->apepat;}
	public function getApeMaterno(){ return $this->apemat;}
	public function getCip(){ return $this->cip;}
	
}
?>