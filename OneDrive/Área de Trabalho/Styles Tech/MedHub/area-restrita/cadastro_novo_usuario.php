<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   

    <!--aquin -->
    <div class="content-page">
        <div class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                    </div>
                    <div class="col-md-12">
                        <div class="card-box">
                            <h2 class="mt-0 mb-3 header-title">Cadastro de Novo Usuario</h2>

                            <form class="form-horizontal" role="form" method="post">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="form-group col-3">
                                            <label for="inputEmail4">nome</label>
                                            <input type="text" class="form-control" name="nome">

                                            <label for="inputEmail4">E-mail (usuário)</label>
                                            <input type="email" class="form-control" name="usuario">

                                            <div style="width: 100%; height: 16px;"></div>
                                            <label for="inputEmail4">Senha</label>
                                            <input type="text" class="form-control" name="senha">
                                            <div style="width: 100%; height: 16px;"></div>

                                        </div>

                                        <div class="container">
                                            <div class="row">

                                                <div class="col-4">
                                                    <label for="inputEmail4">Qual área o Setor pode acessar em Acadêmicos?</label>

                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoCadastrado" type="checkbox" value="1" id="flexCheck">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Cadastrados
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoMatriculado" type="checkbox" value="1" id="flexCheck">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Matriculados
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoListaAprovado" type="checkbox" value="1" id="flexCheck">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Lista de Aprovados
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoCracha" type="checkbox" value="1" id="flexCheck">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Crachá
                                                        </label>
                                                    </div>

                                                </div>



                                                <div class="col-4">
                                                    <label for="input">Qual área o Setor pode acessar em Médicos? </label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkMedicoCadastrado" type="checkbox" value="1" id="flexCheck">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Cadastrados
                                                        </label>
                                                    </div>

                                                </div>

                                                <div class="col-4">
                                                    <label for="inputEmail4">Qual área o Setor pode acessar? Professores</label>
                                                    <div class="form-check">

                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkProfessorNovoProfessor" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                Novo Professor
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkProfessorProfsCadastrado" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                Profs Cadastrados
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="inputEmail4">Qual área o Setor pode acessar? Hospitais</label>
                                                        <div class="form-check">

                                                            <input class="form-check-input" name="checkHospitalHospital" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Hospitas
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkHospitalEstagio" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Estagios
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkHospitalEdital" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Editais
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">

                                                        <label for="inputEmail4">Qual área o Setor pode acessar? Cursos</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoCurso" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Cursos
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoModulo" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Modulos
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoQuiz" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Quiz
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoQuizPreTeste" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Quiz Pre Teste
                                                            </label>
                                                        </div>
                                                        <div class="form-check">

                                                            <input class="form-check-input" name="checkCursoAula" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Aulas
                                                            </label>

                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <label for="inputEmail4">Qual área o Setor pode acessar em Aulas? </label>

                                                        <div class="form-check">

                                                            <input class="form-check-input" name="checkAulaAula" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Aulas
                                                            </label>
                                                        </div>

                                                        <div class="form-check">

                                                            <input class="form-check-input" name="checkVideoAula" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                Video Aula
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkPdfAula" type="checkbox" value="1" id="flexCheck">
                                                            <label class="form-check-label" for="flexCheck">
                                                                PDF Aula
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="col-4">
                                                        <label for="inputEmail4">Qual área o Setor pode acessar em Área do Gestor?</label>
                                                        <div class="form-check">
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorPermuta" type="checkbox" value="1" id="flexCheck">
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Permuta
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorNotificacao" type="checkbox" value="1" id="flexCheck">
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Notificação
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorComportamento" type="checkbox" value="1" id="flexCheck">
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Comportamento
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorDesempenho" type="checkbox" value="1" id="flexCheck">
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Desempenho
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorFrequencia" type="checkbox" value="1" id="flexCheck">
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Frequencia
                                                                </label>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="col-4">
                                                        <label for="inputEmail4">Qual área o Setor pode acessar em Usuário?</label>
                                                        <div class="form-check">
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkCadastroUsuario" type="checkbox" value="1" id="flexCheck">
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Cadastro de Usuario
                                                                </label>
                                                            </div>
                                                        </div>


                                                    </div>



                                                    <input name="cadastrar" type="submit" class="btn btn-success" value="Cadastrar">
                                                </div>
                                            </div><br>




                                        </div>

                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php include 'footer.php'; ?>

            </div>

        </div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/dropify/dropify.min.js"></script>
        <script src="assets/js/pages/form-fileupload.init.js"></script>

</body>

</html>

<?php

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD
include_once "models/conexao.php";

//Receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);

if (!empty($dados['cadastrar'])) {
    $query_usuario = "INSERT INTO login 
                (nome, usuario, senha) VALUES
                (:nome, :usuario, :senha)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $cad_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
    $cad_usuario->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
    $cad_usuario->execute();
    //Recuperar o ultimo id inserido
    $id_login = $conn->lastInsertId();



    try {
        # 36 - 1 = 35
        $sql = "INSERT INTO permissao_setor (
            setor_id,id_login,
            Academicos_Cadastrados,Academicos_Matriculados,Academicos_Lista_Aprovados,Academicos_Cracha,Medicos_Cadastrados,
            Professores_Novo_Professor, `Professores_Profs_Cadastrados`, Hospitais_Hospitas,Hospitais_Estagios,Hospitais_Editais, 
            Cursos_Cursos,Cursos_Módulos,Cursos_Quiz,Cursos_Quiz_Pre_Teste,Cursos_Aula,Aulas_Aulas,Aulas_Video_Aula,Aulas_PDF_Aula,
            Area_Gestor_Permutas,Area_Gestor_Notificacao,Area_Gestor_Comportamento,Area_Gestor_Desempenho,Area_Gestor_Frequencia,
            Usuario_Cadastro_Permissao)
            VALUES (NULL,:id_login, :checkAcademicoCadastrado, :checkAcademicoMatriculado, :checkAcademicoListaAprovado,
            :checkAcademicoCracha, :checkMedicoCadastrado, :checkProfessorNovoProfessor, :checkProfessorProfsCadastrado, :checkHospitalHospital,
            :checkHospitalEstagio, :checkHospitalEdital, :checkCursoCurso, :checkCursoModulo, :checkCursoQuiz,:checkCursoQuizPreTeste,
            :checkCursoAula, :checkAulaAula, :checkVideoAula, :checkPdfAula, :checkAreaGestorPermuta,:checkAreaGestorNotificacao,
            :checkAreaGestorComportamento, :checkAreaGestorDesempenho, :checkAreaGestorFrequencia, :checkCadastroUsuario)";


        $sql = $conn->prepare($sql);

        //  Uncaught PDOException: SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens in
        //  Quantidade de parametros invalido, numbero de parametros não igual ao numero de tokens do insert
        
        // aqui tem 34
        $sql->bindParam(':id_login', $id_login, PDO::PARAM_INT);
        $sql->bindParam(':checkAcademicoCadastrado', $dados['checkAcademicoCadastrado'], PDO::PARAM_INT);
        $sql->bindParam(':checkAcademicoMatriculado', $dados['checkAcademicoMatriculado'], PDO::PARAM_INT);
        $sql->bindParam(':checkAcademicoListaAprovado', $dados['checkAcademicoListaAprovado'], PDO::PARAM_INT);
        $sql->bindParam(':checkAcademicoCracha', $dados['checkAcademicoCracha'], PDO::PARAM_INT);
        $sql->bindParam(':checkMedicoCadastrado', $dados['checkMedicoCadastrado'], PDO::PARAM_INT);
        $sql->bindParam(':checkProfessorNovoProfessor', $dados['checkProfessorNovoProfessor'], PDO::PARAM_INT);
        $sql->bindParam(':checkProfessorProfsCadastrado', $dados['checkProfessorProfsCadastrado'], PDO::PARAM_INT);
        $sql->bindParam(':checkHospitalHospital', $dados['checkHospitalHospital'], PDO::PARAM_INT);
        $sql->bindParam(':checkHospitalEstagio', $dados['checkHospitalEstagio'], PDO::PARAM_INT);
        $sql->bindParam(':checkHospitalEdital', $dados['checkHospitalEdital'], PDO::PARAM_INT);
        $sql->bindParam(':checkCursoCurso', $dados['checkCursoCurso'], PDO::PARAM_INT);
        $sql->bindParam(':checkCursoModulo', $dados['checkCursoModulo'], PDO::PARAM_INT);
        $sql->bindParam(':checkCursoQuiz', $dados['checkCursoQuiz'], PDO::PARAM_INT);
        $sql->bindParam(':checkCursoQuizPreTeste', $dados['checkCursoQuizPreTeste'], PDO::PARAM_INT);
        $sql->bindParam(':checkCursoAula', $dados['checkCursoAula'], PDO::PARAM_INT);
        $sql->bindParam(':checkAulaAula', $dados['checkAulaAula'], PDO::PARAM_INT);
        $sql->bindParam(':checkVideoAula', $dados['checkVideoAula'], PDO::PARAM_INT);
        $sql->bindParam(':checkPdfAula', $dados['checkPdfAula'], PDO::PARAM_INT);
        $sql->bindParam(':checkAreaGestorPermuta', $dados['checkAreaGestorPermuta'], PDO::PARAM_INT);
        $sql->bindParam(':checkAreaGestorNotificacao', $dados['checkAreaGestorNotificacao'], PDO::PARAM_INT);
        $sql->bindParam(':checkAreaGestorComportamento', $dados['checkAreaGestorComportamento'], PDO::PARAM_INT);
        $sql->bindParam(':checkAreaGestorDesempenho', $dados['checkAreaGestorDesempenho'], PDO::PARAM_INT);
        $sql->bindParam(':checkAreaGestorFrequencia', $dados['checkAreaGestorFrequencia'], PDO::PARAM_INT);
        $sql->bindParam(':checkCadastroUsuario', $dados['checkCadastroUsuario'], PDO::PARAM_INT);

        $sql->execute();
        //print_r($sql->errorInfo());
        
        $obr = $soVariavelMesmo; // pra caso o usuario não marque o checkbox ocorra um erro
        
        // esse aqui é mais indicado
        // Pra caso ele não tenha passado marque como `false`, se o usuario não marcou é porque não quer.
        $nObg = isset($dados['paramentro']) ? $dados['paramentro']: 0; // caso o valor não seja obrigatorio

        // se eu fosse tu jogava no ChatGPT pra fazer esse serviço mais manual mesmo. Pra serviço manual ele é até bom.
        // Enfim.
        
        /**
         * A tela de area do gestor tu acha que tá pronta quando ?
         * vou cuidar dessa logica primeira e mais dificil.
         * Verdade!
         * 
         * Vlw, qualquer coisa estou diponível, blz ?valeu obrigado
         * Eu que agradeço, showw!
         */
        header('Location:home.php?acao=usuario');
    } catch (Exception $e) {
        echo "error: " . $e->getMessage() . "\n";
        echo "line: " . $e->getLine() . "\n";
    };
    
} else {
    //Criar a variavel global para salvar a mensagem de erro
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
}