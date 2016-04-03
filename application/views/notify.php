<?php if($notify):?>
<?php foreach($notify as $not):?>
<?php endforeach; endif;?>
<h4>Известия по email адрес</h4>
<span id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></span>
<?php if($message): ?>
<p class="alert alert-info"><?= $message; ?></p>
<?php else:?>
<?php if($not->send_msg_email == '1'):?>
<p class="alert alert-info">По подразбиране, известията са ви включени,което означава,че ще получавате съобщение по email,
    когато някой ви изпрати съобщение</p>
<form class="form-group" action="javascript:changeNotify();">
    <select id="notify">
        <option value="1">Включено</option>
        <option value="0">Изключено</option>
    </select><br/><br/>
    <input type="submit" class="btn btn-primary" name="click" value="Запази" />
</form>
<?php else:?>
<p class="alert alert-info">Вашата настройка за известия е променена. В момента вие не получавате известия по email адрес. Можете да промените това </p>


<form class="form-group" action="javascript:changeNotify();">
    <select id="notify">
        <option value="0">Изключено</option>
        <option value="1">Включено</option>
    </select><br/><br/>
    <input type="submit" class="btn btn-primary" name="click" value="Запази" />
</form>
<?php endif; endif;?>

<script>
        function changeNotify() {
            var notify = $('#notify');
           $.post('<?= base_url('members/changeNotifications'); ?>',{notifyCH:notify.val()},
           function(data){
               $('#loading').show();
               $('#settings').html(data).show();
               $('#loading').hide();
    }).fail(function () {
          $('#settngs').html('Нещо се обърка :( Опитай пак').show().fadeOut('5000');
       });
        }
    </script>
