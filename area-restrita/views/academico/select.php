
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
                                                    WhatsApp: <strong><?= $whats_acad;?></strong><br />
                                                    Email: <strong><?= $email_acad;?></strong><br />
                                                    CPF: <strong><?= $cpf_acad;?></strong><br />
                                                    Data: <strong><?= $data_cad_acad;?></strong><br />
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="m-0"><br /></h4>
                                                    <p class="text-muted"><br /></p>
                                                    <p class="font-16">
                                                    Universidade: <strong><?= $univ_imp_acad;?></strong><br />
                                                    Período: <strong><?= $periodo_acad;?></strong><br>
                                                    Como nos conheceu: <strong><?= $conheceu_imp_acad;?></strong><br />
                                                    Como nos conheceu 2: <strong><?= $outro_conhe_acad;?></strong><br />
                                                    Interesse: <strong><?= $interesse_acad;?></strong><br />
                                                    Interesse 2: <strong><?= $outro_inter_acad;?></strong>
                                                    </p>
                                                </div>
                                               
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div> 
                            <!--<div class="col-sm-12">
                                <div class="bg-picture card-box">
                                    <div class="user-desc">
                                        <center>
                                            <a href="home.php?acao=matricula&id_mat=<?= $mostra->id_mat;?>" class="btn btn-primary" style="width: 280px;">Inserir Nota</a>
                                            <a href="home.php?acao=matricula&id_mat=<?= $mostra->id_mat;?>" class="btn btn-primary" style="width: 280px;">Classificar Academico</a>
                                            <a href="home.php?acao=matricula&id_mat=<?= $mostra->id_mat;?>" class="btn btn-primary" style="width: 280px;">Gerar Certificado</a>
                                        </center>
                                    </div>
                        
                                </div>
                            </div>-->
                            <div class="col-sm-4">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3">Documentos Atualizados</h4>
                                    <ul class="list-group mb-0 user-list">

                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="<?= $link_cv_lates_acad;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Link Curriculo Lates</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                            $select = "SELECT * from acad_cv WHERE acad_id_cv = $id_acad ORDER BY id_cv DESC LIMIT 1";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();
                                        
                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="../up-cv/<?= $mostra->id_cv;?>/<?= $mostra->arq_cv;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Vizualizar Curriculo Lates</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        }else{
                                            echo '<p style="margin-left:20px;">Esperando curriculo Lates</p>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    
    
                                        ?>
                                        <?php
                                            $select = "SELECT * from acad_ma WHERE acad_id_ma = $id_acad ORDER BY id_ma DESC LIMIT 1";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();
                                        
                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="../up-ma/<?= $mostra->id_ma;?>/<?= $mostra->arq_ma;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Vizualizar Comprovante de Matrícula</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        }else{
                                            echo '<p style="margin-left:20px;">Esperando comprovante de Matricula</p>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    
    
                                        ?>
                                        <?php
                                            $select = "SELECT * from acad_rg WHERE acad_id_rg = $id_acad ORDER BY id_rg DESC LIMIT 1";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();
                                        
                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="../up-rg/<?= $mostra->id_rg;?>/<?= $mostra->arq_rg;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Vizualizar RG</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        }else{
                                            echo '<p style="margin-left:20px;">Esperando RG</p>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    
    
                                        ?>
                                        <?php
                                            $select = "SELECT * from acad_ap WHERE acad_id_ap = $id_acad ORDER BY id_ap DESC LIMIT 1";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();
                                        
                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="../up-ap/<?= $mostra->id_ap;?>/<?= $mostra->arq_ap;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Vizualizar Plano de Aula</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        }else{
                                            echo '<p style="margin-left:20px;">Esperando Plano de Aula</p>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    
    
                                        ?>
                                        <?php
                                            $select = "SELECT * from acad_cr WHERE acad_id_cr = $id_acad ORDER BY id_cr DESC LIMIT 1";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();
                                        
                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="../up-cr/<?= $mostra->id_cr;?>/<?= $mostra->arq_cr;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Vizualizar Comprovante de Residência</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        }else{
                                            echo '<p style="margin-left:20px;">Esperando comprovante de residência</p>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    
                                        ?>
                                        <?php
                                            $select = "SELECT * from acad_va WHERE acad_id_va = $id_acad ORDER BY id_va DESC LIMIT 1";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();
                                        
                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="../up-va/<?= $mostra->id_va;?>/<?= $mostra->arq_va;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Vizualizar Comprovante de Vacinação</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        }else{
                                            echo '<p style="margin-left:20px;">Esperando comprovante de vacinação</p>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    
                                        ?>
                                        <?php
                                            $select = "SELECT * from acad_ch WHERE acad_id_ch = $id_acad ORDER BY id_ch DESC LIMIT 1";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();
                                        
                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                        ?>
                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                         
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="../up-ch/<?= $mostra->id_ch;?>/<?= $mostra->arq_ch;?>" target="_blank" class="btn btn-primary" style="width: 280px;">Vizualizar Crachá</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        }else{
                                            echo '<p style="margin-left:20px;">Esperando crachá</p>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    
                                        ?>
                             
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
                                        <div class="inbox-widget">
                                            <a href="home.php?acao=presencas&id_mat=<?= $mostra->id_mat;?>">
                                                <h5 class="inbox-item-author mt-0 mb-1"><?= $mostra->nome_est;?></h5>
                                                <!--<p style="color: #333;"><strong style="color: red;">12</strong> faltas</p>-->
                                            </a>
                                        </div>
                                        <hr>
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
                        </div>
                    </div> 
                <?php include 'footer.php';?>
            </div>
        </div>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>