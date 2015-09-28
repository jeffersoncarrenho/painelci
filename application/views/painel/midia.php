<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch ($tela) {
	case 'cadastrar':
		echo '<div class="twelve columns">';
		echo breadcrumb();
		erros_validacao();
		get_msg('msgok');
		get_msg('msgerro');
		echo form_open_multipart('midia/cadastrar', array('class'=>'custom'));
		echo form_fieldset('Upload de Mídia');
		echo form_label('Nome para exibição');
		echo form_input(array('name'=>'nome','class'=>'five'), set_value('nome'), 'autofocus');
		echo form_label('Descrição');
		echo form_input(array('name'=>'descricao','class'=>'five'), set_value('descricao'));
		echo form_label('Arquivo');
		echo form_upload(array('name'=>'arquivo','class'=>'twelve'), set_value('arquivo'));
		echo anchor('midia/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
		echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'), 'Salvar Dados');
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
					$('input').click(function(){
						(this).select();
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
						<th>Nome</th>
						<th>Link</th>
						<th>Miniatura</th>
						<th class="text-center">Ações</th>						
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = $this->midia->get_all()->result();
						foreach ($query as $linha) {
							echo '<tr>';
							printf('<td>%s</td>', $linha->nome);
							printf('<td><input type="text" value="%s" /></td>', base_url("uploads/$linha->arquivo"));
							printf('<td>%s</td>', thumb($linha->arquivo));
							printf('<td class="text-center">%s%s%s</td>', 
									anchor("uploads/$linha->arquivo", ' ', array('class'=>'table-actions table-view','title'=>'Visualizar', 'target'=>'_blank')), 
									anchor("midia/editar/$linha->id", ' ', array('class'=>'table-actions table-edit','title'=>'Editar' )),
									anchor("midia/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete deletareg','title'=>'Excluir' ))
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