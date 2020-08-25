<?php
    class Trosa extends CI_Controller{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('trosa_model');
                //$this->load->model('payement_model');
                $this->load->helper('url_helper');
        }

        public function allegerDette($id_user = NULL , $id_trosa = NULL){
            
            // echo 'ETO NY TOKONY MANAO VALIDATION';
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Create a news item';

            $this->form_validation->set_rules('dateRemb', 'Date de remboursement', 'required');
            $this->form_validation->set_rules('montantRemb', 'Montant de remboursement', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->rembourser($id_user,$id_trosa);

            }
            else
            {
                // Eto ny manao ny remboursement à valider 
                //INSERT INTO PAYEMENT à VALIDER : idPayement (généréna),idTrosa , sommePayement , datePayement 
                $payement = $this->trosa_model->pre_remboursement($id_trosa);
                //Makao am page de validation/annulation payement
                //Atao anaty objet iray aloha ilay Payement de alefa any am page de validation payement
                //$Payement = new Payement_model($payement['idpayement'],$payement['idtrosa'],$payement['sommepayement'],$payement['datepayement']);

                $data['PayementObject'] = $payement;
                $query = $this->db->get_where('getalltrosa',array('iddette' => $id_trosa));
                $data['trosaCible'] = $query->row_array();
                if(isset($payement['idpayement'])){
                    $this->load->view('pages/ValidationPayement',$data);
                }
                
            }


        }

        public function rembourser($id_user = NULL , $id_trosa = NULL){ //aller à la page remboursement fotsiny miaraka amle id anle user de mrecuperer an'ilay infos de trosa
            if(!isset($id_user) or !isset($id_trosa)){
                show_404();
            
            }else{
                //maka ny details anle trosa noselectionnena tary amn Accueil
                $this->load->helper('form');
                $data['trosaOfUser'] = $this->trosa_model->getHisTrosa($id_user,$id_trosa);
                //Eto ampiana ny maka ny vue mamerina ny somme efa remboursée sy ny reste à payer
                $data['reste'] = $this->trosa_model->get_reste($id_trosa);
                $query = $this->db->get_where('getrembs',array('iddette' => $id_trosa));
                $data['rembs'] = $query->row_array()['sum'];
                //Condition raha nikitika anle url le olona ka tsy misy ninina averinle getHisTrosa

                //ra misy zavatra averinle getHisTrosa dia makany amin'ilay page de remboursement
                $this->load->view('pages/RemboursementPage',$data);
            }
            

        }

        public function index(){ //mlister ny trosa rehetra 
            $data['title'] = 'Les trosa';
            //TEST
            $data['users'] = $this->trosa_model->getAllTrosa();
            //TEST
            $this->load->view('pages/Accueil',$data);
        }
    }



?>