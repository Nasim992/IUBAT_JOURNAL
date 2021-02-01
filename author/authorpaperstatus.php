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
            <th >Paper Status</th> 
            <th >Paper Id</th>
            <th >Paper Title</th>
            <th >Submitted</th>
        </tr> 
</thead> 
<tbody id="myTable-admin">
<!-- Selecting paper section starts here  -->
        <?php $sql = "SELECT paper.paperid,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.numberofcoauthor,paper.pdate,paper.pmonth,paper.pyear,paper.uploaddate,paper.uploadmonth,paper.uploadyear,paper.coauthorname from paper WHERE authoremail='$authoremail' ORDER BY uploadyear DESC";
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
<tr>
<td class="text-dark">
<small>
  <!-- Paper Status Section starts here  -->
  <!-- Reviewer section starts here  -->
 <?php 

// Selecting Primary email from the reviewertable section starts here 
$primaryemailarray = array();

$sqlreviewer = "SELECT primaryemail FROM reviewertable WHERE paperid = '$paperid'";
$resultreviewer = mysqli_query($link,$sqlreviewer );
$file = mysqli_fetch_assoc($resultreviewer);
foreach($resultreviewer as $filerev) {
    array_push($primaryemailarray,$filerev['primaryemail']);
}
 ?>
  <!-- Reviewer section ends here -->
  <?php 
  $accepted = htmlentities($result->action);
  $pdate = htmlentities($result->pdate);
  $pmonth = htmlentities($result->pmonth);
  $pyear = htmlentities($result->pyear);
  $mainpdate =$pdate.' '.$arraymonth[$pmonth].' '.$pyear;
  if($accepted == 1 ) {

      echo "<p class='text-success'><b>Accepted on:<br></b> ".$mainpdate.'</p>';
  }
  else  {
      
     echo "<b><span class='text-warning'>Under Review</span> <br>Reviewer:</b>".'<br>';
      if(empty($primaryemailarray)) {
          echo "Not Selected Yet";
      }
      else {
          $cnt = 1;
    foreach ($primaryemailarray as $es) {
        $sqlauthorname = "SELECT * FROM author WHERE  primaryemail= '$es' ";
        $resultauthorname = mysqli_query($link,$sqlauthorname); 
        $fileauthorname = mysqli_fetch_assoc($resultauthorname);
        
            $title = $fileauthorname['title'];
            $fname= $fileauthorname['firstname'];
            $middlename= $fileauthorname['middlename'];
            $lastname= $fileauthorname['lastname'];
        
            $authorname =  $title.' '.$fname.' '.$middlename.' '.$lastname;

         echo $cnt.'.'.$authorname.'<br>';
         $cnt = $cnt + 1;
    //   Reviewing paper selection section ends here 
}
  }
}


  ?> 
  <!-- Paper status section starts here  -->
  </small>
</td>
<td>
<?php  echo htmlentities($result->paperid); ?>
</td>

<td>
<!-- <form action="paperdetails" method="post">
<input type="hidden" name="paperid" value="<?php echo htmlentities($result->paperid);?>">
<input onclick="return" class="bg-success;" style="font-size:13px;border:none;font-weight:600;background-color:transparent" type="submit" name="paperDetailsAuthor" value="<?php  echo htmlentities($result->papername); ?>">
</form> -->

<a href="paperdetails.php?paperid=<?php echo htmlentities($result->paperid);?>"><?php  echo htmlentities($result->papername); ?></a>
</td>
<td class="text-dark">
<small>
<b>Uploaded On :</b><br>
<?php
  // Selecting Date section starts here

  $uploaddate = htmlentities($result->uploaddate);
  $uploadmonth = htmlentities($result->uploadmonth);
  $uploadyear = htmlentities($result->uploadyear);
  $maindate =$uploaddate.' '.month($uploadmonth).' '.$uploadyear;


  echo $maindate;

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