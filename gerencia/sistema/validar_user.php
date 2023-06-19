<?php 

include"../Connections/conf.php";

$usuarioSistema = $_SESSION['MM_Username'];

$sqlSistema_usuarioSistema = 'SELECT * FROM master_user WHERE user_email = :usuarioSistema';

try {
$querySistema_usuarioSistema = $conecta->prepare($sqlSistema_usuarioSistema);
$querySistema_usuarioSistema->bindValue(':usuarioSistema',$usuarioSistema,PDO::PARAM_STR);
$querySistema_usuarioSistema->execute();
var_dump($querySistema_usuarioSistema);
$resultado_querySistema = $querySistema_usuarioSistema->fetchAll(PDO::FETCH_ASSOC);
       
} catch (PDOException $erro_usuarioSistema) {
    echo 'erro ao selecionar o usuario';
    echo '<meta http-equiv="refresh" content="2, deslogar.php"/>';
}

   foreach($resultado_querySistema as $res_usuarioSistema);
        $clienteId       = $res_usuarioSistema['user_id'];
        $clienteCria     = $res_usuarioSistema['user_date_criacao'];
        $clienteMod      = $res_usuarioSistema['user_date_modi'];
        $clienteStatus   = $res_usuarioSistema['user_status'];
        $clienteNivel    = $res_usuarioSistema['user_nivel'];
        $clienteNome     = $res_usuarioSistema['user_nome'];
        $clienteEmail    = $res_usuarioSistema['user_email'];
        $clienteSenha    = $res_usuarioSistema['user_senha'];
        $clienteTelefone = $res_usuarioSistema['user_telefone'];
      

?>