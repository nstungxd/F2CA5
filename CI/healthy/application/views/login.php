<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>My Healthy App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!--
    <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
    <meta name="author" content="Codrops" />
    -->
    <link rel="shortcut icon" href="<?php echo $baseDir ?>/www/img/stock.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo $baseDir ?>/www/css/login.demo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $baseDir ?>/www/css/style.login.css" />
</head>
<body>
    <div class="container">
        <section>
            <div id="container_demo" >
                <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form action="" autocomplete="on" method="post">
                            <h1>My Healthy App</h1> 
                            <p> 
                                <label for="username" class="uname" data-icon="u" > UserID </label>
                                <input id="username" name="username" required="required" type="text" placeholder="Please type in UserID"/>
                            </p>
                            <p> 
                                <label for="password" class="youpasswd" data-icon="p"> Password </label>
                                <input id="password" name="password" required="required" type="password" placeholder="Please type in password" /> 
                            </p>
                            <!--
                            <p class="keeplogin"> 
								<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
								<label for="loginkeeping">Keep me logged in</label>
							</p>
							-->
                            <p class="login button"> 
                                <input type="submit" value="Log in" /> 
							</p>
                            <!-- Errors -->
                            <?php if(form_error('username') || form_error('password')):?>
                                <div class="change_link">
                                <!--
                                    Not a member yet ?
                                    <a href="#toregister" class="to_register">Join us</a>
                                -->
                                    <?=form_error('username');?>
                                    <?=form_error('password');?>
                                </div>
                            <?php endif;?>
                            
							
                        </form>
                    </div>
                </div>
            </div>  
        </section>
    </div>
</body>
</html>