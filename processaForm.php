<?php
require_once 'vendor/autoload.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();;
$nome    = $_REQUEST['nome'];
$email   = $_REQUEST['email'];
$fone = $_REQUEST['fone'];
$msg     = $_REQUEST['mensagem'];

$corpo   = "<strong> Mensagem de contato </strong><br><br>";
$corpo  .= "<strong> Nome: </strong> $nome<br>";
$corpo  .= "<strong> Email: </strong> $email<br>";
$corpo  .= "<strong> Telefone: </strong> $fone<br>";
$corpo  .= "<strong> Mensagem: </strong> $msg<br>";

$mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
$mail->Username = 'contato@medhub.app.br';
$mail->Password = 'Hostinger@123';
$mail->setFrom('contato@medhub.app.br', 'MedHub');
$mail->addAddress('contato@medhub.app.br', 'Contato MedHub');

$mail->isHTML(true);
$mail->Subject = 'Contato Pelo Site - MedHub';
$mail->Body  = $corpo;

if ($mail->send()) {
	return header("location:enviado.php?msg=enviado");
}
