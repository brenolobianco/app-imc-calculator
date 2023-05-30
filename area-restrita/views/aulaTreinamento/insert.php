

            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/aula/ControllerInsert.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Nova Aula</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre a Aula</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="nome_aula" class="form-control" placeholder="Nome da Aula" required>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="prof_id_aula" required>
                                                    <option value="">Selecionar o Professor</option>
                                                    <?php
                                                        $select = "SELECT * from professor";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_prof;?>"><?= $mostra->nome_prof;?></option>
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
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label" placeholder="Nome da Aula">Descrição da Aula</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="desc_aula" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Curso</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="est_id_aula">
                                                    <option value="">Selecionar o hospital e estágio</option>
                                                    <?php
                                                        $select = "SELECT * from estagio e JOIN hospital h ON h.id_hosp = e.hosp_id_est";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_est;?>">Estágio <?= $mostra->nome_est;?>Hospital <?= $mostra->nome_hosp;?></option>
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
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-control" name="curso_id_aula">
                                                    <option value="">Selecionar o curso</option>
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
                                                            <strong> Nada Cadastrado!!!</strong> 
                                                            </div>';
                                                    }
                                                    }catch(PDOException $e){
                                                        echo $e;
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-control" name="mod_id_aula">
                                                    <option value="1">Selecionar o módulo</option>
                                                    <?php
                                                        $select = "SELECT * from modulo";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_mod;?>"><?= $mostra->nome_mod;?></option>
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
                                                </select>
                                            </div>      
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Treinamento</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="est_id_aula_treinamento">
                                                    <option value="">Selecionar o hospital e estágio</option>
                                                    <?php
                                                        $select = "SELECT * from estagio e JOIN hospital h ON h.id_hosp = e.hosp_id_est";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_est;?>">Estágio <?= $mostra->nome_est;?>Hospital <?= $mostra->nome_hosp;?></option>
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
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <select class="form-control" name="mod_id_aula">
                                                    <option value="1">Selecionar o módulo</option>
                                                    <?php
                                                        $select = "SELECT * FROM modulo WHERE treinamento = 'sim' ";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_mod;?>"><?= $mostra->nome_mod;?></option>
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
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <select class="form-control" name="cronograma_semanas">
                                                    <option value="1">1 Semana</option>
                                                    <option value="2">2 Semana</option>
                                                    <option value="3">3 Semana</option>
                                                    <option value="4">4 Semana</option>
                                                    <option value="5">5 Semana</option>
                                                    <option value="6">6 Semana</option>
                                                    <option value="7">7 Semana</option>
                                                    <option value="8">8 Semana</option>
                                                    <option value="9">9 Semana</option>
                                                    <option value="10">10 Semana</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="taxa_acerto_quiz" placeholder="Taxa de acerto Quiz">
                                            </div>
                                        </div>


                                        <div class="form-group mb-0 justify-content-end row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="cadastrar" class="btn btn-success waves-effect waves-light">Salvar</button>
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
        <script>
            let input = document.querySelector('input[name="taxa_acerto_quiz"]');
            input.addEventListener('keyup', function(e){
                input.value = input.value.replace(/[^0-9]/g, '');

                e.target.style.outline = '';
                if(input.value >= 101) {
                    e.target.style.outline = '1px solid red';
                }
                
                if(input.value.length > 3) {
                    input.value = input.value.slice(0, 3);
                }
            });
        </script>


        
    </body>
</html>