<?php
	session_start();

	if (isset($_COOKIE['id'])) {
		$_SESSION['id'] = $_COOKIE['id'];
	}

	function crearUsuario($data, $imagen) {
		$usuario = [
			'id' => traerUltimoID(),
			'name' => $data['name'],
			'lastname' => $data['lastname'],
			'dni' => $data['dni'],
			'areacode' => $data['areacode'],
			'phone' => $data['phone'],
			'username' => $data['username'],
			'email' => $data['email'],
			'pass' => password_hash($data['pass'], PASSWORD_DEFAULT),
			'foto' => 'images/' . $data['email'] . '.' . pathinfo($_FILES[$imagen]['name'], PATHINFO_EXTENSION)
		];
	   return $usuario;
	}

	function validar($data, $archivo) {
		$errores = [];
		$name = trim($_POST['name']);
		$lastname = trim($_POST['lastname']);
		$dni = trim($_POST['dni']);
		$areacode = trim($_POST['areacode']);
		$phone = trim($_POST['phone']);
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		$rpass = trim($_POST['rpass']);

		if ($name == '') {
			$errores['name'] = "Ingrese su primer nombre.";
		}
		if ($lastname == '') {
			$errores['lastname'] = "Ingrese su apellido.";
		}
		if ($dni == '') {
			$errores['dni'] = "Ingrese su número de DNI.";
		}
		if ($areacode == '') {
			$errores['areacode'] = "Ingrese el código de área de su número telefónico.";
		}
		if ($phone == '') {
			$errores['phone'] = "Ingrese su número telefónico.";
		}
		if ($username == '') {
			$errores['username'] = "Ingrese un nombre de usuario.";
		}
		if ($email == '') {
			$errores['email'] = "Ingrese su dirección de email.";
				} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errores['email'] = "Por favor, ingrese un formato de email válido.";
					} elseif (existeEmail($email)) {
					$errores['email'] = "Ya existe esa dirección de email en nuestra base de datos.";
					}
					if ($pass == '' || $rpass == '') {
						$errores['pass'] = "Por favor, ingrese su contraseña.";
		  				} elseif ($pass != $rpass) {
							$errores['pass'] = "La contraseña ingresada no coincide con su repetición.";
							}
							if ($_FILES[$archivo]['error'] != UPLOAD_ERR_OK) {
								$errores['avatar'] = "Suba una foto por favor.";
		  					} else {
								$ext = strtolower(pathinfo($_FILES[$archivo]['name'], PATHINFO_EXTENSION));
			  				if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'JPG') {
									$errores['avatar'] = "Formatos de foto admitidos: JPG o PNG.";
			  				}
							}
		return $errores;
	}

	function traerTodos() {

		$todosJson = file_get_contents('usuarios.json');

		$usuariosArray = explode(PHP_EOL, $todosJson);

		array_pop($usuariosArray);

		$todosPHP = [];

		foreach ($usuariosArray as $usuario) {
			$todosPHP[] = json_decode($usuario, true);
		}
		return $todosPHP;
	}

	function traerUltimoID(){

		$usuarios = traerTodos();
		if (count($usuarios) == 0) {
			return 1;
		}

		$elUltimo = array_pop($usuarios);

		$id = $elUltimo['id'];

		return $id + 1;
	}

	function existeEmail($email){

		$todos = traerTodos();

		foreach ($todos as $unUsuario) {

			if ($unUsuario['email'] == $email) {
				return $unUsuario;
			}
		}
		return false;
	}
	
	function guardarImagen($laImagen){
		$errores = [];
		if ($_FILES[$laImagen]['error'] == UPLOAD_ERR_OK) {
			// Capturo el nombre de la imagen, para obtener la extensión
			$nombreArchivo = $_FILES[$laImagen]['name'];
			// Obtengo la extensión de la imagen
			$ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Capturo el archivo temporal
			$archivoFisico = $_FILES[$laImagen]['tmp_name'];
			// Pregunto si la extensión es la deseada
			if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG') {
				// Armo la ruta donde queda gurdada la imagen
				$dondeEstoyParado = dirname(__FILE__);
				$rutaFinalConNombre = $dondeEstoyParado . '/images/' . $_POST['email'] . '.' . $ext;
				// Subo la imagen definitivamente
				move_uploaded_file($archivoFisico, $rutaFinalConNombre);
			} else {
				$errores['imagen'] = 'Formatos de foto admitidos: JPG o PNG.';
			}
		} else {
			// Genero error si no se puede subir
			$errores['imagen'] = 'Por favor, agregue una foto.';
		}
		return $errores;
	}
	// == FUNCTION - guardarUsuario ==
	/*
		- Recibe dos parámetros -> $_POST y el nombre del campo de la imagen
		- Usa la función crearUsuario()
		- Su función principal es guardar al usuario
		- Retorna el usuario para poder auto-loguear después del registro
	*/
	function guardarUsuario($data, $imagen){
		$usuario = crearUsuario($data, $imagen);
		$usuarioJSON = json_encode($usuario);
		// Inserta el objeto JSON en nuestro archivo de usuarios
		file_put_contents('usuarios.json', $usuarioJSON . PHP_EOL, FILE_APPEND);
		// Devuelvo al usuario para poder auto loguearlo después del registro
		return $usuario;
	}
	// == FUNCTION - validarLogin ==
	/*
		- Recibe un parámetro -> $_POST
		- Usa la función existeEmail()
		- Retorna un array de errores que puede estar vacio
	*/
	function validarLogin($data) {
		$arrayADevolver = [];
		$email = trim($data['email']);
		$pass = trim($data['pass']);
		if ($email == '') {
			$arrayADevolver['email'] = 'Ingrese su dirección de email';
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$arrayADevolver['email'] = 'Ingrese un formato de email válido';
		} elseif (!$usuario = existeEmail($email)) {
			$arrayADevolver['email'] = 'Esta dirección de email no está registrada';
		} else {
			// Si el mail existe, me guardo al usuario dueño del mismo
			// $usuario = existeEmail($email);

 			// Pregunto si coindice la password escrita con la guardada en el JSON
      	if (!password_verify($pass, $usuario["pass"])) {
         	$arrayADevolver['pass'] = "Password incorrecto";
      	}
		}
		return $arrayADevolver;
	}
	// FUNCTION - loguear
	/*
		- Recibe un parámetro -> el usuario
		- Guarda en sesión el ID del usuario que recibe
		- Redirecciona a perfil.php
	*/
	function loguear($usuario) {
		// Guardo en $_SESSION el ID del USUARIO
	   $_SESSION['id'] = $usuario['id'];
		header('location: servicios.php');
		exit;
	}
	// FUNCTION - estaLogueado
	/*
		- No recibe parámetros
		- Pregunta si está guardado en SESIÓN el ID del $usuarios
	*/
	function estaLogueado() {
		return isset($_SESSION['id']);
	}
	// == FUNCTION - traerId ==
	/*
		- Recibe un parámetro -> $id:
		- Devuelve el usuario si encuentra a alguno con ese ID
		- Devuelve false si no hay usuarios con ese ID
	*/
	function traerPorId($id){
		// me traigo todos los usuarios
		$todos = traerTodos();
		// Recorro el array de todos los usuarios
		foreach ($todos as $usuario) {
			if ($id == $usuario['id']) {
				return $usuario;
			}
		}
		return false;
	}
