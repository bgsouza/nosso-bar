<div class="pagamentos form">
	<div class="left">
		<h2><?php  echo __('Atualizar Status');?></h2>
	</div>
	<div class="right">
		<?php
		echo $this->Html->link(__('Voltar'), array('controller' => 'pagamentos', 'action' => 'index'));
  	?>
	</div>
	<div class="both"></div>
	<div class="box_form">
		<?php echo $this->Form->create('Pagamento');?>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('status_pagamento',array('options' => array('1' => 'Autorizado','0' => 'Pendente')));
			?>

		<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>
