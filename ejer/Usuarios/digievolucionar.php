<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Index</title>
  <script src="../css/jquery.js"></script>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script type="text/javascript" src="../css/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css/style.css">

</head>
<body class="body_h100 bg-secondary">
  <?php
  if ($_POST["nick"]) {
    $nick = $_POST["nick"];
    if (isset($_POST["partidas_ganadas"])) {
      $partidas_ganadas = $_POST["partidas_ganadas"];
      $partidas_jugadas = $_POST["partidas_jugadas"];
    } else {
      $partidas_jugadas=0;
      $partidas_ganadas=0;
    }
  } else {
    header("Location:../login.php?nick=".$nick."&error=No te has logueado o has pulsado F5");
  }

  include_once "../funciones.php";

  if (isset($_POST["nombre"])) {
    $path = getcwd()."/".$_POST["nick"]."/digimones_usuario.txt";
    $lo_tiene = usuario_tiene_digimon($_POST["nombreevolucion"],$path);
    if ($lo_tiene) {
    }else {
      //coge los digimons de la pokedex del usuario
      $path = getcwd()."/../Usuarios/".$_POST["nick"]."/digimones_usuario.txt";
      $array_digimons = get_digimons($path);
      $file = fopen($path, 'wa+');
      //coge todos los digimons
      $path2 = getcwd()."/../Digimons/digimons.txt";
      $array_digimons2 = get_digimons($path2);
      $file2 = fopen($path2, 'r');

      //encuentra el index en la pokedex global del digimon seleccinado en la parte del equipo
      //servira para coger toda la info del digimon y ponerla en la pokedex del usuario
      $index;
      for ($i=0; $i < count($array_digimons2)-1; $i++) {//recorre los digimons
        if ($array_digimons2[$i][0] == $_POST["nombreevolucion"]) {
          $index=$i;
        }
      }

      //cambia al digimon seleccionado en la parte de pokedex por el digimon seleccionado en la parte equipo
      for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
        if ($array_digimons[$i][0] == $_POST["nombre"]) {
          for ($a=0; $a < count($array_digimons2[$index]) ; $a++) {
            $array_digimons[$i][$a] = $array_digimons2[$index][$a];//copia la informacion de la pokedex global a la pokedex del usuario
          }
          if (count($array_digimons2[$index]) == 5) { //si esta al nivel 3, no tiene digievolucion
            $array_digimons[$i][5] = null;
          }
        }
      }
      //efectua los cambios
      $temp_array = array();
      for ($i=0; $i < count($array_digimons)-1; $i++) {
        $temp_array[] = implode("**",$array_digimons[$i]);
      }
      $string = implode(PHP_EOL,$temp_array);
      $string .=PHP_EOL;
      fwrite($file, $string);
      fclose($file);

      //ccoge los digimons del equipo del usuario
      $path = getcwd()."/../Usuarios/".$_POST["nick"]."/equipo_usuario.txt";
      $array_digimons = get_digimons($path);
      $file = fopen($path, 'wa+');
      //cambia al digimon seleccionado en la parte de equipo por el digimon seleccionado en la parte pokedex
      for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
        if ($array_digimons[$i][0] == $_POST["nombre"]) {
          for ($a=0; $a < count($array_digimons2[$index]) ; $a++) {
            $array_digimons[$i][$a] = $array_digimons2[$index][$a];//copia la informacion de la pokedex global al equipo del usuario
          }
          if (count($array_digimons2[$index]) == 5) { //si esta al nivel 3, no tiene digievolucion
            $array_digimons[$i][5] = null;
          }
        }
      }
      //efectua los cambios
      $temp_array = array();
      for ($i=0; $i < count($array_digimons)-1; $i++) {
        $temp_array[] = implode("**",$array_digimons[$i]);
      }
      $string = implode(PHP_EOL,$temp_array);
      $string .=PHP_EOL;
      fwrite($file, $string);
      fclose($file);
      $partidas_ganadas=$partidas_ganadas-10;
    }
  }
  ?>
  <!--NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <form action="index.php" method="post">
      <input type="hidden" name="nick" value="<?= $nick ?>">
      <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
      <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
      <button type="submit" class="bg-transparent border-0">
        <a class="navbar-brand text-white">Home</a>
      </button>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <form action="jugar_partida.php" method="post">
            <input type="hidden" name="nick" value="<?= $nick ?>">
            <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
            <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
            <button type="submit" class="bg-transparent border-0">
              <a class="nav-link">Jugar partida</a>
            </button>
          </form>
        </li>
        <li class="nav-item">
          <form action="organizar_equipo.php" method="post">
            <input type="hidden" name="nick" value="<?= $nick ?>">
            <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
            <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
            <button type="submit" class="bg-transparent border-0">
              <a class="nav-link">Organizar equipo</a>
            </button>
          </form>
        </li>
        <li class="nav-item">
          <form action="ver_mis_digimon.php" method="post">
            <input type="hidden" name="nick" value="<?= $nick ?>">
            <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
            <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
            <button type="submit" class="bg-transparent border-0">
              <a class="nav-link">Ver mis digimon</a>
            </button>
          </form>
        </li>
        <li class="nav-item">
          <form action="digievolucionar.php" method="post">
            <input type="hidden" name="nick" value="<?= $nick ?>">
            <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
            <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
            <button type="submit" class="bg-transparent border-0">
              <a class="nav-link">Digievolucionar</a>
            </button>
          </form>
        </li>
      </ul>
      <span class="navbar-text ">
        <form action="../index.php" method="post">
          <button type="submit" class="bg-transparent border-0">
            <a class="nav-link"><h6> Logout: <?= $nick ?></h6></a>
          </button>
        </form>
      </span>
    </div>
  </nav>
  <!-- FIN DE NAVBAR -->
  <div class="container-fluid h100_navbar">
    <div class="row h100">
      <div class='col-4'>
        <div  class='vcenter'>
          <?php
          include_once "../funciones.php";
          if (isset($_POST["nombre"])) {
            if ($lo_tiene==true) {
              echo "<h1 style='color: red;'>No se ha podido digievolucionar porque esa digievolucion ya la tienes</h1>";
            } else {
              echo "<h1 style='transform: rotate(-40deg);'>DIGIEVOLUCIONADOOOOOOO</h1>";
            }
          }
          ?>
        </div>
      </div>

      <div class="col-4">
        <div style="overflow:scroll; overflow-x: hidden;" class="h80 vcenter rounded border border-dark p-3">
          <h1>Digievolucionar</h1>
          <?php
          echo "Partidas ganadas: ".$partidas_ganadas;
          $path = getcwd()."/../Usuarios/".$_POST["nick"]."/digimones_usuario.txt";
          $array_digimons = get_digimons($path);

          for ($z=1; $z <= 2; $z++) {//crea tres tablas segun su nivel
            echo "<table class='table '>
            <thead>
            <tr class='tablan-".$z."'>
            <th scope='col'>Nombre</th>
            <th scope='col'>Nivel</th>";
            if (isset($_POST["partidas_ganadas"])) {
              if ($_POST["partidas_ganadas"] >= 10 ) {
                echo "<th scope='col'>Evolucionar</th>";
              }
            }
            echo "
            </tr>
            </thead>
            <tbody>";
            for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
              if ($array_digimons[$i][4] == $z) {
                echo "<tr>";
                echo "<form action='digievolucionar.php' method='post'>
                <input type='hidden' name='nombre' value='".$array_digimons[$i][0]."'>
                <input type='hidden' name='nombreevolucion' value='".$array_digimons[$i][5]."'>
                <input type='hidden' name='nick' value='$nick'>
                <input type='hidden' name='partidas_ganadas' value='".$partidas_ganadas."'>
                <input type='hidden' name='partidas_jugadas' value='$partidas_jugadas'>
                ";
                echo "<td>".$array_digimons[$i][0]."</td>";
                echo "<td>".$array_digimons[$i][4]."</td>";

                if (isset($_POST["partidas_ganadas"])) {
                  if ($_POST["partidas_ganadas"] >= 10 ) {
                    echo "<td><input type='submit' value='Digievolucionar'></td>";
                  }
                }

                echo "</form>";
                echo "</tr>";
              }
            }
            echo "</tbody></table>";

          }
          ?>
        </div>
      </div>
      <div class='col-4'>
        <div class='vcenter'>
          <?php
          if (isset($_POST["nombre"])) {
            echo "<img src='../css/gif_digievolucion.gif'>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
