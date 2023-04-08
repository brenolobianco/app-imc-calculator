<<<<<<< HEAD
<?php

if (isset($_POST['cadastrar'])) {
    $senha_med = trim(strip_tags($_POST["senha_med"]));
    $senha_confirmar_med = trim(strip_tags($_POST["senha2"]));
    $nome_med  = trim(strip_tags($_POST["nome_med"]));
    $email_med = trim(strip_tags($_POST["email_med"]));
    $cpf_med   = trim(strip_tags($_POST["cpf_med"]));
    $data_nasc_med = trim(strip_tags($_POST["data_nasc_med"]));
    $ano_formacao_med   = trim(strip_tags($_POST["ano_formacao_med"]));
    $estado_atuacao_med  = trim(strip_tags($_POST["estado_atuacao_med"]));
    $numero_crm_med  = trim(strip_tags($_POST["numero_crm_med"]));
    $especialidade_med  = trim(strip_tags($_POST["especialidade_med"]));
    $link_cv_lates_med = $_POST["link_cv_lates_med"];

    if (strcmp($senha_med, $senha_confirmar_med) !== 0) {
        echo '
        <div class="alert alert-warning mt-4">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Senhas diferentes!</strong> 
        </div>';
        return;
    }

    $insert = "INSERT into medico ( nome_med, email_med, senha_med, 
        cpf_med, data_nasc_med, ano_formacao_med, estado_atuacao_med, 
        numero_crm_med, especialidade_med, link_cv_lates_med ) 
        VALUES (:nome_med, :email_med, :senha_med, :cpf_med,
         :data_nasc_med, :ano_formacao_med, :estado_atuacao_med, :numero_crm_med,
         :especialidade_med, :link_cv_lates_med)";

    try {
        $result = $conexao->prepare($insert);
        $result->bindParam(':nome_med', $nome_med, PDO::PARAM_STR);
        $result->bindParam(':email_med', $email_med, PDO::PARAM_STR);
        $result->bindParam(':senha_med', $senha_med, PDO::PARAM_STR);
        $result->bindParam(':cpf_med', $cpf_med, PDO::PARAM_STR);
        $result->bindParam(':data_nasc_med', $data_nasc_med, PDO::PARAM_STR);
        $result->bindParam(':ano_formacao_med', $ano_formacao_med, PDO::PARAM_STR);
        $result->bindParam(':estado_atuacao_med', $estado_atuacao_med, PDO::PARAM_STR);
        $result->bindParam(':numero_crm_med', $numero_crm_med, PDO::PARAM_STR);
        $result->bindParam(':especialidade_med', $especialidade_med, PDO::PARAM_STR);
        $result->bindParam(':link_cv_lates_med', $link_cv_lates_med, PDO::PARAM_STR);
        $result->execute();
        $medico_id = $conexao->lastInsertId();

        if (isset($medico_id)) {
            echo '
            <div class="alert alert-success mt-4">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> Cadastrado efetuado com sucesso! Aguarde, redirecionando para o questionário.</strong> 
            </div>';


            /// Habilitar login
            $_SESSION['emailAcad'] = $email_med;
            $_SESSION['senhaAcad'] = $senha_med;
            $_SESSION['isMed'] = true;

            header("Refresh: 1, pesquisa-medico.php?med_id=$medico_id");
        } else {
            echo '
            <div class="alert alert-warning mt-4">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Não foi efetuado de forma correta!</strong> 
            </div>';
        }
    } catch (PDOException $e) {
        echo '
            <div class="alert alert-warning mt-4">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Este CPF já está cadastrada!</strong> 
            </div>';
    }
}
=======
<?php

if (isset($_POST['cadastrar'])) {
    $senha_med = trim(strip_tags($_POST["senha_med"]));
    $senha_confirmar_med = trim(strip_tags($_POST["senha2"]));
    $nome_med  = trim(strip_tags($_POST["nome_med"]));
    $email_med = trim(strip_tags($_POST["email_med"]));
    $cpf_med   = trim(strip_tags($_POST["cpf_med"]));
    $data_nasc_med = trim(strip_tags($_POST["data_nasc_med"]));
    $ano_formacao_med   = trim(strip_tags($_POST["ano_formacao_med"]));
    $estado_atuacao_med  = trim(strip_tags($_POST["estado_atuacao_med"]));
    $numero_crm_med  = trim(strip_tags($_POST["numero_crm_med"]));
    $especialidade_med  = trim(strip_tags($_POST["especialidade_med"]));
    $link_cv_lates_med = $_POST["link_cv_lates_med"];

    if (strcmp($senha_med, $senha_confirmar_med) !== 0) {
        echo '
        <div class="alert alert-warning mt-4">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Senhas diferentes!</strong> 
        </div>';
        return;
    }

    $insert = "INSERT into medico ( nome_med, email_med, senha_med, 
        cpf_med, data_nasc_med, ano_formacao_med, estado_atuacao_med, 
        numero_crm_med, especialidade_med, link_cv_lates_med ) 
        VALUES (:nome_med, :email_med, :senha_med, :cpf_med,
         :data_nasc_med, :ano_formacao_med, :estado_atuacao_med, :numero_crm_med,
         :especialidade_med, :link_cv_lates_med)";

    try {
        $result = $conexao->prepare($insert);
        $result->bindParam(':nome_med', $nome_med, PDO::PARAM_STR);
        $result->bindParam(':email_med', $email_med, PDO::PARAM_STR);
        $result->bindParam(':senha_med', $senha_med, PDO::PARAM_STR);
        $result->bindParam(':cpf_med', $cpf_med, PDO::PARAM_STR);
        $result->bindParam(':data_nasc_med', $data_nasc_med, PDO::PARAM_STR);
        $result->bindParam(':ano_formacao_med', $ano_formacao_med, PDO::PARAM_STR);
        $result->bindParam(':estado_atuacao_med', $estado_atuacao_med, PDO::PARAM_STR);
        $result->bindParam(':numero_crm_med', $numero_crm_med, PDO::PARAM_STR);
        $result->bindParam(':especialidade_med', $especialidade_med, PDO::PARAM_STR);
        $result->bindParam(':link_cv_lates_med', $link_cv_lates_med, PDO::PARAM_STR);
        $result->execute();
        $medico_id = $conexao->lastInsertId();

        if (isset($medico_id)) {
            echo '
            <div class="alert alert-success mt-4">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> Cadastrado efetuado com sucesso! Aguarde, redirecionando para o questionário.</strong> 
            </div>';


            /// Habilitar login
            $_SESSION['emailAcad'] = $email_med;
            $_SESSION['senhaAcad'] = $senha_med;
            $_SESSION['isMed'] = true;

            header("Refresh: 1, pesquisa-medico.php?med_id=$medico_id");
        } else {
            echo '
            <div class="alert alert-warning mt-4">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Não foi efetuado de forma correta!</strong> 
            </div>';
        }
    } catch (PDOException $e) {
        echo '
            <div class="alert alert-warning mt-4">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Este CPF já está cadastrada!</strong> 
            </div>';
    }
}
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
