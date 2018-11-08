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
    <form action="organizar_equipo.php" class="h100_navbar" method="post">
      <div class="row h80">
        <div class="col-6">
          <div style="overflow:scroll; overflow-x: hidden;" class="h80 vcenter rounded border border-dark p-3">
            <h1>Tus digimons</h1>
            <?php
            include_once "../funciones.php";

            if (isset($_POST["pokedex"])) {
              //coge todos los digimons
              $path2 = getcwd()."/../Digimons/digimons.txt";
              $array_digimons2 = get_digimons($path2);
              $file2 = fopen($path2, 'r');

              //encuentra el index en la pokedex global del digimon seleccinado en la parte del equipo
              //servira para coger toda la info del digimon y ponerla en la pokedex del usuario
              $index;
              for ($i=0; $i < count($array_digimons2)-1; $i++) {//recorre los digimons
                if ($array_digimons2[$i][0] == $_POST["equipo"]) {
                  $index=$i;
                }
              }

              //encuentra el index en la pokedex global del digimon seleccinado en la parte de pokedex
              //servira para coger toda la info del digimon y ponerla en el file de equipo_usuario.txt
              $path = getcwd()."/../Usuarios/".$_POST["nick"]."/equipo_usuario.txt";
              $array_digimons = get_digimons($path);
              $file = fopen($path, 'wa+');
              for ($i=0; $i < count($array_digimons2)-1; $i++) {//recorre los digimons
                if ($array_digimons2[$i][0] == $_POST["pokedex"]) {
                  $index=$i;
                }
              }

              //cambia al digimon seleccionado en la parte de equipo por el digimon seleccionado en la parte pokedex
              for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
                if ($array_digimons[$i][0] == $_POST["equipo"]) {
                  for ($a=0; $a < count($array_digimons[$i]) ; $a++) {
                    if (count($array_digimons2[$index]) == 5) {
                      $array_digimons2[$index][5] = null;
                    }
                    $array_digimons[$i][$a] = $array_digimons2[$index][$a];
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
            }

            if (isset($_POST["nick"])) {
              $path = getcwd()."/../Usuarios/".$_POST["nick"]."/digimones_usuario.txt";
              $array_digimons = get_digimons($path);
              $file = fopen($path, 'r');
              for ($z=1; $z <= 3; $z++) {//crea tres tablas segun su nivel
                echo "<table class='table '>
                <thead>
                <tr class='tablan-".$z."'>
                <th scope='col'>Nombre</th>
                <th scope='col'>Ataque</th>
                <th scope='col'>Defensa</th>
                <th scope='col'>Tipo</th>
                <th scope='col'>Nivel</th>
                <th scope='col'>Digievolucion</th>
                <th scope='col'>Seleccionar</th>
                </tr>
                </thead>
                <tbody>";
                $path2 = getcwd()."/../Usuarios/".$_POST["nick"]."/equipo_usuario.txt";
                $array_digimons_equipo = get_digimons($path2);
                for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons

                    if ($array_digimons[$i][4] == $z) {
                      echo "<tr>";
                      for ($a=0; $a < count($array_digimons[$i]); $a++) {//recorre caracteristicas de digimon
                        echo "<td>".$array_digimons[$i][$a]." </td>";
                      }
                      if (count($array_digimons[$i]) == 5) {
                        echo "<td></td>";
                      }
                      if ($array_digimons[$i][0] == $array_digimons_equipo[0][0] || $array_digimons[$i][0] == $array_digimons_equipo[1][0] || $array_digimons[$i][0] == $array_digimons_equipo[2][0]) {
                        //si esta en el array de equipo:usuario, que no lo muestre
                        echo "<td></td>";
                      } else {
                        echo "<td><input type='radio' name='pokedex' value='".$array_digimons[$i][0]."' required></td>";
                      }
                      echo "</tr>";
                    }

                }
                echo "</tbody></table>";
              }
              fclose($file);
            }
            ?>
          </div>
        </div>
        <div class="col-6">
          <div class="vcenter rounded border border-dark p-3">
            <h1>Tu equipo</h1>
            <?php
            include_once "../funciones.php";

            if (isset($_POST["nick"])) {
              $path = getcwd()."/../Usuarios/".$_POST["nick"]."/equipo_usuario.txt";
              $array_digimons = get_digimons($path);
              $file = fopen($path, 'r');
              for ($z=1; $z <= 3; $z++) {//crea tres tablas segun su nivel
                echo "<table class='table '>
                <thead>
                <tr class='tablan-".$z."'>
                <th scope='col'>Nombre</th>
                <th scope='col'>Ataque</th>
                <th scope='col'>Defensa</th>
                <th scope='col'>Tipo</th>
                <th scope='col'>Nivel</th>
                <th scope='col'>Digievolucion</th>
                <th scope='col'>Seleccionar</th>
                </tr>
                </thead>
                <tbody>";
                for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
                  if ($array_digimons[$i][4] == $z) {
                    echo "<tr>";
                    for ($a=0; $a < count($array_digimons[$i]); $a++) {//recorre caracteristicas de digimon
                      echo "<td>".$array_digimons[$i][$a]." </td>";
                    }
                    if (count($array_digimons[$i]) == 5) {
                      echo "<td></td>";
                    }
                    echo "<td><input type='radio' name='equipo' value='".$array_digimons[$i][0]."' required> </td>";
                    echo "</tr>";
                  }
                }
                echo "</tbody></table>";
              }
              fclose($file);
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row border-top border-dark h20">
        <div class="col-12">
          <div class="vcenter rounded border border-dark p-3">
            <button type="submit" class="btn btn-primary">Cambiar</button>
          </div>
        </div>
      </div>
      <input type="hidden" name="nick" value="<?= $nick ?>">
      <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
      <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
    </form>
  </div>
</body>
</html>
