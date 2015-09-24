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
		echo form_close();
		echo '</div>';		
		break;
		
	case 'nova_senha':
		echo '<div class="four columns centered">';
		echo form_open('usuarios/nova_senha', array('class'=>'custom loginform'));
		echo form_fieldset('Recuperação de Senha');
		get_msg('msgok');
		get_msg('msgerro');
		erros_validacao();
		echo form_label('Seu Email');
		echo form_input(array('name'=>'email'), set_value('email'), 'autofocus');
		echo form_submit(array('name'=>'novasenha', 'class'=>'button radius right'), 'Enviar Nova Senha');
		echo '<p>'.anchor('usuarios/login', 'Fazer Login').'</p>';
		echo form_fieldset_close();
		echo form_close();
		echo '</div>';		
		break;
	case 'cadastrar':
		echo '<div class="twelve columns">';
		erros_validacao();
		get_msg('msgok');
		echo form_open('usuarios/cadastrar', array('class'=>'custom'));
		echo form_fieldset('Cadastrar Usuário');
		echo form_label('Nome Completo');
		echo form_input(array('name'=>'nome','class'=>'five'), set_value('nome'), 'autofocus');
		echo form_label('Email');
		echo form_input(array('name'=>'email','class'=>'five'), set_value('email'));
		echo form_label('Login');
		echo form_input(array('name'=>'login','class'=>'three'), set_value('login'));
		echo form_label('Senha');
		echo form_password(array('name'=>'senha','class'=>'three'), set_value('senha'));
		echo form_label('Repita a Senha');
		echo form_password(array('name'=>'senha2','class'=>'three'), set_value('senha2'));
		echo form_checkbox(array('name'=>'adm'), '1').'Dar poderes administrativos a este usuário <br /><br />';
		echo anchor('usuarios/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
		echo form_submit(array('name'=>'cadastra', 'class'=>'button radius'), 'Salvar Dados');
		echo form_fieldset_close();
		echo form_close();
		echo '</div>';		
		break;
	case 'gerenciar':
		?>
		<div class="twelve columns">
			<table class="twelve data-table">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Login</th>
						<th>Email</th>
						<th>Ativo / Adm</th>
						<th class="text-center">Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = $this->usuarios->get_all()->result();
						foreach ($query as $linha) {
							echo '<tr>';
							printf('<td>%s</td>', $linha->nome);
							printf('<td>%s</td>', $linha->login);
							printf('<td>%s</td>', $linha->email);
							printf('<td>%s / %s</td>', ($linha->ativo==0)?'Não':'Sim', ($linha->adm==0)?'Não':'Sim' );
							printf('<td class="text-center">%s%s%s</td>', 
									anchor("usuarios/editar/$linha->id", ' ', array('class'=>'table-actions table-edit','title'=>'Editar')), 
									anchor("usuarios/alterar_senha/$linha->id", ' ', array('class'=>'table-actions table-pass','title'=>'Altera Senha' )),
									anchor("usuarios/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete','title'=>'Excluir' ))
									);
							echo '</tr>';
						}
					?>
				</tbody>
			</table>				
		</div>
		<?php
		break;
		
	default:
		echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
		break;
}
















