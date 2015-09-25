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
			<script type="text/javascript">
				$(function(){
					$('.deletareg').click(function(){
						if(confirm("Deseja Realmente excluir este registro?\nEsta Operação não poderá ser desfeita!"))return true; else return false;
					});
				});
			</script>
			<?php 
				get_msg('msgok');
				get_msg('msgerro');
			?>
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
									anchor("usuarios/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete deletareg','title'=>'Excluir' ))
									);
							echo '</tr>';
						}
					?>
				</tbody>
			</table>				
		</div>
		<?php
		break;
	case 'alterar_senha':
		$iduser = $this->uri->segment(3);
		if ($iduser==NULL){
			set_msg('msgerro', 'Escolha um usuário para alterar', 'erro');
			redirect('usuarios/gerenciar');
		}?>
			<div class="twelve columns">
			  <?php 
			  	if (is_admin() || $iduser == $this->session->userdata('user_id')){
					$query = $this->usuarios->get_byid($iduser)->row();
					erros_validacao();
					get_msg('msgok');
					echo form_open(current_url(), array('class'=>'custom'));
					echo form_fieldset('Alterar senha');
					echo form_label('Nome Completo');
					echo form_input(array('name'=>'nome','class'=>'five','disabled'=>'disabled'), set_value('nome', $query->nome));
					echo form_label('Email');
					echo form_input(array('name'=>'email','class'=>'five','disabled'=>'disabled'), set_value('email', $query->email));
					echo form_label('Login');
					echo form_input(array('name'=>'login','class'=>'three','disabled'=>'disabled'), set_value('login', $query->login));
					echo form_label('Nova Senha');
					echo form_password(array('name'=>'senha','class'=>'three'), set_value('senha'), 'autofocus');
					echo form_label('Repita a Senha');
					echo form_password(array('name'=>'senha2','class'=>'three'), set_value('senha2'));
					echo anchor('usuarios/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
					echo form_submit(array('name'=>'alterarsenha', 'class'=>'button radius'), 'Salvar Dados');
					echo form_hidden('idusuario', $iduser);
					echo form_fieldset_close();
					echo form_close();  
				  } else {
				  		set_msg('msgerro', 'Seu usuário não tem permissão para executar esta operação','erro');
						redirect('usuarios/gerenciar'); 
				  }				  
			  ?>
			</div>
		
		<?php
		break;
		case 'editar':
		$iduser = $this->uri->segment(3);
		if ($iduser==NULL){
			set_msg('msgerro', 'Escolha um usuário para alterar', 'erro');
			redirect('usuarios/gerenciar');
		}?>
			<div class="twelve columns">
			  <?php 
			  	if (is_admin() || $iduser == $this->session->userdata('user_id')){
					$query = $this->usuarios->get_byid($iduser)->row();
					erros_validacao();
					get_msg('msgok');
					echo form_open(current_url(), array('class'=>'custom'));
					echo form_fieldset('Alterar Usuário');
					echo form_label('Nome Completo');
					echo form_input(array('name'=>'nome','class'=>'five'), set_value('nome', $query->nome), 'autofocus');
					echo form_label('Email');
					echo form_input(array('name'=>'email','class'=>'five','disabled'=>'disabled'), set_value('email', $query->email));
					echo form_label('Login');
					echo form_input(array('name'=>'login','class'=>'three','disabled'=>'disabled'), set_value('login', $query->login));
					echo form_checkbox(array('name'=>'ativo'), '1',($query->ativo==1)?TRUE:FALSE).'Permitir o acesso deste usuário ao sistema<br /><br />';
					echo form_checkbox(array('name'=>'adm'), '1', ($query->adm==1)?TRUE:FALSE).'Dar poderes administrativos a este usuário <br /><br />';
					echo anchor('usuarios/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
					echo form_submit(array('name'=>'editar', 'class'=>'button radius'), 'Salvar Dados');
					echo form_hidden('idusuario', $iduser);
					echo form_fieldset_close();
					echo form_close();  
				  } else {
				  	set_msg('msgerro', 'Seu usuário não tem permissão para executar esta operação','erro');
					 redirect('usuarios/gerenciar'); 
				  }				  
			  ?>
			</div>
		
		<?php
		break;			
	default:
		echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
		break;
}