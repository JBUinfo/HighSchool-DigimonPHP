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
  if (isset($_POST["nick"])) {
    $path = getcwd()."/../Usuarios/usuarios.txt";
    $existe = existe_usuario($_POST["nick"],$path);
    if ($existe) {
      $error="Ese usuario ya existe";
    } else {
      $path =getcwd()."/../Digimons/digimons.txt";
      $array_digimons = get_digimons($path);
      $contador=0;
      for ($i=0; $i < count($array_digimons)-1; $i++) {
        if ($array_digimons[$i][4] == 1) {
          $contador++;
        }
      }
      if ($contador>=3) {
        $path = getcwd()."/../Usuarios/usuarios.txt";
        $file = fopen($path, 'a+');
        $string = $_POST["nick"]."**".$_POST["pass"].PHP_EOL;
        fwrite($file, $string);
        fclose($file);

        $pathm = getcwd()."/../Usuarios/".$_POST["nick"];
        if (!is_dir($pathm)) {
          mkdir($pathm);
        }

        $file = fopen('../Usuarios/'.$_POST["nick"].'/digimones_usuario.txt', 'a');
        $file2 =fopen('../Usuarios/'.$_POST["nick"].'/equipo_usuario.txt', 'a');

        $contador=0;
        do {
          $random = rand(0,count($array_digimons)-2);//-1 para el espacio vacion y -1 porque el count no cuent el 0
          if ($array_digimons[$random][4] == 1) {
            $path =getcwd()."/../Usuarios/".$_POST["nick"]."/digimones_usuario.txt";
            $prueba = usuario_tiene_digimon($array_digimons[$random][0],$path);
            if ($prueba) {
            } else {
              $string= implode("**",$array_digimons[$random]).PHP_EOL;
              fwrite($file, $string);
              fwrite($file2, $string);
              $contador++;
            }
          }
        } while ($contador < 3);
        $error="Se ha creado correctamente el usuario ". $_POST["nick"];
        fclose($file);
        fclose($file2);
      } else {
        $error="Aun no existen 3 digimons de nivel 1";
      }
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
          <h1>Anadir usuario</h1>
          <form action="alta_usuario.php" method="post">
            <div class="form-group">
              <label for="nick">Nick</label>
              <input type="text" class="form-control" name="nick" id="nick"
              <?php
              if (isset($_POST['nick'])) {
                echo "value='".$_POST['nick']."'";
              } else {
                echo "placeholder='Introduce Nick'";
              }
              ?>
              required>
            </div>
            <div class="form-group">
              <label for="Pass">Contrasena</label>
              <input type="password" class="form-control" name="pass" id="Pass" placeholder="Contrasena" required>
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
