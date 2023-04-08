<?php

if(!isset($_GET['id_mat'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_mat = $_GET['id_mat'];
        
        $select = "SELECT * from matricula m JOIN academico a ON a.id_acad = m.acad_id_mat WHERE id_mat=:id_mat";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_mat', $id_mat, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_mat    = $mostra->id_mat;
            $insc_mat  = $mostra->insc_mat;
            $motivo_mat  = $mostra->motivo_mat;
            $data_des_mat = $mostra->data_des_mat;
   

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
      $insc_mat   = trim(strip_tags($_POST["insc_mat"]));
      $data_des_mat = trim(strip_tags($_POST["data_des_mat"]));
      $motivo_mat  = trim(strip_tags($_POST["motivo_mat"]));
              
      $update ="UPDATE matricula SET insc_mat=:insc_mat, data_des_mat=:data_des_mat,
          motivo_mat=:motivo_mat WHERE id_mat=:id_mat"; 

            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_mat',$id_mat, PDO::PARAM_INT);
                $result ->bindParam(':insc_mat',$insc_mat, PDO::PARAM_STR);
                $result ->bindParam(':data_des_mat',$data_des_mat, PDO::PARAM_STR);
                $result ->bindParam(':motivo_mat',$motivo_mat, PDO::PARAM_STR);
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<br><div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Seu Cancelamento foi efetuado com Sucesso!</strong> 
                    </div>'; 
            
            }else{
                echo '<br><div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> O Cancelamento não foi atualizado de forma correta!</strong> 
                    </div>';
            }
        }catch(PDOException $e){
            echo $e;
        }
                                    
    }    

?>