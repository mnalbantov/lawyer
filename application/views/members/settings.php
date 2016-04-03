
<div id="menu">
      <ul>
        <li class="current_page_item"><a href="<?= base_url();?>members" accesskey="1" title="">Профил</a></li>
        <li><a href="<?= base_url();?>blog" accesskey="2" title="">Блог</a></li>
        <li><a href="<?= base_url();?>about" accesskey="3" title="">За мен</a></li>
        <li><a href="#" accesskey="5" title="">Контакти</a></li>
        <li><a href="<?= base_url();?>members/logout" accesskey="6" title="">Изход</a></li>
      </ul>
    </div>
  </div>
</div>
    
<hr>
<div class="container">
	<div class="row">
        <div class="col-sm-10"><h1>Здравей&nbsp;<strong><?= $this->session->userdata('first_name'); ?></strong></h1></div>
        <?php if ($this->session->userdata('profile_pic')): ?>
            <div class="col-sm-2"><a style="cursor: pointer;" id="profile_pic" class="pull-right"><img title="Промени профилната си снимка" class="img-thumbnail img-responsive" src="<?= base_url('uploads/thumbs') . '/' . $this->session->userdata('profile_pic'); ?>" width="126" height="126"></a></div>

        <?php else: ?>
            <div class="col-sm-2"><a style="cursor: pointer;" id="profile_pic" class="pull-right"><img title="Промени профилната си снимка" class="img-circle img-responsive" src="<?= base_url('uploads') . '/std_prof_pic.png' ?>" width="126" height="126"></a></div>
        <?php endif; ?>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted"><strong>Настройки</strong></li>
              <a href=""><li id="several" class="list-group-item text-right active"><span class="pull-left"><i class="glyphicon glyphicon-cog"></i><strong>Общи</strong></span>&nbsp;</li> </a>
               <a href="javascript:notify();"> <li id="notifications" class="list-group-item text-right "><span class="pull-left"><i class="glyphicon glyphicon-new-window"></i><strong>Изветия</strong></span>&nbsp;</li></a> 
            </ul> 

            <div class="panel panel-default">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                <div class="panel-body"><a href="http://bootply.com">bootply.com</a></div>
            </div>


            <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
            </ul> 

            <div class="panel panel-default">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
                    <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                </div>
            </div>

        </div><!--/col-3-->
    	<div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li><a href="<?=base_url('members');?>">Личен профил</a></li>
            <li><a href="<?=base_url('members/messages');?>">Съобщения</a></li>
            <li class="active"><a href="<?=base_url('members/settings');?>">Настройки</a></li>
          </ul>
              
          
             <div class="tab-pane" id="settings">
            	<span id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>	
               	
                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Име</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Фамилия</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Потребителско име</h4></label>
                              <input type="text" class="form-control" name="username" id="phone" placeholder="твоят никнейм" title="enter your phone number if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Телефон</h4></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Адрес</h4></label>
                              <input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Парола</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Потвърди парола</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
              	</form>
                  
              </div>
            
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
    <script>
            function notify() {
                $('#several').removeClass('active');
                $("#notifications").addClass('active');
                $.ajax({
                   url:"<?=base_url('members/notifications')?>" 
                }).done(function(data){
                    $('#loading').show();
                    $('#settings').html(data);
                    $('#loading').hide();
                }).fail(function() {
                    $('#settings').html('<p class="alert alert-primary">Издънихме схемата някъде бро :( </p>');
                });
            }
        </script>
