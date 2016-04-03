

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
                          <li class="active">
                            <i class="glyphicon glyphicon-picture"></i> Качване на файл 
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <?php echo $error; ?>
            <?php echo form_open_multipart('admin/do_upload'); ?>
            <input type="file" name="pic_file" size="20"  />
            <br/><br/>
            <input type="submit" value="Качи" class="btn btn-primary" />
            </form>

        </div>

    </div>
</div>



