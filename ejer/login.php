<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="css/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="body_h100 bg-secondary">
    <?php
    if (isset($_GET["error"])) {
      $error = $_GET["error"];
    }
     ?>
    <div class="container-fluid h100">
      <div class="row h100">
        <div class="col-12">
          <div class="vcenter rounded border border-dark p-3">
            <form action="Usuarios/index.php" method="post">
              <div class="form-group">
                <label for="nick">Nick</label>
                <input type="text" class="form-control" name="nick" id="nick"
                  <?php
                    if (isset($_GET['nick'])) {
                      echo "value='".$_GET['nick']."'";
                    } else {
                      echo "placeholder='Introduce Nick'";
                    }
                  ?>
                required>
                <small class="form-text">Si no recuerdas tu nick, hazlo saber a admin@admin.es </small>
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
