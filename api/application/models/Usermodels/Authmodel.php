<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Authmodel extends CI_Model{
        protected $emailaddress;
        protected $password;

        //getters for email
        public function getEmail(){
            return $this->emailaddress;
        }
        
        //setters for email
        public function setEmail($data){
            if(isset($data))
            {
                $this->emailaddress = $data;
            }else{
                throw new InvalidArgumentException('Email is Required');
            }
        }

        //getters for password
        public function getPassword(){
            return $this->password;
        }

        //setters for password
        public function setPassword($data){
            if(isset($data))
            {
                $this->password = $data;
            }else{
                throw new InvalidArgumentException('Password is Required');
            }
        }
    }