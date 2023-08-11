<?php

$sessionActiva = true; //false;

if($sessionActiva){
    header('Location:sistema.php');
}elseif($sessionActiva){
    header('Location:login.php');
}
elseif($sessionActiva){
    header('Location:sistema_cliente.php');
}else{
    header('Location:login_cliente.php');
}





?>