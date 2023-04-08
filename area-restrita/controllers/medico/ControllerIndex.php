<?php

function carregarMedicos($conexao)
{
    $select = "SELECT * from medico order by nome_med asc";
    $return_html = '';
    try {
        $result = $conexao->prepare($select);
        $result->execute();
        $contar = $result->rowCount();

        if ($contar > 0) {
            while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
                $return_html .=
                    "<tr>
                        <td>$mostra->nome_med</td>
                        <td>$mostra->cpf_med</td>
                        <td>$mostra->numero_crm_med</td>
                        <td>
                            <a href='home.php?acao=medico&id_med=$mostra->id_med' class='btn btn-icon waves-effect waves-light btn-primary'> <i class='fa fa-eye'></i> </a>
                            <a href='home.php?acao=medicos&delete=$mostra->id_med' class='btn btn-icon waves-effect waves-light btn-danger'> &nbsp;<i class='fas fa-times'></i>&nbsp; </a>
                        </td>
                    </tr>";
            }
        } else {
            echo ' <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Nada Cadastrado!!!</strong> 
            </div>';
        }
    } catch (PDOException $e) {
        echo $e;
    }

    return $return_html;
}
