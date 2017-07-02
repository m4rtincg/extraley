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
            $this->db->select('(select count(*) from empleado_baja where id_empleado=id_employee) as baja,status, id_employee as id, name_employee as name, dni_employee as dni, lastname_employee as lastname, email_employee as email, phone_employee as phone, address_employee as address');
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



         //baja
         public function selectBajaById($id){
            $this->db->select("id_empleado, nombre_banco, DATE_FORMAT(fecha_culminacion, '%d/%m/%Y' ) AS fecha_culminacion, n_cuenta, lugar_entrega_cese, DATE_FORMAT(fecha_entrega_cese, '%d/%m/%Y' ) AS fecha_entrega_cese , DATE_FORMAT(fecha_inicio, '%d/%m/%Y' ) AS 'fecha_inicio' , lugar_entrega_constancia, DATE_FORMAT(fecha_entrega_constancia, '%d/%m/%Y' ) AS fecha_entrega_constancia, trabajo",false);
            $this->db->from('empleado_baja');
            $this->db->where('id_empleado' , $id);
            $query = $this->db->get();
            return $query->row();
         }
         public function updatebaja($id,$banco,$fecha_culminacion,$cuenta,$lugar1,$fecha1,$fecha_inicio,$bajapuestoAdd,$lugar2,$fecha2)
        {
            $data = array(
                'nombre_banco' => $banco,
                'fecha_culminacion' => $fecha_culminacion,
                'n_cuenta' => $cuenta,
                'lugar_entrega_cese' => $lugar1,
                'fecha_entrega_cese' => $fecha1,
                'fecha_inicio' => $fecha_inicio,
                'trabajo' => $bajapuestoAdd,
                'lugar_entrega_constancia' => $lugar2,
                'fecha_entrega_constancia' => $fecha2
            );

            $this->db->where('id_empleado', $id);
            $this->db->update('empleado_baja', $data);

            return $this->db->affected_rows();
        }
        public function deletebaja($id)
        {
            $this->db->where('id_empleado', $id);
            $this->db->delete('empleado_baja');
            return $this->db->affected_rows();
        }
        public function insertbaja($id,$banco,$fecha_culminacion,$cuenta,$lugar1,$fecha1,$fecha_inicio,$bajapuestoEdit,$lugar2,$fecha2)
        {
            $data = array(
                'id_empleado' => $id,
                'nombre_banco' => $banco,
                'fecha_culminacion' => $fecha_culminacion,
                'n_cuenta' => $cuenta,
                'lugar_entrega_cese' => $lugar1,
                'fecha_entrega_cese' => $fecha1,
                'fecha_inicio' => $fecha_inicio,
                'trabajo' => $bajapuestoEdit,
                'lugar_entrega_constancia' => $lugar2,
                'fecha_entrega_constancia' => $fecha2
            );

            $this->db->insert('empleado_baja', $data);
            return $this->db->insert_id();
        }
        public function selectBajaByIdAll($id){
            $this->db->select('*');
            $this->db->from('empleado_baja');
            $this->db->join('employee', 'employee.id_employee = empleado_baja.id_empleado');
            $this->db->join('business', 'business.id_business = employee.id_business');
            $this->db->where('id_empleado' , $id);
            $query = $this->db->get();
            return $query->row();
        }

        

    }
?>