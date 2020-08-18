<?php
require_once "db.php";
session_start();

$code=$_POST["code"];

$sql = "SELECT code FROM users where email = '".$_SESSION['email']."'";

$receive_code=time();

if( ($receive_code - $_SESSION['sendcode'])<=60){

if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
    
      if($row['code']==$code){

    echo"<h1>You have entered 2FA code correctly.Login Successful</h1>";
  }
     
else{
    echo"<h1>You have entered wrong 2FA secret code.Login Failed!</h1>";
}

}

}
else{
  echo "<script>
alert('Code expired');
  location='index.html';

 </script>";
 session_unset();
 session_destroy();
 session_start();


}
?>
<html>
<body>
  Click here to <a href="logout.php">Logout</a>
</body>
  </html>