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
            $cpf_acad   = $mostra->cpf_acad;
            $rg_acad    = $mostra->rg_acad;
            $univ_imp_acad = $mostra->univ_imp_acad;
            $data_nasc_acad = $mostra->data_nasc_acad;
            $link_cv_lates_acad = $mostra->link_cv_lates_acad;
            $email_acad = $mostra->email_acad;
            $whats_acad = $mostra->whats_acad;
            $cep_acad   = $mostra->cep_acad;
            $uf_acad    = $mostra->uf_acad;
            $cidade_acad = $mostra->cidade_acad;
            $bairro_acad = $mostra->bairro_acad;
            $rua_acad    = $mostra->rua_acad;
            $num_acad    = $mostra->num_acad;
            $img_acad    = $mostra->img_acad;
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
?>