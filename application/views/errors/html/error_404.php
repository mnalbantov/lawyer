<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>404 Page Not Found</title>
        <link href="<?= base_url('assets/default.css') ?>" type="text/css" rel="stylesheet" />   
     
    <body>
        <div id="er404"> </div> 
        <div id="error404">

            <h1 id="errMsg"><?php echo $heading; ?></h1>
            <p><?php echo $message; ?></p>
        </div>
    </body>
</html>