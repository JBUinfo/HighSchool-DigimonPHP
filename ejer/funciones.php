<?php
function get_digimons($path){
  ///Digimons/digimons.txt
  $path =str_replace("\\", "/", $path);
  $file5 = fopen($path, "r");
  clearstatcache();
  if (filesize($path) == 0) {
  } else {
    $cadena_digimons = fread($file5, filesize($path));
    $array_digimons = explode(PHP_EOL, $cadena_digimons);
    for ($i = 0; $i < count($array_digimons) - 1; $i++) {
        $array_digimons[$i] = explode('**', $array_digimons[$i]);
    }
  }
  fclose($file5);
  return $array_digimons;
}


/*
function get_info_digimon($nombre){
  $path = getcwd();
  echo $path;
  $file5 = fopen($path."\Digimons\digimons.txt", "r");
  $cadena_digimons = fread($file5, filesize($path."\digimons.txt"));
  $array_digimons = explode(PHP_EOL, $cadena_digimons);
  $Existe = false;
  for ($i = 0; $i < count($array_digimons) - 1; $i++) {
      $array_digimons[$i] = explode('**', $array_digimons[$i]);
      if ($nombre == $array_digimons[$i][0]) {
        return $array_digimons[$i];
      }
  }
}
*/
function existe_digimon($nombre,$path){
///Digimons/digimons.txt
  $path =str_replace("\\", "/", $path);
  $Existe = false;
  $file5 = fopen($path, "a+");
   if (filesize($path) == 0) {
   } else {
     $cadena_digimons = fread($file5, filesize($path));
     $array_digimons = explode(PHP_EOL, $cadena_digimons);
     for ($i = 0; $i < count($array_digimons) - 1; $i++) {
         $array_digimons[$i] = explode('**', $array_digimons[$i]);
         if ($nombre == $array_digimons[$i][0]) {
           $Existe = true;
         }
     }
   }
   fclose($file5);
   return $Existe;

}

function usuario_tiene_digimon($nombre,$path){
///Usuarios/nick/digimones_usuario.txt"
  $path =str_replace("\\", "/", $path);
  $file5 = fopen($path, "r");
  $Existe = false;
  clearstatcache();
  if (filesize($path) == 0) {
  } else {
    $cadena_digimons = fread($file5, filesize($path));
    $array_digimons = explode(PHP_EOL, $cadena_digimons);
    for ($i = 0; $i < count($array_digimons) - 1; $i++) {
        $array_digimons[$i] = explode('**', $array_digimons[$i]);
        if ($nombre == $array_digimons[$i][0]) {
          $Existe = true;
        }
    }
  }
  fclose($file5);
  return $Existe;
}

function existe_usuario($nick,$path){
  ///Usuarios/usuarios.txt
  $path =str_replace("\\", "/", $path);
  $file5 = fopen($path, "a+");
  $Existe = false;
  if (filesize($path) == 0) {
  } else {
    $cadena_usuarios = fread($file5, filesize($path));
    $array_usuarios = explode(PHP_EOL, $cadena_usuarios);
    for ($i = 0; $i < count($array_usuarios) - 1; $i++) {
        $array[$i] = explode('**', $array_usuarios[$i]);
        if ($nick == $array[$i][0]) {
          $Existe = true;
        }
    }
  }
  fclose($file5);
  return $Existe;
}
 ?>
