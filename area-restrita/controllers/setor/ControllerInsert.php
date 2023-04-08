<?php
include_once "../models/conexao.php";

//Receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

var_dump($dados);

//Verificar se o usuario clicou no botao
if (!empty($dados['Cadastrar'])) {
    $query_usuario = "INSERT INTO login 
        (email, senha) VALUES
        (:email, :senha)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $cad_usuario->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
    var_dump($cad_usuario);
    $cad_usuario->execute();
    //var_dump($conn->lastInsertId());
    //Recuperar o ultimo id inserido
    $id_usuario = $conn->lastInsertId();

    $query_endereco = "INSERT INTO setor 
        (logradouro, numero, usuario_id) VALUES 
        (:logradouro, :numero, :usuario_id)";
    $cad_endereco = $conn->prepare($query_endereco);
    $cad_endereco->bindParam(':logradouro', $dados['logradouro'], PDO::PARAM_STR);
    $cad_endereco->bindParam(':numero', $dados['numero'], PDO::PARAM_STR);
    $cad_endereco->bindParam(':usuario_id', $id_usuario, PDO::PARAM_INT);
    $cad_endereco->execute();
}
