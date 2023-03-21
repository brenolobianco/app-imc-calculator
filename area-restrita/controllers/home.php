<?php 

include ("header.php");

	if(isset($_GET['acao'])){
		$acao = $_GET['acao'];
		
		if($acao=='welcome'){include("views/painel.php");}	
		if($acao=='seguranca'){include("views/seg.php");}
		if($acao=='cracha'){include("views/cracha.php");}
		
		/*--- RANKING --*/
		if($acao=='lista-ranking'){include("views/ranking/index.php");}
		if($acao=='ranking'){include("views/ranking/select.php");}
		
		/*--- HORÁRIOS ---*/	
		if($acao=='horarios'){include("views/horarios/index.php");}
		if($acao=='horario'){include("views/academico/select.php");}
		if($acao=='novo-horario'){include("views/horarios/insert.php");}
		if($acao=='editar-horario'){include("views/horarios/update.php");}

		/*--- ACADEMICO ---*/	
		if($acao=='academicos'){include("views/academico/index.php");}
		if($acao=='academico'){include("views/academico/select.php");}
		if($acao=='indicacao'){include("views/academico/insert.php");}
		if($acao=='editar-indicacao'){include("views/academico/update.php");}
		
		/*--- ACADEMICO ---*/	
		if($acao=='medicos'){include("views/medico/index.php");}
		if($acao=='medico'){include("views/medico/select.php");}
		
		/*---LISTA APROVADOS ---*/
		if($acao=='lista-de-aprovados'){include("views/aprovadosPdf/index.php");}
		if($acao=='nova-lista'){include("views/aprovadosPdf/insert.php");}
		
		/*--- PRESENÇA ---*/	
		if($acao=='presencas'){include("views/presenca/index.php");}
		if($acao=='presenca'){include("views/presenca/select.php");}
		if($acao=='nova-presenca'){include("views/presenca/insert.php");}
		if($acao=='editar-presenca'){include("views/presenca/update.php");}

		/*--- AULAS ---*/
		if($acao=='aulas'){include("views/aula/index.php");}
		if($acao=='aula'){include("views/aula/select.php");}
		if($acao=='nova-aula'){include("views/aula/insert.php");}
	
		if($acao=='aula-outros'){include("views/aula/outros.php");}
		if($acao=='editar-aula'){include("views/aula/update.php");}
		if($acao=='editar-aula-treinamento'){include("views/aula/update.php");}

		/*--- AULAS VÍDEO ---*/
		if($acao=='aulas-videos'){include("views/aulaVideo/index.php");}
		if($acao=='aula-video'){include("views/aulaVideo/select.php");}
		if($acao=='nova-aula-video'){include("views/aulaVideo/insert.php");} 

		/*--- AULAS PDF ---*/
		if($acao=='aulas-pdf'){include("views/aulaPdf/index.php");}
		if($acao=='aula-pdf'){include("views/aulaPdf/select.php");}
		if($acao=='nova-aula-pdf'){include("views/aulaPdf/insert.php");}

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
		if($acao=='cursos'){include("views/curso/index.php");}
		if($acao=='curso'){include("views/curso/select.php");}
		if($acao=='novo-curso'){include("views/curso/insert.php");}
		if($acao=='editar-curso'){include("views/curso/update.php");}
		
		/*--- HOSPITAIS ---*/
		if($acao=='hospitais'){include("views/hospital/index.php");}
		if($acao=='hospital'){include("views/hospital/select.php");}
		if($acao=='novo-hospital'){include("views/hospital/insert.php");}
		if($acao=='editar-hospital'){include("views/hospital/update.php");}

		/*--- MATRICULA ---*/
		if($acao=='matriculas'){include("views/matricula/index.php");}
		if($acao=='matricula'){include("views/matricula/update.php");}
		if($acao=='matricular-academico'){include("views/matricula/insert.php");}
		if($acao=='matricula-add'){include("views/matricula/m.php");}
		
		/*--- MÓDULOS ---*/
		if($acao=='modulos'){include("views/modulo/index.php");}
		if($acao=='modulo'){include("views/modulo/select.php");}
		if($acao=='novo-modulo'){include("views/modulo/insert.php");}	
		if($acao=='editar-modulo'){include("views/modulo/update.php");}	

		/*--- PROFESSORES ---*/
		if($acao=='professores'){include("views/professor/index.php");}
		if($acao=='professor'){include("views/professor/select.php");}
		if($acao=='novo-professor'){include("views/professor/insert.php");}	
		if($acao=='editar-professor'){include("views/professor/update.php");}
		
		
	}else{
		include("views/painel.php");
	}
