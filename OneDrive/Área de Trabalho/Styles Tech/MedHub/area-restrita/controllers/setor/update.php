<?php

if(!isset($_GET['id'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id = $_GET['id'];
        $select = "SELECT * FROM permissao_setor as p INNER JOIN login as l ON p.id_login = l.id WHERE p.id_login = :id";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id', $id, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();
      
        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id    = $mostra->id;
            $nome = $mostra->nome;
            $usuario  = $mostra->usuario;
            $senha  = $mostra->senha;
            $Academicos_Cadastrados = $mostra->Academicos_Cadastrados;
            $Academicos_Matriculados = $mostra->Academicos_Matriculados;
            $Academicos_Lista_Aprovados =$mostra->Academicos_Lista_Aprovados;
            $Academicos_Cracha =$mostra->Academicos_Cracha;
            $Medicos_Cadastrados =$mostra->Medicos_Cadastrados;
            $Professores_Novo_Professor =$mostra->Professores_Novo_Professor;
            $Professores_Profs_Cadastrados =$mostra->Professores_Profs_Cadastrados;
            $Hospitais_Hospitas =$mostra->Hospitais_Hospitas;
            $Hospitais_Estagios =$mostra->Hospitais_Estagios;
            $Hospitais_Editais =$mostra->Hospitais_Editais;
            $Cursos_Cursos =$mostra->Cursos_Cursos;
            $Cursos_Módulos =$mostra->Cursos_Módulos;
            $Cursos_Quiz =$mostra->Cursos_Quiz;
            $Cursos_Quiz_Pre_Teste =$mostra->Cursos_Quiz_Pre_Teste;
            $Cursos_aula =$mostra->Cursos_Aula;
            $Aulas_Aulas =$mostra->Aulas_Aulas;
            $Aulas_Video_Aula =$mostra->Aulas_Video_Aula;
            $Aulas_PDF_Aula =$mostra->Aulas_PDF_Aula;
            $Area_Gestor_Permutas =$mostra->Area_Gestor_Permutas;
            $Area_Gestor_Notificacao =$mostra->Area_Gestor_Notificacao;
            $Area_Gestor_Comportamento =$mostra->Area_Gestor_Comportamento;
            $Area_Gestor_Desempenho =$mostra->Area_Gestor_Desempenho;
            $Area_Gestor_Frequencia =$mostra->Area_Gestor_Frequencia;
            $Usuario_Cadastro_Permissao =$mostra->Usuario_Cadastro_Permissao;


        }
        }else{
          echo '<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>Opz!!!</strong> Nada adicionado.
          </div>'; exit;
        }
        }catch(PDOException $e){
          echo $e;
        }
        var_dump($_POST['Editar']);
    if(isset($_POST['Editar'])){
      
        $id = trim (strip_tags($_GET['id']));
        //echo '--------------------------------';
        //print_r($id);
        $usuario  = trim(strip_tags($_POST["usuario"]));
        $senha  = trim(strip_tags($_POST["senha"]));
        $nome = trim(strip_tags($_POST["nome"]));
        $Academicos_Cadastrados =trim(strip_tags($_POST["checkAcademicoCadastrado"]));
        $Academicos_Matriculados =trim(strip_tags($_POST["checkAcademicoMatriculado"]));
        $Academicos_Lista_Aprovados =trim(strip_tags($_POST["checkAcademicoListaAprovado"]));
        $Academicos_Cracha =trim(strip_tags($_POST["checkAcademicoCracha"]));
        $Medicos_Cadastrados =trim(strip_tags($_POST["checkMedicoCadastrado"]));
        $Professores_Novo_Professor =trim(strip_tags($_POST["checkProfessorNovoProfessor"]));
        $Professores_Profs_Cadastrados =trim(strip_tags($_POST["checkProfessorProfsCadastrado"]));
        $Hospitais_Hospitas =trim(strip_tags($_POST["checkHospitalHospital"]));
        $Hospitais_Estagios =trim(strip_tags($_POST["checkHospitalEstagio"]));
        $Hospitais_Editais =trim(strip_tags($_POST["checkHospitalEdital"]));
        $Cursos_Cursos =trim(strip_tags($_POST["checkCursoCurso"]));
        $Cursos_Módulos =trim(strip_tags($_POST["checkCursoModulo"]));
        $Cursos_Quiz =trim(strip_tags($_POST["checkCursoQuiz"]));
        $Cursos_Quiz_Pre_Teste =trim(strip_tags($_POST["checkCursoQuizPreTeste"]));
        $Cursos_aula =trim(strip_tags($_POST["checkCursoAula"]));
        $Aulas_Aulas =trim(strip_tags($_POST["checkAulaAula"]));
        $Aulas_Video_Aula =trim(strip_tags($_POST["checkVideoAula"]));
        $Aulas_PDF_Aula =trim(strip_tags($_POST["checkPdfAula"]));
        $Area_Gestor_Permutas =trim(strip_tags($_POST["checkAreaGestorPermuta"]));
        $Area_Gestor_Notificacao =trim(strip_tags($_POST["checkAreaGestorNotificacao"]));
        $Area_Gestor_Comportamento =trim(strip_tags($_POST["checkAreaGestorComportamento"]));
        $Area_Gestor_Desempenho =trim(strip_tags($_POST["checkAreaGestorDesempenho"]));
        $Area_Gestor_Frequencia =trim(strip_tags($_POST["checkAreaGestorFrequencia"]));
        $Usuario_Cadastro_Permissao =trim(strip_tags($_POST["checkCadastroUsuario"]));
      
            $update ="UPDATE login as l
            INNER JOIN permissao_setor as p ON l.id = p.id_login
            SET 
             l.usuario=:usuario,
             l.senha=:senha,
             l.nome=:nome,
             p.Academicos_Cadastrados =:checkAcademicoCadastrado,
             p.Academicos_Matriculados =:checkAcademicoMatriculado,
             p.Academicos_Lista_Aprovados =:checkAcademicoListaAprovado,
             p.Academicos_Cracha =:checkAcademicoCracha,
             p.Medicos_Cadastrados =:checkMedicoCadastrado,
             p.Professores_Novo_Professor =:checkProfessorNovoProfessor,
             p.Professores_Profs_Cadastrados =:checkProfessorProfsCadastrado,
             p.Hospitais_Hospitas =:checkHospitalHospital,
             p.Hospitais_Estagios =:checkHospitalEstagio,
             p.Hospitais_Editais =:checkHospitalEdital,
             p.Cursos_Cursos =:checkCursoCurso,
             p.Cursos_Módulos =:checkCursoModulo,
             p.Cursos_Quiz =:checkCursoQuiz,
             p.Cursos_Quiz_Pre_Teste =:checkCursoQuizPreTeste,
             p.Cursos_Aula =:checkCursoAula,
             p.Aulas_Aulas =:checkAulaAula,
             p.Aulas_Video_Aula =:checkVideoAula,
             p.Aulas_PDF_Aula =:checkPdfAula,
             p.Area_Gestor_Permutas =:checkAreaGestorPermuta,
             p.Area_Gestor_Notificacao =:checkAreaGestorNotificacao,
             p.Area_Gestor_Comportamento =:checkAreaGestorComportamento,
             p.Area_Gestor_Desempenho =:checkAreaGestorDesempenho,
             p.Area_Gestor_Frequencia =:checkAreaGestorFrequencia,
             p.Usuario_Cadastro_Permissao = :checkCadastroUsuario
            WHERE p.id_login = :id"; 
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id',$id, PDO::PARAM_INT);
                $result ->bindParam(':usuario',$usuario, PDO::PARAM_STR);
                $result ->bindParam(':senha',$senha, PDO::PARAM_STR);
                $result ->bindParam(':nome',$nome, PDO::PARAM_STR);
                $result ->bindParam(':checkAcademicoCadastrado',$Academicos_Cadastrados, PDO::PARAM_STR);
                $result ->bindParam(':checkAcademicoMatriculado',$Academicos_Matriculados, PDO::PARAM_STR);
                $result ->bindParam(':checkAcademicoListaAprovado',$Academicos_Lista_Aprovados, PDO::PARAM_STR);
                $result ->bindParam(':checkAcademicoCracha',$Academicos_Cracha, PDO::PARAM_STR);
                $result ->bindParam(':checkMedicoCadastrado',$Medicos_Cadastrados, PDO::PARAM_STR);
                $result ->bindParam(':checkProfessorNovoProfessor',$Professores_Novo_Professor, PDO::PARAM_STR);
                $result ->bindParam(':checkProfessorProfsCadastrado',$Professores_Profs_Cadastrados, PDO::PARAM_STR);
                $result ->bindParam(':checkHospitalHospital',$Hospitais_Hospitas, PDO::PARAM_STR);
                $result ->bindParam(':checkHospitalEstagio',$Hospitais_Estagios, PDO::PARAM_STR);
                $result ->bindParam(':checkHospitalEdital',$Hospitais_Editais, PDO::PARAM_STR);
                $result ->bindParam(':checkCursoCurso',$Cursos_Cursos, PDO::PARAM_STR);
                $result ->bindParam(':checkCursoModulo',$Cursos_Módulos, PDO::PARAM_STR);
                $result ->bindParam(':checkCursoQuiz',$Cursos_Quiz, PDO::PARAM_STR);
                $result ->bindParam(':checkCursoQuizPreTeste',$Cursos_Quiz_Pre_Teste, PDO::PARAM_STR);
                $result ->bindParam(':checkCursoAula',$Cursos_aula, PDO::PARAM_STR);
                $result ->bindParam(':checkAulaAula',$Aulas_Aulas, PDO::PARAM_STR);
                $result ->bindParam(':checkVideoAula',$Aulas_Video_Aula, PDO::PARAM_STR);
                $result ->bindParam(':checkPdfAula',$Aulas_PDF_Aula, PDO::PARAM_STR);
                $result ->bindParam(':checkAreaGestorPermuta',$Area_Gestor_Permutas, PDO::PARAM_STR);
                $result ->bindParam(':checkAreaGestorNotificacao',$Area_Gestor_Notificacao, PDO::PARAM_STR);
                $result ->bindParam(':checkAreaGestorComportamento',$Area_Gestor_Comportamento, PDO::PARAM_STR);
                $result ->bindParam(':checkAreaGestorDesempenho',$Area_Gestor_Desempenho, PDO::PARAM_STR);
                $result ->bindParam(':checkAreaGestorFrequencia',$Area_Gestor_Frequencia, PDO::PARAM_STR);
                $result ->bindParam(':checkCadastroUsuario',$Usuario_Cadastro_Permissao, PDO::PARAM_STR);
                //print_r($result->errorInfo());
                $result ->execute();
                //print_r($result->errorInfo());
                $contar = $result->rowCount();
                //print_r($result->errorInfo());



            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                    header("Refresh: 1, home.php?acao=usuario");
            }else{
              print_r($result->errorInfo());
                echo '<div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> O Conteúdo não foi atualizado de forma correta!</strong> 
                    </div>';
                  
            }
        }catch(PDOException $e){
            echo $e;
        }
                                    
    }    

?>