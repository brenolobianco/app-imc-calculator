<?php
    if(isset($_REQUEST['sair'])){
        session_destroy();
        unset($_SESSION['usuariowva']);
        unset($_SESSION['senhawva']);
        header("Location: index.php");
    }
    ?>
