<<<<<<< HEAD

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/matricula/ControllerInsert-whats.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Matricular Acadêmico</h2>

                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">WhatsApp</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="whats_mat" placeholder="WhatsApp">
                                                </div> 
                                            </div> 
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Informações da indição</label>
                                                <div class="col-sm-5">
                                                    <input type="hidden" name="data_cad_mat" value="<?= date("d/m/Y h:i");?>">
                                                    <input type="hidden" name="insc_mat" value="Liberado">
                                                    <select class="form-control" name="acad_id_mat" required>
                                                        <option>Acadêmico ???</option>
                                                        <?php
                                                            $select = "SELECT * from academico ORDER BY nome_acad";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_acad;?>"><?= $mostra->nome_acad;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>

                                                <div class="col-sm-5">
                                                    <select class="form-control" name="est_id_mat" required>
                                                        <option>Estágio ???</option>
                                                        <?php
                                                            $select = "SELECT * from estagio";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_est;?>"><?= $mostra->nome_est;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Informações da indição</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="hosp_id_mat" required>
                                                        <option>Hospital ???</option>
                                                        <?php
                                                            $select = "SELECT * from hospital";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_hosp;?>"><?= $mostra->nome_hosp;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>  
                                                </div>  
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="curso_id_mat" required>
                                                        <option>Curso ???</option>
                                                        <?php
                                                            $select = "SELECT * from curso";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_curso;?>"><?= $mostra->nome_curso;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group mb-0 justify-content-end row">
                                                <div class="col-sm-10">
                                                    <button name="cadastrar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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
=======

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/matricula/ControllerInsert-whats.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Matricular Acadêmico</h2>

                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">WhatsApp</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="whats_mat" placeholder="WhatsApp">
                                                </div> 
                                            </div> 
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Informações da indição</label>
                                                <div class="col-sm-5">
                                                    <input type="hidden" name="data_cad_mat" value="<?= date("d/m/Y h:i");?>">
                                                    <input type="hidden" name="insc_mat" value="Liberado">
                                                    <select class="form-control" name="acad_id_mat" required>
                                                        <option>Acadêmico ???</option>
                                                        <?php
                                                            $select = "SELECT * from academico ORDER BY nome_acad";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_acad;?>"><?= $mostra->nome_acad;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>

                                                <div class="col-sm-5">
                                                    <select class="form-control" name="est_id_mat" required>
                                                        <option>Estágio ???</option>
                                                        <?php
                                                            $select = "SELECT * from estagio";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_est;?>"><?= $mostra->nome_est;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Informações da indição</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="hosp_id_mat" required>
                                                        <option>Hospital ???</option>
                                                        <?php
                                                            $select = "SELECT * from hospital";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_hosp;?>"><?= $mostra->nome_hosp;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>  
                                                </div>  
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="curso_id_mat" required>
                                                        <option>Curso ???</option>
                                                        <?php
                                                            $select = "SELECT * from curso";  
                                                            try{
                                                            $result = $conexao->prepare($select);
                                                            $result ->execute();
                                                            $contar = $result->rowCount();
                            
                                                            if($contar>0){
                                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                                
                                                       
                                                        ?>
                                                        <option value="<?= $mostra->id_curso;?>"><?= $mostra->nome_curso;?></option>
                                                        <?php
                                                        
                                                        }
                                                        }else{
                                                            echo '<div class="alert alert-info">
                                                                <button type="button" class="close" data-dismiss="warning">x</button>
                                                                <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                                                </div>';
                                                        }
                                                        }catch(PDOException $e){
                                                            echo $e;
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group mb-0 justify-content-end row">
                                                <div class="col-sm-10">
                                                    <button name="cadastrar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
</html>