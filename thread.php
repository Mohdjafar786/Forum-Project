<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Welcome to iDisscuss :-coding for forum</title>
</head>

<body>
    <?php include 'partials/_dbConnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
      $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE threads_id=$id";
    $result=mysqli_query($conn,$sql);      
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['threads_title'];
        $desc=$row['threads_desc'];
        $thread_user_id=$row['threads_user_id'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'"; 
      $result2 = mysqli_query($conn, $sql2);
        $row2=mysqli_fetch_assoc($result2);
        $username1=$row2['user_email']; 
    echo '<div class="container my-4">
      <div class="jumbotron">
  <h1 class="display-4">'.$title.' </h1>
  <p class="lead">'.$desc.'</p>
  <hr class="my-4">
  <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
  <p>Posted by:<i>'.$username1.'</i></p>
</div>
</div>';
    }  
    ?>
    <?php
    $showAlert=false;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $content=$_POST['comment'];
    $content = str_replace("<", "&lt;", $content);
    $content = str_replace(">", "&gt;", $content); 
    $sno=$_POST['sno'];
    $sql="INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`) VALUES ( '$content', '$id', '$sno')";
    $result=mysqli_query($conn,$sql);
    $showAlert=true;
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}
    
    if(isset($_SESSION['loggedin']) &&  $_SESSION['loggedin']==true ){
   echo '<div class="container">
    <h1>Post a comment</h1>
    <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Type your comment</label>
    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Post</button>
</form>
</div>';
    }else{
        echo  '<div class="container">
        <h1>Post a comment</h1>
       <p class="lead">You are not logged in. Please login to be able to start a Comment</p>
        </div>';
    }
echo '<div class="container">
    <h2>Disscussion</h2>';
 $sql="SELECT * FROM `comments` WHERE thread_id=$id";
 $result=mysqli_query($conn,$sql);
 $noResult=true;     
 while($row=mysqli_fetch_assoc($result)){
    $noResult=false;
$content=$row['comment_content'];
$content_time=$row['comment_time'];
$comment_by=$row['comment_by'];
$sql2 = "SELECT user_email FROM `users` WHERE sno='$comment_by'"; 
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);
  $username1=$row2['user_email']; 
 echo '<div class="media my-4">
 <img src="img/userdeafult.jpg" width=30px class="mr-3" alt="...">
 <div class="media-body">
   <h5 class="mt-0"><a class="text-dark">'. $username1.' at '.$content_time.'</a></h5>
   '.$content.'
 </div>
</div>';

 }  
 if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p><b>No Results Found</b></p>
    <p class="lead">Be the first person to ask question.</p>
  </div>
</div>';
} 
echo '</div>';
 ?> 

 
    <?php include 'partials/_footer.php';?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>