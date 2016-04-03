<div id="menu">
    <ul>
        <li><a href="<?= base_url(); ?>pages" accesskey="1" title="">Начало</a></li>
        <li><a href="<?= base_url(); ?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url(); ?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <li><a href="<?= base_url(); ?>login" accesskey="6" title="">Вход за клиенти</a></li>
    </ul>
</div>
</div>
</div>


<div id="wrapper">
    <div id="header-register"></div>
    <div id="register" class="container">
        <h2>Успешна регистрация! </h2>
        <?php if ($message):  ?>
        <?php echo '<p class="alert alert-success">' . $message . '</p>'; ?>
        <?php endif; ?>
        <a href="<?=base_url('login');?>">Влезте от тук</a>
       

    </div>