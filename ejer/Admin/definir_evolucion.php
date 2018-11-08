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
  <?php
  include_once "../funciones.php";
  $path =getcwd()."/../Digimons/digimons.txt";
  $array_digimons = get_digimons($path);
  if (isset($_POST["nombre"]) && isset($_POST["nivel2"])) {
    if ($_POST["nivel2"] !== "") {
      for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
        if ($array_digimons[$i][0] == $_POST["nombre"]) {
          $array_digimons[$i][5] = $_POST["nivel2"];
        }
      }
      $temp_array;
      for ($i=0; $i < count($array_digimons)-1; $i++) {
        $temp_array[] = implode("**",$array_digimons[$i]);
      }
      $string = implode(PHP_EOL,$temp_array);
      $string .=PHP_EOL;
      $file = fopen($path, "wa+");
      fwrite($file, $string);
      fclose($file);
      if ($_POST["nivel3"] !== "") {
        for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
          if ($array_digimons[$i][0] == $_POST["nivel2"]) {
            $array_digimons[$i][5] = $_POST["nivel3"];
          }
        }
        $temp_array = array();
        for ($i=0; $i < count($array_digimons)-1; $i++) {
          $temp_array[] = implode("**",$array_digimons[$i]);
        }
        $string = implode(PHP_EOL,$temp_array);
        $string .=PHP_EOL;
        $file = fopen($path, "wa+");
        fwrite($file, $string);
        fclose($file);
      }
    } else {
      $error="Selecciona una digievolucion de nivel 2";
    }
  }
  ?>
  <div class="container-fluid h100_navbar">
    <form action="definir_evolucion.php" class="h100_navbar" method="post">
      <div class="row h70">
        <?php
        if ($_POST["nivel"] == 1) {
          echo "<div class='col-6 border-right border-dark'>
          <div class='vcenter rounded border border-dark p-3'>
          <h1>Nivel 2</h1>
          <div class='form-group'>
          <select class='form-control' name='nivel2'>";
        } elseif ($_POST["nivel"] == 2) {
          echo "<div class='col-12'>
          <div class='vcenter rounded border border-dark p-3'>
          <h1>Nivel 3</h1>
          <div class='form-group'>
          <select class='form-control' name='nivel3'>";
        }
        echo "<option value=''></option>";
        if ($_POST["nivel"] == 1) {
          for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
            if ($array_digimons[$i][4] == 2) {
              if ($array_digimons[$i][3] == $_POST["tipo"]) {
                echo "<option value='".$array_digimons[$i][0]."'>".$array_digimons[$i][0]."</option>";
              }
            }
          }
        }
        if ($_POST["nivel"] == 2) {
          for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
            if ($array_digimons[$i][4] == 3) {
              if ($array_digimons[$i][3] == $_POST["tipo"]) {
                echo "<option value='".$array_digimons[$i][0]."'>".$array_digimons[$i][0]."</option>";
              }
            }
          }
        }
        ?>
      </select>
    </div>
  </div>
</div>
<?php
if ($_POST["nivel"] == 1) {
  echo "<div class='col-6 border-right border-dark'>
  <div class='vcenter rounded border border-dark p-3'>
  <h1>Nivel 3</h1>
  <div class='form-group'>
  <select class='form-control' name='nivel3'>";
} elseif ($_POST["nivel"] == 2) {
  echo "<div style='display:none'>
  <div class='vcenter rounded border border-dark p-3'>
  <h1>Nivel 3</h1>
  <div class='form-group'>
  <select class='form-control' name='nada'>
  ";
}

echo "<option value=''></option>";
for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
  if ($array_digimons[$i][4] == 3) {
    if ($array_digimons[$i][3] == $_POST["tipo"]) {
      echo "<option value='".$array_digimons[$i][0]."'>".$array_digimons[$i][0]."</option>";
    }
  }
}
?>
</select>
</div>
</div>
</div>
</div>
<div class="row border-top border-dark h30">
  <div class="col-12">
    <div class="vcenter rounded border border-dark p-3"><br>
      <?php
      if (isset($error)) {
        echo "<h6>$error<br><br>";
      } else {
        if (isset($_POST["nombre"]) && isset($_POST["nivel2"])) {
          echo "<h6>SE HA DEFINIDO LA DIGIEVOLUCION:<br><br>";
          echo $_POST["nombre"]."========>".$_POST["nivel2"]."========>".$_POST["nivel3"]."</h6>";
        }
        if (isset($_POST["nombre"]) && !(isset($_POST["nivel2"])) && isset($_POST["nivel3"]) ) {
          echo "<h6>SE HA DEFINIDO LA DIGIEVOLUCION:<br><br>";
          echo $_POST["nombre"]."========>".$_POST["nivel3"]."</h6>";
        }
      }

      ?>
      <input type='hidden' name='nombre' value='<?= $_POST["nombre"] ?>'>
      <input type='hidden' name='nivel' value='<?= $_POST["nivel"] ?>'>
      <input type='hidden' name='tipo' value='<?= $_POST["tipo"] ?>'>
      <button type="submit" name="definido" class="btn btn-primary">Definir</button>
    </div>
  </div>
</div>
</form>
</div>
</body>
</html>
