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
    include_once 'categorias.php';

}else{
    //echo "login";
    header('Location:index.php');
}

if(isset($_GET['lugar'])){
  $_SESSION['wordkey']="Sin busqueda";
	if($_GET['lugar']=="Restaurantes")
		$_SESSION['lugar']=1;
	else if($_GET['lugar']=="Hospedajes")
		$_SESSION['lugar']=2;
	else if($_GET['lugar']=="Antros")
		$_SESSION['lugar']=3;
	else if($_GET['lugar']=="Bares")
		$_SESSION['lugar']=4;
	else if($_GET['lugar']=="Turisticos")
		$_SESSION['lugar']=5;
	else if($_GET['lugar']=="Rutas")
		$_SESSION['lugar']=6;
	else if($_GET['lugar']=="Servicios")
		$_SESSION['lugar']=7;
	else if($_GET['lugar']=="Escuelas")
		$_SESSION['lugar']=8;
	else if($_GET['lugar']=="Tiendas")
		$_SESSION['lugar']=9;
	else if($_GET['lugar']=="Empleos")
		$_SESSION['lugar']=10;
	else if($_GET['lugar']=="Viajes")
		$_SESSION['lugar']=11;
}else{
	$_SESSION['lugar']="Sin clasificar";
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
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>

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
				<section class="wrapper ">
					<div class="inner">
						<header class="align-center">
							<h2>Escoge una subcategoria para <?php echo $_GET['lugar'];?>:</h2>
              <?php if($_GET['lugar']!="Servicios" && $_GET['lugar']!="Empleos" && $_GET['lugar']!="Viajes" && $_GET['lugar']!="Rutas") {?>
							<p>Se mostrarán los lugares más cercanos a tu posición.</p>
            <?php }else if($_GET['lugar']=="Servicios"){ ?>
              <p>Se encontrán los servicios más cercanos a tu posición.</p>
            <?php }else if($_GET['lugar']=="Empleos"){ ?>
              <p>Se encontrán los empleos más cercanos a tu posición.</p>
            <?php }else if($_GET['lugar']=="Viajes"){ ?>
              <p>Se encontron los siguientes viajes.</p>
            <?php }else if($_GET['lugar']=="Rutas"){ ?>
              <p>Se encontron las siguientes rutas.</p>
            <?php } ?>
              <?php if($_GET['lugar']=="Hospedajes") {?>
                        <p>Por favor selecciona la ciudad de búsqueda.</p>
                        <div class="select-wrapper">

                          <?php
                            $query = "SELECT * FROM estados";
                            $sql_statement = $conn->prepare($query);
                            $sql_statement->execute();
                            $resulta = $sql_statement->get_result();
                            ?><select name="estado" id="state">
                              <option value="">- Selecciona un Estado -</option>
                            <?php
                            if ($resulta->num_rows > 0) {
                                while ($row = $resulta->fetch_assoc()) {
                                    echo '<option data-value="'.$row['estado'].'" value="'.$row['id_estado'].'">'.$row['estado'].'</option>';

                                }
                            }else{
                                echo '<option value="">No hay estados</option>';
                            }
                            ?>
                            </select>
                          <select name="ciudad" id="city">
                            <option value="">- Selecciona un estado primero -</option>
                          </select>
                        </div></p>

                        <script type="text/javascript">
                          $(document).ready(function(){
                              $('#state').on('change',function(){
                                  var estado = $(this).val();
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
                      <?php } ?>

                      <?php if($_GET['lugar']=="Empleos") {?>

                                <form action="elemento" method="POST" onsubmit="return checkform()">
                                <p>Por favor llena el siguiente formulario.</p>
                                <div class="select-wrapper">

                                  <select name="tienecv" id="tienecv">
                                      <option value="">- Selecciona CV -</option>
                                      <option value="1">Con CV</option>
                                      <option value="2">Sin CV</option>
                                  </select>
                                  <select name="ttiempo" id="ttiempo">
                                    <option value="">- Selecciona tiempo -</option>
                                    <option value="1">Medio</option>
                                    <option value="2">Completo</option>
                                  </select>
                                </div><br>
                                <input type="submit" value="Buscar empleo">
                              </form>
                              <?php } ?>

						</header>
						<!-- 3 Column Video Section -->
							<div class="flex flex-3">
                <?php
    							$query = "SELECT * FROM subcategorias WHERE categoria='$_SESSION[lugar]'";
    							$sql_statement = $conn->prepare($query);
    							$sql_statement->execute();
    							$resulta = $sql_statement->get_result();
    							if ($resulta->num_rows > 0) {
    									while ($row = $resulta->fetch_assoc()) {?>
                        <div class="video col">
        									<div class="image fit">
        										<img src="uploads/imagenessubcat/<?php echo $row['rutaimagen'];?>" alt="" />
        										<div class="arrow">
        											<div class="icon fa-play"></div>
        										</div>
        									</div>
        									<p class="caption">
        										<?php echo $row['subcategoria'];?>
        									</p>
        									<a id="subcat<?php echo $row['id'];?>" href="" class="link" data-value="<?php echo $row['idsub'];?>"><span>Click Me</span></a>
        								</div>
                        <?php if($_GET['lugar']=="Hospedajes") {?>
                          <script>

                          $(document).ready(function(){
                              $('#subcat<?php echo $row['id'];?>').on('click',function(){
                                  var estado = $('#state option:selected').text();
                                  var ciudad = $('#city option:selected').text();
                                  var subcategoria = $(this).data("value");
                                  var lugar= '<?php echo $_GET['lugar'];?>';
                                  if(estado!="- Selecciona un Estado -" && (ciudad!="Selecciona una ciudad" && ciudad!="No hay municipios")){
                                      $.ajax({
                                          type:'POST',
                                          url:'savesessions.php',
                                          data:{ estado: estado,ciudad: ciudad,lugar: lugar, subcategoria : subcategoria},
                                          success:function(data){
                                              window.location.replace('elemento');
                                          }
                                      });
                                  }else{
                                    alert("Por favor selecciona el estado y ciudad");
                                  }
                              });
                          });

                          </script>
                        <?php }else{ ?>
                        <script>

                        $(document).ready(function(){
                            $('#subcat<?php echo $row['id'];?>').on('click',function(){

                                var subcategoria = $(this).data("value");
                                var lugar= '<?php echo $_GET['lugar'];?>';
                                if(subcategoria){
                                    $.ajax({
                                        type:'POST',
                                        url:'savesessions.php',
                                        data:{ lugar: lugar, subcategoria : subcategoria},
                                        success:function(data){

                                            window.location.replace('elemento');
                                        }
                                    });
                                }else{
                                  alert(subcategoria);
                                }
                            });
                        });

                        </script>

    							 <?php  }

                  }
    							}
    							?>


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
