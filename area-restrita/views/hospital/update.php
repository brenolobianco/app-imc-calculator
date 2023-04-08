<<<<<<< HEAD
<div class="content-page">
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <?php include_once 'controllers/hospital/ControllerUpdate.php'; ?>
                </div>
                <div class="col-md-12">
                    <div class="card-box">
                        <h2 class="mt-0 mb-3 header-title">Editar Hospital</h2>

                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Hospital</label>
                                    <input type="text" class="form-control" name="nome_hosp" value="<?= $nome_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">Telefone</label>
                                    <input type="text" class="form-control" name="fone_hosp" value="<?= $fone_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">CEP</label>
                                    <input type="text" class="form-control" name="cep_hosp" value="<?= $cep_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">Bairro</label>
                                    <input type="text" class="form-control" name="bairro_hosp" value="<?= $bairro_hosp; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">Responsável</label>
                                    <input type="text" class="form-control" name="resp_hosp" value="<?= $resp_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">Senha</label>
                                    <input type="text" class="form-control" name="senha_hosp" value="<?= $senha_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">UF</label>
                                    <input type="text" class="form-control" name="uf_hosp" value="<?= $uf_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">Número</label>
                                    <input type="text" class="form-control" name="num_hosp" value="<?= $num_hosp; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Email</label>
                                    <input type="text" class="form-control" name="email_hosp" value="<?= $email_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">Telefone</label>
                                    <input type="text" class="form-control" name="fone_hosp" value="<?= $fone_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">Cidade</label>
                                    <input type="text" class="form-control" name="cidade_hosp" value="<?= $cidade_hosp; ?>">
                                    <div style="width: 100%; height: 16px;"></div>
                                    <label for="inputEmail4">Rua</label>
                                    <input type="text" class="form-control" name="rua_hosp" value="<?= $rua_hosp; ?>">


                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Imagem</label>
                                    <img src="../upload/<?= $novoNome; ?>" width="100%"><br />
                                    <input type="file" class="form-control" name="img[]">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <button id="submit" name="atualizar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                                    <a href="cadastro_novo_usuario.php">  
                                  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 
                                            0v3h-3a.5.5 0 0 0 0 
                                             1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg>
                                        </a>
                               
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


=======

            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/hospital/ControllerUpdate.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Hospital</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">      
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Hospital</label>
                                                <input type="text" class="form-control" name="nome_hosp" value="<?= $nome_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">Telefone</label>
                                                <input type="text" class="form-control" name="fone_hosp" value="<?= $fone_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">CEP</label>
                                                <input type="text" class="form-control" name="cep_hosp" value="<?= $cep_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">Bairro</label>
                                                <input type="text" class="form-control" name="bairro_hosp" value="<?= $bairro_hosp;?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Responsável</label>
                                                <input type="text" class="form-control" name="resp_hosp" value="<?= $resp_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">Senha</label>
                                                <input type="text" class="form-control" name="senha_hosp" value="<?= $senha_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">UF</label>
                                                <input type="text" class="form-control" name="uf_hosp" value="<?= $uf_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">Número</label>
                                                <input type="text" class="form-control" name="num_hosp" value="<?= $num_hosp;?>">    
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Email</label>
                                                <input type="text" class="form-control" name="email_hosp" value="<?= $email_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">Telefone</label>
                                                <input type="text" class="form-control" name="fone_hosp" value="<?= $fone_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">Cidade</label>
                                                <input type="text" class="form-control" name="cidade_hosp" value="<?= $cidade_hosp;?>">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <label for="inputEmail4">Rua</label>
                                                <input type="text" class="form-control" name="rua_hosp" value="<?= $rua_hosp;?>">
                                                
                                   
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Imagem</label>
                                                <img src="../upload/<?= $novoNome;?>" width="100%"><br /> 
                                                <input type="file" class="form-control" name="img[]">
                                            </div>
                                        </div>
                                       
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button id="submit" name="atualizar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
