<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $title; ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?= base_url(); ?>assets/css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <script src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/typeahead.min.js"></script>    

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url('admin') ?>">Администраторски панел</a>
            </div>
            <!-- Top Menu Items -->
            <a href="<?= site_url(); ?>" class="nav navbar-brand">Към сайта</a>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <?php if ($messages): ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-envelope" ></i> <?= count($messages); ?> <b class="caret"></b></a>
                    <?php else: ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <?php endif; ?>
                    <?php if ($messages): ?>

                        <ul class="dropdown-menu message-dropdown">
                            <?php foreach ($messages as $msg): ?>
                                <li class="message-preview">
                                    <a href="<?= base_url('admin/read_message') . '/' . $msg->id; ?>">
                                        <div class="media">
                                            <span class="pull-left">
                                                <?php if (!$msg->profile_pic): ?>
                                                    <img class="media-object" src="<?= base_url('uploads') . '/std_prof_pic.png' ?>" width="50" height="50" alt="">
                                                <?php else: ?>
                                                    <img class="media-object" src="<?= base_url('uploads/thumbs') . '/' . $msg->profile_pic; ?>" width="50" heigt="50" alt="">
                                                <?php endif; ?>
                                            </span>
                                            <div class="media-body">
                                                <h5 class="media-heading"><strong><?= $msg->first_name . ' ' . $msg->last_name; ?></strong>
                                                </h5>
                                                <?php $date = date_create($msg->date_sended); ?>

                                                <p class="small text-muted"><i class="fa fa-clock-o"></i><?= date_format($date, "F j, Y h:m"); ?> </p>
                                                <?php
                                                if (mb_strlen($msg->message) > 80) {
                                                    $textCut = substr($msg->message, 0, 80);
                                                    $msg->message = substr($textCut, strpos($textCut, ' '));
                                                    ?>
                                                    <p><?= $msg->message; ?>...</p>
                                                <?php } else {
                                                    ?>
                                                    <p><?= $msg->message; ?></p>
                                                <?php } ?>


                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>

                            <li class="message-footer">
                                <a href="<?= base_url('admin/messages') ?>">Прочети всички съобщения</a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="dropdown-menu message-dropdown">
                            <li class="message-preview"><a href="#">Нямате нови съобщения</a></li>
                            <li class="message-footer">
                                <a href="<?= base_url('admin/messages') ?>">Към съобщения</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $this->session->userdata('first_name'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i>Профил</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i>Вх.кутия</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Настройки</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= base_url(); ?>admin/logout"><i class="fa fa-fw fa-power-off"></i>Изход</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="dashboard">
                        <a href="<?= base_url(); ?>admin/index"><i class="fa fa-fw fa-dashboard"></i> Табло</a>
                    </li>
                    <li id="diagrami">
                        <a href="<?= base_url(); ?>admin/messages"><i class="fa fa-fw fa-pencil"></i> Съобщеия</a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>admin/users"><i class="fa fa-fw fa-table"></i> Потребители</a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>admin/posts"><i class="fa fa-fw fa-edit"></i> Публикации</a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>admin/gallery"><i class="fa fa-fw fa-desktop"></i>Галерия</a>
                    </li>  
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
