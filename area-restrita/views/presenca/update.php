
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/presenca/ControllerUpdate.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar presença</h2>
                                     <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Presença</label>
                                                <div class="col-sm-5">
                                         
                                                    <input type="date" class="form-control" name="data_pres" value="<?= $data_pres?>">
                                                </div>
                                                <div class="col-sm-5">
                                                    <select type="text" class="form-control" name="sit_pres" required> 
                                                    <option value="<?= $sit_pres?>">Atual é <?= $sit_pres?></option>
                                                    <option>Presente</option>
                                                    <option>Ausente</option>
                                                    </select>
                                                </div>  
                                            </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button name="atualizar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                                            </div>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>   
                    </div> 
                </div> 

                <?php include 'footer.php';?>

            </div>

        </div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/dropify/dropify.min.js"></script>
        <script src="assets/js/pages/form-fileupload.init.js"></script>
        
    </body>
</html>