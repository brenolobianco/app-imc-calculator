<?php

if(!isset($_GET['id_hosp'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_hosp = $_GET['id_hosp'];
   
        $select = "SELECT * from hospital WHERE id_hosp=:id_hosp";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_hosp', $id_hosp, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_hosp    = $mostra->id_hosp;
            $email_hosp = $mostra->email_hosp;
            $senha_hosp = $mostra->senha_hosp;

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
        $email_hosp  = trim(strip_tags($_POST["email_hosp"]));
        $senha_hosp  = trim(strip_tags($_POST["senha_hosp"]));
              
            $update ="UPDATE hospital SET email_hosp=:email_hosp, senha_hosp=:senha_hosp WHERE id_hosp=:id_hosp"; 
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_hosp',$id_hosp, PDO::PARAM_INT);
                $result ->bindParam(':email_hosp',$email_hosp, PDO::PARAM_STR);
                $result ->bindParam(':senha_hosp',$senha_hosp, PDO::PARAM_STR);
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
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