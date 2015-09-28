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
				});
			</script>
			<?php 
				echo breadcrumb();
				get_msg('msgok');
				get_msg('msgerro');
				$modo = $this->uri->segment(3);
				if ($modo=='all'){					
					$limit  =0;
				}else{
					$limit  =50;
					echo '<p>Mostrando os últimos 50 registros, para ver todo o histórico '. anchor('auditoria/gerenciar/all', 'Clique aqui').' </p>';
				}
			?>
			
			<table class="twelve data-table">
				<thead>
					<tr>
						<th>Usuário</th>
						<th>Data e Hora</th>
						<th>Operação</th>
						<th>Observação</th>						
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = $this->auditoria->get_all($limit)->result();
						foreach ($query as $linha) {
							echo '<tr>';
							printf('<td>%s</td>', $linha->usuario);
							printf('<td>%s</td>', date('d/m/Y H:i:s', strtotime($linha->data_hora)));
							printf('<td>%s</td>', '<span class="has-tip tip-top" title="'.$linha->query.'"> '.$linha->operacao.'</span>');
							printf('<td>%s</td>', $linha->observacao);
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