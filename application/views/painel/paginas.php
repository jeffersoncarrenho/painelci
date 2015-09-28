<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch ($tela) {
	case 'cadastrar':
		echo '<div class="twelve columns">';
		echo breadcrumb();
		erros_validacao();
		get_msg('msgok');
		get_msg('msgerro');
		echo form_open('paginas/cadastrar', array('class'=>'custom'));
		echo form_fieldset('Cadastrar nova página');
		echo form_label('Título');
		echo form_input(array('name'=>'titulo','class'=>'six'), set_value('titulo'), 'autofocus');
		echo form_label('Slug (deixe em branco se não souber do que se trata)');
		echo form_input(array('name'=>'slug','class'=>'six'), set_value('slug'));
		echo form_label('Conteúdo');
		echo form_textarea(array('name'=>'conteudo', 'class'=>'twelve htmleditor', 'rows'=>20), set_value('conteudo'));
		
		echo anchor('paginas/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
		echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'), 'Publicar Página');
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
				echo breadcrumb();
				get_msg('msgok');
				get_msg('msgerro');
			?>			
			<table class="twelve data-table">
				<thead>
					<tr>
						<th>Título</th>
						<th>Slug</th>
						<th>Resumo</th>
						<th class="text-center">Ações</th>						
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = $this->paginas->get_all()->result();
						foreach ($query as $linha) {
							echo '<tr>';
							printf('<td>%s</td>', $linha->titulo);
							printf('<td>%s</td>', $linha->slug);
							printf('<td>%s</td>', resumo_post($linha->conteudo, 6));
							printf('<td class="text-center">%s%s</td>', 
									anchor("paginas/editar/$linha->id", ' ', array('class'=>'table-actions table-edit','title'=>'Editar' )),
									anchor("paginas'/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete deletareg','title'=>'Excluir' ))
									);
							echo '</tr>';
						}
					?>
				</tbody>
			</table>				
		</div>
		<?php
		break;	
		case 'editar':
		$idmidia = $this->uri->segment(3);
		if ($idmidia==NULL){
			set_msg('msgerro', 'Escolha uma mídia para alterar', 'erro');
			redirect('midia/gerenciar');
		}?>
			<div class="twelve columns">
			  <?php 
			  	echo breadcrumb();
			  	$query = $this->midia->get_byid($idmidia)->row();
				erros_validacao();
				get_msg('msgok');
				echo form_open(current_url(), array('class'=>'custom'));
				echo form_fieldset('Alteração de Mídia');
				echo '<div class="row">';
				echo '<div class="six columns">';
				echo form_label('Nome para exibição');
				echo form_input(array('name'=>'nome','class'=>'twelve'), set_value('nome', $query->nome), 'autofocus');
				echo form_label('Descrição');
				echo form_input(array('name'=>'descricao','class'=>'twelve'), set_value('descricao', $query->descricao));
				echo '</div>';
				echo '<div class="five columns offset-by-one">';
				echo thumb($query->arquivo, 300,180);
				echo '</div>';
				echo '</div>';					
				echo anchor('midia/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
				echo form_submit(array('name'=>'editar', 'class'=>'button radius'), 'Salvar Dados');
				echo form_hidden('idmidia', $query->id);
				echo form_fieldset_close();
				echo form_close();
			?>
			</div>
			<?php
		break;		
	default:
		echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
		break;
}