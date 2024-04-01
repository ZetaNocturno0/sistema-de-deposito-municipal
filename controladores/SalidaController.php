<?php
	 require("../clases/Pagadores.class.php"); $objpag = new Pagadores();
   	 require("../clases/Salida.class.php");
	 require("../clases/Internamiento.class.php");$objin=new Internamiento();
	     $Objcom = new Salida();	
         $accion=$_REQUEST['txtpara'];
		 date_default_timezone_set('America/Lima');
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    	
	   			$vnom=strtoupper($_REQUEST['nombres']); 
				$vapepat=strtoupper($_REQUEST['apellidopaterno']);
				$vapemat=strtoupper($_REQUEST['apellidomaterno']);			
				$vdni=$_REQUEST['dni'];

               if($objpag->Crear($vnom,$vapepat,$vapemat,$vdni))
				  {         
					$cod=$_REQUEST['cod'];
					$monto=$_REQUEST['MONTO'];
					$idpagador=$objpag->BuscarPorDni($vdni);
					$recibo=$_REQUEST['recibo'];					
					$e=1;	
					$fecha = date("Y-m-d");
					$horasal=$_REQUEST['horasal'];
					$idusuario=$_REQUEST['idusuario'];		
/////////////////////////////
					if($Objcom->Crear($cod,$monto,$idpagador,$recibo,$fecha,$horasal,$idusuario))
					  {
						if($objin->ActualizarEstadopago($cod,$e)) {               
								echo "Este Internamiento ha sido Cancelado<br>Ya puede cerrar esta ventana y proceder a retirar el vehiculo"; 	
						}else{echo "no se pudo cambiar el estado";}				
					  } else{ echo "No se pudo guardar";}
	
								
		          } else{ 
				  
				  		$cod=$_REQUEST['cod'];
						$monto=$_REQUEST['MONTO'];
						$idpagador=$objpag->BuscarPorDni($vdni);
						$recibo=$_REQUEST['recibo'];					
						$e=1;	
						$fecha = date("Y-m-d");
						$horasal=$_REQUEST['horasal'];
						$idusuario=$_REQUEST['idusuario'];		
	/////////////////////////////
						if($Objcom->Crear($cod,$monto,$idpagador,$recibo,$fecha,$horasal,$idusuario))
						  {
							if($objin->ActualizarEstadopago($cod,$e)) {               
									echo "Este Internamiento ha sido Cancelado<br>Ya puede cerrar esta ventana y proceder a retirar el vehiculo"; 	
							}else{echo "no se pudo cambiar el estado";}				
						  } else{ echo "No se pudo guardar";}
				  
				  }
	   	
				
       }  	 
	 ///////////////////////////// 	
	 if($accion=="S")
	   {        $vcod = $_REQUEST['id'];
				if($Objcom->BuscarPorCodigo($vcod)){
				  // $num=$Objcom->getNum();				       			 
				   echo "este Internamiento ya se ha cancelado, por lo que el vehiculo ya no debe encontrarse en el deposito";
				}else{
				       echo "<script languaje=javascript>\n"; 
	 					echo "location.href ='../frmpago.php?id=$vcod';";					
	 					echo "</script>";	
				     }
       }      
	
			?>
