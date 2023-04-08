
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
                                                <div class="col-md-12">
                                                    <h5>Área de interesse:</h5>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div> 
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
                            
                                <div class="card-box">
                                    <h4 class="header-title mb-3"><?= $nome_acad;?> é candidato</h4>

                                    <div class="inbox-widget">
                                    <?php
                                            $select = "SELECT * from matricula m 
                                            JOIN academico a ON a.id_acad = m.acad_id_mat
                                            JOIN estagio e ON e.id_est = m.est_id_mat 
                                            WHERE m.acad_id_mat = $id_acad";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();

                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <div class="inbox-item">
                                            <?php
                                            if($mostra->insc_mat != 'Restrito'){
                                                $icon = 'fa-thumbs-up';
                                                $cor = 'success';
                                            }else{
                                                $icon = 'fa-times';
                                                $cor = 'danger';
                                            }
                                            ?>
                                            <a href="home.php?acao=matricula">
                                                <div class="inbox-item-img"><a href="home.php?acao=matricula&id_mat=<?= $mostra->id_mat;?>" class="btn btn-icon waves-effect waves-light btn-<?= $cor;?>"> <i class="fa <?= $icon;?>"></i></a></div>
                                                <h5 class="inbox-item-author mt-0 mb-1"><?= $mostra->nome_est;?></h5>
                                                <p class="inbox-item-text"><?= $mostra->insc_mat;?></p>
                                                <p class="inbox-item-date">
                                                <?php
                                                if($mostra->nota_mat != null){
                                                    echo "NOTA $mostra->nota_mat";
                                                }else{
                                                    echo "EM ANDAMENTO";
                                                }
                                                ?>
                                                </p>
                                            </a>
                                        </div>
                                        <?php
                                        }
                                        }else{
                                            echo '<div class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                <strong> Nada Cadastrado!!!</strong> 
                                                </div>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                        ?>  
                                    </div>
                                </div>
                  
                            </div>
                             <div class="col-sm-4">
                            
                                <div class="card-box" style="background-color: #98FB98;">
                                    <h4 class="header-title mb-3">Lista de presença de <?= $nome_acad;?></h4>
                                    <hr>
                                        <div class="inbox-widget">
                                            <a href="home.php?acao=matricula">
                                                <h5 class="inbox-item-author mt-0 mb-1">Nome do Estágio</h5>
                                                <p style="color: #333;"><strong style="color: red;">12</strong> faltas</p>
                                            </a>
                                        </div>
                                        <hr>
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
        
    </body>
</html>