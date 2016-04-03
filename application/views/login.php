<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<!--------------------
LOGIN FORM
by: Amit Jakhu
www.amitjakhu.com
--------------------->

<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Вход</title>

<!--STYLESHEETS-->
<link href="<?= base_url();?>assets/css/login.css" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--Slider-in icons-->


</head>
<body>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="login-form" class="login-form" action="<?=base_url();?>login/validate" method="post">
   
	<!--HEADER-->
    <div class="header">
    <!--TITLE--><h1>Вход</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Попълнете полетата за да влезнете в системата!</span><!--END DESCRIPTION-->
    
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME--><input name="email" type="text" class="input username"  placeholder="Вашият Email"  /><!--END USERNAME-->
        <!--PASSWORD--><input name="password" type="password" class="input password"   onfocus="this.value=''" /><!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
     <div class="error"> <p><?= validation_errors();?></p></div>
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><input type="submit" name="submit" value="Вход" class="button" /><!--END LOGIN BUTTON-->
    <!--REGISTER BUTTON--><a href="<?=base_url();?>register" class="register">Регистрация</a><!--END REGISTER BUTTON-->
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
		$(":input").removeAttr("placeholder");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>
</body>
</html>