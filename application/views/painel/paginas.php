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
									anchor("paginas/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete deletareg','title'=>'Excluir' ))
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
		$idpagina = $this->uri->segment(3);
		if ($idpagina==NULL){
			set_msg('msgerro', 'Escolha uma página para alterar', 'erro');
			redirect('paginas/gerenciar');
		}?>
			<div class="twelve columns">
			  <?php 
			  	$query = $this->paginas->get_byid($idpagina)->row();
			  	echo breadcrumb();
			  	erros_validacao();
				get_msg('msgok');
				get_msg('msgerro');
				echo form_open(current_url(), array('class'=>'custom'));
				echo form_fieldset('Alterar página');
				echo form_label('Título');
				echo form_input(array('name'=>'titulo','class'=>'six'), set_value('titulo', $query->titulo), 'autofocus');
				echo form_label('Slug (deixe em branco se não souber do que se trata)');
				echo form_input(array('name'=>'slug','class'=>'six'), set_value('slug', $query->slug));
				echo '<p>'.anchor('#', 'Inserir Imagens', 'class="addimg button tiny radius"');
				echo anchor('midia/cadastrar', 'Upload de Imagens', 'target="_blank" class="button tiny secondary radius"').'</p>';
				echo form_label('Conteúdo');
				echo form_textarea(array('name'=>'conteudo', 'class'=>'twelve htmleditor', 'rows'=>20), set_value('conteudo', to_html($query->conteudo)));
				echo anchor('paginas/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
				echo form_submit(array('name'=>'alterar', 'class'=>'button radius'), 'Salvar Dados');
				echo form_hidden('idpagina', $query->id);							
				echo form_fieldset_close();
				echo form_close();
			?>
			</div>
			<?php
			incluir_arquivo('insertimg', 'includes', TRUE);
		break;		
	default:
		echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
		break;
}