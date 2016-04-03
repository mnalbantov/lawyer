
<nav id="menu" class="navbar">
    <ul class="nav navbar-right top-nav">
        <li><a href="<?= base_url(); ?>" accesskey="1" title="">Начало</a></li>
        <li class="current_page_item"><a href="<?= base_url(); ?>members" accesskey="1" title="">Профил</a></li>
        <li><a href="<?= base_url(); ?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url(); ?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <li><a href="<?= site_url(); ?>members/logout" accesskey="6" title="">Изход</a></li>
    </ul>
</nav>

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

           


            <ul class="list-group">
                <li class="list-group-item text-muted">Активност <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Коментари</strong></span><?php if (count($posts)): echo count($posts);
                else: echo 0;
                endif; ?></li>
            </ul> 

          

        </div><!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="<?= base_url('members'); ?>">Личен профил</a></li>
                <?php if ($messages): ?>
                    <li><a href="<?= base_url('members/messages'); ?>">Съобщения<b>(<?php echo count($messages); ?> )</b></a></li>
                <?php else: ?>
                    <li><a href="<?= base_url('members/messages'); ?>">Съобщения</a></li>
<?php endif; ?>
                <li><a href="<?= base_url('members/settings'); ?>">Настройки</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">


                </div><!--/table-resp-->

                <hr>

                <h4>Последна активност</h4>

                        <?php if ($activity): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                                    <?php foreach ($activity as $last): ?>
                                <tbody>
                                    <tr>
        <?php if ($last->comment_id):
            $date = date_create($last->comment_date);
            ?>
                                            <td><i class="pull-right fa fa-edit"><?php echo date_format($date, 'l d m Y'); ?></i>добавихте <a href="<?= base_url('blog/post') . '/' . $last->entry_id . '#comment'; ?>">коментар</a> към статия <a href="<?= base_url('blog/post') . '/' . $last->entry_id; ?>"><?php echo $last->entry_name; ?></a></td>
                                        </tr>
                            <?php endif;
                        endforeach; ?>
                            </tbody>
                        </table>

<?php else: ?>
                        <p>Все още нямате активност в сайта</p>
<?php endif; ?>

                </div>

            </div><!--/tab-pane-->



        </div><!--/tab-pane-->
    </div><!--/tab-content-->
    <!-- /.modal compose message -->
    <div class="modal fade" id="changePic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Обновяване на профилната снимка</h4>


                </div>
                <div class="modal-body">
                    <form id="changePic" role="form" enctype="multipart/form-data" class="form-horizontal" method="post" action="javascript:change_pic();">
                        <div class="form-group">

                            <div class="col-sm-10">
                                <?php if ($this->session->userdata('profile_pic')): ?>
                                    <img src="<?= base_url('uploads') . '/' . $this->session->userdata('profile_pic'); ?>" width="550" height="400"/>
<?php else: ?>
                                    <img src="<?= base_url('uploads') . '/std_prof_pic.png' ?>"/>
<?php endif; ?>
                            </div>

                        </div>
                        <div id="profile_picture">
                            <input type="file" name="upload_pic" id="pic" />
                        </div>

                        <div class="modal-footer">
                            <p class="alert"></p>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отказ</button>
                            <input type="submit"  class="btn btn-primary" value="Качи" />

                        </div>

                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal compose message -->
    <script>

        $(document).ready(function(){
             $('#profile_pic').click(function () {
            $('#changePic').modal('show');

        });
        });
    </script>
</div>
</div><!--/col-9-->


