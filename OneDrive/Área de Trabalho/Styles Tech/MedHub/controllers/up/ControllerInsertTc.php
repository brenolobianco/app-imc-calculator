<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_tc = filter_input(INPUT_POST, 'nome_tc', FILTER_SANITIZE_STRING);
    $acad_id_tc = filter_input(INPUT_POST, 'acad_id_tc', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_tc']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO acad_tc (nome_tc, acad_id_tc, arq_tc) VALUES (:nome_tc, :acad_id_tc, :arq_tc)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_tc', $nome_tc);
    $insert_msg->bindParam(':acad_id_tc', $acad_id_tc);
    $insert_msg->bindParam(':arq_tc', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../up-tc/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_tc']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<br><div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Todos comprovantes cadastrado com Sucesso!</strong> 
            </div>";
            header("Location: ../../home.php?acao=subir-termos-de-compromisso"); 
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Erro.</strong> 
            </div>";
            header("Location: ../../home.php?acao=erro");
        }        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=erro");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=erro");
}