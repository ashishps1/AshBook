<?php include("includes/sessions.php");?>
<?php include("includes/db_connection.php") ?>
<?php include("functions/query_functions.php") ?>
<?php include("functions/common_functions.php") ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AshBook | Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">-->
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Ash</span>Book<small>A Social Network</small></a></h1>
      </div>
      
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="login.php">Log In</a></li>
		  <li><a href="register.php">Register</a></li>
          <li><a href="support.php">Support</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
          
          <div class="article">
			<?php 
				//print_r($_POST);
				if(isset($_POST["user_name"])&&isset($_POST["password"])&&!empty($_POST["user_name"])&&!empty($_POST["password"])){
				
					if(get_user_login_info($_POST["user_name"], $_POST["password"])) {
						redirect_to('user_home.php');
					}			
					else {
						echo "<div class=\"error\">Please enter correct username and password</div>";
		
					}
					
				}
			?>
            <h2><span>Login</span></h2>
            <div class="clr"></div>
            <form action="login.php" method="post" >
              <ol>
                <li>
                  <label for="user_name">User Name</label>
                  <input id="user_name" name="user_name" class="text" />
                </li>
                <li>
                  <label for="email">Password</label>
                  <input type="password" id="password" name="password" class="text" />
                </li>
				<li>
                  <input type="image" name="imageField" id="imageField" src="images/submit.gif" class="send" />
                  <div class="clr"></div>
                </li>
              </ol>
            </form>
          </div>
        </div>
        
        <div class="clr"></div>
      </div>
    </div>
  </div>
</div>
<div class="footer">
  <div class="footer_resize">
    <p class="lf">&copy; Copyright <a href="about.php">AshBook</a>.</p>
    <p class="rf">Layout by Rocket <a href="http://www.rocketwebsitetemplates.com/">Website Templates</a></p>
    <div class="clr"></div>
  </div>
</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

</html>