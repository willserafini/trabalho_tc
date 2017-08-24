<?php

Cache::config('default', array('engine' => 'File'));
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'File',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'File',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

Configure::write('Config.language', 'pt-br');


$sis_admin_app = dirname(ROOT) . DS . 'sis_prof' . DS . 'app' . DS;
$models_sis_admin = $sis_admin_app . 'Model' . DS;
$components_sis_admin = $sis_admin_app . 'Controller' . DS . 'Component' . DS;
$vendors_sis_admin = $sis_admin_app . 'Vendor' . DS;
$plugins_sis_admin = $sis_admin_app . 'Plugin' . DS;
$libs_sis_admin = $sis_admin_app . 'Lib' . DS;

App::build(array(
    'Model' => array(APP . DS . 'Model' . DS, $models_sis_admin),
    'Controller/Component' => array(APP . DS . 'Controller' . DS . 'Component' . DS, $components_sis_admin),
    'Lib' => array(APP . DS . 'Lib' . DS, $libs_sis_admin),
    'Vendor' => array(APP . DS . 'Vendor' . DS, $vendors_sis_admin),
    'Plugin' => array(APP . DS . 'Plugin' . DS, $plugins_sis_admin),
));

CakePlugin::loadAll();