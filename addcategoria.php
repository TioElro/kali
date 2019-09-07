<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user']) && $_SESSION['user']=="admin"){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'addcategoria.php';

}else{
    //echo "login";
    header('Location:index');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">


      function checkform() {
    // get all the inputs within the submitted form
        if(document.getElementById('category').value==""){
          alert("Escoge una categoria");
          return false;
        }
        if(document.getElementById('nombresub').value==""){
          alert("Escribe el nombre de la categoria");
          return false;
        }
    }
    </script>
</head>
<body class="subpage">

	<header id="header">
	<h1><a href="#"><?php echo $_SESSION['user'];?>-Registro de Categorias<span> en Kali</span></a></h1>
	<a href="#menu">Menú</a>
	</header>

		<!-- Nav -->
	<nav id="menu">
	<ul class="links">
	<li><a href="home">Inicio</a></li>
	<li><a href="lugaresuser">Lugares</a></li>
	<li><a href="includes/logout">Cerrar Sesión</a></li>
	</ul>
	</nav>

	<div id="main">
    <form action="registrarcategoria.php" enctype="multipart/form-data" method="POST" onsubmit="return checkform()">

		<section class="wrapper style1">
					<div class="inner">
						<h2>Registro de SubCategorias</h2>
            <p>Escoge la Categoria Principal: <br>
              <div class="select-wrapper">
                <select name="tipolugar" id="category">
                  <option value="">- Seleccionar -</option>
                  <option value="1">Restaurantes</option>
                  <option value="2">Hospedaje</option>
                  <option value="3">Antros</option>
                  <option value="4">Bares</option>
                  <option value="5">Turismo</option>
                  <option value="6">Rutas</option>
                  <option value="8">Escuelas</option>
                  <option value="9">Tiendas</option>
                  <option value="12">Otros</option>
                </select>
              </div></p>

						<p>Nombre de la subcategoria: <br><br>
						<input type="text" id="nombresub" name="nombresub" placeholder="Ser claro con el nombre de la subcategoria"></p>
            </p>
            <p>Imagen: <br>
            <input id="imagen" name="imagen" size="30" type="file" /><br></p>
						<p class="center"><input type="submit" value="Registrar la Categoria"></p>
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
