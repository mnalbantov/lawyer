 <div id="wrapper">

    
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Създаване на потребител
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?= base_url('admin/index');?>">Главно табло</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Добавяне на потребител
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                 <?php if($this->session->flashdata('message')) {
                            echo'<span class="alert alert-info">'.$this->session->flashdata('message').'</span>';
                        } ?>
                <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                       
                        <h3>Създай потребител</h3>
                    </div>
                    <?php 
                            $username = array(
                                'name' => 'username',
                                'placeholder' => 'Name', 
                            );
                             $email = array(
                                'name' => 'email',
                                'placeholder' => 'Email', 
                            );
                              $f_name = array(
                                'name' => 'f_name',
                                'placeholder' => 'Име', 
                            );
                                $l_name = array(
                                'name' => 'l_name',
                                'placeholder' => 'Фамилия', 
                            );
                                 $password = array(
                                'name' => 'password', 
                            );
                                 $phone = array(
                                'name' => 'phone',
                                'placeholder' => 'Телефон', 
                            );
                                 
                                  
                            
                    ?>
                    <?php  echo form_open('admin/validate_user')?>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Потребителско име</label>
                        <div class="controls">
                           <?php echo  form_input($username,$this->input->post('username')) ?>
                            <span class="help-inline alert-danger"><?php echo form_error('username');?></span>
                        </div>
                         <label class="control-label">Email</label>
                        <div class="controls">
                           <?php echo  form_input($email,$this->input->post('email')) ?>
                            <span class="help-inline alert-danger"><?php echo form_error('email');?></span>
                        </div>
                          <label class="control-label">Име</label>
                        <div class="controls">
                           <?php echo  form_input($f_name,$this->input->post('f_name')) ?>
                            <span class="help-inline alert-danger"><?php echo form_error('f_name');?></span>
                        </div>
                            <label class="control-label">Фамилия</label>
                        <div class="controls">
                           <?php echo  form_input($l_name,$this->input->post('l_name')) ?>
                            <span class="help-inline alert-danger"><?php echo form_error('l_name');?></span>
                        </div>
                              <label class="control-label">Парола</label>
                        <div class="controls">
                           <?php echo form_password($password) ?>
                            <span class="help-inline alert-danger"><?php echo form_error('password');?></span>
                        </div>
                                <label class="control-label">Телефон</label>
                        <div class="controls">
                           <?php echo  form_input($phone,$this->input->post('phone')) ?>
                            <span class="help-inline alert-danger"><?php echo form_error('phone');?></span>
                        </div>
                                 <label class="control-label">Тип потребител</label>
                        <div class="controls">
                            
                            <select name="type">
                                <option selected="" value="user">Потребител</option>
                                <option value="admin">Администратор</option>
                                <option value="moderator">Модератор</option>
                                
                            </select><br/>
                            <label class="control-label">Активност</label><br/>
                            <select name="is_active">
                                <option selected="" value="1">Активен</option>
                                <option value="0">Неактивен</option>
                                
                            </select><br/>
                            <span class="help-inline alert-danger"><?php echo form_error('access');?></span>
                        </div><br/>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Създай</button>
                          <a class="btn" href="<?= base_url('admin/users');?>">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
            </div>
        </div>
 </div>
