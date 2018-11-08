<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="css/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="body_h100 bg-secondary">
    <div class="container-fluid h100">
      <div class="row h100">
        <div class="col-6 border-right border-dark">
          <div class="vcenter">
            <label class="p-5 rounded border border-dark" for="Usuario"><h1>Usuario</h1></label>
            <form action="login.php" method="post">
              <input style="display:none;" type="submit" id="Usuario" value="Usuario">
            </form>
          </div>
        </div>
        <div class="col-6">
          <div class="vcenter">
            <label class="p-5 rounded border border-dark" for="Admin"><h1>Admin</h1></label>
            <form action="Admin/index.php" method="post">
              <input style="display:none;" type="submit" id="Admin" value="Admin">
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
