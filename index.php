<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    header('Location:home');

}else if(isset($_POST['username']) && isset($_POST['password'])){

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        header('Location:home');
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'index.php';
    }
}else{
    //echo "login";
    include_once 'index.php';
}

?>
<html>
	<head>
		<title>Kali</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1><a href="#">Kali <span></span></a></h1>
				<a href="#menu">Menú</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
						<li><a href="index">Inicio</a></li>
					<li><a href="login">Iniciar Sesión</a></li>
					<li><a href="lugares">Lugares</a></li>
					<li><a href="">Ayuda</a></li>
				</ul>
			</nav>

			<!-- Banner -->
			<!--
				To use a video as your background, set data-video to the name of your video without
				its extension (eg. images/banner). Your video must be available in both .mp4 and .webm
				formats to work correctly.
			-->
				<section id="banner" data-video="images/banner">
					<div class="inner">
						<header>
							<h1>Esto es Kali</h1>
							<p>Un sitio WEB hecho para ti!<br />
							Encuentra los mejores Bares, Restaurantes, Hoteles, Departamentos y Antros ;) cerca de tu ubicación.</p>
						</header>
						<a href="#main" class="button big alt scrolly">Comenzar</a>
					</div>

				</section>

		<!-- Main -->
			<div id="main">

			<!-- One -->
				<section class="wrapper style1">
					<div class="inner">
						<header class="align-center">
							<h2>¿Cómo funciona?</h2>
							<p>Tutoriales Web | App Android.</p>
						</header>
						<!-- 2 Column Video Section -->
							<div class="flex flex-2">
								<div class="video col">
									<div class="image fit">
										<img src="images/pic07.jpg" alt="" />
											<div class="arrow">
											<div class="icon fa-play"></div>
										</div>
									</div>
									<p class="caption">
										Sitio Web
									</p>
									<a href="" class="link"><span>Da Click</span></a>
								</div>
								<div class="video col">
									<div class="image fit">
										<img src="images/pic08.jpg" alt="" />
										<div class="arrow">
											<div class="icon fa-play"></div>
										</div>
									</div>
									<p class="caption">
										App Android
									</p>
									<a href="" class="link"><span>Da Click</span></a>
								</div>
							</div>
					</div>
				</section>

			<!-- Two -->


		<!-- Footer -->
			<footer id="footer">
				<div class="inner">

				<div class="copyright">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-snapchat"><span class="label">Snapchat</span></a></li>
					</ul>
					&copy; Kali. Designed BY: IRRO. Images: <a href="https://unsplash.com">Coverr</a>. Video: <a href="https://coverr.co">Coverr</a>.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
