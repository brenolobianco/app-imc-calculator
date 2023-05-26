<?php

 if(!isset($_GET['id'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_login = $_GET['id'];

        $select = "SELECT * FROM login l JOIN permissao_setor p ON p.id_login = l.id WHERE id=:id";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id', $id_login, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_login   = $mostra->id;
                $nome  = $mostra->nome;
                $usuario   = $mostra->usuario;
                $senha  = $mostra->senha;
                $Academicos_Cadastrados  = $mostra->Academicos_Cadastrados;
                $Academicos_Matriculados = $mostra->Academicos_Matriculados;
                $Academicos_Lista_Aprovados = $mostra->Academicos_Lista_Aprovados;
                $Academicos_Cracha = $mostra->Academicos_Cracha;
                $Medicos_Cadastrados = $mostra->Medicos_Cadastrados;
                $Professores_Novo_Professor = $mostra->Professores_Novo_Professor;
                $Professores_Profs_Cadastrados = $mostra->Professores_Profs_Cadastrados;
                $Hospitais_Hospitas = $mostra->Hospitais_Hospitas;
                $Hospitais_Estagios = $mostra->Hospitais_Estagios;
                $Hospitais_Editais = $mostra->	Hospitais_Editais;
                $Cursos_Cursos = $mostra->Cursos_Cursos;
                $Cursos_Módulos = $mostra->Cursos_Módulos;
                $Cursos_Quiz = $mostra->Cursos_Quiz;
                $Cursos_Quiz_Pre_Teste = $mostra->Cursos_Quiz_Pre_Teste;
                $Cursos_Aula = $mostra->Cursos_Aula;
                $Aulas_Aulas = $mostra->Aulas_Aulas;
                $Aulas_Video_Aula = $mostra->Aulas_Video_Aula;
                $Aulas_PDF_Aula = $mostra->Aulas_PDF_Aula;
                $Area_Gestor_Permutas = $mostra->Area_Gestor_Permutas;
                $Area_Gestor_Notificacao = $mostra->Area_Gestor_Notificacao;
                $Area_Gestor_Comportamento = $mostra->Area_Gestor_Comportamento;
                $Area_Gestor_Desempenho = $mostra->Area_Gestor_Desempenho;
                $Area_Gestor_Frequencia = $mostra->Area_Gestor_Frequencia;
                $Usuario_Cadastro_Permissao = $mostra->Usuario_Cadastro_Permissao;  
            }
        }else{
            echo '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Opz!!!</strong> Você ainda tem texto adicionado.
            </div>'; exit;
        }
        }catch(PDOException $e){
            echo $e;
        }

        if(isset($_POST['atualizar'])){
            $nome = trim(strip_tags($_POST["nome"])); 
            $usuario  = trim(strip_tags($_POST["usuario"]));
            $senha = trim(strip_tags($_POST["senha"]));

                  
            $update ="UPDATE login SET nome=:nome, usuario=:usuario, senha=:senha WHERE id=:id"; 
                try{
                    $result = $conexao->prepare($update);
                    $result ->bindParam(':nome',$nome, PDO::PARAM_STR);
                    $result ->bindParam(':usuario',$usuario, PDO::PARAM_STR);
                    $result ->bindParam(':senha',$senha, PDO::PARAM_STR);                 
                    $result ->execute();

                    $contar = $result->rowCount();
    
                if($contar>0){
                    echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> Atualizado com Sucesso!</strong> 
                        </div>'; 
                    header("Refresh: 1, home.php?acao=horarios&id_est=$est_id_hora");
                }else{
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