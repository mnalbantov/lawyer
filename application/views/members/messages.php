
<div id="menu">
    <ul>
        <li class="current_page_item"><a href="<?= base_url(); ?>members" accesskey="1" title="">Профил</a></li>
        <li><a href="<?= base_url(); ?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url(); ?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <li><a href="<?= base_url(); ?>members/logout" accesskey="6" title="">Изход</a></li>
    </ul>
</div>
</div>
</div>
<hr>

<div class="container">
    <div class="row">
        <div class="col-sm-10"><h1>Здравей&nbsp;<strong><?= $this->session->userdata('first_name'); ?></strong></h1></div>
        <?php if ($this->session->userdata('profile_pic')): ?>
            <div class="col-sm-2"><a style="cursor: pointer;" id="profile_pic" class="pull-right"><img title="Промени профилната си снимка" class="img-thumbnail img-responsive" src="<?= base_url('uploads/thumbs') . '/' . $this->session->userdata('profile_pic'); ?>" width="126" height="126"></a></div>

        <?php else: ?>
            <div class="col-sm-2"><a style="cursor: pointer;" id="profile_pic" class="pull-right"><img title="Промени профилната си снимка" class="img-circle img-responsive" src="<?= base_url('uploads') . '/std_prof_pic.png' ?>" width="126" height="126"></a></div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted">Профил</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Име</strong></span><?= $this->session->userdata('first_name'); ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Фамилия</strong></span><?= $this->session->userdata('last_name'); ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Потребителско име</strong></span><?= $this->session->userdata('username'); ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong> Email адрес</strong></span><?= $this->session->userdata('email'); ?></li>


                <?php if ($this->session->userdata('phone')): ?>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Телефон</strong></span><?= $this->session->userdata('phone'); ?></li>
                <?php else: ?>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Телефон</strong></span>Не е въведен</li>
                <?php endif; ?>

                <?php if ($this->session->userdata('company')): ?>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Компания</strong></span><?= $this->session->userdata('company'); ?></li>
                <?php else: ?>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Компания</strong></span>Не е въведен</li>
                <?php endif; ?>

                <?php if ($this->session->userdata('address')): ?>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Адрес</strong></span><?= $this->session->userdata('address'); ?></li>
                <?php else: ?>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Адрес</strong></span>Не е въведен</li>
                <?php endif; ?>


            </ul> 

            <div class="panel panel-default">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                <div class="panel-body"><a href="http://bootply.com">bootply.com</a></div>
            </div>


            <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
            </ul> 

            <div class="panel panel-default">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
                    <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                </div>
            </div>

        </div><!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
                <li><a href="<?= base_url('members'); ?>">Личен профил</a></li>
                <?php if ($messages): ?>
                    <li class="active"><a href="<?= base_url('members/messages'); ?>">Съобщения(<?php echo count($messages); ?> )</a></li>
                <?php else: ?>
                    <li class="active"><a href="<?= base_url('members/messages'); ?>">Съобщения</a></li>
                <?php endif; ?>
                <li><a href="<?= base_url('members/settings'); ?>">Настройки</a></li>
            </ul>

            <div class="tab-content">

                <br/>

 <?php if ($messages):
                    ?>
                    <strong> Непрочетени (<?php echo count($messages); ?> )</strong>&nbsp;
                <?php else: ?>
                    <a style="cursor:pointer" onclick="loadNew()"> Непрочетени ()</a>&nbsp;
                <?php endif; ?>
                    <a style="cursor:pointer;" onclick="loadPM()">Прочетени</a>
                <hr>


            </div><!--/tab-pane-->

            <div class="tab-pane" id="messages">
               


                <?php if ($messages):
                    ?>
                    <form action="javascript:readPM();" method="POST">

                        <ul class="list-group">

    <?php
    foreach ($messages as $key => $message):
        if ($message->profile_pic):
            ?>
                                    <li class="list-group-item text-right"><input type="checkbox" class="pull-left" value="<?= $message->id; ?>"/>от<a style="cursor:pointer"  href="<?php echo base_url('members/read_message').'/'. $message->id; ?>" class="pull-left message" ><?= $message->subject; ?></a>&nbsp;<a href="<?= base_url('members/profile') . '/' . $message->user_id; ?>"><?= $message->first_name; ?></a></li>
                                <?php else: ?>
                                    <li class="list-group-item text-right"><input type="checkbox" class="pull-left" value="<?= $message->id; ?>"/>от<a style="cursor:pointer"  href="<?php echo base_url('members/read_message').'/'. $message->id; ?>" class="pull-left message" ><?= $message->subject; ?></a>&nbsp;<a href="<?= base_url('members/profile') . '/' . $message->user_id; ?>"><?= $message->first_name; ?></a></li>
                                <?php endif; ?>
                            </ul> 
                        </form>
                    <?php endforeach;
                else: ?>
                    <p>Нямате нови съобщения</p>

                <?php endif; ?>
                <div id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></div>
            </div><!--/tab-pane-->


        </div><!--/tab-pane-->
    </div><!--/tab-content-->

</div><!--/col-9-->


<!-- /.modal compose message -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Изпрати съобщение</h4>


            </div>
            <div class="modal-body">
                <form id="sendPM" role="form" class="form-horizontal" method="post" action="javascript:sendPM();">
                    <div class="form-group">
                        <label class="col-sm-2" for="inputTo">До</label>
                        <div class="col-sm-10"><input type="text" class="form-control" id="inputTo" name="to" placeholder="Име на потребител"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="inputSubject">Заглавие</label>
                        <div class="col-sm-10"><input type="text" class="form-control" id="subject" name="subject" id="inputSubject" placeholder="Заглавие на темата"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="inputBody">Съобщение</label>
                        <div class="col-sm-12"><textarea class="form-control" id="inputBody" name="message" rows="18"></textarea></div>
                        <input type="hidden" name="from_id" id="from_id" value="<?= $this->session->userdata('id'); ?>"/>
                        <input type="hidden" name="sender_name" id="sender_name" value="<?= $this->session->userdata('first_name'); ?>"     
                    </div>
                    <div class="modal-footer">
                        <p class="alert"></p>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отказ</button>
                        <input type="submit" class="btn btn-primary" value="Изпрати" />

                    </div>

                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal compose message -->

</div>
<script>
    function readPM(msgID) {
        $.post('<?= base_url('members/read_message') ?>', {id: msgID},
        function (data) {
            $('#loading').show();
            $('.col-sm-9').html(data);
            $('#loading').hide();
        }
        );
    }
    function loadPM() {
        $.ajax({
            url:'<?=base_url('members/viewed_messages'); ?>'
        }).done(function(data){
            $('#loading').show();
            $('#messages').html(data);
            $('#loading').hide();
        }).fail(function() {
           $('#messages').html('Нещо се обърка :( ');
     });
    }
    function loadNew() {
    $.ajax({
            url:'<?=base_url('members/messages'); ?>'
        }).done(function(data){
            $('#loading').show();
            $('body').html(data);
            $('#loading').hide();
        }).fail(function() {
           $('#messages').html('Нещо се обърка :( ');
     });
    }
      
    
       
</script>


