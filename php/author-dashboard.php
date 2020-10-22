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
      // $authoremail = $_SESSION["email"];
      // echo $authoremail;
      
      // Paper submission section starts here

      if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        // print_r($file);
        $filename = $_FILES['file']['name'];
        $filetmp = $_FILES['file']['tmp_name'];
        $filesize = $_FILES['file']['size'];
        $fileerror = $_FILES['file']['error'];
        $filetype = $_FILES['file']['type'];

        echo $filename;
        echo $filetmp;
        echo $filesize;
        echo $fileerror;
        echo $filetype ;

        move_uploaded_file($filetmp,"uploads/".$filename);

      }
      

    //   if(isset($_POST['submit']))
    // { 
      // $authoremail = $_SESSION["email"];
      // echo $authoremail;
      // $papertitle = $_POST['paper-title'];
      // echo $papertitle;
      // $abstract = $_POST['summary'];
      // echo $abstract;

      // if (isset($_FILES['file'])) {
      //   $file = $_FILES['file'];
      //   // print_r($file);
      //   $filename = $_FILES['file']['name'];
      //   $filetmp = $_FILES['file']['tmp_name'];
      //   $filesize = $_FILES['file']['size'];
      //   $fileerror = $_FILES['file']['error'];
      //   $filetype = $_FILES['file']['type'];

      //   echo $filename;
      //   echo $filetmp;
      //   echo $filesize;
      //   echo $fileerror;
      //   echo $filetype ;

      //   move_uploaded_file($filetmp,"uploads/".$filename);

      // }
      

      // echo $filename;
      // echo $filetmp;
      // echo $filesize;
      // echo $filetype;



      // if(move_uploaded_file($filetmp,$fileDestination)){

      //   $sql="INSERT INTO  paper(author-email,paper-name,abstract,name,mime) VALUES(:authoremail,:papertitle,:abstract,:filename,:filetype )";

      //   $query = $dbh->prepare($sql);

      //   $query->bindParam(':authoremail',$authoremail,PDO::PARAM_STR);
      //   $query->bindParam(':papertitle',$papertitle,PDO::PARAM_STR);
      //   $query->bindParam(':abstract',$abstract,PDO::PARAM_STR);
      //   $query->bindParam(':name',$filename,PDO::PARAM_STR);
      //   $query->bindParam(':type',$filetype,PDO::PARAM_STR);
      //   // $query->bindParam(':file',$file,PDO::PARAM_STR);
      //   $query->execute();

      // }




      // $query->bindParam(1,$authoremail);
      // $query->bindParam(2,$papertitle);
      // $query->bindParam(3,$abstract);
      // $query->bindParam(4,$name);
      // $query->bindParam(5,$mime);
      // $query->bindParam(6,$file);
      
     

    // $results=$query->fetchAll(PDO::FETCH_OBJ);
    // $lastInsertId = $dbh->lastInsertId();
    // if($lastInsertId)
    // {
    // echo "<script>alert('Signed Up Success');</script>";
    // header("refresh:0;url=intro.php");
    // } else{
        
    //     echo "<script>alert('Something went wrong .Please Try Again .May be your Username Matches with Others');</script>";
    //     header("refresh:0;url=intro.php");

    // }
    // $results=$query->fetchAll(PDO::FETCH_OBJ);
    // if($query->rowCount() > 0)
    // {

    //   echo "<script>alert('SSuccessfully added');</script>";
    // // echo "<script type='text/javascript'> document.location = 'author-dashboard.php'; </script>";
    // } else{
        
    //     echo "<script>alert('Invalid Details !Something went wrong .Please Try Again .May be your Username Matches with Others');</script>";
    //     // header("refresh:0;url=author-dashboard.php");

    // }
    

// }
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
    <h1 class="author-heading">Upload your paper as a pdf format</h1>

      <form class = "author-form" method = "post" enctype = "multipart/form-data">
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
      <input type="file" class="form-control-file" name="file"id="exampleFormControlFile1"  required>
      </div>
      <!-- accept = "application/pdf" -->
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