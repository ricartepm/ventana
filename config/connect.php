<?php
@session_start();
$LogSessionId	   = $_SESSION['log_id'];
$LogSessionUsuario = $_SESSION['log_usuario'];
$LogSessionLogin   = $_SESSION['log_login'];
$logSessionSenha   = $_SESSION['log_senha']; 
$LogSessionEmail   = $_SESSION['log_email'];
$LogSessionNivel   = $_SESSION['log_Nivel'];
?>
<?php 
$ventana = ('va');
$conectar = mysqli_connect('localhost','root','Andr0meDA');
$db = mysqli_select_db($conectar, $ventana);
//mysqli_set_charset($conexao,'utf8');

?>
