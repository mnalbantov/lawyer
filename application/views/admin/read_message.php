<div id="wrapper">


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Съобщения 
                    </h1>
                    <ol class="breadcrumb">
                        <i class="active fa fa-inbox"></i> Съобщения
                        <a href="<?= base_url('admin/messages') ?>">Назад</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">


                <?php if ($message): ?>
                    <div class="col-sm-9">

                        <ul class="nav nav-tabs" id="myTab">

                            <?php
                            foreach ($message as $msg):
                                $date = date_create($msg->date_sended);
                                ?>
                            </ul>




                            <div class="" id="messages">

                                <div class="list-group">
                                    <?php if ($msg->profile_pic): ?>
                                        от <a href="<?= base_url('admin/profile') . '/' . $msg->user_id; ?>"><?= $msg->first_name . ' ' . $msg->last_name; ?></a><br/><img src="<?= base_url('uploads') . '/' . $msg->profile_pic; ?>" width="50" height="50"/>
                                    <?php else: ?>
                                        <a href="<?= base_url('admin/profile') . '/' . $msg->user_id; ?>"><?= $msg->first_name . ' ' . $msg->last_name; ?></a><br/><img src="<?= base_url('uploads') . '/std_prof_pic.png'; ?>" width="50" height="50"/>

                                    <?php endif; ?>
                                    <h4><?= $msg->subject; ?></h4>
                                    <p><?= $msg->message; ?></p>
                                    <span class="name" style="min-width: 120px;display: inline-block;"></span> <span class=""></span>

                                    </span></span></a></b>

                                    <li><?= date_format($date, 'm:i:s D d/m/Y '); ?></li>
                                </div>
                                <div class="alert" style="display:none;"></div>
                                <div id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></div>
                                <form action="javascript:replyPM();" method="post" class="form-group" role="form">
                                    <?php echo validation_errors(); ?>
                                    <textarea id="msgReply" class="form-control"  placeholder="Отговорете на <?= $msg->first_name; ?>"></textarea><br/>
                                    <input type="hidden"  id="from_id" value="<?= $this->session->userdata('id'); ?>"/>
                                    <input type="hidden" name="sender_name" id="sender_name" value="<?= $this->session->userdata('first_name'); ?>" />
                                    <input type="hidden" id="inputTo" name="userTo" value="<?= $msg->user_id; ?>"/>
                                    <input type="hidden" name="subject" id="subject" value="<?= $msg->subject; ?>" />
                                    <input type="hidden" id="reciever_name"  value="<?= $msg->first_name; ?>"/>
                                    <input type="hidden" id="reciever_email"  value="<?= $msg->email; ?>"/>
                                    <input type="submit" name="replyMsg" id="replyMsg" class="btn btn-info" value="Отговор" />
                                </form>



                            </div><!--/tab-pane-->

                        </div><!--/tab-content-->

                    </div><!--/col-9-->
                </div>
            </div>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <p>Няма нищо за показване</p>
<?php endif; ?>
<script>

        $('#replyMsg').click(function () {
            var toUser = $('#inputTo');
            var subject = $('#subject');
            var message = $('#msgReply');
            var senderName = $('#sender_name');
            var recieverName = $('#reciever_name');
            var recivierEmail = $('#reciever_email');
            if (message.val() === '') {
                $('#loading').show();
                $('.alert').html('<p class="alert alert-danger">Не може да изпратите празно съобщение</p>').show().fadeOut(5000);
                $('#loading').hide();
            } else {
                $('#loading').show();
                $("input[type='submit']").attr('disabled', 'disabled');
                $.post('<?= base_url('admin/reply_message') ?>', {toUserId: toUser.val(), subjectPM: subject.val(), messagePM: message.val(), senderName: senderName.val(), recName: recieverName.val(), recEmail: recivierEmail.val()},
                function (data) {
                    $('#messages').html(data);
                    $('#loading').hide();
                }).fail(function () {
                    $('#messages').html('Нещо се обърка :( Опитай пак!').show();
                });
            }
        });

</script>