<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//carrega o modulo do sistema devolvendo a tela solicitada
function load_modulo($modulo=NULL, $tela=NULL, $diretorio='painel'){
	$CI=& get_instance();
	if ($modulo!=NULL) {
		return $CI->load->view("$diretorio/$modulo", array('tela'=>$tela), TRUE);
	} else {
		return FALSE;
	}
}
//seta valores ao array $tema da classe sistema
function set_tema($prop, $valor, $replace=TRUE){
	$CI =& get_instance();
	$CI->load->library('sistema');
	if ($replace) {
		$CI->sistema->tema[$prop]=$valor;		
	} else {
		if(!isset($CI->sistema->tema[$prop])) $CI->sistema->tema[$prop] = '';
		$CI->sistema->tema[$prop].=$valor;
	}	
}
//retorna os valores do array $tema da classe sistema
function get_tema(){
	$CI =& get_instance();
	$CI->load->library('sistema');
	return $CI->sistema->tema;
}

//Inicializa o painel adm carregando os recursos necessários

function init_painel(){
	$CI =& get_instance();
	$CI->load->library(array('parser','sistema', 'session', 'form_validation'));
	$CI->load->helper(array('form','url','array','text'));
	//carregamento dos models
	$CI->load->model('usuarios_model', 'usuarios');
	
	set_tema('titulo_padrao', 'Gerenciamento de Sistema');
	set_tema('rodape', '<p>&copy;'.date("Y").' | Todos os direitos reservados para <a href="http://rbtech.info">RBTech.info</a></p>');
	set_tema('template', 'painel_view');
	set_tema('headerinc', load_CSS(array('foundation.min','app')),FALSE);
	set_tema('headerinc', load_JS(array('foundation.min','app')),FALSE);
	set_tema('footerinc','');
}

//Inicializa o Tiny MCE para criação de textarea com editor html
function init_hmtmleditor(){
	//set_tema('headerinc', load_JS(base_url('htmleditor/tiny_mce.js'), NULL, TRUE), FALSE);
	set_tema('headerinc', load_JS(base_url('htmleditor/jquery.tinymce.js'), NULL, TRUE), FALSE);
	set_tema('headerinc', incluir_arquivo('htmleditor', 'includes', FALSE), FALSE);
}

//retorna ou printa o conteúdo de uma view
function incluir_arquivo($view, $pasta='includes', $echo = TRUE){
	$CI =& get_instance();
	if($echo==TRUE){
		echo $CI->load->view("$pasta/$view", '', TRUE);
		return TRUE;
	}
	return $CI->load->view("$pasta/$view", '', TRUE);
}

//carrega um template passand o array $tema como parâmetro
function load_template(){
	$CI =& get_instance();
	$CI->load->library('sistema');
	$CI->parser->parse($CI->sistema->tema['template'], get_tema());	
}

//carrega um ou vários aquivos css de uma pasta
function load_CSS($arquivo=NULL, $pasta='css', $media='all'){
	if ($arquivo!=NULL) {
		$CI =& get_instance();
		$CI->load->helper('url');
		$retorno ='';
		if (is_array($arquivo)) {
			foreach ($arquivo as $css) {
				$retorno .='<link rel="stylesheet" href="'.base_url("$pasta/$css.css").'" media="'.$media.'" />';
			}
		} else {
			$retorno ='<link rel="stylesheet" href="'.base_url("$pasta/$arquivo.css").'" media="'.$media.'" />';
		}	
	}
	return $retorno;
}

//carrega um ou vários arquivos .js de uma pasta ou servidor remoto
function load_JS($arquivo=NULL, $pasta='js', $remoto=FALSE){
	if ($arquivo!=NULL) {
		$CI =& get_instance();
		$CI->load->helper('url');
		$retorno ='';
		if (is_array($arquivo)) {
			foreach ($arquivo as $js) {
				if ($remoto) {
					$retorno .='<script type="text/javascript" src="'.$js.'"></script>';
				} else {
					$retorno .='<script type="text/javascript" src="'.base_url("$pasta/$js.js").'"></script>';
				}
			}
		} else {
			if ($remoto) {
				$retorno .='<script type="text/javascript" src="'.$arquivo.'"></script>';
			} else {
				$retorno .='<script type="text/javascript" src="'.base_url("$pasta/$arquivo.js").'"></script>';
			}
		}	
	}
	return $retorno;	
} 

//mostra erros de validação em forms
function erros_validacao(){
	if (validation_errors())echo '<div class="alert-box alert">'.validation_errors('<p>','</p>').'</div>';
}

//verifica se o usuário está logado no sistema
function esta_logado($redir=TRUE){
	$CI =& get_instance();
	$CI->load->library('session');
	$user_status = $CI->session->userdata('user_logado');
	if (!isset($user_status) || $user_status != TRUE) {
		//$CI->session->sess_destroy();
		//$CI->session->sess_create();
		if ($redir) {
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			set_msg('errologin', 'Acesso restrito, faça login antes de proseguir', 'erro');
			redirect('usuarios/login');
		} else {
			return FALSE;
		}
		
	} else {
		return TRUE;
	}
}

//define uma mensagem para ser exibida na nova tela carregada
function set_msg($id='msgerro', $msg=NULL, $tipo='erro'){
	$CI =& get_instance();
	switch ($tipo) {
		case 'erro':
			$CI->session->set_flashdata($id, '<div class="alert-box alert"><p>'.$msg.'</p></div>');
			break;
		case 'sucesso':
			$CI->session->set_flashdata($id, '<div class="alert-box success"><p>'.$msg.'</p></div>');
			break;
		default:
			$CI->session->set_flashdata($id, '<div class="alert-box"><p>'.$msg.'</p></div>');			
			break;
	}
}

//verifica se existe uma mensagem para ser exibida na tela atual
function get_msg($id,$printar=TRUE){
	$CI =& get_instance();
	if($CI->session->flashdata($id)){
		if ($printar) {
			echo $CI->session->flashdata($id);
			return TRUE;
		} else {
			return $CI->session->flashdata($id);
		}
	}
	return FALSE;	
}

//verifica se o usuário atual é administrador
function is_admin($set_msg=FALSE){
	$CI =& get_instance();
	$user_admin = $CI->session->userdata('user_admin');
	if (!isset($user_admin) || $user_admin!=TRUE) {
		if($set_msg) set_msg('msgerro', 'Seu usuário não tem permissão para executar esta operação','erro');
		return FALSE;
	} else {
		return TRUE;
	}
}
//gera um breadcrumb com base no controller atual
function breadcrumb(){
	$CI =& get_instance();
	$CI->load->helper('url');
	$classe = ucfirst($CI->router->class);
	if ($classe=='Painel'){
		$classe = anchor($CI->router->class, 'Início');
	} else {
		$classe = anchor($CI->router->class, $classe);
	}
	$metodo = ucwords(str_replace('_', ' ', $CI->router->method));
	if ($metodo && $metodo!='Index'){
		$metodo = " &raquo; " . anchor($CI->router->class."/".$CI->router->method, $metodo);
	} else {
		$metodo = '';
	}
	return '<p>Sua Localização: '. anchor('painel', 'Painel').' &raquo; '.$classe.$metodo.'</p>';
}

//sete uma registro na tabela de auditoria
function auditoria($operação, $obs='', $query=TRUE){
	$CI =& get_instance();
	$CI->load->library('session');
	$CI->load->model('auditoria_model', 'auditoria');
	if ($query = TRUE) {
		$last_query = $CI->db->last_query();
	} else {
		$last_query = '';
	}
	if (esta_logado(FALSE)) {
		$user_id = $CI->session->userdata('user_id');
		$user_login = $CI->usuarios->get_byid($user_id)->row()->login;
	} else {
		$user_login = 'Desconhecido';
	}
	$dados = array(
		'usuario'=> $user_login,
		'operacao'=> $operação,
		'query'=> $last_query,
		'observacao'=> $obs,
	);
	$CI->auditoria->do_insert($dados);
}

//gera uma miniatura de uma imagem caso ela ainda não exista
function thumb($imagem=NULL, $largura=100, $altura=75, $geratag=TRUE){
	$CI =& get_instance();
	$CI->load->helper('file');
	$thumb = $largura . 'x' . $altura . '_'. $imagem;	
	$thumbinfo = get_file_info('./uploads/thumbs/'.$thumb);
	if ($thumbinfo!=FALSE) {
		$retorno = base_url('uploads/thumbs/'. $thumb);
	} else {
		$CI->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$imagem;
		$config['new_image'] = './uploads/thumbs/'.$thumb;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $largura;
		$config['height'] = $altura;
		$CI->image_lib->initialize($config);
		if ($CI->image_lib->resize()) {
			$CI->image_lib->clear();
			$retorno = base_url('uploads/thumbs/'.$thumb);
		} else {
			$retorno = FALSE;
		}		
	}
	if ($geratag && $retorno!=FALSE) $retorno = '<img src="'.$retorno.'" alt="" />';
	return $retorno;	
}
//gera um slug baseado no título
function slug($string=NULL){
	$string =remove_acentos($string) ;//remover acentos
	return url_title($string, '-', TRUE);
}

//remove acentos e caracteres especiais de uma string
function remove_acentos($string=NULL){
	$procurar 	= array('Á','À','Ã','Â','É','Ê','Í','Ó','Õ','Ô','Ú','Ü','Ç','á','à','ã','â','é','ê','í','ó','õ','ô','ú','ü','ç');
	$substituir = array('A','A','A','A','E','E','I','O','O','O','U','U','C','a','a','a','a','e','e','i','o','o','o','u','u','c');
	return str_replace($procurar, $substituir, $string);	
}
//gera o resumo de uma string
function resumo_post($string=NULL, $palavras=50, $decodifica_html=TRUE,$remove_tags=TRUE){
	if ($string!=NULL) {
		if ($decodifica_html) $string = to_html($string);
		if ($remove_tags) $string = strip_tags($string);
		$retorno = word_limiter($string, $palavras);
	} else {
		$retorno = FALSE;
	}
	return $retorno;
}
//converter dados do bd para html válido
function to_html($string=NULL){
	return html_entity_decode($string);
}

















