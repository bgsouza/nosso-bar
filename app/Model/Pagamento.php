<?php
    App::uses('AuthComponent', 'Controller/Component');

    class Pagamento extends AppModel {

        public $name = 'Pagamento';

        public $belongsTo = array(
      		'Evento' => array(
      			'className' => 'Evento',
      			'foreignKey' => 'evento_id',
      			'conditions' => '',
      			'fields' => '',
      			'order' => ''
      		)
      	);
}
