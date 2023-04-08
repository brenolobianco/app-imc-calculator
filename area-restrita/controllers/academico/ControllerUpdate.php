<<<<<<< HEAD
<?php

 if(!isset($_GET['id_acad'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_acad = $_GET['id_acad'];
    
        $select = "SELECT * from academico WHERE id_acad=:id_acad";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_acad', $id_acad, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_acad    = $mostra->id_acad;
                $nome_acad  = $mostra->nome_acad;
                $email_acad = $mostra->email_acad;
                $senha_acad = $mostra->senha_acad;
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
            $nome_acad   = trim(strip_tags($_POST["nome_acad"]));
            $email_acad  = trim(strip_tags($_POST["email_acad"]));
            $senha_acad  = trim(strip_tags($_POST["senha_acad"]));
                    
                  $update ="UPDATE academico SET nome_acad=:nome_acad, email_acad=:email_acad, senha_acad=:senha_acad WHERE id_acad=:id_acad"; 
                  try{
                      $result = $conexao->prepare($update);
                      $result ->bindParam(':id_acad',$id_acad, PDO::PARAM_INT);
                      $result ->bindParam(':nome_acad',$nome_acad, PDO::PARAM_STR);
                      $result ->bindParam(':email_acad',$email_acad, PDO::PARAM_STR);
                      $result ->bindParam(':senha_acad',$senha_acad, PDO::PARAM_STR);
                      $result ->execute();
                      $contar = $result->rowCount();
      
                  if($contar>0){
                      echo '<div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <strong> Atualizado com Sucesso!</strong> 
                          </div>'; 
                          header("Refresh: 1, home.php?acao=academicos");
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
      
=======
<?php

 if(!isset($_GET['id_acad'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_acad = $_GET['id_acad'];
    
        $select = "SELECT * from academico WHERE id_acad=:id_acad";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_acad', $id_acad, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_acad    = $mostra->id_acad;
                $nome_acad  = $mostra->nome_acad;
                $email_acad = $mostra->email_acad;
                $senha_acad = $mostra->senha_acad;
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
            $nome_acad   = trim(strip_tags($_POST["nome_acad"]));
            $email_acad  = trim(strip_tags($_POST["email_acad"]));
            $senha_acad  = trim(strip_tags($_POST["senha_acad"]));
                    
                  $update ="UPDATE academico SET nome_acad=:nome_acad, email_acad=:email_acad, senha_acad=:senha_acad WHERE id_acad=:id_acad"; 
                  try{
                      $result = $conexao->prepare($update);
                      $result ->bindParam(':id_acad',$id_acad, PDO::PARAM_INT);
                      $result ->bindParam(':nome_acad',$nome_acad, PDO::PARAM_STR);
                      $result ->bindParam(':email_acad',$email_acad, PDO::PARAM_STR);
                      $result ->bindParam(':senha_acad',$senha_acad, PDO::PARAM_STR);
                      $result ->execute();
                      $contar = $result->rowCount();
      
                  if($contar>0){
                      echo '<div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <strong> Atualizado com Sucesso!</strong> 
                          </div>'; 
                          header("Refresh: 1, home.php?acao=academicos");
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
      
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
      ?>