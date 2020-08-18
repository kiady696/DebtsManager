<?php
    class Trosa_model extends CI_Model {
        
        public $id_user;
        public $date;
        public $total;

        public function getAllTrosa(){
            $query = $this->db->get('getalltrosa');
            return $query->result_array();
        }

        public function __construct(){
            $this->load->database();
            //$this->set_id_user($id_user);
            //$this->set_date($date);
            //$this->set_total($total);
        }

        function set_id_user($id_user){
            $this->id_user = $id_user;
        }

        function set_date($date){ //Mbola ho asiana test unitaire
            $this->date = $date;
        }

        function set_total($total){ //Mbola asiana test unitaire 
            $this->total = $total;
        }
    }


?>