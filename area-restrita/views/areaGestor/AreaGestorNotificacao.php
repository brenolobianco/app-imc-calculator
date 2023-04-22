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
    */ ?>

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
</style>


<?php
    include_once 'area-restrita/controllers/areaGestor/dados/ControllerDados.php';
    include_once 'area-restrita/controllers/areaGestor/dados/Dados.php';
?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 mx-4" col-mb-5>
                    <button type="button" class="btn btn btn-lg text-light" style="background: #00063f; border-radius: 20px;">
                        <a class="btn btn" href="area-restrita/AreaGestorNotificacao.php" target="_blank" role="button" style=" border-radius: 20px;">NOTIFICAÇÃO</a>
                    </button><br><br>

                    <button type="button" class="btn btn btn-lg text-light" style="background: #00063f; border-radius: 20px;">
                        <a class="btn btn me-2" href="area-restrita/AreaGestorComportamento.php" target="_blank">COMPORTAMENTO</a></button><br><br>

                    <button type="button" class="btn btn btn-lg text-light desempenho" style="background: #00063f; border-radius: 20px;">
                        <a class="btn btn">DESEMPENHO</a>
                    </button><br><br>

                    <button type="button" class="btn btn btn-lg text-light" style="background: #00063f; border-radius: 20px;">
                        <a class="btn btn" href="area-restrita/AreaGestorFrequencia.php" target="_blank">FREQUÊNCIA</a>
                    </button><br><br>

                    <button type="button" class="btn btn btn-lg text-light" style="background: #00063f; border-radius: 20px;">
                        <a class="btn btn" href="area-restrita/AreaGestorPermutas.php" target="_blank">PERMUTA</a>
                    </button><br><br>
                </div>

                <div class="col-md-9 md-5" style="background-color:#00063f; border-radius: 20px;">
                    <button type="button" class="btn btn btn-lg titulo" style="color:#73c054;">NOTIFICAÇÃO</button><br><br>
                    <div class="col-md-9 md-5 selecionar-tipo-visualizacoes" style="display: none;">
                        <select class="btn btn btn-lg selecionar-tipo-visualizacoes selecionar-hospital">
                            <option value="">Selecione o hospital</option>
                            <option value="">Todos</option>
                            <?php
                                $select = "SELECT * FROM hospital";  
                                try{
                                    $result = $conexao->prepare($select);
                                    $result ->execute();
                                    $contar = $result->rowCount();

                                    if($contar>0){
                                    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                    ?>
                                       <option value="<?= $mostra->id_hosp ?>"><?= $mostra->nome_hosp ?></option>
                                    <?php
                                    }
                                    }
                                }
                                catch(PDOException $e){
                                    echo "<b>ERRO DE PDO= </b>".$e->getMessage();
                                }
                                ?>
                        </select>
                    </div>
                    <div class="container">

                        <div class="row justify-content-end">

                            <div class="col-12">
                                <?php include_once 'controllers/professor/ControllerDelete.php'; ?>
                            </div>

                            <div class="col-5 justify-content-end">

                                <div class="col-mb-5 justify-content-end justify-content-end">
                                    <label class="sr-only align-bottom float-end" for="inlineFormInputGroup">Pesquisar</label>
                                    <div class="input-group mb-2 justify-content-center">
                                        <input type="text" class="form-control justify-content-center " id="inlineFormInputGroup" placeholder="Pesquisar">
                                        <div class="input-group-prepend justify-content-center ">
                                            <div class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
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

                        <div class="col-12" >
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

                                    <tbody>
                                        <?php include_once 'controllers/areaGestor/ControllerIndex.php'; ?>
                                    </tbody>

                                </table>
                            </div>

                            <div class="p-5 selecionar-tipo-visualizacoes" style="display: none;" >
                                <div class="row col-md-12 justify-content-center align-items-center">
                                    <div class="btn-img justify-content-center align-items-center mr-2" style="cursor: pointer; border-radius: 5px 5px 5px;">
                                        <div class="img" onclick="nextContent({name: 'selecionar-tipo-visualizacoes', type:'class'}, {name:'selecionar-categoria-cadastro', type:'class'})" style="max-width: 200px; max-height: 200px;">
                                            <div class="btn-titulo text-center mt-2">
                                            <figure class="selecionar-tipo-visualizacoes" style="max-width: 200px; max-height: 200px;">
                                                <img src="/assets/images/estagio-518x518.jpg" class="img-selecionar-tipo-dado" style="max-width: 256; max-height: 200px;"/>  
                                                <figcaption>Coletivo  </figcaption>
                                            </figure>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-img justify-content-center align-items-center mr-2" style="cursor: pointer; border-radius: 5px 5px 5px;">
                                        <div class="img" style="max-width: 200px; max-height: 200px;" onclick="nextContent({name: 'selecionar-tipo-visualizacoes', type:'class'}, {name:'selecionar-usuario-individual', type:'class'})">
                                            <div class="btn-titulo text-center mt-2">
                                            <figure class="selecionar-tipo-visualizacoes" style="max-width: 200px; max-height: 200px;">
                                                <img src="/assets/images/estagio-518x518.jpg" class="img-selecionar-tipo-dado" style="max-width: 256; max-height: 200px;"/>  
                                                <figcaption>Individual</figcaption>
                                            </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--- Selecionar categoria do cadastrados -->
                            <div class="p-5 selecionar-categoria-cadastro" style="display: none;" >
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
                            <div class="mt-3 selecionar-usuario-individual col-md-12 col-md-12" style="display: none;">
                                <div class="card-box col-md-12 w-100">
                                    <h4 class="mt-0 header-title">Desempenho</h4>
                                    <hr />
                                    <table class="table table-bordered dt-responsive nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Função</th>
                                                <th>Ranking geral(avaliações)</th>
                                                <th style="text-align: right;">Análise de desempenho</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            
                                            <tr>
                                                <td>Mateus</td>
                                                <td>Acadêmico</td>
                                                <td>1º</td>
                                                <td style="text-align: center;">
                                                    <button onclick="nextContent({name: 'selecionar-usuario-individual', type: 'class'}, {name: 'dados-usuario-individual', type: 'class'})" class="btn btn-primary btn-sm" style="border-radius: 5px 5px 5px;">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>João da Silva</td>
                                                <td>Acadêmico</td>
                                                <td>2º</td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-primary btn-sm" style="border-radius: 5px 5px 5px;">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="card-box mt-3 dados-usuario-individual col-md-12 col-md-12" style="display: none;">
                                <div class="chart-pre-teste col-md-6">
                                    <canvas class="chart-pre-teste">

                                    </canvas>
                                </div class="chart-pre-teste">
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
<script>

    let btnDesempenho = document.querySelector('.btn.desempenho');
    let titulo = document.querySelector('.titulo');
    let selecionarHospital = document.querySelector('.selecionar-hospital');

    // Obtenha a referência ao elemento canvas
    var ctx = document.querySelector('canvas.chart-pre-teste').getContext('2d');

    var dataRes = [];

    const data = {
        datasets: [{
            label: 'Pré-teste',
            data: [],
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

        }
    ],

    labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setempro', 'Outubro', 'Novembro', 'Dezembro'],
    
    };

    var myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
        responsive: true,
    }
    
});


    function initDesepeneho() {
        hideContent('selecionar-tipo-visualizacoes', 'class');
        hideContent('selecionar-categoria-cadastro', 'class');
        hideContent('selecionar-usuario-individual', 'class');
    }


    btnDesempenho.addEventListener('click', function() {
        initDesepeneho();

        nextContent({name: 'usuariosCadastrados', type: "id"}, {name: 'selecionar-tipo-visualizacoes', type: "class"});
        
        titulo.innerHTML = 'DESEMPENHO';
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
    
    function showContent(id, type='id') {
        if(type == 'class') {
            var element = document.getElementsByClassName(id);
            for(var i = 0; i < element.length; i++) {
                element[i].style.display = 'block';
            }
        } else {
            var element = document.getElementById(id);
            element.style.display = 'block';
        }
    }

    function hideContent(id, type='id') {
        if(type == 'class') {
            var element = document.getElementsByClassName(id);
            for(var i = 0; i < element.length; i++) {
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
    
</script>

<script>
    $(document).ready(function() {
        $('.datatable').DataTable();
    } );
</script>
</body>

</html>


