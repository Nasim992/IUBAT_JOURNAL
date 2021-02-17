<?php
session_start();
error_reporting(0);
 
include('../link/config.php'); 
include('../functions.php');
if(strlen($_SESSION['alogin'])=="") 
    {    
    header("Location: ../login"); 
    }
    else
    {  
        $authoremail = $_SESSION["email"];

                // Check that the Author is logged in or not section starts here 

                       $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$authoremail'"; 
                       $query = $dbh->prepare($sql); 
                       $query->execute(); 
                       $results=$query->fetchAll(PDO::FETCH_OBJ); 
                       $cnt=1;
                       if($query->rowCount() > 0) 
                       {
                
                // Check that the Author is logged in or not section ends here 




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

<h6>PAPER STATUS</h6>
  <hr class="bg-secondary" >
  <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm p-4"> 
<table id="dtBasicExample" class="table table-striped table-bordered table-hover">

<thead>
        <tr class="bg-secondary text-white">
            <th >Paper Id</th>
            <th >Reviewed</th>
            <th >Review date</th>
        </tr> 
</thead> 
<tbody id="myTable-admin">
<!-- Selecting paper section starts here  -->
        <?php $sql = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username,reviewertable.primaryemail,reviewertable.assigndate,reviewertable.action,reviewertable.feedback,reviewertable.feedbackdate from reviewertable WHERE primaryemail='$authoremail' and feedback IS NOT NULL";
            $query = $dbh->prepare($sql); 
            $query->execute(); 
            $results=$query->fetchAll(PDO::FETCH_OBJ); 
            $cnt=1; 
            if($query->rowCount() > 0)  
            {
            foreach($results as $result) 
            {  
                $paperid = htmlentities($result->paperid);
                ?>
<!-- Selecting paper section ends here  -->

</td>
<td class="text-dark">
<?php  echo htmlentities($result->paperid); ?>
</td>
 
<td>
<?php $feedback = unserialize($result->feedback);

  for ($x = count($feedback)-1; $x>=0;$x-- ){
      echo $feedback[$x].'<hr>';
  }

;?>
</td>
<td class="text-dark">
<small>
<b>Reviewd On :</b><br>

<?php 
// Selecting Date section starts here

if (!empty(htmlentities($result->feedback)))
{
    $feedbackdatestring = unserialize($result->feedbackdate);
    $maindate = date("d-M-Y",strtotime($feedbackdatestring[count($feedbackdatestring)-1]));
    echo $maindate.'<br>';
}

// Selecting Date section ends here 
?>


</small>
</td>

</tr>
<?php }} ?>
       
</tbody>

</table>

</div>


<div class="pb-4"></div>
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