<?php
    class config_model extends CI_Model {

        public function getConfig()
        {
            $this->db->select('*');
            $this->db->from('config');
            $query = $this->db->get();
            return $query->row();
        }
        public function updateConfig($dias){
            $data = array(
                'diasPrevios' => $dias
            );
            $this->db->where('id', 1);
            $this->db->update('config', $data);
            return $this->db->affected_rows();
        }

        public function getSliders()
        {
            $this->db->select('*');
            $this->db->from('sliders');
            $query = $this->db->get();
            return $query->result();
        }

        public function getSlidersById($id)
        {
            $this->db->select('*');
            $this->db->from('sliders');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->row();
        }

        public function deleteSlider($id){
            $this->db->where('id', $id);
            $this->db->delete('sliders');
            return $this->db->affected_rows();
        }

        public function addSlider($name){
          $data = array(
               'name_imagen' => $name
            );
          $this->db->insert('sliders', $data);
          return $this->db->insert_id();
        }
        
    }
?>