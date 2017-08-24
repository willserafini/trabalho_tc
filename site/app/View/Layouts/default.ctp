<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo __('Simulado Pré Vestibular Método Medicina') . $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('reset');
        echo $this->Html->css('site.css?v=2');
        echo $this->Html->script('jquery.min.js');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>

        <!--[if lt IE 9]>
        <script src="<?php echo $this->Html->url('/js/') ?>html5.js"></script>
        <![endif]-->
    </head>
    <body>

        <?php
        if (!isset($mostrarImgTopo)) {
            $mostrarImgTopo = true;
        }
        ?>


        <div id="container">

            <?php
            if ($mostrarImgTopo) {
                echo $this->element('site/topo');
            }
            ?>

            <div id="conteudo">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
            <div class="clear"></div>
        </div>

        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>