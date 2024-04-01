<?php       
	include("../clases/Usuario.class.php");
	
         $objusu =new Usuario();
         $usuario=trim($_REQUEST['user']); //recibo parametro
         $clave=trim($_REQUEST['pass']);  //recibo parametro 	
			        
		  if($objusu->Login($usuario,$clave))
		  {		 	            
			   session_start();
	   	       //$_SESSION["usuario"]=$objusu->getUsuario();//$usuario; //registrando nuevas variables de sesion
			    $_SESSION["usuario"]=$objusu->getUsuario();
			   $_SESSION["tipo"] = $usuario;
			   //echo $_SESSION["usuario"];
			  // if(@empty($_SESSION["usuario"]))
				//{
				    if($objusu->getIdtipo()==1 )
					{
		               echo "<script languaje='JavaScript'>"; 		   	     						
				       echo "location.href='../index.php';";					  
		   	           echo "</script>";
				    }
					if($objusu->getIdtipo()==2 )
					{
		               echo "<script languaje='JavaScript'>"; 		   	     						
				       echo "location.href='../indexoperador.php';";					  
		   	           echo "</script>";
				    }else
					//if($objusu->getTipo()=="X" )
					{
		               echo "<script languaje='JavaScript'>"; 		   	     						
				       echo "alert('ESTA CUENTA ESTA DESACTIVADA, CONTACTE AL ADMINISTRADOR');location.href='../login.php';";					  
		   	           echo "</script>";
				    }
				    
				//} 
          } else{
		       echo "<script languaje=javascript> alert('Ingrese un Usuario y/o Contraseña Valido'); location.href=('../login.php');</script>"; 	    
		      }
?>