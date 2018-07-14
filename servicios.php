<?php
	require_once('funcionesandres.php');
	if (!estaLogueado()) {
		header('location: login.php');
		exit;
	}

$usuario = traerPorId($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>servicios</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
		<link href="https://unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css" rel="stylesheet">
	</head>

	<header class="main-header">
		<img src="images/logoms.png" alt="logotipo" class="logo">
		<br>
		<a href="#" class="toggle-nav">
			<i class="icon ion-md-menu"></i>
		</a>

		<nav class="botones-navegacion">
			<ul>
				<li><a href="index.php" class="nav1" target="_self">inicio</a></li>
				<li><a href="logout.php" class="nav1" target="_self">logout</a></li>
				<li><a href="faq.php" class="nav1" target="_self">preguntas frecuentes</a></li>
				<li><a href="servicios.php" class="nav1" target="_self">servicios</a></li>
				<li class="holafoto">
					<div class="saludo"><p>Hola <?=$usuario['name']?></p></div>
					<div><img class="img-rounded" src="<?=$usuario['foto']?>" height="70"></div>
				</li>
			</ul>
		</nav>
	</header>

	<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script>
			/* global $ */
			$('.toggle-nav').click(function () {
			$('.botones-navegacion').slideToggle();
			});
		</script>

<body>
	<br><br><br>
	<h1>En Preparación</h1>
	<br><br><br>
	<!-- servicios -->
	<!--<section class="servicios">
		<article class="container">
			<img src="images/calendario.png" alt="pdto 01">
			<h2>Ingresando al Calendario pueden ver y registrar las actividades planificadas</h2>
			<p>Ayuda a estar enterado de todo evento planificado ya sea academico, deportivo o social</p>
			<a href="#">ver más</a>
		</article>
		<article class="container">
			<img src="images/materias.png" alt="pdto 01">
			<h2>Ingresando a Materias pueden consultar los dias y horarios en los que se cursan cada materia o actividad especial</h2>
			<p>Ayuda a estar informado de las materias, profesores y horarios de cursada, y no olidar el envio de carpetas, instrumentos o vestimenta para las mismas. </p>
			<a href="#">ver más</a>
		</article>
		<article class="container">
			<img src="images/chat.png" alt="pdto 01">
			<h2>Ingresando a Chat pueden enviarse mensajes al grupo general, a grupos cerrados o individuales</h2>
			<p>Ayuda a estar comunicado y conversar de intereses comunes, con la tranquilidad de saber que los mensajes no molestan a contactos generales</p>
			<a href="#">ver más</a>
		</article>
		<article class="container">
			<img src="images/objetosperdidos.png" alt="pdto 01">
			<h2>Ingresando Objetos Perdidos pueden comunicar acerca de los objetos perdidos y encontrados por sus hijos</h2>
			<p>Ayuda a comunicar los objetos que estamos buscando o que hemos encontrado</p>
			<a href="#">ver más</a>
		</article>
		<article class="container">
			<img src="images/tarea.png" alt="pdto 01">
			<h2>Ingresando a Tareas pueden ver y compatir las tareas asignadas en cada clase</h2>
			<p>Ayuda a estar comunicado y realizar un seguimiento de las tareas pendientes</p>
			<a href="#">ver más</a>
		</article>

		<article class="container">
			<img src="images/pruebas.png" alt="pdto 01">
			<h2>Ingresando a Pruebas pueden ver las fechas y temas de los proximos examenes</h2>
			<p>Ayuda a compartir temas, material de estudio, y a acompanar a sus hijos en sus estudios</p>
			<a href="#">ver más</a>
		</article>
		<article class="container">
			<img src="images/cumples.png" alt="pdto 01">
			<h2>Ingresando a Cumples pueden registrar y consultor los dias y horarios en los que se realizan festejos</h2>
			<p>Ayuda a realizar y recibir invitaciones, recordar horarios de inicio y fin y domicilios donde se realizan las fiestas </p>
			<a href="#">ver más</a>
		</article>
		<article class="container">
			<img src="images/actosescolares.png" alt="pdto 01">
			<h2>Ingresando a Actos Escolares pueden ver las fechas y horarios de los proximos actos</h2>
			<p>Ayuda a estar comunicado con los padres de alumnos que compartan asignaciones comunes, intercambiar informacion acerca de los personajes que interpretaran, organizar la produccion de disfraces, y todo lo necesario para organizar actos memorables para sus hijos</p>
			<a href="#">ver más</a>
		</article>

		<article class="container">
			<img src="images/recordatorios.png" alt="pdto 01">
			<h2>Ingresando a Recordatorios pueden ver notificaciones que se realicen sobre eventos importantes</h2>
			<p>Ayuda a estar comunicado y comunicar eventos importantes de las proximas horas</p>
			<a href="#">ver más</a>
		</article>

		<article class="container">
			<img src="images/saludyseguridad.png" alt="pdto 01">
			<h2>Ingresando a Salud y Seguridad se pueden compartir datos acerca de enfermedades y prevencion de accidentes</h2>
			<p>Ayuda a estar informado acerca de enfermedades contagiosas que se hayan diagnosticado en la clase, y otras recomendaciones o inquietudes</p>
			<a href="#">ver más</a>
		</article>

		<article class="container">
			<img src="images/lunch.png" alt="pdto 01">
			<h2>Ingresando a Lunch se pueden compartir recetas e ideas acerca de comidas ideales para enviar en las luncheras</h2>
			<p>Ayuda a compartir recetas saludables y originales para no enviarles todos los dias lo mismo;)</p>
			<a href="#">ver más</a>
		</article>

 -->

</body>

<?php
	require_once('footer.html');
?>

</html>
