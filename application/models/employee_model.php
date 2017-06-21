<?php
    class employee_model extends CI_Model {

        public function selectByDoc($dni,$idbusiness)
        {
            $this->db->select('id_employee as id, name_employee as name, lastname_employee as lastname, email_employee as email, phone_employee as phone, address_employee as address');
            $this->db->from('employee');
            $this->db->where('dni_employee', $dni);
            $this->db->where('id_business', $idbusiness);
			$this->db->where('status', 1);
            $query = $this->db->get();
            return $query->row();
        }
        
        public function insertEmployee($name,$lastname,$dni,$address,$email,$phone,$idbusiness)
        {
            $data = array(
                'name_employee' => $name,
                'lastname_employee' => $lastname,
                'dni_employee' => $dni,
                'email_employee' => $email,
                'phone_employee' => $phone,
                'id_business' => $idbusiness,
                'address_employee' => $address,
                'status' => 1
            );

            $this->db->insert('employee', $data);
            return $this->db->insert_id();
        }

        public function editEmployee($id,$name,$lastname,$dni,$address,$email,$phone){
            $data = array(
                'name_employee' => $name,
                'lastname_employee' => $lastname,
                'dni_employee' => $dni,
                'email_employee' => $email,
                'phone_employee' => $phone,
                'address_employee' => $address
            );

            $this->db->where('id_employee', $id);
            $this->db->update('employee', $data);
            return $this->db->affected_rows();
        }

         public function selectByAll($idbusiness)
        {
            $this->db->select('id_employee as id, name_employee as name, dni_employee as dni, lastname_employee as lastname, email_employee as email, phone_employee as phone, address_employee as address');
            $this->db->from('employee');
            $this->db->where('id_business', $idbusiness);
            //$this->db->where('status', 1);
            $query = $this->db->get();
            return $query->result();
        }

        
         public function deleteemployee($id,$status)
        {
            $data = array(
            'status'=>$status
            );

            $this->db->where('id_employee', $id);
            $this->db->update('employee', $data);

            return $this->db->affected_rows();
        }

           public function selectById($id)
        {
           $this->db->select('*');
            $this->db->from('employee');
            $this->db->where('id_employee', $id);
            $query = $this->db->get();
            return $query->row();
        }

            public function comprobardniAdd($dni,$id_business)
        {
            $this->db->select('*');
            $this->db->from('employee');
            $this->db->where('id_employee', $dni);
            $this->db->where('id_business', $id_business);
            $query = $this->db->get();
            return $query->result();
        }

         public function comprobardniEdit($id,$dni,$id_business){
            $this->db->select('*');
            $this->db->from('employee');
              $this->db->where('id_employee !=' , $id);
            $this->db->where('dni_employee', $dni);
            $this->db->where('id_business', $id_business);
            $query = $this->db->get();
            return $query->result();
         }


        

    }
?>