<?
include("clases/Comisaria.class.php"); $objcom=new Comisaria();
	include("clases/Infraccion.class.php"); $objin=new Infraccion();
	include("clases/Papeleta.class.php"); $objp=new Papeleta();
	include("clases/Internamiento.class.php"); $obj=new Internamiento();
	include("clases/Inventario.class.php"); $obji=new Inventario();
	include("clases/EstadoVehiculos.class.php"); $objev=new EstadoVehiculos();
	include("clases/Marcas.class.php"); $objmar=new Marcas();
	include("clases/Colores.class.php"); $objcol=new Colores();
	include("clases/Clasevehiculos.class.php"); $objcv=new Clasevehiculos();
   $cod = $_REQUEST['id'];
   if($obj->BuscarPorCodigo($cod)){
      $fecha=$obj->getfecha();
	  $idpapeleta=$obj->getidpapeleta();
	    if($objp->BuscarPorCodigo($idpapeleta)){
	     $placa=$objp->getPlaca();
		 $papeleta = $objp->getNumpapeleta();
		 $idmarca = $objp->getIdMarca();
		 if($objmar->BuscarPorCodigo($idmarca))
		 {
		    $marca = $objmar->getMarca();
		 }
		 $idcolor = $objp->getIdcolor();
		 if($objcol->BuscarPorcodigo($idcolor))
		 {
		    $color = $objcol->getColor();
		 }
		 $idcv = $objp->getIdclasevehiculo();
		 if($objcv->BuscarPorcodigo($idcv))
		 {
		    $clase = $objcv->getClase();
		 }
	    }
	  $motor = $obj->getmotor();
	  $horaing = $obj->gethoraing();
	  $idev = $obj->getidestadovehiculo();
	  if($objev->BuscarPorcodigo($idev)){
	     $es = $objev->getEstadovehiculo();
	  }
	  $obs = $obj->getobs();
   }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificar Inventario</title>
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

<script language="javascript">
function Nuevo(f){
		
		f.action='controladores/InventarioController.php';
		f.submit();
		return true;	
	}
</script>
<style type="text/css">
<!--
.inputbox {BORDER-RIGHT: #444444 1px solid;
	PADDING-RIGHT: 3px;
	BORDER-TOP: #444444 1px solid;
	PADDING-LEFT: 3px;
	FONT-SIZE: 11px;
	PADDING-BOTTOM: 3px;
	MARGIN: 5px 0px;
	BORDER-LEFT: #444444 1px solid;
	COLOR: #444444;
	PADDING-TOP: 3px;
	BORDER-BOTTOM: #444444 1px solid
}
.Estilo3 {
	color: #FFFFFF;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo4 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 10px}
.Estilo8 {font-size: 10}
.Estilo9 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo10 {font-size: 11px}
.Estilo12 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<body>
<div class="col-md-12">
<div class="modal-dialog">
 <div class="modal-content">
   <div class="modal-body">
<form id="form1" name="form1" method="post" action="">
  <table class="table-condensed table-bordered table" >
    <tr>
      <td colspan="6" >
        <div align="center">
          <input type="hidden" name="txtpara" value="IM" />
          <strong>MODIFICAR INTERNAMIENTO </strong>
          <input type="hidden" name="cod" value="<?=$cod?>" />      
        </div></td>
    </tr>
    
    <tr>
      <td colspan="2"><div align="center">Fecha:</div></td>
      <td width="28%"><span class="Estilo12">
        <?=$fecha;?>
      </span></td>
      <td width="21%"><div align="center">Papeleta:</div></td>
      <td width="30%" colspan="2"><span class="Estilo12">
        <?=$papeleta;?>
      </span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">Placa:</div></td>
      <td><span class="Estilo12">
        <?=$placa;?>
      </span></td>
      <td><div align="center">Marca:</div></td>
      <td colspan="2"><span class="Estilo12">
        <?=$marca;?>
      </span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">Clase:</div></td>
      <td><span class="Estilo12">
        <?=$clase;?>
      </span></td>
      <td><div align="center">Motor:</div></td>
      <td colspan="2"><span class="Estilo12">
        <?=$motor;?>
      </span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">Color:</div></td>
      <td><span class="Estilo12">
        <?=$color;?>
      </span></td>
      <td><div align="center">Hora ingreso: </div></td>
      <td colspan="2"><span class="Estilo12">
        <?=$horaing;?>
      </span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">Observa.:</div></td>
      <td colspan="4"><span class="Estilo12">
        <?=$obs;?>
      </span></td>
    </tr>
	</table>
	<table class="table-condensed table-bordered table" >
    <tr>
      <th colspan="6"><div align="center">INVENTARIO
        
      </div></th>
    </tr>
    <tr>
      <td colspan="3"><div align="left"><strong>1.- ESTADO DE CARROCERIA:</strong>
      </div></td>
      <td colspan="3"><?=$es;?></td>
      </tr>
    <tr>
      <th colspan="2">2.- PARTE EXTERIOR </th>
      <th colspan="2">3.- PARTE EXTERIOR </th>
      <th colspan="2">4.- MOTOR </th>
    </tr>
	<?
	 if($obji->BuscarPorCodigo($cod)){
	    $id=$obji->getidinv();
	    $fgd=$obji->getfgd();
		$fcd=$obji->getfcd();
		$fp=$obji->getfp();
		$vi=$obji->getvi();  
		$lp=$obji->getlp();
		$lu=$obji->getlu();
		$llan=$obji->getllan();
   		$vas=$obji->getvas();
		$ee=$obji->getee();	       
		$cha=$obji->getcha();
		$ante=$obji->getante();
		$paracho=$obji->getparacho();
		$llanre=$obji->getllanre();
		$tab=$obji->gettab();
		$chapa=$obji->getchapa();
		$radio=$obji->getradio();
		$ence=$obji->getence();
		$piso=$obji->getpiso();
		$mani=$obji->getmani();
		$cenice=$obji->getcenice();		   					
		$parasol=$obji->getparasol();
		$ei=$obji->getei();
		$code=$obji->getcode();
		$gata=$obji->getgata();
		$llaru=$obji->getllaru();		    
		$ador=$obji->getador();
		$bate=$obji->getbate();
		$radiador=$obji->getradiador();
		$arranca=$obji->getarranca();
		$alterna=$obji->getalterna();
		$carbu=$obji->getcarbu();		    
		$puri=$obji->getpuri();
		$distri=$obji->getdistri();
		$bobi=$obji->getbobi();
		$ta=$obji->getta();		      
		$bujia=$obji->getbujia();
		$vca=$obji->getvca();
	 }  
	
	?>
    <tr>
      <td width="277" bordercolor="#000000">Faro grande del </td>
      <td width="109" bordercolor="#000000"><input name="ch1" type="checkbox" value="si" <? if($fgd=="si"){echo "checked";}else{echo "unchecked";}?> /></td>
      <td width="264" bordercolor="#000000">Tablero</td>
      <td width="146" bordercolor="#000000"><input name="ch14" type="checkbox" value="si" <? if($tab=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td width="273" bordercolor="#000000">Bateria</td>
      <td width="195" bordercolor="#000000"><input name="ch27" type="checkbox" value="si" <? if($bate=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Faro chico del </td>
      <td bordercolor="#000000"><input name="ch2" type="checkbox" value="si" <? if($fcd=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Chapa Contacto </td>
      <td bordercolor="#000000"><input name="ch15" type="checkbox" value="si" <? if($chapa=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Radiador</td>
      <td bordercolor="#000000"><input name="ch28" type="checkbox" value="si" <? if($radiador=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Faro Posterior </td>
      <td bordercolor="#000000"><input name="ch3" type="checkbox" value="si" <? if($fp=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Radio</td>
      <td bordercolor="#000000"><input name="ch16" type="checkbox" value="si" <? if($radio=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Arrancador</td>
      <td bordercolor="#000000"><input name="ch29" type="checkbox" value="si" <? if($arranca=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Visores</td>
      <td bordercolor="#000000"><input name="ch4" type="checkbox" value="si" <? if($vi=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Encendedor</td>
      <td bordercolor="#000000"><input name="ch17" type="checkbox" value="si" <? if($ence=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Alternador</td>
      <td bordercolor="#000000"><input name="ch30" type="checkbox" value="si" <? if($alterna=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Limpia Parabrisas </td>
      <td bordercolor="#000000"><input name="ch5" type="checkbox" value="si" <? if($lp=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Piso</td>
      <td bordercolor="#000000"><input name="ch18" type="checkbox" value="si" <? if($piso=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Carburador</td>
      <td bordercolor="#000000"><input name="ch31" type="checkbox" value="si" <? if($carbu=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Lunas</td>
      <td bordercolor="#000000"><input name="ch6" type="checkbox" value="si" <? if($lu=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Manijas</td>
      <td bordercolor="#000000"><input name="ch19" type="checkbox" value="si" <? if($mani=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Purificador</td>
      <td bordercolor="#000000"><input name="ch32" type="checkbox" value="si" <? if($puri=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Llantas</td>
      <td bordercolor="#000000"><input name="ch7" type="checkbox" value="si" <? if($llan=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Ceniceros</td>
      <td bordercolor="#000000"><input name="ch20" type="checkbox" value="si" <? if($cenice=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Distribuidor</td>
      <td bordercolor="#000000"><input name="ch33" type="checkbox" value="si" <? if($distri=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Vasos</td>
      <td bordercolor="#000000"><input name="ch8" type="checkbox" value="si" <? if($vas=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Parasoles</td>
      <td bordercolor="#000000"><input name="ch21" type="checkbox" value="si" <? if($parasol=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Bobina</td>
      <td bordercolor="#000000"><input name="ch34" type="checkbox" value="si" <? if($bobi=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Espejo Exterior </td>
      <td bordercolor="#000000"><input name="ch9" type="checkbox" value="si" <? if($ee=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Espejo Interior </td>
      <td bordercolor="#000000"><input name="ch22" type="checkbox" value="si" <? if($ei=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Tapa Aceite </td>
      <td bordercolor="#000000"><input name="ch35" type="checkbox" value="si" <? if($ta=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Chapas</td>
      <td bordercolor="#000000"><input name="ch10" type="checkbox" value="si" <? if($cha=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Coderas</td>
      <td bordercolor="#000000"><input name="ch23" type="checkbox" value="si" <? if($code=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Bujias</td>
      <td bordercolor="#000000"><input name="ch36" type="checkbox" value="si" <? if($bujia=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Antenas</td>
      <td bordercolor="#000000"><input name="ch11" type="checkbox" value="si" <? if($ante=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Gata</td>
      <td bordercolor="#000000"><input name="ch24" type="checkbox" value="si" <? if($gata=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Veh. Ce. Ab. </td>
      <td bordercolor="#000000"><input name="ch37" type="checkbox" value="si" <? if($vca=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Parachoques</td>
      <td bordercolor="#000000"><input name="ch12" type="checkbox" value="si" <? if($paracho=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Llave de Ruedas </td>
      <td bordercolor="#000000"><input name="ch25" type="checkbox" value="si" <? if($llaru=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td colspan="2" rowspan="2" align="center" bordercolor="#000000"><span class="Estilo10"></span><span class="Estilo10"></span>
	  <button name="Submit" type="button" onclick="Nuevo(this.form)" class="btn-success btn" />
	  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Registrar
	  </button>
	  <span class="Estilo10"><span class="Estilo12">
      <input type="hidden" name="idinv" value="<?=$id;?>" />
      </span></span></td>
    </tr>
    <tr>
      <td bordercolor="#000000">Llanta de Repuesto </td>
      <td bordercolor="#000000"><input name="ch13" type="checkbox" value="si" <? if($llanre=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
      <td bordercolor="#000000">Adornos</td>
      <td bordercolor="#000000"><input name="ch26" type="checkbox" value="si" <? if($ador=="si"){echo "checked";}else{echo "unchecked";}?>/></td>
    </tr>
  </table>
</form>
</div></div></div></div>
</body>
</html>
