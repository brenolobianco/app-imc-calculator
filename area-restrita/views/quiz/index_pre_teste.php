<?php

function carregarQuiz($conexao)
{
<<<<<<< HEAD
    $select = "SELECT * from treinamento_pre_teste order by id_vid_aula asc";
=======
    $select = "SELECT * FROM treinamento_pre_teste quiz INNER JOIN aula a ON quiz.id_vid_aula = a.id_aula INNER JOIN estagio ON a.est_id_aula = estagio.id_est INNER JOIN hospital ON estagio.hosp_id_est = hospital.id_hosp ORDER BY quiz.id_vid_aula";
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
    $return_html = '';
    try {
        $result = $conexao->prepare($select);
        $result->execute();
        $contar = $result->rowCount();

        if ($contar > 0) {
            while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
                $return_html .=
                    "<tr>
<<<<<<< HEAD
                        <td>$mostra->pergunta</td>
                        <td>$mostra->pergunta</td>
                        <td>$mostra->pergunta</td>
                        <td>
                            <a href='home.php?acao=medico&id_med=$mostra->id_quiz' class='btn btn-icon waves-effect waves-light btn-primary'> <i class='fa fa-eye'></i> </a>
                            <a href='home.php?acao=medicos&delete=$mostra->pergunta' class='btn btn-icon waves-effect waves-light btn-danger'> &nbsp;<i class='fas fa-times'></i>&nbsp; </a>
=======
                        <td>$mostra->nome_aula</td>
                        <td>$mostra->nome_mod</td>
                        <td>$mostra->nome_hosp</td>
                        <td>$mostra->pergunta</td>
                        <td>
                            <a href='home.php?acao=quiz-pre-teste-editar&edit=$mostra->id_pre_teste' class='btn btn-icon waves-effect waves-light btn-primary'> <i class='fa fa-eye'></i> </a>
                            <a href='home.php?acao=quiz-pre-teste&delete=$mostra->id_pre_teste' class='btn btn-icon waves-effect waves-light btn-danger'> &nbsp;<i class='fas fa-times'></i>&nbsp; </a>
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
                        </td>
                    </tr>";
            }
        } else {
            echo ' <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Nada Cadastrado!!!</strong> 
            </div>';
        }
    } catch (PDOException $e) {
        echo $e;
    }

    return $return_html;
}
<<<<<<< HEAD
?>

<div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php include_once 'controllers/professor/ControllerDelete.php';?>
=======


if(isset($_GET['delete'])){
    $id_delete = $_GET['delete'];
    $seleciona= "SELECT * FROM treinamento_pre_teste WHERE id_pre_teste=:id_delete";
    try{
        $result = $conexao->prepare($seleciona);
        $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        if($contar>0){
        $loop = $result->fetchAll();
        foreach ($loop as $exibir){
            
        }

        $seleciona= "DELETE FROM treinamento_pre_teste WHERE id_pre_teste=:id_delete";
        try{
            $result = $conexao->prepare($seleciona);
            $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
            $result->execute();
            $contar = $result->rowCount();

        }catch(PDOException $erro){
            echo $erro;
        }

        }else{

        }
    }catch(PDOException $erro){
        echo $erro;
    }
}


?>  

<div class="content-page">
                <div class="content">
                    <?php 
                                if($contar>0){
                                    echo '<div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong> Excluido com Sucesso!</strong> 
                                    </div>';
                                }else{
                                    echo '<div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong> Erro ao Excluir!</strong> 
                                    </div>';
                                }
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
                            </div>
                            <div class="col-12">
                                <a href="home.php?acao=novo-quiz-pre-teste" class="btn btn-primary">Novo Quiz</a>
                            </div>
                            <br /><br />
                            <div class="col-12">
<<<<<<< HEAD
                                <?php include_once 'controllers/professor/ControllerDelete.php';?>
=======
                                <?php include_once 'controllers/quiz/ControllerQuizDelete.php';?>
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title">Quiz Cadastrados</h4>
                                    <hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Aula</th>
                                            <th>Modulo</th>
<<<<<<< HEAD
                                            <th>Descrição</th>
=======
                                            <th>Hospital</th>
                                            <th>Pergunta</th>
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
                                            <th>Detalhes</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?=carregarQuiz($conexao)?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div> 
       
                <?php include 'footer.php';?>
            </div>
        </div>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
        <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables/buttons.print.min.js"></script>
        <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables/dataTables.select.min.js"></script>
        <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/vfs_fonts.js"></script>

        <!-- Datatables init -->
        <script src="assets/js/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>