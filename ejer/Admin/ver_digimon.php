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
  <div class="container-fluid h100_navbar">
    <div class="row h100">
      <div class="col-12">
        <div style="overflow-x: hidden; overflow-y: scroll;" class="h100_navbar vcenter rounded border border-dark p-3">
          <h1>Anadir digimon</h1>
          <?php
          include_once "../funciones.php";

          $path =getcwd()."/../Digimons/digimons.txt";
          $array_digimons = get_digimons($path);
          for ($z=1; $z <= 3; $z++) {//crea tres tablas segun su nivel
            echo "<table class='table '>
            <thead>
            <tr class='tablan-".$z."'>
            <th scope='col'>Nombre</th>
            <th scope='col'>Ataque</th>
            <th scope='col'>Defensa</th>
            <th scope='col'>Tipo</th>
            <th scope='col'>Nivel</th>";
            if ($z == 3) {
            } else {
              echo "<th scope='col'>Evolucion</th>";
            }
            echo "<th scope='col'>Modificar imagen</th>";
            if ($z == 3) {
            } else {
              echo "<th scope='col'>Definir digievolucion</th>";
            }
            echo"</tr>
            </thead>
            <tbody>";
            for ($i=0; $i < count($array_digimons)-1; $i++) {//recorre los digimons
              if ($array_digimons[$i][4] == $z) {
              echo "<tr>";
              echo "<form action='imagen_digimon.php' method='post'>
              <input type='hidden' name='nombre' value='".$array_digimons[$i][0]."'>
              ";
              for ($a=0; $a < count($array_digimons[$i]); $a++) {//recorre caracteristicas de digimon
                  echo "<td>".$array_digimons[$i][$a]." </td>";
              }

              echo "<td><input type='submit' value='Imagenes'></td>";
              echo "</form>";
              if ($array_digimons[$i][4] == 3) {
              } else {
                echo "<td><form action='definir_evolucion.php' method='post'>
                          <input type='hidden' name='nombre' value='".$array_digimons[$i][0]."'>
                          <input type='hidden' name='nivel' value='".$array_digimons[$i][4]."'>
                          <input type='hidden' name='tipo' value='".$array_digimons[$i][3]."'>
                          <input type='submit' value='Digievolucion'>
                          </form>
                      </td>";
              }
              echo "</tr>";
              }
            }
            echo "</tbody></table>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
