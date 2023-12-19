<?php
	session_start();
	require 'F:\Mohammed_Shahzadul_Quadri\Project\config.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in</title>
  </head>


  <body>

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form class="sign-in-form" class="myform" action="index.php" method="post">
            <h2 class="title">Entry Here</h2>
            
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" id="username" placeholder="Username" name="username" class="inputvalues" required/>
            </div>
            
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" class="inputvalues" required/>
            </div>
           
            <a href="tour.html"><input type="submit" value="Login" class="btn solid"/></a>

            <h4>OR</h4>

            <p class="social-text">Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3 style="position:absolute; left:200px;">New here ?</h3>
          </br></br>
            <button class="btn transparent" id="sign-up-btn" style="position:absolute; left:200px;">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Need not register again. Just Login and Enjoy your vacation.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Log in
            </button>
          </div>
        </div>
      </div>
    </div>

    <script defer src="app.js"></script>



<?php
		if(isset($_POST['login']))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$query="select * from userinformation WHERE username='$username' AND password='$password'";
			
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				$row = mysqli_fetch_assoc($query_run);
				// valid
				$_SESSION['username']= $row['username'];
				$_SESSION['imglink']= $row['imglink'];
				header('location:homepage.php');
			}
			else
			{
				// invalid
				echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
			}
			
		}	
		?>


  </body>
</html>