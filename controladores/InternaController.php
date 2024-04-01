<?php
   	 require("../clases/Internamiento.class.php");
	     $Objcom = new Internamiento();	
         $accion=$_REQUEST['txtpara'];		
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    	
	            $num=$Objcom->Correlativo();		
				 $fecha=$_REQUEST['fechapedido'];
			 $idpapeleta=$_REQUEST['idpapeleta'];				
				$motor=$_REQUEST['motor'];						
				$horaing=$_REQUEST['horaing'];						
				$obs=$_REQUEST['obs'];						
				$idestadovehiculo=$_REQUEST['estadovehiculo'];				
				$idestadopago=2;	
				$idusuario=$_REQUEST['idusuario'];	
		 if($Objcom->Verificar($idpapeleta))
		 {
		   echo "<script languaje=javascript>\n"; 
	 	   echo "alert('Ya se realizo un internamiento con esta papeleta');location.href ='../maninterna.php';";					
	 	   echo "</script>";   
		 }else{
/////////////////////////////
				if($Objcom->Crear($num,$fecha,$idpapeleta,$motor,$horaing,$obs,$idestadovehiculo,$idestadopago,$idusuario))
					  {                
						echo "<script languaje=javascript>\n"; 
						echo "location.href ='../frminventario.php?id=$num';";				
						echo "</script>"; 					
					  } else{ echo "No se pudo guardar";}
			}//fin del caso contrario
       } //fin del si
	 ///////////////////////////// 	
	 if($accion=="M")
	   {        $num=$_REQUEST['cod'];				
				$codcomi=$_REQUEST['codcomi'];		
				$codinfra=$_REQUEST['codinfra'];		
				$fecha=$_REQUEST['fechapedido'];		
				$placa=$_REQUEST['placa'];		
				$marca=$_REQUEST['marca'];		
				$clase=$_REQUEST['clase'];		
				$color=$_REQUEST['color'];		
				$motor=$_REQUEST['motor'];		
				$papeleta=$_REQUEST['papeleta'];		
				$pnp=$_REQUEST['pnp'];					
				$horaing=$_REQUEST['horaing'];	
				$obs=$_REQUEST['obs'];			
				$chofer=$_REQUEST['chofer'];				
				$estado=$_REQUEST['estado'];
 				$e="c";
				if($Objcom->Actualizar($num,$codcomi,$codinfra,$fecha,$placa,$clase,$color,$papeleta,$pnp,$chofer,$marca,$motor,$horaing,$obs,$estado))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../maninterna.php';";						
	 				echo "</script>"; 					
		          }else{ echo "No se pudo modificar";}
       } 
	   
	   if($accion=="A")
	   {        $num=$_REQUEST['cod'];				
 				$e="c";
				if($Objcom->Actualizar($num,$e))
				  {   echo "listo";             
					/*echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../maninterna.php';";						
	 				echo "</script>"; 		*/			
		          }else{ echo "No se pudo modificar";}
       }       
	
			?>