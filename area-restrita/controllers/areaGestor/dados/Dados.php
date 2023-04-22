<?php


include_once __DIR__ . '/../../../../area-restrita/models/conexao.php';

abstract class Dados {
    
        protected $id_user;
        protected $id_hosp;
        protected $db;

        private $tipoDado;

        public function __construct() {
            global $conn;
            $this->db = $conn;
        }

        public function setIdUser($id_user) {
            $this->id_user = $id_user;
        }
    
        public function setIdHosp($id_hosp) {
            $this->id_hosp = $id_hosp;
        }
    
        public function setDadosIndividual() {
            $this->tipoDado = 'individual';
            echo "teste";
        }

        public function getDados() {
        }
}

class Individual extends Dados {

    public function preTeste() {
        $idUsuario = $this->id_user;
        $idHosp = $this->id_hosp;


        $sql = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function mediaNotaPreTeste() {
        /**
         * 
         * Média das notas do pré teste
         * 
         * 
         */
        $idUsuario = $this->id_user;
        $idHosp = $this->id_hosp;
        $total = 0;
        $quantidade = 0;

        $sql = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

class Coletivo extends Dados {
    
    public function getDados() {
        $sql = "SELECT * FROM  WHERE id_hosp = :id_hosp";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_hosp', $this->id_hosp);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$individual = new Individual();
$individual->setIdUser(22);
$individual->setIdHosp(1);
$dados = $individual->preTeste();
print_r($dados);