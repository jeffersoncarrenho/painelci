<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		init_painel();
	}

	public function index(){
		$this->load->view('nomeview');
	}
	
	public function login(){
		$this->form_validation->set_rules('usuario', 'USUÁRIO', 'trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');
		if ($this->form_validation->run()==TRUE){
			$usuario = $this->input->post('usuario', TRUE);
			$senha = md5($this->input->post('senha', TRUE));
			
			if ($this->usuarios->do_login($usuario, $senha)==TRUE) {
				$query = $this->usuarios->get_bylogin($usuario)->row();
				$dados = array(
					'user_id' => $query->id,
					'user_nome' => $query->nome,
					'user_admin' => $query->adm,
					'user_logado' => TRUE,
				);
				$this->session->set_userdata($dados);
				redirect('painel');
			} else {
				echo 'Login falhou';
			}
		}
		set_tema('titulo', 'Login');
		set_tema('conteudo', load_modulo('usuarios','login'));
		set_tema('rodape', '');
		load_template();
	}
}