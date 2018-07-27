<?php
class Conectar{

  public static function conexion(){ //establecer conexión con PDO
    try {
      $con=new PDO('mysql:host=localhost; dbname=jgestor', 'root','');
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $con->exec("SET CHARACTER SET UTF8");

    } catch (\Exception $e) {
      die("Error".$e->getMessage());
      echo "Linea del error ".$e->getLine();
    }
    return $con;
  }

}

 ?>
