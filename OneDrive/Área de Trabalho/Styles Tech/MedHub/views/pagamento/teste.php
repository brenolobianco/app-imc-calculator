<?php
    //session_start();

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<br><br><br><br>
  
<form method="post" action="controllers/pagamento/ControllerInsertRg.php" enctype="multipart/form-data">
    <input type="hidden" name="acad_id_rg" value="<?=$idLog;?>">
    <input type="text" name="nome_rg" placeholder="link">
    <input type="file" name="arq_rg"/>

    <input name="SendCadImg" type="submit" value="Salvar"/>

</form>