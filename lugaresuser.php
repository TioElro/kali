<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';
$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";
$conn = mysqli_connect($host, $user, $password, $database);
$userSession = new UserSession();
$user = new User();
if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'lugaresuser.php';

}else{
    //echo "login";
    header('Location:index.php');
}

?>
<!--
	Broadcast by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Lugares</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
  	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
      $("#changeplace").click(function(){
        $("#changeplace").hide();
        $("#changeplaces").show();
      });
      $("#changeit").click(function(){
        var estadouser = $('#state option:selected').text();
        var ciudaduser = $('#city option:selected').text();
        if(estadouser!="- Selecciona un Estado -" && (ciudaduser!="Selecciona una ciudad" && ciudaduser!="No hay municipios")){
            $.ajax({
                type:'POST',
                url:'savesessions.php',
                data:{ estadouser: estadouser,ciudaduser: ciudaduser},
                success:function(data){
                    location.reload();
                }
            });
        }else{
          alert("Por favor selecciona el estado y ciudad");
        }
      });
    });
    </script>
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<h1><a href="#"><?php echo $_SESSION['user'];?><span> mi favorito!</span></a></h1>
				<a href="#menu">Menú</a>
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

			<!-- Three -->
				<section class="wrapper">
					<div class="inner">
						<form method="post" action="elemento.php">
									<div class="row uniform">
										<div class="9u 12u$(small)">
											<input type="text" name="busqueda" id="query" value="" placeholder="Palabra Clave: Ej. Barato, Lujo, Top" />
										</div>
										<div class="3u$ 12u$(small)">
											<input type="submit" value="Buscar" class="fit" />
										</div>
									</div>
								</form>
            <p><span style="font-weight: bold">Lugar de búsqueda actual:</span><span style="color: #A05CDF"> Estado: </span><?php echo $_SESSION['estadouser'];?>, <span style="color: #A05CDF">Ciudad: </span><?php echo $_SESSION['ciudaduser'];?><p>
            <a id="changeplace" href="#" class="button alt small">Cambiar lugar de busqueda</a>

              <div id="changeplaces" class="select-wrapper" style="display:none">

                <?php
                  $query = "SELECT * FROM estados";
                  $sql_statement = $conn->prepare($query);
                  $sql_statement->execute();
                  $resulta = $sql_statement->get_result();
                  ?><select name="estado" id="state">
                    <option data-value="" value="">- Selecciona un Estado -</option>
                  <?php
                  if ($resulta->num_rows > 0) {
                      while ($row = $resulta->fetch_assoc()) {
                          echo '<option data-value="'.$row['id_estado'].'" value="'.$row['estado'].'">'.$row['estado'].'</option>';

                      }
                  }else{
                      echo '<option value="">No hay estados</option>';
                  }
                  ?>
                  </select>

                <select name="ciudad" id="city">
                  <option value="">- Selecciona un estado primero -</option>
                </select><br>
                <a id="changeit" class="button">Cambiar lugar</a>
              </div>
            <script type="text/javascript">
              $(document).ready(function(){
                  $('#state').on('change',function(){
                      var selected = $(this).find('option:selected');
                      var estado = selected.data('value');
                      if(estado){
                          $.ajax({
                              type:'POST',
                              url:'ajaxestados.php',
                              data:'estado='+estado,
                              success:function(html){
                                  $('#city').html(html);
                              }
                          });
                      }else{
                      }
                  });
              });
              </script>
						<header class="align-center">
							<h2>Escoge una categoria:</h2>
							<p>Se mostrarán los lugares más cercanos a tu posición.</p>
						</header>
						<!-- 3 Column Video Section -->
							<div class="flex flex-3">
                <div class="video col">
									<div class="image fit">
										<img src="images/Restaurantes.jpg" alt="" />
										<div class="arrow">
											<div class="icon fa-play"></div>
										</div>
									</div>
									<p class="caption">
										Restaurantes
									</p>
									<a href="categorias?lugar=Restaurantes" class="link"><span>Click Me</span></a>
								</div>
                <div class="video col">
									<div class="image fit">
										<img src="images/Hospedajes.jpg" alt="" />
										<div class="arrow">
											<div class="icon fa-play"></div>
										</div>
									</div>
									<p class="caption">
										Hospedaje
									</p>
									<a href="categorias?lugar=Hospedajes" class="link"><span>Click Me</span></a>
								</div>
                <div class="video col">
									<div class="image fit">
										<img src="images/Antros.jpg" alt="" />
										<div class="arrow">
											<div class="icon fa-play"></div>
										</div>
									</div>
									<p class="caption">
										Antros
									</p>
									<a href="categorias?lugar=Antros" class="link"><span>Click Me</span></a>
								</div>
								<div class="video col">
									<div class="image fit">
										<img src="images/Bares.jpg" alt="" />
										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Bares
  									</p>
  									<a href="categorias?lugar=Bares" class="link"><span>Click Me</span></a>
  								</div>
                  <div class="video col">
  									<div class="image fit">
  										<img src="images/Turisticos.jpg" alt="" />
  										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Turismo
  									</p>
  									<a href="categorias?lugar=Turisticos" class="link"><span>Click Me</span></a>
  								</div>
                  <div class="video col">
  									<div class="image fit">
  										<img src="images/Rutas.jpg" alt="" />
  										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Rutas
  									</p>
  									<a href="categorias?lugar=Rutas" class="link"><span>Click Me</span></a>
  								</div>
                  <div class="video col">
  									<div class="image fit">
  										<img src="images/Servicios.jpg" alt="" />
  										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Servicios
  									</p>
  									<a href="categorias?lugar=Servicios" class="link"><span>Click Me</span></a>
  								</div>
  								<div class="video col">
  									<div class="image fit">
  										<img src="images/Escuelas.jpg" alt="" />
  										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Escuelas
  									</p>
  									<a href="categorias?lugar=Escuelas" class="link"><span>Click Me</span></a>
  								</div>
  								<div class="video col">
  									<div class="image fit">
  										<img src="images/Tiendas.jpg" alt="" />
  										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Tiendas
  									</p>
  									<a href="categorias?lugar=Tiendas" class="link"><span>Click Me</span></a>
  								</div>
  								<div class="video col">
  									<div class="image fit">
  										<img src="images/Empleos.jpg" alt="" />
  										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Empleos
  									</p>
  									<a href="categorias?lugar=Empleos" class="link"><span>Click Me</span></a>
  								</div>
  								<div class="video col">
  									<div class="image fit">
  										<img src="images/Viajes.jpg" alt="" />
  										<div class="arrow">
  											<div class="icon fa-play"></div>
  										</div>
  									</div>
  									<p class="caption">
  										Viajes
  									</p>
  									<a href="categorias?lugar=Viajes" class="link"><span>Click Me</span></a>
  								</div>
								<div class="video col">
									<div class="image fit">
										<img src="images/Sin Clasificar.jpg" alt="" />
										<div class="arrow">
											<div class="icon fa-play"></div>
										</div>
									</div>
									<p class="caption">
										Otros
									</p>
									<a href="categorias?lugar=Otros" class="link"><span>Click Me</span></a>
								</div>
							</div>
					</div>
				</section>

			</div>

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
