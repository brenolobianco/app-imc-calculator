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
   // tu fez um sistema de aba, certo ? fiz so que ajuste, certo.
?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 mx-4" style="background-color:#d7d8dd; height:850px; border-radius: 20px;" id="abas">

                    <br>
                    <br>
                    <?php if ($perm->Area_Gestor_Notificacao) { ?>
                        <button type="button" class="btn btn btn-sm text-light w-75" style="background: #00063f; border-radius: 20px;">
                            <a rel="abas" class="btn btn" itens="NOTIFICAÇÃO" role="button" style=" border-radius: 20px;">NOTIFICAÇÃO</a>
                        </button><br><br>
                    <?php }
                    if ($perm->Area_Gestor_Comportamento) { ?>
                        <button type="button" class="btn btn btn-sm text-light w-75" style="background: #00063f; border-radius: 20px;">
                            <a rel="abas" class="btn btn me-2" itens="COMPORTAMENTO">COMPORTAMENTO</a></button><br><br>
                    <?php }
                    if ($perm->Area_Gestor_Desempenho) { ?>
                        <button type="button" class="btn btn btn-sm text-light w-75" style="background: #00063f; border-radius: 20px;">
                            <a rel="abas" class="btn btn" itens="DESEMPENHO">DESEMPENHO</a>
                        </button><br><br>
                    <?php }
                    if ($perm->Area_Gestor_Frequencia) { ?>
                        <button type="button" class="btn btn btn-sm text-light w-75" style="background: #00063f; border-radius: 20px;">
                            <a rel="abas" class="btn btn" itens="FREQUÊNCIA">FREQUÊNCIA</a>
                        </button><br><br>
                    <?php }
                    if ($perm->Area_Gestor_Permutas) { ?>
                        <button type="button" class="btn btn btn-sm text-light w-75" style="background: #00063f; border-radius: 20px;">
                            <a rel="abas" class="btn btn" itens="PERMUTA">PERMUTA</a>
                        </button><br><br>
                    <?php } ?>
                </div>
                <div class="col-md-8">
                    <div class="col-4 bg-light" id="conteudo" style="color:#73c054; border-radius: 20px;">
                    </div>
                    <div class="col-md-12 md-5" style="background-color:#00063f; border-radius: 20px; height: auto;">
                        <div class="row ">

                            <div class="col-12" style="height:850px">
                                <div class="row justify-content-end" style="height:max-content">
                                    <div class="col-12">
                                        <?php include_once 'controllers/professor/ControllerDelete.php'; ?>
                                    </div>
                                    <div class="col-5 justify-content-end mt-2">
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
                                  <!--
                                <hr size="20" width="70%">
                           
                                <hr size="20" width="95%" style="height:100vh;
                                        width:.5vw;
                                        border-width:0;
                                        color:#FFFFFF;
                                        background-color:#FFFFFF;
                                        margin-right:90px;
                                        height:800px;">
                                        
                             
                               
                                <hr size="50" width="70%">
                    -->
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

<!-- Datatables init -->
<script src="assets/js/pages/datatables.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

<script type="text/javascript">
    /*$ significa que ajax o rel=abas esta vindo html on e onde click e o evento attr e o nome do atributo vindo do html e tenho que utilizar o this para pegar o atributo que está dentro html*/
    $("a[rel=abas]").on('click', function() {
        var dadosLink = $(this).attr('itens');

        $.ajax({
            url: 'https://localhost/area-restrita/views/areaGestor/pegaDados.php',
            method: 'POST',
            data: {
                dados: dadosLink
            },
            success: function(data) {
                $("#conteudo").html(data);
            },
            error: function(data) {
                $("#conteudo").html(data);
            }
        });
    })
</script>

</body>

</html>