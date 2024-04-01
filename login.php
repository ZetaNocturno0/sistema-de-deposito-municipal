<? 
session_start();
session_destroy(); ?>



<!DOCTYPE html>
<html lang="en">
<head>
<head> 
<title>Autenticacion de Usuario</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script language="javascript">
	function validarLogin(f){		
		if( isEmpty(f.user.value) ){			
			alert( "Por favor ingrese Nombre de Usuario" );
			f.user.focus();		
			return false;
		}else if( !isValidAlpha(f.user.value) ){
			f.user.focus();
			f.user.select();
			return false;		
		}
		
		if( isEmpty(f.pass.value) ){
			alert( "Por favor ingrese su Password" );
			f.pass.focus();
			return false;
		}else if( !isValidAlpha(f.pass.value) ){
			f.pass.focus();
			f.pass.select();
			return false;		
		}		
      	
	    return true;
		
	}
	function foco(){
  document.frmLogin.user.focus();
}
</script>
</head> 
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
   
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .panel-heading {
    padding: 5px 15px;
}

.panel-footer {
	padding: 1px 15px;
	color: #A0A0A0;
}

.profile-img {
	width: 96px;
	height: 96px;
	margin: 0 auto 10px;
	display: block;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
}
    </style>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container" style="margin-top:40px">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Iniciar Sesion</strong>
					</div>
					<div class="panel-body">
						<form role="form" action="controladores/LoguinController.php" onSubmit="validarLogin(this.form)" method="POST">
							<fieldset>
								<div class="row">
									<div class="center-block">
										<img class="profile-img"
											src="img/Login2.png" alt="">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control" placeholder="Usuario" name="user" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control" placeholder="Password" name="pass" type="password" value="">
											</div>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-lg btn-success btn-block"> Acceder
												<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
											</button>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<div class="panel-footer "> Derechos Protegidos &copy; 2022</div>
                </div>
			</div>
		</div>
	</div>
<script type="text/javascript">

</script>
</body>
</html>
