<?php

//https:/localhost/SampleApp/Redirection.php

if(isset($_GET['code']))
{
    $code=$_GET['code'];



    $clientId="2159514937635641";
    $clientSecret="9eed0f936962649629ee7123d480083b";
    $url="https://graph.facebook.com/oauth/access_token";
    $value= base64_encode($clientId.":".$clientSecret);

    echo "<br>";


    $paras=array(

        "grant_type"=>"authorization_code",
       /// "redirect_uri"=>"https%3A%2F%2localhost%2FSampleAPP%2FRedirectionPage.php",
        "redirect_uri"=>"https://localhost/SampleAPP/RedirectionPage.php",
        "client_id"=>$clientId,
        "code"=>$code



    );
$req=http_build_query($paras);
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization:Basic MjE1OTUxNDkzNzYzNTY0MTo5ZWVkMGY5MzY5NjI2NDk2MjllZTcxMjNkNDgwMDgzYg==',
        'content-type: application/x-www-form-urlencoded',
        'Accept:applicaion-json'
    ));
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$req);



    $responce=curl_exec($curl);
    var_dump(curl_getinfo($curl));
    //echo curl_getinfo($curl) . '<br/>';
    echo curl_errno($curl) . '<br/>';
    echo curl_error($curl) . '<br/>';
    curl_close($curl);

    echo "<br>";

    $data=json_decode($responce,true);
echo "<PRE>";

print_r($data);

echo"</PRE>";




if(isset($data['access_token']))
{
    session_start();
    $_SESSION['access_token']=$data['access_token'];
    header('Location:https://localhost/SampleApp/DataPage.php');
    exit;

}





}else
    {
        echo "Code Dosent Recived";
      header('Location:https://localhost/SampleAPP/RedirectionPage.php');
       exit;
    }




?>

<!DOCTYPE html>
<html>
<head>
    <title>WEBAPPOAUTH</title>
</head>
<body>






</body>





</html>