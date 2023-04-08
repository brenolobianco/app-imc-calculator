<<<<<<< HEAD
<?php

if (isset($_POST['cadastrar']) && isset($_GET['med_id'])) {
    echo ' <div class="alert alert-warning mt-4">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Aguarde, enviando questionário.</strong> 
    </div>';

    $medico_id = $_GET['med_id'];

    try {

        $select = "SELECT * FROM respostas WHERE medico_id=:medico_id";
        $result = $conexao->prepare($select);
        $result->bindParam(':medico_id', $medico_id, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();

        if ($contar > 0) header("Refresh: 1, pesquisa-medico.php");

        foreach ($_POST as $questao_id => $value) {
            if ($questao_id != 'cadastrar') {
                if (!is_array($value)) {
                    $insert = "INSERT into respostas (resposta_questao, questao_id, medico_id) VALUES (:resposta_questao, :questao_id, :medico_id)";
                    $result = $conexao->prepare($insert);
                    $result->bindParam(':resposta_questao', $value, PDO::PARAM_STR);
                    $result->bindParam(':questao_id', $questao_id, PDO::PARAM_STR);
                    $result->bindParam(':medico_id', $medico_id, PDO::PARAM_STR);
                    $result->execute();
                } else {
                    foreach ($value as $resposta) {
                        $insert = "INSERT into respostas (alternativa_id, questao_id, medico_id) VALUES (:alternativa_id, :questao_id, :medico_id)";
                        $result = $conexao->prepare($insert);
                        $result->bindParam(':alternativa_id', $resposta, PDO::PARAM_STR);
                        $result->bindParam(':questao_id', $questao_id, PDO::PARAM_STR);
                        $result->bindParam(':medico_id', $medico_id, PDO::PARAM_STR);
                        $result->execute();
                    }
                }
            }
        }

        header("Refresh: 1, home.php?acao=welcome");
    } catch (PDOException $e) {
        echo '<br />
        <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Não foi possivel responder o questionário!</strong> 
        </div>';
    }
}

function carregarAlternativas($conexao, $id, $tipo_questao)
{
    if ($tipo_questao === 'text') {
        return  "<div class='alternativa'><textarea placeholder='Resposta:' class='content-questao_input' name='$id'></textarea></div>";
    }

    $select = "SELECT * from alternativas where questao_id = :id ORDER BY descricao_alternativa asc";

    $return_html = '';

    try {
        $result = $conexao->prepare($select);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($alternativa = $result->FETCH(PDO::FETCH_OBJ)) {
                $return_html .= "<div class='alternativa'><p><input type='$tipo_questao' name='$alternativa->questao_id[]' value='$alternativa->id_alternativa'>&ensp; $alternativa->descricao_alternativa</p></div>";
            }
        }
        return $return_html;
    } catch (PDOException $e) {
        echo $e;
    }
}

function carregarQuestoes($conexao)
{
    $select = "SELECT * from questoes where  formulario_questao = 'medico' ORDER BY ordem_questao asc";

    try {
        $result = $conexao->prepare($select);

        $result->execute();

        if ($result->rowCount() > 0) {
            while ($questao = $result->FETCH(PDO::FETCH_OBJ)) {

                $alternativas = carregarAlternativas($conexao, $questao->id_questao, $questao->tipo_questao);

                echo "<div class='content-questao'><div><p> $questao->ordem_questao) $questao->descricao_questao</p></div><div class='content-alternativa'> $alternativas</div></div>";
            }
        }
    } catch (PDOException $e) {
        echo $e;
    }
}
=======
<?php

if (isset($_POST['cadastrar']) && isset($_GET['med_id'])) {
    echo ' <div class="alert alert-warning mt-4">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Aguarde, enviando questionário.</strong> 
    </div>';

    $medico_id = $_GET['med_id'];

    try {

        $select = "SELECT * FROM respostas WHERE medico_id=:medico_id";
        $result = $conexao->prepare($select);
        $result->bindParam(':medico_id', $medico_id, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();

        if ($contar > 0) header("Refresh: 1, pesquisa-medico.php");

        foreach ($_POST as $questao_id => $value) {
            if ($questao_id != 'cadastrar') {
                if (!is_array($value)) {
                    $insert = "INSERT into respostas (resposta_questao, questao_id, medico_id) VALUES (:resposta_questao, :questao_id, :medico_id)";
                    $result = $conexao->prepare($insert);
                    $result->bindParam(':resposta_questao', $value, PDO::PARAM_STR);
                    $result->bindParam(':questao_id', $questao_id, PDO::PARAM_STR);
                    $result->bindParam(':medico_id', $medico_id, PDO::PARAM_STR);
                    $result->execute();
                } else {
                    foreach ($value as $resposta) {
                        $insert = "INSERT into respostas (alternativa_id, questao_id, medico_id) VALUES (:alternativa_id, :questao_id, :medico_id)";
                        $result = $conexao->prepare($insert);
                        $result->bindParam(':alternativa_id', $resposta, PDO::PARAM_STR);
                        $result->bindParam(':questao_id', $questao_id, PDO::PARAM_STR);
                        $result->bindParam(':medico_id', $medico_id, PDO::PARAM_STR);
                        $result->execute();
                    }
                }
            }
        }

        header("Refresh: 1, home.php?acao=welcome");
    } catch (PDOException $e) {
        echo '<br />
        <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Não foi possivel responder o questionário!</strong> 
        </div>';
    }
}

function carregarAlternativas($conexao, $id, $tipo_questao)
{
    if ($tipo_questao === 'text') {
        return  "<div class='alternativa'><textarea placeholder='Resposta:' class='content-questao_input' name='$id'></textarea></div>";
    }

    $select = "SELECT * from alternativas where questao_id = :id ORDER BY descricao_alternativa asc";

    $return_html = '';

    try {
        $result = $conexao->prepare($select);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($alternativa = $result->FETCH(PDO::FETCH_OBJ)) {
                $return_html .= "<div class='alternativa'><p><input type='$tipo_questao' name='$alternativa->questao_id[]' value='$alternativa->id_alternativa'>&ensp; $alternativa->descricao_alternativa</p></div>";
            }
        }
        return $return_html;
    } catch (PDOException $e) {
        echo $e;
    }
}

function carregarQuestoes($conexao)
{
    $select = "SELECT * from questoes where  formulario_questao = 'medico' ORDER BY ordem_questao asc";

    try {
        $result = $conexao->prepare($select);

        $result->execute();

        if ($result->rowCount() > 0) {
            while ($questao = $result->FETCH(PDO::FETCH_OBJ)) {

                $alternativas = carregarAlternativas($conexao, $questao->id_questao, $questao->tipo_questao);

                echo "<div class='content-questao'><div><p> $questao->ordem_questao) $questao->descricao_questao</p></div><div class='content-alternativa'> $alternativas</div></div>";
            }
        }
    } catch (PDOException $e) {
        echo $e;
    }
}
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
