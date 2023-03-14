<?php
include '_dbConnect.php';
$showError=false;
$showAlert=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

    $sql = "SELECT * FROM `users` WHERE user_email='$user_email'"; 
    $result = mysqli_query($conn, $sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $showError='Email already in use';
    }else{
        if($pass==$cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_email`, `user_password`, `timestamp`) VALUES ( '$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert=true;
                header("Location:/forum/index.php?signupsucess=true");
                exit();
            }
        }else{
            $showError='passwords do not match';
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}
?>