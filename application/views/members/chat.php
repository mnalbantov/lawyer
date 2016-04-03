<h2>Hello world</h2>
<?php foreach($chats as $chat):?>
<p><?= $chat->subject; ?></p>
<p><?= $chat->id; ?></p>
<p><?= $chat->message; ?></p>
<p><?= $chat->username; ?></p>
<p><?= $chat->opened; ?></p>
<?php endforeach; ?>
