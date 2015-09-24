<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch ($tela) {
	case 'login':
		echo '<div class="four columns centered">';
		echo form_open('usuarios/login', array('class'=>'custom loginform'));
		echo form_fieldset('Identifique-se');
		get_msg('logoffok');
		get_msg('errologin');
		erros_validacao();
		echo form_label('Usuário');
		echo form_input(array('name'=>'usuario'), set_value('usuario'), 'autofocus');
		echo form_label('Senha');
		echo form_password(array('name'=>'senha'), set_value('senha'));
		echo form_submit(array('name'=>'logar', 'class'=>'button radius right'), 'Login');
		echo '<p>'.anchor('usuarios/nova_senha', 'Esqueci minha senha').'</p>';
		echo form_fieldset_close();
		echo '</div>';		
		break;
		
	case 'nova_senha':
		echo '<div class="four columns centered">';
		echo form_open('usuarios/nova_senha', array('class'=>'custom loginform'));
		echo form_fieldset('Recuperação de Senha');
		get_msg('msgok');
		get_msg('erro');
		erros_validacao();
		echo form_label('Seu Email');
		echo form_input(array('name'=>'email'), set_value('email'), 'autofocus');
		echo form_submit(array('name'=>'novasenha', 'class'=>'button radius right'), 'Enviar Nova Senha');
		echo '<p>'.anchor('usuarios/login', 'Fazer Login').'</p>';
		echo form_fieldset_close();
		echo '</div>';		
		break;
	default:
		echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
		break;
}