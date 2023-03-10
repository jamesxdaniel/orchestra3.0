<?php defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: PWAuth');

    class Usercontroller extends CI_Controller {
        protected $UserDbContext;
        protected $userprofile;
        protected $auth;
        protected $Filemanager;

        public function __construct() {
            parent::__construct();
            $this->load->model('Usermodels/Authmodel');
            $this->auth = $this->Authmodel;
            $this->load->model('Usermodels/Dbcontext/Userdbcontext');
            $this->UserDbContext = $this->Userdbcontext;
            $this->load->model('Usermodels/Editusermodel');
            $this->userprofile = $this->Editusermodel;
            $this->load->model('PWFileManager');
            $this->Filemanager = $this->PWFileManager;
        }

        public function index() {
            echo '404';
        }
        
        public function AuthUser() {
            try {
                // Accept and validate email and password. it will return exception error if all requirements didn`t met
                $this->auth->setEmail($this->input->get('email'));
                $this->auth->setPassword($this->input->get('password'));

                //get email and password and save to database after being validated
                $res = $this->UserDbContext->check_user($this->auth->getEmail(),$this->auth->getPassword());

                if (count($res) > 0) {
                    echo json_encode($this->response(true,'User is authenticated',$res));
                }
            } catch(Exception $ex) {
                echo json_encode($this->response(false,$ex->getMessage(),null));
            }
        }

        public function EditUser() {
            try {
                //Checking if variable met
                if (!empty($this->input->get('userid'))) {
                    $this->userprofile->setUserid($this->input->get('userid'));
                }
                if (!empty($this->input->get('password'))) {
                    if (!empty($this->input->get('confirmpassword'))) {
                        $this->userprofile->setResPassword($this->input->get('password'), $this->input->get('confirmpassword'));
                    }else{
                        throw new InvalidArgumentException('Password and confirm password doesn\'t match');
                    }
                }
                if (!empty($this->input->get('zimbraemail'))) { 
                    $this->userprofile->setResZimbraemail($this->input->get('zimbraemail'));
                }
                if (!empty($this->input->get('gmailemail'))) { 
                    $this->userprofile->setResGmailemail($this->input->get('gmailemail')); 
                }
                if (!empty($this->input->get('skypename'))) { 
                    $this->userprofile->setResSkypename($this->input->get('skypename')); 
                }
                if (!empty($this->input->get('webmail'))) { 
                    $this->userprofile->setResWebmail($this->input->get('webmail')); 
                }
                if (!empty($this->input->get('emaileremail'))) { 
                    $this->userprofile->setResEmaileremail($this->input->get('emaileremail')); 
                }
                if (!empty($this->input->get('contactnumber'))) { 
                    $this->userprofile->setResContactnumber($this->input->get('contactnumber')); 
                }

                $data = [];

                if (!empty($this->userprofile->getUserid())) {
                    $data['user_id'] = $this->userprofile->getUserid();
                }

                if (!empty($this->userprofile->getProfilepicture())) {
                    $data['user_photo'] = $this->userprofile->getProfilepicture();
                }

                if (!empty($this->userprofile->getPassword())) {
                    $data['user_password'] = sha1($this->userprofile->getPassword());
                }

                if (!empty($this->userprofile->getZimbraemail())) {
                    $data['user_zimbra_email'] = $this->userprofile->getZimbraemail();
                } else {
                    $data['user_phone'] = null;
                }

                if (!empty($this->userprofile->getGmailemail())) {
                    $data['user_gmail_email'] = $this->userprofile->getGmailemail();
                } else {
                    $data['user_gmail_email'] = null;
                }

                if (!empty($this->userprofile->getSkypename())) {
                    $data['user_skype_name'] = $this->userprofile->getSkypename();
                } else {
                    $data['user_skype_name'] = null;
                }

                if (!empty($this->userprofile->getWebmail())) {
                    $data['security_email'] = $this->userprofile->getWebmail();
                } else {
                    $data['security_email'] = null;
                }

                if (!empty($this->userprofile->getEmaileremail())) {
                    $data['emailer_email'] = $this->userprofile->getEmaileremail();
                } else {
                    $data['emailer_email'] = null;
                }

                if (!empty($this->userprofile->getContactnumber())) {
                    $data['user_phone'] = $this->userprofile->getContactnumber();
                } else {
                    $data['user_phone'] = null;
                }

                if ($data == []) {
                    $res = $this->UserDbContext->get_user($this->input->get('userid'));
                    echo json_encode($this->response(true,'Profile updated successfully',$res));
                } else {
                    $res = $this->UserDbContext->update_user($this->userprofile->getUserid(), $data);
                    echo json_encode($this->response(true,'Profile updated successfully',$res));
                }

            } catch(Exception $ex) {
                echo json_encode($this->response(false,$ex->getMessage(),null));
            }
        }

        public function uploadfile() {
            $get = $this->input->get();
            $post = $this->input->post();

            if (isset($this->session->post_data)) $post = $this->session->post_data;
            
            $file = $_FILES;
            $profilepicture = $this->Filemanager->upload($get,$post,$file['file']);
            if ($profilepicture['success'])
            {
                $data = [
                    'user_photo' => $profilepicture['file_name']
                ];
                $this->userprofile->setUserid($this->input->post('userid'));
                $this->userprofile->setProfilepicture = $profilepicture['file_name'];
                $this->UserDbContext->update_user($this->userprofile->getUserid(), $data);
            }else{
                $data = [
                    'user_photo' => $profilepicture['file_name']
                ];
                $this->userprofile->setUserid($this->input->post('userid'));
                $this->userprofile->setProfilepicture = $profilepicture['file_name'];
                $this->UserDbContext->update_user($this->userprofile->getUserid(), $data);
            }
        }
        public function viewprofile() {
            try {
                if (empty($this->input->get('userid')))
                {
                    throw new InvalidArgumentException('Something went wrong!');
                }
                $userid = $this->input->get('userid');
                $data = $this->UserDbContext->view_profile($userid);
                echo json_encode($this->response(true,'Success',$data));
            } catch(Exception $ex) {
                echo json_encode($this->response(false,$ex->getMessage(),null));
            }
        }
        public function showteam() {
            try {
                if (empty($this->input->get('teamid')))
                {
                    throw new InvalidArgumentException('Something went wrong!');
                }
                $teamid = $this->input->get('teamid');
                $data = $this->UserDbContext->show_teammates($teamid);
                echo json_encode($this->response(true,'Success',$data));
            } catch(Exception $ex) {
                echo json_encode($this->response(false,$ex->getMessage(),null));
            }
        } 
        public function countusertask() {
            try {
                if (empty($this->input->get('userid')))
                {
                    throw new InvalidArgumentException('Something went wrong!');
                }
                $userid = $this->input->get('userid');
                $data = $this->UserDbContext->count_userstask($userid);
                echo json_encode($this->response(true,'Success',$data));
            } catch(Exception $ex) {
                echo json_encode($this->response(false,$ex->getMessage(),null));
            }
        }
        public function showKudos() {
            try {
                if (empty($this->input->get('userid')))
                {
                    throw new InvalidArgumentException('Something went wrong!');
                }
                $userid = $this->input->get('userid');
                $data = $this->UserDbContext->showkudos($userid);
                echo json_encode($this->response(true,'Success',$data));
            } catch(Exception $ex) {
                echo json_encode($this->response(false,$ex->getMessage(),null));
            }
        }
        //getting the response of each function and return to axios
        private function response($success,$msg=null,$result=null) {
            $response = array('success'=>$success);
            if (isset($msg)) $response['msg'] = $msg;
            if (isset($result)) $response['result'] = $result;
            return $response;
        }
    }