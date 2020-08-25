<?php
    class Payement extends CI_Controller{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('trosa_model');
                $this->load->model('payement_model');
                $this->load->helper('url_helper');
        }

        public function annuler($id_payement){
            header('Location :'.site_url(''));
        }

        public function valider($id_payement){
            if(isset($id_payement)){
                $this->payement_model->validateRemb($id_payement);
                $data['messageSuccess'] = 'Le payement a été validé';
                $this->load->view('pages/ValidationSuccess',$data);
            }
        }



    }
?>