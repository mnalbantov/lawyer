
<div id="wrapper">

   
    <div id="page-wrapper">

        <div class="container-fluid">
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="page-header">
                        Добави публикация
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?= base_url(); ?>admin/welcome/">Табло</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> Публикации
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

                   
                        <?php echo form_open('admin/add_new_entry'); ?>
                      
                    <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
                        <div class="form-group">
                           <?=validation_errors('<div class="alert alert-danger">','</div>');?>
                            <label>Заглавие</label>
                              <p class="help-block">Избери заглавие на публикацията.</p>
                            <input class="form-control" type="text" name="entry_name"/>        
                            </p>
                            <label for="category">Категория</label><br/>
                            <p class="help-block">Избери категория на публикацията.</p>
                           <p><select id="category" name="category" class="form-control"> 
                           <?php foreach($categories as $category):?>
                           
                               <option value="<?= $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                              
                           <?php endforeach;?>
                               </select></p>
                               <a href="#" id="choose_img">Избери заглавна снимка</a><br/>
                            <label>Публикация</label><br />
                            
                           <textarea name="entry_body" class="ckeditor" rows="10" cols="80" style="resize:none;"></textarea><br/>
                          
                           
                          
                        </div>
                         
            </div>

            <div class="modal fade" id="img_gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="image-gallery-title"></h4>
                        </div>   
                        <div class="modal-body">
                            
                
                  
                    <?php if ($images && count($images)): ?>
 
                            <?php foreach ($images as $image): ?>
                            <div class="col-md-4">
                            <label for="<?=$image->pic_id; ?>"><img class="img-rounded col-md-8" src="<?=  base_url('uploads/').'/'.$image->pic_name;?>"</label>
                            <input type="radio" class="checkbox" name="pic_id" id="<?=$image->pic_id; ?>" value="<?=$image->pic_id; ?>" />
                            </a>
                            </div>
                            <?php endforeach; ?>
                               <?php endif; ?>
                            
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-8 text-justify" id="image-gallery-caption">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
             <input type="submit" name="add_entry" class="btn btn-primary" value="Публикувай" />
              <?php echo form_close(); ?>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
         <div class="row">
                  <div class="col-lg-6">
                    <h1>Добави категория</h1>
                        
                    <form role="form" action="<?= base_url('admin/add_new_category'); ?>" method="post">
                        
                        <fieldset>
                            
                            <div class="form-group">
                                <label for="add_category">Добавяне на нова категория за блог</label>
                                <input class="form-control" id="add_category"  name="category_name" type="text" placeholder="Добави категория">
                            </div>

                            

                            

                            <button type="submit" class="btn btn-primary">Добави </button>

                        </fieldset>

                    </form>
                </div>
            </div>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script>
        $(document).ready(function(){
            $('#choose_img').on('click',function(){
                $('#img_gallery').modal('show');
            });
        });
        
    </script>

