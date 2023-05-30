<?php



class Aula {
    private $user_id;
    private $conexao;

    public function __construct($idLog, $conexao) {
        $this->user_id = $idLog;
        $this->conexao = $conexao;
    }

    public function estaLiberada($aula) {
        if ($this->podeFazerPreTeste($aula)) {
            return $this->podeFazerQuiz($aula);
        }
        return false;
    }

    private function podeFazerPreTeste($aula) {
        if ($this->ePrimeiraAula($aula)) {
            return true;
        }
        if (!$this->fezPreTesteAnterior($aula)) {
            return false;
        }
        return true;
    }

    private function ePrimeiraAula($aula) {
        $primeiraAula = self::primeiraAula($aula);
        return $primeiraAula->id_aula == $this->$aula;
    }

    private function primeiraAula($atual) {
        /**
         * 
         * A primeira sempre será liberada!
         * 
         */
        $select = "SELECT * FROM modulo INNER JOIN aula ON aula.mod_id_aula = modulo.id_mod INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula AND modulo.treinamento = 'sim' AND aula.treinamento = 'sim'";
        $result = $this->conexao->prepare($select);
        $result->execute();
        $count = $result->rowCount();
        $fetch = $result->FETCH(PDO::FETCH_OBJ);
        return $fetch;
    }
    

    private function fezPreTesteAnterior($aula) {
        $aula_anterior = self::aulaAnterior($aula);
        $preTeste = self::getProgressoPreTesteByAula($aula);
        return $preTeste->rowCount() > 0;
    }


    private function podeFazerQuiz($aula) {
        $aprovado = $this->aprovadoPreTeste($this->user_id);
        if ($this->ePrimeiraAula($aula)) {
            if (!$aprovado) {
                return false;
            }
            return true;
        }
        if (!$this->fezQuizAnterior()) {
            return false;
        }
        return true;
    }

    private function fezQuizAnterior() {
        $aula_anterior = self::aulaAnterior($this->user_id);
        $quiz = self::getProgressoQuiz($aula_anterior->id_aula);
        return $quiz->rowCount() > 0;
    }

    function aulaAnterior($id_aula) {
        $select = "SELECT * FROM aula WHERE aula.id_aula < :id_aula AND treinamento = 'sim' ORDER BY id_aula DESC LIMIT 1";
        
        $result = $this->conexao->prepare($select);
        $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result ->execute();
    
        return $result->FETCH(PDO::FETCH_OBJ);
    }
    

    private function aprovadoPreTeste($id_aula) {
        $preTeste = self::getProgressoPreTesteByAula($id_aula);
        $fetch = $preTeste->fetch();
        return $fetch['aprovado'];
    }

    private function getProgressoPreTesteByAula($id_aula) {
        $select = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario AND id_aula = :id_aula";
        $result = $this->conexao->prepare($select);
        $result->bindParam(":id_usuario", $this->user_id, PDO::PARAM_INT);
        $result->bindParam(":id_aula", $id_aula, PDO::PARAM_INT);
        $result->execute();
    
        return $result;
    }

    private function getProgressoQuiz($id_aula) {
        $select = "SELECT * FROM progresso_usuario_quiz WHERE id_usuario = :id_usuario AND id_aula = :id_aula";
        $result = $this->conexao->prepare($select);
        $result->bindParam(":id_usuario", $this->user_id, PDO::PARAM_INT);
        $result->bindParam(":id_aula", $id_aula, PDO::PARAM_INT);
        $result->execute();
    
        return $result;
    }

}