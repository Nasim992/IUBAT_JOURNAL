<?php  
session_start();
error_reporting(0);
include '../link/config.php';
include '../functions.php'; 
if(strlen($_SESSION['alogin'])=="")
    {     
        header("Location:../chiefeditorlogin");  
    }
    else
    {  
     // Check that the Editor is logged in or not section starts here  
     $editoremail = $_SESSION["email"];

     $sql = "SELECT chiefeditor.id,chiefeditor.fullname,chiefeditor.password,chiefeditor.contact FROM chiefeditor WHERE email='$editoremail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     // Check that the Editor is logged in or not section ends here 

      if($link === false){
          die("ERROR: Could not connect. " .mysqli_connect_error());
      }


      if (!empty($_GET['id'])) {
      $id=$_GET['id'];

      // Selecting paper section starts here 
      $sql = "SELECT * FROM paper WHERE paperid = '$id' ";

      $result = mysqli_query($link,$sql);

      $file = mysqli_fetch_assoc($result);

      // Title File and Abstract Section Starts Here
      $filepathtitle = '../documents/file1/'.$file['name1'];
      $filepathmessagetitle = 'documents/file1/'.$file['name1'];
      $filename1 = $file['name1'];
      $type1 = $file['type1']; 
      // Title File and Abstract Section Ends Here 

      // Title second Section Starts Here
      $filepathsecond = '../documents/file2/'.$file['name2'];
      $filepathmessageseconod = 'documents/file2/'.$file['name2'];
      $filename2 = $file['name2'];
      $type2 = $file['type2']; 
      // Title Second Section Ends Here 

      // Main File Uploaded Section starts here 
      $filepath = '../documents/'.$file['name']; 
      $filepathmessage = 'documents/'.$file['name'];
      $filename = $file['name'];
      $type = $file['type']; 
      // Main File Uploaded Section Ends Here 

      // Resubmit file path section
      $filepathresubmit ='../documents/resubmit/'.$file['resubmitpaper'];
      $filepathresubmitname = $file['resubmitpaper'];
      $fileresubmitdate = $file['resubmitdate'];
      // Resubmit file path section

      $papername = $file['papername'];
      $authormail = $file['authoremail'];
      $abstract = $file['abstract'];
      $numberofcoauthor = $file['numberofcoauthor'];

      $uploaddatestring = $file['uploaddate'];

      $maindate = date('d-M-Y',strtotime($uploaddatestring));

      // Selecting paper section ends here 

      // Selecting authorname section starts here 
      $sql = "SELECT * FROM author WHERE  primaryemail= '$authormail' ";

      $result1 = mysqli_query($link,$sql); 

      $file1 = mysqli_fetch_assoc($result1);

      $title = $file1['title'];
      $fname= $file1['firstname'];
      $middlename= $file1['middlename'];
      $lastname= $file1['lastname'];

      $name = $title.' '.$fname.' '.$middlename.' ' .$lastname;
      // Selecting authorname section starts here 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/index.css">
    <title>Download paper</title>
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

            <h5>DOWNLOAD THIS PAPER</h5>
            <hr class="bg-secondary">
            <!-- Dashboard section starts  -->
            <div class="jumbotron ">

                <h5 class="display-4">Name : <?php echo $papername; ?></h5>
                <h6 class="display-5">Author:<span style='color:goldenrod;'> <?php echo $name; ?></span></h6>

                <p style="font-size:14px;"><b>Abstract:</b><?php echo $abstract ?></p>
                <hr class="my-4">
                <div class="row">

                    <?php  if(!empty($filename1)) { ?>
                    <div class="col-sm-12 col-md-6 col-xl-12 col-lg-4">
                        <a style="font-size:14px;" class="btn btn-success btn-sm " href="<?php echo $filepathtitle; ?> "
                            target="_blank" role="button">Full Manuscript as doc</a>
                    </div>
                    <?php }?>

                    <?php  if(!empty($filename2)) { ?>
                    <div class="col-sm-12 col-md-12 col-xl-4 col-lg-4">
                        <a style="font-size:14px;" class="btn btn-success btn-sm "
                            href="<?php echo $filepathsecond; ?> " target="_blank" role="button">Full Manuscript as pdf
                        </a>
                    </div>
                    <?php }?>

                    <?php if(!empty($filepath)) {?>
                    <div class="col-sm-12 col-md-12 col-xl-4 col-lg-4">
                        <a style="font-size:14px;" class="btn btn-success btn-sm " href="<?php echo $filepath; ?> "
                            target="_blank" role="button">Necessary Info</a>
                    </div>
                    <?php  }?>

                </div>
            </div>

            <!-- DashBoard Section ends  -->

        </div>
    </div>
    </div>
    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->
    <script>
    $(document).ready(function() {
        $("#heading-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#heading-table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    // Aim and scope readmore section starts here 
    document.querySelector('#read-more').addEventListener('click', function() {
        document.querySelector('#content').style.height = 'auto';
        this.style.display = 'none';
    });
    //   Aim and scope read more section ends here 
    </script>
</body>

</html>

<?php } else  {
echo "<script>alert('Id is not recognized');</script>";
header("refresh:0;url=publishedpaper");
    } 
  }
  else {
    echo "<script>alert('You are not a Chief Editor.Try to log in as a Chief Editor');</script>";
    header("refresh:0;url=../chiefeditorlogin");
  }
}
    ?>