<?php
   	 require("../clases/Usuario.class.php");
	     $Objusu = new Usuario();	
         $accion=$_REQUEST['txtpara'];		
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    	$cod=$Objusu->Correlativo();		
				$vNombreusu=$_REQUEST['Nombreusu'];
				$vContraseña=$_REQUEST['Clave'];
				$vTipousuario=$_REQUEST['Tipousuario'];
				
							
								//echo $vNombretrans." ".$vTipovehiculo." "." ".$vPlaca." ";
/////////////////////////////
			if($Objusu->Crear($cod,$vNombreusu,$vContraseña,$vTipousuario))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "alert('Usuario guardado correctamente');location.href ='../manusuario.php';";					
	 				echo "</script>"; 					
		          } else{ echo "No se pudo guardar";}
       }  
	 
	 ///////////////////////////// 	
	 if($accion=="M")
	   {        $vcod = $_REQUEST['cod'];
				$vNombreusu=$_REQUEST['Nombreusu'];
				$vContraseña=$_REQUEST['Clave'];
				$vTipousuario=$_REQUEST['Tipousuario'];
				
					//echo $vcod." ".	$vNombreusu." ".$vContraseña." ".$vTipousuario;
				//echo $vPlaca;
 				
				if($Objusu->Actualizar($vcod,$vNombreusu,$vContraseña,$vTipousuario))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "alert('Usuario modificado correctamente');location.href ='../manusuario.php';";					
	 				echo "</script>";
					 					
		          }else{ echo "No se pudo modificar";}
				  
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