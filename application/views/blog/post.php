<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.4&appId=140946166246792";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php if ($this->session->userdata('admin_logged')): ?> 
    <div id="menu">
        <ul>
            <li><a href="<?= base_url(); ?>pages" accesskey="1" title="">Начало</a></li>
            <li class="current_page_item"><a href="<?= base_url(); ?>blog" accesskey="2" title="">Блог</a></li>
            <li><a href="<?= base_url(); ?>about" accesskey="3" title="">За мен</a></li>
            <li><a href="#" accesskey="5" title="">Контакти</a></li>
            <?php if ($this->session->userdata('is_logged_in')): ?>
                <li><a href="<?= base_url(); ?>members/logout" accesskey="5" title="">Изход</a></li>
            <?php else: ?>
                <li><a href="<?= base_url(); ?>admin" accesskey="5" title="">Админ панел</a></li>
            <?php endif; ?>
        </ul>
    </div>
    </div>
    </div>
    <div id="header-blog"></div>    

    <div id="wrapper">
        <div id="news" class="container">
            <?php if ($post): ?>
                <?php foreach ($post as $p): ?>  

                    <?php $date = date_create($p->entry_date); ?>
                    <article>
                        <header>
                            <h2><?= $p->entry_name; ?></h2>
                        </header>    
                        <em  style="float:right;" class="icon icon-comments">Коментари (<?= $total_comments; ?>)</em>
                        <em style="float:right;margin-right: 1em;" class="icon icon-user"><?= $p->username; ?></em>
                        <em style="float:right;margin-right: 1em;" class="icon icon-pencil"><a href="<?= base_url('blog/category') . '/' . $p->category_id; ?>"><?= $p->category_name; ?></a></em>
                        <span  class=" icon icon-time">&nbsp;<?= date_format($date, 'l d m Y'); ?></span><hr/>
                        <?php if ($p->pic_name): ?>
                            <img src="<?= base_url() . 'uploads/' . $p->pic_name; ?>" width="600" height="400"/>
                        <?php endif; ?>
                        <div class="post"><?= $p->entry_body; ?></div>
                        <a href="javascript:showEdit();"  class="icon icon-edit">Редактирай</a> 
                        <a href="javascript:deletePost();" style="float:right;" class="icon icon-trash">Изтрий</a>
                    <?php endforeach; ?>
                </article>
            <?php else: ?>
                <?php redirect('blog'); ?>
            <?php endif; ?>
            <form style="display:none;"  class="edit_post" method="POST" action="javascript:editPost();">
                <textarea  id="post" class="form-control" rows="25" cols="100"> <?= $p->entry_body; ?></textarea><br/>
                <input type="submit" value="Запази" class="btn btn-primary" />
                <a href="javascript:cancelEdit();"  class="btn btn-danger"  style="float:right;"/>Откажи</a>
            </form>
            <div style="display:none;" class="actions">
                <p class="alert alert-danger">Сигурни ли сте,че искате да изтриете тази публикация?</p>
                <button class="btn btn-danger" id="deletePost">Да</button>
                <a id="cancelDelete" class="btn btn-default">Не</a>
            </div>
                <div class="fb-like" data-href="http://hydraltd.com/meto" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                <section class="comments">
                 <?php if ($comments): ?>
                
                    <h3 id="comment">Коментари</h3><hr/> 
                    <?php foreach ($comments as $comment): ?>
                        <?php $comment_date = date_create($comment->comment_date) ?>
                        <?php if ($comment->user_id == 1): ?>
                            <div class="postemeta" id="comment<?= $comment->comment_id; ?>">
                                <div>
                                    <strong style="color:red;">
                                        <div  class="glyphicon glyphicon-user " style="margin-right: 5px;"></div><?php echo ucwords($comment->comment_name); ?></strong> каза: 
                                        <a href="javascript:deleteComment(<?=$comment->comment_id; ?>);" class="pull-right glyphicon glyphicon-remove" title="Изтриване на този коментар" ></a>
                                        <b style="float:right;"><?= date_format($comment_date, 'D j F Y h:i:s'); ?></b>
                                   
                                </div>
                                <p><?php echo $comment->comment_body; ?></p>
                            </div>


                        <?php else: ?>
                            <div class="postemeta" id="comment<?= $comment->comment_id; ?>">
                                <div>
                                    <strong style="color:#0086b3;">
                                        <div  class="glyphicon glyphicon-user " style="margin-right: 5px;"></div><?php echo ucwords($comment->comment_name); ?></strong> каза: 
                                        <a href="javascript:deleteComment(<?=$comment->comment_id; ?>);" title="Изтриване на този коментар" class="pull-right glyphicon glyphicon-remove"></a>
                                        <b style="float:right;"><?= date_format($comment_date, 'D j F Y h:i:s'); ?></b>
                                </div>
                                <p><?php echo $comment->comment_body; ?></p>

                            </div>

                        
                    <?php
                    endif;
                endforeach;
            else:
                ?>
                <h4 id="comment">Все още няма коментари!</h4>
                <p style="padding:0 2em;">Напишете първият ...</p><hr/>
            <?php endif; ?></section><br/>
              <div class="fb-comments" data-href="http://hydraltd.com/meto"  data-numposts="5"></div>
            <div class="err_msg"></div>
           
            <p><p  id="message" style="color:#a2d246;"><?php
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                ?></p>
            <span id="loading" style="display:none;margin:0 auto;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>
            <?php echo validation_errors(); ?>
            <?php if ($this->session->userdata('is_logged_in')): ?>
                <input type="hidden" name="commentor" id="commentor" value="<?php echo $this->session->userdata('username'); ?>" type="text" size="30" />

                <input type="hidden" name="email"  id="email" value="<?php echo $this->session->userdata('email'); ?>" type="text" size="30" /><br/>   


            <?php elseif ($this->session->userdata('admin_logged')): ?>
                <input type="hidden" name="commentor" id="commentor" value="<?php echo $this->session->userdata('name'); ?>" type="text" size="30" />

                <input type="hidden" name="email" id="email" value="<?php echo $this->session->userdata('email'); ?>" type="text" size="30" /><br/>   

            <?php else: ?>

                <label for="commentor" class="icon icon-user">Име</label><br/>
                <input  name="commentor" id="commentor" placeholder="Вашето име" type="text" size="30" /><br/>

                <label for="email"  class="icon icon icon-edit">Email</label><br/>
                <input id="email" name="email" placeholder="Вашият email" type="text" size="30" /><br/>

            <?php
            endif;
            $textarea = array(
                'class' => 'form-control',
                'id' => 'type_msg',
                'name' => 'comment',
                'rows' => 5,
                'cols' => 6,
            );
            ?>

            <label for="type_msg" class="icon icon-pencil">&nbsp;Вашият коментар</label><strong style="color:#e23b33;">(на кирилица)</strong><br/>  
            <?php echo form_textarea($textarea, $this->input->post('comment')); ?>
            <br />	

            <input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>" />

            <input type="hidden" name="user_id" id="user_id" value="<?php echo (($this->session->userdata('id'))) ? $this->session->userdata('id') : ''; ?>" />

            <input class="button" type="submit" id="addComment" value="Добави коментар"/>
            <input class="button" type="reset" id="reset" value="Изчисти"/>	
            </p>		
       


        </div>

        <div id="lastest">
            <h2>Последно добавени </h2>

        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Изтрита публикация</h4>
                </div>
                <div class="modal-body">
                    <p>Тази публикация е изтрита успешно</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
       <div class="modal" id="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Изтриване на  коментар</h4>
                </div>
                <div class="modal-body">
                    <p>Наистина ли искате да изтриете този коментар?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">Да</button>
                    <button type="button" id="no" class="btn btn-default "aria-hidden="true">Не</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
    <script>
        function showEdit() {
            $('.edit_post').slideDown(2000);

        }
       $('#addComment').on('click',function(){
            var post_id = $("#post_id").val();
        var user_id = $('#user_id').val();
        var commentor = $('#commentor').val();
        var email = $("#email").val();
        var comment = $("#type_msg").val();
        $('#loading').show();
       
        $.ajax({
            url:"<?=site_url('blog/add_comment') ?>",
            data:{
                user_id:user_id,
                post_id:post_id,
                commentor:commentor,
                email:email,
                comment:comment
            },
            type:'POST'
            
        }).done(function(data){    
          var result = JSON.parse(data);
          if(result.err === 1){
             $('.err_msg').show().html(result.error).fadeOut(5000); 
          }else{
              var comment ='';
              for(var i in result.comments){
                  
                  if(result.comments[i].user_id === '1')
                  {
                     comment += '<div class="postemeta" id="comment'+ result.comments[i].comment_id +'"><div><strong style="color:red;"><div class="glyphicon glyphicon-user" style="margin-right: 5px;"></div>'+ result.comments[i].comment_name + '<a href="javascript:deleteComment('+ result.comments[i].comment_id +');" class="pull-right glyphicon glyphicon-remove" title="Изтриване на този коментар" ></a></strong> каза:<b style="float:right;">'+ result.comments[i].comment_date + '</b></div>'+ '<p>'+ result.comments[i].comment_body + '</p></div>';
                  }else
                  {
                     comment += '<div class="postemeta" id="comment'+ result.comments[i].comment_id +'"><div><strong style="color:#0086b3;"><div class="glyphicon glyphicon-user" style="margin-right: 5px;"></div>'+ result.comments[i].comment_name + '<a href="javascript:deleteComment('+ result.comments[i].comment_id +');" class="pull-right glyphicon glyphicon-remove" title="Изтриване на този коментар" ></a></strong> каза:<b style="float:right;">'+ result.comments[i].comment_date + '</b></div>'+ '<p>'+ result.comments[i].comment_body + '</p></div>'; 
                  }                  
              }
              $('article em:first').html('Коментари('+result.total_comments+')');
              $('.err_msg').hide();
              $("html, body").animate({ scrollTop: $('.comments').offset().top }, 2000);
              $('.comments').html(comment); 
             
          }
          $('#loading').hide();
          $('#type_msg').val('');
        }).fail(function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
        alert(xhr.responseText);
      });
       });
       $('#reset').on('click',function(){
        $('#type_msg').val('');
       });
        function deleteComment(id){
          $.post('<?= site_url('admin/delete_comment'); ?>', {
                comment_id: id,
                post_id: $('#post_id').val(),
                dataType: "json"
            }, function (data) {
                var result = JSON.parse(data);
                var comment = '';
             for(var i in result.comments){
                  if(result.comments[i].user_id === '1')
                  {
                     comment += '<div class="postemeta" id="comment'+ result.comments[i].comment_id +'"><div><strong style="color:red;"><div class="glyphicon glyphicon-user" style="margin-right: 5px;"></div>'+ result.comments[i].comment_name + '<a href="javascript:deleteComment('+ result.comments[i].comment_id +');" class="pull-right glyphicon glyphicon-remove" title="Изтриване на този коментар" ></a></strong> каза:<b style="float:right;">'+ result.comments[i].comment_date + '</b></div>'+ '<p>'+ result.comments[i].comment_body + '</p></div>';
                  }else
                  {
                     comment += '<div class="postemeta" id="comment'+ result.comments[i].comment_id +'"><div><strong style="color:#0086b3;"><div class="glyphicon glyphicon-user" style="margin-right: 5px;"></div>'+ result.comments[i].comment_name + '<a href="javascript:deleteComment('+ result.comments[i].comment_id +');" class="pull-right glyphicon glyphicon-remove" title="Изтриване на този коментар" ></a></strong> каза:<b style="float:right;">'+ result.comments[i].comment_date + '</b></div>'+ '<p>'+ result.comments[i].comment_body + '</p></div>'; 
                  }
                  
                  
              }
                 
              $('article em:first').html('Коментари('+result.total_comments+')');
             // $("html, body").animate({ scrollTop: $('#comment').offset().top }, 2000);
              $('.comments').html(comment);
                  
            });
        }
      

        function cancelEdit() {
            $('.edit_post').hide();
        }
        function editPost() {
            $('#loading').show();
            var post = $('#post').val();
            var post_id = $('#post_id').val();
            $.post('<?= site_url('admin/edit_entry'); ?>', {
                post: post,
                post_id: post_id,
                dataType: "json"
            }, function (data) {
                var result = JSON.parse(data);
                var post = '';
                if(result.err === 0){
                   for(var i in result.show_post){
                       post += result.show_post[i].entry_body;
                   }
                }else{
                   
                }
                $('.post').html(post);
                $('#loading').hide();
                $('.edit_post').hide();
                $("html, body").animate({ scrollTop: $('article').offset().top }, 2000);
            }).fail(function () {
                alert('Изглежда нещо се обърка :( . Опитай пак!');
            });

        }
        function deletePost() {
            $('.actions').show();
        }
        $('#cancelDelete').on('click', function () {
            $('.actions').hide();
        });
        $('#deletePost').on('click', function () {
            $('#loading').show();
            $.ajax({
                url: '<?= site_url('admin/delete_entry') ?>',
                type: 'POST',
                data: {
                    post_id:<?= $post_id ?>
                },
                dataType: 'text'
            }).done(function (data) {
                var json = JSON.parse(data);
                $('#loading').hide();
                alert(json);
                $('body').load('<?= site_url('blog'); ?>');
            });
        });



    </script>
<?php else: ?>


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
            <?php if ($post): ?>
                <?php foreach ($post as $p): ?>  

                    <?php $date = date_create($p->entry_date); ?>
                    <article>
                        <header>
                            <h2><?= $p->entry_name; ?></h2>   
                        </header>
                        <em  style="float:right;" class="icon icon-comments">Коментари (<?= $total_comments; ?>)</em>
                        <em style="float:right;margin-right: 1em;" class="icon icon-user"><?= $p->username; ?></em>
                        <em style="float:right;margin-right: 1em;" class="icon icon-pencil"><a href="<?= base_url('blog/category') . '/' . $p->category_id; ?>"><?= $p->category_name; ?></a></em>
                        <span  class=" icon icon-time">&nbsp;<?= date_format($date, 'l d m Y'); ?></span><hr/>
                        <?php if ($p->pic_name): ?>
                            <img src="<?= base_url() . 'uploads/' . $p->pic_name; ?>" width="600" height="400"/>
                        <?php endif; ?>
                        <div class="post"><?= $p->entry_body; ?></div>
                    <?php endforeach; ?>
                </article>
            <?php else: ?>
                <?php redirect('blog'); ?>
            <?php endif; ?>
            <section class="comments">
            <?php if ($comments): ?>
                <section>
                    <h3 id="comment">Коментари</h3><hr/>
                    <?php foreach ($comments as $comment): ?>
                        <?php $comment_date = date_create($comment->comment_date) ?>
                        <?php if ($comment->user_id == 1): ?>
                            <div class="postemeta">
                                <div>
                                    <strong style="color:red;">
                                        <div  class="glyphicon glyphicon-user " style="margin-right: 5px;"></div><?php echo ucwords($comment->comment_name); ?></strong> каза: 
                                    <b style="float:right;"><?= date_format($comment_date, 'D j F Y h:i:s'); ?></b>
                                </div>
                                <p><?php echo $comment->comment_body; ?></p>
                            </div>

                        <?php else: ?>
                            <div class="postemeta" id="comment<?= $comment->comment_id; ?>">
                                <div>
                                    <strong style="color:#0086b3;">
                                        <div  class="glyphicon glyphicon-user " style="margin-right: 5px;"></div><?php echo ucwords($comment->comment_name); ?></strong> каза: 
                                    <b style="float:right;"><?= date_format($comment_date, 'D j F Y h:i:s'); ?></b>
                                </div>
                                <p><?php echo $comment->comment_body; ?></p>

                            </div>
                        </section>
                    <?php
                    endif;
                endforeach;
            else:
                ?>
                <h4 id="comment">Все още няма коментари!</h4>
                <p style="padding:0 2em;">Напишете първият ...</p><hr/>
            <?php endif; ?><section><br/>
            <div class="err_msg"></div>
 
            <p><p  id="message" style="color:#a2d246;"><?php
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                ?></p>
            <span id="loading" style="display:none;margin:0 auto;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>
            <?php echo validation_errors(); ?>
            <?php if ($this->session->userdata('is_logged_in')): ?>
                <input type="hidden" name="commentor" id="commentor" value="<?php echo $this->session->userdata('username'); ?>" type="text" size="30" />

                <input type="hidden" name="email"  id="email" value="<?php echo $this->session->userdata('email'); ?>" type="text" size="30" /><br/>   


            <?php elseif ($this->session->userdata('admin_logged')): ?>
                <input type="hidden" name="commentor" id="commentor" value="<?php echo $this->session->userdata('name'); ?>" type="text" size="30" />

                <input type="hidden" name="email" id="email" value="<?php echo $this->session->userdata('email'); ?>" type="text" size="30" /><br/>   

            <?php else: ?>

                <label for="commentor" class="icon icon-user">Име</label><br/>
                <input  name="commentor" id="commentor" placeholder="Вашето име" type="text" size="30" /><br/>

                <label for="email"  class="icon icon icon-edit">Email</label><br/>
                <input id="email" name="email" placeholder="Вашият email" type="text" size="30" /><br/>

            <?php
            endif;
            $textarea = array(
                'class' => 'form-control',
                'id' => 'type_msg',
                'name' => 'comment',
                'rows' => 5,
                'cols' => 6,
            );
            ?>

            <label for="type_msg" class="icon icon-pencil">&nbsp;Вашият коментар</label><strong style="color:#e23b33;">(на кирилица)</strong><br/>
            <?php echo form_textarea($textarea, $this->input->post('comment')); ?>
            <br />	

            <input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>" />

            <input type="hidden" name="user_id" id="user_id" value="<?php echo (($this->session->userdata('id'))) ? $this->session->userdata('id') : ''; ?>" />

            <input class="button" type="submit" id="addComment" value="Добави коментар"/>
            <input class="button" type="reset" id="reset" value="Изчисти"/>	
            </p>		


        </div>
        <div id="lastest">
            <h2>Последно добавени </h2>

        </div>
    </div>
    <script>
    $(document).ready(function(){
       $('#addComment').on('click',function(){
            var post_id = $("#post_id").val();
        var user_id = $('#user_id').val();
        var commentor = $('#commentor').val();
        var email = $("#email").val();
        var comment = $("#type_msg").val();
        $('#loading').show();
       
        $.ajax({
            url:"<?=site_url('blog/add_comment') ?>",
            data:{
                user_id:user_id,
                post_id:post_id,
                commentor:commentor,
                email:email,
                comment:comment
            },
            type:'POST'
            
        }).done(function(data){    
          var result = JSON.parse(data);
          if(result.err === 1){
             $('.err_msg').show().html(result.error).fadeOut(5000); 
          }else{
              var comment ='';
              for(var i in result.comments){
                  
                  if(result.comments[i].user_id === '1')
                  {
                     comment += '<div class="postemeta" id="comment'+ result.comments[i].comment_id +'"><div><strong style="color:red;"><div class="glyphicon glyphicon-user" style="margin-right: 5px;"></div>'+ result.comments[i].comment_name +'</strong> каза:<b style="float:right;">'+ result.comments[i].comment_date + '</b></div>'+ '<p>'+ result.comments[i].comment_body + '</p></div>';
                  }else
                  {
                     comment += '<div class="postemeta" id="comment'+ result.comments[i].comment_id +'"><div><strong style="color:#0086b3;"><div class="glyphicon glyphicon-user" style="margin-right: 5px;"></div>'+ result.comments[i].comment_name + '</strong> каза:<b style="float:right;">'+ result.comments[i].comment_date + '</b></div>'+ '<p>'+ result.comments[i].comment_body + '</p></div>'; 
                  }                  
              }
              $('article em:first').html('Коментари('+result.total_comments+')');
              $('.err_msg').hide();
              $("html, body").animate({ scrollTop: $('.comments').offset().top }, 2000);
              $('.comments').html('<h3 id="comment">Коментари</h3>'+comment);
             
          }
          $('#loading').hide();
          $('#type_msg').val('');
        }).fail(function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
        alert(xhr.responseText);
      });
       });
       $('#reset').on('click',function(){
        $('#type_msg').val('');
       });
    });
   
</script>

<?php endif; ?>
