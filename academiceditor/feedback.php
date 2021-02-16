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
      $email =  $_SESSION['alogin']; 
     // Check that the Associate Editor is logged in or not section starts here 

     $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact,author.academiceditor from author where primaryemail='$email' and academiceditor IS NOT NULL"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
 
// Check that the Associate Editor  is logged in or not section ends here 

 
     // Sending Review to the author section starts here 
if(isset($_POST['send-review']))
{
    $paperid = $_POST['paperid']; 
    $username = $_POST['username'];
    $primaryemailauthor = $_POST['primaryemailauthor'];
    
    $action = 1;
    $sql="update reviewertable set permits=$action where paperid='$paperid' and username='$username'";
    if(mysqli_query($link, $sql))
    {
              // Send Review Message Section Starts Here 
              include '../mailmessage/sendreview.php';
              // Send Review Message Section Ends Here 
    send_email($primaryemailauthor, $subject, $msg, $headers);
    echo "<script>alert('Send this Review to the author Successfully.');</script>";
      header("refresh:0;url=feedback");
    }
    else {
        echo "<script>alert('Already sent!');</script>";
        header("refresh:0;url=feedback");

    }
}
// Sending Review to the author section ends here 



    //  Remove as a Reviewer section starts Here 

    if(isset($_POST['reviewer-remove-feedback'])) {
      $paperid = $_POST['paperid'];
      $username = $_POST['username'];
      $filepathreviewer = $_POST['reviewpaperpath'];

      $action = 1;
      $action0=0;
      $feedback = NULL;
      $feedbackdate = NULL;
      $feedbackfile = NULL;
      $permits = NULL;
      $sqlremovereview="update reviewertable set feedback='$feedback',feedbackdate='$feedbackdate',feedbackfile='$feedbackfile',permits='$permits' where paperid='$paperid' and username='$username'";

      if(mysqli_query($link, $sqlremovereview))
      {
        unlink($filepathreviewer);
      echo "<script>alert('Feedback Removed Successfully for this paper.');</script>";
        header("refresh:0;url=feedback");
      }
      else {
          echo "<script>alert('Something went wrong');</script>";
          header("refresh:0;url=feedback");
      }
   

        }

        if(isset($_POST['editor-remove-feedback'])) {
            $paperid = $_POST['paperid'];
            $username = $_POST['username'];
      
            $action = 1;
            $action0=0;
            $feedback = NULL;
            $sqlremoveedit="update editortable set feedback='$feedback' where paperid='$paperid' and username='$username'";
      
            if(mysqli_query($link, $sqlremoveedit))
            {
            echo "<script>alert('Feedback Removed Successfully for this paper.');</script>";
              // header("refresh:0;url=reviewerdetails");
            }
            else {
                echo "<script>alert('Something went wrong');</script>";
                // header("refresh:0;url=reviewerdetails");
            }
         
      
              }
         // Remove as  a Reviewer Section Ends Here 

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
   <link rel="stylesheet" href="../css/admin-dashboard.css">
   <link rel="stylesheet" href="../css/index.css">
</head>
<body>


<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'header.php';
?> 
</div> 
<!-- Author showing header sections ends   -->


<div id="mySidebar" class="sidebar">
  <?php
  include 'sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

   <!-- --------------------------------------Reviewer Feedback Section -------------------------------------------------- -->
   <h6>REVIEWER FEEDBACK</h6>
  <hr class="bg-secondary" >
  <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm"> 
<table id="dtBasicExample" class="table table-striped table-bordered table-hover">

<thead>
        <tr>
            <th >#</th>
            <th >Paper id</th> 
            <th >Reviewer Name</th>
            <th >Feedback</th>
            <th>Date</th>
            <th >Actions</th>
        </tr> 
</thead> 

<tbody id="myTable-admin">
<?php $sql = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username,reviewertable.primaryemail,reviewertable.assigndate,reviewertable.action,reviewertable.feedback,reviewertable.feedbackfile,reviewertable.feedbackdate,reviewertable.permits from reviewertable where action IS NULL";
$query = $dbh->prepare($sql); 
$query->execute(); 
$results=$query->fetchAll(PDO::FETCH_OBJ); 
$cnt=1;
if($query->rowCount() > 0) 
{
foreach($results as $result)  
{  
  
  $feedbackfilename = htmlentities($result->feedbackfile);

  $feedbackfilepath = '../documents/review/'.$feedbackfilename;

  $paperid = htmlentities($result->paperid);
  $permits = htmlentities($result->permits);
  $feedbackdate = htmlentities($result->feedbackdate);
  $reviewertablemail = htmlentities($result->primaryemail);
  ?>


<tr>
<td><?php echo htmlentities($cnt);?></td><td class="result-color1"><?php echo htmlentities($result->paperid);?></td>

<?php 
      $username = htmlentities($result->username);
      $sql1 = "SELECT * FROM author WHERE  username='$username' ";

      $result1 = mysqli_query($link,$sql1); 

      $file1 = mysqli_fetch_assoc($result1);
      
      $title = $file1['title'];
      $fname= $file1['firstname'];
      $middlename= $file1['middlename']; 
      $lastname= $file1['lastname'];

      $authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

      $fdate = htmlentities($result->feedbackdate);

      $fddate = date("d-M-Y",strtotime($fdate ));

       
      // Selecting paperauthor email section starts here 
      $sqlpaper = "SELECT * FROM paper WHERE  paperid='$paperid' ";

      $resultpaper = mysqli_query($link,$sqlpaper ); 

      $filepaper = mysqli_fetch_assoc($resultpaper );

      $primaryemailauthor = $filepaper['authoremail'];

      
      // Selecting paperauthor email section ends here 

?>

            <td ><?php echo $authorname;?></td>
            <td ><?php
            
  // Reviewer Selection section starts here 
  $sqlreviewerupdate = "SELECT * from reviewertable WHERE  paperid='$paperid' and primaryemail='$reviewertablemail '";

  $resultreviewerupdate = mysqli_query($link,$sqlreviewerupdate);

  $filereviewerupdate = mysqli_fetch_assoc($resultreviewerupdate);

  $feedbackfile = $filereviewerupdate['feedbackfile']; 

  $feedbackfilepath = '../documents/review/'.$filereviewerupdate['feedbackfile'];

  $feedback =  unserialize($filereviewerupdate['feedback']);
  $feedbackdate = unserialize($filereviewerupdate['feedbackdate']);

  foreach ($feedback as $fd) {
    echo $fd.'<hr>';
  }


  // Reviewer Selection ends here 
      ?>
      <br>
            <a style="font-size:13px;" title="Reviewer Feedback File" class="" href="<?php echo $feedbackfilepath; ?> "target ="_blank" role="button"><?php echo $feedbackfilename;  ?></a>
     </td>

     <td>
      <?php 
     if (!empty($feedbackdate)) {
      echo date('d-M-Y',strtotime($feedbackdate[0]));
     }
      
      ?>
      </td>
 
<td> 

<form method="post">
<input type="hidden" name="paperid" value="<?php echo $paperid;?>">
<input type="hidden" name="username" value="<?php echo $username?>">
<input type="hidden" name="primaryemailauthor" value="<?php echo $primaryemailauthor;?>">
<input type="hidden" name="reviewpaperpath" value="<?php echo $feedbackfilepath;?>">

 
<?php
  if(!empty($feedbackdate))  { 

    if($permits==1) {
      echo "<small>Already sent</small>";
    }
  ?>
<div class="d-flex justify-content-between">
<div>
<input class=" btn btn-sm btn-info" title="send this review" onclick="return confirm('Are you sure you want to send this review to the author?');" style="font-size:15px;border:none;font-weight:600; background:transparent;" type="submit" name="send-review" value="✔️">
</div>

<div>
<input class="btn btn-sm btn-danger" title="remove this review" onclick="return confirm('Are you sure you want to remove review for this paper?');" style="border:none;font-weight:600;" type="submit" name="reviewer-remove-feedback" value="x">
</div>

</div>
<?php 
  }?>

</form>

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
       
    
    </tbody>


</table>

</div>
 <!-- --------------------------------------Reviewer Feedback Section -------------------------------------------------- -->

<div class="mb-5"></div>
</div>
</div>
<!-- Authors showing section ends here  -->


</div>

<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });

            $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });

            $(document).ready(function () {
            $('#dtBasicExample2').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });
            </script>

<!-- Essential Js,Jquery  section ends  -->


</body>
</html>



<?php 

}
else {
  echo "<script>alert('You are not a academiceditor.Try to log in as an Author');</script>";
  header("refresh:0;url=../login");
}


}


?>