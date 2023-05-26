<?php

session_start();

if(!isset($_GET['id_hosp'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_hosp = $_GET['id_hosp'];


   $select = "SELECT * FROM hospital, login  WHERE id_hosp=:id_hosp";
   try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_hosp', $id_hosp, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_hosp   = $mostra->id_hosp;
            $nome_hosp = $mostra->nome_hosp;
            $img_hosp  = $mostra->img_hosp;
            $fone_hosp = $mostra->fone_hosp;
            $resp_hosp = $mostra->resp_hosp;
            $email_hosp = $mostra->email_hosp;
            $senha_hosp = $mostra->senha_hosp;
            $cep_hosp   = $mostra->cep_hosp;
            $uf_hosp    = $mostra->uf_hosp;
            $cidade_hosp = $mostra->cidade_hosp;
            $bairro_hosp = $mostra->bairro_hosp;
            $rua_hosp  = $mostra->rua_hosp;
            $num_hosp  = $mostra->num_hosp;
            
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