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

if(isset($_SESSION['user']) && $_SESSION['user']=="admin"){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'addlugar.php';

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
    $(function(){
            $("input[type = 'submit']").click(function(){
               var $fileUpload = $("input[type='file']");
               if (parseInt($fileUpload.get(0).files.length) > 5){
                  alert("Solo puedes seleccionar 5 imagenes");
               }
            });
         });
    $(document).ready(function(){
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

    $(document).ready(function(){
        $('#category').on('change',function(){
            var categoria = $(this).val();

            if(categoria){
                $.ajax({
                    type:'POST',
                    url:'ajaxcategorias.php',
                    data:'categoria='+categoria,
                    success:function(html){
                        $('#subcategoria').html(html);
                    }
                });
            }else{
                $('#subcategoria').html('<option value="">Selecciona una categoria primero</option>');
            }
        });
    });

      function checkform() {
    // get all the inputs within the submitted form
        if(document.getElementById('nombrelugar').value==""){
          alert("Coloca el nombre del lugar");
          return false;
        }
        if(document.getElementById('category').value==""){
          alert("Escoge una categoria");
          return false;
        }
        if(document.getElementById('subcat').value=="0"){
          alert("Escoge una subcategoria");
          return false;
        }
        if(document.getElementById('message').value==""){
          alert("Escribe una descripcion del lugar");
          return false;
        }
        if(document.getElementById('state').text==""){
          alert("Escoge un estado");
          return false;
        }
        if(document.getElementById('city').value==""){
          alert("Escoge una ciudad");
          return false;
        }
        if(document.getElementById('direccion').value==""){
          alert("Escribe la direccion del lugar");
          return false;
        }
        if((document.getElementById('telefono').value=="")&&(document.getElementById('correo').value=="")){
          alert("Escribe al menos un dato de contacto");
          return false;
        }
    }
    </script>
</head>
<body class="subpage">

	<header id="header">
	<h1><a href="#"><?php echo $_SESSION['user'];?>-Registro de lugares<span> en Kali</span></a></h1>
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
    <form action="registrarlugar.php" enctype="multipart/form-data" method="POST" onsubmit="return checkform()">

		<section class="wrapper style1">
					<div class="inner">
						<h2>Registro de Lugares</h2>
						<p>Nombre del lugar: <br>
						<input type="text" id="nombrelugar" name="nombrelugar" placeholder="Ser claro con el nombre para su búsqueda"></p>
            <p>Tipo de lugar: <br>
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
            <p>Subcategoria del Lugar: <br>
              <div class="select-wrapper">
                <select name="subcategoria" id="subcategoria">
                  <option value="">- Selecciona una categoria primero -</option>
                </select>
              </div></p>

						<p>Descripción del lugar: <br>
						<textarea name="descripcion" id="message" placeholder="Descripción del lugar, trata de usar palabras claras para que los usuarios encuentren facilmente el lugar." rows="6"></textarea></p>
						<p>Direccion: <br>
              <div class="select-wrapper">

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
                </select>
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
						<input type="text" id="direccion" name="direccion" placeholder="Trata de ser claro con la direccion, si es posible obtener de Maps"></p>
            <p>Contacto: <br>
						<input type="text" id="telefono" name="telefono" placeholder="Telefono">
          <input type="text" id="correo" name="correo" placeholder="Correo"></p>
            <p>Imagenes (SOLO PUEDES SUBIR 5 IMAGENES): <br></p>
            <input type="file" name="imagen[]" multiple><br/><br>

            <p class="center"><input type="submit" value="Registrar el Lugar"></p>
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
