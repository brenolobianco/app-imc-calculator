<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_pdf = filter_input(INPUT_POST, 'nome_pdf', FILTER_SANITIZE_STRING);
    $aula_id_pdf = filter_input(INPUT_POST, 'aula_id_pdf', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_pdf']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO aula_pdf (nome_pdf, aula_id_pdf, arq_pdf ) VALUES (:nome_pdf, :aula_id_pdf, :arq_pdf )";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_pdf', $nome_pdf);
    $insert_msg->bindParam(':aula_id_pdf', $aula_id_pdf);
    $insert_msg->bindParam(':arq_pdf', $nome_arq);

    $write = null;
    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../../../pdfs/' . $ultimo_id.'/';
        //Criar a pasta de foto 
<<<<<<< HEAD
        mkdir($diretorio, 777);
        
        // debug
        if (is_dir($diretorio)) {
            $write = "true";
        } else {
            $write = "false";
        }
    
=======
        mkdir($diretorio, 0755);
        
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
        
        if(move_uploaded_file($_FILES['arq_pdf']['tmp_name'], $diretorio.$nome_arq)){
            $_SESSION['msg'] = "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> Inserido com Sucesso!</strong> 
            </div>";
            header("Location: ../../home.php?acao=nova-aula-pdf");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>x</button>
            <strong> ".$write."</strong> 
            </div>";
            header("Location: ../../home.php?acao=nova-aula-pdf");
        }        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> ".$write."</strong> 
        </div>";
        header("Location: ../../home.php?acao=nova-aula-pdf");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=nova-aula-pdf");
}
