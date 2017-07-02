<?php
    class clauses_model extends CI_Model {

        public function getClausesByType($type,$empresa)
        {
            $this->db->select('clauses.tittle_clauses as title, clauses.id_clauses as id, clauses.required as required');
            $this->db->from('clauses');
            $this->db->where('clauses.status', 1);
            $this->db->where('clauses.id_contract_type', $type);
            $this->db->where('clauses.id_business', $empresa);
            $this->db->order_by("clauses.sort", "desc");
            $this->db->order_by("clauses.id_clauses","asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function getClausesById($id)
        {
            $this->db->select('tittle_clauses as title, description_clauses as description');
            $this->db->from('clauses');
            $this->db->where('clauses.status', 1);
            $this->db->where('clauses.id_clauses', $id);
            $query = $this->db->get();
            return $query->row();
        }

       /* public function getClausesByName($name,$type)
        {
            $this->db->select('tittle_clauses as title, description_clauses as description');
            $this->db->from('clauses');
            $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
            $this->db->where('clauses.status', 1);
            $this->db->where('template_contract.status', 1);
            $this->db->where('clauses.tittle_clauses', $name);
            $query = $this->db->get();
            return $query->row();
        }*/
        /*
        public function insertClauses($title,$desc){
            $data = array(
                'tittle_clauses' => $title,
                'description_clauses' => $desc,
                'status' => 1
            );

            $this->db->insert('clauses', $data);
            return $this->db->insert_id();
        }
        */
        public function getClausesByTypeAdmin($empresa, $tipo)
        {
            $this->db->select('*');
            $this->db->from('clauses');
            $this->db->where('clauses.status', 1);
            $this->db->where('clauses.id_contract_type', $tipo);
            $this->db->where('clauses.id_business', $empresa);
            $this->db->order_by("clauses.sort", "desc");
            $this->db->order_by("clauses.id_clauses","asc");
            $query = $this->db->get();
            return $query->result();
        }
        
        public function deleteClausesTemplate($id){
            $this->db->where('id_clauses', $id);
            $this->db->delete('clauses');
            return $this->db->affected_rows();
        }

        public function changeRequired($id,$estado){
            $data = array(
               'required' => $estado
            );
            $this->db->where('id_clauses', $id);
            $this->db->update('clauses', $data);
            return $this->db->affected_rows();
        }
        public function updatesort($tipo, $empresa, $val, $sort){
            $data = array(
               'sort' => $sort
            );
            $this->db->where('id_clauses', $val);
            $this->db->update('clauses', $data);
            return $this->db->affected_rows();
        }

        public function newClausesTemplate($newtitle,$newdescripcion,$select,$empresa){
            $this->db->trans_start();

                $data = array(
                    'id_contract_type' => $select,
                    'id_business' => $empresa,
                    'tittle_clauses' => $newtitle,
                    'description_clauses' => $newdescripcion,
                    'status' => 1,
                    'required' => 1,
                    'sort' => 0
                );

                $this->db->insert('clauses', $data);
                $idClause =  $this->db->insert_id();

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
                return array("status"=>false,"id"=>0);
            }else{
                return array("status"=>true,"id"=>$idClause);
            }
        }

        public function editClausesTemplate($edittitle,$editdescripcion,$idedittypeclauses,$ideditclauses,$empresa){
            $this->db->trans_start();

                $data = array(
                    'tittle_clauses' => $edittitle,
                    'description_clauses' => $editdescripcion
                );

                $this->db->where('id_clauses', $ideditclauses);
                $this->db->update('clauses', $data);

                $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
                return array("status"=>false,"id"=>0);
            }else{
                return array("status"=>true,"id"=>$ideditclauses);
            }
        }

        public function comprobate_name($type,$name,$empresa){
            $this->db->select('*');
            $this->db->from('clauses');
            $this->db->where('clauses.status', 1);
            $this->db->where('clauses.tittle_clauses', $name);
            $this->db->where('clauses.id_contract_type', $type);
            $this->db->where('clauses.id_business', $empresa);
            $query = $this->db->get();
            return $query->result();
        }

        public function comprobate_name_edit($type,$name,$id,$empresa){
            $this->db->select('*');
            $this->db->from('clauses');
            $this->db->where('clauses.id_clauses !=', $id);
            $this->db->where('clauses.status', 1);
            $this->db->where('clauses.tittle_clauses', $name);
            $this->db->where('clauses.id_contract_type', $type);
            $this->db->where('clauses.id_business', $empresa);
            $query = $this->db->get();
            return $query->result();
        }


        public function selectcalusesByContractSaved($id){
            $this->db->select('clauses_id as id');
            $this->db->from('contract_clauses');
            $this->db->where('contract_id', $id);
            $query = $this->db->get();
            return $query->result();
        }


    }
?>