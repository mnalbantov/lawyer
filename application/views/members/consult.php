  <div id="menu">
      <ul>
        <li><a href="<?= base_url();?>members" accesskey="1" title="">Начало</a></li>
        <li><a href="<?= base_url();?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url();?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <li class="current_page_item"><a href="<?= base_url();?>members/consult" accesskey="5" title="">Конултация</a></li>
      </ul>
    </div>
  </div>
</div>

<div id="header-question"> </div>

<div id="wrapper">
 
  <div id="question" class="container">
      <h2>Онлайн консултация</h2>
      <p>Можете да зададете вашият въпрос като използвате формата за изпращане на въпроси</p>
   <?php echo form_open('members/add_question');?>
      <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
      <?= validation_errors('<p class="alert alert-danger">','</p>'); ?>
      <input type="text" name="title" placeholder="Заглавие на въпроса ви" class="form-control"/><br/>
      <textarea  resize:none class="form-control" rows="10" name="subject" placeholder="Вашето запитване"></textarea><br/>
      <input type="submit" name="ask" value="Изпрати" class="btn btn-success" />
    <?php echo form_close();?>
      
  </div>

    
</div>