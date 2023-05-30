<?php


include 'controllers/log/logado.php'; 

$select = "SELECT * from m";  
try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

            if($mostra->m_m != '1'){
                echo 'MANUTENÇÃO';
                exit(0);
            }
        }
    }
} catch (Exception $e) {
    echo $e;
}

function preventToXSS($text) {
    $text = trim($text);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);
    return $text;
}

if(isset($_GET['acao'])) {

    $acao = $_GET['acao'];


    if(isset($_GET['id_aula'])) {
        // verificar se aula está disponível para o usuário

        $id_aula = $_GET['id_aula'];
        $id_vid = get_id_vid_by_aula($conexao, $id_aula);

        if(!pode_fazer($conexao, $idLog, $id_aula)) {
            header("Location: /home.php?acao=hospital&id_est=35");
        }


        $temPreTeste = tem_pre_teste($conexao, $id_vid, $idLog);
        if(!$temPreTeste) {
            salvar_pre_teste($conexao, $id_vid, $idLog);
        }



        if($acao == "get-pre-teste") {

            $autorizado = pode_fazer_pre_teste($idLog, $conexao, $id_aula); // verificar se o usuário pode fazer o pre-teste
            if($autorizado) {

                $select = "SELECT * FROM treinamento_pre_teste WHERE id_vid_aula = :id_vid_aula ORDER BY id_pre_teste";  
                try{
                    $result = $conexao->prepare($select);
                    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
                    $result ->execute();
                    $contar = $result->rowCount();
                    $json = ["success" => true];
                    $res = [];
                    
                    if($contar>0){
                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                            array_push($res, $mostra);
                        }
                    } else {
                        $json["success"] = false;
                    }

                    $json["result"] = $res;
                    
                    echo json_encode(array($json));
                } catch (Exception $e) {
                }
            }
        } elseif($acao == "get-quiz") {
            $pode_fazer = pode_fazer_quiz($conexao, $id_aula, $idLog);
            if($pode_fazer) {
                
                $select = "SELECT * FROM quiz_treinamento WHERE id_vid_aula = :id_vid_aula ORDER BY id_quiz";  
                try{
                    $result = $conexao->prepare($select);
                    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
                    $result ->execute();
                    $contar = $result->rowCount();
                    $json = ["success" => true];
                    $res = [];
                    
                    if($contar>0){
                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                            array_push($res, $mostra);
                        }
                    } else {
                        $json["success"] = false;
                    }

                    $json["result"] = $res;
                    
                    echo json_encode(array($json));
                } catch (Exception $e) {
                }
            }
        } elseif ($acao == "verificar-quiz") {
            if(isset($_GET['resposta']) && isset($_GET['id_quiz'])) {
                $id_resposta = $_GET['resposta'];
                
                $id_quiz = $_GET['id_quiz'];
                $select = "SELECT * FROM quiz_treinamento WHERE id_quiz = :id_quiz";  
                try{
                    $result = $conexao->prepare($select);
                    $result->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
                    $result ->execute();
                    $contar = $result->rowCount();
                    if($contar>0){
                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                            $alternativa_correta = $mostra->alternativa_correta;
                            $id_vid_aula = $mostra->id_vid_aula;
                            $finalizado = finalizado_quiz($conexao, $id_vid_aula, $idLog);
                            if($alternativa_correta == $id_resposta && !$finalizado) {
                                acertou_quiz($conexao, $idLog, $id_quiz, $id_resposta, $id_vid_aula);
                                echo json_encode(["sucesso" => true, "texto" => "Resposta Correta!", "id" => $id_quiz]);
                            } elseif(!$alternativa_correta == $id_resposta && !$finalizado) {
                                errou_quiz($conexao, $idLog, $id_quiz, $id_resposta, $id_vid_aula);
                                echo json_encode(["sucesso" => false, "texto" => "Resposta incorreta!", "id" => $id_quiz]);
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e;
                }
            }

        } elseif($acao == "nova-tentativa-quiz") {
            $count = nova_tentativa_quiz($conexao, $idLog, $id_aula);
            if($count >= 1) {
                echo json_encode(["success" => true, "text" => "Nova tentativa!"]);
            } else {
                echo json_encode(["success" => false, "text" => "Ocorreu um erro!"]);
            }
        } elseif($acao == "finalizar-quiz") {
            $aprovado = foi_aprovado_quiz($conexao, $idLog, $id_aula);
            $minima = get_nota_minima($conexao, $id_aula);
            $count = finalizar_quiz($conexao, $idLog, $id_aula, $aprovado);
            if($aprovado) {
                echo json_encode(["success" => true, "text" => "Finalizao!"]);
            } else {
                echo json_encode(["success" => false, "text" => "Você não foi aprovado! Você não atingiu a nota mínima de $minima%"]);
            }

        } elseif ($acao == "verificar-quiz-pre-teste") {
            if(isset($_GET['resposta']) && isset($_GET['id_quiz'])) {
                $id_resposta = $_GET['resposta'];
                
                $id_quiz = $_GET['id_quiz'];
                $select = "SELECT * FROM treinamento_pre_teste WHERE id_pre_teste = :id_quiz";  
                try{
                    $result = $conexao->prepare($select);
                    $result->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
                    $result ->execute();
                    $contar = $result->rowCount();
                    if($contar>0){
                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                            $alternativa_correta = $mostra->alternativa_correta;
                            $id_vid_aula = $mostra->id_vid_aula;
                            $finalizado = finalizado_pre_teste($conexao, $id_vid_aula, $idLog);
                            
                            if($alternativa_correta == $id_resposta && !$finalizado) {
                                acertou($conexao, $idLog, $id_quiz, $id_resposta, $id_vid_aula);
                                echo json_encode(["sucesso" => true, "texto" => "Resposta Correta!", "id" => $id_quiz]);
                            } elseif($alternativa_correta != $id_resposta && !$finalizado) {
                                errou($conexao, $idLog, $id_quiz, $id_resposta, $id_vid_aula);
                                echo json_encode(["sucesso" => false, "texto" => "Resposta incorreta!", "id" => $id_quiz]);
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e;
                }
            }
        } elseif($acao == "finalizar-pre-teste") {
            // $aprovado = foi_aprovado_pre_teste($conexao, $idLog, $id_aula);
            $aprovado = 1; //foi_aprovado_pre_teste($conexao, $idLog, $id_aula); // sempre será aprovado
            $count = finalizar_pre_teste($conexao, $idLog, $id_aula, $aprovado);
            if($count >= 1) {
                echo json_encode(["success" => true, "text" => "Finalizao!"]);
            } else {
                echo json_encode(["success" => false, "text" => "Ocorreu um erro!"]);
            }
        } elseif($acao == "info-situacao-aula") {
            $resp = [];
            $resp['pre_teste'] = fez_pre_teste_atual($conexao, $id_aula, $idLog); // se fez o pre-teste atual
            $resp['quiz'] = aprovado_quiz($conexao, $id_aula, $idLog);
            $resp['aula'] = assistiu_aula($conexao, $id_aula, $idLog);
            echo json_encode($resp);
        } elseif ($acao == "concluir-aula") {
            $concluida = concluir_aula($conexao, $id_aula, $idLog);
            if($concluida) {
                echo json_encode(["success" => true, "text" => "Aula concluída!"]);
            } else {
                echo json_encode(["success" => false, "text" => "Ocorreu um erro!"]);
            }
        } elseif($acao == "input-nota") {
            $nota = ($_GET['nota']);
            if($nota > 10) {
                echo json_encode(["success" => false, "text" => "Nota inválida!"]);
                exit(0);
            }

            $comentario = preventToXSS($_GET['comentario']);
            $id_aula = $_GET['id_aula'];
            $concluida = input_nota($conexao, $id_aula, $idLog, $nota, $comentario);
            if($concluida) {
                echo json_encode(["success" => true, "text" => "Nota inserida!"]);
            } else {
                echo json_encode(["success" => false, "text" => "Ocorreu um erro!"]);
            }
        } elseif($acao == "visualizar-pdf") {
            pdf_view($conexao, $idLog, $id_aula);
        }
    } 
}


function getPdf($conexao, $id_aula, $id_pdf) {
    $select = "SELECT * FROM aula_pdf WHERE aula_id_pdf = :id_aula AND id_pdf = :id_pdf ORDER BY id_pdf";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':id_pdf', $id_pdf, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function pdf_view($conexao, $id_usuario, $id_aula, $id_pdf = 0) {
    $pdf = getPdf($conexao, $id_aula, $id_pdf);
    $fetch = $pdf->fetch(PDO::FETCH_OBJ);
    $id_pdf = $fetch->id_pdf ?? 0;
    $arq_vid = $fetch->arq_pdf;
    header('Content-Type: text/html; charset=utf-8');
    $html = <<<HTML
    <!DOCTYPE html>
        <html>
        <head>
            <title>PDF.js</title>
            <!-- Incluir o CSS padrão do PDF.js -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf_viewer.css" />            
        </head>
        <body>
            <!-- Div onde o PDF será exibido -->
            <div id="pdf-container"></div>
            
            <!-- Incluir as bibliotecas do PDF.js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.js"></script>
            <script>
            // URL do arquivo PDF que será carregado
            const url = "/pdfs/$id_pdf/$arq_vid";

            // Inicializar a biblioteca PDF.js
            pdfjsLib.getDocument(url).promise.then(pdf => {
                // Obter o número de páginas do PDF
                const numPages = pdf.numPages;
                
                // Exibir a primeira página do PDF
                pdf.getPage(1).then(page => {
                // Definir a escala da página para 1.5
                const scale = 1.5;
                const viewport = page.getViewport({ scale: scale });

                // Criar um canvas para exibir a página
                const canvas = document.createElement('canvas');
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                canvas.style.display = 'block';
                const context = canvas.getContext('2d');

                // Renderizar a página no canvas
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);

                // Adicionar o canvas ao contêiner
                const container = document.getElementById('pdf-container');
                container.appendChild(canvas);
                });
            });
            </script>
        </body>
    </html>


    HTML;
    echo $html;
}

function input_nota($conexao, $id_aula, $idLog, $nota, $comentario) {
    $select = "INSERT INTO aula_treinamento_nota(id_usuario, id_aula, nota, comentario) VALUES (:id_usuario, :id_vid_aula, :nota, :comentario)";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idLog, PDO::PARAM_INT);
    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':nota', $nota, PDO::PARAM_INT);
    $result->bindParam(':comentario', $comentario, PDO::PARAM_STR);
    
    $result ->execute();
    $count = $result->rowCount();
    return $count;
}

function get_nota_minima($conexao, $id_aula) {
    $select = "SELECT taxa_acerto_quiz FROM aula WHERE id_aula = :id_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $count = $result->rowCount();
    if($count > 0) {
        $mostra = $result->FETCH(PDO::FETCH_OBJ);
        return $mostra->taxa_acerto_quiz;
    }
    return 0;
}

function nova_tentativa_quiz($conexao, $idLog, $id_aula) {
    $select = "INSERT INTO quiz_treinamento_num_erros (id_usuario, id_vid_aula, data_tentativa) VALUES (:id_usuario, :id_vid_aula, NOW())";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idLog, PDO::PARAM_INT);
    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $count = $result->rowCount();
    return $count;
}


function get_id_vid_by_aula($conexao, $id_aula) {
    $select = "SELECT *
    FROM aula_vid
    WHERE aula_id_vid = :id_vid_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $fetch = $result->FETCH(PDO::FETCH_OBJ);
    $id = $fetch->id_vid;
    return $id;
}


function ja_tentou($id, $conexao, $id_aula) {
    $select = "SELECT * FROM quiz_treinamento_pre_teste_tentivas WHERE data_tentativa < DATE_ADD(NOW(), INTERVAL -5 MINUTE) AND id_vid_aula = :id_vid_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    if($contar >= 1) {
        return true;
    } else {
        return false;
    }
}


function pode_fazer_pre_teste($id_usuario, $conexao, $id_aula) {
    /**
     * 
     * Verifica se pode fazer o pre teste
     * 
     */

     if(e_primeira_aula($conexao, $id_aula)) {
         return true;
     }

    // verifica se já fez o pre teste anterior
    if(!fez_pre_teste_anterior($conexao, $id_aula, $id_usuario)) {
        return false;
    } else {
        return true;
    }
}



function pode_fazer_quiz($conexao, $id_aula, $id_usuario) {

    $aprovado = aprovado_pre_teste($conexao, $id_aula, $id_usuario);
    if(e_primeira_aula($conexao, $id_aula)) {
        if(!$aprovado) {
            return false;
        } else {
            return true;
        }
    }

    fez_quiz_anterior($conexao, $id_aula, $id_usuario);
    if(!fez_quiz_anterior($conexao, $id_aula, $id_usuario)) {
        return false;
    } else {
        return true;
    }
}

function fez_quiz_anterior($conexao, $id_aula, $idLog) {
    /**
     * 
     * Aqui já verifica se fez anterior
     * 
     * 
     */
    $aula_anterior = aula_anterior($conexao, $id_aula);
    $id = $aula_anterior->id_aula;
    $preTeste = get_progresso_quiz($conexao, $id, $idLog);
    $count = $preTeste->rowCount();
    
    return $count;
}


function aulaLiberada($conexao, $idAula, $idLog) {
    /**
     * 
     * Verifica se a aula está liberada para assistir
     * 
     * 
     */

    
     // Aula está bloqueada, então não pode assistir
    if(verificarEstaBloqueada($conexao, $idAula, $idLog)) {
        return false;
    }


    if(e_primeira_aula($conexao, $idAula)) {
        return true;
    }

    // Verifica se já fez o pre teste anterior
    if(!fez_pre_teste_anterior($conexao, $idAula, $idLog)) {
        return false;
    }

    // Aula está concluida
    if(aulaConcluida($conexao, $idAula, $idLog)) {
        return false;
    }



    if(pode_fazer_pre_teste($idLog, $conexao, $idAula) && pode_fazer_quiz($conexao, $idAula, $idLog)) {
        return true;
    } else {
        return false;
    }
}

function verificarEstaBloqueada($conexao, $idAula, $idLog) {
    /**
     * 
     * Verifica se a aula está bloqueada no PAINEL
     * 
     * 
     */

    if(esta_bloqueada($conexao, $idAula)) {
        return true;
    }

     if(bloqueada_ate($conexao, $idAula, $idLog)) {
        return true;
     }

    return false;
}

function esta_bloqueada($conexao, $idAula) {
    $sql = "SELECT * FROM aula WHERE id_aula = :id_aula AND status = 'liberado'";
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_aula', $idAula, PDO::PARAM_INT);
    $result ->execute();
    $count = $result->rowCount();
    if($count >= 1) {
        return false;
    } else {
        return true;
    }
}


function bloqueada_acima($conexao, $idAula, $idLog) {
    /**
     * 
     * Bloquear todas as aulas a anterior a esta
     * 
     */

    $id_est = get_user_est($conexao, $idLog); // pega o id da estação do usuário

    $sql = "SELECT * FROM aula WHERE id_aula > :id_aula AND est_id_aula = :id_est AND status != 'liberado' GROUP BY aula.id_aula ORDER BY aula.mod_id_aula DESC, aula.id_aula ASC";    
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_aula', $idAula, PDO::PARAM_INT);
    $result->bindParam(':id_est', $id_est, PDO::PARAM_INT);
    $result ->execute();
    $count = $result->rowCount();
    if($count >= 1) {
        return true;
    } else {
        return false;
    }
}

function bloqueada_ate($conexao, $idAula, $idLog) {
    /**
     * 
     * Bloquear todas as aulas a posterior a esta
     * 
     */

    $id_est = get_user_est($conexao, $idLog); // pega o id da estação do usuário

    $sql = "SELECT * FROM aula WHERE id_aula < :id_aula AND est_id_aula = :id_est AND status != 'liberado' GROUP BY aula.id_aula ORDER BY aula.mod_id_aula DESC, aula.id_aula ASC";    
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_aula', $idAula, PDO::PARAM_INT);
    $result->bindParam(':id_est', $id_est, PDO::PARAM_INT);
    $result ->execute();
    $count = $result->rowCount();
    if($count >= 1) {
        return true;
    } else {
        return false;
    }
}

function aulaConcluida($conexao, $idAula, $idLog) {
    $preTeste = get_progresso_pre_teste_by_aula($conexao, $idAula, $idLog);
    $quiz = get_progresso_quiz($conexao, $idAula, $idLog);
    $count = $preTeste->rowCount();
    $count2 = $quiz->rowCount();
    if($count >= 1 && $count2 >= 1) {
        return true;
    } else {
        return false;
    }
}

function pode_fazer($conexao, $idLog, $idAula) {
    $select = "SELECT DISTINCT acad_id_mat FROM matricula INNER JOIN aula ON aula.est_id_aula = matricula.est_id_mat WHERE matricula.acad_id_mat = :id_usuario AND aula.id_aula = :id_aula";
    $result = $conexao->prepare($select);
    $result ->bindParam(':id_usuario', $idLog, PDO::PARAM_INT);
    $result ->bindParam(':id_aula', $idAula, PDO::PARAM_INT);
    
    $result ->execute();
    $contar = $result->rowCount();
    
    if($contar) {
        return true;
    } else {
        return false;
    }
}


function verificar_aulas($conexao, $id_aula, $idLog) {
    $modulos = get_aulas($conexao, $idLog);
    $aula = get_aula($conexao, $id_aula);
    $progresso = get_progresso_pre_teste($conexao, $idLog);
    $preTeste = array();
    

    foreach ($modulos as $modulo) {
        $aulas = $modulo['aulas'];
        foreach ($aulas as $aula) {
            foreach ($progresso as $key) {
                $assitida = $key->id_aula;
                if($assitida == $aula->id_aula && $key->aprovado == true) {
                    array_push($preTeste, $aula->id_aula);
                }
            }
        }
    }


    echo json_encode($preTeste);
}


function proxima_aula($conexao, $id_aula) {
    $select = "SELECT * FROM aula WHERE id_aula > :id_aula AND treinamento = 'sim' GROUP BY aula.id_aula ORDER BY aula.mod_id_aula ASC, aula.id_aula ASC LIMIT 1";
    
    $result = $conexao->prepare($select);
    $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function aula_anterior($conexao, $id_aula) {
    $select = "SELECT * FROM aula WHERE treinamento = 'sim' GROUP BY aula.id_aula ORDER BY aula.mod_id_aula ASC, aula.id_aula ASC";
    
    
    $result = $conexao->prepare($select);
    $result ->execute();
    $fetch = $result->fetchAll(PDO::FETCH_OBJ);

    for($i = 0; $i < count($fetch); $i++) {
        if($fetch[$i]->id_aula == $id_aula) {
            if($i == 0) {
                return false;
            } else {
                return ($fetch[$i - 1]);
            }
        }
    }

}


function get_progresso_quiz($conexao, $id_aula , $idLog) {
    $select = "SELECT * FROM progresso_usuario_quiz WHERE id_usuario = :id_usuario AND id_aula = :id_aula AND aprovado = 1";
    $result = $conexao->prepare($select);
    $result->bindParam(":id_usuario", $idLog, PDO::PARAM_INT);
    $result->bindParam(":id_aula", $id_aula, PDO::PARAM_INT);
    $result->execute();

    return $result;
}


function get_progresso_pre_teste($conexao, $idLog) {
    $select = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(":id_usuario", $idLog, PDO::PARAM_INT);
    $result->execute();
    $aulasAssitidas = [];
    while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
        array_push($aulasAssitidas, $mostra);
    }

    return $aulasAssitidas;
}


function get_progresso_pre_teste_by_aula($conexao, $id_aula , $idLog) {
    $select = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario AND id_aula = :id_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(":id_usuario", $idLog, PDO::PARAM_INT);
    $result->bindParam(":id_aula", $id_aula, PDO::PARAM_INT);
    $result->execute();

    return $result;
}

function get_progresso_quiz_by_aula($conexao, $id_aula , $idLog) {
    $select = "SELECT * FROM progresso_usuario_quiz WHERE id_usuario = :id_usuario AND id_aula = :id_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(":id_usuario", $idLog, PDO::PARAM_INT);
    $result->bindParam(":id_aula", $id_aula, PDO::PARAM_INT);
    $result->execute();

    return $result;
}

function aprovado_pre_teste($conexao, $id_aula, $idLog) {
    $preTeste = get_progresso_pre_teste_by_aula($conexao, $id_aula, $idLog);
    $fetch = $preTeste->FETCH();
    if($preTeste->rowCount() > 0) {
        return $fetch['aprovado'];
    } else {
        return false;
    }
}


function assistiu_aula($conexao, $id_aula, $idLog) {
    $preTeste = get_progresso_pre_teste_by_aula($conexao, $id_aula, $idLog);

    $fetch = $preTeste->FETCH();
    $aprovado = $fetch['finalizado'] ?? 0;
    if($aprovado) {
        $sql = "SELECT * FROM progresso_usuario_aulas WHERE id_usuario = :id_usuario AND id_aula = :id_aula AND assistido > 0";
        $result = $conexao->prepare($sql);
        $result->bindParam(":id_usuario", $idLog, PDO::PARAM_INT);
        $result->bindParam(":id_aula", $id_aula, PDO::PARAM_INT);
        $result->execute();
        $fetch = $result->FETCH();
        $contar = $result->rowCount();
        if($contar > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function aprovado_quiz($conexao, $id_aula, $idLog) {
    $preTeste = get_progresso_quiz($conexao, $id_aula, $idLog);
    $fetch = $preTeste->FETCH();
    if($preTeste->rowCount() > 0) {
        if($fetch['aprovado'] == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function concluir_aula($conexao, $id_aula, $idLog) {
    $preTesteConcluido = finalizado_pre_teste($conexao, $id_aula, $idLog);
    if($preTesteConcluido) {

        try {
            $stmt = $conexao->prepare("INSERT INTO progresso_usuario_aulas(id_usuario, id_aula, assistido)
            SELECT * FROM (SELECT :id_usuario as id_usuario, :id_aula as id_aula, 0 as assistido) AS tmp
            WHERE NOT EXISTS (
                SELECT * FROM progresso_usuario_aulas WHERE id_usuario = :id_usuario AND id_aula = :id_aula
            )
            LIMIT 1;

            UPDATE progresso_usuario_aulas SET assistido = assistido + 1 WHERE id_usuario = :id_usuario AND id_aula = :id_aula;
            ");
            
            $stmt->bindParam(':id_usuario', $idLog);
            $stmt->bindParam(':id_aula', $id_aula);
            

            $stmt->execute();
            $count = $stmt->rowCount();
            if($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
        
    } else {
        return false;
    }
}

function finalizado_pre_teste($conexao, $id_aula, $idLog) {
    try {
        $preTeste = get_progresso_pre_teste_by_aula($conexao, $id_aula, $idLog);
        return $preTeste->FETCH()['finalizado'];
    } catch (\Throwable $th) {
        return 0;
    }
}


function finalizado_quiz($conexao, $id_aula, $idLog) {
    try {
        $preTeste = get_progresso_quiz($conexao, $id_aula, $idLog);
        if($preTeste->rowCount() == 0) {
            return 0;
        }
        return $preTeste->FETCH()['finalizado'];
    } catch (\Throwable $th) {
        return 0;
    }
}


function fez_pre_teste_anterior($conexao, $id_aula, $idLog) {
    /**
     * 
     * Aqui já verifica se fez anterior
     * 
     * 
     */
    $aula_anterior = aula_anterior($conexao, $id_aula);
    $id = $aula_anterior->id_aula ?? false;
    if($id) {
        $preTeste = get_progresso_pre_teste_by_aula($conexao, $id, $idLog);
        $count = $preTeste->rowCount();
        if($count > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function fez_pre_teste_atual($conexao, $id_aula, $idLog) {
    $preTeste = get_progresso_pre_teste_by_aula($conexao, $id_aula, $idLog);
    $count = $preTeste->rowCount();
    if($count > 0) {
        return true;
    } else {
        return false;
    }
}



function primeira_aula($conexao) {
    /**
     * 
     * A primeira sempre será liberada!
     * 
     */
    $select = "SELECT * FROM modulo INNER JOIN aula ON aula.mod_id_aula = modulo.id_mod INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula AND modulo.treinamento = 'sim' AND aula.treinamento = 'sim'";
    $result = $conexao->prepare($select);
    $result->execute();
    $count = $result->rowCount();
    $fetch = $result->FETCH(PDO::FETCH_OBJ);
    return $fetch;
}



function e_primeira_aula($conexao, $id_aula) {
    $primeiraAula = primeira_aula($conexao);
    return $primeiraAula->id_aula == $id_aula;
}



function fez_aula_anterior($conexao, $id_aula) {
    if(e_primeira_aula($conexao, $id_aula)) {
        return true;
    }
}

function get_user_est($conexao, $idLog) {
    $select = 'SELECT est_id_mat FROM matricula WHERE acad_id_mat = :acad_id_mat';
    $result = $conexao->prepare($select);
    $result->bindParam(':acad_id_mat', $idLog, PDO::PARAM_INT);
    $result ->execute();

    return $result->FETCH()['est_id_mat'];
}

 
function get_aulas($conexao, $idLog) {
    $user_est = get_user_est($conexao, $idLog);
    $modulos = get_modulos($conexao, $user_est);
    $modulosCount = $modulos->rowCount();

    if($modulosCount>0){
        $resp = [];
        while($mostra = $modulos->FETCH(PDO::FETCH_OBJ)){
            $id_mod = $mostra->id_mod;
            $aulas = get_aulas_modulos($conexao, $id_mod);

            $aulasMod = ["id_mod" => $id_mod, "aulas" => []];
            while($fetchAula = $aulas->FETCH(PDO::FETCH_OBJ)) {
                $fetchAula->finalizado_pre_teste = finalizado_pre_teste($conexao, $fetchAula->id_aula, $idLog);
                $fetchAula->finalizado_quiz = finalizado_quiz($conexao, $fetchAula->id_aula, $idLog);
                array_push($aulasMod['aulas'], $fetchAula);
            }

            array_push($resp, $aulasMod);
        }

        return array_values($resp);
    }
}


function porcentagem_conclusao($conexao, $idLog) {
    /**
     * 
     * Verifica a porcentagem de conclusão do treinamento
     * 
     */
    $aulas = get_aulas($conexao, $idLog);
    $totalAulas = 0;
    $totalAulasFinalizadas = 0;
    foreach($aulas as $modulo) {
        foreach($modulo['aulas'] as $aula) {
            $totalAulas++;
            if($aula->finalizado_quiz) {
                if($aula->finalizado_pre_teste == 1 && $aula->finalizado_quiz == 1) {
                    $totalAulasFinalizadas++;
                } elseif($aula->finalizado_pre_teste == 1 && $aula->finalizado_quiz == 0) {
                    $totalAulasFinalizadas += 0.5;
                } elseif($aula->finalizado_pre_teste == 0 && $aula->finalizado_quiz == 1) {
                    $totalAulasFinalizadas += 0.5;
                }
    
            }
        }
    }

    $conta = ($totalAulasFinalizadas / $totalAulas) * 100;
    return round($conta, 2);
}


function get_aula($conexao, $id_aula){
    $select = "SELECT * FROM aula WHERE aula.id_aula = :id_aula";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function finalizar_pre_teste($conexao, $id_usuario, $id_aula, $aprovado) {

    $sql = "INSERT INTO progresso_usuario_pre_teste(id_usuario, id_aula, finalizado, aprovado)
    SELECT * FROM (SELECT :id_usuario as id_usuario, :id_aula as id_aula, 1 AS finalizado, :aprovado as aprovado) AS tmp
    WHERE NOT EXISTS (
        SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario_2 AND id_aula = :id_aula_2
    ) LIMIT 1;
    ";

    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':id_usuario_2', $id_usuario, PDO::PARAM_INT);
    $result->bindParam(':id_aula_2', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':aprovado', $aprovado, PDO::PARAM_INT);
    $result ->execute();
    
    return $result->rowCount();
}

function finalizar_quiz($conexao, $id_usuario, $id_aula, $aprovado) {
    

    $sql = "INSERT INTO progresso_usuario_quiz(id_usuario, id_aula, finalizado, aprovado)
    SELECT * FROM (SELECT :id_usuario, :id_aula, 1 AS finalizado, :aprovado as aprovado) AS tmp
    WHERE NOT EXISTS (
        SELECT * FROM progresso_usuario_quiz WHERE id_usuario = :id_usuario_2 AND id_aula = :id_aula_2
    ) LIMIT 1;
    ";

    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':id_usuario_2', $id_usuario, PDO::PARAM_INT);
    $result->bindParam(':id_aula_2', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':aprovado', $aprovado, PDO::PARAM_INT);
    $result ->execute();
    
    if($aprovado == 1) {
        update_progresso_usuario_quiz($conexao, $id_usuario, $id_aula, $aprovado);
    }


    return $result;
}

function update_progresso_usuario_quiz($conexao, $id_usuario, $id_aula, $aprovado) {
    $sql = "UPDATE progresso_usuario_quiz SET aprovado = :aprovado WHERE id_usuario = :id_usuario AND id_aula = :id_aula";

    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':aprovado', $aprovado, PDO::PARAM_INT);
    $result ->execute();

    return $result;
}


function foi_aprovado_pre_teste($conexao, $id_usuario, $id_aula) {
    
    $select = "SELECT * FROM treinamento_pre_teste WHERE id_vid_aula = :id_vid_aula ORDER BY id_pre_teste";  

    try{
        $result = $conexao->prepare($select);
        $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
        $result ->execute();
        $quantidade_quiz = $result->rowCount();
        $num_acertos = num_acertos_pre_teste($conexao, $id_usuario, $id_aula);

        if($num_acertos > ($quantidade_quiz / 2)) {
            return 1;
        } else {
            return 0;
        }

    } catch (Exception $e) {
    }
}

function foi_aprovado_quiz($conexao, $id_usuario, $id_aula) {
    
    $select = "SELECT * FROM quiz_treinamento WHERE id_vid_aula = :id_vid_aula ORDER BY id_quiz";  

    try{
        $result = $conexao->prepare($select);
        $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
        $result ->execute();
        $quantidade_quiz = $result->rowCount();
        $num_acertos = num_acerto_aula($conexao, $id_usuario, $id_aula);
        $porcentagemAula = taxaAcertoAula($conexao, $id_aula);
        $resultado = ($num_acertos / $quantidade_quiz) * 100;
        if($resultado >= $porcentagemAula) {
            return 1;
        } else {
            return 0;
        }

    } catch (Exception $e) {
    }
}

function taxaAcertoAula($conexao, $id_aula) {
    /**
     * 
     * Taxa de acerto quiz
     * 
     */
    $sql = "SELECT * FROM aula WHERE id_aula = :id_aula";
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    if($result->rowCount() == 0) {
        return 0;
    } else {
        $aula = $result->fetch(PDO::FETCH_OBJ);
        $porcentagem = $aula->taxa_acerto_quiz;
        return $porcentagem;    
    }
}

function num_acertos_pre_teste($conexao, $id_usuario, $id_aula) {
    $select = "SELECT DISTINCT treinamento_pre_teste.id_pre_teste, treinamento_pre_teste.id_vid_aula FROM treinamento_pre_teste INNER JOIN quiz_treinamento_pre_teste_tentivas ON quiz_treinamento_pre_teste_tentivas.resposta = treinamento_pre_teste.alternativa_correta WHERE quiz_treinamento_pre_teste_tentivas.id_usuario = :id_usuario AND quiz_treinamento_pre_teste_tentivas.id_vid_aula = :id_aula ORDER BY treinamento_pre_teste.id_pre_teste";
    try{
        $result = $conexao->prepare($select);
        $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        return $contar;
    } catch (Exception $e) {
    }
}

function num_acertos_quiz($conexao, $id_usuario, $id_aula) {
    $select = "SELECT DISTINCT quiz_treinamento.id_quiz, quiz_treinamento.id_vid_aula FROM quiz_treinamento INNER JOIN quiz_treinamento_tentivas ON quiz_treinamento_tentivas.resposta = quiz_treinamento.alternativa_correta WHERE quiz_treinamento_tentivas.id_usuario = :id_usuario AND quiz_treinamento_tentivas.id_vid_aula = :id_aula ORDER BY quiz_treinamento.id_vid_aula";
    try{
        $result = $conexao->prepare($select);
        $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $result ->execute();
        var_dump($result->fetchAll());
        $contar = $result->rowCount();
        return $contar;
    } catch (Exception $e) {
    }
}


function num_acerto_aula($conexao, $id_usuario, $id_aula) {
    $sql2 = "SELECT id FROM quiz_treinamento_tentivas WHERE id_usuario = :id_usuario AND id_vid_aula = :id_aula";
    try{
        $result = $conexao->prepare($sql2);
        $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        return $contar;
    } catch (Exception $e) {
    }
}


function num_quiz($conexao, $id_aula) {
    $select = "SELECT * FROM quiz_treinamento WHERE id_vid_aula = :id_aula";
    try{
        $result = $conexao->prepare($select);
        $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        return $contar;
    } catch (Exception $e) {
    }
}


function errou($conexao, $idUsuario, $idQuiz, $resposta, $id_vid) {
    if(existe_coluna($conexao, $idUsuario, $idQuiz)) {
        adicionar_erro($conexao, $idUsuario, $idQuiz, $resposta, $id_vid);
    } else {
        criar_erros($conexao, $idUsuario, $idQuiz);
        adicionar_erro($conexao, $idUsuario, $idQuiz, $resposta, $id_vid);
    }
}

function errou_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid) {
    if(existe_coluna_quiz($conexao, $idUsuario, $idQuiz)) {
        adicionar_erro_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid);
    } else {
        criar_erros_quiz($conexao, $idUsuario, $idQuiz);
        adicionar_erro_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid);
    }
}


function acertou($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    if(existe_coluna($conexao, $idUsuario, $idQuiz)) {
        adicionar_acerto($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula);
    } else {
        criar_erros($conexao, $idUsuario, $idQuiz);
        adicionar_acerto($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula);
    }
}

function acertou_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    if(existe_coluna_quiz($conexao, $idUsuario, $idQuiz)) {
        adicionar_acerto_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula);
    } else {
        criar_erros_quiz($conexao, $idUsuario, $idQuiz);
        adicionar_acerto_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula);
    }
}

function num_erros($conexao, $idUsuario, $idQuiz){
    $select = "SELECT num_erros FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result ->execute();    
}


function adicionar_acerto($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    /**
     * pré-teste
     * 
     */
    $sql = "UPDATE quiz_treinamento_pre_teste_tentivas SET aprovado = 1, resposta=:resposta, id_vid_aula=:id_vid_aula WHERE id_usuario = :id_usuario AND id_pre_teste = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result->bindParam(':resposta', $resposta, PDO::PARAM_STR);
    $result->bindParam(':id_vid_aula', $id_vid_aula, PDO::PARAM_INT);

    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}


function adicionar_acerto_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    $sql = "UPDATE quiz_treinamento_tentivas SET aprovado = 1, resposta=:resposta, id_vid_aula=:id_vid_aula WHERE id_usuario = :id_usuario AND id_pre_teste = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result->bindParam(':resposta', $resposta, PDO::PARAM_STR);
    $result->bindParam(':id_vid_aula', $id_vid_aula, PDO::PARAM_INT);

    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}


function adicionar_erro($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    $sql = "UPDATE quiz_treinamento_pre_teste_tentivas SET num_erros = num_erros + 1, resposta=:resposta, aprovado=0, id_vid_aula=:id_vid_aula WHERE id_usuario = :id_usuario AND id_pre_teste = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result->bindParam(':id_vid_aula', $id_vid_aula, PDO::PARAM_INT);
    $result->bindParam(':resposta', $resposta, PDO::PARAM_STR);

    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}

function adicionar_erro_quiz($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    $sql = "UPDATE quiz_treinamento_tentivas SET num_erros = num_erros + 1, resposta=:resposta, id_vid_aula=:id_vid_aula, aprovado=0 WHERE id_usuario = :id_usuario AND id_pre_teste = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result->bindParam(':id_vid_aula', $id_vid_aula, PDO::PARAM_INT);
    $result->bindParam(':resposta', $resposta, PDO::PARAM_STR);

    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}


function criar_erros($conexao, $idUsuario, $idQuiz) {
    try {
        $insert = "INSERT INTO quiz_treinamento_pre_teste_tentivas(id_usuario, id_pre_teste) VALUES(:id_usuario, :id_quiz)";  
        $result = $conexao->prepare($insert);
        $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        return $contar;
    } catch (\Exception $th) {
        throw $th;
    }
}

function criar_erros_quiz($conexao, $idUsuario, $idQuiz) {
    try {
        $insert = "INSERT INTO quiz_treinamento_tentivas(id_usuario, id_pre_teste) VALUES(:id_usuario, :id_quiz)";  
        $result = $conexao->prepare($insert);
        $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        return $contar;
    } catch (\Exception $th) {
        throw $th;
    }
}


function existe_coluna($conexao, $idUsuario, $idPreTeste) {
    $select = "SELECT * FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario AND id_pre_teste = :id_pre_teste";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_pre_teste', $idPreTeste, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}


function existe_coluna_quiz($conexao, $idUsuario, $idPreTeste) {
    $select = "SELECT * FROM quiz_treinamento_tentivas WHERE id_usuario = :id_usuario AND id_pre_teste = :id_pre_teste";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_pre_teste', $idPreTeste, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}


function salvar_pre_teste($conexao, $id_vid_aula, $id_usuario) {
    $select = "INSERT INTO quiz_treinamento_pre_teste_novo(id_vid_aula, id_usuario) VALUES (:id_vid_aula, :id_usuario)";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid_aula', $id_vid_aula, PDO::PARAM_INT);
    $result ->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function tem_pre_teste($conexao, $id_vid, $id_usuario) {
    $select = "SELECT * FROM quiz_treinamento_pre_teste_novo  WHERE id_vid_aula = :id_vid_aula AND id_usuario = :id_usuario";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid_aula', $id_vid, PDO::PARAM_INT);
    $result ->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result ->execute();
    $count = $result->rowCount();
    if($count >= 1) {
        return true;
    } else {
        return false;
    }
}



function get_aulas_modulos($conexao, $id_mod){
    $select = "SELECT * FROM aula LEFT JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula WHERE mod_id_aula=:mod_id_aula AND treinamento = 'sim'";

    $result = $conexao->prepare($select);
    $result ->bindParam(':mod_id_aula', $id_mod, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}



function getAulasByAulaVid($conexao, $id_vid){
    $select = "SELECT * FROM aula_vid LEFT JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid ORDER BY `aula`.`cronograma_semanas` ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $id_vid, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModuloByAulaVid($conexao, $aula_vid_id){
    $select = "SELECT * FROM aula_vid LEFT JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid ORDER BY `aula`.`cronograma_semanas` ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $aula_vid_id, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModulo($conexao, $id_est) {

    $select = "SELECT * FROM modulo WHERE est_id_mod=:est_id_mod AND treinamento = 'sim'";

    $result = $conexao->prepare($select);
    $result ->bindParam(':est_id_mod', $id_est, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function get_modulos($conexao, $est_id_mod) {


    $select = "SELECT * FROM modulo WHERE treinamento = 'sim' AND est_id_mod = :est_id_mod";
    $result = $conexao->prepare($select);
    $result->bindParam(':est_id_mod', $est_id_mod, PDO::PARAM_INT);
    $result ->execute();

    return $result;
}


function getVisualizacoesAula($conexao, $id_usuario) {
    $select = "SELECT * FROM visualizacoes WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function getComentarios($conexao, $id_usuario) {
    
}


?>
