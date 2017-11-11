<br />
<div>
    <?= $this->Form->create(); ?>
    <h2>Questões para Identificar ECA Sequencial/Global</h2>

    <br />

    <strong>Perguntas</strong>
    <br />

    <div class="left-align">
        <strong>1 - Eu tendo a</strong>
        <?php
        echo $this->Form->input('q1', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'compreender os detalhes de um assunto, mas a estrutura geral pode ficar imprecisa.',
                1 => 'compreender a estrutura geral de um assunto, mas os detalhes podem ficar imprecisos.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>2 - Quando eu compreendo</strong>
        <?php
        echo $this->Form->input('q2', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'todas as partes, consigo entender o todo.',
                1 => 'o todo, consigo ver como as partes se encaixam.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>


        <strong>3 - Quando resolvo problemas de Matemática, eu</strong>
        <?php
        echo $this->Form->input('q3', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'usualmente trabalho de maneira a resolver uma etapa de cada vez.',
                1 => 'freqüentemente antevejo as soluções, mas tenho que me esforçar muito para conceber as etapas para chegar a elas.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>4 - Quando estou analisando uma história ou novela eu</strong>
        <?php
        echo $this->Form->input('q4', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'penso nos incidentes e tento colocá-los juntos para identificar os temas.',
                1 => 'tenho consciência dos temas quando termino a leitura e então, tenho que voltar atrás
para encontrar os incidentes que os confirmem.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>5 - Na minha concepção é mais importante que o professor</strong>
        <?php
        echo $this->Form->input('q5', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'apresente a matéria em etapas sequências claras.',
                1 => 'apresente um quadro geral e relacione a matéria com outros assuntos.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>6 - Eu aprendo</strong>
        <?php
        echo $this->Form->input('q6', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'num ritmo bastante regular. Se estudar "pesado" eu “chego lá”.',
                1 => 'em saltos. Fico totalmente confuso por algum tempo, mas, repentinamente eu
tenho um “estalo”.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>
    </div>
        
    <div class="right-align">
        <strong>7 - Quando considero um conjunto de informações, provavelmente eu</strong>
        <?php
        echo $this->Form->input('q7', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'presto mais atenção nos detalhes e não percebo o quadro geral.',
                1 => 'procuro compreender o quadro geral antes de atentar para os detalhes.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>8 - Quando escrevo um texto, eu prefiro trabalhar (pensar a respeito ou escrever)</strong>
        <?php
        echo $this->Form->input('q8', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'a parte inicial do texto e avançar ordenadamente.',
                1 => 'diferentes partes do texto e ordená-las depois.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>9 - Quando estou aprendendo um assunto novo, eu prefiro</strong>
        <?php
        echo $this->Form->input('q9', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'concentrar-me no assunto, aprendendo o máximo possível.',
                1 => 'tentar estabelecer conexões entre o assunto e outros com ele relacionados.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>10 - Alguns professores iniciam suas explicações com um resumo do que irão abordar.
Tais resumos são</strong>
        <?php
        echo $this->Form->input('q10', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'de alguma utilidade para mim.',
                1 => 'muito úteis para mim.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>

        <strong>11 - Quando estou resolvendo problemas em grupo, mais provavelmente eu</strong>
        <?php
        echo $this->Form->input('q11', [
            'templates' => [
                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
            ],
            'type' => 'radio',
            'options' => [
                0 => 'penso nas etapas do processo de solução.',
                1 => 'penso nas possíveis conseqüências, ou sobre a aplicação da solução para muitos problemas.'
            ],
            'required' => 'required',
            'label' => false
        ]);
        ?>




    </div>







    <br />


    <?= $this->Form->submit('Enviar', array('class' => 'button')); ?>
    <?= $this->Form->end(); ?>
</div>
