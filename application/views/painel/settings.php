<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch ($tela) {
	case 'gerenciar':
		echo '<div class="twelve columns">';
		echo breadcrumb();
		erros_validacao();
		get_msg('msgok');
		get_msg('msgerro');
		echo form_open('settings/gerenciar', array('class'=>'custom'));
		echo form_fieldset('Configuração do Sistema');
		echo form_label('Nome do Site');
		echo form_input(array('name'=>'nome_site','class'=>'six'), set_value('nome_site', get_setting('nome_site')), 'autofocus');
		echo form_label('URL da Logomarca');
		echo form_input(array('name'=>'url_logomarca','class'=>'six'), set_value('url_logomarca', get_setting('url_logomarca')));
		echo form_label('Email do Administrador');
		echo form_input(array('name'=>'email_adm','class'=>'six'), set_value('email_adm', get_setting('email_adm')));
		echo form_submit(array('name'=>'salvardados', 'class'=>'button radius'), 'Salvar Configuração');
		echo form_fieldset_close();
		echo form_close();
		echo '</div>';		
		break;				
	default:
		echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
		break;
}