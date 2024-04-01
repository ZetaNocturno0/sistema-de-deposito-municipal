<?php
   	 require("../clases/Empleado.class.php");
	  require("../clases/Usuario.class.php"); $obju = new Usuario();
	     $Objcliente = new Empleado();	
         $accion=$_REQUEST['accion'];		
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    	//$cod=$Objcliente->Correlativo();
	            $vnom=strtoupper($_REQUEST['nombres']); 
				$vapepat=strtoupper($_REQUEST['apellidopaterno']);
				$vapemat=strtoupper($_REQUEST['apellidomaterno']);			
				$vtelefijo=$_REQUEST['telefijo'];
				$vemail=$_REQUEST['email'];
				$vdir=strtoupper($_REQUEST['direccion']);
				$ve=$_REQUEST['estado'];
				//$vcel = $_REQUEST['cel'];
				////////////////////////////////////////////////
				//echo $cod."-".$vruc."-".$vrazon."-".$vdni."-".$vnombres."-".$vtelefono."-".$vciudad."-".$vpais."-".$vdir."-".$vemail."-".$vtipo;
 				//////////////////////////////
               if($Objcliente->Crear($vnom,$vapepat,$vapemat,$vdir,$vtelefijo,$vemail,$ve))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manempleado.php';";					
	 				echo "</script>"; 					
		          } else{ echo "No se pudo guardar";}
       }  
	 ////////////////////////////// 	
	 if($accion=="M")
	   {        $vcod = $_REQUEST['idemp'];
	    		$vnom=strtoupper($_REQUEST['nombres']); 
				$vapepat=strtoupper($_REQUEST['apellidopaterno']);
				$vapemat=strtoupper($_REQUEST['apellidomaterno']);					
				$vtelefijo=strtoupper($_REQUEST['telefijo']);
				$vemail=$_REQUEST['email'];
				$vdir=strtoupper($_REQUEST['direccion']);
				echo $ve=$_REQUEST['estado'];
				
				if($ve=="INACTIVO"){if($obju->desactivaPerfil($vcod,"X")){;}}
				if($Objcliente->Actualizar($vcod,$vnom,$vapepat,$vapemat,$vdir,$vtelefijo,$vemail,$ve))
				  { 
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manempleado.php';";					
	 				echo "</script>"; 										
		          }else{ echo "No se pudo modificar";}
       }  
	 ///////////////////////////////
	 if($accion=="E")
	   {    			
		   $vcod=$_REQUEST['idemp'];
              if($Objcliente->Eliminar($vcod))
			    {
			        echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manempleado.php';";					
	 				echo "</script>"; 
			   }else{ echo "No se pudo eliminar";}
       }    
    /*//////////////////////////
	/*
	 $usuario=trim($_REQUEST['txtusu']); //recibo parametro
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