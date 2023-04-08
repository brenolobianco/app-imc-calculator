<<<<<<< HEAD
<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_vid = filter_input(INPUT_POST, 'nome_vid', FILTER_SANITIZE_STRING);
    $aula_id_vid = filter_input(INPUT_POST, 'aula_id_vid', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_vid']['name'];
    $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
    $base = pathinfo($nome_arq, PATHINFO_FILENAME);

    $nome_arq_webm = $base . ".webm";
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO aula_vid (nome_vid, aula_id_vid, arq_vid) VALUES (:nome_vid, :aula_id_vid, :arq_vid)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_vid', $nome_vid);
    $insert_msg->bindParam(':aula_id_vid', $aula_id_vid);
    $insert_msg->bindParam(':arq_vid', $nome_arq_webm);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        if (!empty($nome_arq)) {
            //Recuperar último ID inserido no banco de dados
            $permitido = array(
                "mp4",
                "avi",
                "mov",
                "wmv",
                "flv",
                "mkv",
                "webm",
                "m4v"
            );
            
            $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
            $base = pathinfo($nome_arq, PATHINFO_FILENAME);
            if (!in_array($ext, $permitido)) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <strong> Erro! Apenas video!</strong> 
                </div>";
                header("Location: ../../home.php?acao=nova-aula-video");
                exit(0);
            }
            $ultimo_id = $conn->lastInsertId();

            //Diretório onde o arquivo vai ser salvo
            $diretorio = '../../../videos/' . $ultimo_id . '/';

            //Criar a pasta de foto 
            mkdir($diretorio, 0755);
            $tmp = $_FILES['arq_vid']['tmp_name'];
            $cmd = "ffmpeg -i ".$tmp." -c:v libvpx-vp9 -b:v 1M -c:a libvorbis ".$tmp;
            if (move_uploaded_file($tmp, $diretorio . $base . ".webm")) {
                $_SESSION['msg'] = "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>";
                header("Location: ../../home.php?acao=nova-aula-video");
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Inserido com Sucesso!</strong> 
        </div>";
        header("Location: ../../home.php?acao=nova-aula-video");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=nova-aula-video");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=nova-aula-video");
}
=======
<?php

session_start();

include '../../models/conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome_vid = filter_input(INPUT_POST, 'nome_vid', FILTER_SANITIZE_STRING);
    $aula_id_vid = filter_input(INPUT_POST, 'aula_id_vid', FILTER_SANITIZE_STRING);
    $nome_arq = $_FILES['arq_vid']['name'];
    $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
    $base = pathinfo($nome_arq, PATHINFO_FILENAME);

    $nome_arq_webm = $base . ".webm";
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO aula_vid (nome_vid, aula_id_vid, arq_vid) VALUES (:nome_vid, :aula_id_vid, :arq_vid)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_vid', $nome_vid);
    $insert_msg->bindParam(':aula_id_vid', $aula_id_vid);
    $insert_msg->bindParam(':arq_vid', $nome_arq_webm);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        if (!empty($nome_arq)) {
            //Recuperar último ID inserido no banco de dados
            $permitido = array(
                "mp4",
                "avi",
                "mov",
                "wmv",
                "flv",
                "mkv",
                "webm",
                "m4v"
            );
            
            $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
            $base = pathinfo($nome_arq, PATHINFO_FILENAME);
            if (!in_array($ext, $permitido)) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <strong> Erro! Apenas video!</strong> 
                </div>";
                header("Location: ../../home.php?acao=nova-aula-video");
                exit(0);
            }
            $ultimo_id = $conn->lastInsertId();

            //Diretório onde o arquivo vai ser salvo
            $diretorio = '../../../videos/' . $ultimo_id . '/';

            //Criar a pasta de foto 
            mkdir($diretorio, 0755);
            $tmp = $_FILES['arq_vid']['tmp_name'];
            $cmd = "ffmpeg -i ".$tmp." -c:v libvpx-vp9 -b:v 1M -c:a libvorbis ".$tmp;
            if (move_uploaded_file($tmp, $diretorio . $base . ".webm")) {
                $_SESSION['msg'] = "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>";
                header("Location: ../../home.php?acao=nova-aula-video");
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Inserido com Sucesso!</strong> 
        </div>";
        header("Location: ../../home.php?acao=nova-aula-video");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
        header("Location: ../../home.php?acao=nova-aula-video");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Erro!</strong> 
    </div>";
    header("Location: ../../home.php?acao=nova-aula-video");
}
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
