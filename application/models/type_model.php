<?php
    class type_model extends CI_Model {

        public function selectAll()
        {
            $this->db->select('*');
            $this->db->from('type');
			$this->db->where('status', 1);
            $query = $this->db->get();
            return $query->result();
        }
        public function selectAllContractTypeByType($type)
        {
            $this->db->select('id_contract_type as id, name_contract_type as name');
            $this->db->from('contract_type');
			$this->db->where('status', 1);
			$this->db->where('id_type', $type);
            $query = $this->db->get();
            return $query->result();
        }
        public function selectContractTypeById($id)
        {
            $this->db->select('name_contract_type as name');
            $this->db->from('contract_type');
            $this->db->where('id_contract_type', $id);
            $query = $this->db->get();
            return $query->row();
        }
        
    }
?>