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
    <?php include 'partials/_header.php';
    $query=$_GET['query'];
    ?>
    <div class="container">
        <h3>Search for results <?php echo "$query"?></h3>
        <?php
        $sql=" SELECT * FROM `threads` WHERE MATCH(`threads_title`,`threads_desc`) against('$query')";
        $result=mysqli_query($conn,$sql);
        $noResult=true;
        while($row=mysqli_fetch_assoc($result)){
            $thread_title=$row["threads_title"];
            $thread_desc=$row["threads_desc"];
            $noResult=false;
            $id=$row["threads_id"];
            echo '<div class="container">
             <h3><a href="/forum/thread.php?threadid='.$id.'" class="text-dark">'.$thread_title.'</a></h3>
             <p>'.$thread_desc.'</p>
            </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
             <div class="container">
                 <p class="display-4">No Results Found</p>
                 <p class="lead"> Suggestions: <ul>
                         <li>Make sure that all words are spelled correctly.</li>
                         <li>Try different keywords.</li>
                         <li>Try more general keywords. </li></ul>
                 </p>
             </div>
          </div>';
         }
        ?>
       

    </div>

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