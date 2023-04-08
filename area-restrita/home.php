<?php 
<<<<<<< HEAD
=======

>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
include ("header.php");

	if(isset($_GET['acao'])){
		$acao = $_GET['acao'];
		
<<<<<<< HEAD
		
=======
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
		if($acao=='welcome'){include("views/painel.php");}	
		if($acao=='seguranca'){include("views/seg.php");}
		if($acao=='cracha'){include("views/cracha.php");}
		
		/*--- RANKING --*/
<<<<<<< HEAD
		if(isset($perm->ranking) && $perm->ranking)
		{
			if($acao=='lista-ranking'){include("views/ranking/index.php");}
			if($acao=='ranking'){include("views/ranking/select.php");}
		}
=======
		if($acao=='lista-ranking'){include("views/ranking/index.php");}
		if($acao=='ranking'){include("views/ranking/select.php");}
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
		
		/*--- HORÁRIOS ---*/	
		if($acao=='horarios'){include("views/horarios/index.php");}
		if($acao=='horario'){include("views/academico/select.php");}
		if($acao=='novo-horario'){include("views/horarios/insert.php");}
		if($acao=='editar-horario'){include("views/horarios/update.php");}

<<<<<<< HEAD
		/*--- ACADEMICO ---*/
		if(isset($perm->academico) && ($perm->academico)){
			if($acao=='academicos'){include("views/academico/index.php");}
			if($acao=='academico'){include("views/academico/select.php");}
			if($acao=='indicacao'){include("views/academico/insert.php");}
			if($acao=='editar-indicacao'){include("views/academico/update.php");}
		}
		
		/*--- ACADEMICO ---*/
		if(isset($perm->medico) && $perm->medico){
			if($acao=='medicos'){include("views/medico/index.php");}
			if($acao=='medico'){include("views/medico/select.php");}
		}
=======
		/*--- ACADEMICO ---*/	
		if($acao=='academicos'){include("views/academico/index.php");}
		if($acao=='academico'){include("views/academico/select.php");}
		if($acao=='indicacao'){include("views/academico/insert.php");}
		if($acao=='editar-indicacao'){include("views/academico/update.php");}
		
		/*--- ACADEMICO ---*/	
		if($acao=='medicos'){include("views/medico/index.php");}
		if($acao=='medico'){include("views/medico/select.php");}
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
		
		/*---LISTA APROVADOS ---*/
		if($acao=='lista-de-aprovados'){include("views/aprovadosPdf/index.php");}
		if($acao=='nova-lista'){include("views/aprovadosPdf/insert.php");}
		
		/*--- PRESENÇA ---*/	
		if($acao=='presencas'){include("views/presenca/index.php");}
		if($acao=='presenca'){include("views/presenca/select.php");}
		if($acao=='nova-presenca'){include("views/presenca/insert.php");}
		if($acao=='editar-presenca'){include("views/presenca/update.php");}

		/*--- AULAS ---*/
<<<<<<< HEAD
		if(isset($perm->aula)){
			if($acao=='aulas'){include("views/aula/index.php");}
			if($acao=='aula'){include("views/aula/select.php");}
			if($acao=='nova-aula'){include("views/aula/insert.php");}
			if($acao=='aula-outros'){include("views/aula/outros.php");}
			if($acao=='editar-aula'){include("views/aula/update.php");}
	
			/*--- AULAS VÍDEO ---*/
			if($acao=='aulas-videos'){include("views/aulaVideo/index.php");}
			if($acao=='aulas-treinamento'){include("views/aulaVideo/index.php");}
			if($acao=='aula-video'){include("views/aulaVideo/select.php");}
			if($acao=='nova-aula-video'){include("views/aulaVideo/insert.php");}
	
			/*--- AULAS PDF ---*/
			if($acao=='aulas-pdf'){include("views/aulaPdf/index.php");}
			if($acao=='aula-pdf'){include("views/aulaPdf/select.php");}
			if($acao=='nova-aula-pdf'){include("views/aulaPdf/insert.php");}
		}
=======
		if($acao=='aulas'){include("views/aula/index.php");}
		if($acao=='aula'){include("views/aula/select.php");}
		if($acao=='nova-aula'){include("views/aula/insert.php");}
		if($acao=='aula-outros'){include("views/aula/outros.php");}
		if($acao=='editar-aula'){include("views/aula/update.php");}

		/*--- AULAS VÍDEO ---*/
		if($acao=='aulas-videos'){include("views/aulaVideo/index.php");}
		if($acao=='aulas-treinamento'){include("views/aulaVideo/index.php");}
		if($acao=='aula-video'){include("views/aulaVideo/select.php");}
		if($acao=='nova-aula-video'){include("views/aulaVideo/insert.php");}

		/*--- AULAS PDF ---*/
		if($acao=='aulas-pdf'){include("views/aulaPdf/index.php");}
		if($acao=='aula-pdf'){include("views/aulaPdf/select.php");}
		if($acao=='nova-aula-pdf'){include("views/aulaPdf/insert.php");}

>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
		/*--- ESTÁGIOS ---*/
		if($acao=='estagios'){include("views/estagio/index.php");}
		if($acao=='estagio'){include("views/estagio/select.php");}
		if($acao=='novo-estagio'){include("views/estagio/insert.php");}
		if($acao=='editar-estagio'){include("views/estagio/update.php");}
		
		/*--- EDITAL ---*/
		if($acao=='editais-pdf'){include("views/editalPdf/index.php");}
		if($acao=='edital-pdf'){include("views/editalPdf/select.php");}
		if($acao=='novo-edital-pdf'){include("views/editalPdf/insert.php");}

		/*--- CURSOS ---*/
<<<<<<< HEAD
		if(isset($perm->curso)){
			if($acao=='cursos'){include("views/curso/index.php");}
			if($acao=='curso'){include("views/curso/select.php");}
			if($acao=='novo-curso'){include("views/curso/insert.php");}
			if($acao=='editar-curso'){include("views/curso/update.php");}
		}
		
		/*--- HOSPITAIS ---*/
		if(isset($perm->hospital)){
			if($acao=='hospitais'){include("views/hospital/index.php");}
			if($acao=='hospital'){include("views/hospital/select.php");}
			if($acao=='novo-hospital'){include("views/hospital/insert.php");}
			if($acao=='editar-hospital'){include("views/hospital/update.php");}
		}
=======
		if($acao=='cursos'){include("views/curso/index.php");}
		if($acao=='curso'){include("views/curso/select.php");}
		if($acao=='novo-curso'){include("views/curso/insert.php");}
		if($acao=='editar-curso'){include("views/curso/update.php");}
		
		/*--- HOSPITAIS ---*/
		if($acao=='hospitais'){include("views/hospital/index.php");}
		if($acao=='hospital'){include("views/hospital/select.php");}
		if($acao=='novo-hospital'){include("views/hospital/insert.php");}
		if($acao=='editar-hospital'){include("views/hospital/update.php");}
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650

		/*--- MATRICULA ---*/
		if($acao=='matriculas'){include("views/matricula/index.php");}
		if($acao=='matricula'){include("views/matricula/update.php");}
		if($acao=='matricular-academico'){include("views/matricula/insert.php");}
		if($acao=='matricular-academico-nome'){include("views/matricula/insert-nome.php");}
		if($acao=='matricula-add'){include("views/matricula/m.php");}
		
		/*--- MÓDULOS ---*/
		if($acao=='modulos'){include("views/modulo/index.php");}
		if($acao=='modulo'){include("views/modulo/select.php");}
		if($acao=='novo-modulo'){include("views/modulo/insert.php");}	
		if($acao=='editar-modulo'){include("views/modulo/update.php");}	

		/*--- QUIZ ---*/
		if($acao=='quiz'){include("views/quiz/index.php");}
<<<<<<< HEAD
		if($acao=='quiz-pre-teste'){include("views/quiz/index_pre_teste.php");}
		
		if($acao=='novo-quiz-pre-teste'){include("views/quiz/insertQuizPreTeste.php");}
		if($acao=='novo-quiz'){include("views/quiz/insert.php");}

		// treinamento-v2
		if($acao=='aulas-treinamento-v2'){include("views/treinamento/aulas.php");}
		if($acao=='aula-treinamento-v2'){include("views/treinamento/select.php");}
		if($acao=='editar-aula-treinamento'){include("views/treinamento/update.php");}

		
		/*--- PROFESSORES ---*/
		if(isset($perm->professor)){
			if($acao=='professores'){include("views/professor/index.php");}
			if($acao=='professor'){include("views/professor/select.php");}
			if($acao=='novo-professor'){include("views/professor/insert.php");}	
			if($acao=='editar-professor'){include("views/professor/update.php");}
		}
		
		/****  AREA RESTRITA *****/
		if($acao=='area-gestor-notificacao'){include("views/areaGestor/AreaGestorNotificacao.php");}		
=======
		if($acao=='quiz-editar'){include("views/quiz/update_quiz.php");}
		if($acao=='quiz-pre-teste'){include("views/quiz/index_pre_teste.php");}
		if($acao=='quiz-pre-teste-editar'){include("views/quiz/update_quiz_pre_teste.php");}

		if($acao=='novo-quiz-pre-teste'){include("views/quiz/insertQuizPreTeste.php");}
		if($acao=='novo-quiz'){include("views/quiz/insert.php");}

		// TREINAMENTO-V2
		if($acao=='aulas-treinamento-v2'){include("views/treinamento/aulas.php");}

		if($acao=='aula-treinamento-v2'){include("views/treinamento/select.php");}
        

        if($acao=='aula-treinamento-v2-video-aula'){include("views/aulaVideoTreinamento/index.php");}
		if($acao=='aula-treinamento-v2-video-aula-pdf'){include("views/aulaPdfTreinamento/index.php");}
        if($acao=='nova-aula-video-treinamento'){include("views/aulaVideoTreinamento/insert.php");}


		if($acao=='editar-aula-treinamento'){include("views/treinamento/update.php");}

        /** AVALIAÇÕES */
		if($acao=='avaliacoes'){include("views/avaliacao/index.php");}
        if($acao=='detalhes-avaliacao'){include("views/avaliacao/select.php");}
		if($acao=='nova-avaliacao'){include("views/avaliacao/insert.php");}
		if($acao=='editar-avaliacao'){include("views/avaliacao/update.php");}

		
		/*--- PROFESSORES ---*/
		if($acao=='professores'){include("views/professor/index.php");}
		if($acao=='professor'){include("views/professor/select.php");}
		if($acao=='novo-professor'){include("views/professor/insert.php");}	
		if($acao=='editar-professor'){include("views/professor/update.php");}
		
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
		
	}else{
		include("views/painel.php");
	}
