<?php
	require_once('funcionesandres.php');

	if (estaLogueado()) {
		header('location: servicios.php');
		exit;
	}

	$name = '';
	$lastname = '';
	$dni = '';
	$areacode = '';
	$phone = '';
	$username = '';
	$email = '';

	$errores = [];

	if ($_POST) {

		$name = trim($_POST['name']);
		$lastname = trim($_POST['lastname']);
		$dni = trim($_POST['dni']);
		$areacode = trim($_POST['areacode']);
		$phone = trim($_POST['phone']);
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);

		$errores = validar($_POST, 'avatar');

		if (empty($errores)) {
			$errores = guardarImagen('avatar');

			if (empty($errores)) {
				$usuario = guardarUsuario($_POST, 'avatar');
				loguear($usuario);
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registro</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!--<integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">-->
        <style>
          .cuerpo{
            background-color:#F7F9F8;
            color: #F7F9F8;
            font-family: 'Handlee', cursive;
            }
          .formulario{
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: /*#23353C*/ rgb(45, 134, 45);
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 1%;
            }
         .btn.btn-primary{
           background-color: /*#818043*/ rgb(255, 153, 0);
          }
         /*.has-error{
           background-color: red;
          }*/
					.help-block {
						color: red;
					}
        </style>

      </head>
			<?php
			 require_once('header.html');
			?>
   <body class="cuerpo">

		<div class="container-fluid d-flex justify-content-center">

			<form method="post" class="formulario col-md-8" enctype="multipart/form-data">

        <div class="card-header">
          <h3 class="mb-0 text-center titulo-reg">Formulario de Registro</h3>
        </div>
      <br>

        <div class="form-row d-flex justify-content-center ">

					<div class="col-sm-4">
						<div class="form-group <?= isset($errores['name']) ? 'has-error' : null ?>">
							<label class="control-label">Nombre:</label>
							<input type="text" class="form-control" name="name" value="<?=$name?>">
							<span class="help-block" style="<?= !isset($errores['name']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['name']) ? $errores['name'] : ''; ?>
							</span>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group <?= isset($errores['lastname']) ? 'has-error' : null ?>">
							<label class="control-label">Apellido:</label>
							<input type="text" class="form-control" name="lastname" value="<?=$lastname?>">
							<span class="help-block" style="<?= !isset($errores['lastname']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['lastname']) ? $errores['lastname'] : ''; ?>
							</span>
						</div>
					</div>

					<div class="col-sm-8">
						<div class="form-group <?= isset($errores['dni']) ? 'has-error' : null ?>">
							<label class="control-label">DNI:</label>
							<input type="text" class="form-control" name="dni" value="<?=$dni?>">
							<span class="help-block" style="<?= !isset($errores['dni']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['dni']) ? $errores['dni'] : ''; ?>
							</span>
						</div>
					</div>

        </div>

        <div class="form-row d-flex justify-content-center ">

					<div class="col-sm-3">
						<div class="form-group <?= isset($errores['areacode']) ? 'has-error' : null ?>">
							<label class="control-label">Código de área:</label>
							<input type="text" class="form-control" name="areacode" value="<?=$areacode?>">
							<span class="help-block" style="<?= !isset($errores['areacode']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['areacode']) ? $errores['areacode'] : ''; ?>
							</span>
						</div>
					</div>

					<div class="col-sm-5">
						<div class="form-group <?= isset($errores['phone']) ? 'has-error' : null ?>">
							<label class="control-label">Número de teléfono:</label>
							<input type="text" class="form-control" name="phone" value="<?=$phone?>">
							<span class="help-block" style="<?= !isset($errores['phone']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['phone']) ? $errores['phone'] : ''; ?>
							</span>
						</div>
					</div>

					<div class="col-sm-8">
						<div class="form-group <?= isset($errores['username']) ? 'has-error' : null ?>">
							<label class="control-label">Usuario:</label>
							<input type="text" class="form-control" name="username" value="<?=$username?>">
							<span class="help-block" style="<?= !isset($errores['username']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['username']) ? $errores['username'] : ''; ?>
							</span>
						</div>
					</div>

        </div>

        <div class="form-row d-flex justify-content-center">

					<div class="col-sm-8">
						<div class="form-group <?= isset($errores['email']) ? 'has-error' : null ?>">
							<label class="control-label">Email:</label>
							<input class="form-control" type="text" name="email" value="<?=$email?>">
							<span class="help-block" style="<?= !isset($errores['email']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['email']) ? $errores['email'] : ''; ?>
							</span>
		        </div>
					</div>

					<div class="col-sm-8">
						<div class="form-group <?= isset($errores['pass']) ? 'has-error' : null ?>">
							<label class="control-label">Contraseña:</label>
							<input class="form-control" type="password" name="pass" value="">
							<span class="help-block" style="<?= !isset($errores['pass']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['pass']) ? $errores['pass'] : ''; ?>
							</span>
		        </div>
					</div>

					<div class="col-sm-8">
						<div class="form-group <?= isset($errores['pass']) ? 'has-error' : null ?>">
							<label class="control-label">Repetir Contraseña:</label>
							<input class="form-control" type="password" name="rpass" value="">
							<span class="help-block" style="<?= !isset($errores['pass']) ? 'display: none;' : ''; ?>">
								<?= isset($errores['pass']) ? $errores['pass'] : ''; ?>
							</span>
		        </div>
					</div>

					<div class="col-xs-6">
						<div class="form-group <?= isset($errores['avatar']) ? 'has-error' : null ?>">
							<label for="name" class="control-label">Subir imagen:</label>
							<input class="form-control" type="file" name="avatar" value="<?= isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : null ?>">
							<span class="help-block" style="<?= !isset($errores['avatar']) ? 'display: none;' : '' ; ?>">
								<?= isset($errores['avatar']) ? $errores['avatar'] : '' ;?>
							</span>
						</div>
					</div>
        </div>

        <div class="form-row d-flex justify-content-center">
          <button class="btn btn-primary" type="submit">Registrar</button>
        </div>

        </form>
	  	</div>
   </body>

	 <?php
	 	require_once('footer.html');
	 ?>

</html>
