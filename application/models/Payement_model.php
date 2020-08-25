<?php
    class Payement_model extends CI_Model {
        
        public $idPayement;
        public $idTrosa;
        public $sommePayement;
        public $datePayement;

        public function __construct(){
            $this->load->database();
            //$this->set_id_payement($id_payement);
            //$this->set_id_trosa($id_trosa);
            //$this->set_sommePayement($somme_payement);
            //$this->set_datePayement($date_payement);

        }

        public function validateRemb($id_payement){
            $query = $this->db->get_where('payementavalider',array('idpayement' => $id_payement));
            $remb = $query->row_array();
            $data = array(
                'idremboursement' => $this->genPK('R','remboursements'),
                'idpayement' => $remb['idpayement'],
                'idtrosa' => $remb['idtrosa'],
                'dateremboursement' => $remb['datepayement']
            );
            $this->db->insert('remboursements',$data);
        }

        public function genPK($prefixe,$tableName){
            $nbRows = $this->db->count_all($tableName);
            $nbRows++;
            return $prefixe.$nbRows;
            //return $prefixe.$id;
        }

        function getIdPayement(){
            return $this->idPayement;
        }
        function getIdTrosa(){
            return $this->idTrosat;
        }
        function getSommePayement(){
            return $this->sommePayement;
        }
        function getDatePayement(){
            return $this->datePayement;
        }


        function set_id_payement($id_payement){
            $this->idPayement = $id_payement;
        }
        function set_id_trosa($id_trosa){
            $this->idTrosa = $id_trosa;
        }
        function set_sommePayement($somme_payement){
            $this->sommePayement = $somme_payement;
        }
        function set_datePayement($date_payement){
            $this->datePayement = $date_payement;
        }

    }



?>