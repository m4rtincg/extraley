<?php
    class user_model extends CI_Model {

        public function login($ruc, $dni, $pass)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->join('business', 'business.id_business = user.id_business');
            $this->db->where('ruc', $ruc);
            $this->db->where('dni_user', $dni);
      			$this->db->where('password', $pass);
      			$this->db->where('business.status', 1);
      			$this->db->where('user.status', 1);
            $query = $this->db->get();
            return $query->row();
        }

        public function adduser($dni,$apellidos,$nombres,$direccion,$email,$telefono,$pass,$id_business){
            
            $data = array(
               'dni_user' => $dni,
               'apellidos_user' => $apellidos,
               'nombres_user' => $nombres,
               'direccion_user' => $direccion,
               'email_user' => $email,
               'telefono_user'=> $telefono,
               'password'=>$pass,
               'id_business'=>$id_business,
               'status'=>1,
               'tipo'=>1
            );

            $this->db->insert('user', $data);
            return $this->db->insert_id();
        }

        public function edituser($id,$dni,$apellidos,$nombres,$direccion,$email,$telefono,$pass){
            if($pass==false){
              $data = array(
                'dni_user' => $dni,
                'apellidos_user' => $apellidos,
                'nombres_user' => $nombres,
                'direccion_user' => $direccion,
                'email_user' => $email,
                'telefono_user'=> $telefono
              );
            }else{
              $data = array(
                'dni_user' => $dni,
                'apellidos_user' => $apellidos,
                'nombres_user' => $nombres,
                'direccion_user' => $direccion,
                'email_user' => $email,
                'telefono_user'=> $telefono,
                'password'=>$pass
              );
            }
            

            $this->db->where('id_user', $id);
            $this->db->update('user', $data);

            return $this->db->affected_rows();
        }

        public function deleteuser($id,$status)
        {
            $data = array(
            'status'=>$status
            );

            $this->db->where('id_user', $id);
            $this->db->update('user', $data);

            return $this->db->affected_rows();
        }

        public function selectByAll($business)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id_business', $business);
            $this->db->where('tipo', 1);
            $query = $this->db->get();
            return $query->result();
        }

        public function selectByAllStatus($business)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id_business', $business);
            $this->db->where('tipo', 1);
            $this->db->where('status', 1);
            $query = $this->db->get();
            return $query->result();
        }

          public function selectById($id)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id_user', $id);
            $query = $this->db->get();
            return $query->row();
        }

        public function comprobardniAdd($dni,$id_business)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('dni_user', $dni);
            $this->db->where('id_business', $id_business);
            $query = $this->db->get();
            return $query->result();
        }

         public function comprobardniEdit($id,$dni,$id_business){
            $this->db->select('*');
            $this->db->from('user');
              $this->db->where('id_user !=' , $id);
            $this->db->where('dni_user', $dni);
            $this->db->where('id_business', $id_business);
            $query = $this->db->get();
            return $query->result();
         }
          
         public function actualizarDatos($iduser, $apellidosuser,$nombresuser, $direccionuser,$emailuser, $telefonouser){
            $data = array(
                'apellidos_user' => $apellidosuser,
                'nombres_user' => $nombresuser,
                'direccion_user' => $direccionuser,
                'email_user' => $emailuser,
                'telefono_user'=> $telefonouser
              );

            $this->db->where('id_user', $iduser);
            $this->db->update('user', $data);

            return $this->db->affected_rows();
         }

         public function actualizarDatosPassword($id, $newpassword){
            $data = array(
                'password'=>$newpassword
              );

            $this->db->where('id_user', $id);
            $this->db->update('user', $data);

            return $this->db->affected_rows();
         }

         public function deshabilitar($id){
            $data = array(
                'status'=>0
              );

            $this->db->where('id_user', $id);
            $this->db->update('user', $data);

            return $this->db->affected_rows();
         }
    }
?>