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

        public function selectAllBybusiness($empresa)
        {
            $this->db->select('*');
            $this->db->from('contract_type');
            $this->db->join('business_type', 'contract_type.id_contract_type = business_type.id_type');
            $this->db->where('status', 1);
            $this->db->where('business_type.id_business',$empresa);
            $query = $this->db->get();
            return $query->result();
        }   

    }
?>