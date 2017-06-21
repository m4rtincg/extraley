<?php
    class foro_model extends CI_Model {

        public function selectByContract($id)
        {
            $this->db->select('foro.type as type,foro.date as fecha, foro.text as texto,user.apellidos_user as apellidos,user.nombres_user as nombres,user.id_user as id');
            $this->db->from('foro');
            $this->db->join('user', 'foro.id_user = user.id_user');
            $this->db->where('id_contract', $id);
			$this->db->where('foro.status', 1);
            $this->db->order_by("foro.date", "asc");
            $query = $this->db->get();
            return $query->result();
        }
        
        public function insertForo($contract,$user,$text,$type)
        {
            $data = array(
                'id_user' => $user,
                'id_contract' => $contract,
                'text' => $text,
                'view' => $user,
                'status' => 1,
                'type' => $type
            );
            $this->db->set('date', 'NOW()', FALSE);
            $this->db->insert('foro', $data);
            return $this->db->insert_id();
        }

        public function selectBydate($id,$date){
            $this->db->select('foro.type as type,foro.date as fecha, foro.text as texto,user.apellidos_user as apellidos,user.nombres_user as nombres,user.id_user as id');
            $this->db->from('foro');
            $this->db->join('user', 'foro.id_user = user.id_user');
            $this->db->where('id_contract', $id);
            $this->db->where('foro.status', 1);
            $this->db->where('foro.date >', $date);
            $this->db->order_by("foro.date", "asc");
            $query = $this->db->get();
            return $query->result();
        }
        
        public function update_view($id,$user){
        	$this->db->select('view');
            $this->db->from('foro');
            $this->db->where('id_contract', $id);
			$this->db->where('foro.status', 1);
            $this->db->order_by("foro.date", "desc");
            $this->db->limit(1);
            $query = $this->db->get();

            $view = ($query->row()) ? $query->row()->view : '';

            $arraView = explode(";",$view);
            if (! in_array($user, $arraView)) {
                $data = array(
                   'view' => $view.';'.$user
                );
                $this->db->where('id_contract', $id);
                $this->db->update('foro', $data);
            }

        }

        public function date(){
            $this->db->select('NOW() as fecha');
            $query = $this->db->get();
            return $query->row()->fecha;
        }

    }
?>