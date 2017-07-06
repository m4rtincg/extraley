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


        function addType($nombre,$descripcion){
            $data = array(
                'name_contract_type' => $nombre,
                'descripciontype' => $descripcion,
                'id_type'=>1,
                'status'=>1
            );

            $this->db->insert('contract_type', $data);
            return $this->db->insert_id();
        }

        function editType($id,$nombre,$descripcion){
            $data = array(
                'name_contract_type' => $nombre,
                'descripciontype' => $descripcion
            );

            $this->db->where('id_contract_type', $id);
            $this->db->update('contract_type', $data);

            return $this->db->affected_rows();
        }

        function selectTypeById($id){
            $this->db->select('name_contract_type as name, id_contract_type as id, descripciontype as descripcion');
            $this->db->from('contract_type');
            $this->db->where('id_contract_type', $id);
            $query = $this->db->get();
            return $query->row();
        }

        public function comprobarTypeEdit($id,$name)
        {
            $this->db->select('*');
            $this->db->from('contract_type');
            $this->db->where('id_contract_type !=', $id);
            $this->db->where('name_contract_type', $name);
            $query = $this->db->get();
            return $query->row();
        }

        public function comprobarTypeAdd($name)
        {
            $this->db->select('*');
            $this->db->from('contract_type');
            $this->db->where('name_contract_type', $name);
            $query = $this->db->get();
            return $query->row();
        }
        
    }
?>