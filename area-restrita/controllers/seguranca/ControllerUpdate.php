<?php

if(!isset($_GET['id'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id = $_GET['id'];
        $select = "SELECT * from login WHERE id=:id";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id', $id, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id    = $mostra->id;
            $usuario  = $mostra->usuario;
            $senha  = $mostra->senha;

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
        $usuario  = trim(strip_tags($_POST["usuario"]));
        $senha  = trim(strip_tags($_POST["senha"]));
              
            $update ="UPDATE login SET usuario=:usuario, senha=:senha WHERE id=:id"; 
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id',$id, PDO::PARAM_INT);
                $result ->bindParam(':usuario',$usuario, PDO::PARAM_STR);
                $result ->bindParam(':senha',$senha, PDO::PARAM_STR);
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