

<div id="wrapper">



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Статистика
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= site_url('admin/index'); ?>">
                                <i class="fa fa-dashboard"></i> Главно табло
                            </a>
                        </li>
                        <li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Последна активност
                        </li>
                    </ol>

                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-comment "></i>Последни коментари</h3>
                        </div>
                        <?php if ($last_comments): ?>
                            <?php foreach ($last_comments as $last): ?>
                                <div class="panel-body">
                                    <a  href="javascript:Comment(<?= $last->comment_id; ?>);" title="Виж този коментар"><?= $last->comment_body; ?> </a>


                                    <div id="morris-donut-chart"></div>
                                    <div class="text-right">
                                        <a href="<?= base_url('admin/profile/') . '/' . $last->user_id; ?>"><?= $last->comment_name; ?> <i class="glyphicon glyphicon-user"></i></a>
                                    </div>
                                </div>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>
                
                <div class="col-lg-12" id="new_users">
                     <a  id="mark_as_seen" title="Маркирай като видяни" style="display:none;" class="pull-right btn btn-info"><i class="glyphicon glyphicon-check"></i></a>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user fa-fw"></i>Нови потребители</h3>
                        </div>
                        <div class="container-fluid">                                                                                  
                            <div class="table-responsive">          
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><input class="checkbox" type="checkbox" id="select_AllNewUsers"</th>
                                            <th>Име</th>
                                            <th>Фамилия</th>
                                            <th>E-mail</th>
                                            <th>Никнейм</th>
                                            <th>Адрес</th>
                                            <th>Телефон</th>
                                            <th>Тип</th>
                                            <th>Дата</th>
                                            <th>Настройки</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php if($last_users):
                                              foreach($last_users as $user):
                                             $date = date_create($user->created_on) ?>
                                        <tr><td><input class="checkbox-inline" type="checkbox" value="<?=$user->user_id; ?>"</td>
                                            <td><?=$user->first_name;?></td>
                                            <td><?=$user->last_name;?></td>
                                            <td><?=$user->email;?></td>
                                            <td><?=$user->username;?></td>
                                            <td><?=$user->address;?></td>
                                            <td><?=$user->phone;?></td>
                                            <td><?=$user->type;?></td>
                                            <td><?=  date_format($date, 'd M y h:i:s');?></td>
                                            <td>
                                                <a href="<?=site_url('admin/profile').'/'.$user->user_id; ?>" title="Виж този потребител" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="#" title="Изтрий този потребител" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                            </td>
                                        </tr>                
                                    </tbody>
                                     <?php endforeach; else:?>
                                    <tbody><tr><center>Няма нови потребители</center></tr></tbody>
                                            <?php endif;?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

        <!-- /#page-wrapper -->
        <div class="modal" id="myModal" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Коментар</h4>
                    </div>
                    <div class="modal-body">

                    </div>  
                </div> 
            </div>  
        </div>
    </div>
    <!-- /#wrapper -->
    <script>
        function Comment(ID) {
            var comment_id = ID;
            $.ajax({
                url: '<?= site_url('admin/update_comments'); ?>',
                data: {
                    comment_id: comment_id
                },
                method: "POST"
            }).done(function (data) {
                var result = JSON.parse(data);
                var comment = '';
                var user_profile = result.link;
                var blog = result.blog_link;
                for (var i in result.comment) {
                    comment += '<a href="' + blog + '/' + result.comment[i].entry_id + '#comment' + result.comment[i].comment_id + '" title="Виж този коментар във форума" >' + result.comment[i].comment_body + '</a><br/>От:<br/><a href="' + user_profile + '/' + result.comment[i].user_id + '">' + result.comment[i].comment_name + '</a>'
                }
                $('.modal-body').html(comment);
                $('#myModal').modal('show');
            });
        }
        $(document).ready(function(){
        $('#select_AllNewUsers').on('click',function(event){
           if(this.checked === true){
              $('input:checkbox').each(function(){
                 this.checked = true; 
                 $('#mark_as_seen').show();
              });
           }else{
                $('input:checkbox').each(function(){
                this.checked = false;
                  $('#mark_as_seen').hide();
            });
        }
        });
        $('#mark_as_seen').on('click',function(){
           var checked = $('.checkbox-inline:checked').map(function(){
              return $(this).val(); 
           }).get();
           
           $.ajax({
               url:'<?=site_url('admin/mark_as_seen'); ?>',
               data:{
                   checked:checked
               },
                method:"POST"
           }).done(function(data){
               alert(data);
           });
        });
        });
    </script>

