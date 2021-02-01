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
        $authoremail = $_SESSION["email"];

                       // Check that the admin is logged in or not section starts here 

                       $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$authoremail'"; 
                       $query = $dbh->prepare($sql); 
                       $query->execute(); 
                       $results=$query->fetchAll(PDO::FETCH_OBJ); 
                       $cnt=1;
                       if($query->rowCount() > 0) 
                       {
                
                // Check that the admin is logged in or not section ends here 


?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Paper Status</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css"> 
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <style>

    .fontSize14px {
        font-size:14px !important;
    }
    .fontSize16px {
        font-size:16px !important;
    }
    .fontSize13px {
        font-size:13px !important;
    }
    
    </style>

    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
</head> 
<body> 
<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'author-header.php';
?> 
</div>
<!-- Author showing header sections ends   -->
<div id="mySidebar" class="sidebar">
  <?php 
  include 'author-sidebar.php';
  ?>
</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

<h5>PAPER STATUS</h5>
<hr class="bg-secondary">

<div  class="table-responsive">
<table   id="dtBasicExample"  cellspacing="0">

<thead>  
    <tr><th></th></tr>
</thead>

<!-- Author paper showing section starts (Jumbotron section) -->

<tbody id="myTable">
    <?php $sql = "SELECT paper.paperid,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.numberofcoauthor,paper.pdate,paper.pmonth,paper.pyear,paper.uploaddate,paper.uploadmonth,paper.uploadyear,paper.coauthorname from paper WHERE authoremail='$authoremail'";
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
      if($query->rowCount() > 0)  
      {
      foreach($results as $result) 
      {   ?>

<?php  


$authoremail = htmlentities($result->authoremail);

$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authoremail' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

?>
<!-- Select user  name section ends here  -->




          <!-- Dashboard section starts  -->
      
            <tr>
            <td>
            <div class="jumbotron" > 

            <div class="d-flex justify-content-between">
            <div>
            <p class="fontSize14px">Paper ID : <?php echo htmlentities($result->id);?></p>
            </div>
            <div>
            <p class="fontSize14px"><b> Status: <?php
            //  echo htmlentities($result->action);
            $test = htmlentities($result->action);
            $pdate = htmlentities($result->pdate);
            $pmonth = htmlentities($result->pmonth);
            $pyear = htmlentities($result->pyear);

            $uploaddate = htmlentities($result->uploaddate);


            if ($test!=1) {
                ?>
                <span style="color:goldenrod;">
               <?php  echo "Under Review";
            }
            else {
                ?>
                </span>
                <span style="color:green;">
                <?php
                echo "Accepted on ".$pdate.'-'.$pmonth.'-'.$pyear;
            }
            
            ?>
            </span></b></p>
            </div>
            </div>

            <h5 class="display-4 fontSize16px"><?php echo htmlentities($result->papername);?></h5>
            <p style="font-size:12px"><b>Uploaded On : </b><?php echo $uploaddate; ?></p>

            <div class="d-flex justify-content-between">
            <p class="fontSize14px"><b>Author:</b> <?php echo $authorname ?></p>
         <a href="#"><p class="fontSize14px">Number of Co-Author: <?php echo htmlentities($result->numberofcoauthor);?></p></a>
            </div>

            <div class="d-flex justify-content-between">
            <p class="fontSize14px"><b>Email:</b> <?php echo htmlentities($result->authoremail);?></p>
            <p class="fontSize14px"><b>Co-Authors:</b>[<?php echo htmlentities($result->coauthorname); ?>]</p>

            </div>

            <p class="fontSize14px"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>

            <div class=" d-flex justify-content-between">
            <div >
            <a href="paper-download.php?id=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></a>
            </div>
            <div >
            <p><?php echo htmlentities($result->type);?></p>
            </div>
            <a href="edit-paper-author.php?id=<?php echo htmlentities($result->id);?>&nameprevious=../documents/<?php echo htmlentities($result->name);?>"><i class="far fa-edit" title="Edit"></i></a>
            <a href="delete-paper.php?id=<?php echo htmlentities($result->id);?>&name=documents/<?php echo htmlentities($result->name);?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>
            </div>

           

           </div>
           <hr>
            </td>
           </div>
           </tr>
          
      

       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
        </table>


<!-- Authors paper showing section ends (jumbotron section) -->

<div class="pb-4"></div>
</div>
    </div>
    </div>
 <!-- Essential Js,jquery,section starts  -->
 <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>

    <script>
            // DataTables section starts here 
             $(document).ready(function () {
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
              echo "<script>alert('You are not a Author.Try to log in as an Author');</script>";
              header("refresh:0;url=../login");
            }

} ?>