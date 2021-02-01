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

       
        // Select paper id from reviewertable section starts here

        $sql = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username,reviewertable.feedback from reviewertable Where primaryemail='$authoremail' and feedback IS NULL and accepted IS NOT NULL";
        $query = $dbh->prepare($sql); 
        $query->execute(); 
        $results=$query->fetchAll(PDO::FETCH_OBJ); 
        $cnt=1;
        if($query->rowCount() > 0) 
        {
        $arraypaperidreviewer = array();
        foreach($results as $result) 
        { 
            $paperid = htmlentities($result->paperid);
            array_push($arraypaperidreviewer,$paperid);
        }
    }
  


        // Select Paper id From reviewertable section ends here

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>As Reviewer</title>
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
include 'reviewer-header.php';
?> 
</div>
<!-- Author showing header sections ends   -->
<div id="mySidebar" class="sidebar">
  <?php 
  include 'reviewer-sidebar.php';
  ?>
</div>  

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

<h5>ASSIGNED PAPER</h5>
<hr class="bg-secondary">

<div  class="table-responsive">
<table   id="dtBasicExample"  cellspacing="0">

<thead> 
    <tr><th></th></tr>
</thead>

<!-- Author paper showing section starts (Jumbotron section) -->
<tbody id="myTable"> 
    <?php 
    // include 'link/linklocal.php';
    foreach ($arraypaperidreviewer  as $pid) {
        $sqlreviewerselection = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.numberofcoauthor,paper.pdate,paper.pmonth,paper.pyear,paper.uploaddate,paper.coauthorname from paper WHERE  action=0 and id='$pid'";
        $resultreviewerselection = mysqli_query($link,$sqlreviewerselection);
        $filereviewerselection = mysqli_fetch_assoc($resultreviewerselection);

        $id =  $filereviewerselection['id'];
        $papername = $filereviewerselection['papername'];
        $numberofcoauthor = $filereviewerselection['numberofcoauthor'];
        $abstract = $filereviewerselection['abstract'];
        $authoremailpaper = $filereviewerselection['authoremail'];
        $name = $filereviewerselection['name'];
        $filepath = '../documents/'.$filereviewerselection['name']; 
        $type = $filereviewerselection['type'];
        $action = $filereviewerselection['action'];
        $uploaddate = $filereviewerselection['uploaddate'];
        $type = $filereviewerselection['type'];
        $pdate = $filereviewerselection['pdate'];
        $pmonth = $filereviewerselection['pmonth'];
        $pyear = $filereviewerselection['pyear'];
        $cauname = $filereviewerselection['coauthorname'];
          ?>

<?php  


$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authoremailpaper' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;
 

// $sqlfeedback = "SELECT feedback FROM reviewertable WHERE  primaryemail= '$authoremailpaper' and paperid = '$id ";

// $resultfeedback = mysqli_query($link,$sqlfeedback); 

// $filefeedback = mysqli_fetch_assoc($resultfeedback);


?>
<!-- Select user  name section ends here  -->




          <!-- Dashboard section starts  -->
      
            <tr>
            <td>
            <div class="jumbotron" > 

            <div class="d-flex justify-content-between">
            <div>
            <p class="fontSize14px">Paper ID : <?php echo $id;?></p>
            </div>
            <div>
            <p class="fontSize14px"><b> Status: <?php

            if ($action!=1) {
                ?>
                <span style="color:goldenrod;">
               <?php  echo "Pending";
            }
            else {
                ?>
                </span>
                <span style="color:green;">
                <?php
                echo "Published on ".$pdate.'-'.$pmonth.'-'.$pyear;
            }
            
            ?>
            </span></b></p>
            </div>
            </div>

            <h5 class="display-4 fontSize16px"><?php echo $papername;?></h5>
            <p style="font-size:12px"><b>Uploaded On : </b><?php echo $uploaddate; ?></p>

            <div class="d-flex justify-content-between">
            <p class="fontSize14px"><b>Author:</b> <?php echo $authorname ?></p>
         <a href="#"><p class="fontSize14px">Number of Co-Author: <?php echo $numberofcoauthor;?></p></a>
            </div>

            <div class="d-flex justify-content-between">
            <p class="fontSize14px"><b>Email:</b> <?php echo $authoremail;?></p>
            <p class="fontSize14px"><b>Co-Authors:</b>[<?php echo $cauname; ?>]</p>

            </div>

            <p class="fontSize14px"><span style="font-weight:bold">Abstract:</span> <?php echo $abstract;?></p>

            <div class=" d-flex justify-content-between col-sm-12">
            <div >
            <a style="font-size:14px;" class="" href="<?php echo $filepath ?> "target ="_blank" role="button">Download</a>
            </div>
            <div >
            <p><?php echo $type;?></p>
            </div>
            <div >
       <form action='reviewer-feedback' method='post'>
       <input type="hidden" name="paperid" value="<?php echo $id;?>">
       
       <input class="text-danger" style="font-size:15px;border:none;font-weight:600;background-color:white;" type="submit" name="reviewer-feedbacks" value="Write a Feedback">
       </form>
            </div>
           
            </div>

           

           </div>
           <hr>
            </td>
           </div>
           </tr>
          
      

       <!-- DashBoard Section ends  -->

    <?php  }?>
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

<?php } ?>