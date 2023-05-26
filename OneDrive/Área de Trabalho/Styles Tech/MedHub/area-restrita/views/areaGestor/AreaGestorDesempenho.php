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
<link
    href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap"
    rel="stylesheet"
/>
    

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

section.ranking tr:nth-child(1) {
}

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
                            <a rel="abas" class="btn btn desempenho" itens="DESEMPENHO">DESEMPENHO</a>
                        </button><br><br>
                        <button type="button" class="btn btn btn-sm text-light w-100" style="background: #00063f; border-radius: 20px;">
                            <a rel="abas" class="btn btn" itens="FREQUÊNCIA">FREQUÊNCIA</a>
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
                            <select class="btn btn btn-lg selecionar-tipo-visualizacoes selecionar-hospital">
                                <option value="">Todos</option>
                                <?php
                                $select = "SELECT * FROM hospital";
                                try {
                                    $result = $conexao->prepare($select);
                                    $result->execute();
                                    $contar = $result->rowCount();

                                    if ($contar > 0) {
                                        while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
                                ?>
                                            <option value="<?= $mostra->id_hosp ?>"><?= $mostra->nome_hosp ?></option>
                                <?php
                                        }
                                    }
                                } catch (PDOException $e) {
                                    echo "<b>ERRO DE PDO= </b>" . $e->getMessage();
                                }
                                ?>
                            </select>
                        </div>
                    
                    <div class="row mt-3 p-3">

                        <div class="col-12">
                            <div class="card-box" id="usuariosCadastrados">
                                <h4 class="mt-0 header-title">Usuários Cadastrados</h4>
                                <hr />
                                <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nome</th>
                                            <th>Usuário</th>
                                            <th>Permissões</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <!--
                                    <tbody>
                                        <?php // Robério, quando estiver tudo certo, descomente isto. include_once 'controllers/areaGestor/ControllerIndex.php'; ?>
                                    </tbody>
                                    --->
                                </table>
                            </div>


                            <div class="p-5 selecionar-tipo-visualizacoes" style="display: none;">
                                <div class="row col-md-12 justify-content-center align-items-center">
                                    <div class="btn-img justify-content-center align-items-center mr-2 btn-ver-coletivo" style="cursor: pointer; border-radius: 5px 5px 5px;">
                                        <div class="img" style="max-width: 200px; max-height: 200px;">
                                            <div class="btn-titulo text-center mt-2">
                                                <figure class="selecionar-tipo-visualizacoes" style="max-width: 200px; max-height: 200px;">
                                                    <img src="/assets/images/estagio-518x518.jpg" class="img-selecionar-tipo-dado" style="max-width: 256; max-height: 200px;" />
                                                    <figcaption>Coletivo </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-img justify-content-center align-items-center mr-2 btn-ver-individual" style="cursor: pointer; border-radius: 5px 5px 5px;">
                                        <div class="img" style="max-width: 200px; max-height: 200px;">
                                            <div class="btn-titulo text-center mt-2">
                                                <figure class="selecionar-tipo-visualizacoes" style="max-width: 200px; max-height: 200px;">
                                                    <img src="/assets/images/estagio-518x518.jpg" class="img-selecionar-tipo-dado" style="max-width: 256; max-height: 200px;" />
                                                    <figcaption>Individual</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--- Selecionar categoria do cadastrados -->
                            <div class="p-5 selecionar-categoria-cadastro" style="display: none;">
                                <div class="text-center col-md-12 justify-content-center align-items-center">
                                    <div class="buttons">
                                        <div class="button mb-2">
                                            <button class="btn-basic">
                                                TODOS
                                            </button>
                                        </div>

                                        <div class="button mt-1">
                                            <button class="btn-basic">
                                                ACADÊMICOS
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- Selecionar categoria do cadastrados -->
                            <div class="mt-3 selecionar-usuario-individual col-md-12" style="display: none;">
                                <div class="card-box col-md-12 w-100">
                                    <h4 class="mt-0 header-title">Desempenho</h4>
                                    <hr />
                                    <table id="tableUsuarioIndividual" class="table table-bordered dt-responsive nowrap col-md-12">
                                        <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Função</th>
                                                <th>Ranking geral(avaliações)</th>
                                                <th style="text-align: right;">Análise de desempenho</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                    
                                        <!--- Carregando --->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-box mt-3 dados-usuario-coletivo w-100 " style="display: none;">
                                <div class="button row d-block">
                                    <button class="print btn btn-dark print mb-3 float-none col-md-2" onclick="window.print();">
                                        <span> <i class="fa fa-print" aria-hidden="true"></i> Imprimir </span>
                                    </button>

                                    <button class="print btn btn-dark print mb-3 float-right col-md-2" onclick="window.print();">
                                        <span> <i class="fa fa-download" aria-hidden="true"></i> Download </span>
                                    </button>
                                </div>
                                <section class="ranking w-100">
                                    <div id="header">
                                        <h1>Ranking - Quiz(Quantidade de acertos)</h1>
                                        <button class="share">
                                        <i class="ph ph-share-network"></i>
                                        </button>
                                    </div>
                                    <div id="leaderboard">
                                        <table id="rankingQuizColetivo" class="table table-bordered dt-responsive nowrap col-md-12">
                                        <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Pontos</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        </tbody>

                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>


                        <div class="card-box mt-3 dados-usuario-individual col-md-12 col-md-12 pb-5 pt-5" style="display: none;">
                                <div class="button row d-block">
                                    <button class="print btn btn-dark print mb-3 float-none col-md-2" onclick="window.print();">
                                        <span> <i class="fa fa-print" aria-hidden="true"></i> Imprimir </span>
                                    </button>

                                    <button class="print btn btn-dark print mb-3 float-right col-md-2" onclick="window.print();">
                                        <span> <i class="fa fa-download" aria-hidden="true"></i> Download </span>
                                    </button>
                                </div>
                                <div class="col-md-12 col-sm-12 pt-5">

                                    <div class="chart-pre-teste col-md-12">
                                        <div class="col-md-12">
                                            <canvas class="chart-pre-teste w-100" >

                                            </canvas>
                                        </div>

                                        <div class="col-md-12">

                                            <div class="roboto row">
                                                <div class="col">
                                                    <p>Média nota pré-teste: <span class="media-nota-pre-teste"></p></h4>
                                                    <p>Pré-teste com maior nota: <span class="maior-nota-pre-teste"></p></h4>
                                                    <p>Pré-teste com menor nota: <span class="menor-nota-pre-teste"></p></h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="split-line mt-5">
                                    </div>

                                    <div class="chart-quiz col-md-12">
                                        <div class="col-md-12">
                                            <canvas class="chart-quiz">

                                            </canvas>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="roboto row">
                                                <div class="col w-100 aulas">

                                                    <!-- INICIO AULA --->
                                                    <!-- FIM AULA --->
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col">
                                                    
                                                    <h3>Média Quiz: 0</h3>
                                                    <h3>Quiz com maior nota: 0</h3>
                                                    <h3>Quiz com menor nota: 0</h3>
                                                    <h3>Ranking geral: 1° de 14</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="avaliacoes col-md-12 mb-5 mt-3">
                                        <div class="col-md-12">
                                            <canvas class="chart-avaliacao">

                                            </canvas>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="roboto row">
                                                <div class="col w-100 aulas">

                                                    <!-- INICIO AULA --->
                                                    <!-- FIM AULA --->
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col">
                                                    
                                                    <h3>Média avaliação: 0</h3>
                                                    <h3>avaliação com maior nota: 0</h3>
                                                    <h3>avaliação com menor nota: 0</h3>
                                                    <h3>Ranking geral: 1° de 14</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>


                        </div>
                    </div>
                </div>
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

<script>
    let btnDesempenho = document.querySelector('.btn.desempenho');
    let titulo = document.querySelector('.titulo');
    let selecionarHospital = document.querySelector('.selecionar-hospital');
    let verDadosIndividual = document.querySelector('.dados-usuario-individual');



    function initDesepeneho() {
        hideContent('selecionar-tipo-visualizacoes', 'class');
        hideContent('selecionar-categoria-cadastro', 'class');
        hideContent('selecionar-usuario-individual', 'class');
        hideContent('dados-usuario-individual', 'class');
        hideContent('dados-usuario-coletivo', 'class');
    }


    btnDesempenho.addEventListener('click', function() {
        initDesepeneho();

        nextContent({
            name: 'usuariosCadastrados',
            type: "id"
        }, {
            name: 'selecionar-tipo-visualizacoes',
            type: "class"
        });

        // titulo.innerHTML = 'DESEMPENHO';
    });

    selecionarHospital.addEventListener('change', function() {
        let seleted = this.options[this.selectedIndex].value;
        // id selecionado
        sessionStorage.setItem('hospital', seleted);
    });


    function nextContent(from, to) {
        hideContent(from.name, from.type);
        showContent(to.name, to.type);
    }

    function showContent(id, type = 'id') {
        if (type == 'class') {
            var element = document.getElementsByClassName(id);
            for (var i = 0; i < element.length; i++) {
                element[i].style.display = 'block';
            }
        } else {
            var element = document.getElementById(id);
            element.style.display = 'block';
        }
    }

    function hideContent(id, type = 'id') {
        if (type == 'class') {
            var element = document.getElementsByClassName(id);
            for (var i = 0; i < element.length; i++) {
                element[i].style.display = 'none';
            }
        } else {
            var element = document.getElementById(id);
            element.style.display = 'none';
        }
    }

    function backContent(from, to) {
        var to = document.getElementById(to);
        var from = document.getElementById(from);
        to.style.display = 'block';
        from.style.display = 'none';
    }

    function getHospitalSession() {
        let hospital = sessionStorage.getItem('hospital');
        if (hospital == null) {
            return "";
        } else {
            return hospital;
        }
    }

    let btnVerIndividual = document.querySelector('.btn-ver-individual');
    btnVerIndividual.addEventListener('click', function() {
        nextContent({name: 'selecionar-tipo-visualizacoes', type:'class'}, {name:'selecionar-usuario-individual', type:'class'})

        mostrarIndividualHospital();
    });

    let btnVerColetivo = document.querySelector('.btn-ver-coletivo');
    btnVerColetivo.addEventListener('click', function() {
        nextContent({name: 'selecionar-tipo-visualizacoes', type:'class'}, {name:'dados-usuario-coletivo', type:'class'});
    });


    function mostrarIndividualHospital() {
        let xml = new XMLHttpRequest();
        xml.open('GET', './controllers/areaGestor/dados/Dados.php?acao=listar-academicos-hospital&hospital=' + getHospitalSession(), true);
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let table = $('#tableUsuarioIndividual').DataTable(
                    {
                        "language": {
                            "lengthMenu": "Mostrando _MENU_ registros por página",
                            "zeroRecords": "Nada encontrado",
                            "info": "Mostrando página _PAGE_ de _PAGES_",
                            "infoEmpty": "Nenhum registro disponível",
                            "infoFiltered": "(filtrado de _MAX_ registros no total)"
                        },
                        retrieve: true,
                    }
                );
                table.clear().draw();

                let data = JSON.parse(this.responseText);

                data.forEach(element => {
                    let tableHtml = '<button onclick="mostrarDadosIndividual(this)" data-id-usuario="'+ element.id_acad +'" class="btn btn-primary btn-sm ver-dado-individual-usuario" style="border-radius: 5px 5px 5px;"><i class="mdi mdi-eye"></i></button>';

                    table.row.add([diminuirNome(element.nome_acad), "", "", tableHtml]).draw();
                });
            }
        }

        xml.send();
    }


    function tableRankingQuizColetivo() {
        let xml = new XMLHttpRequest();
        xml.open('GET', './controllers/areaGestor/dados/Dados.php?acao=listar-academicos-hospital&hospital=' + getHospitalSession(), true);
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let table = $('#rankingQuizColetivo').DataTable(
                    {
                        "language": {
                            "lengthMenu": "Mostrando _MENU_ registros por página",
                            "zeroRecords": "Nada encontrado",
                            "info": "Mostrando página _PAGE_ de _PAGES_",
                            "infoEmpty": "Nenhum registro disponível",
                            "infoFiltered": "(filtrado de _MAX_ registros no total)"
                        },
                        pageLength: 4,
                        retrieve: true,
                        searching: false,
                        info:false,
                        bInfo:false,
                        order: [],
                        columnDefs: [
                            {
                                targets: [0],
                                className: 'number',
                            }
                        ]
                    }
                    
                );
                table.clear().draw();

                let data = JSON.parse(this.responseText);
                let first = 1;
                let index = 0;
                data.forEach(element => {
                    index += 1;
                    if(index == 1) {
                        table.row.add([1, diminuirNome(element.nome_acad) + ' | Pontos: 15  <img class="gold-medal" src="https://github.com/malunaridev/Challenges-iCodeThis/blob/master/4-leaderboard/assets/gold-medal.png?raw=true" alt="gold medal"/>']).draw();
                        return;
                    }

                    table.row.add([index, diminuirNome(element.nome_acad) + ' | Pontos: 13']).draw();
                });
            }
        }


        xml.send();
    }



    function buscarDadosIndividual(id) {
        return new Promise ((resolve, reject) => {
            let xml = new XMLHttpRequest();
            xml.open('GET', './controllers/areaGestor/dados/Dados.php?acao=mostrar-dado-individual&academico=' + id, true);
            xml.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let data = JSON.parse(this.responseText);
                    resolve(data);
                }
            }

            xml.send();
        });
    }

    function cadaQuestaoErradaQuiz() {

    }

    function mostrarDadosIndividual(element) {
        console.log(element);
        let dataIdUsuario = element.getAttribute('data-id-usuario');
        nextContent({name: 'selecionar-usuario-individual', type:'class'}, {name:'dados-usuario-individual', type:'class'})

        // Obtenha a referência ao elemento canvas

        buscarDadosIndividual(dataIdUsuario).then( (data) => {
            console.log(data);
            var ctx1 = document.querySelector('canvas.chart-pre-teste').getContext('2d'); // pre-teste
            var ctx2 = document.querySelector('canvas.chart-quiz').getContext('2d'); // chart quiz
            var ctx3 = document.querySelector('canvas.chart-avaliacao').getContext('2d'); // chart quiz
            let mediaPreTeste = document.querySelector('.media-nota-pre-teste'); 
            let preTesteMaiorNota = document.querySelector('.maior-nota-pre-teste');
            let menor = document.querySelector('.menor-nota-pre-teste');
            let mediaQuiz = document.querySelector('.media-quiz');
            let mediaAvaliacao = document.querySelector('.media-avaliacao');
            // var ctx3 = document.querySelector('canvas.chart-avaliacao').getContext('2d');

            mediaPreTeste.innerHTML = "" + data.resultado.quiz.media;
            preTesteMaiorNota.innerHTML = "" + data.resultado.pre_teste.maior_nota;
            menor.innerHTML = "" + data.resultado.pre_teste.menor_nota;
            let preTesteG = tratarDadosPreTeste(data.resultado); // Grafico do pré-teste
            let quizG = tratarDadosQuiz(data.resultado);  // Gráfico do Quiz
            
            // let avaliacaoG = tratarDadosAvaliacao(data.resultado); // Grafico da Avaliação
            // console.log(preTesteG);

            let dataGraficoPreTeste = {
                datasets: [{
                    label: 'Pré-teste',
                    data: preTesteG,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    // adicionar informação ao ponto
                    pointHoverRadius: 10,
                    pointHoverBackgroundColor: 'rgb(75, 192, 192)',
                    pointHoverBorderColor: 'rgb(75, 192, 192)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    lineColor: 'rgb(30, 144, 255)',

                }],

                labels: [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setempro',
                    'Outubro', 'Novembro', 'Dezembro'
                ],
            };

            let dataGraficoQuiz = {
                datasets: [{
                    label: 'Quiz',
                    data: quizG,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    // adicionar informação ao ponto
                    pointHoverRadius: 10,
                    pointHoverBackgroundColor: 'rgb(75, 192, 192)',
                    pointHoverBorderColor: 'rgb(75, 192, 192)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    lineColor: 'rgb(30, 144, 255)',

                }],

                labels: [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setempro',
                    'Outubro', 'Novembro', 'Dezembro'
                ],
            };

            let dataGraficoAvaliacao = {
                datasets: [{
                    label: 'Avaliação',
                    data: quizG, // data no gráfico
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    // adicionar informação ao ponto
                    pointHoverRadius: 10,
                    pointHoverBackgroundColor: 'rgb(75, 192, 192)',
                    pointHoverBorderColor: 'rgb(75, 192, 192)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    lineColor: 'rgb(30, 144, 255)',

                }],

                labels: [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setempro',
                    'Outubro', 'Novembro', 'Dezembro'
                ],
            };

            var preTesteChart = new Chart(ctx1, {
                type: 'line',
                data: dataGraficoPreTeste,
                options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Pré-teste'
                    }
                }
            },
            });

            var quizChart = new Chart(ctx2, {
                type: 'line',
                data: dataGraficoQuiz,
                options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Quiz'
                    }
                }
            },
            });

            var avaliacaoChart = new Chart(ctx3, {
                type: 'line',
                data: dataGraficoAvaliacao,
                options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Avaliação'
                    }
                }
            },
            });

            infoAulaIndividual(data.resultado);
        });


    }

    function tratarDadosPreTeste(res) {
        let janeiro = null;
        let fevereiro = null;
        let marco = null;
        let abril = null;
        let maio = null;
        let junho = null;
        let julho = null;
        let agosto = null;
        let setembro = null;
        let outubro = null;
        let novembro = null;
        let dezembro = null;

        let pontos = [];
        let resPontos = res.pre_teste.pontuacao;
        resPontos.forEach(element => {
            let dataRes = new Date(element.data);
            let mes = dataRes.getMonth() + 1;
            if(mes == 1) {
                janeiro += element.nota;
            } else if(mes == 2) {
                fevereiro += element.nota;
            } else if(mes == 3) {
                marco += element.nota;
            } else if(mes == 4) {
                abril += element.nota;
            } else if(mes == 5) {
                maio += element.nota;
            } else if(mes == 6) {
                junho += element.nota;
            } else if(mes == 7) {
                julho += element.nota;
            } else if(mes == 8) {
                agosto += element.nota;
            } else if(mes == 9) {
                setembro += element.nota;
            } else if(mes == 10) {
                outubro += element.nota;
            } else if(mes == 11) {
                novembro += element.nota;
            } else if(mes == 12) {
                dezembro += element.nota;
            }
        });


        return [janeiro, fevereiro, marco, abril, maio, junho, julho, agosto, setembro, outubro, novembro, dezembro];
    }

    function tratarDadosQuiz(res) {
        let janeiro = null;
        let fevereiro = null;
        let marco = null;
        let abril = null;
        let maio = null;
        let junho = null;
        let julho = null;
        let agosto = null;
        let setembro = null;
        let outubro = null;
        let novembro = null;
        let dezembro = null;

        let pontos = [];
        let resPontos = res.quiz.pontuacao.notas;
        resPontos.forEach(element => {
            let dataRes = new Date(element.data);
            let mes = dataRes.getMonth() + 1;
            let nota = parseInt(element.nota);
            let id 
            if(mes == 1) {
                janeiro += nota;
            } else if(mes == 2) {
                fevereiro += nota;
            } else if(mes == 3) {
                marco += nota;
            } else if(mes == 4) {
                abril += nota;
            } else if(mes == 5) {
                maio += nota;
            } else if(mes == 6) {
                junho += nota;
            } else if(mes == 7) {
                julho += nota;
            } else if(mes == 8) {
                agosto += nota;
            } else if(mes == 9) {
                setembro += nota;
            } else if(mes == 10) {
                outubro += nota;
            } else if(mes == 11) {
                novembro += nota;
            } else if(mes == 12) {
                dezembro += nota;
            }
        });

        pontos = [janeiro, fevereiro, marco, abril, maio, junho, julho, agosto, setembro, outubro, novembro, dezembro];
        return pontos;
    }


    function diminuirNome(nome) {
        if (nome.length > 30) {
            return nome.substring(0, 20) + '...';
        } else {
            return nome;
        }
    }

    function aulasIndividualSemDuplicadas(aulas) {
        // Objeto auxiliar para acompanhar os IDs das aulas já encontradas
        var aulasEncontradas = {};

        // Array final sem aulas duplicadas
        var aulasSemDuplicatas = [];

        // Percorre cada objeto do array original
        aulas.forEach(function(aula) {
        let idAula = aula.id_aula;
        
        // Verifica se o ID da aula já foi encontrado antes
        if (!aulasEncontradas[idAula]) {
            // Adiciona a aula ao array final
            aulasSemDuplicatas.push(aula);

            // Marca o ID da aula como encontrado
            aulasEncontradas[idAula] = true;
        }
        });

        // Exibe o resultado
        return aulasSemDuplicatas;
    }


    function infoAulaIndividual(resultado) {
        let questoesErradasQuiz = (resultado) => {

        }

        let html = function (resultado) {
            let aulas = resultado.quiz.pontuacao.notas;
            let semDuplicadas = aulasIndividualSemDuplicadas(aulas);
            semDuplicadas.forEach(element => {
            let id = element.id_aula;
            let nomeAula = element.nome_aula;
            
            let html = `
                <div class="aula">
                    <button class="btn btn-primary w-100 mt-1" type="button" data-toggle="collapse"  data-target="#aula` + id + `" aria-expanded="false" aria-controls="">`+ nomeAula +`</button>

                    <div class="collapse" id="aula`+ id +`">
                        <div class="card card-body">
                            
                            <div class="questoes-erradas quiz mb-3">
                                <h3>Questões erradas: </h3>
                            </div>
                            
                            <div> 
                                <h3>Informaçães sobre a aula</h3>
                                <ul>
                                    <span class="detalhes">
                                        <li>Esta aula teve a menor nota no quiz</li>
                                    </span>
                                    
                                    <li>Pontuacao nesta aula: <span class="pontuacao-quiz">0</span> </li>
                                    <li>Ranking do usuário nesta aula: <span class="ranking-quiz">NÃO INFORMADO</span> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                document.querySelector('.aulas').innerHTML += html;
            });
        }
        html(resultado)
    
    }



</script>

</body>

</html>