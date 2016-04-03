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
        <h2>Регистриране на потребител </h2>
        <?php if ($message):  ?>
        <?php echo '<p class="alert alert-success">' . $message . '</p>'; ?>
        <?php endif; ?>
        <?= form_open('register/validate_reg'); ?>
        <label for="email" class="icon icon-user">Email *</label> 
        <?= form_input('email', $this->input->post('email'), 'class="form-control" id="email"'); ?>
        <?= form_error('email') ?>;
        <label for="username" class="icon icon-edit">Потребителско име *</label>
        <?= form_input('username', $this->input->post('username'), 'class="form-control" id="username"'); ?> 
        <?= form_error('username') ?>;
        <label for="password" class="icon icon-warning-sign">Парола *</label>
        <?= form_password('password', '', 'class="form-control" id="password"'); ?> 
        <?= form_error('password') ?>;
        <label for="cpassword" class="icon icon-warning-sign">Повтори парола *</label>
        <?= form_password('cpassword', '', 'class="form-control" id="cpassword"'); ?> 
        <?= form_error('cpassword') ?>;
        <label for="f_name" class="icon icon-edit">Вашето име *</label>
        <?= form_input('f_name', $this->input->post('f_name'), 'class="form-control" id="f_name"'); ?>
        <?= form_error('f_name') ?>;
        <label for="l_name" class="icon icon-edit">Фамилия *</label>
        <?= form_input('l_name', $this->input->post('l_name'), 'class="form-control" id="l_name"'); ?> 
        <?= form_error('l_name') ?>;
        <label for="address" class="icon icon-home">Адрес</label>
        <?= form_input('address', $this->input->post('address'), 'class="form-control" id="address"'); ?><br/>
        <?= form_error('address') ?>;
        <label for="phone" class="icon icon-phone">Телефон</label>
        <?= form_input('phone', $this->input->post('phone'), 'class="form-control" id="phone"'); ?><br/>
        <?= form_error('phone') ?>;
        <input type="submit" value="Регистрация" class="btn btn-success" />

        <?= form_close(); ?>


    </div>