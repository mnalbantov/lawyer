<div id="wrapper">

   
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Качване на файл
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?= base_url('admin/index'); ?>">Главно табло</a>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-picture"></i> <a href="<?= base_url('admin/gallery'); ?>">Галерия</a>
                        </li>
                          <li>
                            <i class="glyphicon glyphicon-upload"></i><a href="<?= base_url('admin/upload'); ?>">Качи друг файл</a>
                        </li>
                        <li class="active">
                            <i class="glyphicon glyphicon-file"></i> Успешно качен файл
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
        <?php if($img): ?>
            <div>
                <p class="alert alert-info">Успешно качен файл</p>
        <img  src="<?= $img; ?>" />
            </div>
        <?php else:?>
        <?php echo 'Нещо се обърка :( Опитай пак';endif;?>
       </div>

    </div>
</div>

    

