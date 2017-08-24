<?php

App::uses('Model', 'Model');

class AppModel extends Model {

    public $camposLimpar = [];

    public function beforeValidate($options = array()) {
        foreach ($this->camposLimpar as $campo) {
            if (!isset($this->data[$this->alias][$campo])) {
                continue;
            }

            $valor = $this->data[$this->alias][$campo];
            $this->data[$this->alias][$campo] = preg_replace('/[^0-9]/', '', $valor);
        }
    }

}