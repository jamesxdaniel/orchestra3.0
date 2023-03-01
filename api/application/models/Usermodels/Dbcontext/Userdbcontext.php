<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Userdbcontext extends CI_Model {
        protected $table_name;
        protected $db;

        public function __construct() {
            parent::__construct();
            $this->db = $this->load->database('default',true);
            $this->table_name = 'users';
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
                throw new InvalidArgumentException('Data was not successfully saved to database');
            }
        }
        
        //Retrieve a user from the database by its id
        public function get_user($id){
            if(isset($id)){
                //add condtion after where like limit or offset instead of using just where
                $query = $this->db->get_where($this->table_name,array('user_id' => $id));
                return $query->row();
            }else{
                throw new InvalidArgumentException('The id that was recieved is null');
            }
        }
        
        //Retrieve all users from the database
        public function get_alluser(){
            $query = $this->db->get($this->table_name);
            if(count($query->result())>0){
                return $query->result();
            }else{
                throw new InvalidArgumentException('There is no user found in the database!');
            }
        }
        
        //Update a user in the database
        public function update_user($id,$data){
            if(isset($id) && isset($data))
            {
                $query = $this->db->get_where($this->table_name,array('user_id' => $id));
                $flag = 0;
                if(array_key_exists('user_password', $data))
                {
                    if($query->row()->user_password != $data['user_password'])
                    {
                        $flag = 0;
                    }else{
                        $flag = 1;
                        throw new InvalidArgumentException('It seems like you used your old password! Please enter a new password.');
                    }
                }
                if($flag == 0)
                {
                    $this->db->where('user_id',$id);
                    $res = $this->db->update($this->table_name, $data);
                    
                    if($res){
                        $query = $this->db
                        ->select('users.*,users_team.*,users_team_members.*')
                        ->from($this->table_name)
                        ->join('users_team_members','users_team_members.user_id = users.user_id')
                        ->join('users_team','users_team.team_id = users_team_members.team_id')
                        ->where(array('users.user_id' => $id))
                        ->get();
                        return $query->row_array();
                    }else{
                        throw new InvalidArgumentException('Sorry something went wrong! Try again later.');
                    }
                }
            }else{
                throw new InvalidArgumentException('Sorry something went wrong! Try again later.');
            }
        }

        //Delete a user in the database
        public function delete_user($id){
            if(isset($id)){
                $this->db->delete($this->table_name,array('id'=>$id));
            }else{
                throw new InvalidArgumentException('The parameters pass recieved is null');
            }
        }

        public function check_user($useremail, $password){
            $query = $this->db
                    ->select('users.*,users_team.*,users_team_members.*')
                    ->from($this->table_name)
                    ->join('users_team_members','users_team_members.user_id = users.user_id')
                    ->join('users_team','users_team.team_id = users_team_members.team_id')
                    ->where(array('users.user_email' => $useremail))
                    ->get();
            //check if query has many rows
            if($query->num_rows() > 0){
                if(sha1($password) == $query->row()->user_password){
                    return $query->result();
                }else{
                    throw new InvalidArgumentException('Email or password doesn\'t match!');
                }
            }else{
                throw new InvalidArgumentException('Email or password doesn\'t match!');
            }
        }
        //function to show teamates
        public function show_teammates($team_id){
            $query = $this->db
                    ->select('users.user_status,users.user_photo,users.user_id,users.user_full_name,ut.team_name as main_team_name,ust.team_name as sub_team_name,users_team_members.date_assigned,users_team_members.team_id')
                    ->from($this->table_name)
                    ->join('users_team_members','users_team_members.user_id = users.user_id')
                    ->join('users_sub_team ust', 'ust.id = users_team_members.sub_team_id')
                    ->join('users_team ut','ut.team_id = users_team_members.team_id')
                    ->where(array('users_team_members.team_id' => $team_id))
                    ->get();
            if($query->num_rows() > 0){
                return $query->result();
            }else{
                throw new InvalidArgumentException('You are not in a team yet!');
            }
        }
        //function to show user kudos
        public function count_userstask($user_id){
            $date = date('Y-m-d H:i:s');
            $query = $this->db
                    ->where(array('user_id' => $user_id))
                    ->where(array('DATE(date_assigned)' => Date($date)))
                    ->from('tasks_assign_log')
                    ->count_all_results();
            if($query >= 0)
            {
                return $query;
            }else{
                throw new InvalidArgumentException('Sorry something went wrong! Try again later.');
            }
        }
        public function showkudos($user_id)
        {
            $query = $this->db
                ->select('kudos.*,users.user_photo,users.user_alias_name')
                ->from('kudos')
                ->join('users', 'FIND_IN_SET(users.user_id, kudos.user_id) > 0')
                ->where("FIND_IN_SET('$user_id', kudos.user_id) !=", 0)
                ->group_by('kudos.kudos_id')
                ->get();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
        
                // Get the list of user IDs from the kudos result
                $user_ids = [];
                foreach ($result as $row) {
                    $ids = explode(',', $row['user_id']);
                    $user_ids = array_merge($user_ids, $ids);
                }
                $user_ids = array_unique($user_ids);
        
                // Get the user details for the user IDs in the kudos result
                $user_query = $this->db
                    ->select('users.*,ut.team_name as main_team_name,ut.team_id')
                    ->from('users')
                    ->join('users_team_members', 'users_team_members.user_id = users.user_id')
                    ->join('users_team ut', 'ut.team_id = users_team_members.team_id')
                    ->where_in('users.user_id', $user_ids)
                    ->get();
        
                if ($user_query->num_rows() > 0) {
                    $users = $user_query->result_array();
        
                    // Map the user details to the kudos result
                    foreach ($result as &$row) {
                        $ids = explode(',', $row['user_id']);
                        $row_users = array_filter($users, function($user) use ($ids) {
                            return in_array($user['user_id'], $ids);
                        });
                        $row_users = array_values($row_users);
                        $row['users'] = $row_users;
                    }
                    unset($row);
        
                    return $result;
                }
            }else if ($query->num_rows() <= 0) {
                $result = $query->result_array();
                return $result;
            }else{
                throw new InvalidArgumentException('Sorry something went wrong! Try again later.');
            }
        }
    }