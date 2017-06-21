<?php
    class business_model extends CI_Model {

        public function getAllBusiness()
        {
        	$this->db->select('*');
            $this->db->from('business');
            $this->db->where('id_business !=', "(select admin from config where id=1)", false);
            $query = $this->db->get();
            return $query->result();
        }

        public function changeStatus($id,$status){
        	$data = array(
               'status' => $status
            );
      			$this->db->where('id_business', $id);
      			$this->db->update('business', $data);
      			return $this->db->affected_rows();
        }

        public function getBusinessById($id)
        {
        	$this->db->select('*');
            $this->db->from('business');
            $this->db->join('ubdistrito', 'business.distrito = ubdistrito.idDist');
            $this->db->join('ubprovincia', 'ubdistrito.idProv = ubprovincia.idProv');
            $this->db->join('ubdepartamento', 'ubprovincia.idDepa = ubdepartamento.idDepa');
            $this->db->where('id_business', $id);
            $query = $this->db->get();
            return $query->row();
        }

        public function getUserById($id)
        {
          $this->db->select('*');
          $this->db->from('user');
          $this->db->join('business', 'business.id_business = user.id_business');
          $this->db->where('id_user', $id);
          $query = $this->db->get();
          return $query->row();
        }

        public function updateBusiness($id,$ruc,$name,$address,$phone,$email,$url,$logo,$gdniBusinessEdit,$gapellidosBusinessEdit,$gnombresBusinessEdit,$gemailBusinessEdit,$gdireccionBusinessEdit,$gtelefonoBusinessEdit,$pass,$revision,$distrito,$descripcion,$partida){
            $this->db->trans_start();
            $data = array(
               'ruc' => $ruc,
               'name_razonSocial' => $name,
               'address' => $address,
               'phone' => $phone,
               'email' => $email,
               'url' => $url,
               'logo' => $logo,
               'revision' => $revision,
               'distrito'=> $distrito,
               'actividad'=> $descripcion,
               'partida'=> $partida
            );
            $this->db->where('id_business', $id);
            $this->db->update('business', $data);

            if($pass==""){
                $data1 = array(
                   'dni_user' => $gdniBusinessEdit,
                   'apellidos_user' => $gapellidosBusinessEdit,
                   'nombres_user' => $gnombresBusinessEdit,
                   'direccion_user' => $gdireccionBusinessEdit,
                   'email_user' => $gemailBusinessEdit,
                   'telefono_user' => $gtelefonoBusinessEdit
                );
            }else{
                $data1 = array(
                   'dni_user' => $gdniBusinessEdit,
                   'apellidos_user' => $gapellidosBusinessEdit,
                   'nombres_user' => $gnombresBusinessEdit,
                   'direccion_user' => $gdireccionBusinessEdit,
                   'email_user' => $gemailBusinessEdit,
                   'telefono_user' => $gtelefonoBusinessEdit,
                   'password' => $pass
                );
            }
            
            $this->db->where('tipo', 2);
            $this->db->where('id_business', $id);
            $this->db->update('user', $data1);

            $this->db->trans_complete();

            return $this->db->trans_status();
        }

        public function addBusiness($ruc,$name,$address,$phone,$email,$url,$logo,$gdniBusinessEdit,$gapellidosBusinessEdit,$gnombresBusinessEdit,$gemailBusinessEdit,$gdireccionBusinessEdit,$gtelefonoBusinessEdit,$pass,$revision,$distrito,$descripcion,$partida){
            $this->db->trans_start();
            $data = array(
               'ruc' => $ruc,
               'name_razonSocial' => $name,
               'address' => $address,
               'phone' => $phone,
               'email' => $email,
               'url' => $url,
               'status' => 1,
               'logo' => $logo,
               'revision' => $revision,
               'distrito'=> $distrito,
               'actividad'=> $descripcion,
               'partida'=> $partida
            );
            $this->db->insert('business', $data);
            $id =  $this->db->insert_id();

            
            $data1 = array(
               'dni_user' => $gdniBusinessEdit,
               'apellidos_user' => $gapellidosBusinessEdit,
               'nombres_user' => $gnombresBusinessEdit,
               'direccion_user' => $gdireccionBusinessEdit,
               'email_user' => $gemailBusinessEdit,
               'telefono_user' => $gtelefonoBusinessEdit,
               'password' => $pass,
               'status'=>1,
               'tipo'=>2,
               'id_business'=>$id
            );
            
            $this->db->insert('user', $data1);

            $this->db->trans_complete();

            return $this->db->trans_status();
        }

        public function comprobarBusinessruc($id,$ruc)
        {
            $this->db->select('*');
            $this->db->from('business');
            $this->db->where('id_business !=', $id);
            $this->db->where('ruc', $ruc);
            $query = $this->db->get();
            return $query->row();
        }

        public function comprobarBusinessrucAdd($ruc)
        {
            $this->db->select('*');
            $this->db->from('business');
            $this->db->where('ruc', $ruc);
            $query = $this->db->get();
            return $query->row();
        }

        public function getGerenteByBusiness($id){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id_business', $id);
            $this->db->where('tipo', 2);
            $query = $this->db->get();
            return $query->row();
        }

    }
?>