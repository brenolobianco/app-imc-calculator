<?php

 if(!isset($_GET['id_pres'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_pres = $_GET['id_pres'];
    
        $select = "SELECT * from presenca WHERE id_pres=:id_pres";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_pres', $id_pres, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_pres   = $mostra->id_pres;
                $sit_pres  = $mostra->sit_pres;
                $data_pres = $mostra->data_pres;
                $mat_id_pres   = $mostra->mat_id_pres;
         
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
            $sit_pres    = trim(strip_tags($_POST["sit_pres"])); 
            $data_pres   = trim(strip_tags($_POST["data_pres"]));
                    
                  $update ="UPDATE presenca SET sit_pres=:sit_pres, data_pres=:data_pres WHERE id_pres=:id_pres"; 
                  try{
                      $result = $conexao->prepare($update);
                      $result ->bindParam(':id_pres',$id_pres, PDO::PARAM_INT);
                      $result ->bindParam(':sit_pres',$sit_pres, PDO::PARAM_STR);
                      $result ->bindParam(':data_pres',$data_pres, PDO::PARAM_STR);
                      $result ->execute();
                      $contar = $result->rowCount();
      
                  if($contar>0){
                      echo '<div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <strong> Atualizado com Sucesso!</strong> 
                          </div>'; 
                          header("Refresh: 1, home.php?acao=presencas&id_mat=$mat_id_pres");
                  }else{
                      echo '<div class="alert alert-warning">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <strong> Não foi atualizado de forma correta!</strong> 
                          </div>';
                  }
              }catch(PDOException $e){
                  echo $e;
              }
                                          
          }    
      
      ?>