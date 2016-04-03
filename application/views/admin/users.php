

<div id="wrapper">

    

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Списък с потребители
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?= base_url('admin/index') ?>">Главно табло</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Потребители
                        </li>
                    </ol>
                </div>  
            </div>
            <!-- /.row -->
           
            <label>Общо:</label><span class="glyphicon glyphicon-user"><?php echo $total_rows; ?></span>
            <div class="row">
                <a href="<?= base_url('admin/create_user');?>" class="btn btn-success" >Добави</a>
                <span>Сортирай по:</span>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                               
                                <th><a href="<?= base_url()?>admin/users/first_name/<?= (($sort_order == 'desc') ? 'asc' : 'desc'); ?>">Име </a></th>
                                <th><a href="<?= base_url()?>admin/users/last_name/<?= (($sort_order == 'desc') ? 'asc' : 'desc'); ?>">Фамилия</a></th>
                                <th><a href="<?= base_url()?>admin/users/username/<?= (($sort_order == 'desc') ? 'asc' : 'desc'); ?>">Потребителско име</a></th>
                                <th><a href="<?= base_url()?>admin/users/email/<?= (($sort_order == 'desc') ? 'asc' : 'desc'); ?>">Адрес</a></th>
                                <th><a href="<?= base_url()?>admin/users/phone/<?= (($sort_order == 'desc') ? 'asc' : 'desc'); ?>">Телефон</a></th>
                                <th><a href="<?= base_url()?>admin/users/created_on/<?= (($sort_order == 'desc') ? 'asc' : 'desc'); ?>">Дата на регистрация</a></th>
                                <th>Настройки</th>

                            </tr>
                        </thead>
                        <?php foreach ($users as $user): ?>
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
                                    <?php endif; 
                                    ?>
                                        <td><?= $user->created_on; ?></td>
                                    <td>
                                        <a class="btn btn-primary glyphicon glyphicon-search" href="<?= base_url('admin/profile') . '/' . $user->user_id; ?>">Виж</a> 
                                        <a class="btn btn-success glyphicon glyphicon-edit" href="<?= base_url('admin/profile_edit'). '/' . $user->user_id; ?>">Обнови</a> 
                                        <a class="btn btn-danger glyphicon glyphicon-trash" href="<?= base_url('admin/delete_user'). '/' . $user->user_id; ?>">Изтрий</a> 
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                    <div id="pagination">
                        <?= $links; ?>
                    </div>
                    
                </div>

