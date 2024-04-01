<?php

require_once("DBManager.class.php");

class Usuario{
	private $Idusuario ;///
	private $Nombreusu ;
	private $Contrasena ;
	private $idtipo;
	///////////////////////////////////////////
	public function Correlativo()
	{
		$vCorre=1;		
		$vCont=1;
		$vCeros="";
		$vIdtipo="U";
		
		$db= new DBManager('root','');		
		$rs=$db->execute("SELECT Idusuario FROM usuario ORDER BY Idusuario ASC;");		
		if($rs->lastRow()){						
			$vCorre=intval(substr($rs->fields['Idusuario'],1));//obtengo el valor entero de la subcadena numerica
			$vCorre++;//se incrementa en 1		
		}
		for($i=1;$i<(4-strlen($vCorre));$i++){
		  $vCont++;//contador de ceros
		}		
		$vCeros=str_pad($vCeros,$vCont,'0',STR_PAD_RIGHT);//rellenar de ceros al lado derecho		
		$rs->close();
		$db->closeConnection();//opcional
		return(strtoupper($vIdtipo).$vCeros.$vCorre);			
	}
	///////////////////////////////////////
	public function Crear($vIdusuario,$vNombreusu,$vContrasena,$vidtipousuario)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO usuario (Idusuario,Nombreusu,Contrasena,idtipo) VALUES('".$vIdusuario."','".$vNombreusu."','".$vContrasena."','".$vidtipousuario."')")) 

		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorUsuario($vu)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from usuario where(Nombreusu LIKE CONCAT('%','".$vu."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				 $vector[$row]=array("Idusuario"=> $rs->fields["Idusuario"],
				 					"Nombreusu"=> $rs->fields["Nombreusu"],
									"Contrasena"=> $rs->fields["Contrasena"],
									"idtipo"=> $rs->fields["idtipo"]);
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
		$rs=$db->execute("select * from usuario where(Idusuario= '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->Idusuario=$rs->fields["Idusuario"];
				$this->Nombreusu=$rs->fields["Nombreusu"];	
				$this->Contrasena=$rs->fields["Contrasena"];			 
				$this->idtipo=$rs->fields["idtipo"];
				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function BuscarPorUsuario($user)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from usuario where(Nombreusu= '".$user."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->Idusuario=$rs->fields["Idusuario"];
				$this->Nombreusu=$rs->fields["Nombreusu"];	
				$this->Contrasena=$rs->fields["Contrasena"];			 
				$this->idtipo=$rs->fields["idtipo"];
				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	
	public function Actualizar($vcod,$vNombreusu,$vContrasena,$vidtipousuario)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update usuario set Nombreusu = '".$vNombreusu."', Contrasena='".$vContrasena."' where (Idusuario='".$vcod."') "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	/*/////////////////////////////////
	
	/////////////////////////////////*/
		
	public function ListaTotal()
	{
		$vector=null;
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from usuario");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                 $vector[$row]=array("Idusuario"=> $rs->fields["Idusuario"],
				 					"Nombreusu"=> $rs->fields["Nombreusu"],
									"Contrasena"=> $rs->fields["Contrasena"],
									"idtipo"=> $rs->fields["idtipo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	////////////////////////////
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM usuario WHERE ( Nombreusu LIKE CONCAT('%','".$vpro."','%') ) ORDER BY Idusuario ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("Idusuario"=> $rs->fields["Idusuario"],   			    				
									"Nombreusu"=> $rs->fields["Nombreusu"],
									"Contrasena"=>$rs->fields["Contrasena"],
									"idtipo"=> $rs->fields["idtipo"]);
									
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
		if($db->_execute("DELETE FROM usuario WHERE (Idusuario='".$vcod."');"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	/////////////////////////////////////////
	public function Login($vNombreusu,$vContrasena)
        {
                $resp=false;
                $num_rows=0;//numero de filas afectada por la consulta
                $db= new DBManager('root','');	
        		$rs=$db->execute("SELECT * FROM usuario WHERE (Nombreusu='".$vNombreusu."' AND Contrasena='".$vContrasena."');");
                $num_rows=$rs->getNumOfRows();
                if($num_rows>0)
                {        $resp=true;
                         $rs->firstRow(); // opcional, pero recomendado
                        while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también                               
                                $this->Idusuario=$rs->fields["Idusuario"];
								$this->Nombreusu=$rs->fields["Nombreusu"];
								$this->Contrasena=$rs->fields["Contrasena"];
								$this->idtipo=$rs->fields["idtipo"];
                               $rs->nextRow(); // Nota: nextRow() Esta situado al final
                         }
                }
                $rs->close();
                $db->closeConnection();//opcional cierra el enlace de la Base de Datos
                return $resp;
        }
		
		public function ListarPorCriterio($vu)
	{
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario where(usuario like concat('%','".$vu."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				 $vector[$row]=array("Idusuario"=> $rs->fields["Idusuario"],   			    				
									"Nombreusu"=> $rs->fields["Nombreusu"],
									"Contrasena"=>$rs->fields["Contrasena"],
									"idtipo"=> $rs->fields["idtipo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}				
	
	public function getIdusuario(){ return $this->Idusuario;}
	public function getNombreusu(){ return $this->Nombreusu;}
	public function getContrasena(){ return $this->Contrasena;}
	public function getIdtipo(){ return $this->idtipo;}
}




?>