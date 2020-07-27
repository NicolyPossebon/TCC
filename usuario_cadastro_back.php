<?php
session_start();
include("conectar.php");

$nome_usuario  = $_POST['nome_usuario'];
$email_usuario = $_POST['email_usuario'];
$senha_usuario = $_POST['senha_usuario'];

$select = "select * from usuario where email_usuario = '$email_usuario'";
$result = mysqli_query($conectar, $select);
$row = mysqli_num_rows($result);

$select2 = "select * from usuario where nome_usuario = '$nome_usuario'";
$result2 = mysqli_query($conectar, $select2);
$row2 = mysqli_num_rows($result2);

if ($row2 >= 1){
	 $_SESSION['erros'] = "Este nome já está cadastrado!";
	header('location:usuario_cadastro_front.php');
} else if ($row >= 1){
	 $_SESSION['erros'] = "Este email já está cadastrado!";
	header('location:usuario_cadastro_front.php');
} else if ($row == 0 && $row2 == 0){

	$insert = "INSERT INTO usuario 
					(nome_usuario, email_usuario, tipo_usuario, senha_usuario) 
			   VALUES
			 		('$nome_usuario', '$email_usuario', 2, '$senha_usuario')";

	$query = mysqli_query($conectar, $insert);
	header('location:usuario_login_front.php');
}

mysql_close($conectar);
?>