<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/gallery.css"/>
<div id="wrapper">


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Галерия
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?= base_url('admin/index'); ?>">Главно табло</a>
                        </li>
                        <li class="active">
                            <i class="glyphicon glyphicon-picture"></i> Галерия
                        </li>
                    </ol>
                </div>
            </div>
            <a href="<?= base_url('admin/upload'); ?>" class="btn btn-info">Качи файл</a>
            <a href="<?= base_url('admin/upload'); ?>" class="btn btn-info">Качи </a>
            <!-- /.row -->

            <?php if ($images && count($images)): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Вашите качени снимки</h1>
                    </div>
                    <?php foreach ($images as $image): ?>

                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <a class="thumbnail" href="#" data-image-id="<?=$image->pic_id; ?>" data-toggle="modal" data-title="<?=$image->pic_name; ?>" data-image="<?=base_url('uploads').'/'.$image->pic_name; ?>" data-target="#image-gallery">
                                <img class="img-responsive" src="<?= base_url('uploads/thumbs') . '/' . $image->pic_name; ?>" alt="Изображение">
                            </a>
                        </div>

                    <?php endforeach; ?>

                <?php else: ?>
                    <h2>Вашата галерия е празна!<br/><a href="<?= base_url('admin/upload') ?>">Качете снимки сега</a></h2><br/>
                <?php endif; ?>
            </div>

            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="image-gallery-title"></h4>
                        </div>
                        <div class="modal-body">
                            <img id="image-gallery-image" class="img-responsive" src=""/>
                        </div>
                        <div class="modal-footer">
                            
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="show-previous-image">Назад</button>
                                
                            </div>

                            <div class="col-md-8 text-justify" id="image-gallery-caption">
                            </div>

                            <div class="col-md-2">
                                <button type="button" id="show-next-image" class="btn btn-default">Напред</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {

            loadGallery(true, 'a.thumbnail');

            //This function disables buttons when needed
            function disableButtons(counter_max, counter_current) {
                $('#show-previous-image, #show-next-image').show();
                if (counter_max == counter_current) {
                    $('#show-next-image').hide();
                } else if (counter_current == 1) {
                    $('#show-previous-image').hide();
                }
            }

            /**
             *
             * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
             * @param setClickAttr  Sets the attribute for the click handler.
             */

            function loadGallery(setIDs, setClickAttr) {
                var current_image,
                        selector,
                        counter = 0;

                $('#show-next-image, #show-previous-image').click(function () {
                    if ($(this).attr('id') == 'show-previous-image') {
                        current_image--;
                    } else {
                        current_image++;
                    }

                    selector = $('[data-image-id="' + current_image + '"]');
                    updateGallery(selector);
                });

                function updateGallery(selector) {
                    var $sel = selector;
                    current_image = $sel.data('image-id');
                    $('#image-gallery-caption').text($sel.data('caption'));
                    $('#image-gallery-title').text($sel.data('title'));
                    $('#image-gallery-image').attr('src', $sel.data('image'));
                    disableButtons(counter, $sel.data('image-id'));
                }

                if (setIDs == true) {
                    $('[data-image-id]').each(function () {
                        counter++;
                        $(this).attr('data-image-id', counter);
                    });
                }
                $(setClickAttr).on('click', function () {
                    updateGallery($(this));
                });
            }
        });
    </script>





