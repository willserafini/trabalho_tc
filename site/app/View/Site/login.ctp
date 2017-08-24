<section id="login">
    <?php echo $this->Session->flash(); ?>
    
    <div class="aviso">PARA ACESSAR SISTEMA DE LISTAS ONLINE FAÇA SEU LOGIN</div>
    <div class="cx_login">
        <?php echo $this->Form->create('Aluno') ?>
        <?php echo $this->Form->input('Aluno.matricula', array('label' => 'Login:')) ?>
        <?php echo $this->Form->input('Aluno.senha', array('type' => 'password', 'label' => 'Senha:')) ?>
        <input type="submit" name="enviar" value="Acessar" class="acessar" />
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="aviso">Esqueceu login ou senha, contate a direção para renovar o acesso</div>
</section>