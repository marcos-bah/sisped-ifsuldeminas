<?php
// session_start inicia a sessão
session_start();
include_once('initSystem.php');
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = sha1(md5($_POST['senha'])); //hash

include("dbconnection.php");

// A variavel $result pega as varias $login e $senha, faz uma
//pesquisa na tabela de usuarios
$result = mysqli_query($conn,"SELECT * FROM `sispeduser`
WHERE `nameuser` = '$login' AND `password`= '$senha'");
/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi
bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do
resultado ele redirecionará para a página site.php ou retornara  para a página
do formulário inicial para que se possa tentar novamente realizar o login */
if(mysqli_num_rows($result) > 0 )
{
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
header('location:../consultas.php');
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  session_destroy();
  header('location:../login.php');
  }
?>
