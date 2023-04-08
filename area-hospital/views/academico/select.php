
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <?php include_once 'controllers/academico/ControllerSelect.php';?>
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-picture card-box">
                                    <?php 
                                    if($img_acad != null){
                                        $img_acad2 = "../upload/$img_acad";
                                    }else{
                                        $img_acad2 = "assets/images/users/user.png";
                                    }
                                    ?>
                                    <div class="profile-info-name">
                                        <img src="<?= $img_acad2;?>" class="rounded-circle avatar-xl img-thumbnail float-left mr-3" alt="profile-image">

                                        <div class="profile-info-detail overflow-hidden">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4 class="m-0"><?= $nome_acad;?></h4>
                                                    <p class="text-muted"><i>Acadêmico</i></p>
                                                    <p class="font-16">
                                                    Email: <strong><?= $email_acad;?></strong><br />
                                                    WhatsApp: <strong><?= $whats_acad;?></strong><br />
                                                    CPF: <strong><?= $cpf_acad;?></strong><br />
                                                    RG: <strong><?= $rg_acad;?></strong>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="m-0"><br /></h4>
                                                    <p class="text-muted"><br /></p>
                                                    <p class="font-16">
                                                    CEP: <strong><?= $cep_acad;?></strong><br />
                                                    UF: <strong><?= $uf_acad;?></strong><br />
                                                    Cidade: <strong><?= $cidade_acad;?></strong><br />
                                                    Bairro: <strong><?= $bairro_acad;?></strong><br />
                                                    Rua: <strong><?= $rua_acad;?></strong>
                                                    </p>
                                                </div>
                                                <hr />
                                           
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div> 
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3">Curriculo Lates</h4>
                                    <ul class="list-group mb-0 user-list">

                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="<?= $link_cv_lates_acad;?>" target="_blank" class="btn btn-primary">Vizualizar Curriculo Lates</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>  
                         
                        </div>
                    </div> 
                <?php include 'footer.php';?>
            </div>
        </div>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>