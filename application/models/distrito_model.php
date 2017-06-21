<?php
    class distrito_model extends CI_Model {

        public function selectdepartamentos()
        {
            $this->db->select('*');
            $this->db->from('ubdepartamento');
            $query = $this->db->get();
            return $query->result();
        }
        public function selectprovincia($departamento)
        {
            $this->db->select('*');
            $this->db->from('ubprovincia');
            $this->db->where('idDepa',$departamento);
            $query = $this->db->get();
            return $query->result();
        }
        public function selectdistrito($provincia)
        {
            $this->db->select('*');
            $this->db->from('ubdistrito');
            $this->db->where('idProv',$provincia);
            $query = $this->db->get();
            return $query->result();
        }
        
    }
?>