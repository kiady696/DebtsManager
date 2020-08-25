<?php
    class Trosa_model extends CI_Model {
        
        public $id_user;
        public $date;
        public $total;

        public function checkEtatTrosa($id_trosa){
            $reste = $this->get_reste($id_trosa);
            if($reste == 0){
                $this->db->where('iddette',$id_trosa);
                $this->db->set('etat',10);
                $this->db->update('trosa');
            }else{
                return $reste; 
            }
        }

        public function get_reste($id_trosa){
            $query = $this->db->get_where('trosa',array('iddette' => $id_trosa));
            $totalARemb = $query->row_array()['total'];
            //echo "le total pour ce trosa: ".$totalARemb;
            $query = $this->db->get_where('getrembs',array('iddette' => $id_trosa));
            $DejaRemb = $query->row_array()['sum'];
            //echo "la somme des remb pour ce trosa: ".$DejaRemb;
            if($DejaRemb === NULL){
                $DejaRemb = 0;
            }
            $reste = $totalARemb - $DejaRemb;
            //echo 'Le reste est: '.$reste;
            return $reste;
            
        }

        public function pre_remboursement($id_trosa){
            $montantInput = $this->input->post('montantRemb');
            //Le montant entré ne doit pas excéder le reste à payer
            $resteAPayer = $this->get_reste($id_trosa);
            if($montantInput <= 0){ //Erreur d'entrée , retaper le montant
                $data['messageErreur'] = 'Erreur d\'entrée , montant invalide, retaper le montant';
                $this->load->view('pages/error',$data);
            }else if($montantInput > $resteAPayer){ //Erreur d'entrée , retaper le montant
                $data['messageErreur'] = 'Erreur d\'entrée , Remboursement en excès, retaper le montant';
                $this->load->view('pages/error',$data);
            }else{
                //generer le PK du PayementAValider
                $idPaye = $this->genPK('P','payementavalider');
                //inserer l'input dans la table payementavalider
                $data = array (
                    'idpayement' => $idPaye,
                    'idtrosa' => $id_trosa,
                    'sommepayement' => $montantInput,
                    'datepayement' => $this->input->post('dateRemb')
                );
                $this->db->insert('payementavalider' , $data);
                
            }
            return $data;
        }

        public function genPK($prefixe,$tableName){
            $nbRows = $this->db->count_all($tableName);
            $nbRows++;
            return $prefixe.$nbRows;
            //return $prefixe.$id;
        }

        public function getHisTrosa($id_user,$id_trosa){
            $query = $this->db->get_where('getalltrosa',array('id' => $id_user,'iddette' => $id_trosa));
            return $query->row_array(); 
        }

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