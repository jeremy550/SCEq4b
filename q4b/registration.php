<?php
session_start();    
require_once "db.php";
require('vendor/autoload.php');

        if(isset($_POST['submit'])){
        
        if(isset($_POST['email']) & isset($_POST['password'])& isset($_POST['phone'])){
        
            $email = $_POST['email'];
            $password =$_POST['password'];
            $phone =$_POST['phone'];
            $_SESSION['email']=$email;

           $sql1="INSERT INTO users VALUES ('".$email."','".$password."','','".$phone."')";
           $user=mysqli_query($link,$sql1);
           
           $random_number = mt_rand(100000, 999999);
        
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
   
           $expire=1;
           $session["code"] = $random_number ;
           $session["sendcode"] = time() - $_SESSION["code"];
          $session["expireaftersec"]=($expire*60);

           if($message->sid){
   
           header('location: receive_code.html');
           }
        
    }
        else {
            echo "<script>
					 alert('Email or Password cannot be empty ');
					</script>";

            }

        }

?>


<html>
<head>
</head>
<body>

        <h3>Create Account</h3>
    <form action="registration.php" method="post">
         <h3>Email</h3>
        <input type="email" id="email" name="email" required>
        <br>
        <h3>Password</h3>
        <input type="password" id="password" name="password" required>
        <br></br>
        <h3>Phone Number</h3>
        Please add your country international code <br>
        <input type="text" id="phone" name="phone" required>
        <br></br>
        <input type="submit" name="submit" value="Register">
    </form>
        
</body>
</html>