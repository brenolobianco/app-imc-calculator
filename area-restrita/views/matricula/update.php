
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/matricula/ControllerUpdate.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Estado do Curso do Acadêmico <?= $nome_acad;?> - WhatsApp <?= $whats_mat;?></h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                
                                            <label for="inputEmail4">Acesso ao curso</label>
                                                <select name="insc_mat" class="form-control">
                                                    <option value="<?= $insc_mat;?>"><?= $insc_mat;?></option>
                                                    <?php if($insc_mat == 'Restrito'){?>
                                                    <option value="Liberado">Liberado</option>
                                                    <?php }else{?>
                                                    <option value="Restrito">Restrito</option>
                                                    <?php }?>
                                                </select>
                                            </div> 
                                            <!--<div class="form-group col-md-2">
                                                <label for="inputEmail4">Restrição</label>
                                                <select name="horario_mat" class="form-control">
                                                    <option value="<?= $horario_mat;?>"><?php if($horario_mat =='n'){echo 'Liberado';}else{echo $horario_mat;} ;?></option>
                                                    <?php if($horario_mat == 'Desistente'){?>
                                                    <option value="n">Liberar</option>
                                                    <?php }else{?>
                                                    <option value="Desistente">Desistente</option>
                                                    <?php }?>
                                                </select>
                                            </div> -->
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Nota ( Max 9.9 ) Nota Indicação ( 999 )</label>
                                                <input type="text" name="nota_mat" class="form-control" value="<?= $nota_mat;?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Indicado por?</label>
                                                <input type="text" name="indicado_mat" class="form-control" value="<?= $indicado_mat;?>">
                                            </div>  
                                        </div>
                                        <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Classificado</label>
                                                <select name="class_mat" class="form-control">
                                                    <?php if($class_mat == null){
                                                        $at = 'não';
                                                    }else{
                                                        $at = $class_mat;
                                                    }?>
                                                    <option value="<?=$class_mat;?>"> Atual: <?=$at;?></option>
                                                    <option value="sim">Sim</option>
                                                    <option value="nao">Não</option>
                                                </select>
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Certificado</label>
                                                <select name="cert_mat" class="form-control">
                                                    <?php if($cert_mat == null){
                                                        $ae = 'não';
                                                    }else{
                                                        $a3 = $cert_mat;
                                                    }?>
                                                    <option value="<?=$cert_mat;?>">Atual <?=$ae;?></option>
                                                    <option value="sim">Sim</option>
                                                    <option value="nao">Não</option>
                                                    <option value="confirmado">Confirmado (Upload)</option>
                                                </select>
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Data que expira a MSN </label>
                                                <input type="date" name="exp_msn_mat" class="form-control" value="Data de expiração">
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">WhatsApp</label>
                                                <input type="text" name="whats_mat" class="form-control" value="<?= $whats_mat;?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label for="inputEmail4">Pagamento</label>
                                                <select name="pag_mat" class="form-control">
                                                    <option value="<?= $pag_mat;?>"><?= $pag_mat;?></option>
                                                    <option value="OK">OK</option>
                                                    <option value="Conferir">Conferir</option></option>
                                                </select>
                                            </div>
                                            </div> 
                                        </div>
                                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <label for="inputEmail4"> MSN ao acadêmico </label>
                                                <textarea type="text" name="msn_mat" class="form-control"><?= $msn_mat;?></textarea>
                                            </div>
                                        </div>
                                        <?php if($motivo_mat != null){?>
                                        <h5>Motivo da desistência </h5>
                                        <p><?= $motivo_mat;?></p>
                                        <?php } ?>
                                      
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" name="atualizar" class="btn btn-success waves-effect waves-light">Salvar</button>
                                                OBS: Somente com data de expiração, libera o UPLOAD dos documentos. 
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