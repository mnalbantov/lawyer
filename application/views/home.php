<div id="menu">
    <ul>
        <li class="current_page_item"><a href="<?= base_url(); ?>" accesskey="1" title="">Начало</a></li>
        <li><a href="<?= base_url(); ?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url(); ?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <?php if ($this->session->userdata('is_logged_in')): ?>
            <li><a href="<?= base_url(); ?>members" accesskey="5" title="">Профил</a></li>
        <?php else: ?>
            <li><a href="<?= base_url(); ?>login" accesskey="5" title="">Вход за клиенти</a></li>
        <?php endif; ?>
    </ul>
</div>
</div>
</div>
<div class="quotes">
    <h1>Цитат на деня</h1>
    <?php foreach ($quote as $q): ?>
        <p class="lead">
            <?= $q->quote_text; ?> </p>
    <?php endforeach; ?>  	
</div>
<div id="header-featured"> </div>
<?php if (isset($posts) && count($posts)): ?>

    <div id="wrapper">
        <div id="featured-wrapper">
            <div id="featured" class="container">


            </div>
        </div>
    </div>
    <div id="extra">
        <h2>Последно добавени теми от блога</h2>
        <div class="last" >
            <?php foreach ($posts as $post): ?>
                <div class="column">
                    <a href="<?= base_url('blog/category') . '/' . $post->category_id; ?>"><?= $post->category_name; ?></a>
                    <?php if($post->pic_id):?>
                    <p ><a href="<?= base_url('blog/post') . '/' . $post->entry_id; ?>"><img class="article_img"  src="<?= base_url() . 'uploads/thumbs' . '/' . $post->pic_name; ?>" width="180" height="100"/></a></p>
                    <?php else:?>
                     <p ><a href="<?= base_url('blog/post') . '/' . $post->entry_id; ?>"><img class="article_img"  src="<?= base_url() . 'uploads/blog_images' . '/default_post.png'; ?>" width="180" height="100"/></a></p>
                     <?php endif;?>
                     <a href="<?= base_url('blog/post') . '/' . $post->entry_id; ?>" class="title    "><?= $post->entry_name; ?> </a>

                </div>
            <?php endforeach; ?>

        </div>


        <a href="<?= base_url('blog') ?>" class="button">Научи повече</a> </div>
    </div>

    <?php endif;
?>
<script>
    $(document).ready(function () {
       $('#header-featured').hover(function(){
        
       });

    });
</script>
</body>
