

<div id="menu">
    <ul>
        <li><a href="<?= base_url(); ?>pages" accesskey="1" title="">Начало</a></li>
        <li class="current_page_item"><a href="<?= base_url(); ?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url(); ?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <?php if ($this->session->userdata('is_logged_in')): ?>
            <li><a href="<?= base_url(); ?>members/logout" accesskey="5" title="">Изход</a></li>
        <?php else: ?>
            <li><a href="<?= base_url(); ?>login" accesskey="5" title="">Вход за клиенти</a></li>
        <?php endif; ?>
    </ul>
</div>
</div>
</div>
<div id="header-blog"></div>


<div id="wrapper">
    <div id="news" class="container">
        <?php if ($posts_orders): ?>
            <?php foreach ($posts_orders as $post): ?>
                <?php $date = date_create($post->entry_date);
                ?>
                   
                <small style='float:right;'>&nbsp;<strong><?php echo date_format($date, 'l jS F Y'); ?></strong></small>
                <h3><a href="<?= base_url('blog/post/' . $post->entry_id) ?>"><?= $post->entry_name; ?></a></h3><br/>  
                <?php if (mb_strlen($post->entry_body) > 700): ?>
                    <?php $textCut = substr($post->entry_body, 0, 700) ?>
                    <?php $post->entry_body = substr($textCut, 0, strrpos($textCut, ' ')) ?>
                <p><strong><?= $post->entry_body; ?>&nbsp;...</strong><br/><a class="btn  btn-info" href="<?= base_url('blog/post/' . $post->entry_id) ?>">Прочети повече</a> </p>
                <?php else: ?>
                    <p><?= $post->entry_body; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else:
     redirect('blog');                
        endif;
        ?>
       

    </div>
    <div id="lastest">
        <h2>Последно добавени </h2>
        <?php foreach ($posts_orders as $post): ?>
        <a href="<?= base_url('blog/post').'/'.$post->entry_id; ?>"><?php echo $post->entry_name; ?></a>- <?php echo $post->category_name; ?><br/>
        <?php endforeach;?><br/>
        <h2>Най-гледани</h2>
    </div>



</div>