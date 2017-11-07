<?php

namespace App\Controller;

use App\Controller\AreaProfessorController;
use Cake\Mailer\Email;

/**
 * Duvidas Controller
 *
 * @property \App\Model\Table\DuvidasTable $Duvidas
 *
 * @method \App\Model\Entity\Duvida[] paginate($object = null, array $settings = [])
 */
class DuvidasController extends AreaProfessorController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'conditions' => [
                'Duvidas.feedback_professor IS NULL'
            ],
            'contain' => ['Alunos']
        ];
        $duvidas = $this->paginate($this->Duvidas);

        $this->set(compact('duvidas'));
        $this->set('_serialize', ['duvidas']);
    }

    /**
     * View method
     *
     * @param string|null $id Duvida id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $duvida = $this->Duvidas->get($id, [
            'contain' => ['Alunos']
        ]);

        $this->set('duvida', $duvida);
        $this->set('_serialize', ['duvida']);
    }

    /**
     * responder method
     *
     * @param string|null $id Duvida id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function responder($id = null) {
        $duvida = $this->Duvidas->get($id, [
            'contain' => ['Alunos']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $duvida = $this->Duvidas->patchEntity($duvida, $this->request->getData());
            if ($this->Duvidas->save($duvida)) {
                $this->Flash->success(__('A dúvida foi respondida com sucesso.'));
                $this->mandaEmailAvisandoAluno($duvida);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The duvida could not be saved. Please, try again.'));
        }
        $this->set(compact('duvida'));
        $this->set('_serialize', ['duvida']);
    }

    private function mandaEmailAvisandoAluno($duvida) {
        $email = new Email();
        $email->from(['williantcc2017@gmail.com' => 'Ambiente']);
        $email->to($duvida->aluno->email);
        $email->setSubject('Dúvida Respondida');
        $msg = "Olá " . $duvida->aluno->nome . ", sua dúvida foi respondida pelo professor.\n"
                . "Por favor, acesse https://willianserafini.000webhostapp.com/site/index#tm-section-3  \n\n";
        $email->send($msg);
    }

}
