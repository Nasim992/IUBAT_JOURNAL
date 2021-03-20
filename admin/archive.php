<?php
session_start();
error_reporting(0);
include('../link/config.php'); 
if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: ../login"); 
    }  
    else 
    {  
     // Check that the Editor is logged in or not section starts here  
     $editoremail = $_SESSION["email"];

     $sql = "SELECT admin.id,admin.fullname,admin.password,admin.contact FROM admin WHERE email='$editoremail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     
     // Check that the Editor is logged in or not section ends here 
  if(isset($_POST['submit']))
  { 
  $paperid = $_POST['paperid'];
  $papername = $_POST['papername'];
  $authorname = $_POST['authorname'];
  $abstract = $_POST['abstract'];
  $publisheddate =  $_POST['publisheddate'];
  $versionyear = date("Y",strtotime($publisheddate));
  $versionissue= intval($versionyear);

  // Full pdf if necessary info file section starts Here 
  $file = $_FILES['file'];
  $name = $_FILES['file']['name'];
  $filetmp = $_FILES['file']['tmp_name'];
  $type = $_FILES['file']['type']; 
   // Full pdf if necessary info  File section ends here

   $sqlarchive="INSERT INTO  archive(versionissue,paperid,papername,authorname,abstract,filename,publisheddate) VALUES('$versionissue','$paperid','$papername','$authorname','$abstract','$name','$publisheddate')";

   if( mysqli_query($link,$sqlarchive))
   {
     move_uploaded_file($filetmp,"../documents/archivefile/".$name);
   echo "<script>alert('Paper Uploaded Successfully.');</script>";
   echo "<script type='text/javascript'> document.location = 'archive'; </script>";
   } else{
       
       echo "<script>alert('Invalid Details !This paper has already Uploaded');</script>";
       header("refresh:0;url=archive");
    }   
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <style>
    @media only screen and (max-width: 992px) {
        form {
            margin-left: 0px !important;
            margin-right: 0px !important;
        }
    }

    form {
        padding: 20px;
        margin-left: 120px;
        margin-right: 120px;
        border: 2px solid #e3e3e3;
        font-size: 14px;
    }
    </style>
</head>

<body>

    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php include 'header.php'; ?>
    </div>
    <!-- Author showing header sections ends   -->

    <div id="mySidebar" class="sidebar">
        <?php include 'sidebar.php'; ?>

    </div>

    <div id="main">

        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">

            <!-- Progress bar section starts here  -->
            <div>
                <!-- input file section starts here  -->
                <form class="author-form" method="post" enctype="multipart/form-data">
                    <div class="">
                        <h1 class="text-center" style="font-size:18px;"><b>ADD PAPER TO THE ARCHIVE</b></h1>
                        <br>

                        <br>
                        <div class="input-group">
                            <label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Paper ID:</b></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleFormControlTextarea1" name="paperid"
                                    placeholder="Enter the Unique paper id" required>
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Paper
                                    Name:</b></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleFormControlTextarea1"
                                    name="papername" placeholder="Enter the Paper Name of this paper " required>
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Author
                                    Name:</b></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleFormControlTextarea1"
                                    name="authorname" placeholder="Enter the Authorname of this paper" required>
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Abstract:</b></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="abstract"
                                    rows="10" placeholder="Write the Abstract of this paper" required></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Published Date
                                    :</b></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="exampleFormControlTextarea1"
                                    name="publisheddate" required>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="col-sm-12 col-lg-12 col-md-12">
                        <div class="input-group">
                            <label class="col-sm-8 col-form-label" for="formGroupExampleInput"><b>Upload the paper
                                </b></label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1"
                                    accept="application/pdf">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <div>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-success " name="submit" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section Ends Here  -->
    </form>
    </div>

    </div>

    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
    // DataTables section starts here 
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    // Datables section ends here 
    </script>
    <!-- Essential Js,Jquery  section ends  -->
</body>

</html>

<?php 

}
else {
  echo "<script>alert('You are not a admin.Try to log in as a admin');</script>";
  header("refresh:0;url=../login");
}

}
    
?>