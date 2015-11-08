<div class="pagamentos index">
	<h2><?php echo __('Pagamentos');?></h2>
	<br>
	<div class="both"></div>
	<table cellpadding="0" cellspacing="0">
		<caption>Lista de pagamentos</caption>
	<tr>
			<th class="spec"><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('evento_id', 'Evento');?></th>
			<th><?php echo $this->Paginator->sort('forma_pagamento');?></th>
      <th><?php echo $this->Paginator->sort('status_pagamento');?></th>
      <th><?php echo $this->Paginator->sort('valor');?></th>
			<th><?php echo $this->Paginator->sort('data_pagamento','Criado em');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($pagamentos as $pagamento): ?>
	<tr>
		<td class="spec"><?php echo h($pagamento['Pagamento']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pagamento['Evento']['nome'], array('controller' => 'eventos', 'action' => 'view', $pagamento['Evento']['id'])); ?>
		</td>
		<td>
      <?php

        if($pagamento['Pagamento']['forma_pagamento'] == 1){
          echo "Cartão de crédito";
        }else if($pagamento['Pagamento']['forma_pagamento'] == 2){
          echo "Boleto";
        }
      ?>&nbsp;</td>
      <td>
        <?php

          if($pagamento['Pagamento']['status_pagamento'] == 1){
            echo "Autorizado";
          }else if($pagamento['Pagamento']['status_pagamento'] == 0){
            echo "Pendete";
          }
        ?>&nbsp;</td>
      <td>
        <?php echo $pagamento['Pagamento']['valor'] ?>
      </td>
		<td><?php echo h(date('d/m/Y \à\s H:i', strtotime($pagamento['Pagamento']['data_pagamento']))); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Atribuir Token'), array('action' => 'atribuir_token', $pagamento['Pagamento']['id'])); ?>
      <?php echo $this->Html->link(__('Atualizar Status'), array('action' => 'atualizar_status', $pagamento['Pagamento']['id'])); ?>

      </td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="pagination">
		<ul>
			<?php echo $this->Paginator->prev(
				'< ' . __('Anterior'),
				array('tag' => 'li', 'class' => 'page gradient', 'escape' => false),
				null,
				array('tag' => 'li','class' => 'page gradient', 'escape' => false)
			); ?>
			<?php echo $this->Paginator->numbers(array(
				'tag' => 'li',
				'separator' => '',
				'class' => 'page',
				'currentClass' => 'page active',
			)); ?>
			<?php echo $this->Paginator->next(
				__('Próximo') . ' >',
				array('tag' => 'li','class' => 'page gradient',  'escape' => false),
				null,
				array('tag' => 'li','class' => 'page gradient',  'escape' => false)
			); ?>
		</ul>
	</div>
</div>
