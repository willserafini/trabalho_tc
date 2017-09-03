<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>


        <?= $this->Html->css('base.css') ?>
        <?= $this->Html->css('cake.css') ?>

        <?= $this->Html->script('jquery.min') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-2 medium-2 columns">
                <li class="name">
                    <h1><?= $this->Html->link('Professores', ['controller' => 'professores', 'action' => 'index']); ?></h1>
                </li>
            </ul>
            <ul class="title-area large-1 medium-2 columns">
                <li class="name">
                    <h1><?= $this->Html->link('Alunos', ['controller' => 'alunos', 'action' => 'index']); ?></h1>
                </li>
            </ul>
            <section class="top-bar-section">
                <ul class="right">
                    <?php if ($loggedIn) : ?>
                        <li><?= $this->Html->link('Logout', ['controller' => 'professores', 'action' => 'logout']); ?></li>
                    <?php endif; ?>
                </ul>
            </section>
        </nav>
        <?= $this->Flash->render() ?>
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
        <footer>
        </footer>
    </body>
</html>
