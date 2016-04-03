<div>
    <?php if($viewed_messages): ?>
    <ul class="list-group">
    <?php foreach($viewed_messages as $msg):?>
      <?php  if($msg->profile_pic):
            ?>
                                    <li class="list-group-item text-right"><input type="checkbox" class="pull-left" value="<?= $msg->id; ?>"/>от<a style="cursor:pointer"  href="<?php echo base_url('members/read_message').'/'. $msg->id; ?>" class="pull-left message" ><?= $msg->subject; ?></a>&nbsp;<a href="<?= base_url('members/profile') . '/' . $msg->user_id; ?>"><?= $msg->first_name; ?></a></li>
                                <?php else: ?>
                                    <li class="list-group-item text-right"><input type="checkbox" class="pull-left" value="<?= $msg->id; ?>"/>от<a style="cursor:pointer"  href="<?php echo base_url('members/read_message').'/'. $msg->id; ?>" class="pull-left message" ><?= $msg->subject; ?></a>&nbsp;<a href="<?= base_url('members/profile') . '/' . $msg->user_id; ?>"><?= $msg->first_name; ?></a></li>
                                <?php endif; ?>
                                        <div id="loading" style="display:none;"><img src="<?= base_url() ?>assets/images/ajax-loader.gif" /></div>
        <?php endforeach;?>
    </ul>
        <?php   else:
        ?>
        <p>Все още нямате съобщения!</p>
        <?php endif; ?>
    </div>
</div>

