<?php 

include ("includes/header.php");

	if(isset($_GET['acao'])){
		$acao = $_GET['acao'];
		
		if($acao=='welcome'){include("views/painel.php");}
		
		if($acao=='estagio'){include("views/estagio/index.php");}	
		if($acao=='pesquisa'){include("views/pesquisa/index.php");}	
		if($acao=='curso'){include("views/curso/select.php");}	
		
		if($acao=='curso-video'){include("views/curso/selectVideo.php");} 
		
		if($acao=='treinamento'){include("views/treinamento/select.php");}	
		if($acao=='treinamento-video'){include("views/treinamento/selectVideo.php");}	
		
		
		if($acao=='certificado'){include("views/cert-pdf.php");}
		if($acao=='perfil'){include("views/perfil/select.php");}
		if($acao=='meus-dados'){include("views/perfil/update.php");}
		if($acao=='endereco'){include("views/perfil/updateEndereco.php");}
		if($acao=='perfil-meus-dados'){include("views/perfil/menu/dados.php");}
		if($acao=='perfil-inscricoes'){include("views/perfil/menu/inscricoes.php");}
		if($acao=='perfil-estagios'){include("views/perfil/menu/estagios.php");}
		if($acao=='perfil-estagio'){include("views/perfil/menu/estagio.php");}
		
		if($acao=='atualizar-comprovante-de-residencia'){include("views/perfil/menu/atualizar-residencia.php");}
		if($acao=='atualizar-plano-de-aula'){include("views/perfil/menu/atualizar-plano-aula.php");}
		if($acao=='atualizar-comprovante-de-vacinacao'){include("views/perfil/menu/atualizar-cart-vacina.php");}
		
		if($acao=='upload-comprovante-de-residencia'){include("views/perfil/menu/residencia.php");}
		if($acao=='upload-plano-de-aula'){include("views/perfil/menu/plano-aula.php");}
		if($acao=='upload-comprovante-de-vacinacao'){include("views/perfil/menu/cart-vacina.php");}
		if($acao=='termos-de-compromisso'){include("views/perfil/menu/term-compromisso.php");}
		
		if($acao=='subir-cracha'){include("views/perfil/menu/cracha.php");}
		
		if($acao=='escolher-a-semana'){include("views/perfil/menu/semana.php");}
		if($acao=='confirmar-a-semana'){include("views/perfil/menu/conf-semana.php");}
		if($acao=='finalizados'){include("views/perfil/menu/finalizado.php");}
		
		if($acao=='perfil-faltas'){include("views/perfil/menu/faltas.php");}
		if($acao=='motivo-da-desistencia-rEdr458w323'){include("views/perfil/menu/desistencia.php");}
		if($acao=='confirmar-senha'){include("views/perfil/menu/confirmar-senha.php");}

		if($acao=='hospital'){include("views/hospital/select.php");}	
		if($acao=='area-da-prova'){include("views/areaProva/select.php");}
		
		if($acao=='prova'){include("views/areaProva/prova.php");}
		
		if($acao=='avaliacao'){include("views/avaliacao/select.php");}

		
		if($acao=='etapa-0-pag'){include("views/pagamento/etapa-0-pag.php");}
		
		
		
		if($acao=='endereco-confirmar'){include("views/perfil/updateEnderecoConfirmar.php");}
		
		
		if($acao=='etapa-0'){include("views/pagamento/etapa-0.php");}
		if($acao=='etapa-0b'){include("views/pagamento/etapa-0b.php");}
		if($acao=='etapa-1'){include("views/pagamento/etapa-1.php");}
		if($acao=='etapa-11'){include("views/pagamento/etapa-11.php");}
		if($acao=='etapa-1b'){include("views/pagamento/etapa-1b.php");}
		if($acao=='etapa-2'){include("views/pagamento/etapa-2.php");}
		if($acao=='etapa-3'){include("views/pagamento/etapa-3.php");}
		if($acao=='etapa-4'){include("views/pagamento/etapa-4.php");}
		
		if($acao=='aprovado8Efr3Ww1'){include("views/pagamento/apro.php");}
		
		if($acao=='aprovado'){include("views/pagamento/apro.php");}	
		if($acao=='verificar-quiz-resposta'){include("views/quiz/verificar_resposta.php");}			
		if($acao=='analise'){include("views/pagamento/analise.php");}	
		if($acao=='erro-no-processo'){include("views/pagamento/em-pro.php");}
		
		if($acao=='reprovado'){include("views/pagamento/rep.php");}	
		if($acao=='acesso'){include("views/pagamento/acesso.php");}	
		
		if($acao=='atualizar-login2wsdeDEee2@asdEWSfvg'){include("views/perfil/updateSenha.php");}
		if($acao=='login-senha'){include("views/perfil/menu/confirmar-senha-login.php");}
		if($acao=='logout-senha'){include("views/perfil/menu/confirmar-logout.php");}
		
		/* TESTES */
		if($acao=='teste'){include("views/curso/select-teste.php");}
		if($acao=='etapa-00'){include("views/pagamento/etapa-0-teste.php");}
		if($acao=='curso-0'){include("views/curso/select-trava.php");}
		if($acao=='area-da-prova-0'){include("views/areaProva/select-trava.php");}
		
		
	
		
		
	}else{

		include("views/painel.php");
		
	}

include ("includes/footer.php");

?>


