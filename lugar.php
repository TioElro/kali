<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

// En este apartado se puede agregar sesion para usuarios registrados
$username = $_SESSION['user'];
$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";
if(isset($_GET['id'])){
	$conn = mysqli_connect($host, $user, $password, $database);
	$Datoslugar = "SELECT * FROM lugares
  WHERE id = '$_GET[id]' ";
  $sql_statement = $conn->prepare($Datoslugar);

	$sql_statement->execute();
	$result = $sql_statement->get_result();

}else{
	header('Location:lugaresuser');
}
?>
<html>
	<head><?php 	if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {?>
		<title><?php echo $row['nombrelugar']?></title>
		<meta charset="utf-8" />
		<link type="image/x-icon" rel="icon" href="http://www.zkreations.com/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="dist/sheetslider.min.css"/>
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<h1><a href="#">Kali - <span><?php echo $row['nombrelugar']?></span></a></h1>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<nav id="menu">
			<ul class="links">
					<li><a href="home">Inicio</a></li>
				<li><a href="lugaresuser">Lugares</a></li>
				<li><a href="">Ayuda</a></li>
				<li><a href="includes/logout.php">Cerrar Sesión</a></li>
			</ul>
		</nav>
		<!-- Main -->
			<div id="main">
				<section class="wrapper style1">
				<div class="inner">

				<!-- Intro -->

								<div class="row">
									<section class="6u 12u$(medium)">
										<h2>Que es <?php echo $row['nombrelugar']?></h2>
										<p><strong>Descripción:</strong> <?php echo $row['descripcion']?></p>
									</section>
									<section class="3u 6u(medium) 12u$(small)">
										<h3>Dirección</h3>
										<p><a href="https://www.google.com/maps/search/<?php echo $row['direccion']?>"><?php echo $row['direccion']?></a></p>
									</section>
									<section class="3u$ 6u$(medium) 12u$(small)">
										<h3>Contacto</h3>
										<p><strong>Telefono:</strong> <?php echo $row['telefono']?></p>
										<p><strong>Correo:</strong> <?php echo $row['correo']?></p>
									</section>
								</div>

								<hr class="major" />

								<!-- Content -->
									<h2 id="content">Conoce más de <?php echo $row['nombrelugar']?></h2>
									<p>En esta parte puede venir incluida la HISTORIA del lugar.</p>
									<h2 id="content">Imágenes del lugar</h2>
									<div class="sheetSlider sh-default sh-auto">
									   <input id="s1" type="radio" name="slide1" checked/>
									   <input id="s2" type="radio" name="slide1"/>
									   <input id="s3" type="radio" name="slide1"/>
									   <input id="s4" type="radio" name="slide1"/>
									   <input id="s5" type="radio" name="slide1"/>
									   <div class="sh__content">

									      <!-- Slider Item -->
									      <div class="sh__item">
									         <img src="img/slide-img01.jpg" alt="imgText"/>
									         <!-- Item Info -->
									         <div class="sh__meta">
									            <h4>Artwork surreal</h4>
									            <span>Secondary text without link</span>
									         </div>
									      </div>

									      <!-- Slider Item -->
									      <div class="sh__item">
									         <img src="img/slide-img02.jpg" alt="imgText"/>
									         <!-- Item Info -->
									         <div class="sh__meta">
									            <h4>2 Weeks</h4>
									            <span>Secondary text <a href="#urlPage">with link</a></span>
									         </div>
									      </div>

									      <!-- Slider Item -->
									      <div class="sh__item">
									         <img src="img/slide-img03.jpg" alt="imgText"/>
									         <!-- Item Info -->
									         <div class="sh__meta">
									            <h4>Cat under a carpet</h4>
									            <span>Secondary text without link</span>
									         </div>
									      </div>

									      <!-- Slider Item -->
									      <div class="sh__item">
									         <img src="img/slide-img04.jpg" alt="imgText"/>
									         <!-- Item Info -->
									         <div class="sh__meta">
									            <h4>Sheet</h4>
									            <span>Secondary text without link</span>
									         </div>
									      </div>

									      <!-- Slider Item -->
									      <div class="sh__item">
									         <img src="img/slide-img05.jpg" alt="imgText"/>
									         <!-- Item Info -->
									         <div class="sh__meta">
									            <h4>Cute girl and cat</h4>
									            <span>Secondary text without link</span>
									         </div>
									      </div>

									   </div><!-- .sh__content -->

									   <!--botones -->
									   <div class="sh__btns">
									      <label for="s1"></label>
									      <label for="s2"></label>
									      <label for="s3"></label>
									      <label for="s4"></label>
									      <label for="s5"></label>
									   </div><!-- .sh__btns -->

									   <!--flechas-->
									   <div class="sh__arrows">
									      <label for="s1"></label>
									      <label for="s2"></label>
									      <label for="s3"></label>
									      <label for="s4"></label>
									      <label for="s5"></label>
									   </div><!-- .sh__arrows -->

									   <!--Control-->
									   <button class="sh-control"></button>
									</div><!-- .sheetSlider -->

									</div>

						<?php	}?>
				<?php	}else{
						header('Location:lugaresuser');
					}?>



				<hr class="major" />


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
			<script src="dist/sheetslider.min.js"></script>

	</body>
</html>
