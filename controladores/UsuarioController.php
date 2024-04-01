<?php
   	 require("../clases/Usuario.class.php");
	     $Objusu = new Usuario();	
         $accion=$_REQUEST['accion'];		
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    			
				$vempleado=$_REQUEST['idemp'];
				$vusuario=$_REQUEST['usuario'];
				$vclave=$_REQUEST['clave'];
				$vtipo=$_REQUEST['tipo'];
				
								//echo $vNombretrans." ".$vTipovehiculo." "." ".$vPlaca." ";
/////////////////////////////
			if($Objusu->Crear($vempleado,$vusuario,$vclave,$vtipo))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manusuario.php';";					
	 				echo "</script>"; 					
		          } else{ echo "No se pudo guardar";}
       }  
	 
	 ///////////////////////////// 	
	 if($accion=="M")
	   {        $vcod = $_REQUEST['idusuario'];
				$vempleado=$_REQUEST['idemp'];
				$vusuario=$_REQUEST['usuario'];
				$vclave=$_REQUEST['clave'];
				$vtipo=$_REQUEST['tipo'];
				 				
				if($Objusu->Actualizar($vcod,$vempleado,$vusuario,$vclave,$vtipo))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manusuario.php';";					
	 				echo "</script>";
					 					
		          }else{ echo "No se pudo modificar";}
				  
       } 
	   
	 if($accion=="E")
	   {    			
		   $vcod=$_REQUEST['idusuario'];
              if($Objusu->Eliminar($vcod))
			    {
			        echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manusuario.php';";	//alert('Se eliminó correctamente');				
	 				echo "</script>"; 
			   }else{ //echo "No se pudo eliminar";			   			
					echo "<script languaje=javascript>\n"; 
	 				echo "alert('NO SE PUEDE ELIMINAR!!! existen campos relacionados! ');location.href ='../manusuario.php';";					
	 				echo "</script>"; 							
					}
       }    
	
	 //////////////////////////////////////////////
	 
	 
	/* $usuario=trim($_REQUEST['txtusu']); //recibo parametro
     $clave=trim($_REQUEST['txtclave']);  //recibo parametro 
	 if($accion=="L"){
	          if($Objcliente->Iniciarsesion($usuario,$clave)){
			    	 session_start();
	   	       		$_SESSION["usuario"]=$Objcliente->getUsuario;//$usuario; 
			   		if(@empty($_SESSION["usuario"]))
						{
		         			 echo "<script languaje='JavaScript'>"; 		   	     						
				 			 echo "location.href='../consultacliente.php';";
		   	      			 echo "</script>";
						}		     
          		} else {
							echo "<script languaje='JavaScript'>"; 
				  			echo "location.href='../session_inexacta.php';";
				  			echo "</script>";
	             		} 
			}*/
			?>