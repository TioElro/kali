<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    header('Location:index');

}else if(isset($_POST['username']) && isset($_POST['password'])){

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        header('Location:index');
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'login.php';
    }
}else{
    //echo "login";
    include_once 'login.php';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>

    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="subpage">

	<header id="header">
	<h1><a href="#">Iniciar Sesión <span>en Kali</span></a></h1>
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

	<div id="main">
    <form action="" method="POST">
        <?php
            if(isset($errorLogin)){?>
				<script type="text/javascript">
				alert("Nombre de usuario y/o password incorrecto");
			   </script>

           <?php  }
        ?>

		<section class="wrapper style1">
					<div class="inner">
						<h2>Iniciar sesión</h2>
						<p>Nombre de usuario: <br>
						<input type="text" name="username"></p>
						<p>Contraseña: <br>
						<input type="password" name="password"></p>
						<p class="center"><input type="submit" value="Iniciar Sesión"></p>
						<p>¿Aún no has creado tu <b>cuenta</b>?</p><a href="registro" class="button">Registro</a>
					</div>
				</section>

    </form>
	</div>
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
	<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>
</html>
