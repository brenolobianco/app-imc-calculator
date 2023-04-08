<?php

function carregarQuiz($conexao)
{
    $select = "SELECT * from quiz_treinamento order by id_vid_aula asc";
    $return_html = '';
    try {
        $result = $conexao->prepare($select);
        $result->execute();
        $contar = $result->rowCount();

        if ($contar > 0) {
            while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
                $return_html .=
                    "<tr>
                        <td>$mostra->pergunta</td>
                        <td>$mostra->pergunta</td>
                        <td>$mostra->pergunta</td>
                        <td>
                            <a href='home.php?acao=medico&id_med=$mostra->id_quiz' class='btn btn-icon waves-effect waves-light btn-primary'> <i class='fa fa-eye'></i> </a>
                            <a href='home.php?acao=medicos&delete=$mostra->pergunta' class='btn btn-icon waves-effect waves-light btn-danger'> &nbsp;<i class='fas fa-times'></i>&nbsp; </a>
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
?>

<div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
<<<<<<< HEAD
                                <?php include_once 'controllers/professor/ControllerDelete.php';?>
=======
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
                            </div>
                            <div class="col-12">
                                <a href="home.php?acao=novo-quiz" class="btn btn-primary">Novo Quiz</a>
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