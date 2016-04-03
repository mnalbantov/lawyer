<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.4&appId=140946166246792";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
        <?php if ($posts): ?>
            <?php foreach ($posts as $post): ?> 
                <?php $date = date_create($post->entry_date);
                ?>
                   
                <small style='float:right;'>&nbsp;<strong><?php echo date_format($date, 'l jS F Y'); ?></strong></small>
                <h3><a href="<?= base_url('blog/post/' . $post->entry_id) ?>"><?= $post->entry_name; ?></a></h3><br/>
                    <?php if($post->pic_name): ?>
                <a href="<?= base_url('blog/post').'/'.$post->entry_id; ?>"><img src="<?= base_url().'uploads/thumbs/'.$post->pic_name; ?>"/></a>
                <?php endif;?>
                <?php if (mb_strlen($post->entry_body) > 100): ?>
                    <?php $textCut = substr($post->entry_body, 0, 300) ?>
                    <?php $post->entry_body = substr($textCut, 0, strrpos($textCut, ' ')) ?>
                <p><strong><?= $post->entry_body; ?>&nbsp;...</strong><br/><a class="btn  btn-info" href="<?= base_url('blog/post/' . $post->entry_id) ?>">Прочети повече</a> </p>
                <?php else: ?>
                    <p><?= $post->entry_body; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
                    <h3>Все още няма публикации.</h3>
                    <p>Напишете първата сега :) </p>
        <?php endif;
        ?>
        <!-- <a href="#" class="button">Добави коментар</a> 
         <div class="form-group">
             <textarea class="form-control" rows="5" id="comment"></textarea>
         </div> -->

    </div>
    <div id="lastest" class="pull-left" >
        <h2>Последно добавени </h2>
        <?php foreach ($posts as $post): ?>
        <a href="<?= base_url('blog/post').'/'.$post->entry_id; ?>"><?php echo $post->entry_name; ?></a>- <a href="<?= base_url('blog/category').'/'.$post->category_id; ?>"><?php echo $post->category_name; ?></a><br/>
        <?php endforeach;?><br/>
        <h2>Най-гледани</h2>
        
    </div><br/>
        <div>
   <div class="fb-page" data-href="https://www.facebook.com/Draginovo" data-width="400" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/Draginovo"><a href="https://www.facebook.com/Draginovo">Draginovo /  Драгиново</a></blockquote></div></div>
    </div>
    



</div>