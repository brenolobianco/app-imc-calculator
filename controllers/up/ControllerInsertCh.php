<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_ch = filter_input(INPUT_POST, 'nome_ch', FILTER_SANITIZE_STRING);
    $acad_id_ch = filter_input(INPUT_POST, 'acad_id_ch', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_ch']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO acad_ch (nome_ch, acad_id_ch, arq_ch) VALUES (:nome_ch, :acad_id_ch, :arq_ch)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_ch', $nome_ch);
    $insert_msg->bindParam(':acad_id_ch', $acad_id_ch);
    $insert_msg->bindParam(':arq_ch', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../up-ch/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_ch']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<br><div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Crachá cadastrado com Sucesso.</strong> 
            </div>";
            header("Location: ../../home.php?acao=subir-cracha"); 
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