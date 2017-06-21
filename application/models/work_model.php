<?php
    class work_model extends CI_Model {

        public function selectById($id)
        {
            $this->db->select('*');
            $this->db->from('work');
            $this->db->where('id_work', $id);
			$this->db->where('status', 1);
            $query = $this->db->get();
            return $query->row();
        }

        public function selectByName($name)
        {
            $this->db->select('*');
            $this->db->from('work');
            $this->db->where('name_work', $name);
            $query = $this->db->get();
            return $query->row();
        }

        public function selectAll()
        {
            $this->db->select('*');
            $this->db->from('work');
            $this->db->where('status', 1);
            $query = $this->db->get();
            return $query->result();
        }
        
        public function insertWork($name, $descripcion)
        {
            $data = array(
                'name_work' => $name,
                'descripcion_work' => $descripcion,
                'status' => 1
            );

            $this->db->insert('work', $data);
            return $this->db->insert_id();
        }

        public function searchByName($name,$all)
        {
            $this->db->select('id_work as id , name_work as name, descripcion_work as descripcion');
            $this->db->from('work');
            $this->db->like('name_work', $name);
            if($all==1){
                $this->db->limit(5);
            }
            $query = $this->db->get();
            return $query->result();
        }
        

    }
?>