<?php

//if (estaLogueado()) {
  //header('location: servicios.php');
  //exit;
//}

require_once ('requires.php');
require ('clases/usuario.php');

$errores=[];

$form = new UserRegisterForm($_POST);
$nuevoUsuario = new Usuario('', '', '');

if($_POST){

//controlar lo que llega por Post y creo las variables necesarioas para crear el objeto
  // if(isset($_POST['id'])){
  //   $id = $_POST['id'];
  // } else {
  //   $id = 0;
  // }
  // $id =  isset($_POST['id']) ? $_POST['id'] : 0;

  //limpiar para evitar que se rompa php  $_POST

  $id =  $_POST['id'] ?? 0;
  $name =  $_POST['name'] ?? '';
  $lastname =  $_POST['lastname'] ?? '';
  $email =  $_POST['email'] ?? '';
  $dni =  $_POST['dni'] ?? '';
  $codigo =  $_POST['codigo'] ?? '';
  $telefono =  $_POST['telefono'] ?? '';
  $avatar =  $_POST['avatar'] ?? '';

  $pwd = $_POST['pwd'] ?? '';
  $rpwd = $_POST['rpwd'] ?? '';

// validacion del formulario
  $form = new UserRegisterForm($_POST, $_FILES);

  if($form->isValid()){
    //creando objeto
    $nuevoUsuario = new Usuario($name,$lastname,$email);

    $nuevoUsuario->setId($id);
    $nuevoUsuario->setDni($dni);
    $nuevoUsuario->setCodigo($codigo);
    $nuevoUsuario->setTelefono($telefono);
    $nuevoUsuario->setAvatar($avatar);

    // $nuevoUsuario->GuardarUsuario();
    //  header('location: logueo.php');
  }




    //$errores = $nuevoUsuario->Validar();
    //$errores = Validar($_POST);

    if (empty($errores)) {
      //exit;
   }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
    <?php if ($form->getMessages()):
      $messages = $form->getMessages() ?>

      <!-- Si no esta vacia errores -->
      <div class="div-errores alert alert-danger">
        <ul>
          <?php foreach ($form->getMessages() as $value): ?>
          <li><?= $value?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
   <br>
    <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-white mb-4"></h2>
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Registro</h3>
                        </div>
                        <div class="card-body">
                            <form  method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="uname1">Nombre</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="name"  value="<?= $form->getName() ?>">

                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="lastname" value="<?= $form->getLastname() ?>" >

                                </div>
                                <div class="form-group">
                                    <label>Dni</label>
                                    <input type="number" class="form-control form-control-lg rounded-0" name="dni" value="<?= $form->getDni() ?>" >

                                </div>
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="codigo" value="<?= $form->getCodigo() ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="telefono" value="<?= $form->getTelefono() ?>" >

                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="email" value="<?= $form->getEmail() ?>" >

                                </div>
                                <div class="form-group">
                                    <label>Constraseña</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="pwd" value="">

                                </div>
                                <div class="form-group">
                                    <label>Repetir Constraseña</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="rpwd" value="" >

                                </div>

                                <div class="form-group">
                                    <label>Avatar</label>
                                    <input type="file" class="form-control form-control-lg rounded-0" name="avatar" value="<?= $form->getAvatar() ?>" >
                                </div>
                                <button type="submit" class="btn btn-primary boton float-right ">Registrar</button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
  </div>
  </body>
</html>
