<?php
session_start();
error_reporting(0);  
include('../link/config.php');
include('../link/functionsql.php');
include('../functions.php');
checkLoggedInOrNot();  
$authoremail = $_SESSION["email"];
IsAuthorLoggedIn($authoremail);

// Co Authors Selection Section Starts Here 
if(isset($_POST['submit-firsto']))
{ 
  $numberOfCoAuthor = $_POST['co-authors-number'];
  $papername = $_POST['paper-title'];
}
// Co- Authors Selection Section Ends Here 

// Paper Uploaded Section Starts Here 
if(isset($_POST['submit']))
{ 
    uploadPaper();
} 
// Paper Uploaded Section Ends Here 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Paper</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/heading.css">
    <link rel="stylesheet" href="../css/index.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
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
    .co-author-form {
        font-size: 11px;
    }
    .co-author-form input {
        font-size: 11px;
    }
    </style>
</head>
<body>
    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php include 'author-header.php'; ?>
    </div>
    <!-- Author showing header sections ends   -->
    <div id="mySidebar" class="sidebar">
        <?php  include 'author-sidebar.php'; ?>
    </div>
    <div id="main">
        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">
            <div>
                <!-- input file section starts here  -->
                <form class="author-form" method="post" enctype="multipart/form-data">
                    <div class="">
                        <h1 class="text-center" style="font-size:18px;"><b>UPLOAD PAPER</b></h1>
                        <br>
                        <input type="hidden" id="custId" name="author-email" value="<?php echo $authoremail ?>">
                        <input type="hidden" id="custId" name="number-of-coauthors"
                            value="<?php echo $numberOfCoAuthor ?>">
                        <input type="hidden" id="custId" name="paper-title" value="<?php echo $papername ?>">

                        <div class="input-group">
                            <label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Abstract:</b></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="summary" rows="10"
                                    placeholder="Write the Abstract of this paper(length should be minimum 255 characters and maximum 1000 characters" minlength="255" maxlength="1000" required></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-md-12">
                                <div class="input-group">
                                    <label class="col-sm-8 col-form-label" for="formGroupExampleInput"><b>1.Upload full
                                            manuscript as doc format:</b></label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control-file" name="file1"
                                            id="exampleFormControlFile1" accept=".doc, .docx" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 col-md-12">
                                <div class="input-group">
                                    <label class="col-sm-8 col-form-label" for="formGroupExampleInput"><b>2.Upload full
                                            manuscript as pdf format:</b></label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control-file" name="file2"
                                            id="exampleFormControlFile1" accept="application/pdf" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 col-md-12">
                                <div class="input-group">
                                    <label class="col-sm-8 col-form-label" for="formGroupExampleInput"><b>3.Upload
                                            Necessary information as Pdf format:(If Necessary)</b></label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control-file" name="file"
                                            id="exampleFormControlFile1" accept="application/pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr class="bg-success">

                        <div class="row co-author-form">
                            <?php for ( $x=0;$x<$numberOfCoAuthor;$x++){ ?>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <h6 style="font-size:14px;"><b>Co-Author:<?php echo $x+1;?></b></h6>
                                <div class="input-group">
                                    <label class="col-sm-3 col-form-label" for="formGroupExampleInput">Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                            name="caufullname<?php echo $x+1;?>" placeholder="FullName " required>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group">
                                    <label class="col-sm-3 col-form-label" for="formGroupExampleInput">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="formGroupExampleInput"
                                            name="cauemail<?php echo $x+1;?>" placeholder="email " required>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group">
                                    <label class="col-sm-3 col-form-label" for="formGroupExampleInput">Dept.:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                            name="caudept<?php echo $x+1;?>" placeholder="Department " required>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group">
                                    <label class="col-sm-3 col-form-label"
                                        for="formGroupExampleInput">Institute:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                            name="cauinstitute<?php echo $x+1;?>" placeholder="Institute" required>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group">
                                    <label class="col-sm-3 col-form-label" for="formGroupExampleInput">Address:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                            name="cauaddress<?php echo $x+1;?>" placeholder="address" required>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <!-- <a href="upload-paper1.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a> -->
                            </div>
                            <div>
                                <button class="btn btn-sm btn-success " name="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                    <!-- Form Section Ends Here  -->
                </form>
            </div>
            <!-- Input file section ends here  -->
        </div> <!-- Container div -->
    </div>
    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <!-- Essential Js,Jquery  section ends  -->
</body>
</html>