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
	set_tema('titulo_padrao', 'Gerenciamento de Sistema');
	set_tema('rodape', '<p>&copy;'.date("Y").' | Todos os direitos reservados para <a href="http://rbtech.info">RBTech.info</a></p>');
	set_tema('template', 'painel_view');
}

//carrega um template passand o array $tema como parâmetro
function load_template(){
	$CI =& get_instance();
	$CI->load->library('sistema');
	$CI->parser->parse($CI->sistema->tema['template'], get_tema());	
}















