<?php include 'header.php'; 
error_reporting(E_ERROR);
//var_dump($_REQUEST);
if (isset($_GET['id']) && $_GET['op']) {
    $op = $_GET['op'];
    $id = $_GET['id'];

    $sql = "SELECT * FROM permissao_setor as p INNER JOIN login as l ON p.id_login = l.id WHERE p.id_login = $id";//:ID
    echo $sql;
    $preare = $conexao->prepare($sql);
    $preare->bindParam(":id", $id);
    $result = $preare->execute();
    $fetch = $preare->fetchAll();
    $count = count($fetch);
    if ($count > 0) { 
    	$show = $fetch[0];//var_dump($show);
        $idlogin=$show['id'];
        $nome = $show["nome"];
        $usuario = $show["usuario"];
        $senha = $show["senha"];

        // exemplo
        $loginid = ($show["id_permissao_setor"] > 0); //
        $dashboad = ($show["dashboard"] > 0) ? "true" : "false";
        $conteudo = ($show["conteudo"] > 0) ? "true" : "false";
        $ranking = ($show["ranking"] > 0) ? "true" : "false";
        $academico = ($show["academico"] > 0) ? "true" : "false";
        $medico = ($show["medico"] > 0) ? "true" : "false";
        $professor = ($show["professor"] > 0) ? "true" : "false";
        $hospital = ($show["hospital"] > 0) ? "true" : "false";
        $curso = ($show["curso"] > 0) ? "true" : "false";
        $aula = ($show["aula"] > 0) ? "true" : "false";
        $area_gestor = ($show["area_gestor"] > 0) ? "true" : "false";
        $Academicos_Cadastrados = $show["Academicos_Cadastrados"];//($show["Academicos_Cadastrados"] > 0) ? "true" : "false";
        $Academicos_Matriculados = $show["Academicos_Matriculados"];//($show["Academicos_Matriculados"] > 0) ? "true" : "false";
        $Academicos_Lista_Aprovados = $show["Academicos_Lista_Aprovados"];//($show["Academicos_Lista_Aprovados"] > 0) ? "true" : "false";
        $Academicos_Cracha = $show["Academicos_Cracha"];//($show["Academicos_Cracha"] > 0) ? "true" : "false";
        $Medicos_Cadastrados = ["Medicos_Cadastrados"];//($show["Medicos_Cadastrados"] > 0) ? "true" : "false";
        $Professores_Novo_Professor = $show["Professores_Novo_Professor"];//($show["Professores_Novo_Professor"] > 0) ? "true" : "false";
        $Professores_Profs_Cadastrados = $show["Professores_Prof's_Cadastrados"];//($show["Professores_Prof's_Cadastrados"] > 0) ? "true" : "false";
        $Hospitais_Hospitas = $show["Hospitais_Hospitas"];//($show["Hospitais_Hospitas"] > 0) ? "true" : "false";
        $Hospitais_Estagios = $show["Hospitais_Estagios"];//($show["Hospitais_Estagios"] > 0) ? "true" : "false";
        $Hospitais_Editais = $show["Hospitais_Editais"];//($show["Hospitais_Editais"] > 0) ? "true" : "false";
        $Cursos_Cursos = $show["Cursos_Cursos"];//($show["Cursos_Cursos"] > 0) ? "true" : "false";
        $Cursos_Módulos = $show["Cursos_Módulos"];//($show["Cursos_Módulos"] > 0) ? "true" : "false";
        $Cursos_Quiz = $show["Cursos_Quiz"];//($show["Cursos_Quiz"] > 0) ? "true" : "false";
        $Cursos_Quiz_Pre_Teste = $show["Cursos_Quiz_Pre_Teste"];//($show["Cursos_Quiz_Pre_Teste"] > 0) ? "true" : "false";
        $Cursos_Aula = $show["Cursos_Aula"];//($show["Cursos_Aula"] > 0) ? "true" : "false";
        $Aulas_Aulas = $show["Aulas_Aulas"];//($show["Aulas_Aulas"] > 0) ? "true" : "false";
        $Aulas_Video_Aula = $show["Aulas_Video_Aula"];//($show["Aulas_Video_Aula"] > 0) ? "true" : "false";
        $Aulas_PDF_Aula = $show["Aulas_PDF_Aula"];//($show["Aulas_PDF_Aula"] > 0) ? "true" : "false";
        $Area_Gestor_Permutas = $show["Area_Gestor_Permutas"];//($show["Area_Gestor_Permutas"] > 0) ? "true" : "false";
        $Area_Gestor_Notificacao = $show["Area_Gestor_Notificacao"];//($show["Area_Gestor_Notificacao"] > 0) ? "true" : "false";
        $Area_Gestor_Comportamento = $show["Area_Gestor_Comportamento"];//($show["Area_Gestor_Comportamento"] > 0) ? "true" : "false";
        $Area_Gestor_Desempenho = $show["Area_Gestor_Desempenho"];//($show["Area_Gestor_Desempenho"] > 0) ? "true" : "false";
        $Area_Gestor_Frequencia = $show["Area_Gestor_Frequencia"];//($show["Area_Gestor_Frequencia"] > 0) ? "true" : "false";
        $Usuario_Cadastro_Permissao = $show["Area_Gestor_Frequencia"];//($show["Area_Gestor_Frequencia"] > 0) ? "true" : "false";
        /*echo $nome;
        echo $usuario;
        echo $senha;
        echo $dashboad;
        echo $conteudo;*/
        // pergue aqui
        /**
         * permissao.area_gestor, login.nome
         * Caso esteja duplicada invente um apelido login.nome as login_nome 
         *  
         *
         * O resto eu acho que tu sabe, né ? ok
         * Blzz, vlw!!
         * 
         * 
         */
    }
}

?>

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
    <?php //include 'controllers/setor/ControllerInsert.php'; ?>

    <!--aquin -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                    </div>
                    <div class="col-md-12">
                    <?php include_once 'controllers/setor/Update.php';?>
                        <div class="card-box">
                            <h2 class="mt-0 mb-3 header-title">Edição de Usuário</h2>

                            <form class="form-horizontal" role="form" method="post">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="form-group col-3">
                                      
                                            <input type="hidden" class="form-control" name="idlogin" value="<?= $usuario?>">

                                            <label for="inputEmail4">nome</label>
                                            <input type="text" class="form-control" name="nome" value="<?= $nome; ?>">

                                            <label for="inputEmail4">E-mail (usuário)</label>
                                            <input type="email" class="form-control" name="usuario" value="<?= $usuario; ?>">

                                            <div style="width: 100%; height: 16px;"></div>
                                            <label for="inputEmail4">Senha</label>
                                            <input type="text" class="form-control" name="senha" value="<?= $senha; ?>">
                                            <div style="width: 100%; height: 16px;"></div>

                                            <input type="hidden" class="form-control" name="id_permissao_setor" value="<?= $loginid; ?>">
                                           
                                        </div>

                                        <div class="container">
                                            <div class="row">

                                                <div class="col-4">
                                                    <label for="inputEmail4">Qual área o Setor pode acessar em Acadêmicos?</label>
                                                   
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoCadastrado" type="checkbox" value="1" id="flexCheck" <?php echo($Academicos_Cadastrados?'checked="checked"':'');?>>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Cadastrados
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoMatriculado" type="checkbox" value="1" id="flexCheck" <?php echo($Academicos_Matriculados?'checked="checked"':'');?>>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Matriculados
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoListaAprovado" type="checkbox" value="1" id="flexCheck" <?php echo($Academicos_Lista_Aprovados?'checked="checked"':'');?>>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Lista de Aprovados
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkAcademicoCracha" type="checkbox" value="1" id="flexCheck" <?php echo($Academicos_Cracha?'checked="checked"':'');?>>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Crachá
                                                        </label>
                                                    </div>

                                                </div>



                                                <div class="col-4">
                                                    <label for="input">Qual área o Setor pode acessar em Médicos? </label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="checkMedicoCadastrado" type="checkbox" value="1" id="flexCheck" <?php echo($Medicos_Cadastrados?'checked="checked"':'');?>>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Cadastrados
                                                        </label>
                                                    </div>

                                                </div>

                                                <div class="col-4">
                                                    <label for="inputEmail4">Qual área o Setor pode acessar? Professores</label>
                                                    <div class="form-check">

                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkProfessorNovoProfessor" type="checkbox" value="1" id="flexCheck" <?php echo($Professores_Novo_Professor?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                Novo Professor
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkProfessorProfsCadastrado" type="checkbox" value="1" id="flexCheck" <?php echo($Professores_Profs_Cadastrados?'checked="checked"':'');?>>
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

                                                            <input class="form-check-input" name="checkHospitalHospital" type="checkbox" value="1" id="flexCheck" <?php echo($Hospitais_Hospitas?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Hospitas
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkHospitalEstagio" type="checkbox" value="1" id="flexCheck" <?php echo($Hospitais_Estagios?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Estagios
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkHospitalEdital" type="checkbox" value="1" id="flexCheck" <?php echo($Hospitais_Editais?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Editais
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">

                                                        <label for="inputEmail4">Qual área o Setor pode acessar? Cursos</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoCurso" type="checkbox" value="1" id="flexCheck" <?php echo($Cursos_Cursos?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Cursos
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoModulo" type="checkbox" value="1" id="flexCheck" <?php echo($Cursos_Módulos?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Modulos
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoQuiz" type="checkbox" value="1" id="flexCheck" <?php echo($Cursos_Quiz?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Quiz
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoQuizPreTeste" type="checkbox" value="1" id="flexCheck" <?php echo($Cursos_Quiz_Pre_Teste?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Quiz Pre Teste
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkCursoAula" type="checkbox" value="1" id="flexCheck" <?php echo($Cursos_aula?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Aulas
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <label for="inputEmail4">Qual área o Setor pode acessar em Aulas? </label>

                                                        <div class="form-check">

                                                            <input class="form-check-input" name="checkAulaAula" type="checkbox" value="1" id="flexCheck" <?php echo($Aulas_Aulas?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Aulas
                                                            </label>
                                                        </div>

                                                        <div class="form-check">

                                                            <input class="form-check-input" name="checkVideoAula" type="checkbox" value="1" id="flexCheck" <?php echo($Aulas_Video_Aula?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                Video Aula
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="checkPdfAula" type="checkbox" value="1" id="flexCheck" <?php echo($Aulas_PDF_Aula?'checked="checked"':'');?>>
                                                            <label class="form-check-label" for="flexCheck">
                                                                PDF Aula
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="col-4">
                                                        <label for="inputEmail4">Qual área o Setor pode acessar em Área do Gestor?</label>
                                                        <div class="form-check">
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorPermuta" type="checkbox" value="1" id="flexCheck" <?php echo($Area_Gestor_Permutas?'checked="checked"':'');?>>
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Permuta
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorNotificacao" type="checkbox" value="1" id="flexCheck" <?php echo($Area_Gestor_Notificacao?'checked="checked"':'');?>>
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Notificação
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorComportamento" type="checkbox" value="1" id="flexCheck" <?php echo($Area_Gestor_Comportamento?'checked="checked"':'');?>>
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Comportamento
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorDesempenho" type="checkbox" value="1" id="flexCheck" <?php echo($Area_Gestor_Desempenho?'checked="checked"':'');?>>
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Desempenho
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" name="checkAreaGestorFrequencia" type="checkbox" value="1" id="flexCheck" <?php echo($Area_Gestor_Frequencia?'checked="checked"':'');?>>
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
                                                                <input class="form-check-input" name="checkCadastroUsuario" type="checkbox" value="1" id="flexCheck" <?php echo($Usuario_Cadastro_Permissao?'checked="checked"':'');?>>
                                                                <label class="form-check-label" for="flexCheck">
                                                                    Cadastro de Usuario
                                                                </label>
                                                            </div>
                                                        </div>


                                                    </div>



                                                    <input name="Editar" type="submit" class="btn btn-success" value="Editar">
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


        <script>
            // exemplo blz
            /*
            document.querySelector("[name=id_permissao_setor]").checked = <?php echo $loginid ?>;
            document.querySelector("[name=checkDashboard]").checked = <?php echo $dashboad ?>;
            document.querySelector("[name=checkConteudo]").checked = <?php echo $conteudo ?>;
            document.querySelector("[name=checkRanking]").checked = <?php echo $ranking ?>;
            document.querySelector("[name=checkAcademico]").checked = <?php echo $academico ?>;
            document.querySelector("[name=checkMedico]").checked = <?php echo $medico ?>;
            document.querySelector("[name=checkProfessor]").checked = <?php echo $professor ?>;
            document.querySelector("[name=checkHospital]").checked = <?php echo $hospital ?>;
            document.querySelector("[name=checkCursos]").checked = <?php echo $curso ?>;
            document.querySelector("[name=checkAula]").checked = <?php echo $aula ?>;
            document.querySelector("[name=checkAreaGestor]").checked = <?php echo $area_gestor ?>;//faltando
            document.querySelector("[name=checkAcademicoCadastrado]").checked = <?php echo $Academicos_Cadastrados ?>;
            document.querySelector("[name=checkAcademicoMatriculado]").checked = <?php echo $Academicos_Matriculados ?>;
            document.querySelector("[name=checkAcademicoListaAprovado]").checked = <?php echo $Academicos_Lista_Aprovados ?>;
            document.querySelector("[name=checkAcademicoCracha]").checked = <?php echo $Academicos_Cracha ?>;
            document.querySelector("[name=checkMedicoCadastrado]").checked = <?php echo $Medicos_Cadastrados ?>;
            document.querySelector("[name=checkProfessorNovoProfessor]").checked = <?php echo $Professores_Novo_Professor ?>;
            document.querySelector("[name=checkProfessorProfsCadastrado]").checked = <?php echo $Professores_Profs_Cadastrados ?>;
            document.querySelector("[name=checkHospitalHospital]").checked = <?php echo $Hospitais_Hospitas ?>;
            document.querySelector("[name=checkHospitalEstagio]").checked = <?php echo $Hospitais_Estagios ?>;
            document.querySelector("[name=checkHospitalEdital]").checked = <?php echo $Hospitais_Editais ?>;
            document.querySelector("[name=checkCursoCurso]").checked = <?php echo $Cursos_Cursos ?>;
            document.querySelector("[name=checkCursoModulo]").checked = <?php echo $Cursos_Módulos ?>;
            document.querySelector("[name=checkCursoQuiz]").checked = <?php echo $Cursos_Quiz ?>;
            document.querySelector("[name=checkCursoQuizPreTeste]").checked = <?php echo $Cursos_Quiz_Pre_Teste ?>;
            document.querySelector("[name=checkCursoAula]").checked = <?php echo $Cursos_Aula ?>;
            document.querySelector("[name=checkAulaAula]").checked = <?php echo $Aulas_Aulas ?>;
            document.querySelector("[name=checkVideoAula]").checked = <?php echo $Aulas_Video_Aula ?>;
            document.querySelector("[name=checkPdfAula]").checked = <?php echo $Aulas_PDF_Aula ?>;
            document.querySelector("[name=checkAreaGestorPermuta]").checked = <?php echo $Area_Gestor_Permutas ?>;
            document.querySelector("[name=checkAreaGestorNotificacao]").checked = <?php echo $Area_Gestor_Notificacao ?>;
            document.querySelector("[name=checkAreaGestorComportamento]").checked = <?php echo $Area_Gestor_Comportamento ?>;
            document.querySelector("[name=checkAreaGestorDesempenho]").checked = <?php echo $Area_Gestor_Desempenho ?>;
            document.querySelector("[name=checkAreaGestorFrequencia]").checked = <?php echo $Area_Gestor_Frequencia ?>;
            document.querySelector("[name=checkCadastroUsuario]").checked = <?php echo $Usuario_Cadastro_Permissao ?>;*/
        </script>
</body>

</html>

