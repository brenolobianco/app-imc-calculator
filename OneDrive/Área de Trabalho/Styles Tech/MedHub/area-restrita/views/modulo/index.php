
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php include_once 'controllers/modulo/ControllerDelete.php';?>
                            </div>
                            <br /><br />
                            <div class="col-12">
                            <?php 
                                    if(isset($_GET['treinamento'])){
                                    ?>
                                        <a href="home.php?acao=novo-modulo&treinamento=true" class="btn btn-primary">Novo Módulo de Treinamento</a>
                                    <?php } else {?>
                                        <a href="home.php?acao=novo-modulo" class="btn btn-primary">Novo Módulo</a>
                                    <?php }?>
                            </div>
                            <br /><br />
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title">Módulos Cadastradas</h4>
                                    <hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Módulo</th>
                                            <th>Descrição</th>
                                            <th>Detalhes</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php if(isset($_GET['treinamento'])) include_once 'controllers/modulo/ControllerTreinamento.php';?>
                                        <?php if(!isset($_GET['treinamento'])) include_once 'controllers/modulo/ControllerIndex.php';?>
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