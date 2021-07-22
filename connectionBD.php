<?php
$host ='localhost';
$user='root';
$pasword='';
$db='territoriossmg_dev';

$connection= @mysqli_connect($host,$user,$pasword,$db);
if(!$connection){
    echo "Error en la conexion a la base de datos";
}
?>