<?php
session_start();
error_reporting(0);

include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php"); 
    }
    else
    { 
       $authoremail = $_SESSION["email"];

// Co Authors Selection Section Starts Here 
if(isset($_POST['submit-firsto']))
{ 
  $numberOfCoAuthor = $_POST['co-authors-number'];
  $papername = $_POST['paper-title'];
}
// Co- Authors Selection Section Ends Here 

// echo $numberOfCoAuthor;
// echo $papername;

// Paper Uploaded Section Starts Here 
if(isset($_POST['submit']))
{ 

  $authoremailmain = $_POST['author-email'];
  $papername = $_POST['paper-title'];
  $abstract = $_POST['summary'];
  $numberOfCoAuthorp = $_POST['number-of-coauthors'];
    $file = $_FILES['file'];

    $name = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];

    $type = $_FILES['file']['type'];

    $action = 0 ;

    


  // echo $filename;
  // echo $filetmp;
  // echo $filesize;
  // echo $filetype;
  $sql="INSERT INTO  paper(authoremail,papername,abstract,name,type,action) VALUES(:authoremailmain,:papername,:abstract,:name,:type,:action)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':authoremailmain',$authoremailmain,PDO::PARAM_STR);
  $query->bindParam(':papername',$papername,PDO::PARAM_STR);
  $query->bindParam(':abstract',$abstract,PDO::PARAM_STR);
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':type',$type,PDO::PARAM_STR);
  $query->bindParam(':action',$action,PDO::PARAM_STR);

  $query->execute();

  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    move_uploaded_file($filetmp,"documents/".$name);
  echo "<script>alert('Paper Uploaded Successfully.');</script>";
  echo "<script type='text/javascript'> document.location = 'upload-paper1.php'; </script>";
  } else{
      
      echo "<script>alert('Invalid Details !This paper has already Uploaded');</script>";
      // header("refresh:0;url=author-dashboard.php");

  }   
}

 
// Paper Uploaded Section Ends Here 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/heading.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
<style>
@media only screen and (max-width: 992px) {
  form {
    margin-left:0px !important;
    margin-right:0px !important; 
  }
}
form {

  padding:20px;
  margin-left:120px;
  margin-right:120px;
  border:2px solid #e3e3e3;
  font-size:14px;
}
.co-author-form {

  font-size:11px;
  
}
.co-author-form input{
  font-size:11px;
}
</style>
</head> 
<body>
<div class="sticky-top mr-2 ml-2 pb-3">
    <!-- Header section starts here  --> 
    <?php 
    include 'author-header.php'; 
    ?>
    <!-- Header section ends here  -->
    </div>
 
  <div class="container ">


<div>
 <!-- input file section starts here  -->
   <form class="author-form"  method = "post" enctype = "multipart/form-data">
   <div class="">
   <h1 class="text-center" style="font-size:18px;"><b>UPLOAD PAPER</b></h1>
   <br>

<input type="hidden" id="custId" name="author-email" value="<?php echo $authoremail ?>"> 
<input type="hidden" id="custId" name="co-authors-number" value="<?php echo $numberOfCoAuthor ?>">
<input type="hidden" id="custId" name="paper-title" value="<?php echo $papername ?>">
<!-- <div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput">PaperTitle:</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="formGroupExampleInput" name = "paper-title" placeholder="Write the title of the paper" required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput">CoAuthors:</label>
<div class="col-sm-10">
<input type="number" class="form-control" id="formGroupExampleInput" name = "number-of-coauthors" placeholder="Enter the number of Co-Authors" min=0 max=10 required>
</div>
</div>
<br> -->
 
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Abstract:</b></label>
<div class="col-sm-10">
<textarea class="form-control" id="exampleFormControlTextarea1" name= "summary" rows="5" placeholder ="Write the short summary about the paper" required></textarea>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>UploadPdf:</b></label>
<div class="col-sm-10">
<input type="file" class="form-control-file" name="file"id="exampleFormControlFile1" accept = "application/pdf"  required>
</div>
</div>
<br>
<hr class="bg-success">

<div class="row co-author-form">
   <?php
   for ( $x=0;$x<$numberOfCoAuthor;$x++)
   {
       ?>

<div class="col-sm-12 col-md-6 col-lg-4">
<h6 style="font-size:14px;"><b>Co-Author:<?php echo $x+1;?></b></h6>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Name:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "fullname+<?php echo $x+1;?>" placeholder="FullName " required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Email:</label>
<div class="col-sm-9">
<input type="email" class="form-control" id="formGroupExampleInput" name = "email+<?php echo $x+1;?>" placeholder="email " required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Dept.:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "dept+<?php echo $x+1;?>" placeholder="Department " required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Institute:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "institute+<?php echo $x+1;?>" placeholder="Institute" required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Address:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "address+<?php echo $x+1;?>" placeholder="address" required>
</div>
</div>


</div>

       <?php 
   }
   
   ?>
   </div>
<br>

   </div>
<hr>
<div class="form-group">
<div class="d-flex justify-content-between">
<div>
<a href="upload-paper1.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>
</div>
<div>
<button class="btn btn-success " name = "submit" type="submit" >Submit</button>
</div>
</div>

</div>

  <!-- Form Section Ends Here  -->
  </form>
</div>
 <!-- Input file section ends here  -->



</div> <!-- Container div -->


    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <!-- Essential Js,Jquery  section ends  -->    
</body>
</html>

    <?php } ?>