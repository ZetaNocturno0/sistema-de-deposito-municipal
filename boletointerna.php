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
	include("clases/Salida.class.php"); $objsal=new Salida();
   $cod = $_REQUEST['id'];
   $salidafec = $objsal->BuscarFecha($cod);
   $salidahor = $objsal->BuscarHora($cod);
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
<title>Registro Documentado</title>
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
<script language="javascript"> 
function imprimir() { 
if (navigator.appName.substring(0,8) == 'Netscape') { 
if (parseInt(navigator.appVersion.substring(0,1)) > 3) { 
window.print(); 
} else { 
alert("Esta funcion esta disponible solo para\nNetscape y Explorer version 4 o superiores.\nUd. Puede imprimir seleccionando la funcion\nImprimir del menu Archivo de su navegador\n"); 
} 
} else { 
// IE 5.0 or later 
if ((navigator.appVersion.indexOf(5)) != -1) { 
//alert("IE 5 or above "); 
window.print(); 
} else { 
// IE 4.0 versions 
if (parseInt(navigator.appVersion.substring(0,1)) > 3) { 
// añadir un confirm 
// Si se utiliza OLECMDEXECOPT_DONTPROMPTUSER y al dialogo de la impresora se 
// le da cancelar se va en error y ya no saca el dialogo.... 

if (confirm('¿Este seguro que desea imprimir?')) { 
var OLECMDID_PRINT = 6; 
var OLECMDEXECOPT_DONTPROMPTUSER = 2; 
var OLECMDEXECOPT_PROMPTUSER = 1; 
var WebBrowser = "<OBJECT ID=\"WebBrowser1\" WIDTH=0 HEIGHT=0 CLASSID=\"CLSID:8856F961-340A-11D0-A96B-00C04FD705A2\"></OBJECT>"; 
document.body.insertAdjacentHTML("beforeEnd", WebBrowser); 
WebBrowser1.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER); 
WebBrowser1.outerHTML = ""; 
} 

} else { 
alert("Esta funcion esta disponible solo para\nNetscape y Explorer version 4 o superiores.\nUd. Puede imprimir seleccionando la funcion\nImprimir del menu Archivo de su navegador\n"); 
} 
} 
} 
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
.Estilo6 {
	color: #000000;
	font-size: 11px;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo15 {font-size: 11px}
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="700" class="table-bordered" >
    <tr>
      <td width="700" height="127" colspan="6"><table width="690" border="0" align="center">
        <tr>
          <td width="350" align="center" rowspan="3"><img src="img/muni.png" width="267" height="119" /></td>
          <td width="350" align="center" class="Estilo17"><span class="Estilo7">FORMATO N&deg; 1 </span></td>
        </tr>
        <tr>
          <td align="center" valign="top" class="Estilo17"><span class="Estilo7">N&deg;
              <?=$cod;?>
              <span class="Estilo6 ">
            <input type="hidden" name="cod" value="<?=$cod?>" />
            <input type="hidden" name="txtpara" value="I" />
            </span></span> </td>
        </tr>
        <tr>
          <td align="center"><a href="javascript:imprimir();" class="titulito a">Imprimir</a></td>
        </tr>
      </table></td>
    </tr>
  </table>
	<p></p>
	<table width="700" class="table-bordered">
    <tr>
      <td width="695" colspan="6"><div align="center" class="Estilo6 Estilo7">
        <table width="100%" border="0">
          <tr>
            <td colspan="2" align="center"><strong>BOLETO DE INTERNAMIENTO - DMV </strong></td>
            </tr>
          <tr>
            <td width="50%" align="center">FECHA</td>
            <td width="50%" align="center">PLACA</td>
          </tr>
          <tr>
            <td align="center"><span class="Estilo14"><strong>
              <?=$fecha;?>
            </strong></span></td>
            <td align="center"><span class="Estilo14"><strong>
              <?=$placa;?>
            </strong></span></td>
          </tr>
        </table>
      </div></td>
    </tr>
	</table>
	<p></p>
	<table width="700" class="table-bordered" >
      <tr class="table-condensed table">
        <td width="138" class="Estilo17">Fecha Ingreso:</td>
        <td width="201"><?=$fecha;?></td>
        <td width="137" class="Estilo17">Papeleta:</td>
        <td width="204"><?=$papeleta;?>        </td>
      </tr>
      <tr class="table-condensed table">
        <td class="Estilo17">Hora Ingreso: </td>
        <td><?=$horaing;?></td>
        <td class="Estilo17">Placa:</td>
        <td><?=$placa;?></td>
      </tr>
      <tr class="table-condensed table">
        <td class="Estilo17">Motor:</td>
        <td><?=$motor;?></td>
        <td class="Estilo17">Marca:</td>
        <td><?=$marca;?>        </td>
      </tr>
      <tr class="table-condensed table">
        <td class="Estilo17">Clase de Vehiculo:</td>
        <td><?=$clase;?>        </td>
        <td class="Estilo17">Fecha Salida:</td>
        <td><?=$salidafec;?></td>
      </tr>
      <tr class="table-condensed table">
        <td class="Estilo17">Color:</td>
        <td><?=$color;?></td>
        <td class="Estilo17">Hora Salida: </td>
        <td><?=$salidahor;?></td>
      </tr>
</table>
    <p></p>
    <table width="700" class="table-bordered">
    <tr>
      <td colspan="6"><div align="center" class="Estilo17">INVENTARIO</div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="left" class="Estilo17">1.- ESTADO DE CARROCERIA:</div></td>
      <td colspan="4"><?=$es;?></td>
      </tr>
    <tr>
      <td colspan="2"><span class="Estilo17">2.- PARTE EXTERIOR </span></td>
      <td colspan="2"><span class="Estilo17">3.- PARTE EXTERIOR </span></td>
      <td colspan="2"><span class="Estilo17">4.- MOTOR </span></td>
    </tr>
	<?
	 if($obji->BuscarPorCodigo($cod)){
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
      <td width="140">Faro grande del </td>
      <td width="110">
        <? if($fgd=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>      </td>
      <td width="111">Tablero</td>
      <td width="109">
        <? if($tab=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>      </td>
      <td width="84">Bateria</td>
      <td width="122"><span class="Estilo14">
        <? if($bate=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Faro chico del</td>
      <td><span class="Estilo14">
        <? if($fcd=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Chapa Contacto </td>
      <td><span class="Estilo14">
        <? if($chapa=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Radiador</td>
      <td><span class="Estilo14">
        <? if($radiador=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Faro Posterior </td>
      <td><span class="Estilo14">
        <? if($fp=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Radio</td>
      <td><span class="Estilo14">
        <? if($radio=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Arrancador</td>
      <td><span class="Estilo14">
        <? if($arranca=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Visores</td>
      <td><span class="Estilo14">
        <? if($vi=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Encendedor</td>
      <td><span class="Estilo14">
        <? if($ence=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Alternador</td>
      <td><span class="Estilo14">
        <? if($alterna=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Limpia Parabrisas </td>
      <td><span class="Estilo14">
        <? if($lp=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Piso</td>
      <td><span class="Estilo14">
        <? if($piso=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Carburador</td>
      <td><span class="Estilo14">
        <? if($carbu=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Lunas</td>
      <td><span class="Estilo14">
        <? if($lu=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Manijas</td>
      <td><span class="Estilo14">
        <? if($mani=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Purificador</td>
      <td><span class="Estilo14">
        <? if($puri=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Llantas</td>
      <td><span class="Estilo14">
        <? if($llan=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Ceniceros</td>
      <td><span class="Estilo14">
        <? if($cenice=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Distribuidor</td>
      <td><span class="Estilo14">
        <? if($distri=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Vasos</td>
      <td><span class="Estilo14">
        <? if($vas=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Parasoles</td>
      <td><span class="Estilo14">
        <? if($parasol=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Bobina</td>
      <td><span class="Estilo14">
        <? if($bobi=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Espejo Exterior </td>
      <td><span class="Estilo14">
        <? if($ee=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Espejo Interior </td>
      <td><span class="Estilo14">
        <? if($ei=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Tapa Aceite </td>
      <td><span class="Estilo14">
        <? if($ta=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Chapas</td>
      <td><span class="Estilo14">
        <? if($cha=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Coderas</td>
      <td><span class="Estilo14">
        <? if($code=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Bujias</td>
      <td><span class="Estilo14">
        <? if($bujia=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Antenas</td>
      <td><span class="Estilo14">
        <? if($ante=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Gata</td>
      <td><span class="Estilo14">
        <? if($gata=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Veh. Ce. Ab. </td>
      <td><span class="Estilo14">
        <? if($vca=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
    </tr>
    <tr>
      <td>Parachoques</td>
      <td><span class="Estilo14">
        <? if($paracho=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Llave de Ruedas </td>
      <td><span class="Estilo14">
        <? if($llaru=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td><span class="Estilo15"></span></td>
      <td><span class="Estilo15"></span></td>
    </tr>
    <tr>
      <td>Llanta de Repuesto </td>
      <td><span class="Estilo14">
        <? if($llanre=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td>Adornos</td>
      <td><span class="Estilo14">
        <? if($ador=="si"){echo "<img src='confirmar.gif' width='15' height='15'/>";}else{echo "";}?>
      </span></td>
      <td><span class="Estilo15"></span></td>
      <td><span class="Estilo15"></span></td>
    </tr>
	<tr>
	  	<td><span class="Estilo17">5.- OBSERVACIONES:</span></td>
        <td colspan="5"><?=$obs;?></td>
	 </tr>

    <tr>
      <td valign="top"><span class="Estilo15"></span></td>
      <td colspan="5" valign="top"><span class="Estilo15"></span></td>
    </tr>
    <tr>
      <td colspan="6" valign="top"><table class="table">
        
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">____________________</td>
          <td align="center">____________________</td>
          <td align="center">____________________</td>
        </tr>
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif" align="center" class="Estilo15"><span class="Estilo3">PNP</span></td>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif" align="center" class="Estilo15"><span class="Estilo3">VIGILANTE</span></td>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif" align="center" class="Estilo15"><span class="Estilo3">INTERVENIDO</span></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
