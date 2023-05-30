<?php

if(!isset($_GET['id_mat'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_mat = $_GET['id_mat'];
        
        $select = "SELECT * from matricula WHERE id_mat=:id_mat";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_mat', $id_mat, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_mat    = $mostra->id_mat;
            $termos_mat  = $mostra->termos_mat;
            $est_id_mat  = $mostra->est_id_mat;
         

        }
        }else{
          echo '<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>Opz!!!</strong> Nada adicionado.
          </div>'; exit;
        }
        }catch(PDOException $e){
          echo $e;
        }

    if(isset($_POST['atualizar'])){
        $termos_mat  = trim(strip_tags($_POST["termos_mat"]));
              
        $update ="UPDATE matricula SET termos_mat=:termos_mat WHERE id_mat=:id_mat"; 

            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_mat',$id_mat, PDO::PARAM_INT);
                $result ->bindParam(':termos_mat',$termos_mat, PDO::PARAM_STR);
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                    header("Refresh: 1, home.php?acao=escolher-a-semana&id_est=$est_id_mat");
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

?>