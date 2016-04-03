

<div id="wrapper">

 
    <?php if ($profile): ?> 
        <?php foreach ($profile as $user): ?>
            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Профил на <?php echo $user->username; ?>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="<?= base_url('admin/index'); ?>">Главно табло</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-table"></i> Профил
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">

                        <h2>Информация</h2>
                        <a href="<?= base_url('admin/profile_edit') . '/' . $user->user_id; ?>" class="btn btn-info">Редактирай</a>
                        <a href="<?= base_url('admin/delete_user') . '/' . $user->user_id; ?>" class="btn btn-danger">Изтрий</a>
                        <div class="table-responsive"><br/>
                            <?php if($user->profile_pic):?>
                            <div><a href="#" id="user_pic"><img src="<?= base_url() . 'uploads/thumbs/' . $user->profile_pic; ?>" alt="Няма профилна снимка"/></a></div>
                            <?php else:?>
                             <div><a href="#" id="user_pic"><img src="<?= base_url() . 'uploads/std_prof_pic.png'; ?>" alt="Няма профилна снимка"/></a></div>
                            <?php endif;?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Име </th>
                                        <th>Фамилия</th>
                                        <th>Потребителско име</th>
                                        <th>Адрес</th>
                                        <th>Телефон</th>
                                        <th>Дата на регистрация</th>
                                        <th>Тип на профил</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><?= $user->first_name; ?></td>
                                        <td><?= $user->last_name; ?></td>
                                        <td><?= $user->username; ?></td>
                                        <td><?= $user->email; ?></td>
                                        <?php if (!$user->phone): ?>
                                            <td>Не е въведен</td>
                                        <?php else: ?>
                                            <td><?= $user->phone; ?></td>
                                        <?php endif; ?>
                                        <td><?= $user->created_on; ?></td>
                                        <td><?= $user->type; ?></td>

                                    </tr>
                                </tbody>

                            <?php
                            endforeach;
                        else:redirect('admin/users');
                        endif;
                        ?>
                    </table>
                    <h2>Последна активност в блога</h2>
<?php if ($last_activity): ?>
                        <table class="table table-bordered table-hover table-responsive">
                            <thead>
                            <th>Коментар</th>
                            <th>Публикация</th>
                            <th>Дата на публикуване</th>
                            </thead>
                            <tbody>

    <?php foreach ($last_activity as $last): ?>
                                    <tr>
                                        <td><?= $last->comment_body; ?></td>
                                        <td><a href="<?= base_url('blog/post/') . '/' . $last->entry_id; ?>"><?= $last->entry_name; ?>"</a></td>
                                        <td><?= $last->comment_date; ?></td>
                                    </tr>

    <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php else: ?>
                        <h3>Този потребител все още няма активност.</h3>
<?php endif; ?>
                    <a href="<?= base_url('admin/users'); ?>" class="btn btn-default">Назад </a>
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
                                    <?php if ($user->profile_pic): ?>
                                        <img title="profile image" id="profile_pic" class="img-thumbnail img-responsive" src="<?= base_url('uploads/') . '/' . $user->profile_pic; ?>" width="650" height="400"><br/>

                                    <?php else: ?>
                                        <img title="profile image" id="profile_pic" class="img-circle img-responsive" src="<?= base_url('uploads/') . '/std_prof_pic.png' ?>" width="250" height="250"></a>
<?php endif; ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal">Затвори</button>
                            </div>
                        </div>
                    </div>
                </div>
                        <script>
                                $("#user_pic").click(function(){
                                $('#image-gallery').modal('show');
                                });
                            </script>
                