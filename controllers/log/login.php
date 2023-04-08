<?php
<<<<<<< HEAD
include 'models/conecta.php';
//var_dump($_POST,$_GET);
=======

>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
if (isset($_GET['acao'])) {
  if (!isset($_POST['logar'])) {
    $acao = $_GET['acao'];

    if ($acao == 'negado') {
      echo '<br />
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Erro ao acessar!</strong> Você precisa estar logado p/ acessar o Sistema.
        </div>';
    }
  }
}

if (isset($_POST['logar'])) {
  // RECUPERAR DADOS FORM
  $email_acad = trim(strip_tags($_POST['email_acad']));
  $senha_acad = trim(strip_tags($_POST['senha_acad']));
  // SELECIONAR BANCO DE DADOS
  $select = "SELECT * from academico WHERE BINARY email_acad=:email_acad AND BINARY senha_acad=:senha_acad";

  try {
    $result = $conexao->prepare($select);
    $result->bindParam(':email_acad', $email_acad, PDO::PARAM_STR);
    $result->bindParam(':senha_acad', $senha_acad, PDO::PARAM_STR);
    $result->execute();

    $contar = $result->rowCount();

    if ($contar > 0) {
      $email_acad = $_POST['email_acad'];
      $senha_acad = $_POST['senha_acad'];
      
      $_SESSION['emailAcad'] = $email_acad;
      $_SESSION['senhaAcad'] = $senha_acad;

      echo '<br />
      <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Logado com Sucesso!</strong> Redirecionando para o painel...
      </div>';

      header("Refresh: 1, home.php?acao=welcome");
    } else {
      $selectMedi = "SELECT * from medico WHERE BINARY email_med=:email_acad AND BINARY senha_med=:senha_acad";

      $resultMed = $conexao->prepare($selectMedi);
      $resultMed->bindParam(':email_acad', $email_acad, PDO::PARAM_STR);
      $resultMed->bindParam(':senha_acad', $senha_acad, PDO::PARAM_STR);
      $resultMed->execute();

      if ($resultMed->rowCount() > 0) {
        $email_acad = $_POST['email_acad'];
        $senha_acad = $_POST['senha_acad'];

        $_SESSION['emailAcad'] = $email_acad;
        $_SESSION['senhaAcad'] = $senha_acad;
        $_SESSION['isMed'] = true;

        echo '<br />
        <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Logado com Sucesso!</strong> Redirecionando para o painel...
        </div>';

        return header("Refresh: 1, home.php?acao=welcome");
      }
      echo '<br />
        <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Opss!!!</strong> email e/ou a senha estão incorretos.
        </div>';
    }
  } catch (PDOException $e) {
    echo $e;
  }
}
