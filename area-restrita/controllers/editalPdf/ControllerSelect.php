<<<<<<< HEAD
<?php

if(!isset($_GET['id_edital'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_edital = $_GET['id_edital'];
        $select = "SELECT * from edital_pdf WHERE id_edital=:id_edital";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_edital', $id_edital, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
              $id_edital    = $mostra->id_edital;
              $nome_edital  = $mostra->nome_edital;
              $arq_edital  = $mostra->arq_edital;

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
=======
<?php

if(!isset($_GET['id_edital'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_edital = $_GET['id_edital'];
        $select = "SELECT * from edital_pdf WHERE id_edital=:id_edital";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_edital', $id_edital, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
              $id_edital    = $mostra->id_edital;
              $nome_edital  = $mostra->nome_edital;
              $arq_edital  = $mostra->arq_edital;

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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
?>