<?php echo $error; ?>
           
  <?php if($img): ?>
            <div>
                <p class="alert alert-info">Успешно качен файл</p>
        <img src="<?= $img; ?>" />
            </div>
        <?php else:?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="profile_pic"  />
        </form>
        <?php echo 'Нещо се обърка :( Опитай пак';
        
        endif;
        