
<?php

session_start();
/*
unset($_SESSION['access_token']);
for testing purpose
*/

$appiD="2159514937635641";
$appSecret="";





?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icon.png">

    <title>Login</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin">

      <img class="mb-4" src="https://ubisafe.org/images/facebook-transparent-wordmark.png" alt="" width="700" height="500" >
	  <div>
      <?php

if(isset($_SESSION['access_token']))
{
 
    
    if($_SESSION['DeactivateTime'] > time())
  
    {
        
        $accessToken=$_SESSION['access_token'];
    header('Location: https://localhost/SampleApp/DataPage.php');
   
    exit;

        
        
    }else
    {
         session_destroy();
         echo"<p>Sign In With FaceBook</p><br>";

        echo "<a href='https://www.facebook.com/dialog/oauth?response_type=code&client_id={$appiD}&redirect_uri=https%3A%2F%2Flocalhost%2FSampleAPP%2FRedirectionPage.php&scope=public_profile'>Facebook</a>";
        
    }
    
    
    
   

}else
    {
        echo"<p>Sign In With FaceBook</p><br>";

        echo "<a href='https://www.facebook.com/dialog/oauth?response_type=code&client_id={$appiD}&redirect_uri=https%3A%2F%2Flocalhost%2FSampleAPP%2FRedirectionPage.php&scope=public_profile'>Facebook</a>";

    }




?>
      </div>


    </form>
  </body>
</html>
