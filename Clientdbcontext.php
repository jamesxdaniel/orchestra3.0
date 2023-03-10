<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Clientdbcontext extends CI_Model {
        protected $table_name;
        protected $db;

        public function __construct() {
            parent::__construct();
            $this->db = $this->load->database('default',true);
            $this->table_name = 'accounts';
        }

        //Retrieve all clients from the database
        public function get_allclients($limit, $offset, $searchCriteria = null) {
            $query = $this->db
                    ->select('accounts.acc_id, accounts.company, accounts.opened_by, users.user_alias_name, accounts.date_added')
                    ->from($this->table_name)
                    ->join('users', 'users.user_id = accounts.opened_by')
                    ->order_by('accounts.date_added', 'DESC')
                    ->limit($limit, $offset)
                    ->get();

            if ($searchCriteria !== null) {
                $this->db->like('accounts.company', $searchCriteria);
            }

            if (count($query->result())>0) {
                $total = $this->db->count_all($this->table_name); // Get total number of clients
                return array('data' => $query->result(), 'total' => $total); 
            } else {
                throw new InvalidArgumentException('There are no clients found in the database!');
            }
        }

        public function search_client($criteria) {
            $query = $this->db
                    ->select('accounts.company, accounts.opened_by, users.user_alias_name, accounts.date_added')
                    ->from('accounts')
                    ->join('users', 'users.user_id = accounts.opened_by')
                    ->like('accounts.company', $criteria)
                    ->order_by('accounts.date_added', 'DESC')
                    ->get();
            
            if (count($query->result())>0) {
                $total = $this->db->count_all($this->table_name); // Get total number of clients
                return array('data' => $query->result(), 'total' => $total); 
            } else {
                throw new InvalidArgumentException('There are no client found in the database!');
            }
        }
        
    }