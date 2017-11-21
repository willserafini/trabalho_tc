<?php

namespace App\Controller;

use App\Controller\AreaProfessorController;

/**
 * Perguntas Controller
 *
 * @property \App\Model\Table\PerguntasTable $Perguntas
 *
 * @method \App\Model\Entity\Pergunta[] paginate($object = null, array $settings = [])
 */
class PerguntasController extends AreaProfessorController {

    /**
     * Edit method
     *
     * @param string|null $id Pergunta id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $pergunta = $this->Perguntas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dados = $this->request->getData();
            $dados['opcoes_resposta_objetiva'] = json_encode($dados['opcoes_resposta_objetiva']);
            $pergunta = $this->Perguntas->patchEntity($pergunta, $dados);
            if ($this->Perguntas->save($pergunta)) {
                $this->Flash->success(__('The pergunta has been saved.'));

                return $this->redirect(['controller' => 'quizzes', 'action' => 'view', $pergunta->quiz_id]);
            }
            $this->Flash->error(__('The pergunta could not be saved. Please, try again.'));
        }
        $quizzes = $this->Perguntas->Quizzes->find('list', ['limit' => 200]);
        $this->set(compact('pergunta', 'quizzes'));
        $this->set('_serialize', ['pergunta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pergunta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $pergunta = $this->Perguntas->get($id);
        if ($this->Perguntas->delete($pergunta)) {
            $this->Flash->success(__('The pergunta has been deleted.'));
        } else {
            $this->Flash->error(__('The pergunta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
