<div id="menu">
      <ul>
        <li><a href="<?= base_url();?>pages" accesskey="1" title="">Начало</a></li>
        <li><a href="<?= base_url();?>blog" accesskey="2" title="">Блог</a></li>
        <li class="current_page_item"><a href="<?= base_url();?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
            <?php if($this->session->userdata('is_logged_in')):?>
     <li><a href="<?= base_url();?>members/logout" accesskey="5" title="">Изход</a></li>
    <?php else: ?>
      <li><a href="<?= base_url();?>login" accesskey="5" title="">Вход за клиенти</a></li>
    <?php endif;?>
      
      </ul>
    </div>
  </div>
</div>
    <div class="quotes">
	              <h1>Цитат на деня</h1>
                       <?php foreach($quote as $q): ?>
	              <p class="lead">
                           <?= $q->quote_text;?> </p>
                          <?php endforeach;?>  	
	            </div>
<div id="header-featured"> </div>

<div id="wrapper">
 
  <div id="about" class="container">
    <h2>Кой съм аз?</h2>
    <span>Тук ще има информация относно това с какво се занимавам</span> 
    <p>This is <strong>Nalbantov</strong>, a free, fully standards-compliant CSS template designed by Meto. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
    <?php foreach($rows as $row): ?>
    <p> <?= $row->email; ?> </p>
    <?php endforeach;?>
    <?php if($this->session->userdata('is_logged_in')):?>
    <a href="<?= base_url();?>members/consult" class="button">Онлайн консултация</a> 
    <?php else: ?>
    <a href="<?= base_url();?>pages/consult" class="button">Онлайн консултация</a> 
    <?php endif;?>
  </div>
    <div id="picture">
       
    </div>
    
</div>