<?php
session_start();    
require_once "db.php";
require('vendor/autoload.php');
 
$email = $_POST["email"];
$password = $_POST["password"];

    if(isset($_POST['submit'])){

        $sql = "SELECT * FROM users where email = '".$email."' and password = '".$password."'";
            if ($result = mysqli_query($link, $sql)) {
	        $count = mysqli_num_rows($result);
	        if($count >=1){
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$_SESSION["password"] = $row['password'];
        $_SESSION["email"] =  $row['email'];       
        $phone = $row['phone'];

        $random_number = mt_rand(100000, 999999);

        $send_code=time();
    
        $_SESSION['sendcode']= $send_code ;
        
        $sql2="UPDATE users SET code = '".$random_number."'  WHERE email ='".$email."'";
        $code_update=mysqli_query($link,$sql2);

        $id = 'ACe76a34d785bb908eef0889d9d87db3b5';
        $token = 'd76ca669bb76bbe01473eede99f5f20a';

        $from = '+14243756768';
        $client = new Twilio\Rest\Client($id,$token);
        $message = $client->messages->create(
            $phone,array(
                'from'=>$from,
                 'body'=>'Your verification code '.$random_number
            )

        );

        

        if($message->sid){

        header('location: receive_code.html');
        }

        

        
    }
    else{
        echo "<script>
              alert('Invalid password or email ');
              </script>";
    
    }
}
    }
?>