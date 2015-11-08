<?php
    App::uses('AuthComponent', 'Controller/Component');

    class Evento extends AppModel {

        public $name = 'Evento';
        public $validate = array(
            'nome' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A username is required'
                )
            ),
            'datahora' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A password is required'
                )
            ),
            'local_evento' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A password is required'
                )
            ),
            'quantidade_pessoas' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A password is required'
                )
            ),
            'valor_total' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A password is required'
                )
            )
        );
}
