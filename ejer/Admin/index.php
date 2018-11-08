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
<body style="background-image: url('../css/Imagenes/wallpaper.png');">
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
</body>
</html>
