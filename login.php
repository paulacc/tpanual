<?php
	require_once('funcionesandres.php');

	if (estaLogueado()) {
		header('location: servicios.php');
		exit;
	}
	// Variables para persistencia
	$email = '';
	// Array de errores vacío
	$errores = [];
	// Si envían algo por $_POST
	if ($_POST) {
		$email = trim($_POST['email']);
		$errores = validarLogin($_POST);

		if (empty($errores)) {
			$usuario = existeEmail($email);
			loguear($usuario);
			// Seteo la cookie
				if (isset($_POST["recordar"])) {
	        setcookie('id', $usuario['id'], time() + 3600 * 24 * 30);
	      }
			header('location: servicios.php');
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
	</head>
	<style>
	.formulariolog {
		padding-top: 20px;
		padding-bottom: 20px;
		background-color: /*#23353C*/ rgb(45, 134, 45);
		margin-top: 20px;
		margin-bottom: 20px;
		border-radius: 1%;
		}
		.btn.btn-primary {
			background-color: /*#818043*/ rgb(255, 153, 0);
		 }
	</style>

	<?php
	 require_once('header.html');
	?>

   <body>
		
		<div class="container-fluid d-flex justify-content-center">
			<form  method="post" class="formulariolog col-md-8" enctype="multipart/form-data">

				<div class="card-header">
					<h3 class="mb-0 text-center titulo-reg">Ingrese sus credenciales:</h3>
				</div>
				<br>

				<div class="row">

					<div class="col-sm-6">
						<div class="form-group">
							<label for="name">Email:</label>
							<input class="form-control" type="text" name="email" value="<?=$email?>">
							<?php if (isset($errores['email'])): ?>
								<span style="color: red;">
									<?=$errores['email'];?>
								</span>
							<?php endif; ?>
		        </div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="name">Contraseña:</label>
							<input class="form-control" type="text" name="pass" value="">
							<?php if (isset($errores['pass'])): ?>
								<span style="color: red;">
									<?=$errores['pass'];?>
								</span>
							<?php endif; ?>
		        </div>
					</div>

				</div>

				<div class="row">

					<div class="col-sm-6">
						<div class="form-group">
							<input type="checkbox" name="recordar">
							Mantenerse logueado
						</div>
					</div>

					<div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Enviar</button>
					</div>

				</div>

      </form>
	  </div>
   </body>

	 <?php
	  require_once('footer.html');
	 ?>

</html>
