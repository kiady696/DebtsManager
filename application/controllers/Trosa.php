<?php
    class Trosa extends CI_Controller{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('trosa_model');
                $this->load->helper('url_helper');
        }

        public function allegerDette($idDette = NULL,$idUser = NULL){
            
            echo 'ETO NY TOKONY MANAO VALIDATION';


        }

        public function rembourser($id_user = NULL){ //aller à la page remboursement fotsiny miaraka amle id anle user 
            $this->load->helper('form');
            $this->load->library('form_validation');
                
            $this->form_validation->set_rules('datePaye', 'Date de payement', 'required');
            $this->form_validation->set_rules('rembMontant', 'Montant remboursé', 'required');
            if ($this->form_validation->run() === FALSE)  //ra misy diso ny inputs
            {
                $data['nom_user'] = $_GET['usr'];
                $this->load->view('pages/RemboursementPage',$data);
                    
                    

            }else{
                $data['id_user'] = $id_user;
                $data['nom_user'] = $_GET['usr'];
                $data['idDette'] = $_GET['refD'];

                // $this->trosa_model->getDetailTrosa($_GET['refD']);

                $this->load->view('pages/ValidationRemboursement',$data);

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