<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {
	
	
	public function do_insert($dados=NULL, $redir=TRUE){
		if ($dados!=NULL) {
			$this->db->insert('usuarios', $dados);
			set_msg('msgok', 'Cadastro efetuado com sucesso', 'sucesso');
			if ($redir) redirect(current_url());
		}
		
	}
	
	public function do_update($dados=NULL, $condicao=NULL, $redir=TRUE){
		if ($dados!=NULL && is_array($condicao)) {
			$this->db->update('usuarios', $dados, $condicao);
			set_msg('msgok', 'Alteração efetuada com sucesso', 'sucesso');
			if ($redir) redirect(current_url());		
		}
	}
	
	public function do_login($usuario=NULL, $senha=NULL){
		if ($usuario && $senha) {
			$this->db->where('login', $usuario);
			$this->db->where('senha', $senha);
			$this->db->where('ativo', 1);
			$query = $this->db->get('usuarios');
			if ($query->num_rows == 1) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}	
	
	public function get_bylogin($login=NULL){
		if ($login!=NULL) {
			$this->db->where('login', $login);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		} else {
			return FALSE;
		}
		
	}
	
	public function get_byemail($email=NULL){
		if ($email!=NULL) {
			$this->db->where('email', $email);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		} else {
			return FALSE;
		}
		
	}
	
	public function get_byid($id=NULL){
		if ($id!=NULL) {
			$this->db->where('id', $id);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		} else {
			return FALSE;
		}
		
	}
	
	public function get_all(){
		return $this->db->get('usuarios');
	}	
	
}















