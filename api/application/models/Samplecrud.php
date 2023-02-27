<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class SampleCrud extends CI_Model{
        protected $table_name = 'users';
        protected $db;

        public function __construct(){
            parent::__construct();
            $this->db = $this->load->database('default',true);
        }

        //Create a new user in the database
        public function create_user($data){
            if(isset($data))
            {
                $this->db->insert($this->table_name,$data);
                if(count($this->db->insert_id()) > 0){
                    return $this->db->insert_id();
                }else{
                    throw new InvalidArgumentException('Data was not successfully saved to database');
                }
            }else{
                throw new InvalidArgumentException('Invalid data recieve');
            }
        }
        
        //Retrieve a user from the database by its id
        public function get_user($id){
            if(isset($id)){
                //add condtion after where like limit or offset instead of using just where
                $query = $this->db->get_where($this->table_name,array('id' => $id));
                return $query->result();
            }else{
                throw new InvalidArgumentException('The id that get_user recieve is null');
            }
        }
        
        //Retrieve all users from the database
        public function get_alluser(){
            $query = $this->db->get($this->table_name);
            if(count($query->result())>0){
                return $query->result();
            }else{
                throw new InvalidArgumentException('There is no user found in database');
            }
        }
        
        //Update a user in the database
        public function update_user($id,$data){
            if(isset($id) && isset($data))
            {
                $this->db->where('id',$id);
                $this->db->update($this->table_name, $data);                
            }else{
                throw new InvalidArgumentException('The parameters pass recieve is null');
            }
        }

        //Delete a user in the database
        public function delete_user($id){
            if(isset($id))            {
                $this->db->delete($this->table_name,array('id'=>$id));
            }else{
                throw new InvalidArgumentException('The parameters pass recieve is null');
            }
        }

        public function check_user($username, $password){

            if(isset($username) && isset($password)){

                $query = $this->db->get_where($this->table_name,array('users_username' => $username));
                //check if query has many rows
                if($query->num_rows() > 0){
                    foreach($query->result() as $row)
                    {
                        if(password_verify($password, $row->users_password)){
                            return $row;
                        }
                    }
                }
                
                return $query->result();
            }

        }
    }