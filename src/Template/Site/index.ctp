<section id="tm-section-1" class="row tm-section">
    <div class="tm-white-curve-left col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="tm-white-curve-text">
            <h2 class="tm-section-header blue-text">Conteúdos</h2>

            <p><?= $this->Conteudos->imprimiConteudosHTML(); ?></p>
        </div>                        
    </div>
</section>

<section id="tm-section-2" class="row tm-section">
    <div class="tm-white-curve-left col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="tm-white-curve-text">
            <h2 class="tm-section-header blue-text">Atividades</h2>
            <ul class="">
                <?php foreach ($quizzes as $quiz): ?>                    
                    <li>
                        <?php if ($quiz->is_avaliado) : ?>
                            <?= $quiz->nome ?> foi avaliado. <a href="<?= $this->Url->build('/quiz_avaliado/' . $quiz->id); ?>">Clique aqui para ver o resultado!</a>
                        <?php else : ?>
                            <a href="<?= $this->Url->build('/quiz/' . $quiz->id); ?>"><?= $quiz->nome ?></a>
                        <?php endif; ?>

                    </li>
                <?php endforeach; ?>
            </ul>
        </div>                        
    </div>
</section>

<section id="tm-section-3" class="row tm-section">
    <div class="tm-white-curve-left col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="tm-white-curve-text">
            <h2 class="tm-section-header blue-text">Dúvidas</h2>
            <a href="<?= $this->Url->build('/cadastrar_duvida'); ?>">->Cadastrar Nova Dúvida</a>
            <ul class="">
                <?php foreach ($duvidas as $duvida): ?>                    
                    <li>
                        <a href="<?= $this->Url->build('/duvida/' . $duvida->id); ?>">
                            Assunto: <?= $duvida->assunto ?>
                            <?php
                            if (!empty($duvida->feedback_professor)) {
                                echo ' - Dúvida foi Respondida!';
                            }
                            ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>   
    </div>
</section>