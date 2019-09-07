<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";

$conn = mysqli_connect($host, $user, $password, $database);
// En este apartado se puede agregar sesion para usuarios registrados
$username = $_SESSION['user'];

if(isset($_POST['busqueda'])){
	$_SESSION['wordkey']=$_POST['busqueda'];
	$_SESSION['lugar']="Sin clasificar";
	$_SESSION['subcategoria']="Sin categoria";
}else{
	if(isset($_POST['tienecv']) && isset($_POST['ttiempo'])){
		$_SESSION['nombrelugar']="Empleos";
		$_SESSION['wordkey']="Sin busqueda";
		$_SESSION['lugar']="Sin clasificar";
		$_SESSION['subcategoria']="Sin categoria";
		if($_POST['tienecv']=="1"){
			$_SESSION['tienecv']="Si";
		}else{
			$_SESSION['tienecv']="No";
		}

		if($_POST['ttiempo']=="1"){
			$_SESSION['ttiempo']="Medio";
		}else{
			$_SESSION['ttiempo']="Completo";
		}
	}else if(isset($_SESSION['wordkey']) && $_SESSION['wordkey']!="Sin busqueda"){
		$_SESSION['wordkey']=$_SESSION['wordkey'];
	}else{
		$_SESSION['wordkey']="Sin busqueda";
	}
}

	require_once ("Valoracion.php");

$rate = new Rate();
$result = $rate->getAllPost();
?>
<html>
<head>
	<?php if(isset($_POST['busqueda'])) {?>
		<title>Lugares - <?php echo $_POST['busqueda'];?></title>
	<?php }else if(isset($_SESSION['nombrelugar'])){?>
		<title>Lugares - <?php echo $_SESSION['nombrelugar'];?></title>
	<?php }else if(isset($_SESSION['wordkey'])){?>
		<title>Lugares - <?php echo $_SESSION['wordkey'];?></title>
	<?php }?>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="dist/sheetslider.min.css"/>
	<!--reset y aspecto-->

	<!--Slider-->
	<link rel="stylesheet" href="dist/sheetslider.min.css"/>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script>

		function highlightStar(obj,id) {
			removeHighlight(id);
			$('.demo-table #lugares-'+id+' li').each(function(index) {
				$(this).addClass('highlight');
				if(index == $('.demo-table #lugares-'+id+' li').index(obj)) {
					return false;
				}
			});
		}

		function removeHighlight(id) {
			$('.demo-table #lugares-'+id+' li').removeClass('selected');
			$('.demo-table #lugares-'+id+' li').removeClass('highlight');
		}

		function addRating(obj,id) {
			$('.demo-table #lugares-'+id+' li').each(function(index) {
				$(this).addClass('selected');
				$('#lugares-'+id+' #valoracion').val((index+1));
				if(index == $('.demo-table #lugares-'+id+' li').index(obj)) {
					return false;
				}
			});
			$.ajax({
			url: "Agregar_valoracion.php",
			data:'id='+id+'&valoracion='+$('#lugares-'+id+' #valoracion').val(),
			type: "POST",
		    success: function(data) {
		        $("#star-rating-count-"+id).html(data);
		        }
			});
		}

		function resetRating() {
			$("#main").load("elemento.php");
		}

		function category(){
			$(document).ready(function(){
    $("#editarot_btn").click(function(){
        var ot_antigua = $("#ot_editar").val();
        var ot_nueva = $("#nueva_ot").val();
        var cuenta = $("#cuenta").val();

        $.ajax({
            type: "POST",
            url: "editar_ot.php",
            data: {ot_antigua:ot_antigua, ot_nueva:ot_nueva, cuenta:cuenta},
            success: function(){
                alert("Ha sido ejecutada la acción.");
            }
        });
    });
});
		}
	</script>
	</head>

	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<h1><a href="#"><?php echo $_SESSION['user'];?><span> Kalister!</span></a></h1>
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

				<section id="wrapp" class="wrapper style1">
				<div id="inner" class="inner">

					<table id="tablalugares" class="demo-table">
					        <tbody>
					            <tr>
												<?php if(isset($_POST['busqueda'])) {?>
					                <th><strong>Encontramos estos lugares relacionados a tu busqueda: <?php echo $_POST['busqueda']; ?></strong></th>
												<?php }else if(isset($_SESSION['wordkey']) && $_SESSION['wordkey']!="Sin busqueda"){?>
													<th><strong>Encontramos estos lugares relacionados a tu busqueda: <?php echo $_SESSION['wordkey']; ?></strong></th>
												<?php }else if(isset($_SESSION['nombrelugar'])){?>
													<th><strong>Encontramos estos <?php echo $_SESSION['nombrelugar']; ?> por la zona</strong></th>
												<?php }?>
											</tr>

					<?php
					if (! empty($result)) {
					    $i = 0;
					    foreach ($result as $lugares) {
					        $ratingResult = $rate->getRatingByTutorialForMember($lugares["id"], $username);
					        $ratingVal = "";
					        if (! empty($ratingResult[0]["valoracion"])) {
					            $ratingVal = $ratingResult[0]["valoracion"];
					        }
					        ?>
					<tr>
					                <td valign="top">
					                    <div class="feed_title" onClick=window.open('lugar?id=<?php echo $lugares["id"]; ?>','_blank'); style="cursor: pointer"><?php echo $lugares["nombrelugar"]; ?></div>
															<div class="img" onClick=window.open('lugar?id=<?php echo $lugares["id"]; ?>','_blank'); style="cursor: pointer">
																<?php if(isset($_POST['busqueda'])) {?>
									                <img src="img/fortin.jpg" alt="imgText"/>
																<?php }else if(isset($_SESSION['wordkey']) && $_SESSION['wordkey']!="Sin busqueda"){?>
																	<img src="img/fortin.jpg" alt="imgText"/>
																<?php }else if(isset($_SESSION['nombrelugar'])){?>
																	<img src="images/<?php echo $_SESSION['nombrelugar'];?>.jpg" alt="imgText"/>
																<?php }?>


												      </div>
															<div class="pdescripcion"><?php echo $lugares["descripcion"]; ?></div>
															<div><?php echo '<span style="font-weight: bold;">Dirección:</span><a href="https://www.google.com/maps/search/'.$lugares["direccion"].','.$lugares["ciudad"].','.$lugares["estado"].'" target="_blank"> Ir</a>'; ?></div>
															<div><?php echo ''.$lugares["ciudad"].', '.$lugares["estado"].''; ?></div>
															<div><?php echo 'Dirección: '.$lugares["direccion"].''; ?></div>
															<div><?php echo '<span style="font-weight: bold;">Contacto:</span>'; ?></div>
															<div><?php echo 'Telefono: '.$lugares["telefono"].''; ?></div>
															<div><?php if(!empty($lugares["correo"]))echo 'Correo: '.$lugares["correo"].''; ?></div>

					                    <div id="lugares-<?php echo $lugares["id"]; ?>"
					                        class="star-rating-box">
					                        <input type="hidden" name="valoracion" id="valoracion"
					                            value="<?php echo $ratingVal; ?>" />
					                        <ul

					                            onMouseOut="resetRating();">
					  <?php
					        for ($i = 1; $i <= 5; $i ++) {
					            $selected = "";
											if (! empty($lugares["rating_total"])) {
													$average = round(($lugares["rating_total"] / $lugares["rating_count"]), 1);
													if ($i <= $average) {
							                $selected = "selected";
							            }
												}

					            ?>
					  <li class='<?php echo $selected; ?>'
					                                onmouseover="highlightStar(this,<?php echo $lugares["id"]; ?>);"
					                                onmouseout="removeHighlight(<?php echo $lugares["id"]; ?>);"
					                                onClick="addRating(this,<?php echo $lugares["id"]; ?>);">&#9733;</li>
					  <?php }  ?>
					</ul>
					                        <div
					                            id="star-rating-count-<?php echo $lugares["id"]; ?>"
					                            class="star-rating-count">
					                                <?php

					        if (! empty($lugares["rating_total"])) {
					            $average = round(($lugares["rating_total"] / $lugares["rating_count"]), 1);
											echo '<div style="margin-top: 10px; margin-bottom: 10px; font-size: 15px; color: #000; margin-left: 10px;">¿Que piensan los demás de este lugar?: Promedio <span style="font-weight: bold;">'.$average.'</span> estrellas de <span style="font-weight: bold;">'.$lugares["rating_count"] . '</span> votos</div>';
					            ?>

					                                <?php } else { ?>
					                                No hay valoración
					                                <?php  } ?>
					                                </div>

					                    </div>

					                </td>
					            </tr>
					<?php
					    }
					}else{
						echo "No se han econtrado lugares cercanos.";
					}
					?>
					</tbody>
					    </table>


				<!-- Intro -->


				<hr class="major" />
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
			<script src="dist/sheetslider.min.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
