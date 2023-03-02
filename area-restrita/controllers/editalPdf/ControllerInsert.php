<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_edital = filter_input(INPUT_POST, 'nome_edital', FILTER_SANITIZE_STRING);
    $est_id_edital = filter_input(INPUT_POST, 'est_id_edital', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_edital']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO edital_pdf (nome_edital, est_id_edital, arq_edital ) VALUES (:nome_edital, :est_id_edital, :arq_edital )";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_edital', $nome_edital);
    $insert_msg->bindParam(':est_id_edital', $est_id_edital);
    $insert_msg->bindParam(':arq_edital', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../../editais/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_edital']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Inserido com Sucesso!</strong> 
            </div>";
            header("Location: ../../home.php?acao=novo-edital-pdf");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Opss problemas na imagem!</strong> 
            </div>";
            header("Location: ../../home.php?acao=novo-edital-pdf");
        }        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=novo-edital-pdf");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=novo-edital-pdf");
}
