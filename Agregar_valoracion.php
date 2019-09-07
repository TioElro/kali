<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

// En este apartado se puede agregar sesion para usuarios registrados
$username = $_SESSION['user'];
if (! empty($_POST["valoracion"]) && ! empty($_POST["id"])) {
    require_once ("Valoracion.php");
    $rate = new Rate();

    $ratingResult = $rate->getRatingByTutorialForMember($_POST["id"], $username);

    if (! empty($ratingResult)) {
        $rate->updateRating($_POST["valoracion"], $ratingResult[0]["id"],$username);
    } else {
        $rate->addRating($_POST["id"], $_POST["valoracion"], $username);
    }

    $postRating = $rate->getRatingByTutorial($_POST["id"]);

    if (! empty($postRating[0]["rating_total"])) {
        $average = round(($postRating[0]["rating_total"] / $postRating[0]["rating_count"]), 1);
        echo '<div style="margin-top: 10px; margin-bottom: 10px; font-size: 15px; color: #000; margin-left: 10px;">¿Que piensan los demás de este lugar?: Promedio <span style="font-weight: bold;">'.$average.'</span> estrellas de <span style="font-weight: bold;">'.$postRating[0]["rating_count"] . '</span> votos</div>';
    } else {
        echo "No hay valoraciones";
    }
}
?>
