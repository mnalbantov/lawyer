

<div id="wrapper">

    

    <div id="page-wrapper">

        <div class="container-fluid">
                <?php if($profile): ?>
                <?php foreach ($profile as $user):?>
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">

                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?= base_url('admin/index'); ?>">Главно табло</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Изтриване на потребител - <?= $user->username;?>
                        </li>
                    </ol>
                </div>
            </div>
            <?php endforeach;?>

            <!-- /.row -->
            <div class="row">
                <?php echo form_open('admin/confirm_delete/'.'/'.$profile_id);?>
                <h2 class="alert alert-danger">Сигурни ли сте,че искате да изтриете този потребител?</h2>
                <input type="submit" name="" value="ДА" class="btn btn-danger" />
                <a href="<?= base_url('admin/users'); ?>" class="btn btn-default">Не</a>
                </form>
            </div>
            <?php 
                else:redirect('admin/users');
            endif;?>


        </div>

    </div>

</div>
</div>

