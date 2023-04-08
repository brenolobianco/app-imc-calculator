<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_pa = filter_input(INPUT_POST, 'nome_pa', FILTER_SANITIZE_STRING);
    $acad_id_pa = filter_input(INPUT_POST, 'acad_id_pa', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_pa']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO acad_pa (nome_pa, acad_id_pa, arq_pa) VALUES (:nome_pa, :acad_id_pa, :arq_pa)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_pa', $nome_pa);
    $insert_msg->bindParam(':acad_id_pa', $acad_id_pa);
    $insert_msg->bindParam(':arq_pa', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../up-pa/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_pa']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "";
            header("Location: ../../home.php?acao=upload-comprovante-de-vacinacao"); 
        }else{
            $_SESSION['msg'] = "";
            header("Location: ../../home.php?acao=upload-comprovante-de-vacinacao");
        }        
    } else {
        $_SESSION['msg'] = "<br><div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=upload-comprovante-de-vacinacao");
    }
} else {
    $_SESSION['msg'] = "<br><div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=upload-comprovante-de-vacinacao");
}