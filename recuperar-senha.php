<?php
require_once 'vendor/autoload.php';

include 'includes/headerIndex.php';

?>
<div>
  <?php
  $select = "SELECT * from m";  
  try{
  $result = $conexao->prepare($select);
  $result ->execute();
  $contar = $result->rowCount();

  if($contar>0){
  while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

    if($mostra->m_m != '1'){
      echo 'MANUTENÇÃO';
    }else{

	if(isset($_POST['recuperar'])){
			include("area-restrita/models/conecta.php");
			$email_acad  = utf8_decode (addslashes(strip_tags(trim($_POST['email_acad']))));
			$assunto  = 'Recuperação de Senha - MedHub';
		// verifica se o e-mail está no cadastrado no sistem	
			$select = "SELECT * from academico WHERE email_acad='$email_acad' ";
		
		try{
			$result = $conexao->prepare($select);
			//$result->bindValue(':email_acad', $email_acad, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				foreach($conexao->query($select) as $exibe);
				$nomeUser 		= $exibe['nome_acad'];
				$usuarioUser 	= $exibe['email_acad'];
				$senhaUser 		= $exibe['senha_acad'];

                $mail = new PHPMailer\PHPMailer\PHPMailer();

                $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = 'smtp.hostinger.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
                $mail->Username = 'suporte@medhub.app.br';
                $mail->Password = 'Hostinger@123';
                $mail->setFrom('suporte@medhub.app.br', 'MedHub');
                $mail->addAddress($usuarioUser, 'Suporte MedHub - Sua nova senha');

                $mail->isHTML(true);
                $mail->Subject = 'Suporte MedHub - Sua nova senha';
                $mail->Body    = "<h1>MedHub</h1>
			                 Seguem os dados para acesso.<br /><br />
							 <h3><strong>Nome:</strong> {$nomeUser}<br /></h3>
							 <h3><strong>Usu&aacute;rio:</strong> {$usuarioUser}<br /></h3>
							 <h3><strong>Senha:</strong> {$senhaUser}<br /><br /></h3>
							 
							 <strong>Obs:</strong> Voc&ecirc; n&atilde;o precisa responder &agrave; este e-mail, 
							 
							";
//                $mail->AltBody = 'Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML';


			// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
			if(!$mail->send()){
				echo '<br /><div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro ao enviar!</strong> Houve um problema ao recuperar sua senha, contate o administrador.
                </div>';
			//	echo "Erro: " . $mail->ErrorInfo;
			}else{
				echo '<br /><div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Sucesso!</strong> Uma mensagem com as informações de acesso será enviada p/ 
                      o e-mail cadastrado, não esqueça de olhar a caixa de SPAN, Obrigado...
                </div>';
                header("Location: enviado-recupera.php");
			}	
				
				
			}else{
				echo '<br /><div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Opss!</strong> O e-mail digitado não está cadastrado em nossa plataforma.
                </div>';
			}			
		}catch(PDOException $e){
			echo $e;
		}	
	}// se clicar
?>
</div>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
<div class="container-fluid">

        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Recuperar senha</strong>
                  <center>
                  <div style="width: 150px; margin-top: 20px;">
                    <img src="assets/images/medhub_principal-beta.png" alt="MedHub">  
                  </div>
                  </center>
                </h3> 
            </div>
        </div>
    </div>
</section>
<div class="container">
  <div class="row align-items-start">
    <div class="col">
        <center>
        
        <form action="#" method="post" enctype="multipart/form-data">
          <div class="form-group col-md-4">
            <input class="place_form form-control" type="text" name="email_acad" id="email_acad"  placeholder="Qual o email cadastrado?" style="border-radius: 25px;" required>
          </div>
          <p style="color: #fff;">Serão enviadas as instruções no seu email para recuperar a senha!</p>
          <button class="btn btn-white display-4" type="submit" name="recuperar"> 
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Enviar
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
          </button>
        </form>
        </center>
    </div>
  </div>
</div>
<div>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
</div>
<?php include 'includes/footerIndex.php';
}
}
}else{
  echo '<div class="alert alert-info">
      <button type="button" class="close" data-dismiss="warning"></button>
      <strong> Nada Cadastrado!!!</strong> 
      </div>';
}
}catch(PDOException $e){
  echo $e;
}
?> 
