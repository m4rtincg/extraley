<?php
    class contract_model extends CI_Model {

        public function selectAllContract()
        {
            $this->db->select('*,(Select view from foro where foro.id_contract = contract.contract_id order by id_foro DESC LIMIT 1) as vista');
            $this->db->from('contract');
            $this->db->join('contract_type', 'contract_type.id_contract_type = contract.contract_type_id');
            $this->db->join('work', 'work.id_work = contract.work_id');
            $this->db->join('employee', 'employee.id_employee = contract.employee_id');
            $this->db->join('user', 'contract.user_id_create = user.id_user');
            $this->db->join('business', 'business.id_business = user.id_business');
            //$this->db->where('user.id_business', $business);
            $this->db->order_by('contract.contract_id', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }
        public function selectAllContractBusiness($business)
        {
            $this->db->select('*,(Select view from foro where foro.id_contract = contract.contract_id order by id_foro DESC LIMIT 1) as vista');
            $this->db->from('contract');
            $this->db->join('contract_type', 'contract_type.id_contract_type = contract.contract_type_id');
            $this->db->join('work', 'work.id_work = contract.work_id');
            $this->db->join('employee', 'employee.id_employee = contract.employee_id');
            $this->db->join('user', 'contract.user_id_create = user.id_user');
            $this->db->join('business', 'business.id_business = user.id_business');
            $this->db->where('user.id_business', $business);
            $this->db->order_by('contract.contract_id', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }
        public function selectAllContractUser($user)
        {
            $this->db->select('*,(Select view from foro where foro.id_contract = contract.contract_id order by id_foro DESC LIMIT 1) as vista');
            $this->db->from('contract');
            $this->db->join('contract_type', 'contract_type.id_contract_type = contract.contract_type_id');
            $this->db->join('work', 'work.id_work = contract.work_id');
            $this->db->join('employee', 'employee.id_employee = contract.employee_id');
            $this->db->join('user', 'contract.user_id_create = user.id_user');
            $this->db->join('business', 'business.id_business = user.id_business');
            $this->db->where('contract.user_id_create', $user);
            $this->db->order_by('contract.contract_id', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }




        public function selectContractById($id)
        {
            $this->db->select('*');
            $this->db->from('contract');
            $this->db->join('contract_type', 'contract_type.id_contract_type = contract.contract_type_id');
            $this->db->join('work', 'work.id_work = contract.work_id');
            $this->db->join('employee', 'employee.id_employee = contract.employee_id');
            $this->db->join('user', 'contract.user_id_create = user.id_user');
            $this->db->join('business', 'business.id_business = user.id_business');

            $this->db->join('ubdistrito', 'ubdistrito.idDist = business.distrito');
            $this->db->join('ubprovincia', 'ubprovincia.idProv = ubdistrito.idProv');
            $this->db->join('ubdepartamento', 'ubdepartamento.idDepa = ubprovincia.idDepa');

            $this->db->where('contract.contract_id', $id);
            $query = $this->db->get();
            return $query->row();
        }

        public function selectClausulasByContract($id){
        	$this->db->select('*');
            $this->db->from('contract');
            $this->db->join('contract_clauses', 'contract_clauses.contract_id = contract.contract_id');
            $this->db->join('clauses', 'clauses.id_clauses = contract_clauses.clauses_id');
            $this->db->where('contract.contract_id', $id);
            $this->db->order_by('contract_clauses.orden', 'ASC');
            $query = $this->db->get();
            return $query->result();
        }
        
        public function insertContract($type,$plazo,$dateInicio,$dateFin,$date,
                                                        $work,$user,$employee,$comment,$clauses,
                                                        $typecontrato,$tipoRemuneracion,$montoRemuneracion,$detalleworkcontract,$explicaworkcontract,$lugarfirma)
        {
        	$this->db->trans_start();
	            $data = array(
	                'contract_type_id' => $type,
	                'plazo' => $plazo,
	                'fecha_inicio' => $dateInicio,
	                'fecha_fin' => $dateFin,
                    'fecha' => $date,
	                'work_id' => $work,
	                'user_id_create' => $user,
	                'user_id_approve' => 0,
	                'employee_id' => $employee,
	                'status_contract' => 1,
	                'comment_contract' => $comment,
	                'status' => 1,
	                'type_remuneracion' => $tipoRemuneracion,
	                'remuneracion' => $montoRemuneracion,
                    'detalleworkcontract' => $detalleworkcontract,
                    'explicaworkcontract' => $explicaworkcontract,
                    'firmapdf' => '',
                    'lugarcontract' => $lugarfirma
	            );

	            $this->db->insert('contract', $data);
	            $idContrato =  $this->db->insert_id();


                $this->db->select('clauses.tittle_clauses as title, clauses.id_clauses as id, template_contract.required as required');
                $this->db->from('clauses');
                $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
                $this->db->where('template_contract.status', 1);
                $this->db->where('clauses.status', 1);
                $this->db->where('template_contract.id_contract_type', $type);
                $this->db->order_by("template_contract.sort", "desc");
                $this->db->order_by("template_contract.id_template_contract_type","asc");
                $query = $this->db->get();
                $clausulas = $query->result();

                $arraOrden = array();
                $contador = 1;
                foreach ($clausulas as $key) {
                    $arraOrden[$key->id]= $contador;
                    $contador = $contador + 1;
                }


	            $requeridos = $this->getClausesRequerid($typecontrato);
	            foreach ($requeridos as $key) {
	            	$data1 = array(
		                'contract_id' => $idContrato,
		                'clauses_id' => $key->id,
                        'orden' => $arraOrden[$key->id]
		            );
		            $this->db->insert('contract_clauses', $data1);
	            }
	            foreach($clauses as $clause){
                    if($clause != ""){
                        $data2 = array(
                            'contract_id' => $idContrato,
                            'clauses_id' => $clause,
                            'orden' => $arraOrden[$clause]
                        );
                        $this->db->insert('contract_clauses', $data2);
                    }
	            }
	        $this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
			    return array("status"=>false,"id"=>0);
			}else{
				return array("status"=>true,"id"=>$idContrato);
			}

        }

        public function getClausesRequerid($type)
        {
            $this->db->select('clauses.id_clauses as id');
            $this->db->from('clauses');
            $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
            $this->db->where('template_contract.status', 1);
            $this->db->where('clauses.status', 1);
            $this->db->where('template_contract.required', 0);
            $this->db->where('template_contract.id_contract_type', $type);
            $query = $this->db->get();
            return $query->result();
        }

        public function uploadFirma($id,$logo){
            $data = array(
               'firmapdf' => $logo
            );
                $this->db->where('contract_id', $id);
                $this->db->update('contract', $data);
                return $this->db->affected_rows();
        }
        

        public function changeContractStatus($id,$estado,$user){
            if($user==0){
                $data = array(
                   'status_contract' => $estado
                );
            }else{
                $data = array(
                   'user_id_create' => $user,
                   'status_contract' => $estado
                );
            }
            
            $this->db->where('contract_id', $id);
            $this->db->update('contract', $data);
            return $this->db->affected_rows();
        }

    }
?>