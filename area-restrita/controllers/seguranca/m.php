<<<<<<< HEAD
<?php
 if(!isset($_GET['id_m'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_m = $_GET['id_m'];

        $select = "SELECT * from m WHERE id_m=:id_m";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_m', $id_m, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_m = $mostra->id_m;
                $m_m  = $mostra->m_m;

            }
        }else{
            echo '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Opz!!!</strong> Você ainda tem texto adicionado.
            </div>'; exit;
        }
        }catch(PDOException $e){
            echo $e;
        }

        if(isset($_POST['atualizar'])){
            $m_m = trim(strip_tags($_POST["m_m"])); 

                  
                $update ="UPDATE m SET m_m=:m_m WHERE id_m=:id_m"; 
                try{
                    $result = $conexao->prepare($update);
                    $result ->bindParam(':id_m',$id_m, PDO::PARAM_INT);
                    $result ->bindParam(':m_m',$m_m, PDO::PARAM_INT);
                    $result ->execute();
                    $contar = $result->rowCount();
    
                if($contar>0){
                    echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> Atualizado com Sucesso!</strong> 
                        </div>'; 
                    header("Refresh: 1, home.php?acao=estagios");
                }else{
                    echo '<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> O Conteúdo não foi atualizado de forma correta!</strong> 
                        </div>';
                }
            }catch(PDOException $e){
                echo $e;
            }
                                        
        }    
    
=======
<?php
 if(!isset($_GET['id_m'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_m = $_GET['id_m'];

        $select = "SELECT * from m WHERE id_m=:id_m";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_m', $id_m, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_m = $mostra->id_m;
                $m_m  = $mostra->m_m;

            }
        }else{
            echo '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Opz!!!</strong> Você ainda tem texto adicionado.
            </div>'; exit;
        }
        }catch(PDOException $e){
            echo $e;
        }

        if(isset($_POST['atualizar'])){
            $m_m = trim(strip_tags($_POST["m_m"])); 

                  
                $update ="UPDATE m SET m_m=:m_m WHERE id_m=:id_m"; 
                try{
                    $result = $conexao->prepare($update);
                    $result ->bindParam(':id_m',$id_m, PDO::PARAM_INT);
                    $result ->bindParam(':m_m',$m_m, PDO::PARAM_INT);
                    $result ->execute();
                    $contar = $result->rowCount();
    
                if($contar>0){
                    echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> Atualizado com Sucesso!</strong> 
                        </div>'; 
                    header("Refresh: 1, home.php?acao=estagios");
                }else{
                    echo '<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> O Conteúdo não foi atualizado de forma correta!</strong> 
                        </div>';
                }
            }catch(PDOException $e){
                echo $e;
            }
                                        
        }    
    
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
    ?>