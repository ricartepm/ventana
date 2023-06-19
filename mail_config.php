<?php function sendMail($assunto,$msg,$destino,$nomeDestino){
require_once('mailer/class.phpmailer.php'); //Include pasta/classe do PHPMailer
$mail = new PHPMailer(); //INICIA A CLASSE
$mail->IsSMTP(); //Habilita envio SMPT
$mail->SMTPAuth = true; //Ativa email autenticado
$mail->Host = 'smtp.gmail.com'; //Servidor de envio
$mail->Port = '587'; //Porta de envio
$mail->SMTPSecure = 'tls';
$mail->Username = 'arquivo.ventana@ricarte.eti.br'; //email para smtp autenticado
$mail->Password = 'Servs@DM'; //seleciona a porta de envio
$mail->From = 'arquivo.ventana@ricarte.eti.br'; //remtente
$mail->FromName = 'Arquivo Ventana Serra'; //remtetene nome
$mail->IsHTML(true);
$mail->Subject = utf8_decode($assunto); //assunto
$mail->Body = utf8_decode($msg); //mensagem
$mail->AddAddress($destino,utf8_decode($nomeDestino)); //email e nome do destino
if(!$mail->Send()){
 echo '<span>Erro ao enviar, favor entre em contato pelo e-mail MEU EMAIL!</span>';
}else{
}
}?>
