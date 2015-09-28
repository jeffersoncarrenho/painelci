<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		init_painel();
		esta_logado();
		$this->load->model('paginas_model', 'paginas');
	}
	
	public function index(){
		$this->gerenciar();
	}
	
	public function cadastrar(){
		$this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required|ucfirst');
		$this->form_validation->set_rules('slug', 'SLUG', 'trim');
		$this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required|htmlentities');
		if($this->form_validation->run()==TRUE){
			$dados = elements(array('titulo', 'slug', 'conteudo'), $this->input->post());
			($dados['slug']!='')? $dados['slug'] = slug($dados['slug']): $dados['slug'] = slug($dados['titulo']) ;
			$this->paginas->do_insert($dados);				
		}
		init_hmtmleditor();
		set_tema('titulo', 'Cadastrar nova página');
		set_tema('conteudo', load_modulo('paginas', 'cadastrar'));
		load_template();
	}

	public function gerenciar(){
		set_tema('footerinc', load_JS(array('data-table','table')),FALSE);
		set_tema('titulo', 'Páginas');
		set_tema('conteudo', load_modulo('paginas', 'gerenciar'));
		load_template();
	}
}