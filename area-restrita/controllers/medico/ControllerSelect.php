<?php

if (!isset($_GET['id_med'])) {
  header("Location: home.php?acao=pagina-nao-existe");
  exit;
}

$id_acad = $_GET['id_med'];

$select = "SELECT * from medico WHERE id_med=:id_med";

try {
  $result = $conexao->prepare($select);
  $result->bindParam(':id_med', $id_acad, PDO::PARAM_INT);
  $result->execute();
  $contar = $result->rowCount();

  if ($contar > 0) {
    while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
      $id_med    = $mostra->id_med;
      $nome_med  = $mostra->nome_med;
      $email_med   = $mostra->email_med;
      $cpf_med    = $mostra->cpf_med;
      $data_nasc_med = $mostra->data_nasc_med;
      $ano_formacao_med = $mostra->ano_formacao_med;
      $estado_atuacao_med = $mostra->estado_atuacao_med;
      $numero_crm_med = $mostra->numero_crm_med;
      $especialidade_med = $mostra->especialidade_med;
      $link_cv_lates_med   = $mostra->link_cv_lates_med;
    }
  } else {
    echo '<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>Opz!!!</strong> Nada adicionado.
          </div>';
    exit;
  }
} catch (PDOException $e) {
  echo $e;
}

function carregarRespostas($conexao, $medico_id, $questao_id)
{
  $select = "SELECT * from questoes q
      LEFT JOIN respostas r on r.questao_id = q.id_questao
      LEFT JOIN alternativas a on a.id_alternativa = r.alternativa_id
      WHERE r.medico_id = :medico_id 
      AND  r.questao_id = :questao_id
      ORDER BY descricao_alternativa asc
    ";

  $return_html = '';

  try {
    $result = $conexao->prepare($select);
    $result->bindParam(':medico_id', $medico_id, PDO::PARAM_STR);
    $result->bindParam(':questao_id', $questao_id, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount() > 0) {

      while ($alternativa = $result->FETCH(PDO::FETCH_OBJ)) {
        $value = $alternativa->tipo_questao === 'text'
          ? $alternativa->resposta_questao
          : $alternativa->descricao_alternativa;

        $return_html .= "<li>$value</li>";
      }
    } else {
      $return_html = '<li style="color:red;">Não respondeu!</li>';
    }

    return $return_html;
  } catch (PDOException $e) {
    echo $e;
  }
}

function carregarQuestoes($conexao, $medico_id)
{
  $select = "SELECT * from questoes where  formulario_questao = 'medico' ORDER BY ordem_questao asc";
  try {
    $result = $conexao->prepare($select);
    $result->execute();

    if ($result->rowCount() > 0) {
      while ($questao = $result->FETCH(PDO::FETCH_OBJ)) {

        $alternativas = carregarRespostas($conexao, $medico_id, $questao->id_questao);

        echo "<div><p><b> $questao->ordem_questao) $questao->descricao_questao</b></p><ul> $alternativas</ul></div>";
      }
    }
  } catch (PDOException $e) {
    echo $e;
  }
}
