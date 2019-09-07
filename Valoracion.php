<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';
require_once "DBController.php";
class Rate extends DBController
{

    function getAllPost()
    {
        if((isset($_SESSION['estado']) && isset($_SESSION['ciudad'])) && ($_SESSION['estado']!="Sin estado" && $_SESSION['ciudad']!="Sin ciudad")){
          $query = "SELECT lugares.*, COUNT(star.valoracion) as rating_count, SUM(star.valoracion) as rating_total FROM lugares LEFT JOIN star ON lugares.id = star.lugar_id WHERE lugares.tipolugar= ? AND lugares.subcategoria= ? AND lugares.estado = ? AND lugares.ciudad = ? GROUP BY star.lugar_id";
          $params = array(
              array(
                  "param_type" => "i",
                  "param_value" => $_SESSION['lugar']
              ),
              array(
                  "param_type" => "s",
                  "param_value" => $_SESSION['subcategoria']
              ),
              array(
                  "param_type" => "s",
                  "param_value" => $_SESSION['estado']
              ),
              array(
                  "param_type" => "s",
                  "param_value" => $_SESSION['ciudad']
              )
          );

          $postResult = $this->getDBResult($query,$params);

                  return $postResult;
        }
        else if($_SESSION['subcategoria']!="Sin categoria"){
          $query = "SELECT lugares.*, COUNT(star.valoracion) as rating_count, SUM(star.valoracion) as rating_total FROM lugares LEFT JOIN star ON lugares.id = star.lugar_id WHERE lugares.tipolugar= ? AND lugares.subcategoria= ? AND lugares.estado = ? GROUP BY star.lugar_id";
          $params = array(
              array(
                  "param_type" => "i",
                  "param_value" => $_SESSION['lugar']
              ),
              array(
                  "param_type" => "s",
                  "param_value" => $_SESSION['subcategoria']
              ),
              array(
                  "param_type" => "s",
                  "param_value" => $_SESSION['estadouser']
              )
          );

          $postResult = $this->getDBResult($query,$params);

                  return $postResult;
        }else{

          if($_SESSION['lugar']!="Sin clasificar"){

            $query = "SELECT lugares.*, COUNT(star.valoracion) as rating_count, SUM(star.valoracion) as rating_total FROM lugares LEFT JOIN star ON lugares.id = star.lugar_id WHERE lugares.tipolugar= ? AND lugares.estado= ? GROUP BY star.lugar_id";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $_SESSION['lugar']
                ),array(
                    "param_type" => "s",
                    "param_value" => $_SESSION['estadouser']
                )
            );

            $postResult = $this->getDBResult($query,$params);

                    return $postResult;

          }else if(isset($_SESSION['tienecv']) && isset($_SESSION['ttiempo'])){

            $query = "SELECT lugares.*, COUNT(star.valoracion) as rating_count, SUM(star.valoracion) as rating_total FROM lugares LEFT JOIN star ON lugares.id = star.lugar_id WHERE lugares.tipolugar= ? AND lugares.estado= ? AND lugares.cv = ? AND lugares.tiempo = ? GROUP BY star.lugar_id";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => 10
                ),array(
                    "param_type" => "s",
                    "param_value" => $_SESSION['estadouser']
                ),array(
                    "param_type" => "s",
                    "param_value" => $_SESSION['tienecv']
                ),array(
                    "param_type" => "s",
                    "param_value" => $_SESSION['ttiempo']
                )
            );

            $postResult = $this->getDBResult($query,$params);

                    return $postResult;

          }else if($_SESSION['wordkey']!="Sin busqueda"){

            $query = "SELECT lugares.*, COUNT(star.valoracion) as rating_count, SUM(star.valoracion) as rating_total FROM lugares LEFT JOIN star ON lugares.id = star.lugar_id WHERE lugares.estado='$_SESSION[estadouser]' AND lugares.nombrelugar LIKE '%" . $_SESSION["wordkey"] . "%' OR lugares.descripcion LIKE '%" . $_SESSION["wordkey"] . "%' OR lugares.direccion LIKE
             '%" . $_SESSION["wordkey"] . "%' GROUP BY star.lugar_id ";
            $sql_statement = $this->conn->prepare($query);

            $sql_statement->execute();
            $result = $sql_statement->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $resultset[] = $row;
                }
            }

            if (! empty($resultset)) {
                return $resultset;
            }
          }

        }



    }

    function getRatingByTutorial($lugar_id)
    {
        $query = "SELECT lugares.*, COUNT(star.valoracion) as rating_count, SUM(star.valoracion) as rating_total FROM lugares LEFT JOIN star ON lugares.id = star.lugar_id WHERE star.lugar_id = ? GROUP BY star.lugar_id";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $lugar_id
            )
        );

        $postResult = $this->getDBResult($query, $params);
        return $postResult;
    }

    function getRatingByTutorialForMember($lugar_id, $username)
    {
        $query = "SELECT * FROM star WHERE lugar_id = ? AND userate = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $lugar_id
            ),
            array(
                "param_type" => "s",
                "param_value" => $username
            )
        );

        $ratingResult = $this->getDBResult($query, $params);
        return $ratingResult;
    }

    function addRating($lugar_id, $valoracion, $username)
    {
        $query = "INSERT INTO star (lugar_id,valoracion,userate) VALUES (?, ?, ?)";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $lugar_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $valoracion
            ),
            array(
                "param_type" => "s",
                "param_value" => $username
            )
        );

        $this->updateDB($query, $params);
    }

    function updateRating($valoracion, $rating_id, $username)
    {
        $query = "UPDATE star SET  valoracion = ? WHERE id= ? AND userate= ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $valoracion
            ),
            array(
                "param_type" => "i",
                "param_value" => $rating_id
            ),
            array(
                "param_type" => "s",
                "param_value" => $username
            )
        );

        $this->updateDB($query, $params);
    }
}
