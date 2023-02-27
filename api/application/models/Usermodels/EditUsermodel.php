<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class EditUsermodel extends CI_Model{
        protected $userid;
        protected $password;
        protected $zimbraemail;
        protected $gmailemail;
        protected $skypename;
        protected $webmail;
        protected $emaileremail;
        protected $contactnumber;
        protected $confirmpassword;
        protected $profilepicture;

        //getters for password
        public function getUserid(){
            return $this->userid;
        }
        //setters for password
        public function setUserid($id){
            if(isset($id))
            {
                $this->userid = $id;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }

        //getters for password
        public function getPassword(){
            return $this->password;
        }
        
        //setters for password
        public function setResPassword($pass, $confirmpass){

            if(isset($pass) && isset($confirmpass))
            {
                if(strcmp($pass,$confirmpass) == 0){
                    $this->password = $pass;
                }else{
                    throw new InvalidArgumentException('Password and Confirmpassword doesn`t match!');
                }
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }

        public function setPassword($pass){
            $this->password = $pass;
        }

        //getters for zimbraemail
        public function getZimbraemail(){
            return $this->zimbraemail;
        }
        
        //setters for zimbraemail
        public function setResZimbraemail($data){

            if(isset($data))
            {
                $this->zimbraemail = $data;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }
        public function setZimbraemail($data){
            $this->zimbraemail = $data;
        }

        //getters for gmailemail
        public function getGmailemail(){
            return $this->gmailemail;
        }
        
        //setters for gmailemail
        public function setResGmailemail($data){

            if(isset($data))
            {
                $this->gmailemail = $data;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }
        public function setGmailemail($data){
            $this->gmailemail = $data;
        }

        //getters for skypename
        public function getSkypename(){
            return $this->skypename;
        }
        
        //setters for skypename
        public function setResSkypename($data){

            if(isset($data))
            {
                $this->skypename = $data;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }
         //setters for skypename
         public function setSkypename($data){
            $this->skypename = $data;

        }

        //getters for webmail
        public function getWebmail(){
            return $this->webmail;
        }
        
        //setters for webmail
        public function setResWebmail($data){

            if(isset($data))
            {
                $this->webmail = $data;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }
        public function setWebmail($data){

            $this->webmail = $data;
        }
        
        //getters for emaileremail
        public function getEmaileremail(){
            return $this->emaileremail;
        }
        
        //setters for emaileremail
        public function setResEmaileremail($data){

            if(isset($data))
            {
                $this->emaileremail = $data;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }
        public function setEmaileremail($data){
            $this->emaileremail = $data;
        }

        //getters for contactnumber
        public function getContactnumber(){
            return $this->contactnumber;
        }
        
        //setters for contactnumber
        public function setResContactnumber($data){

            if(isset($data))
            {
                $this->contactnumber = $data;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }
        public function setContactnumber($data){
            $this->contactnumber = $data;
        }
        
        //getters for contactnumber
        public function getProfilepicture(){
            return $this->profilepicture;
        }
        
        //setters for contactnumber
        public function setResProfilepicture($data){

            if(isset($data))
            {
                $this->profilepicture = $data;
            }else{
                throw new InvalidArgumentException('Null value receive');
            }
        }
        public function setProfilepicture($data){
            $this->profilepicture = $data;
        }
    }