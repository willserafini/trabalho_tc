<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('reset');
        echo $this->Html->css('imprimir_relatorio');
        echo $this->Html->script('jquery.min.js');
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div id="container">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_layout; ?>
        </div>
    </body>
</html>