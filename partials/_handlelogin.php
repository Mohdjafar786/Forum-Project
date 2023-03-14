<?php
include '_dbConnect.php';
$showError=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $loginEmail=$_POST['loginEmail'];
    $loginPass=$_POST['loginPass'];
    $sql = "SELECT * FROM `users` WHERE user_email='$loginEmail'"; 
    $result = mysqli_query($conn, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($loginPass,$row['user_password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail']=$loginEmail;
        }
        header("Location: /forum/index.php");
    }
    header("Location: /forum/index.php");
}
?>