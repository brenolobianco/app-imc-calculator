<div class="content-page">
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <?php include_once 'controllers/medico/ControllerSelect.php'; ?>
                </div>
                <div class="col-sm-12">
                    <div class="bg-picture card-box">
                        <div class="profile-info-name">
                            <img src="assets/images/users/user.png" class="rounded-circle avatar-xl img-thumbnail float-left mr-3" alt="profile-image">

                            <div class="profile-info-detail overflow-hidden">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="m-0"><?= $nome_med; ?></h4>
                                        <p class="text-muted"><i>Médico</i></p>
                                        <p class="font-16">
                                            ID: <strong><?= $id_med; ?></strong><br />
                                            Email: <strong><?= $email_med; ?></strong><br />
                                            CPF: <strong><?= $cpf_med; ?></strong><br />
                                            Data: <strong><?= $data_nasc_med; ?></strong><br />
                                            Ano formação: <strong><?= $ano_formacao_med; ?></strong><br />
                                            Estado de Atuação: <strong><?= $estado_atuacao_med; ?></strong><br>
                                            Nº CRM: <strong><?= $numero_crm_med; ?></strong><br />
                                            Especialidade: <strong><?= $especialidade_med; ?></strong><br />
                                            Lattes: <strong><?= $link_cv_lates_med; ?></strong><br />
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="bg-picture card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="m-0">Questionário</h4>
                                <p class="text-muted"><i>Respostas:</i></p>
                                <?= carregarQuestoes($conexao, $id_med); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ul class="list-group mb-0 user-list">
                        <li class="list-group-item">
                            <a href="<?= $link_cv_lates_med; ?>" target="_blank" class="btn btn-primary" style="width: 100%;">Link Curriculo Lates</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>

<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>

</body>

</html>