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
  $error= "";

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
  <?php

  include_once "../funciones.php";
  if (isset($_POST["jugar"])) {
    $path =getcwd()."/".$_POST["contrincante"]."/equipo_usuario.txt";
    $array_equipo_rival = get_digimons($path);

    //CALCULA GANADORES Y PERDEDORES
    $path =getcwd()."/$nick/equipo_usuario.txt";
    $array_digimons = get_digimons($path);

    for ($i=0; $i < count($array_digimons)-1; $i++) {
      switch ($array_digimons[$i][3]) {
        case 'Vacuna':
          switch ($array_equipo_rival[$i][3]) {
            case 'Virus':
              $ventaja = 10;
              break;
            case 'Animal':
              $ventaja = 5;
              break;
            case 'Planta':
              $ventaja = -5;
              break;
            case 'Elemental':
              $ventaja = -10;
              break;
            default:
              $ventaja = 0;
              break;
          }
          break;
        case 'Virus':
          switch ($array_equipo_rival[$i][3]) {
            case 'Animal':
              $ventaja = 10;
              break;
            case 'Planta':
              $ventaja = 5;
              break;
            case 'Elemental':
              $ventaja = -5;
              break;
            case 'Vacuna':
              $ventaja = -10;
              break;
            default:
              $ventaja = 0;
              break;
          }
          break;
        case 'Animal':
          switch ($array_equipo_rival[$i][3]) {
            case 'Planta':
              $ventaja = 10;
              break;
            case 'Elemental':
              $ventaja = 5;
              break;
            case 'Vacuna':
              $ventaja = -5;
              break;
            case 'Virus':
              $ventaja = -10;
              break;
            default:
              $ventaja = 0;
              break;
          }
          break;
        case 'Planta':
          switch ($array_equipo_rival[$i][3]) {
            case 'Elemental':
              $ventaja = 10;
              break;
            case 'Vacuna':
              $ventaja = 5;
              break;
            case 'Virus':
              $ventaja = -5;
              break;
            case 'Animal':
              $ventaja = -10;
              break;
            default:
              $ventaja = 0;
              break;
          }
          break;
          case 'Elemental':
            switch ($array_equipo_rival[$i][3]) {
              case 'Vacuna':
                $ventaja = 10;
                break;
              case 'Virus':
                $ventaja = 5;
                break;
              case 'Animal':
                $ventaja = -5;
                break;
              case 'Planta':
                $ventaja = -10;
                break;
              default:
                $ventaja = 0;
                break;
            }
            break;
      }
      do {
        $random = rand(0,25);
        $vidausuario = $array_digimons[$i][1] + $array_digimons[$i][2] + $random + $ventaja;//calculo vida
        $random = rand(0,25);
        $vidarival = $array_equipo_rival[$i][1] + $array_equipo_rival[$i][2] + $random;//calculo vida
        $num = $vidausuario-$vidarival;
      } while ($num == 0);
      $array_vidausuario[] = $vidausuario;
      $array_vidarival[] = $vidarival;

      if ($num < 0) {
        $array_resultado[] = "derrota";
      } else{
        $array_resultado[] = "victoria";
      }
    }
    //FIN CALCULO
    $contar=0;
    $resultado = false;
    for ($i=0; $i < count($array_resultado); $i++) {
      if ($array_resultado[$i] == "victoria") {
        $contar++;
      }
    }
    if ($contar >=2) {
      $resultado = true;
      $partidas_ganadas++;
    }
    $partidas_jugadas++;
  }
  if ($partidas_jugadas >= 10) {
    $path =getcwd()."/../Digimons/digimons.txt";
    $array_digimons = get_digimons($path);
    $path_temp = getcwd()."/$nick/digimones_usuario.txt";
    $array_digimons_usuario = get_digimons($path_temp);
    $contador =0;
    for ($i=0; $i <count($array_digimons_usuario)-1 ; $i++) {
      if ($array_digimons_usuario[$i][4]== 1) {
        $contador++;
      }
    }
    $contadortotal =0;
    for ($i=0; $i <count($array_digimons)-1 ; $i++) {
      if ($array_digimons[$i][4]== 1) {
        $contadortotal++;
      }
    }
    $partidas_jugadas = 0;
    if ($contador !==$contadortotal) {
      do {
        $a=0;
        $random = rand(0,count($array_digimons)-2);
        if ($array_digimons[$random][4] == 1) {
          $lo_tiene=usuario_tiene_digimon($array_digimons[$random][0],$path_temp);
          if ($lo_tiene) {
          } else {
            $file = fopen($path_temp, 'a');
            $string= implode("**",$array_digimons[$random]).PHP_EOL;
            fwrite($file, $string);
            fclose($file);
            $error="TIENES UN DIGIMON NUEVO!!";
            $a =1;
          }
        }
      } while ($a <1);
    }else {
      $error="YA TIENES TODOS LOS DIGIMONS DE NIVEL 1";
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
      <div class="col-4 border-right border-dark">
        <div class="vcenter rounded border border-dark p-3">
          <h1>TU EQUIPO</h1>
          <?php
          //MUESTRA LOS DIGIMONS DEL EQUIPO DEL USUARIO
          $path =getcwd()."/$nick/equipo_usuario.txt";
          $array_digimons = get_digimons($path);
          echo "<table class='table'>
          <tbody>";
          for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
            echo "<tr>";
            if (isset($array_resultado)) {
              echo "<td><img style='height: 20vh; width: auto;' src='../Digimons/".$array_digimons[$i][0]."/".$array_resultado[$i].".png'></td>";
            } else {
              echo "<td><img style='height: 20vh; width: auto;' src='../Digimons/".$array_digimons[$i][0]."/default.png'></td>";
            }
            if (isset($_POST["jugar"])) {
              echo "<td>".$array_digimons[$i][0]."<br>Vida: ".$array_vidausuario[$i]."</td>";
            } else {
              echo "<td>".$array_digimons[$i][0]."</td>";
            }
            echo "</tr>";
          }
          echo "</tbody></table>";
          //FIN MOSTRAR
          ?>
        </div>
      </div>
      <div class="col-4 border-right border-dark">

        <h3><?= $error ?></h3>

        <div class="vcenter p-3">
          <div>
            <h3>Partidas jugadas:<?= $partidas_jugadas ?></h3><br>
            <h3>Partidas ganadas:<?= $partidas_ganadas ?></h3>
          </div>
          <div class="rounded border border-dark p-3">
          <label for="jugar"><h1>JUGAR PARTIDA</h1></label>
          <?php
          if (isset($_POST["jugar"])) {
            if ($resultado) {
              echo "<br><br>";
              echo "<h1 style='color:green'>HAS GANADO</h1>";
            } else {
              echo "<br><br>";
              echo "<h1 style='color:red'>HAS PERDIDO</h1>";
            }
          }
          ?>
          <div class="form-group">
            <form action="jugar_partida_usuario.php" method="post">
              <input type="hidden" name="nick" value="<?= $nick ?>">
              <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
              <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
              <input type="hidden" name="contrincante" value="<?= $_POST["contrincante"] ?>">
              <input type="submit" id='jugar' name="jugar" style='display:none'>
            </form>
          </div>
        </div>
        </div>
      </div>
      <div class="col-4">
        <div class="vcenter rounded border border-dark p-3">
          <h1>EQUIPO RIVAL</h1>
          <?php
          if (isset($_POST["jugar"])) {
            //MUESTRA LOS DIGIMONS QUE ANTES HEMOS SELECCIONADO
            echo "<table class='table'>
            <tbody>";
            for ($i=0; $i < count($array_equipo_rival)-1; $i++) {//recorre los digimons
              echo "<tr>";
              if ($array_resultado[$i] == "derrota") {
                echo "<td><img style='height: 20vh; width: auto;' src='../Digimons/".$array_equipo_rival[$i][0]."/victoria.png'></td>";
              } else {
                echo "<td><img style='height: 20vh; width: auto;' src='../Digimons/".$array_equipo_rival[$i][0]."/derrota.png'></td>";
              }
                echo "<td>".$array_equipo_rival[$i][0]."<br>Vida: ".$array_vidarival[$i]."</td>";
              echo "</tr>";
            }
            echo "</tbody></table>";
            //FIN DE MOSTRAR
          } else {
            echo "<br><br><h1>?????</h1>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
