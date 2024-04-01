<?
session_start();
if(!isset($_SESSION['usuario']))
{
 	echo "<script languaje='JavaScript'>";       
	echo "parent.location.href='login.php'; ";
	echo "</script>";
}
include "clases/Usuario.class.php"; $obju = new Usuario();
if($obju->BuscarPorUsuario($_SESSION['usuario'])){
  $idusuario = $obju->getIdusuario();
}

date_default_timezone_set('America/Lima');
$horaActual = date("h:i");

$dni = trim($_REQUEST['dni']);
if(strlen($dni)>=8)
{ 
	$url = file_get_contents('http://api.evarweb.com/consulta-dni/dni.php?dni='.$dni);
	$data = json_decode($url,true);
	
	if(!empty($data)){
	foreach($data as $key => $value)
	  {
		 switch($key)
		 {
		   case 'nombre': $nombre =$value; break;
		   case 'apellido_paterno' : $apellidosP=$value; break;
		   case 'apellido_materno' : $apellidosM=$value; break;
		 }
	  }
}
	   $name = $nombre." ".$apellidosP." ".$apellidosM;

		//echo "<pre>";
		//print_r($name);
		//exit;
}
include("clases/Pagadores.class.php");
include("clases/Internamiento.class.php");
include("clases/Salida.class.php");
include("clases/recvarios.class.php");
////////////////////
$vcod=$_REQUEST["id"];
$Objvent = new Internamiento();
$objprov = new Salida();
$objpag = new Pagadores();

/////////////////////////////////7


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registro Salida</title>
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
<LINK title=win2k-cold-1 media=all href="calendario/calendar-blue.css" type=text/css rel=stylesheet><!-- librería principal del calendario -->

<SCRIPT src="calendario/calendar.js" type=text/javascript></SCRIPT>
<!-- librería para cargar el lenguaje deseado -->

<SCRIPT src="calendario/calendar-es.js" type=text/javascript></SCRIPT>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->

<SCRIPT src="calendario/calendar-setup.js" type=text/javascript></SCRIPT>
<link href="estilos/styles/mantenedores.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function salir(){ 
		document.form1.action='maningresopagos.php';
		document.form1.submit();
		return true;			
	} 
</script>
<script language="javascript">
		
	function Nuevo(f)
	{  
		if(f.pagador.value==""){
			alert("CAMPO nombre pagador VACIO!");
			f.pagador.focus();
			return true;
		}
		
		if(f.MONTO.value==""){
			alert("INGRESE MONTO");
			f.MONTO.focus();
			return true;
		}
		if(f.dni.value==""){
			alert("INGRESE dni");
			f.dni.focus();
			return true;
		}
		
		if(f.nombres.value==""){
			 alert("INGRESE nombre");
			 f.nombres.focus();
			 return false;
		}
		if(f.apellidopaterno.value==""){
			 alert("INGRESE apellido");
			 f.apellidopaterno.focus();
			 return false;
		}
		if(f.apellidomaterno.value==""){
			 alert("INGRESE apellido");
			 f.apellidomaterno.focus();
			 return false;
		}
		
		//f.action='controladores/PagadorController.php';
		f.action='controladores/SalidaController.php';
		f.submit();
		return true;	
	}
	
	function persona(c){
	   document.form1.action='frmpago.php?id='+c;
	   document.form1.submit();
	   return true;
	}
	
	function buscar()
	{
	 document.form1.action='frmpago.php?id';
	 document.form1.submit(); 
	}
	
</script>
<script>
	
function es_vacio(){
  var nom = document.getElementById("nombres").value;
  var pat = document.getElementById("apellidopaterno").value;
  var mat = document.getElementById("apellidomaterno").value;
  var ren = document.getElementById("dni").value;
  
  if(ren != ""){
    document.getElementById("BtnNuevo").removeAttribute('disabled');
		if(nom != ""){
		document.getElementById("BtnNuevo").removeAttribute('disabled');
		if(pat != ""){
			document.getElementById("BtnNuevo").removeAttribute('disabled');
				if(mat != ""){
					document.getElementById("BtnNuevo").removeAttribute('disabled');
				}
				else{
					document.getElementById("BtnNuevo").setAttribute('disabled', 'disabled');
				}
		  }
		  else{
			document.getElementById("BtnNuevo").setAttribute('disabled', 'disabled');
		  }
	  }
	  else{
		document.getElementById("BtnNuevo").setAttribute('disabled', 'disabled');
	  }
  }
  else{
    document.getElementById("BtnNuevo").setAttribute('disabled', 'disabled');
  }
}


</script>

<style type="text/css">
<!--
.Estilo3 {font-size: 14px}
-->
</style>
</head>

<body>
<div class="container">
	<div class="row">
        <div class="col-md-9">
		<div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-body">
<form id="form1" name="form1" method="post" action="controladores/PagoController.php">
  <table class="table-condensed table-bordered table">
    <tr>
      <th colspan="14" >
        
      <input name="cod" type="hidden" value="<?=$vcod;?>" />
      REGISTRAR SALIDA - PAGO
      <input type="hidden" name="txtpara" value="R" />
      N&deg; <?=$vcod;?>
      </th>
    </tr>
    <tr>
      <td height="22"  scope="col" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo3">RECIBO:</span></td>
      <th colspan="4" width="1756" ><input type="text" name="recibo" value="<?php echo $_REQUEST['recibo'];?>">
	  <button type="button" name="Submit2" onClick="persona(<?=$vcod;?>);"class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Verificar</button>
	  </th>
    </tr>
	<tr>
      <td height="22" colspan="5" style="color:#999999">
	  <?php
	        $objrv = new Recvarios();
			$rec = $_REQUEST['recibo'];
			if($objrv->BuscarPorCodigo($rec))
			{
			  $con = $objrv->getConcepto();
			  echo "Concepto: ".$con;
			  $dis = "enabled";
			}else{
					echo "Este recibo no existe, pruebe nuevamente";
					$dis = "disabled";
			     }
	  ?>	
	  <input type="hidden" name="idusuario" value="<?=$idusuario;?>" /> <input type="hidden" name="horasal" value="<?=$horaActual;?>" />
	    <input name="accion" type="hidden" value="R" id="accion">
		</td>
      </tr>

    <tr>
      <td width="174" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo3">DNI:</span></td>
      <th colspan="4" width="1756" ><input type="text" name="dni" id="dni" value="<?php echo $_REQUEST['dni'];?>" onChange="es_vacio()">
      
	  <button type="button" name="Submit" onClick="persona(<?=$vcod;?>);"class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Consultar</button>
	  </th>
    </tr>
    <tr>
      <td style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo3">RESULTADO:</span></td>
      <th colspan="4" scope="col"><input name="pagador" type="text"  onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<?php echo $name;?>" size="50" maxlength="100" class="form-control" readonly="readonly"/></th>
    </tr>
	
    <tr>
		<td style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo3">NOMBRES:</span></td>
		<td><input class="form-control " type="text" name="nombres" id="nombres" placeholder="Nombres" onChange="es_vacio()"></td>
	</tr>
	<tr>
		<td style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo3">APELLIDO PATERNO:</span></td>
		<td><input class="form-control " type="text" name="apellidopaterno" id="apellidopaterno" placeholder="Apellido Paterno" onChange="es_vacio()"></td>
	</tr>
	<tr>
		<td style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo3">APELLIDO MATERNO:</span></td>
		<td><input class="form-control " type="text" name="apellidomaterno" id="apellidomaterno" placeholder="Apellido Materno" onChange="es_vacio()"></td>
	</tr>
    
    
    <tr>
      <td height="38" align="center"><button type="button" name="BtnNuevo" id="BtnNuevo" class="btn btn-success" <?php echo $dis;?> onClick="Nuevo(this.form)" disabled="disabled" ><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Registrar</button></td>
      <th colspan="4" scope="col"><input name="MONTO" type="text" size="8" maxlength="12" class="form-control" value="0" style="visibility:hidden" /></th>
    </tr>   
  </table>
  
</form>
</div></div></div></div>
</div></div>
</body>
</html>
