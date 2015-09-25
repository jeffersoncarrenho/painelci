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
				$query = $this->usuarios->get_bylogin($usuario)->row();
				if (empty($query)) {
					set_msg('errologin', 'Usuário inexistente', 'erro');					
				} elseif($query->senha!=$senha) {
					set_msg('errologin', 'Senha está incorreta', 'erro');
				}elseif($query->ativo==0){
					set_msg('errologin', 'Este usuário está inativo', 'erro');
				}else{
					set_msg('errologin', 'Erro desconhecido, contate o desenvolvedor', 'erro');
				}
				redirect('usuarios/login');
			}
		}
		set_tema('titulo', 'Login');
		set_tema('conteudo', load_modulo('usuarios','login'));
		set_tema('rodape', '');
		load_template();
	}
	
	public function logoff(){
		$this->session->unset_userdata(array('user_id'=>'', 'user_nome'=>'','user_admin'=>'', 'user_logado'=>''));
		$this->session->sess_destroy();
		$this->session->sess_create();
		set_msg('logoffok', 'Logoff efetuado com sucesso', 'sucesso');
		redirect('usuarios/login');
	}
	
	public function nova_senha(){
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|strtolower|valid_email');
		if ($this->form_validation->run()==TRUE){
			$email = $this->input->post('email');
			$query = $this->usuarios->get_byemail($email);
			if ($query->num_rows()==1) {
				$novasenha = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnm0123456789'), 0,6);
				$mensagem = "<p>Você solicitou uma nova senha para o acesso ao painel de administração do site, a partir de agora use a seguinte senha para acesso: <strong>$novasenha</strong></p><p> Troque essa senha para uma senha segura e de sua preferência o quanto antes.</p>";
				if ($this->sistema->enviar_email($email, 'Nova senha de acesso', $mensagem)) {
					$dados['senha'] = md5($novasenha);
					$this->usuarios->do_update($dados, array('email'=>$email), FALSE);
					set_msg('msgok','Uma nova senha foi enviada para seu email. Senha: <strong>'.$novasenha.'</strong>', 'sucesso');
					redirect('usuarios/nova_senha');
				} else {
					set_msg('msgerro','Erro ao enviar a nova senha, contate o administrador', 'erro');
					redirect('usuarios/nova_senha');
				}				
			} else {
				set_msg('msgerro','Este email não possui cadsatro no sistema', 'erro');
				redirect('usuarios/nova_senha');
			}
						
		}
		set_tema('titulo', 'Recuperar Senha');
		set_tema('conteudo', load_modulo('usuarios','nova_senha'));
		set_tema('rodape', '');
		load_template();
	}
	
	public function cadastrar(){
		esta_logado();
		$this->form_validation->set_message('is_unique', 'Este %s já está cadastrado no sistema');
		$this->form_validation->set_message('matches', 'O campo %s está diferente do campo %s');
		$this->form_validation->set_rules('nome', 'NOME', 'trim|required|ucwords');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email|is_unique[usuarios.email]|strtolower');
		$this->form_validation->set_rules('login', 'LOGIN', 'trim|required|min_length[4]|is_unique[usuarios.login]|strtolower');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[4]|strtolower|matches[senha]');
		if($this->form_validation->run()==TRUE){
			$dados = elements(array('nome','email','login'), $this->input->post());
			$dados['senha'] = md5($this->input->post('senha'));
			if (is_admin()) $dados['adm'] = ($this->input->post('adm')==1) ? 1 : 0;
			$this->usuarios->do_insert($dados);
		}
		set_tema('titulo', 'Cadastro de Usuários');
		set_tema('conteudo', load_modulo('usuarios', 'cadastrar'));
		load_template();
	}

	public function gerenciar(){
		esta_logado();
		set_tema('footerinc', load_JS(array('data-table','table')),FALSE);
		set_tema('titulo', 'Listagem de Usuários');
		set_tema('conteudo', load_modulo('usuarios', 'gerenciar'));
		load_template();
	}
	
	
	public function alterar_senha(){
		esta_logado();
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[4]|strtolower|matches[senha]');
		if($this->form_validation->run()==TRUE){
			$dados['senha'] = md5($this->input->post('senha'));
			$this->usuarios->do_update($dados, array('id'=>$this->input->post('idusuario')));
		}
		set_tema('titulo', 'Alteração de senha');
		set_tema('conteudo', load_modulo('usuarios', 'alterar_senha'));
		load_template();
	}
	
	
}


















