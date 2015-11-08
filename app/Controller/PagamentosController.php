<?php
  class PagamentosController extends AppController {


          public $uses = array('Pagamento','ProdutoEvento','Evento');


          public function beforeFilter() {
              parent::beforeFilter();
              $this->Auth->allow('pagar', 'atualizar_status', 'atribuir_token');
          }

          public function index() {
              $this->Pagamento->recursive = 0;
              $this->set('pagamentos', $this->paginate());
          }

          public function atribuir_token($id = null){

            $this->Pagamento->id = $id;
            if (!$this->Pagamento->exists()) {
                throw new NotFoundException(__('Invalid Pagamento'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->Pagamento->save($this->request->data)) {
                    $this->Flash->success(__('The Pagamento has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->request->data = $this->Pagamento->findById($id);
            }


          }

          public function atualizar_status($id = null){

            $this->Pagamento->id = $id;
            if (!$this->Pagamento->exists()) {
                throw new NotFoundException(__('Invalid Pagamento'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->Pagamento->save($this->request->data)) {
                    $this->Flash->success(__('The Pagamento has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->request->data = $this->Pagamento->findById($id);
            }


          }

          public function pagar($linkEvento = null){


              if ($this->request->is('post')) {

                $this->Pagamento->create();

                $eventoId = $this->Evento->find('first', array('fields' => array('Evento.id'), 'conditions' => array('Evento.url_evento' => $linkEvento)));

                $this->request->data['Pagamento']['evento_id'] = $eventoId;
                $this->request->data['Pagamento']['status_pagamento'] = 0;

                if ($this->Pagamento->save($this->request->data)){

                    $this->Flash->success(__('Você receberá a cobrança em seu email.'));
                    $this->redirect(array('action' => 'index'));

                  }else{

                    $this->Flash->error(__('The user could not be saved. Please, try again.'));

                  }

              }

          }




  }
?>
