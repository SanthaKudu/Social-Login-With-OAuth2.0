<?php

session_start();



   if(isset($_SESSION['DeactivateTime']))
  {
       
      if($_SESSION['DeactivateTime'] < time())
    {
          
          
          
        session_destroy();
        header('Location: https://localhost/SampleApp/AppFirstPage.php');
        exit;
          
          
      

    }
    
       
       
       
      
    }
    else
    {
    $minutes=1;
    $time=time();
    $_SESSION['ActivetedTime']=$time;
	$_SESSION['DeactivateTime']=$_SESSION['ActivetedTime']+(60+$minutes);
       
        
    }
    







if(isset($_SESSION['access_token']))
{
    
  
    
    
  
    
	$token=$_SESSION['access_token'];
    $clientId="2159514937635641";
    $clientSecret="9eed0f936962649629ee7123d480083b";
    $url="https://graph.facebook.com/v3.1/me?fields=id,name,address,birthday,email,gender,location";
    $value= base64_encode($clientId.":".$clientSecret);

    echo "<br>";

    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization:Bearer '.$token,
        'content-type: application/x-www-form-urlencoded',
        'Accept:applicaion-json'
    ));
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    $responce=curl_exec($curl);

   // echo curl_errno($curl) . '<br/>';
   // echo curl_error($curl) . '<br/>';
    curl_close($curl);
    $data=json_decode($responce,true);
//print_r($data);


    $name=$data['name'];



    if(isset($data['id']))
    {
        $id=$data['id'];
        $url="https://graph.facebook.com/{$id}/picture?type=large&redirect=false";
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.$token,
            'content-type: application/x-www-form-urlencoded',
            'Accept:applicaion-json'
        ));
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
       // curl_setopt($curl,CURLOPT_REDIR_PROTOCOLS)
        $responce=curl_exec($curl);
        curl_close($curl);
        $data=json_decode($responce,true);
        $image=$data['data']['url'];
       

    }



}else
{
    echo"<h1>Sign In With FaceBook</h1><br>";

    echo "<a href='https://www.facebook.com/dialog/oauth?response_type=code&client_id=2159514937635641&redirect_uri=https%3A%2F%2F3bba02b1.ngrok.io%2FSampleAPP%2FRedirectionPage.php&scope=public_profile%20%20user_photos%20email%20user_hometown%20user_location%20user_gender'>Facebook</a>";
    exit;
}

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
    <p>WELCOME <?Php echo $name ?></p>

      <img class="mb-4" src="<?Php echo $image ?>" alt="" width="150" height="150" >
	  <div>

      </div>


    </form>
  </body>
</html>




