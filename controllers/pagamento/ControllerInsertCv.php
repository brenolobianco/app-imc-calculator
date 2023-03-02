<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_cv = filter_input(INPUT_POST, 'nome_cv', FILTER_SANITIZE_STRING);
    $acad_id_cv = filter_input(INPUT_POST, 'acad_id_cv', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_cv']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO acad_cv (nome_cv, acad_id_cv, arq_cv) VALUES (:nome_cv, :acad_id_cv, :arq_cv)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_cv', $nome_cv);
    $insert_msg->bindParam(':acad_id_cv', $acad_id_cv);
    $insert_msg->bindParam(':arq_cv', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../up-cv/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_cv']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<div class='alert alert-info'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Comprovate de matrícula.</strong> 
            </div>";
            header("Location: ../../home.php?acao=etapa-2"); 
        }else{
            $_SESSION['msg'] = "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Link CV Lattes cadastrado com Sucesso, agora vamos cadastrar o comprovate de matrícula.</strong> 
            </div>";
            header("Location: ../../home.php?acao=etapa-2");
        }        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=etapa-1");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=etapa-1");
}