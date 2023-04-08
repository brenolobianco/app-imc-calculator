<?php
    if(isset($_REQUEST['sair'])){
        session_destroy();
        unset($_SESSION['emailHosp']);
        unset($_SESSION['senhaHosp']);
        header("Location: index.php");
    }
    ?>
