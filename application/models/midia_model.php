<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midia_model extends CI_Model {
	public function do_insert($dados=NULL, $redir=TRUE){
		if ($dados!=NULL) {
			$this->db->insert('midia', $dados);
			if ($this->db->affected_rows()>0) {
				auditoria('Inclusão de mídia', 'Nova mídia cadastrada no sistema');
				set_msg('msgok', 'Cadastro efetuado com sucesso', 'sucesso');
			}else {
				set_msg('msgerro', 'Erro ao cadastrar usuário', 'erro');
			}
			if ($redir) redirect(current_url());
		}
		
	}
	public function do_update($dados=NULL, $condicao=NULL, $redir=TRUE){
		if ($dados!=NULL && is_array($condicao)) {
			$this->db->update('midia', $dados, $condicao);
			if ($this->db->affected_rows()>0) {
				auditoria('Alteração de mídia', 'A mídia com o id "'.$condicao['id'].'" foi alterada');
				set_msg('msgok', 'Alteração efetuada com sucesso', 'sucesso');
			}else {
				set_msg('msgerro', 'Erro ao atualizar dados', 'erro');
			}
			if ($redir) redirect(current_url());		
		}
	}

	public function do_delete($condicao=NULL, $redir=TRUE){
		if ($condicao!=NULL && is_array($condicao)) {
			$this->db->delete('midia', $condicao);
			if ($this->db->affected_rows()>0) {
				auditoria('Exclusão de mídia', 'A Mídia com o id "'.$condicao->id.'" foi excluída');
				set_msg('msgok', 'Mídia excluída com sucesso', 'sucesso');
			} else {
				set_msg('msgerro', 'Erro ao excluir mídia', 'erro');
			}
			
			set_msg('msgok', 'Mídia excluída com sucesso', 'sucesso');
			if ($redir) redirect(current_url());
		}
	}
	
	public function do_upload($campo){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload($campo)) {
			return $this->upload->data();
		} else {
			return $this->upload->display_errors();
		}
		
	}
	
	public function get_all(){
		return $this->db->get('midia');
	}	
	
	public function get_byid($id=NULL){
		if ($id!=NULL) {
			$this->db->where('id', $id);
			$this->db->limit(1);
			return $this->db->get('midia');
		} else {
			return FALSE;
		}
		
	}
}