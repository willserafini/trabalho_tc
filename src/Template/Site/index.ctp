<h2 style="color: #00599a; text-align: center">Revisor de Conteúdos de Computação - RCC</h2>

<br />
<p class="avaliarAmbiente">Ainda não avaliou o ambiente?
    <a href="https://goo.gl/forms/wZtXobbIZJ02nVbe2" target="_blank"><strong>Clique aqui</strong></a>
</p>

<section id="tm-section-1" class="row tm-section">
    <div class="tm-white-curve-left col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-11">
        <div class="tm-white-curve-text">
            <h2 class="tm-section-header blue-text">Conteúdos</h2>

            <?php if ($this->Conteudos->isEcaSequencial()) : ?>
            <p>Como o seu ECA (Estilo Cognitivo de Aprendizagem) é o <strong>Sequencial</strong>,
                    você precisa começar pelo Conteúdo <strong>COMANDO REPITA</strong>.                
                    Para liberar acesso aos outros conteúdos, você precisa clicar em <strong>Próximo Conteúdo</strong>,
                    presente dentro do conteúdo estudado.
                </p>
            <?php endif; ?>


            <p><?= $this->Conteudos->imprimiConteudosHTML(); ?></p>
        </div>                        
    </div>
</section>

<section id="tm-section-2" class="row tm-section">
    <div class="tm-white-curve-left col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-11">
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
    <div class="tm-white-curve-left col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-11">
        <div class="tm-white-curve-text">
            <h2 class="tm-section-header blue-text">Dúvidas</h2>

            <p>
                Caso tenha alguma dúvida sobre o <strong>RCC</strong>, ou sobre algum conteúdo, ou sobre alguma
                atividade, <strong>cadastre uma nova dúvida</strong>. Você será notificado por email quando o professor ou
                responsável responder sua dúvida.
            </p>
            <a href="<?= $this->Url->build('/cadastrar_duvida'); ?>">+ Cadastrar Nova Dúvida</a>
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