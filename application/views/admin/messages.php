
<!-- /#wrapper -->

<div id="wrapper">



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Съобщения 
                    </h1>
                    <ol class="breadcrumb">
                        <i class="active fa fa-inbox"></i> Съобщения
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Кутия <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" id="sentbox">Изходящи</a></li>
                            <li><a href="#" id="inbox">Входящи</a></li>
                            <li><a href="#" id="bin">Кошче</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                
                    <input type="text" id="typeahead" class="input-sm" data-provide="typeahead"  placeholder="Търси"/><span id="search-loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>
                    <a  href="#" id="searchMsg" class=" btn btn-primary glyphicon glyphicon-search"></a>
                </div>
                <div class="col-sm-9 col-md-10">
                    <!-- Split button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">
                            <div class="checkbox" style="margin: 0;">
                                <label>
                                    <input id='select_all' type="checkbox">
                                </label>
                            </div>
                        </button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href='#'><label for='readed'><input type='checkbox' id='readed' >Прочетени</label></a></li>
                            <li><a href='#'><label for='unread'><input type='checkbox' id='unread' >Непрочетени</label></a></li>


                        </ul>

                    </div>
                    <button id="refresh" type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh">
                        &nbsp;&nbsp;&nbsp;<span class=" glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;</button>
                    <button id="remove" type="button" style="display:none;" class="btn btn-default" data-toggle="tooltip" title="Премахни">
                        <span class=" glyphicon glyphicon-trash"></span>
                    </button>
                    <div class="btn-group" id='actions' style='display: none;' >
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Още <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a id="mark" href="javascript:markAsRead();">Маркирай като прочетени</a></li>
                            <li><a href="javascript:deleteMsg();">Изтрий</a></li>
                            <li class="divider"></li>

                        </ul>
                    </div>
                    <div class="btn-group" id='actions-read' style='display: none;' >
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Още <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:deleteMsg();">Изтрий</a></li>
                            <li class="divider"></li>

                        </ul>
                    </div>
                    <!-- Single button -->

                    <div class="pull-right">
                        <span class="text-muted"><b>1</b>–<b>50</b> of <b>160</b></span>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </button>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <span id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>
            <div class="tab-pane" id="messages">

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">

                        <div class="list-group">

                            <?php
                            if($all_messages):
                            foreach ($all_messages as $all):
                                $date1 = date_create($all->date_sended);
                                ?>
                                <?php if ($all->opened == '0'): ?>
                                    <b><a href="<?= base_url('admin/read_message') . '/' . $all->id; ?>" class="list-group-item">

                                            <label>
                                                <input class="checkbox1 unread" type="checkbox" name=messages[]' value="<?= $all->id; ?>" >
                                            </label>


                                            <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;display: inline-block;"><?= $all->first_name; ?></span> <span class=""><?= $all->subject; ?></span>
                                            <span class="badge"><?= date_format($date1, 'F j, Y  ') ?></span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                                </span></span></a></b>
                                <?php else: ?>
                                    <a href="<?= base_url('admin/read_message') . '/' . $all->id; ?>" class="list-group-item">
                                        <label>
                                            <input class="checkbox1 read"  type="checkbox" name='messages[]'  value="<?= $all->id; ?>">
                                        </label> 

                                        <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;display: inline-block;"><?= $all->first_name; ?></span> <span class=""><?= $all->subject; ?></span>
                                        <span class="badge"><?= date_format($date1, 'F j, Y  ') ?></span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                            </span></span></a>
                            <span id="sentPM" style="min-width: 120px;display:none;"></span>
                                <?php
                                endif;
                            endforeach;
                            else:
                            ?>
                            <h3>Все още нямате съобщения.Побързайте и пишете на някой приятел :) </h3>
                            <?php endif;?>
                        </div>   
                    </div>



                </div><!--/tab-pane-->



            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                <h3>Изтриване</h3> 
                <div class="modal-body">
                    <p class="deleteSure"></p>
                    <div class="modal-footer">
                        <button class="btn btn-danger" id="confirmDelete">Да</button>
                        <button class="btn btn-default" id="confirmNo">Не</button>
                    </div>
                </div>
                </div>
        </div>      
            </div>
        
    </div>
</div>
<!-- /#page-wrapper -->
<script>
   
    $('#select_all').on('click',function (event) {  //on click 
        if (this.checked) { // check select status

            $('.checkbox1').each(function () { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
                $('#actions').show();
                $('#actions-read').hide();
                
            }); 
        } else {
            $('.checkbox1').each(function () { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"  
                $('#actions').hide();

            });
        }
    });
 
    $('#unread').click(function (event) {  //on click 
        $('#actions-read').hide();
        if (this.checked) { // check select status
            if ($('#readed').checked) {
            }
            $('.unread').each(function () { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"  
                $('#actions').show();
            });
        } else {
            $('.unread').each(function () { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"     
                $('#actions').hide();
            });
        }
    });
    $('#readed').click(function (event) {  //on click 
        if (this.checked) { // check select status
            $('.read').each(function () { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
                $('#actions-read').show();
            });
        } else {
            $('.read').each(function () { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"  
                $('#actions-read').hide();
            });
        }
    });
    $('.unread').on('click', function () {
        if (this.checked === true) {
            $('#actions').show();
            $('#actions-read').hide();
        } else {
            $('#actions').hide();
        }
    });
    $('.read').click(function () {
        $('#actions-read').show();
    });
    $('#remove').on('click',function(){
         var checked = $('.checkbox1:checked').map(function () {
            return $(this).val();
        }).get();
      $.ajax({
          url:'<?=site_url('admin/delete_from_recycle_bin') ?>',
          data:{
             checked_messages:checked
          },
           method:"POST"
      }).done(function(data){
          alert(data);
      }).fail(function(){
         alert('Нещо се обърка.Опитай пак');
      });
    });

    $('#bin').on('click',function(){
      $.ajax({
          url:'<?=site_url('admin/recycle_bin') ?>',
      }).done(function(data){
          var result = JSON.parse(data);
          var messages = '';
          var link = result.link;
          for(var i in result.deleted_msg){
                  messages += '<a href="'+link + '/' +result.deleted_msg[i].id +'" class="list-group-item">\n\
    <label><input class="checkbox1" type="checkbox" value="'+result.deleted_msg[i].id +'"></label>\n\
    <span class="glyphicon glyphicon-trash" ></span><span class="name" style="min-width: 120px;display: inline-block;">'+ result.deleted_msg[i].first_name +'</span><span class="">'+ result.deleted_msg[i].subject + '</span>\n\
    <span class="badge">'+result.deleted_msg[i].date_sended +'</span> \n\
                    \n\
    </a>';
    }if(messages ===''){
                $('#messages').html('<p>Вашето кошче е празно!.</p>');
            }else{
                $('#messages').html(messages);
            }
    $('#remove').show();
      }).fail(function(){
          console.log('fail');
      });
    });
    $('#sentbox').on('click',function(){
        var url = '<?=  site_url('admin/sentbox') ?>';
        $.ajax({
            url:url
            
        }).done(function(data){
            var result = JSON.parse(data);
            var message = '';
            for(var i in result.sentbox){
                message += '<a href="#" id="sent'+result.sentbox[i].id +'" data-toggle="collapse" class="list-group-item">\n\
    <label><input class="checkbox1 " type="checkbox" value="'+result.sentbox[i].id +'"></label>\n\
    <span class="glyphicon glyphicon-envelope" ></span><span class="name" style="min-width: 120px;display: inline-block;">'+ result.sentbox[i].first_name +'</span><span class="">'+ result.sentbox[i].subject + '</span>\n\
    <span class="badge">'+result.sentbox[i].date_sended +'</span> \n\
                    \n\
    </a>';
            }
            if(message ===''){
                $('#messages').html('<p>Нямате изпратени съобщения.</p>');
            }else{
                $('#messages').html(message);
            }
            
        }).fail(function(){
            alert('Нещо се обърка.Опитай пак.');
        });
    });
    function sentPM(){
    alert('Haha');
    }
    function deleteMsg(){
         var checked = $('.checkbox1:checked').map(function () {
            return $(this).val();
        }).get();
       var n = checked.length;
       if(n === 1){
          $('.deleteSure').html('Сигурни ли сте,че искате да изтриете това съобщение?');
       }else{
          $('.deleteSure').html('Сигурни ли сте,че искате да изтриете тези съобщения?'); 
       }
        $('.modal').modal('show');
        var confirmDelete = $('#confirmDelete');
        var noDelete = $("#confirmNo");
        // if admin confirm delete messages 
        if(confirmDelete.on('click',function(){
            $('#loading').show();
            $('.modal').modal('hide');
            $.ajax({
            url:'<?=  site_url('admin/delete_messages') ?>',
            data:{
                messages:checked
            },
             dataType:"html",
             method:"POST"
        }).done(function(data){
            var result = JSON.parse(data);
            var messages = '';
            var link = result.link;
            for(var i in result.all_messages){
              if(result.all_messages[i].opened === '0'){
                  messages += '<b>\n\
      <a href="'+link + '/' +result.all_messages[i].id +'" class="list-group-item">\n\
    <label><input class="checkbox1 unread" type="checkbox" value="'+result.all_messages[i].id +'"></label>\n\
    <span class="glyphicon glyphicon-star-empty" ></span><span class="name" style="min-width: 120px;display: inline-block;">'+ result.all_messages[i].first_name +'</span><span class="">'+ result.all_messages[i].subject + '</span>\n\
    <span class="badge">'+result.all_messages[i].date_sended +'</span> \n\
                    \n\
    </a></b>';
              }else
              {
               messages += '<a href="'+link + '/' +result.all_messages[i].id +'" class="list-group-item">\n\
    <label><input class="checkbox1 read" type="checkbox" value="'+result.all_messages[i].id +'"></label>\n\
    <span class="glyphicon glyphicon-star-empty" ></span><span class="name" style="min-width: 120px;display: inline-block;">'+ result.all_messages[i].first_name +'</span><span class="">'+ result.all_messages[i].subject + '</span>\n\
    <span class="badge">'+result.all_messages[i].date_sended +'</span> \n\
                    \n\
    </a>';     
              }
           $('#messages').html(messages);
           $('#loading').hide();
       }
            
        }).fail(function (xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
            alert(xhr.responseText);
        });
        }));
        // if user cancel deleting...
        if(noDelete.on('click',function(){
            $('.modal').modal('hide');
        }));
      
    }
    function markAsRead() {
        var checked = $('.unread:checked').map(function () {
            return $(this).val();
        }).get();
        $('#loading').show();
        $.ajax({
            url:'<?=base_url('admin/mark_as_read'); ?>',
            data:{
                messages:checked
            },
            dataType:"html",
            method:"POST"
            
        }).done(function(data){
            var result = JSON.parse(data);
            var messages = '';
            var link = result.link;
            for(var i in result.all_messages){
              if(result.all_messages[i].opened === '0'){
                  messages += '<b>\n\
      <a href="'+link + '/' +result.all_messages[i].id +'" class="list-group-item">\n\
    <label><input class="checkbox1 unread" type="checkbox" value="'+result.all_messages[i].id +'"></label>\n\
    <span class="glyphicon glyphicon-star-empty" ></span><span class="name" style="min-width: 120px;display: inline-block;">'+ result.all_messages[i].first_name +'</span><span class="">'+ result.all_messages[i].subject + '</span>\n\
    <span class="badge">'+result.all_messages[i].date_sended +'</span> \n\
                    \n\
    </a></b>';
              }else
              {
               messages += '<a href="'+link + '/' +result.all_messages[i].id +'" class="list-group-item">\n\
    <label><input class="checkbox1 read" type="checkbox" value="'+result.all_messages[i].id +'"></label>\n\
    <span class="glyphicon glyphicon-star-empty" ></span><span class="name" style="min-width: 120px;display: inline-block;">'+ result.all_messages[i].first_name +'</span><span class="">'+ result.all_messages[i].subject + '</span>\n\
    <span class="badge">'+result.all_messages[i].date_sended +'</span> \n\
                    \n\
    </a>';     
              }
      
              
         
                
              
                  
               
            }
            $('#messages').html(messages);
            $('#loading').hide();
        }).fail(function(){
            alert('Нещо се обърка.Опитай пак!');
            $('#loading').hide();
        });
    }
    $('#refresh').on('click',function(){
    $('#msgModal').modal('show').html('\n\
    <div class="modal-dialog">\n\
<div class="modal-content">\n\
<div class="modal-header">\n\
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>\n\
<h4 class="modal-title">Съобщение от </h4> \n\
</div>\n\
<div class="modal-body">\n\
 <input type="hidden" id="inputTo" name="fromUser" value="?"/>\n\
 <input type="hidden" id="sender_name"  value="??"/>\n\
<input type="hidden" id="sender_email"  value="?"/>\n\
 <div class="form-group">\n\
<label class="col-sm-2" for="inputSubject">Заглавие</label>\n\
<div class="col-sm-10"><input type="text" class="form-control" id="subject" name="subject"  placeholder="Заглавие на темата"></div>\n\
  </div>\n\
    <div class="form-group">\n\
      <label class="col-sm-12" for="inputBody">Съобщение</label>\n\
     <div class="col-sm-12"><textarea readonly class="form-control" id="inputBody" rows="8" name="message">dasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsaddasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsaddasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsaddasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsaddasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsaddasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsaddasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsaddasdadsadsadsadqdqwdqdqdqwdqwdqdqdsadsad</textarea></div>\n\
    <div class="col-sm-12"><textarea class="form-control" rows="5></textarea></div>\n\
    <input type="hidden" name="t" id="to" value="??"/>\n\
      </div>\n\
      <div id="foooter" class="modal-footer">\n\
  <span id="loading" style="display:none;"><img src="sassets/images/ajax-loader.gif" /></span>\n\
    <p class="alert"></p>\n\
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отказ</button>\n\
      </div></div></div></div></div>\n\
  \n\
');
    });
  
     
    $('#searchMsg').on('click',function(){
    var search = $('#typeahead').val();
    if($('#typeahead').val() ===''){
        return false;
        }else{
           $.ajax({
               url:'<?=site_url('admin/search_message/?') ?>',
               data:{
                 search:search
               },
               method:"POST",
           }).done(function(data){
               var result = JSON.parse(data);
               var messages = '';
               var link = result.link;
                 for(var i in result.search){
                   messages += '<a href="'+link + '/' + result.search[i].id +'"  data-toggle="collapse" class="list-group-item">\n\
    <span class="glyphicon glyphicon-search"></span><span class="name" style="min-width: 120px;display: inline-block;">'+ result.search[i].first_name +'</span><span class="">'+ result.search[i].subject + '</span>\n\
    <span class="badge">'+result.search[i].date_sended +'</span> \n\
                    \n\
    </a>';
            }
               if(messages === ''){
                   $("#messages").html('Няма намерени резултати за "<b>'+search +'</b>"');
               }else{
                    $('#messages').html('<h4>Резултати от търсенето за <em>"'+ search +'"</em></h4>' + messages);
                    $('#typeahead').val('');
               }
              
           });
           
        }
        
    });

</script>




