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
  <div class="container-fluid h100">
    <div class="row h100">
      <div class="col-12">
        <div class="vcenter">
          <form action="jugar_partida_usuario.php" method="post">
            <select name="contrincante">
              <?php
              include_once "../funciones.php";
              $path=getcwd()."/usuarios.txt";
              $array_usuarios = get_digimons($path);
              for ($i=0; $i <count($array_usuarios)-1 ; $i++) {
                echo "<option value='".$array_usuarios[$i][0]."'>".$array_usuarios[$i][0]."</option>";
              }
              ?>
            </select>
            <input type="hidden" name="nick" value="<?= $nick ?>">
            <input type="hidden" name="partidas_ganadas" value="<?= $partidas_ganadas ?>">
            <input type="hidden" name="partidas_jugadas" value="<?= $partidas_jugadas ?>">
            <input type="submit" >
          </form>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
