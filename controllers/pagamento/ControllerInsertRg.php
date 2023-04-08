<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_rg = filter_input(INPUT_POST, 'nome_rg', FILTER_SANITIZE_STRING);
    $acad_id_rg = filter_input(INPUT_POST, 'acad_id_rg', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_rg']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO acad_rg (nome_rg, acad_id_rg, arq_rg ) VALUES (:nome_rg, :acad_id_rg, :arq_rg )";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_rg', $nome_rg);
    $insert_msg->bindParam(':acad_id_rg', $acad_id_rg);
    $insert_msg->bindParam(':arq_rg', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../up-rg/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_rg']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<div class='alert alert-info'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Todos documentos foram cadastrados com Sucesso!</strong> 
            </div>";
            header("Location: ../../home.php?acao=etapa-4");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Opss problemas na imagem!</strong> 
            </div>";
            header("Location: ../../home.php?acao=etapa-4");
        }        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=etapa-4");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=estagio");
}
