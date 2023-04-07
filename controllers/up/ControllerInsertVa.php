<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_va = filter_input(INPUT_POST, 'nome_va', FILTER_SANITIZE_STRING);
    $acad_id_va = filter_input(INPUT_POST, 'acad_id_va', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_va']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO acad_va (nome_va, acad_id_va, arq_va) VALUES (:nome_va, :acad_id_va, :arq_va)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_va', $nome_va);
    $insert_msg->bindParam(':acad_id_va', $acad_id_va);
    $insert_msg->bindParam(':arq_va', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../up-va/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_va']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<br><div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Comprovantes cadastrados com sucesso!</strong> 
            </div>";
            header("Location: ../../home.php?acao=finalizados"); 
        }else{
            $_SESSION['msg'] = "<br><div class='alert alert-info'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Você poderá posteriormente fazer o upload dos arquivos!</strong> 
            </div>";
            header("Location: ../../home.php?acao=finalizados");
        }        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=finalizados");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=finalizados");
}