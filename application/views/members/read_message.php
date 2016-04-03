
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

          

        </div><!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
                <?php if ($message): ?>
                    <?php
                    foreach ($message as $msg):
                        $date = date_create($msg->date_sended);
                        ?>

                        <div class="tab-content">

                            <br/>

                            <span class="alert" ></span>


                        </div><!--/tab-pane-->

                        <a href="<?= base_url('members/messages') ?>">Назад</a>
                        <div class="tab-pane" id="messages">
                            <ul class="list-group">
                                <?php if ($msg->profile_pic): ?>
                                    от <a href="<?= base_url('members/profile') . '/' . $msg->user_id; ?>"><?= $msg->first_name . ' ' . $msg->last_name; ?></a><br/><img src="<?= base_url('uploads/thumbs') . '/' . $msg->profile_pic; ?>" width="50" height="50"/>
        <?php else: ?>
                                    <a href="<?= base_url('members/profile') . '/' . $msg->user_id; ?>"><?= $msg->first_name . ' ' . $msg->last_name; ?></a><br/><img src="<?= base_url('uploads/') . '/std_prof_pic.png'; ?>" width="50" height="50"/>
                                    
        <?php endif; ?>
                                    <h4><?= $msg->subject; ?></h4>
                                <li class="list-group item"><?= $msg->message; ?></li>
                                <li class="list-group item"><?= date_format($date, 'm:i:s D d/m/Y '); ?></li>

                               

                            </ul>
                            
                            <form action="javascript:replyPM();" method="post" class="form-group" role="form">
                                 <?php echo validation_errors(); ?>
                                <textarea id="msgReply" class="form-control"  placeholder="Отговорете на <?= $msg->first_name; ?>"></textarea><br/>
                                <input type="hidden"  id="from_id" value="<?= $this->session->userdata('id'); ?>"/>
                                <input type="hidden" name="sender_name" id="sender_name" value="<?= $this->session->userdata('first_name'); ?>" />
                                <input type="hidden" id="inputTo" name="userTo" value="<?= $msg->user_id; ?>"/>
                                <input type="hidden" name="subject" id="subject" value="<?=$msg->subject; ?>" />
                                <input type="hidden" id="reciever_name"  value="<?= $msg->first_name; ?>"/>
                                <input type="hidden" id="reciever_email"  value="<?= $msg->email; ?>"/>
                                <input type="submit" name="replyMsg" id="replyMsg" class="btn btn-info" value="Отговор" />
                            </form>
                                <span id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>


                        </div><!--/tab-pane-->

                </div><!--/tab-content-->

            </div><!--/col-9-->
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Няма нищо за показване</p>
<?php endif; ?>
<script>
        var toUser = $('#inputTo');
        var subject = $('#subject');
        var message = $('#msgReply');
        var senderName = $('#sender_name');
        var recieverName = $('#reciever_name');
        var recivierEmail = $('#reciever_email');
        $('#replyMsg').click(function () {

            if (message.val() === '') {
                $('.alert').html('<p class="alert alert-danger">Не може да изпратите празно съобщение</p>').show().fadeOut(3000);
            } else {
                 $('#loading').show();
                $("input[type='submit']").attr('disabled', 'disabled');
                $.post('<?= base_url('members/reply_message') ?>', {toUserId: toUser.val(), subjectPM: subject.val(), messagePM: message.val(), senderName: senderName.val(), recName: recieverName.val(), recEmail: recivierEmail.val()},
                function (data) {
                    $('#messages').html(data); 
                    $('#loading').hide();
                });
            }
        });
 
</script>


