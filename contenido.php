<?


include("clases/Usuario.class.php"); $obju = new Usuario();

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>PAGINA DE INICIO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
	  <script language="javascript">
		function AbrirPag()
		{
			window.open("sistema.php","top=0,left=0,height=680,width=700,fullscreen = no,resizable = no,scrollbars = yes,toolbar = no,status = yes");
		}
	</script>
	
	<link href="css/body.css" type="text/css" rel="stylesheet">
<link href="css/tables.css" type="text/css" rel="stylesheet">
<style type="text/css">
img {background-origin: content-box;}
</style>
  </head>
<body topmargin="0" style="background-image:url(/deposito/img/municipa.png); background-repeat:no-repeat; padding-top:300pt; background-position:center; ">     
        
        <table width="100%" border="0" align="center">

          <tr>
            <td><table width="100%" border="0">
              <tr>
                <td colspan="4" align="center"><a href="ticket.php"></a></td>
              </tr>
              
              <tr>
                <td align="center">BIENVENIDO AL SISTEMA </td>
              </tr>
              <tr>
                <td align="center">Para el uso del sistema empiece a navegar por el men&uacute;, cualquier consulta de su uso puede descargar el <a href="#">manual de usuario </a></td>
              </tr>
            </table></td>
          </tr>
        </table>
</body>
</html>
