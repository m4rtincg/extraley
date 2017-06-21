<?php
    class config_model extends CI_Model {

        public function getConfig()
        {
            $this->db->select('*');
            $this->db->from('config');
            $query = $this->db->get();
            return $query->row();
        }
        public function updateConfig($nombre){
            $data = array(
                'nombre_login' => $nombre
            );
            $this->db->where('id', 1);
            $this->db->update('config', $data);
            return $this->db->affected_rows();
        }
        
    }
?>