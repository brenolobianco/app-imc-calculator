<?php /*<!doctype html>
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
    */
?>

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet" />


<style>
    .roboto {
        font-family: 'Roboto', sans-serif;
        font-weight: 600;
        font-size: 1.2rem;
        color: black;
    }

    .selecionar-tipo-visualizacoes {
        display: inline-block;
        position: relative;
    }

    .selecionar-tipo-visualizacoes figcaption {
        position: absolute;
        top: 150px;
        right: 30px;
        font-size: 30px;
        color: black;
        text-shadow: 0px 0px 2px black;
    }

    .img-selecionar-tipo-dado {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 20px;
        opacity: 1;
    }

    button.btn-basic {
        background-color: #fff;
        color: black;
        width: 50%;
        padding: 10px;
        border-radius: 20px;
        border: none;
    }

    .split-line {
        border: 1px solid #00063f;
        width: 100%;
        margin: 0 auto;
    }


    @media print {
        #abas {
            display: none;
        }

        button.print.btn {
            display: none;
        }

        .ribbon {
            display: none;
        }
    }

    section.ranking {
        width: 40rem;
        height: 43rem;
        background-color: #ffffff;
        -webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
        box-shadow: 0px 5px 15px 8px #e4e7fb;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 0.5rem;
    }

    section.ranking thead {
        display: none;
    }

    #header {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 2.5rem 2rem;
    }

    .share {
        width: 4.5rem;
        height: 3rem;
        background-color: #f55e77;
        border: 0;
        border-bottom: 0.2rem solid #c0506a;
        border-radius: 2rem;
        cursor: pointer;
    }

    .share:active {
        border-bottom: 0;
    }

    .share i {
        color: #fff;
        font-size: 2rem;
    }

    h1 {
        font-family: "Rubik", sans-serif;
        font-size: 1.7rem;
        color: #141a39;
        text-transform: uppercase;
        cursor: default;
    }

    section.ranking #leaderboard {
        width: 100%;
        position: relative;
    }

    section.ranking table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        color: #141a39;
        cursor: default;
    }

    section.ranking tr {
        transition: all 0.2s ease-in-out;
        border-radius: 0.2rem;
    }

    section.ranking tr:not(:first-child):hover {
        background-color: #fff;
        transform: scale(1.1);
        -webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
        box-shadow: 0px 5px 15px 8px #e4e7fb;
    }

    section.ranking tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    section.ranking tr:nth-child(1) {}

    section.ranking td {
        height: 5rem;
        font-family: "Rubik", sans-serif;
        font-size: 1.4rem;
        padding: 1rem 2rem;
        position: relative;
    }

    section.ranking .number {
        width: 1rem;
        font-size: 2.2rem;
        font-weight: bold;
        text-align: left;
        color: black;
    }

    section.ranking .name {
        text-align: left;
        font-size: 1.2rem;
        color: black;
    }

    section.ranking .points {
        font-weight: bold;
        font-size: 1.3rem;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        color: black;
    }

    section.ranking .points:first-child {
        width: 10rem;
    }

    section.ranking .gold-medal {
        height: 3rem;
        margin-left: 1.5rem;
    }

    section.ranking .ribbon {
        width: 42rem;
        height: 5.5rem;
        top: -0.5rem;
        position: absolute;
        left: -1rem;
        -webkit-box-shadow: 0px 15px 11px -6px #7a7a7d;
        box-shadow: 0px 15px 11px -6px #7a7a7d;
    }

    section.ranking .ribbon::before {
        content: "";
        height: 1.5rem;
        width: 1.5rem;
        bottom: -0.8rem;
        left: 0.35rem;
        transform: rotate(45deg);
        background-color: #5c5be5;
        position: absolute;
        z-index: -1;
    }

    section.ranking .ribbon::after {
        content: "";
        height: 1.5rem;
        width: 1.5rem;
        bottom: -0.8rem;
        right: 0.35rem;
        transform: rotate(45deg);
        background-color: #5c5be5;
        position: absolute;
        z-index: -1;
    }

    section.ranking #buttons {
        width: 100%;
        margin-top: 3rem;
        display: flex;
        justify-content: center;
        gap: 2rem;
    }

    section.ranking .exit {
        width: 11rem;
        height: 3rem;
        font-family: "Rubik", sans-serif;
        font-size: 1.3rem;
        text-transform: uppercase;
        color: #7e7f86;
        border: 0;
        background-color: #fff;
        border-radius: 2rem;
        cursor: pointer;
    }

    section.ranking .exit:hover {
        border: 0.1rem solid #5c5be5;
    }

    section.ranking .continue {
        width: 11rem;
        height: 3rem;
        font-family: "Rubik", sans-serif;
        font-size: 1.3rem;
        color: #fff;
        text-transform: uppercase;
        background-color: #5c5be5;
        border: 0;
        border-bottom: 0.2rem solid #3838b8;
        border-radius: 2rem;
        cursor: pointer;
    }

    section.ranking .continue:active {
        border-bottom: 0;
    }

    @media (max-width: 740px) {
        * {
            font-size: 70%;
        }
    }

    @media (max-width: 500px) {
        * {
            font-size: 55%;
        }
    }

    @media (max-width: 390px) {
        * {
            font-size: 45%;
        }
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col col-sm-12 col-md-2" style="background-color:#d7d8dd; height:850px; border-radius: 20px;" id="abas">

                    <br>
                    <br>
                    <button type="button" class="btn btn btn-sm text-light w-100" style="background: #00063f; border-radius: 20px;">
                        <a rel="abas" class="btn btn" itens="NOTIFICAÇÃO" role="button" style=" border-radius: 20px;">NOTIFICAÇÃO</a>
                    </button><br><br>
                    <button type="button" class="btn btn btn-sm text-light w-100" style="background: #00063f; border-radius: 20px;">
                        <a rel="abas" class="btn btn me-2" itens="COMPORTAMENTO">COMPORTAMENTO</a></button><br><br>
                    <button type="button" class="btn btn btn-sm text-light w-100" style="background: #00063f; border-radius: 20px;">
                        <a rel="abas" href="home.php?acao=area-gestor" class="btn btn desempenho" itens="DESEMPENHO">DESEMPENHO</a>
                    </button><br><br>
                    <button type="button" class="btn btn btn-sm text-light w-100" style="background: #00063f; border-radius: 20px;">
                        <a rel="abas" href="home.php?acao=area-gestor-frequencia" class="btn btn" itens="FREQUÊNCIA">FREQUÊNCIA</a>
                    </button><br><br>
                    <button type="button" class="btn btn btn-sm text-light w-100" style="background: #00063f; border-radius: 20px;">
                        <a rel="abas" class="btn btn" itens="PERMUTA">PERMUTA</a>
                    </button><br><br>
                </div>
                <div class="col-md-9 ml-5">

                    <div class="col-4 bg-light" id="conteudo" style="color:#73c054; border-radius: 20px;">

                    </div>

                    <div class="col-md-12 md-6" style="background-color:#00063f; border-radius: 20px; height: auto;">

                        <div class="col-md-9 md-5 selecionar-tipo-visualizacoes" style="display: none;">

                        </div>

                        <div class="row mt-3 p-3">
                            <h1 style="color: #73c054;">Frequência dos Acadêmicos</h1>

                            <form method="GET" action="visualizar_frequencia.php">
                                <div class="form-group">
                                    <label for="academico">Selecione um acadêmico:</label>
                                    <select class="form-control" name="academico" id="academico">
                                        <option value="todos">Todos</option>
                                        <?php

                                        $queryAcademicos = "SELECT * FROM academico";

                                        // Executa a query de acadêmicos
                                        $resultadoAcademicos = mysqli_query($conexao, $queryAcademicos);

                                        // Itera sobre os resultados para criar as opções do select
                                        while ($row = $resultadoAcademicos->fetch_assoc()) {
                                            $nomeAcademico = $row['nome_acad'];
                                            echo "<option value=\"$nomeAcademico\">$nomeAcademico</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Visualizar</button>
                            </form>

                            <div class="frequencia-academicos">
                                <?php
                                $filtroAcademico = $_GET['academico'];

                                $queryFrequencia = "SELECT * FROM tabela_frequencia";

                                if ($filtroAcademico !== 'todos') {
                                    $filtroAcademico = mysqli_real_escape_string($conexao, $filtroAcademico);
                                    $queryFrequencia .= " WHERE nome = '$filtroAcademico'";
                                }

                                $resultadoFrequencia = mysqli_query($conexao, $queryFrequencia);

                                // Verifica se houve algum resultado
                                if (mysqli_num_rows($resultadoFrequencia) > 0) {
                                    while ($row = $resultadoFrequencia->fetch_assoc()) {
                                        $nomeAcademico = $row['nome'];
                                        $frequencia = $row['frequencia'];
                                        $documentoAssinado = $row['documento_assinado'];

                                        // Exibir as informações da frequência do acadêmico
                                        echo "<div class=\"academico-frequencia\">";
                                        echo "<h3>$nomeAcademico</h3>";
                                        echo "<p>Frequência: $frequencia</p>";
                                        echo "<a href=\"$documentoAssinado\">Documento Assinado</a>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "Nenhum resultado encontrado.";
                                }
                                ?>
                            </div>


                            <div class="col-3 mt-5"></div>
                        </div>
                    </div>
                    <?php include 'footer.php'; ?>
                </div>
            </div>
            <script src="assets/js/jquery-3.6.4.min.js"></script>
            <script src="assets/js/vendor.min.js"></script>
            <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
            <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
            <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
            <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
            <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
            <script src="assets/libs/datatables/buttons.html5.min.js"></script>
            <script src="assets/libs/datatables/buttons.flash.min.js"></script>
            <script src="assets/libs/datatables/buttons.print.min.js"></script>
            <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
            <script src="assets/libs/datatables/dataTables.select.min.js"></script>
            <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
            <script src="assets/libs/pdfmake/vfs_fonts.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Datatables init -->
            <script src="assets/js/pages/datatables.init.js"></script>

            <!-- App js -->
            <script src="assets/js/app.min.js"></script>

            <script type="text/javascript">
                /*$ significa que ajax o rel=abas esta vindo html on e onde click e o evento attr e o nome do atributo vindo do html e tenho que utilizar o this para pegar o atributo que está dentro html*/
                $("a[rel=abas]").on('click', function() {
                    var dadosLink = $(this).attr('itens');
                })
            </script>


            </body>

            </html>