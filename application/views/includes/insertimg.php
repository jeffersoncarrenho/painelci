<script type="text/javascript" charset="utf-8">
	$(function(){
		$('.addimg').click(function(e){
			e.preventDefault();
			$('#modalimg').reveal({
				animation:'none'
			});
		});
		$('.buscarimg').click(function(){
			var destino = "<?php echo base_url('midia/get_imgs')?>";
			var dados = $(".buscartxt").serialize();
			$.ajax({
				type:"POST",
				url: destino,
				data: dados,
				success: function(retorno){
					$(".retorno").html(retorno);
				}
			});
		});
		$(".limparimg").click(function(){
			$(".buscartxt").val('');
			$(".retorno").html('');
		});
	});	
</script>

<div id="modalimg" class="reveal-modal large">
	<div class="row collapse">
		<div class="collapse seven columns">
			<?php
				echo form_input(array('name'=>'pesquisarimg', 'class'=>'buscartxt'));
			?>
		</div>
		<div class="five columns">
			<?php
				echo form_button('', 'Buscar', 'class="buscarimg button postfix"');
				echo form_button('', 'Limpar', 'class="limparimg button postfix alert radius"');
			?>
		</div>
	</div>
	<div class="retorno">&nbsp;</div>
	<a class="close-reveal-modal">&#215;</a>
</div>