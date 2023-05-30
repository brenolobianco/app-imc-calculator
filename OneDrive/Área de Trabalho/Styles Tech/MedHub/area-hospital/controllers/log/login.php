<?php

        // // if(isset($_GET['acao'])){
          
        // //   if(!isset($_POST['logar'])){
          
        // //     $acao = $_GET['acao'];
        // //     if($acao=='negado'){
        // //       echo '<div class="alert alert-danger">
        // //               <button type="button" class="close" data-dismiss="alert">×</button>
        // //               <strong>Erro ao acessar!</strong> Você precisa estar logado p/ acessar o Sistema.
        // //           </div>';  
        // //     }
        // //   }
        // }

        if(isset($_POST['logar'])){
            // RECUPERAR DADOS FORM
            $email_hosp = trim(strip_tags($_POST['email_hosp']));
            $senha_hosp = trim(strip_tags($_POST['senha_hosp']));
            
            // SELECIONAR BANCO DE DADOS
            
            $select = "SELECT * from hospital WHERE BINARY email_hosp=:email_hosp AND BINARY senha_hosp=:senha_hosp";
            
            try{
              $result = $conexao->prepare($select);
              $result->bindParam(':email_hosp', $email_hosp, PDO::PARAM_STR);
              $result->bindParam(':senha_hosp', $senha_hosp, PDO::PARAM_STR);
              $result->execute();
              $contar = $result->rowCount();
              if($contar>0){
                $email_hosp = $_POST['email_hosp'];
                $senha_hosp = $_POST['senha_hosp'];
                $_SESSION['emailHosp'] = $email_hosp;
                $_SESSION['senhaHosp'] = $senha_hosp;
                
                echo '<div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>Logado com Sucesso!</strong> Redirecionando para o painel...
                        </div>';
                
                header("Refresh: 1, home.php?acao=welcome");
              }else{
                echo '<div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>Opss!!!</strong> o email e/ou a senha estão incorretos.
                        </div>';
              }
              
            }catch(PDOException $e){
              echo $e;
            }
            
            
            
          }// se clicar no botão entrar no sistema
          
        ?> 