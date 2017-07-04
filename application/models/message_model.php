<?php
    class message_model extends CI_Model {

        public function selectAllMessage()
        {
            $this->db->select('*');
            $this->db->from('messages');
            $query = $this->db->get();
            return $query->result();
        }
        public function selectAllMessageById($id)
        {
            $this->db->select('*');
            $this->db->from('messages');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->row();
        }
        public function updateMessage($id,$msg){
            $data = array(
               'msg' => $msg
            );
            $this->db->where('id', $id);
            $this->db->update('messages', $data);
            return $this->db->affected_rows();
        }
        public function deleteMessage($id){
            $this->db->where('id', $id);
            $this->db->delete('messages');
            return $this->db->affected_rows();
        }
        public function insertMessage($msg){
            $data = array(
               'msg' => $msg
            );
            $this->db->insert('messages', $data);
            return $this->db->insert_id();
        }
    }
?>