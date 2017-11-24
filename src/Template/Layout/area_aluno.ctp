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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">   <!-- Google web font "Open Sans" -->

        <?= $this->Html->css('base.css') ?>
        <?= $this->Html->css('cake.css') ?>  
        <?= $this->Html->css('jquery-ui.min.css') ?>        
        <?= $this->Html->css('bootstrap.min.css') ?>

        <?= $this->Html->css('templatemo-style.css?v=2') ?>

        <?= $this->Html->script('jquery.min') ?>        
        <?= $this->Html->script('tether.min.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('jquery-ui.min') ?>
        <?= $this->Html->script('tinymce.min.js'); ?>
        <?php //echo $this->Html->script('jquery.singlePageNav.min.js') ?>


        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>        
    </head>
    <body>
        <?= $this->Flash->render() ?>
        <div class="container tm-container">
            <div class="row navbar-row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar-container">

                    <nav class="navbar navbar-full">

                        <div class="collapse navbar-toggleable-md" id="tmNavbar">                            

                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $this->Url->build('/index'); ?>#tm-section-1">Conteúdos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $this->Url->build('/index'); ?>#tm-section-2">Atividades</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $this->Url->build('/index'); ?>#tm-section-3">Dúvidas?</a>
                                </li>
                            </ul>
                        </div>
                    </nav>    
                    <?php if ($loggedIn) : ?>
                        <p>Olá <?= $this->request->session()->read('Auth')['Aluno']['nome'] ?>! <br />
                            <?= $this->Html->link('Sair', ['controller' => 'site', 'action' => 'logout']); ?></p>
                    <?php endif; ?>
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                        &#9776;
                    </button>

                </div>
            </div>
            <div class="tm-page-content">                
                <?= $this->fetch('content') ?>


                <footer class="row tm-footer">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <p class="text-xs-center tm-footer-text">
                            Revisor de Conteúdos de Computação - RCC                            
                            <br>
                            Trabalho de Conclusão de Curso - Willian Serafini
                        </p>


                    </div>

                </footer> 
            </div>

        </div>        

        <!-- Templatemo scripts -->
        <script>

            var bigNavbarHeight = 90;
            var smallNavbarHeight = 68;
            var navbarHeight = bigNavbarHeight;

            $(document).ready(function () {

                /* Single page nav
                 -----------------------------------------*/

                if ($(window).width() < 992) {
                    navbarHeight = smallNavbarHeight;
                }

                /*$('#tmNavbar').singlePageNav({
                 'currentClass': "active",
                 offset: navbarHeight
                 });*/


                /* Collapse menu after click 
                 http://stackoverflow.com/questions/14203279/bootstrap-close-responsive-menu-on-click
                 ----------------------------------------------------------------------------------------*/

                $('#tmNavbar').on("click", "a", null, function () {
                    $('#tmNavbar').collapse('hide');
                });

                // Handle nav offset upon window resize
                $(window).resize(function () {
                    if ($(window).width() < 992) {
                        navbarHeight = smallNavbarHeight;
                    } else {
                        navbarHeight = bigNavbarHeight;
                    }

                    /*$('#tmNavbar').singlePageNav({
                     'currentClass': "active",
                     offset: navbarHeight
                     });*/
                });


                /*  Scroll to top
                 http://stackoverflow.com/questions/5580350/jquery-cross-browser-scroll-to-top-with-animation
                 --------------------------------------------------------------------------------------------------*/
                $('#go-to-top').each(function () {
                    $(this).click(function () {
                        $('html,body').animate({scrollTop: 0}, 'slow');
                        return false;
                    });
                });

            });

        </script>           


    </body>
</html>
