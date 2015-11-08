<?php
  class EventosController extends AppController {


      public $uses = array('ProdutoEvento','Evento');


        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('add', 'cancelar', '_gera_link', 'calcular_pagamentos');
        }

        public function cancelar($id = null){

        		$this->Evento->id = $id;
        		if (!$this->Evento->exists()) {
        			throw new NotFoundException(__('Evento Inválido'));
        		}
              $this->request->data['Evento']['status_evento'] = 0;

        			if ($this->Evento->save($this->request->data)) {
        				$this->Session->setFlash(__('Evento Cancelado'));
        				$this->redirect(array('action' => 'index'));
        			} else {
        				$this->Session->setFlash(__('Não é possível cancelar o evento.'));
                $this->redirect(array('action' => 'index'));
        			}

        }

        public function view($id = null) {
            if (!$this->Evento->exists($id)) {
                throw new NotFoundException(__('Evento Inválido'));
            }
            $this->set('evento', $this->Evento->query("SELECT Evento.nome, Evento.datahora, Evento.status_evento, Evento.valor_total, Evento.quantidade_pessoas, SUM(Pagamento.valor) AS valor_total
	                     FROM eventos AS Evento
	                       LEFT JOIN pagamentos AS Pagamento ON
		                      Pagamento.evento_id= Evento.id
	                       WHERE Pagamento.status_pagamento = 1;"));
        }


        public function add() {

              if ($this->request->is('post')) {
                  $this->Evento->create();

                  $dadosEvento = $this->request->data;

                  $this->request->data['Evento']['criado'] = date(now());
                  $this->request->data['Evento']['url_evento'] = $this->_gera_link(4);
                  $this->request->data['Evento']['usuario_id'] = $this->Session->read('Auth.User.id');
                  $this->request->data['Evento']['status_evento'] = 1;

                  if ($this->Evento->save($this->request->data['Evento'])) {

                    $itens = $this->request->data['Produto_Evento'];

                    foreach ($itens as $item) {

                      $item['evento_id'] = $this->Evento->id();
                      $this->ProdutoEvento->save($item);

                    }

                      $this->Flash->success(__('The evento has been saved'));
                      $this->redirect(array('action' => 'index'));
                  } else {
                      $this->Flash->error(__('The user could not be saved. Please, try again.'));
                  }
              }
          }

          public function _gera_link($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
          {
              //$lmin = 'abcdefghijklmnopqrstuvwxyz';
              $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
              $num = '1234567890';
              $simb = '!@#$%*-';
              $retorno = '';
              $caracteres = '';

              //$caracteres .= $lmin;
              if ($maiusculas) $caracteres .= $lmai;
              if ($numeros) $caracteres .= $num;
              if ($simbolos) $caracteres .= $simb;


              $len = strlen($caracteres);


              for ($n = 1; $n <= $tamanho; $n++) {
                  $rand = mt_rand(1, $len);
                  $retorno .= $caracteres[$rand-1];
              }

              //Se o localizar retorna false ele executa novamente o processo de gerarLocalizador
              if(!$this->_checkCupom($retorno)){
               $retorno = $this->_checkCupom(8);
              }

              return $retorno;
          }

  }
 ?>
