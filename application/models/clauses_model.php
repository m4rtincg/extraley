<?php
    class clauses_model extends CI_Model {

        public function getClausesByType($type)
        {
            $this->db->select('clauses.tittle_clauses as title, clauses.id_clauses as id, template_contract.required as required');
            $this->db->from('clauses');
            $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
            $this->db->where('template_contract.status', 1);
            $this->db->where('clauses.status', 1);
            $this->db->where('template_contract.id_contract_type', $type);
            $this->db->order_by("template_contract.sort", "desc");
            $this->db->order_by("template_contract.id_template_contract_type","asc");
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

        public function getClausesByName($name,$type)
        {
            $this->db->select('tittle_clauses as title, description_clauses as description');
            $this->db->from('clauses');
            $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
            $this->db->where('clauses.status', 1);
            $this->db->where('template_contract.status', 1);
            $this->db->where('clauses.tittle_clauses', $name);
            $query = $this->db->get();
            return $query->row();
        }

        public function insertClauses($title,$desc){
            $data = array(
                'tittle_clauses' => $title,
                'description_clauses' => $desc,
                'status' => 1
            );

            $this->db->insert('clauses', $data);
            return $this->db->insert_id();
        }

        public function getClausesByTypeAdmin($type)
        {
            $this->db->select('*');
            $this->db->from('clauses');
            $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
            $this->db->where('template_contract.status', 1);
            $this->db->where('clauses.status', 1);
            $this->db->where('template_contract.id_contract_type', $type);
            $this->db->order_by("template_contract.sort", "desc");
            $this->db->order_by("template_contract.id_template_contract_type","asc");
            $query = $this->db->get();
            return $query->result();
        }
        
        public function deleteClausesTemplate($id){
            $this->db->where('id_template_contract_type', $id);
            $this->db->delete('template_contract');
            return $this->db->affected_rows();
        }

        public function changeRequired($id,$estado){
            $data = array(
               'required' => $estado
            );
            $this->db->where('id_template_contract_type', $id);
            $this->db->update('template_contract', $data);
            return $this->db->affected_rows();
        }
        public function updatesort($id, $val, $sort){
            $data = array(
               'sort' => $sort
            );
            $this->db->where('id_contract_type', $id);
            $this->db->where('id_clauses', $val);
            $this->db->update('template_contract', $data);
            return $this->db->affected_rows();
        }

        public function newClausesTemplate($newtitle,$newdescripcion,$select){
            $this->db->trans_start();

                $data = array(
                    'tittle_clauses' => $newtitle,
                    'description_clauses' => $newdescripcion,
                    'status' => 1
                );

                $this->db->insert('clauses', $data);
                $idClause =  $this->db->insert_id();


                $data1 = array(
                    'id_contract_type' => $select,
                    'id_clauses' => $idClause,
                    'required' => 1,
                    'status' => 1,
                    'sort' => 0
                );

                $this->db->insert('template_contract', $data1);
                $idTemplate =  $this->db->insert_id();


            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
                return array("status"=>false,"id"=>0,"idTemplate"=>0);
            }else{
                return array("status"=>true,"id"=>$idClause,"idTemplate"=>$idTemplate);
            }
        }

        public function editClausesTemplate($edittitle,$editdescripcion,$idedittypeclauses,$ideditclauses){
            $this->db->trans_start();

                $this->db->select('*');
                $this->db->from('template_contract');
                $this->db->where('id_contract_type', $idedittypeclauses);
                $this->db->where('id_clauses', $ideditclauses);
                $query = $this->db->get();
                $sort = $query->row()->sort;
                $required = $query->row()->required;

                $data = array(
                    'tittle_clauses' => $edittitle,
                    'description_clauses' => $editdescripcion,
                    'status' => 1
                );

                $this->db->insert('clauses', $data);
                $idClause =  $this->db->insert_id();


                $data1 = array(
                    'id_contract_type' => $idedittypeclauses,
                    'id_clauses' => $idClause,
                    'required' => $required,
                    'status' => 1,
                    'sort' => $sort
                );

                $this->db->insert('template_contract', $data1);
                $idTemplate =  $this->db->insert_id();

                $this->db->where('id_contract_type', $idedittypeclauses);
                $this->db->where('id_clauses', $ideditclauses);
                $this->db->delete('template_contract');

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
                return array("status"=>false,"id"=>0,"idTemplate"=>0);
            }else{
                return array("status"=>true,"id"=>$idClause,"idTemplate"=>$idTemplate);
            }
        }

        public function comprobate_name($type,$name){
            $this->db->select('*');
            $this->db->from('clauses');
            $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
            $this->db->where('template_contract.status', 1);
            $this->db->where('clauses.status', 1);
            $this->db->where('clauses.tittle_clauses', $name);
            $this->db->where('template_contract.id_contract_type', $type);
            $query = $this->db->get();
            return $query->result();
        }

        public function comprobate_name_edit($type,$name,$id){
            $this->db->select('*');
            $this->db->from('clauses');
            $this->db->join('template_contract', 'template_contract.id_clauses = clauses.id_clauses');
            $this->db->where('template_contract.status', 1);
            $this->db->where('clauses.id_clauses !=', $id);
            $this->db->where('clauses.status', 1);
            $this->db->where('clauses.tittle_clauses', $name);
            $this->db->where('template_contract.id_contract_type', $type);
            $query = $this->db->get();
            return $query->result();
        }

    }
?>