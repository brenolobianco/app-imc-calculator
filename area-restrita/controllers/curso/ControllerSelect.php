<<<<<<< HEAD
<?php

if(!isset($_GET['id_curso'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_curso = $_GET['id_curso'];
        
   $select = "SELECT * from curso WHERE id_curso=:id_curso";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_curso    = $mostra->id_curso;
            $nome_curso  = $mostra->nome_curso;
            $desc_curso  = $mostra->desc_curso;
            $img_curso   = $mostra->img_curso;

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

if(!isset($_GET['id_curso'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_curso = $_GET['id_curso'];
        
   $select = "SELECT * from curso WHERE id_curso=:id_curso";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_curso    = $mostra->id_curso;
            $nome_curso  = $mostra->nome_curso;
            $desc_curso  = $mostra->desc_curso;
            $img_curso   = $mostra->img_curso;

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