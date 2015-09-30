<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditoria_model extends CI_Model {
	
	
	public function do_insert($dados=NULL, $redir=FALSE){
		if ($dados!=NULL) {
			$this->db->insert('auditoria', $dados);
			if ($redir) redirect(current_url());
		}
		
	}
	
	public function get_byid($id=NULL){
		if ($id!=NULL) {
			$this->db->where('id', $id);
			$this->db->limit(1);
			return $this->db->get('auditoria');
		} else {
			return FALSE;
		}
		
	}
	
	public function get_all($limit=0){
		if ($limit > 0) $this->db->limit($limit);
		return $this->db->get('auditoria');
	}
}
