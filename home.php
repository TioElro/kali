<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';


$userSession = new UserSession();
$user = new User();
if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'home.php';

}else if(isset($_POST['username']) && isset($_POST['password'])){

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once 'home.php';
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        header('Location:index');
    }
}else{
    //echo "login";
    header('Location:index');
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
				<h1><a href="#"><?php echo $_SESSION['user'];?><span> mi favorito!</span></a></h1>
				<a href="#menu">Menú</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
						<li><a href="index">Inicio</a></li>
					<li><a href="lugaresuser">Lugares</a></li>
					<li><a href="">Ayuda</a></li>
					<li><a href="includes/logout">Cerrar Sesión</a></li>
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
							<h1>Hola <?php echo $user->getNombre();  ?></h1>
							<p>Listo para navegar!<br />
							Presiona Comenzar para ir al menu de búsqueda.</p>
						</header>
						<a href="lugaresuser" class="button big alt scrolly">Comenzar</a>
					</div>

				</section>


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
