<?php defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: PWAuth');

    class Clientcontroller extends CI_Controller {
        protected $ClientDbContext;
        protected $clientprofile;
        protected $Filemanager;

        public function __construct(){
            parent::__construct();
            $this->load->model('Clientmodels/Dbcontext/Clientdbcontext');
            $this->ClientDbContext = $this->Clientdbcontext;
            $this->load->model('PWFileManager');
            $this->Filemanager = $this->PWFileManager;
        }

        public function getallClients(){
            try{
                $limit = $this->input->get('limit');
                $offset = $this->input->get('offset');
                $data = $this->ClientDbContext->get_allclients($limit, $offset);
                echo json_encode($this->response(true,'Success',$data));
            }catch(Exception $ex){
                echo json_encode($this->response(false,$ex->getMessage(),null));
            }
        }

        //getting the response of each function and return to axios
        private function response($success,$msg=null,$result=null){
            $response = array('success'=>$success);
            if(isset($msg)) $response['msg'] = $msg;
            if(isset($result)) $response['result'] = $result;
            return $response;
        }
    }