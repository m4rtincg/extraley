<?php
    class contract_type_model extends CI_Model {

        public function selectAll()
        {
            $this->db->select('*');
            $this->db->from('contract_type');
            $this->db->where('status', 1);
            $query = $this->db->get();
            return $query->result();
        }   

    }
?>