<?php

$server = "localhost";
$user   = "root";
$senha  = "";
$banco  = "tcc";

$conectar = mysqli_connect($server, $user, $senha, $banco);

if(!$conectar){

	echo "Não foi possível conectar ao MySQL." . PHP_EOL;
	echo "Bebugging erro: ".mysqli_connect_error() . PHP_EOL;
	exit;

}

?>