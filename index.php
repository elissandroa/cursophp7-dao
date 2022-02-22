<?php 

require_once("config.php");

//Carrega um usuário
/*
$user = new Usuario();

$user->loadById(4);

echo $user;
*/

//Carrega uma lista de usuários

/*$lista = Usuario::getList();

echo json_encode($lista);*/

//Carrega lisa de usuarios buscando pelo login

//$search = Usuario::search("");

//echo json_encode($search);

//Carrega usuario usando login e senha

//$usuario = new Usuario();

//$usuario->login("jamil", "nhaPower");

//echo $usuario;

//Inserindo um usuário

//$aluno = new Usuario("Aluno", "SenhaComConsrutor");

//$aluno->insert();

//echo $aluno;

//Atualizando um usuário

$usuario = new Usuario();

$usuario->loadById(8);

$usuario->update("Carmelo", "Carmelo123");

echo $usuario;

?>