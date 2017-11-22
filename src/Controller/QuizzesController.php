<?php

namespace App\Controller;

use App\Controller\AreaProfessorController;
use Cake\Datasource\ConnectionManager;

/**
 * Quizzes Controller
 *
 * @property \App\Model\Table\QuizzesTable $Quizzes
 *
 * @method \App\Model\Entity\Quiz[] paginate($object = null, array $settings = [])
 */
class QuizzesController extends AreaProfessorController {

    public $components = array('RequestHandler');

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Conteudos' => 'ConteudoPai']
        ];
        $quizzes = $this->paginate($this->Quizzes);

        $this->set(compact('quizzes'));
        $this->set('_serialize', ['quizzes']);
    }

    /**
     * View method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $quiz = $this->Quizzes->get($id, [
            'contain' => ['Conteudos' => 'ConteudoPai', 'Perguntas']
        ]);

        $this->set('quiz', $quiz);
        $this->set('_serialize', ['quiz']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $quiz = $this->Quizzes->newEntity();
        if ($this->request->is('post')) {
            try {
                $conn = ConnectionManager::get('default');
                $conn->begin();
                $this->Quizzes->salvar($this->request->getData());
                $conn->commit();
                $this->Flash->success(__('The quiz has been saved.'));
                return $this->redirect(['action' => 'index']);
            } catch (Exception $e) {
                $conn->rollback();
                $this->Flash->error($e->getMessage());
            }
        }

        $conteudos = $this->Quizzes->Conteudos->find('list', ['limit' => 200]);
        $this->set(compact('quiz', 'conteudos'));
        $this->set('_serialize', ['quiz']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $quiz = $this->Quizzes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quiz = $this->Quizzes->patchEntity($quiz, $this->request->getData());
            if ($this->Quizzes->save($quiz)) {
                $this->Flash->success(__('The quiz has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quiz could not be saved. Please, try again.'));
        }
        $conteudos = $this->Quizzes->Conteudos->find('list', ['limit' => 200]);
        $this->set(compact('quiz', 'conteudos'));
        $this->set('_serialize', ['quiz']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $quiz = $this->Quizzes->get($id);
        if ($this->Quizzes->delete($quiz)) {
            $this->Flash->success(__('The quiz has been deleted.'));
        } else {
            $this->Flash->error(__('The quiz could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}