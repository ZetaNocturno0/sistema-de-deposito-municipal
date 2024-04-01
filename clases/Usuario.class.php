<?php

require_once("DBManager.class.php");

class Usuario{
	private $idusuario ;///	private $idemp ;
	private $usuario;
	private $clave;
	private $idtipo;
	
		/////////////////constructor/////////////////
	function __construct($idusuario="",$idemp="",$usuario="", $clave="", $idtipo=""){
	
         $this->setIdusuario($idusuario);//		 $this->setIdemp($idemp);//
		 $this->setUsuario($usuario);//
		 $this->setClave($clave);//
		 $this->setIdtipo($idtipo);//
		         }	
	///////////////////////////////////////////
	public function Crear($vide,$vusu,$vcla,$vt)
	{
		$resp=false;		
		$db= new DBManager('root','');	
		if($db->_execute("INSERT INTO tb_usuario (id_usuario,id_empleado,usuario_nombre,usuario_clave,id_tipo_usuario) VALUES(null,".$vide.",'".$vusu."','".$vcla."',".$vt.")")) 

		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorTipoUsuario($vu)
	{
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario where(id_tipo_usuario ='".$vu."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				 $vector[$row]=array("id_usuario"=> $rs->fields["id_usuario"],
				 					"id_empleado"=> $rs->fields["id_empleado"],
									"usuario_nombre"=> $rs->fields["usuario_nombre"],
									"usuario_clave"=> $rs->fields["usuario_clave"],
									"id_tipo_usuario"=> $rs->fields["id_tipo_usuario"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorCriterio($vu)
	{
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("select u.id_usuario,u.id_empleado,u.usuario_nombre,u.usuario_clave,u.id_tipo_usuario,t.tipo_usuario from tb_usuario as u inner join tb_tipo_usuario as t on u.id_tipo_usuario=t.id_tipo_usuario where(u.usuario_nombre like concat('%','".$vu."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				 $vector[$row]=array("id_usuario"=> $rs->fields["id_usuario"],
				 					"id_empleado"=> $rs->fields["id_empleado"],
									"usuario_nombre"=> $rs->fields["usuario_nombre"],
									"usuario_clave"=> $rs->fields["usuario_clave"],
									"id_tipo_usuario"=> $rs->fields["id_tipo_usuario"],
									"tipo_usuario"=> $rs->fields["tipo_usuario"]);
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
		$rs=$db->execute("select * from tb_usuario where(id_usuario= ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idusuario=$rs->fields["id_usuario"];
				$this->idemp=$rs->fields["id_empleado"];	
				$this->usuario=$rs->fields["usuario_nombre"];
				$this->clave=$rs->fields["usuario_clave"];
				$this->idtipo=$rs->fields["id_tipo_usuario"];				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function BuscarPorUsuario($v)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario where(usuario_nombre= '".$v."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idusuario=$rs->fields["id_usuario"];
				$this->idemp=$rs->fields["id_empleado"];	
				$this->usuario=$rs->fields["usuario_nombre"];
				$this->clave=$rs->fields["usuario_clave"];
				$this->idtipo=$rs->fields["id_tipo_usuario"];				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	
	public function Actualizar($vcod,$vem,$vu,$vc,$t)			
	{
		$resp=false;		
		$db= new DBManager('root','');	
		if($db->_execute("update tb_usuario set id_empleado=".$vem.", usuario_nombre='".$vu."', usuario_clave='".$vc."', id_tipo_usuario = ".$t." where (id_usuario=".$vcod.") "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	//////////////////////////////////
	public function desactivaPerfil($vem,$vu)			
	{
		$resp=false;		
		$db= new DBManager('root','');	
		if($db->_execute("update tb_usuario set id_tipo_usuario='".$vu."' where (id_empleado=".$vem.") "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	/////////////////////////////////*/
		
	public function ListaTotal()
	{
		$vector=null;
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                 $vector[$row]=array("id_usuario"=> $rs->fields["id_usuario"],
									"id_empleado"=> $rs->fields["id_empleado"],
									"usuario_nombre"=> $rs->fields["usuario_nombre"],
									"usuario_clave"=> $rs->fields["usuario_clave"],
									"id_tipo_usuario"=> $rs->fields["id_tipo_usuario"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	/*///////////////////////////
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
   				$vector[$row]=array("idusuario"=> $rs->fields["idusuario"],
				 					"idtienda"=> $rs->fields["idtienda"],
									"idemp"=> $rs->fields["idemp"],
									"usuario"=> $rs->fields["usuario"],
									"clave"=> $rs->fields["clave"],
									"idtipo"=> $rs->fields["idtipo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}*/
	public function Login($vNombreusu,$vContraseña)
        {
                $resp=false;
                $num_rows=0;//numero de filas afectada por la consulta
                $db= new DBManager('root','');	
        		$rs=$db->execute("SELECT * FROM tb_usuario WHERE (usuario_nombre='".$vNombreusu."' AND usuario_clave='".$vContraseña."');");
                $num_rows=$rs->getNumOfRows();
                if($num_rows>0)
                {        $resp=true;
                         $rs->firstRow(); // opcional, pero recomendado
                        while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también                               
                                $this->idusuario=$rs->fields["id_usuario"];
								$this->idemp=$rs->fields["id_empleado"];	
								$this->usuario=$rs->fields["usuario_nombre"];
								$this->clave=$rs->fields["usuario_clave"];
								$this->idtipo=$rs->fields["id_tipo_usuario"];
                               $rs->nextRow(); // Nota: nextRow() Esta situado al final
                         }
                }
                $rs->close();
                $db->closeConnection();//opcional cierra el enlace de la Base de Datos
                return $resp;
        }
	////////////////////////////////////////*/
	public function Eliminar($vcod)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM tb_usuario WHERE (id_usuario=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}					
	
	public function getIdusuario(){ return $this->idusuario;}
	public function getIdemp(){ return $this->idemp;}
	public function getUsuario(){ return $this->usuario;}
	public function getClave(){ return $this->clave;}
	public function getIdtipo(){ return $this->idtipo;}
	
	public function setIdusuario($idusuario){ $this->idusuario = $idusuario;}
	public function setIdemp($idemp){  $this->idemp = $idemp;}	
	public function setUsuario($usuario){  $this->usuario = $usuario;}	
	public function setClave($clave){  $this->clave = $clave;}	
	public function setIdtipo($idtipo){  $this->idtipo = $idtipo;}	

}




?>