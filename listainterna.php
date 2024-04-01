<?
/*
session_start();
if(!isset($_SESSION["usuario"]))
{
 	echo "<script languaje='JavaScript'>";       
	echo "parent.location.href='session_invalida.php'; ";
	echo "</script>";
}*/

include("clases/Internamiento.class.php");//clase
include("clases/Infraccion.class.php");$objinfra= new Infraccion();
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" href="media/css/bootstrap.css">
	<link rel="stylesheet" href="media/css/bootstrap.min.css">
	<link rel="stylesheet" href="media/css/bootstrap-theme.css">
	<link rel="stylesheet" href="media/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="media/css/fixedHeader.bootstrap.min.css">
	<link rel="stylesheet" href="media/css/responsive.bootstrap.min.css">
	 <script src="media/js/jquery-1.10.2.js"></script>
	<script src="media/js/jquery.dataTables.min.js"></script>
	<script src="media/js/dataTables.bootstrap.min.js"></script>
	<script src="media/js/dataTables.fixedHeader.min.js"></script>
	<script src="media/js/dataTables.responsive.min.js"></script>
	<script src="media/js/responsive.bootstrap.min.js"></script>
	
	<script src="media/js/jquery.min.js"></script>
    <script src="media/js/bootstrap.min.js"></script>
	
	<LINK title=win2k-cold-1 media=all href="calendario/calendar-green.css" type=text/css rel=stylesheet><!-- librería principal del calendario -->

<SCRIPT src="calendario/calendar.js" type=text/javascript></SCRIPT>
<!-- librería para cargar el lenguaje deseado -->

<SCRIPT src="calendario/calendar-es.js" type=text/javascript></SCRIPT>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->

<SCRIPT src="calendario/calendar-setup.js" type=text/javascript></SCRIPT>
<style type="text/css">
#color{
color:#003399;
font-weight:bold;
font-size:11px;
}
#color2{
color:#CC3300;
font-size: 12px;
}
#color3{
color:#000000;
font-weight:bold;
font-size: 12px;
}
.Estilo2 {font-size: 14px}
.Estilo3 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo4 {font-size: 12px}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<script language="javascript">	
	function envia(id)
	{ 
	  window.open("boletointerna.php?id="+id,"","fullscreen=no, height=850,width=800,left=200,top=100,resizable = yes,scrollbars=yes,toolbar = no,status = no");						
	}
	function envia3(id)
	{ 
	  window.open("controladores/SalidaController.php?id="+id+"&txtpara=S","","fullscreen=no, height=470,width=720,left=500,top=120,resizable = yes,scrollbars=yes,toolbar = no,status = no");						
	}
	function envia2(id)
	{ 
	  window.open("frminventariomod.php?id="+id,"","fullscreen=no, height=700,width=800,left=200,top=120,resizable = yes,scrollbars=yes,toolbar = no,status = no");						
	}
	
	//////////////////////////////////////
	function BuscarF(f)
	{
			f.action='listainterna.php'; //listar
			f.submit();
			return true;
	}

	
	///////////////////////////////////////
	function confirmLink(codigo)
	{	
		var is_confirmed = confirm("Realmente desea eliminar el registro: "+codigo);
		return is_confirmed;		
	}
	
	function NuevoIng(f)
	{
		f.action='frmcabing.php'; //antes registrar
		f.submit();
		return true;	
	}
	function salir(){ 
		document.frmMan.action='main';
		document.frmMan.submit();
		return true;			
	} 
	
	
</script>
<body style="margin-top:1%">
<div class="container">
	<div class="row">
      <div class="col-md-15">
	<form name="frmMan" method="post" action="">
<div class="form-group">
  <h4 class="Estilo3">LISTADO DE INTERNAMIENTOS<a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></h4> 
</div>

      <div class="table-responsive"> 
	<table class="table table-striped table-bordered nowrap">
	
  	<tr >
  	  <td width="100%" align="left" class="form_label"><table width="100%" border="0" align="center">
        
        <tr>
          <td><table width="1155">
              <tr>
                <td width="11%" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo2">Buscar por Placa:</span></td>
                <td width="13%" align="left"><input type="text" name="txtplaca" size="8"></td>
					
                <td width="14%" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo2">Buscar por Papeleta:</span></td>
                <td width="13%" align="left"><input type="text" name="txtpapeleta" size="8">
                  </span></td>
				  
				 <td width="12%" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo2"> Buscar por Fecha:</span></td>
				 <td width="13%" align="left">
				 <input type="text" name="fi" id="fi" size="7" placeholder="Inicio">
			<button type="button" name="lanzador1" id="lanzador1" class="btn btn-info"><span class="glyphicon glyphicon-calendar" aria-hidden="true"/></button>
			<script type="text/javascript">
				    Calendar.setup(
					  {
				        inputField     :    "fi",      // id del campo de texto
				        ifFormat       :    "%d-%m-%Y",       // formato de la fecha, cuando se escriba en el campo de texto
				        button         :    "lanzador1"   // el id del bot&oacute;n que lanzar&aacute; el calendario
			           }
					);
		</script>
				 </td>
				 <td width="5%" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo2"> Entre:</span></td>
				 <td width="13%"><input type="text" name="ff" id="ff" size="7" placeholder="Ultima">
		   <button type="button" name="lanzador2" id="lanzador2" class="btn btn-info"><span class="glyphicon glyphicon-calendar" aria-hidden="true"/></button>
			<script type="text/javascript">
				    Calendar.setup(
					  {
				        inputField     :    "ff",      // id del campo de texto
				        ifFormat       :    "%d-%m-%Y",       // formato de la fecha, cuando se escriba en el campo de texto
				        button         :    "lanzador2"   // el id del bot&oacute;n que lanzar&aacute; el calendario
			           }
					);
		</script>
				 </td>
				 <td width="6%" align="center">
				 
				 <button type="button" name="BtnBuscar2" id="BtnBuscar2" onClick="BuscarF(this.form)"class="btn-lg btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"/></button>
				 
				
				 </td>
              </tr>
              
          </table></td>
        </tr>
      </table></td>
  	</tr>
  	
  	<tr>
  	  <td align="left" ><table width="100%" class="table-hover table">
        <tr id="color3">
          <td width="83" height="18" align="center"  >PLACA</td>
          <td width="120" align="center" >MARCA</td>
          <td width="95" align="center" >CLASE</td>
          <td width="144" align="center"  >Fecha Hora Ing. </span></td>
          <td width="76" align="center"  >COLOR</td>
          <td width="148" align="center"  >MOTOR N&deg; </td>
          <td width="109" align="center"  >PAPELETA</td>
          <td width="119" align="center"  >INFRACCION</td>
		  <td width="104" align="center"  >USUARIO</td>
          <td width="138" align="center"  >ESTADO </td>
          <td colspan="3"align="center" >Acciones</td>
        </tr>
        <?php
		   $objven = new Internamiento();
		   $fi = $_REQUEST['fi'];
		   $ff = $_REQUEST['ff'];
		   $criterio = $_REQUEST['txtplaca'];		
		   $crit =$_REQUEST['txtpapeleta']; //echo $idprov;		
		 
		   if($fi=="" && $ff=="")
				{
		    	   if($criterio=="" && $crit=="")
					{
					   $listavent = $objven->ListarTodo(); 
					}else{
						  if($criterio!="" && $crit=="") {
							   $listavent = $objven->ListarPorPlaca($criterio);
						  }else{ 
								 $listavent = $objven->ListarPorPapeleta($crit);
							   }		             	
						 }	 
			    }else{
						$listavent = $objven->Filtrar($fi,$ff);             	
					 } 
					 
					 
						
		    
		////////////////////////////
		if(count((is_countable($listaventa)?$listaventa:[]))<0){
               echo "<div align='center'>";
               echo "<font face='verdana' size='-2'>No se encontraron resultados</font>";
               echo "</div>";
            }else{ 			      
			      $tamPag=20;
             	  //pagina actual si no esta definida y limites
                  if(!isset($_GET["pag"])){
        			 $pagina=1;
       			     $inicio=1;
       			     $final=$tamPag;
    			    }else{
       				     $pagina = $_GET["pag"];
    		             }
    			  //calculo del limite inferior
    			  $limitInf=($pagina-1)*$tamPag;
    			  //calculo del numero de paginas
    			  $numPags=ceil(count((is_countable($listaventa)?$listaventa:[]))/$tamPag);
    		     if(!isset($pagina))
    		       {
      		 		  $pagina=1;
      		 		  $inicio=1;
      		 		  $final=$tamPag;
    				}else{
      		 			    $seccionActual=intval(($pagina-1)/$tamPag);
       		 			    $inicio=($seccionActual*$tamPag)+1;

       					    if($pagina<$numPags){
         		 		       $final=$inicio+$tamPag-1;
       					    }else{
          					      $final=$numPags;
       					         }
       					    if ($final>$numPags){
          					    $final=$numPags;
       					       }
					      }	
		//////////////////////////////////////////////////////////////////////
		  
			         	$listaventa = $listavent;
					 
		////////////////////////////////////////////////////////////
		 for($i = 0; $i < count((is_countable($listaventa)?$listaventa:[])); $i++)		 
		 {		
		    if($objinfra->BuscarPorCodigo($listaventa[$i]["id_infraccion"])){
				$listaventa[$i]["infraccion_nombre"]=$objinfra->getdescripcion();
			} 		
		?>
        <tr>
          <td height="26" align="left"><div align="center"><span class="Estilo4">
            <?=$listaventa[$i]["papeleta_placa"];?>
          </span></div></td>
          <td align="left" >
            <span class="Estilo4">
            <div align="center">
              <?=$listaventa[$i]["marca_nombre"];?>          
            </div></td>
          <td align="left" >
          	<span class="Estilo4">
          	<div align="center">
          	  <?=$listaventa[$i]["clase_vehiculo_nombre"];?>          
        	  </div></td>
          <td align="center" >
            <span class="Estilo4">
            <div align="center">
              <?=$listaventa[$i]["internamiento_fecha_ingreso"]." / ".$listaventa[$i]["internamiento_hora_ingreso"];?> 
            </div></td>
          <td align="left" >
            <span class="Estilo4">
            <div align="center">
              <?=$listaventa[$i]["color_nombre"];?>         
            </div></td>
          <td align="left" >
            <span class="Estilo4">
            <div align="center">
              <?=$listaventa[$i]["internamiento_motor_serie"];?>          
            </div></td>
          <td align="left" >
            <span class="Estilo4">
            <div align="center">
              <?=$listaventa[$i]["papeleta_numero"];?>          
            </div></td>
          <td align="left" >
            <span class="Estilo4">
            <div align="center">
              <?=$listaventa[$i]["infraccion_codigo"];?>          
            </div></td>
			<td align="left" >
            <span class="Estilo4">
            <div align="center">
              <?=$listaventa[$i]["usuario_nombre"];?>          
            </div></td>
          <td align="left" >
            <div align="center">
              <?=($listaventa[$i]["internamiento_estado"]=='1')? "<div id=color2>LIBERADO</div>" : "<div id=color>INTERNADO</div>";?>          
            </div></td>
          <td width="40"><a href="javascript:envia('<?=$listaventa[$i]["id_internamiento"];?>');" ><span title="Imprimir" class="glyphicon glyphicon-print" aria-hidden="true"></span></a></td>
          <td width="40"><a href="javascript:envia2('<?=$listaventa[$i]["id_internamiento"];?>');"><span title="Editar" class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          <td width="40"><a href="javascript:envia3('<?=$listaventa[$i]["id_internamiento"];?>');"><span title="Cancelar Deuda" class="glyphicon glyphicon-usd" aria-hidden="true"></span></a></td>
          </tr>
        <?	
		 }			
		?>
      </table>
  	    <? }?>
        <table width="302" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="20"  align="center" valign="top">&nbsp;</td>
            <td width="282"  align="center" valign="top"><?
    if($pagina>1)
    {
       echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pag=".($pagina-1)."'>";
       echo "<font face='verdana' size='-2'>anterior</font>";
       echo "</a> ";
    }

    for($j=$inicio;$j<=$final;$j++)
    {
       if($j==$pagina)
       {
          echo "<font face='verdana' size='-2'><b>".$j."</b> </font>";
       }else{
          echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pag=".$j."'>";
          echo "<font face='verdana' size='-2'>".$j."</font></a> ";
       }
    }
    if($pagina<$numPags)
   {
       echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pag=".($pagina+1)."'>";
       echo "<font face='verdana' size='-2'>siguiente</font></a>";
   }
  
//////////fin de la paginacion
?></td>
          </tr>
          <tr>
            <td  align="center" valign="top">&nbsp;</td>
            <td  align="center" valign="top"><?  echo "<font face='verdana' size='-2'>Total encontrados: ".count((is_countable($listavent)?$listavent:[]))." registros<br>";?></td>
          </tr>
        </table>  	    </td>
  	</tr>
	</table>
	</div>
	</form>
</div></div>	</div>
</body>
</html>