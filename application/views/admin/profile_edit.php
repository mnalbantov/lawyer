

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
                        <?php if($this->session->flashdata('message')) { echo '<p class="alert alert-info">'.$this->session->flashdata('message').'</p>'; } ?>
                        <h2>Информация</h2>
                         
                        <div class="form-group">
                            
                            <?php echo form_open('admin/profile_validate/'.$profile_id); ?>
                            <?php echo validation_errors('<p class="alert alert-danger">','</p>')?>
                            <label>Профилна снимка</label><br/>
                            <?php if($user->profile_pic): ?>
                            <img src="<?= base_url().'uploads/thumbs/'.$user->profile_pic; ?>"  title="Профилна снимка" /><br/>
                            <?php else:?>
                            <span>Няма профилна снимка</span><br/>
                            <?php endif;?>
                             <input type="file" name="userfile" size="20"  /><br/>
                            <label>Потребителско име</label><br/>
                            <input type="text" name="username" value="<?= $user->username; ?>" class="form-control-static" /><br/>
                            <label>Име</label><br/>
                            <input type="text" name="f_name" value="<?= $user->first_name; ?>" class="form-control-static" /><br/>
                            <label>Фамилия</label><br/>
                            <input type="text" name="l_name" value="<?= $user->last_name; ?>" class="form-control-static" /><br/>
                            <label>Email</label><br/>
                            <input type="text" name="email" value="<?= $user->email;?>" class="form-control-static" /><br/>
                             <label>Парола</label><br/>
                            <input type="text" name="password" class="form-control-static" /><br/>
                             <label>Телефон</label><br/>
                            <input type="text" name="phone"<?php if($user->phone);?> value="<?=$user->phone ?>"  class="form-control-static" /><br/>
                            <label class="control-label">Тип потребител</label>
                           <div class="controls">
                            
                            <select name="type">
                                <option selected="" value="user">Потребител</option>
                                <option value="admin">Администратор</option>
                                <option value="moderator">Модератор</option>
                                
                            </select><br/><br/>
                            <label class="control-label">Активност</label><br/>
                            <?php if($user->is_active == '1'):  ?>
                            <select name="is_active">
                                <option selected="" value="1">Активен</option>
                                 <option value="0">Неактивен</option>
                                 </select><br/><br/>
                                <?php else:?>
                                <select name="is_active">
                                <option  value="1">Активен</option>
                                 <option selected="" value="0">Неактивен</option>
                                 </select><br/><br/>
                                <?php endif;?>
                                
                            
                            <input type="submit" value="Обнови"  class="btn btn-success"/>
                        </form>
                        <a href="<?= base_url('admin/users'); ?>" class="btn btn-default">Назад </a>

                        <?php endforeach;
                        else:
                            redirect('admin/users');
                        endif;
?>                 

</div>
                    
                    </div>
                </div>
            </div>
</div>
