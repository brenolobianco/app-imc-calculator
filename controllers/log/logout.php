<?php
    if(isset($_REQUEST['sair'])){
        session_destroy();
        unset($_SESSION['emailAcad']);
        unset($_SESSION['senhaAcad']);
        unset($_SESSION['isMed']);
        header("Location: index.php");
    }
    ?>
