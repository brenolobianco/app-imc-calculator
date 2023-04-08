<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_ma = filter_input(INPUT_POST, 'nome_ma', FILTER_SANITIZE_STRING);
    $acad_id_ma = filter_input(INPUT_POST, 'acad_id_ma', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_ma']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO acad_ma (nome_ma, acad_id_ma, arq_ma ) VALUES (:nome_ma, :acad_id_ma, :arq_ma )";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_ma', $nome_ma);
    $insert_msg->bindParam(':acad_id_ma', $acad_id_ma);
    $insert_msg->bindParam(':arq_ma', $nome_arq);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../up-ma/' . $ultimo_id.'/';

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arq_ma']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<div class='alert alert-info'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Cadastrar o RG.</strong> 
            </div>";
            header("Location: ../../home.php?acao=etapa-3&id_est=user");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Opss problemas na imagem!</strong> 
            </div>";
            header("Location: ../../home.php?acao=etapa-3");
        }        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=etapa-3");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=etapa-3");
}
