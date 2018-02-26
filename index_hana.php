<?php
   include("public/php/config.php");
   session_start();

  $ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	else
	        $ipaddress = 'UNKNOWN';


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email and password sent from form 
      
      //$useremail = mysqli_real_escape_string($con,$_POST['email']);
      //$mypassword = mysqli_real_escape_string($con,$_POST['password']); 
      
	  $useremail = ($_POST['email']);
	  $mypassword = ($_POST['password']); 
	  
	  //echo $useremail." | ". $mypassword;
	  
      $sql = "SELECT * FROM DIFO.m_user WHERE EMAIL = '$useremail' and SANDI = '$mypassword' and BLOK = ''";
   
	  $result = odbc_exec($con,$sql);
      
	  $row = odbc_fetch_array($result);
	  //$active = $row['active'];
	  
	  $count = odbc_num_rows($result);
      // If result matched $useremail and $mypassword, table row must be 1 row
	  
      if($count == 1) {
         //$error = "" ;
		 //session_register("nama");
         
		 $_SESSION['login_user'] = $row['nama'];
		 $_SESSION['idmitra'] = $row['idmitra'];
		 $_SESSION['kodeperusahaan'] = $row['kodeperusahaan'];
		 $_SESSION['ipaddress'] = $ipaddress;
         	
        
        $sql2 = "SELECT * FROM DIFO.q_profil WHERE email = '$useremail'";  //IP Address validation insert here
		$result2 = odbc_exec($con,$sql2);
      
		$row2 = odbc_fetch_array($result2);
		$count2 = odbc_num_rows($result2);
		
		if($count2 == 1) {
		$_SESSION['grupuser'] = $row2['gr_user'];
        }	
       header("location: admin/forms/main.php");
      
	  }
	  	else {
         
		 $error = "Your Email or Password is invalid";
      }
   }

?>

<!DOCTYPE html>
<!-- see tutorial: http://www.jquery4u.com/?p=17043 -->
<html>
    <head>
        <title>E-Dapem NG</title>
		<link rel="stylesheet" href="public/css/bootstrap.css">
        <link rel="stylesheet" href="public/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="public/css/main.css">
        <script data-main="public/js/app" src="public/js/vendor/require.js"></script>
		<style>
		.logo {
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		.login-page {
      	position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%) 
		}
		
		.login-form {
        background: white;
		width:100%;
        border-radius: 1em;
		border: 1px solid grey;
        padding: 1em;
		}
		
		.login-form .input {
		width:90%;	
        padding: 1em;
		}
		
		.captcha-wrap {
			width:100%;	
			margin-left:20%;
		}
		</style>
		
    </head>
    <body>
	<div class="wrapper">
	  <div class="login-page">
        <img class="logo" src="public/img/taspen_small.png" alt="taspen" />
		<h1>E-Dapem NG</h1>
		<div class="login-form">
        <form class="form-horizontal" action="#" method="post" id="captcha-form" name="captcha-form" autocomplete="off" >

            <fieldset>
                <div class="control-group">
                    <div class="controls">
                    <input class="input" name="email" type="email" placeholder="Email">
                    </div>
                </div>
				<div class="control-group">
                    <div class="controls">
                    <input class="text input" name="password" type="password" placeholder="Password">
                    </div>
                </div>
               

                <div class="control-group">
                    <div class="controls">
                        <label class="" for="captcha"><p>*Please enter the verication code shown below.</p></label>
                        <div id="captcha-wrap" class="captcha-wrap">
                            <img src="public/img/refresh.jpg" alt="refresh captcha" id="refresh-captcha" /> 
							<img src="public/php/newCaptcha.php" alt="" id="captcha" />
                        </div>
                        <input class="text input" id="captcha" name="captcha" type="text" placeholder="Verification Code">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <input class="btn-large btn-block btn-primary" type="submit" value="Login">
                    </div>
                </div>
            </fieldset>

        </form>
		
		</div>
		<p>Your IP Address; <?php echo $ipaddress; ?></p>
        <p>Powered by: Finnet</p>
		</div>
	</div>
    </body>
</html>