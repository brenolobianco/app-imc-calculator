<?php include_once 'controllers/treinamento/ControllerBlock.php';?>
<div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php include_once 'controllers/aula/ControllerDelete.php';?>
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <a href="home.php?acao=nova-avaliacao" class="btn btn-primary">Nova avaliacao</a>
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title">Avaliacoes Cadastradas</h4>
                                    <hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Nome avaliacao</th>
                                            <th>Data avaliacao</th>
                                            <th>Link Fiscalizze</th>
                                            <th>Detalhes</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $sql = "SELECT * FROM avaliacoes";
                                        $result = $conexao->prepare($sql);
                                        $result->execute();
                                        if ($result->rowCount() > 0) {
                                            foreach($result as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['nome_avaliacao']; ?></td>
                                                    <td><?php echo $row['data_avaliacao']; ?></td>
                                                    <td><?php echo $row['link_fiscallize']; ?></td>
                                                    <td>
                                                        <a href="home.php?acao=detalhes-avaliacao&id=<?php echo $row['id_avaliacao']; ?>" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></a>
                                                        <a href="home.php?acao=editar-avaliacao&id=<?php echo $row['id_avaliacao']; ?>" class="btn btn-icon waves-effect waves-light btn-warning"><i class="fa fa-edit"></i></a>
                                                        <a href="home.php?acao=excluir-avaliacao&id=<?php echo $row['id_avaliacao']; ?>" class="btn btn-icon waves-effect waves-light btn-danger"><i class="fa fa-trash"></i></a>
                                                        <?php if ($row['liberado'] == 'liberado') { ?>
                                                            <a href="home.php?acao=bloquear&id=<?php echo $row['id_avaliacao']; ?>" class="btn btn-danger"><i class="fa fa-lock"></i></a>
                                                        <?php } ?>
                                                        <?php if ($row['liberado'] == 'bloqueado') { ?>
                                                            <a href="home.php?acao=liberar&id=<?php echo $row['id_avaliacao']; ?>" class="btn btn-success"><i class="fa fa-unlock"></i></a>
                                                        <?php } ?>
                                                        


                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>


                                    </table>
                                </div>
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