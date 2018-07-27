<?php

include "modelo_usuarios.php";

function userExiste($user){
  $usuario=new usuario_model();

  $infoUser = $usuario->getUsuario($user); //devuelve un array con el nombre usuario
  //verificar si existe o no
  if (!$infoUser) { //no existe
    return 0;
  }else{//existe
    return 1;
  }
}

function verificarADM($user,$psw){
  $usuario=new usuario_model();

  $infoUser = $usuario->getUsuario($user); //devuelve un array con el nombre usuario
  //verificar si existe o no
  if ($infoUser[1]==$psw) { //no existe
    return 1;
  }else{//existe
    return 0;
  }
}

?>
