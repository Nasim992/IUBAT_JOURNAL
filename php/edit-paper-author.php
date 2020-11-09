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
       $authoremail = $_SESSION["email"];
       $id=intval($_GET['id']);
       $nameprevious = $_GET['nameprevious'];

      if(isset($_POST['submit']))
    {
      $papername = $_POST['paper-title'];
      $abstract = $_POST['summary'];

        $file = $_FILES['file'];

        $name = $_FILES['file']['name'];
        $filetmp = $_FILES['file']['tmp_name'];

        $type = $_FILES['file']['type'];

      $sql="update paper set papername=:papername,abstract=:abstract,name=:name where id=:id ";

      $query = $dbh->prepare($sql);
      $query->bindParam(':papername',$papername,PDO::PARAM_STR);
      $query->bindParam(':abstract',$abstract,PDO::PARAM_STR);
      $query->bindParam(':name',$name,PDO::PARAM_STR); 

      $query->bindParam(':id',$id,PDO::PARAM_STR);

      $query->execute();

      $results=$query->fetchAll(PDO::FETCH_OBJ);

      if($query->rowCount() > 0)
      {

     // Built-in PHP function to delete file
     unlink($_GET["nameprevious"]);
  
     // Redirecting back
    //   header("Location: " . $_SERVER["HTTP_REFERER"]);
 
      move_uploaded_file($filetmp,"../documents/".$name);
        echo "<script>alert('Paper Updated Successfully.');</script>";
       echo "<script type='text/javascript'> document.location = 'author-paper-show.php'; </script>";
      } else{
          
        echo "<script>alert('Invalid Details !Something went wrong');</script>";
        header("refresh:0;url=author-paper-show.php");

      }

    }   
       

    

     

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
  <div class="sticky-top">
    <!-- Header section starts here  -->

    <?php 
    include 'author-header.php';
    ?>

    <!-- Header section ends here  -->
    </div>

    <!-- input file section starts here  -->
    <h1 class="author-heading">Update your paper</h1>

      <form class = "author-form" method = "post" enctype = "multipart/form-data">

                    <?php 

                $sql = "SELECT * from paper where id=$id";
                $query = $dbh->prepare($sql);
                $query->bindParam(':id',$id,PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0)
                {
                foreach($results as $result)
                { 
                    ?>

      <div class="form-group">
        <label for="formGroupExampleInput">Paper title : </label>
        <input type="text" class="form-control bigText" id="formGroupExampleInput" name = "paper-title" value="<?php echo htmlentities($result->papername)?>" required>
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Abstract : </label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name= "summary" rows="8" required><?php echo htmlentities($result->abstract)?></textarea>

      </div>
      <div class="form-group">
      <label for="exampleFormControlFile1">Upload file : </label>
      <input type="file" class="form-control-file" name="file"id="exampleFormControlFile1" accept = "application/pdf"  required>
      </div>
      <!-- accept = "application/pdf" -->
      <hr>

      <?php }} ?>   

      <button class="btn btn-success  btn-block" name = "submit" type="submit" >Update</button>
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