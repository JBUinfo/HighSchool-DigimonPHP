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
        <div class="vcenter rounded border border-dark p-3">
          <?php
          include_once "../funciones.php";
          $path =getcwd()."/../Digimons/".$_POST["nombre"]."/";
          if (isset($_FILES["default"])) {
            move_uploaded_file($_FILES["default"]["tmp_name"] , $path."/default.png" );
          }

          if (isset($_FILES["victoria"])) {
            move_uploaded_file($_FILES["victoria"]["tmp_name"] , $path."/victoria.png");
          }

          if (isset($_FILES["derrota"])) {
            move_uploaded_file($_FILES["derrota"]["tmp_name"] , $path."/derrota.png");
          }

          if (isset($_POST["nombre"])) {
            echo "<h1>Editar imagenes</h1>";
            if (isset($_POST["actualizar"])) {
              echo "<h5 style='color:#155f15;'>Se ha actualizado correctamente.<br>Recarga la pagina para ver los cambios</h5>";
            }
            echo "<h3>".$_POST["nombre"]."</h3>";
            echo "<form action='imagen_digimon.php' method='post' enctype='multipart/form-data'>
                  <input type='hidden' name='nombre' value='".$_POST["nombre"]."'>
                  ";
            echo "<table class='table '>
            <thead>
            <th scope='col'>Modo</th>
            <th scope='col'>Imagen</th>
            <th scope='col'>Modificar</th>
            </tr>
            </thead>
            <tbody>";
            echo "<tr><td>Por defecto</td>";
            if (file_exists($path."default.png")) {
              echo "<td><img style='height: 15vh; width: auto;' src='../Digimons/".$_POST["nombre"]."/default.png'></td>";
            } else {
              echo "<td></td>";
            }
            echo "<td>
                    <label for='default' style='background-color: white; padding:3px; border-radius: 10px;'>Subir imagen</label>
                    <input type='file' id='default' style='display: none;' name='default'>
                  </td>";
            echo "</tr>";

            echo "<tr><td>Victoria</td>";
            if (file_exists($path."victoria.png")) {
              echo "<td><img style='height: 15vh; width: auto;' src='../Digimons/".$_POST["nombre"]."/victoria.png'></td>";
            } else {
              echo "<td></td>";
            }
            echo "<td>
                    <label for='victoria' style='background-color: white; padding:3px; border-radius: 10px;' >Subir imagen</label>
                    <input type='file' id='victoria' style='display: none;' name='victoria'>
                  </td>";
            echo "</tr>";

            echo "<tr><td>Derrota</td>";
            if (file_exists($path."derrota.png")) {
              echo "<td><img style='height: 15vh; width: auto;' src='../Digimons/".$_POST["nombre"]."/derrota.png'></td>";
            } else {
              echo "<td></td>";
            }
            echo "<td>
                    <label for='derrota' style='background-color: white; padding:3px; border-radius: 10px;'>Subir imagen</label>
                    <input type='file' id='derrota' style='display: none;' name='derrota'>
                  </td>";
            echo "</tr>";
            echo "</tbody></table><input type='submit' name='actualizar' value='Actualizar'>";
            echo "</form>";
          } else {
            header("Location:ver_digimon.php");
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
