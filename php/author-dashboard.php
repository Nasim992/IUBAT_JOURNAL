<?php
session_start();
error_reporting(0);
include('../link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php"); 
    }
    else
    { 

      $email = $_SESSION["email"];
      // Paper submission section starts here 

      if(isset($_POST['submit']))
    { 

   $resultsid = $_POST['author-id'];
   echo $resultsid;
   $papertitle = $_POST['paper-title'];
   echo $papertitle;
//   $username=$_POST['uname'];
//   $password=md5($_POST["pass"]); 
//   $email=$_POST['email'];
//   $sql="INSERT INTO  user(user_name,password,contact) VALUES(:username,:password,:email)";
//   $query = $dbh->prepare($sql);
//   $query->bindParam(':username',$username,PDO::PARAM_STR);
//   $query->bindParam(':password',$password,PDO::PARAM_STR);
//   $query->bindParam(':email',$email,PDO::PARAM_STR);
//    $query->execute();
// // $results=$query->fetchAll(PDO::FETCH_OBJ);
// // $lastInsertId = $dbh->lastInsertId();
// // if($lastInsertId)
// // {
// // echo "<script>alert('Signed Up Success');</script>";
// // header("refresh:0;url=intro.php");
// // } else{
    
// //     echo "<script>alert('Something went wrong .Please Try Again .May be your Username Matches with Others');</script>";
// //     header("refresh:0;url=intro.php");

// // }
// $results=$query->fetchAll(PDO::FETCH_OBJ);
// if($query->rowCount() > 0)
// {

//   echo "<script>alert('Signed Up Success');</script>";
// echo "<script type='text/javascript'> document.location = 'intro.php'; </script>";
// } else{
    
//     echo "<script>alert('Invalid Details !Something went wrong .Please Try Again .May be your Username Matches with Others');</script>";
//     header("refresh:0;url=intro.php");

// }
 

}
      // Paper submission section ends here 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
</head>
<body>
  <div class="container">
    <!-- Header section starts here  -->

    <?php 
    include 'author-header.php';
    ?>

    <!-- Header section ends here  -->

    <!-- input file section starts here  -->
    <h1 class="author-heading">Upoad your paper as a pdf format</h1>
      <form class = "author-form" method = "post">
      <div class="form-group">


     




        <label for="formGroupExampleInput">Paper title : </label>
        <input type="text" class="form-control" id="formGroupExampleInput" name = "paper-title" placeholder="Write the title of the paper" required>
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Abstract : </label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name= "summary" rows="8" placeholder ="Write the short summary about the paper" required></textarea>

      </div>
      <div class="form-group">
      <label for="exampleFormControlFile1">Upload file : </label>
      <input type="file" class="form-control-file" name="file"id="exampleFormControlFile1" required>
      </div>
      <hr>

      <button class="btn btn-success  btn-block" name = "submit" type="submit" >Submit</button>
      </form>

    <!-- Input file section ends here  -->

  </div>

    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->    
</body>
</html>

    <?php } ?>