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
            $cep_acad  = $mostra->cep_acad;
            $uf_acad  = $mostra->uf_acad;
            $cidade_acad  = $mostra->cidade_acad;
            $bairro_acad  = $mostra->bairro_acad;
            $rua_acad  = $mostra->rua_acad;
            $num_acad  = $mostra->num_acad;
            $comp_acad  = $mostra->comp_acad;

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
        $cep_acad  = trim(strip_tags($_POST["cep_acad"]));
        $uf_acad   = trim(strip_tags($_POST["uf_acad"]));
        $cidade_acad  = trim(strip_tags($_POST["cidade_acad"]));
        $bairro_acad  = trim(strip_tags($_POST["bairro_acad"]));
        $rua_acad  = trim(strip_tags($_POST["rua_acad"]));
        $num_acad   = trim(strip_tags($_POST["num_acad"]));
        $comp_acad  = trim(strip_tags($_POST["comp_acad"]));

              
            $update ="UPDATE academico SET cep_acad=:cep_acad, uf_acad=:uf_acad, cidade_acad=:cidade_acad, bairro_acad=:bairro_acad, 
            rua_acad=:rua_acad, num_acad=:num_acad, comp_acad=:comp_acad  WHERE id_acad=:id_acad"; 
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_acad',$id_acad, PDO::PARAM_INT);
                $result ->bindParam(':cep_acad',$cep_acad, PDO::PARAM_STR);
                $result ->bindParam(':uf_acad',$uf_acad, PDO::PARAM_STR);
                $result ->bindParam(':cidade_acad',$cidade_acad, PDO::PARAM_STR);
                $result ->bindParam(':bairro_acad',$bairro_acad, PDO::PARAM_STR);
                $result ->bindParam(':rua_acad',$rua_acad, PDO::PARAM_STR);
                $result ->bindParam(':num_acad',$num_acad, PDO::PARAM_STR);
                $result ->bindParam(':comp_acad',$comp_acad, PDO::PARAM_STR);
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<br><div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                
            }else{
                echo '<br><div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> O Conteúdo não foi atualizado de forma correta!</strong> 
                    </div>';
            }
        }catch(PDOException $e){
            echo $e;
        }
                                    
    }    

?>