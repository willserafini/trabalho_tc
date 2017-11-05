<?php

namespace App\Controller;

use App\Controller\AreaProfessorController;
use App\Model\Table\ConteudosTable;

/**
 * Conteudos Controller
 *
 * @property \App\Model\Table\ConteudosTable $Conteudos
 *
 * @method \App\Model\Entity\Conteudo[] paginate($object = null, array $settings = [])
 */
class ConteudosController extends AreaProfessorController {

    public $components = array('RequestHandler');

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['ConteudoPai']
        ];

        $conteudos = $this->paginate($this->Conteudos);
        $this->set(compact('conteudos'));
        $this->set('_serialize', ['conteudos']);
    }

    /**
     * View method
     *
     * @param string|null $id Conteudo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $conteudo = $this->Conteudos->get($id, [
            'contain' => ['ConteudoPai', 'ConteudoFilho', 'ConteudoAnterior']
        ]);

        $this->set('conteudo', $conteudo);
        $this->set('_serialize', ['conteudo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $conteudo = $this->Conteudos->newEntity();
        if ($this->request->is('post')) {
            $conteudo = $this->Conteudos->patchEntity($conteudo, $this->request->getData());
            $conteudo->pasta = ConteudosTable::getPastaConteudos();
            if ($this->Conteudos->save($conteudo)) {
                $this->Flash->success(__('The conteudo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conteudo could not be saved. Please, try again.'));
        }

        $this->set('conteudos', $this->Conteudos->listConteudosPrincipais());
        $this->set(compact('conteudo'));
        $this->set('_serialize', ['conteudo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Conteudo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $conteudo = $this->Conteudos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conteudo = $this->Conteudos->patchEntity($conteudo, $this->request->getData());
            if ($this->Conteudos->save($conteudo)) {
                $this->Flash->success(__('The conteudo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conteudo could not be saved. Please, try again.'));
        }

        $this->set('conteudos', $this->Conteudos->listConteudosPrincipais());
        $this->set(compact('conteudo'));
        $this->set('_serialize', ['conteudo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Conteudo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $conteudo = $this->Conteudos->get($id);
        if ($this->Conteudos->delete($conteudo)) {
            $this->Flash->success(__('The conteudo has been deleted.'));
        } else {
            $this->Flash->error(__('The conteudo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getConteudosAnterioresAjax() {
        $this->viewBuilder()->setLayout('ajax');
        $conteudoPaiId = $this->request->query['conteudoPaiId'];
        if(empty($conteudoPaiId)) {
            $conteudoAnteriores = $this->Conteudos->listConteudosPrincipais();
        } else {
            $conteudoAnteriores = $this->Conteudos->listSubConteudos($conteudoPaiId);
        }
        
        echo json_encode($conteudoAnteriores);
        exit();
    }

}
