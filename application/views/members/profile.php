
<div id="menu">
    <ul>
        <li><a href="<?= base_url(); ?>pages" accesskey="1" title="">Начало</a></li>
        <li><a href="<?= base_url(); ?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url(); ?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <li><a href="<?= base_url(); ?>members/logout" accesskey="6" title="">Изход</a></li>
    </ul>
</div>
</div>
</div>
<hr>
<?php if ($details): ?>
    <?php foreach ($details as $detail): ?>
        <div class="container">

            <div class="row">

                <?php if ($detail->profile_pic): ?>
                    <div class="col-sm-10"><img title="profile image" id="profile_pic" class="img-thumbnail img-responsive" src="<?= base_url('uploads/thumbs') . '/' . $detail->profile_pic; ?>" width="210" height="150"></a></div><br/>

                <?php else: ?>
                    <div class="col-sm-10"><img title="profile image" id="profile_pic" class="img-circle img-responsive" src="<?= base_url('uploads/') . '/std_prof_pic.png' ?>" width="200" height="150"></a></div>
                <?php endif; ?>
                <div class="col-sm-10"><h1>Профил на <strong><?= $detail->first_name; ?></strong></h1></div>

            </div><br/>
            <div class="row">
                <div class="col-sm-3"><!--left col-->

                    <ul class="list-group">
                        <li class="list-group-item text-muted">Профил</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Име</strong></span><?= $detail->first_name;?></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Фамилия</strong></span><?= $detail->last_name;?></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Потребителско име</strong></span><?= $detail->username;?></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong> Email адрес</strong></span><?= $detail->email;?></li>
                        <?php if(count($comments)): ?>
                        <li class="list-group-item text-right"><span class="pull-left"><strong> Коментари</strong></span><?= count($comments);?></li>
                        <?php else:?>
                        <li class="list-group-item text-right"><span class="pull-left"><strong> Коментари</strong></span>0</li>
                        <?php endif;?>
                    </ul> 
                    
                </div><!--/col-3-->
               
                <div class="col-sm-9">

                    <ul class="nav nav-tabs" id="myTab">
                        <button  id="btn" class="btn btn-primary">Изпрати съобщение</button>
                    </ul>
                    <hr>
                </div><!--/tab-pane-->
            </div><!--/tab-pane-->
        </div><!--/tab-content-->

        </div><!--/col-9-->
        <!-- /.modal compose message -->
        <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Изпрати съобщение на <?= $detail->first_name; ?></h4>
                    </div>
                    <div class="modal-body">
                        <form id="sendPM" role="form" class="form-horizontal" method="post" action="javascript:sendPM();">
                            <input type="hidden" id="inputTo" name="userTo" value="<?= $detail->user_id; ?>"/>
                            <input type="hidden" id="reciever_name"  value="<?= $detail->first_name; ?>"/>
                            <input type="hidden" id="reciever_email"  value="<?= $detail->email; ?>"/>
                            <div class="form-group">
                                <label class="col-sm-2" for="inputSubject">Заглавие</label>
                                <div class="col-sm-10"><input type="text" class="form-control" id="subject" name="subject"  placeholder="Заглавие на темата"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="inputBody">Съобщение</label>
                                <div class="col-sm-12"><textarea class="form-control" id="inputBody" name="message" rows="18"></textarea></div>
                                <input type="hidden" name="from_id" id="from_id" value="<?= $this->session->userdata('id'); ?>"/>
                                <input type="hidden" name="sender_name" id="sender_name" value="<?= $this->session->userdata('first_name'); ?>"     
                            </div>
                            <div id="foooter" class="modal-footer">

                                <span id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>
                                <p class="alert"></p>
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отказ</button>
                                <input type="submit" class="btn btn-primary" value="Изпрати" />

                            </div>

                        </form>
                    </div>

                </div>  
            </div> 
        </div>  
        </div>


        <div class="modal fade" id="image-gallery" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">×</button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">

                        <div id="modalCarousel" class="carousel">
                            <?php if ($detail->profile_pic): ?>
                                <img title="profile image" id="profile_pic" class="img-thumbnail img-responsive" src="<?= base_url('uploads') . '/' . $detail->profile_pic; ?>" width="650" height="400"><br/>

                            <?php else: ?>
                                <img title="profile image" id="profile_pic" class="img-circle img-responsive" src="<?= base_url('uploads/std_prof_pic.png') ?>" width="250" height="250"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <script>

            function sendPM() {
                var toUser = $("#inputTo");
                var subject = $('#subject');
                var message = $('#inputBody');
                var senderId = $('#from_id');
                var senderName = $('#sender_name');
                var recieverName = $('#reciever_name');
                var recivierEmail = $('#reciever_email');
                if (subject.val() === '') {
                    $('.alert').html('<p class="alert alert-danger">Изберете заглавие!</p>').show().fadeOut(6000);
                }
                else if (message.val() === '') {
                    $('.alert').html('<p class="alert alert-danger">Не сте въвели съобщение!</p>').show().fadeOut(6000);
                }
                else {
                    $('#loading').show();
                    $.post('<?= base_url('members/send_message') ?>', {subjectPM: subject.val(), messagePM: message.val(), toUserId: toUser.val(), senderId: senderId.val(), senderName: senderName.val(), recName: recieverName.val(), recEmail: recivierEmail.val()},
                    function (data) {
                        $('.alert').html(data).fadeOut(5000);
                        $('#subject').val('');
                        $('#inputBody').val('');
                        $('#loading').hide();
                    }
                    ).fail(function () {
                        $('#loading').show();
                        $('.alert').html('<p>Нещо май сгафихме :( Отпусни се,изпий един чай и опитай отново.</p>');
                        $('#loading').hide();
                    });

                }


            }
        </script>
        <?php
    endforeach;
else:
    redirect('members');
    endif;
