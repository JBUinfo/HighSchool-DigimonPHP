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
  include_once "../funciones.php";
  if (isset($_POST["nombre"])) {
    $path = getcwd()."/../Digimons/digimons.txt";
    $existe = existe_digimon($_POST["nombre"],$path);
    if ($existe) {
      $error="Este digimon ya existe";
    } elseif ($_POST["ataque"] < 0) {
        $error="Introduce un ataque mayor o igual a 0";
      } elseif ($_POST["defensa"] < 0) {
        $error="Introduce una defensa mayor o igual a 0";
      } else {
        $file = fopen($path, 'a');
        $string = $_POST["nombre"]."**".$_POST["ataque"]."**".$_POST["defensa"]."**".$_POST["tipo"]."**".$_POST["nivel"].PHP_EOL;
        fwrite($file, $string);
        fclose($file);
        $pathm = getcwd()."/../Digimons/".$_POST["nombre"];
        if (!is_dir($pathm)) {
          mkdir($pathm);
        }
        copy(getcwd()."/../css/Imagenes/defaultdigimon.png",getcwd()."/../Digimons/".$_POST["nombre"]."/default.png");
        copy(getcwd()."/../css/Imagenes/defaultdigimonderrota.png",getcwd()."/../Digimons/".$_POST["nombre"]."/derrota.png");
        copy(getcwd()."/../css/Imagenes/defaultdigimonvictoria.png",getcwd()."/../Digimons/".$_POST["nombre"]."/victoria.png");
      }
  }
  ?>
  <!--NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <form action="../index.php" method="post">
      <button type="submit" class="bg-transparent border-0">
        <a class="navbar-brand text-muted">Index</a>
      </button>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <form action="alta_usuario.php" method="post">
            <button type="submit" class="bg-transparent border-0">
              <a class="nav-link">Alta usuario</a>
            </button>
          </form>
        </li>
        <li class="nav-item">
          <form action="alta_digimon.php" method="post">
            <button type="submit" class="bg-transparent border-0">
              <a class="nav-link">Alta digimon</a>
            </button>
          </form>
        </li>
        <li class="nav-item">
          <form action="ver_digimon.php" method="post">
            <button type="submit" class="bg-transparent border-0">
              <a class="nav-link">Ver digimons</a>
            </button>
          </form>
        </li>
      </ul>
      <span class="navbar-text ">
        <h3>Admin</h3>
      </span>
    </div>
  </nav>
  <!-- FIN DE NAVBAR -->
  <div class="container-fluid h100_navbar">
    <div class="row h100">
      <div class="col-12">
        <div class="vcenter rounded border border-dark p-3">
          <h1>Anadir digimon</h1>
          <form action="alta_digimon.php" method="post">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" class="form-control" id="nombre"
                <?php
                  if (isset($_GET['nombre'])) {
                    echo "value='".$_GET['nombre']."'";
                  } else {
                    echo "placeholder='Introduce nombre'";
                  }
                ?>
              required>
            </div>
            <div class="form-group">
              <label for="ataque">Ataque</label>
              <input type="number" class="form-control" name="ataque" id="ataque" placeholder="Ataque" required>
            </div>
            <div class="form-group">
              <label for="defensa">Defensa</label>
              <input type="number" class="form-control" name="defensa" id="defensa" placeholder="Defensa" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select class="form-control" name="tipo" id="tipo">
                  <option value="Vacuna">Vacuna</option>
                  <option value="Virus">Virus</option>
                  <option value="Animal">Animal</option>
                  <option value="Planta">Planta</option>
                  <option value="Elemental">Elemental</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nivel">Nivel</label>
                <select class="form-control" name="nivel" id="nivel">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
            </div>

            <?php
              if (isset($error)) {
                echo "<p style='color:red; text-align:center' class='bg-dark'> $error </p>";
              }
             ?>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
