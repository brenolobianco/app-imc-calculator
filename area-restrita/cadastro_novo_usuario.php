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
    <?php include 'controllers/setor/ControllerInsert.php'; ?>

    <!--aquin -->
    <div class="content-page">
        <div class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                    </div>
                    <div class="col-md-12">
                        <div class="card-box">
                            <h2 class="mt-0 mb-3 header-title">Cadastro de Novo Setor</h2>

                            <form class="form-horizontal" role="form" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">nome</label>
                                        <input type="text" class="form-control" name="nome">

                                        <label for="inputEmail4">E-mail (usuário)</label>
                                        <input type="email" class="form-control" name="usuario">

                                        <div style="width: 100%; height: 16px;"></div>
                                        <label for="inputEmail4">Senha</label>
                                        <input type="text" class="form-control" name="senha">
                                        <div style="width: 100%; height: 16px;"></div>



                                        <label for="inputEmail4">Qual área o Setor pode acessar?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="checkDashboard" type="checkbox" value="1" id="flexCheckDefault" >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Dashboard
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="checkConteudo" type="checkbox" value="1" id="flexCheckChecked" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Conteudo
                                            </label>
                                        </div>
                                      
                                        <div class="form-check">
                                            <input class="form-check-input" name="checkRanking" type="checkbox" value="1" id="flexCheckChecked" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Ranking
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" name="checkAcademico" type="checkbox" value="1" id="flexCheckChecked" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Acadêmicos
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" name="checkProfessor" type="checkbox" value="1" id="flexCheckChecked" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Professores
                                            </label>
                                        </div>

                                        

                                        

                                        <div class="form-check">
                                            <input class="form-check-input" name="checkHospital" type="checkbox" value="1" id="flexCheckChecked" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Hospitais
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" name="checkCursos" type="checkbox" value="1" id="flexCheckChecked" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Cursos/Treinamento
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" name="checkMedico" type="checkbox" value="1" id="flexCheckChecked" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Médicos
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" name="checkAula" type="checkbox" value="1" id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheck">
                                                Aulas
                                            </label>
                                        </div>
                                     
                                        <div class="form-check">
                                            <input class="form-check-input" name="checkGestor" type="checkbox" value="1" id="flexCheck" >
                                            <label class="form-check-label" for="flexCheck">
                                                Área do Gestor
                                            </label>
                                        </div>


                                    </div>


                                </div><br>


                                <div class="form-row">
                                    <div class="col-md-12">
                                        <input type="submit" name="cadastrar" value="cadastar" class="btn btn-success waves-effect waves-light">

                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
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
 
    

    $sql = "INSERT INTO permissao_setor (setor_id, dashboard, conteudo, ranking,  academico, medico,  professor, hospital, curso, aula, area_gestor, id_login)
                        VALUES (NULL,:checkDashboard, :checkConteudo, :checkRanking, :checkAcademico, :checkMedico, :checkProfessor, :checkHospital, :checkCursos,  :checkAula, :checkGestor, :id_login)";
           
          
            $sql = $conn->prepare($sql);
            $sql->bindParam(':checkDashboard', $dados['checkDashboard'], PDO::PARAM_INT);
            $sql->bindParam(':checkConteudo', $dados['checkConteudo'], PDO::PARAM_INT);
            $sql->bindParam(':checkRanking', $dados['checkRanking'], PDO::PARAM_INT);
            $sql->bindParam(':checkAcademico', $dados['checkAcademico'], PDO::PARAM_INT);
            $sql->bindParam(':checkProfessor', $dados['checkProfessor'], PDO::PARAM_INT);
            $sql->bindParam(':checkHospital', $dados['checkHospital'], PDO::PARAM_INT);
            $sql->bindParam(':checkCursos', $dados['checkCursos'], PDO::PARAM_INT);
            $sql->bindParam(':checkMedico', $dados['checkMedico'], PDO::PARAM_INT);
            $sql->bindParam(':checkAula', $dados['checkAula'], PDO::PARAM_INT);
            $sql->bindParam(':checkGestor', $dados['checkGestor'], PDO::PARAM_INT);   
            $sql->bindParam(':id_login', $id_login, PDO::PARAM_INT);      
            $sql->execute();
        
            
  
            header('Location: AreaGestorNotificacao.php');


<<<<<<< HEAD
   
=======

    try {
        # 36 - 1 = 35
        $sql = "INSERT INTO permissao_setor (
            setor_id,dashboard,conteudo,ranking,academico,medico,professor,hospital,curso,aula,area_gestor,id_login,
            Academicos_Cadastrados,Academicos_Matriculados,Academicos_Lista_Aprovados,Academicos_Cracha,Medicos_Cadastrados,
            Professores_Novo_Professor, `Professores_Prof's_Cadastrados`, Hospitais_Hospitas,Hospitais_Estagios,Hospitais_Editais, 
            Cursos_Cursos,Cursos_Módulos,Cursos_Quiz,Cursos_Quiz_Pre_Teste,Cursos_Aula,Aulas_Aulas,Aulas_Video_Aula,Aulas_PDF_Aula,
            Area_Gestor_Permutas,Area_Gestor_Notificacao,Area_Gestor_Comportamento,Area_Gestor_Desempenho,Area_Gestor_Frequencia,
            Usuario_Cadastro_Permissao)
            VALUES (NULL, :checkDashboard, :checkConteudo,:checkRanking,:checkAcademico, :checkMedico,:checkProfessor,:checkHospital,
            :checkCursos,:checkAula,:checkGestor, :id_login, :checkAcademicoCadastrado, :checkAcademicoMatriculado, :checkAcademicoListaAprovado,
            :checkAcademicoCracha, :checkMedicoCadastrado, :checkProfessorNovoProfessor, :checkProfessorProfsCadastrado, :checkHospitalHospital,
            :checkHospitalEstagio, :checkHospitalEdital, :checkCursoCurso, :checkCursoModulo, :checkCursoQuiz,:checkCursoQuizPreTeste,
            :checkCursoAula, :checkAulaAula, :checkVideoAula, :checkPdfAula, :checkAreaGestorPermuta,:checkAreaGestorNotificacao,
            :checkAreaGestorComportamento, :checkAreaGestorDesempenho, :checkAreaGestorFrequencia, :checkCadastroUsuario)";


        $sql = $conn->prepare($sql);

        //  Uncaught PDOException: SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens in
        //  Quantidade de parametros invalido, numbero de parametros não igual ao numero de tokens do insert
        
        // aqui tem 34
        print_r($dados);
        $sql->bindParam(':checkDashboard', $dados['checkDashboard'], PDO::PARAM_INT);
        $sql->bindParam(':checkConteudo', $dados['checkConteudo'], PDO::PARAM_INT);
        $sql->bindParam(':checkRanking', $dados['checkRanking'], PDO::PARAM_INT);
        $sql->bindParam(':checkAcademico', $dados['checkAcademico'], PDO::PARAM_INT);
        $sql->bindParam(':checkMedico', $dados['checkMedico'], PDO::PARAM_INT);
        $sql->bindParam(':checkProfessor', $dados['checkProfessor'], PDO::PARAM_INT);
        $sql->bindParam(':checkHospital', $dados['checkHospital'], PDO::PARAM_INT);    
        $sql->bindParam(':checkCursos', $dados['checkCursos'], PDO::PARAM_INT);
        $sql->bindParam(':checkAula', $dados['checkAula'], PDO::PARAM_INT);
        $sql->bindParam(':checkGestor', $dados['checkGestor'], PDO::PARAM_INT);
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
        print_r($sql->errorInfo());
        
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
        header('Location: AreaGestorNotificacao.php');
    } catch (Exception $e) {
        echo "error: " . $e->getMessage() . "\n";
        echo "line: " . $e->getLine() . "\n";
    };
    
>>>>>>> fffd184 (alteração)
} else {
    //Criar a variavel global para salvar a mensagem de erro
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
}
