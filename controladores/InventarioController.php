<?php
   	 require("../clases/Inventario.class.php");
	     $Objcom = new Inventario();	
         $accion=$_REQUEST['txtpara'];		
	 ////////////////////////////////// 		
      if($accion=="I")
	   {    	
	            $num=$_REQUEST['cod'];			
				$fgd=$_REQUEST['ch1'];		
				$fcd=$_REQUEST['ch2'];		
				$fp=$_REQUEST['ch3'];		
				$vi=$_REQUEST['ch4'];	
				$lp=$_REQUEST['ch5'];					
				$lu=$_REQUEST['ch6'];	
				$llan=$_REQUEST['ch7'];				
				$vas=$_REQUEST['ch8'];						
				$ee=$_REQUEST['ch9'];						
				$cha=$_REQUEST['ch10'];						
				$ante=$_REQUEST['ch11'];				
				$paracho=$_REQUEST['ch12'];	
				$llanre=$_REQUEST['ch13'];	
				
				$tab=$_REQUEST['ch14'];	
				$chapa=$_REQUEST['ch15'];				
				$radio=$_REQUEST['ch16'];
				$ence=$_REQUEST['ch17'];
				$piso=$_REQUEST['ch18'];
				$mani=$_REQUEST['ch19'];
				$cenice=$_REQUEST['ch20'];	
				$parasol=$_REQUEST['ch21'];	
				$ei=$_REQUEST['ch22'];	
				$code=$_REQUEST['ch23'];	
				$gata=$_REQUEST['ch24'];	
				$llaru=$_REQUEST['ch25'];	
				$ador=$_REQUEST['ch26'];
					
				$bate=$_REQUEST['ch27'];	
				$radiador=$_REQUEST['ch28'];	
				$arranca=$_REQUEST['ch29'];	
				$alterna=$_REQUEST['ch30'];	
				$carbu=$_REQUEST['ch31'];	
				$puri=$_REQUEST['ch32'];	
				$distri=$_REQUEST['ch33'];	
				$bobi=$_REQUEST['ch34'];	
			    $ta=$_REQUEST['ch35'];	
				$bujia=$_REQUEST['ch36'];	
				$vca=$_REQUEST['ch37'];	
/////////////////////////////
			if($Objcom->Crear($num,$fgd,$fcd,$fp,$vi,$lp,$lu,$llan,$vas,$ee,$cha,$ante,$paracho,$llanre,$tab,$chapa,$radio,$ence,$piso,$mani,$cenice,$parasol,$ei,$code,$gata,$llaru,$ador,$bate,$radiador,$arranca,$alterna,$carbu,$puri,$distri,$bobi,$ta,$bujia,$vca))
				  { //echo "yaaaaaaa";               
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../boletointerna.php?id=$num';";					
	 				echo "</script>"; 			
		          } else{ echo "No se pudo guardar";} 
       }  	
	 ///////////////////////////// 	
	 if($accion=="IM")
	   {        $id=$_REQUEST['idinv'];			
	   			$num=$_REQUEST['cod'];			
				$fgd=$_REQUEST['ch1'];		
				$fcd=$_REQUEST['ch2'];		
				$fp=$_REQUEST['ch3'];		
				$vi=$_REQUEST['ch4'];	
				$lp=$_REQUEST['ch5'];					
				$lu=$_REQUEST['ch6'];	
				$llan=$_REQUEST['ch7'];				
				$vas=$_REQUEST['ch8'];						
				$ee=$_REQUEST['ch9'];						
				$cha=$_REQUEST['ch10'];						
				$ante=$_REQUEST['ch11'];				
				$paracho=$_REQUEST['ch12'];	
				$llanre=$_REQUEST['ch13'];	
				
				$tab=$_REQUEST['ch14'];	
				$chapa=$_REQUEST['ch15'];				
				$radio=$_REQUEST['ch16'];
				$ence=$_REQUEST['ch17'];
				$piso=$_REQUEST['ch18'];
				$mani=$_REQUEST['ch19'];
				$cenice=$_REQUEST['ch20'];	
				$parasol=$_REQUEST['ch21'];	
				$ei=$_REQUEST['ch22'];	
				$code=$_REQUEST['ch23'];	
				$gata=$_REQUEST['ch24'];	
				$llaru=$_REQUEST['ch25'];	
				$ador=$_REQUEST['ch26'];
					
				$bate=$_REQUEST['ch27'];	
				$radiador=$_REQUEST['ch28'];	
				$arranca=$_REQUEST['ch29'];	
				$alterna=$_REQUEST['ch30'];	
				$carbu=$_REQUEST['ch31'];	
				$puri=$_REQUEST['ch32'];	
				$distri=$_REQUEST['ch33'];	
				$bobi=$_REQUEST['ch34'];	
				$ta=$_REQUEST['ch35'];	
				$bujia=$_REQUEST['ch36'];	
				$vca=$_REQUEST['ch37'];
	if($id=="")
	{
	   if($Objcom->Crear($num,$fgd,$fcd,$fp,$vi,$lp,$lu,$llan,$vas,$ee,$cha,$ante,$paracho,$llanre,$tab,$chapa,$radio,$ence,$piso,$mani,$cenice,$parasol,$ei,$code,$gata,$llaru,$ador,$bate,$radiador,$arranca,$alterna,$carbu,$puri,$distri,$bobi,$ta,$bujia,$vca))
				  { //echo "yaaaaaaa";               
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../boletointerna.php?id=$num';";					
	 				echo "</script>"; 			
		          } else{ echo "No se pudo guardar";} 
	}else{
 				
		if($Objcom->Actualizar($id,$num,$fgd,$fcd,$fp,$vi,$lp,$lu,$llan,$vas,$ee,$cha,$ante,$paracho,$llanre, $tab,$chapa,$radio,$ence,$piso,$mani,$cenice,$parasol,$ei,$code,$gata,		$llaru,$ador, $bate,$radiador,$arranca,$alterna,$carbu,$puri,$distri,$bobi,$ta,$bujia,$vca))
				  {                
					echo "se modifico correctamente"; 					
		          }else{ echo "No se pudo modificar";}
		 }
       }   
	
			?>