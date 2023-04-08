<<<<<<< HEAD
<?php include 'controllers/matricula/ControllerSelect.php';?>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php // include_once 'controllers/presenca/ControllerDelete.php'; ?>
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <a href="home.php?acao=nova-presenca&id_mat=<?=$id_mat;?>" class="btn btn-primary">Nova Presença</a>
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title"> Lista de Presença do <?= $nome_est;?> </h4>
                                    <hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Data</th>
                                            <th>Pesença</th>
                                            <th>Detalhes</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php include_once 'controllers/presenca/ControllerIndex.php';?>
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
        <script src="assets/js/pages/datatables.init.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
=======
<?php include 'controllers/matricula/ControllerSelect.php';?>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php // include_once 'controllers/presenca/ControllerDelete.php'; ?>
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <a href="home.php?acao=nova-presenca&id_mat=<?=$id_mat;?>" class="btn btn-primary">Nova Presença</a>
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title"> Lista de Presença do <?= $nome_est;?> </h4>
                                    <hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Data</th>
                                            <th>Pesença</th>
                                            <th>Detalhes</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php include_once 'controllers/presenca/ControllerIndex.php';?>
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
        <script src="assets/js/pages/datatables.init.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
</html>