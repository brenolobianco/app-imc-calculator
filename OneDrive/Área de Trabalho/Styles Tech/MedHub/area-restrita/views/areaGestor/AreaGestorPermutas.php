<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MedHub</title>
    <base href="/">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <app-root></app-root>

    <div class="container">
        <div class="row position-static ">
            <div class="col-md-3 bg-secondary mt-5 position-static" class="position-absolute h-100">
            <button type="button" class="btn btn btn-lg mt-2" style="color:#73c054;">setor logado x</button><br><br>
            
                <br><br><br><?php if ($perm->Area_Gestor_Notificacao) { ?>
                <button type="button" class="btn btn btn-lg text-light" style="background: #00063f;">
                    <a class="btn btn" href="area-restrita/AreaGestorNotificacao.php" role="button">
                       NOTIFICAÇÃO</a> 
                </button><br><br>
 				<?php }
                if ($perm->Area_Gestor_Comportamento) {?>
                <button type="button" class="btn btn btn-lg text-light" style="background: #00063f;">
                    <a class="btn btn" href="area-restrita/AreaGestorComportamento.php">
                        COMPORTAMENTO</a></button><br><br>
                <?php }
				if ($perm->Area_Gestor_Desempenho) {?>
                <button type="button" class="btn btn btn-lg text-light" style="background: #00063f;">
                    <a class="btn btn" href="area-restrita/AreaGestorDesempenho.php">
                        DESEMPENHO</a>
                </button><br><br>
                <?php }
                if ($perm->Area_Gestor_Frequencia) {?>
                <button type="button" class="btn btn btn-lg text-light" style="background: #00063f;">
                    <a class="btn btn" href="area-restrita/AreaGestorFrequencia.php">
                        FREQUÊNCIA</a>
                </button><br><br>
                <?php }
                if ($perm->Area_Gestor_Permutas) {?>
                <button type="button" class="btn btn btn-lg text-light" style="background: #00063f;">
                    <a class="btn btn" href="area-restrita/AreaGestorPermutas.php">
                        PERMUTA</a>
                </button><br><br>
                <?php }?>
            </div>
            <div class="col-8 mt-2" style="background-color:#00063f;">
                <button type="button" class="btn btn btn-lg mt-2" style="color:#73c054;">PERMUTA</button><br><br>
                <div class="container">

                    <div class="row">

                        <div class="col-5 justify-content-end">

                            <div class="col-mb-5 ">

                                <label class="sr-only " for="inlineFormInputGroup">Pesquisar</label>
                                <div class="input-group mb-2">
                                <input type="text" class="form-control " id="inlineFormInputGroup" placeholder="Pesquisar">
                                    <div class="input-group-prepend ">
                                        <div class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                            class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1
                                                 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                            </i>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div>
            <div class="col-3 mt-5">

            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>