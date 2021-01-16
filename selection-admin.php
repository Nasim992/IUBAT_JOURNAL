<?php 
session_start();
error_reporting(0);

include 'link/linklocal.php';

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php"); 
    } 
    else
    {  

    // Check that the admin is logged in or not section starts here 
     $adminemail = $_SESSION["email"];

     $sqladmin = "SELECT admin.id,admin.username,admin.fullname,admin.password,admin.email,admin.contact from admin where email='$adminemail'"; 

     if(mysqli_query($link, $sqladmin))
    {
     
     // Check that the admin is logged in or not section ends here 



if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Paper description showing section starts here 

$idstr=strval($_GET['id']);
 
$unpublished = $idstr[-1];

$id=intval($_GET['id']);

if (!empty($_GET['id'])) {
$id=intval($_GET['id']);

$sql = "SELECT * FROM paper WHERE id = '$id' and action=0";

$result = mysqli_query($link,$sql);

$file = mysqli_fetch_assoc($result);

$filename = $file['name'];
 
$papername = $file['papername'];
$abstract = $file['abstract'];
$authormail = $file['authoremail'];
$filepath = 'documents/'.$file['name'];
$numberofcoauthor = $file['numberofcoauthor'];
$type = $file['type'];
$uploaddate = $file['uploaddate'];
$cauname1 = $file['cauname1'];
$cauname2 = $file['cauname2'];
$cauname3 = $file['cauname3'];
$cauname4 = $file['cauname4'];
$cauname5 = $file['cauname5'];

$cauname = $cauname1.' '.$cauname2.' '.$cauname3.' '.$cauname4.' '.$cauname5;



$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authormail' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

// Paper description showing section ends here 


// Accept Paper section starts Here
 
if(isset($_POST['accept-paper']))
{
    $id = $_POST['id'];
    $action = 1;

    $pdate = date('d');
    $pmonth = date('m');
    $pyear = date('Y');

    $sql="update paper set action=$action,pdate=$pdate,pmonth=$pmonth,pyear=$pyear where id=$id ";

    if(mysqli_query($link, $sql))
    {
    echo "<script>alert('Paper accepted...');</script>";
      header("refresh:0;url=unpublished-paper");
    }
    else {
        echo "<script>alert('Paper is already Accepted!');</script>";
        header("refresh:0;url=unpublished-paper");

    }
}
// Accept Paper section ends here

// Reviewer Selection Section starts here 
if(isset($_POST['select-reviewer']))
{

    $usernameauthor = $_POST['authornameselect']; 
    // echo $usernameauthor;
    $sqlauthorselect = "SELECT primaryemail FROM author WHERE username = '$usernameauthor'";
    $resultauthorselect = mysqli_query($link,$sqlauthorselect);
    $fileauthorselect = mysqli_fetch_assoc($resultauthorselect);
    $primaryemail = $fileauthorselect['primaryemail'];

    $assigndate = date('d');
    $assignmonth = date('m');
    $assignyear = date('Y');

    $sqlinsert="INSERT INTO reviewertable (paperid,username,primaryemail,assigndate,assignmonth,assignyear) VALUES('$id','$usernameauthor','$primaryemail','$assigndate','$assignmonth','$assignyear')";

    $reviewerselection =1;
    $sqlupdatereviewer = "update author set reviewerselection=$reviewerselection where username = '$usernameauthor' ";

    if(mysqli_query($link, $sqlinsert) and (mysqli_query($link, $sqlupdatereviewer)))
    {
    echo "<script>alert('Reviewer Selected Successfully for this paper');</script>";
    //   header("refresh:0;url=unpublished-paper.php");
    }
    else {
        echo "<script>alert('Something Went Wrong');</script>";
        // header("refresh:0;url=unpublished-paper.php");


    }

    
}
// Reviewer Selection Section Ends Here 

// Editor Selection section starts here 
if(isset($_POST['select-editor']))
{

    $usernameauthor = $_POST['authornameselect']; 
    // echo $usernameauthor;
    $sqlauthorselect = "SELECT primaryemail FROM author WHERE username = '$usernameauthor'";
    $resultauthorselect = mysqli_query($link,$sqlauthorselect);
    $fileauthorselect = mysqli_fetch_assoc($resultauthorselect);
    $primaryemail = $fileauthorselect['primaryemail']; 

    $assigndate = date('d');
    $assignmonth = date('m');
    $assignyear = date('Y');

    $sqlinsert="INSERT INTO editortable (paperid,username,primaryemail,assigndate,assignmonth,assignyear) VALUES('$id','$usernameauthor','$primaryemail','$assigndate','$assignmonth','$assignyear')";

    $editorselection =1;
    $sqlupdateeditor = "update author set editorselection=$editorselection where username = '$usernameauthor' ";


    if(mysqli_query($link, $sqlinsert) and (mysqli_query($link, $sqlupdateeditor)))
    {
    echo "<script>alert('Editor Selected Successfully for this paper');</script>";
    //   header("refresh:0;url=unpublished-paper.php");
    }
    else {
        echo "<script>alert('Something Went Wrong');</script>";
        // header("refresh:0;url=unpublished-paper.php");


    }

    
}
// Editor selection section ends here 

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css">
    <title>Selection Admin</title>
    <style>
        button[type="submit"]:hover {
         background-color:none !important;
     }
    </style>
</head> 
<body>
<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'admin-header.php';
?> 
</div> 
<!-- Author showing header sections ends   -->

<div id="mySidebar" class="sidebar mt-3">
  <?php
  include 'admin-sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

  <h4>UNPUBLISHED PAPER</h4>
  <hr class="bg-secondary" >

  <div class="jumbotron">
     
     <h5 style="font-size:18px" class="display-4">Name : <?php echo $papername ?></h5>
     <h6 style="font-size:15px;" class="display-5">Uploaded on:<span style='color:#122916;'> <small><?php echo $uploaddate ?></small></span></h6>

   <div class="d-flex justify-content-between">
         <p class="fontSize14px"><b>Author:</b> <?php echo $authorname ?></p>
      <a href="#"><p class="fontSize14px">Number of Co-Author:0 <?php echo htmlentities($result->numberofcoauthor);?></p></a>
         </div>
     
         <div class="d-flex justify-content-between">
         <p class="fontSize14px"><b>Email:</b> <?php echo $authormail;?></p>
         <p class="fontSize14px"><b>Co-Authors:</b>[<?php echo $cauname; ?>]</p>
         </div>
         <div class="d-flex justify-content-between">

         <div>
         <h6 style="font-size:15px;" class="display-5">Reviewer:<span style='color:#122916;'> <small>
         <?php
     include('link/config.php');
     $sql = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username from reviewertable Where paperid='$id'";
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     $arrayusernamereviewershowing = array();
     foreach($results as $result) 
     { 

         $usernamereviewer = htmlentities($result->username);
         array_push($arrayusernamereviewershowing,$usernamereviewer);
     }}

                    foreach( $arrayusernamereviewershowing  as $arrpap){
                     $sqlnameeditorr = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrpap'";
                     $resultnameeditorr = mysqli_query($link,$sqlnameeditorr);
                     $filenameeditorr = mysqli_fetch_assoc($resultnameeditorr);
                     $fullname =  $filenameeditorr['title'].$filenameeditorr['firstname'].' '.$filenameeditorr['middlename'].' '.$filenameeditorr['lastname'];
                     echo $fullname.' ';
                   }
     ?>
         
         </small></span></h6>
         </div>
         <div>
         <h6 style="font-size:15px;" class="display-5">Editor:<span style='color:#122916;'> <small>
         <?php
     include('link/config.php');
     $sql = "SELECT editortable.id,editortable.paperid,editortable.username from editortable Where paperid='$id'";
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     $arrayusernameeditorshowing = array();
     if($query->rowCount() > 0) 
     {
     foreach($results as $result) 
     { 
     $usernameeditor = htmlentities($result->username);
     array_push($arrayusernameeditorshowing,$usernameeditor);
     }}

             foreach( $arrayusernameeditorshowing  as $arrpap){
               $sqlnameeditorp = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrpap'";
               $resultnameeditorp = mysqli_query($link,$sqlnameeditorp);
               $filenameeditorp = mysqli_fetch_assoc($resultnameeditorp);
               $fullname =  $filenameeditorp['title'].$filenameeditorp['firstname'].' '.$filenameeditorp['middlename'].' '.$filenameeditorp['lastname'];
               echo $fullname.' ';
             }
     ?>
         
         </small></span></h6>
         </div>

         </div>

     <p style="font-size:14px"><?php echo $abstract ?></p>
     <hr >

<div class="row">

<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Reviewer Feedback:0</a>
</div>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Editor Feedback:0</a>
</div>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Status:<span class="text-success">Satisfactory</span></a>
</div>
<br>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepath ?> "target ="_blank" role="button"><?php echo $filename;  ?></a>
</div>

<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<form method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">

<button  type="submit"  class="bg-light" name="accept-paper" onclick="return confirm('Are you sure you want accept this paper?');" style="border:none;color:green;margin-top:0px;"> Accept <i class="fas fa-check"></i></button>
</form>
</div>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<form method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">

<button  type="submit"  class="bg-light" name="reject-paper" onclick="return confirm('Are you sure you want Reject this paper?');" style="border:none;color:red;margin-top:0px;"> Reject <i class="fas fa-ban"></i></button>
</form>
</div>

<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a href="delete-paper.php?id=<?php echo $id; ?>&name=<?php echo $filepath; ?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>
</div> 

</div>
<hr class="bg-success">
 <!-- DashBoard Section ends  -->
 <div class="row">
 <!-- Feedback Shown Section starts here  -->
 <div style="border-right:3px solid #000b2073;" class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
 <h3 style="font-size:17px" class="text-dark "><b><i>Feedback Section</i></b></h3>
  <hr class="bg-success">

  <?php
  include('link/config.php');
     $sqlreviewertable = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username,reviewertable.feedback from reviewertable Where paperid='$id'";
     $querytable = $dbh->prepare($sqlreviewertable); 
     $querytable->execute(); 
     $resultreviewertable=$querytable->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if( $querytable->rowCount() > 0) 
     {
     foreach($resultreviewertable as $result) 
     { 

        $feedback =   htmlentities($result->feedback);
        $feedbackauthor =   htmlentities($result->username);


      $authoremail = htmlentities($result->authoremail);
      $sql1 = "SELECT * FROM author WHERE  username= '$feedbackauthor' ";

      $result1 = mysqli_query($link,$sql1); 

      $file1 = mysqli_fetch_assoc($result1);
      
      $title = $file1['title'];
      $fname= $file1['firstname'];
      $middlename= $file1['middlename'];
      $lastname= $file1['lastname'];

      $authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;
  ?>
  <div style="border:2px solid #e3e3e3;  padding:10px;margin-top:5px;border-radius:10px;">
  <p><?php echo $feedback ?></p>
  <div class="d-flex justify-content-between">
<div>

        </div>
        <div>
        <p><small><b> - &nbsp<?php echo $authorname; ?></b></small></p>
        </div>
          </div>
       
          </div>

<?php   }}  ?>

 </div>
 <!-- Feedback Shown Section ends Here  -->
 <!-- Selecting Editor Reviewer Selection section starts here  -->
 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
  <div class="row">
  <!-- Reviewer Selection starts Here  -->
  <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
  <h3 style="font-size:17px" class="text-dark "><b><i>Select Reviewer of this paper</i></b></h3>
  <hr class="bg-success">

  <?php
  $sqlreviewer = "SELECT username FROM author";
  $resultreviewer = mysqli_query($link,$sqlreviewer);
  $filereviewer = mysqli_fetch_assoc($resultreviewer);

   $arrayusernamebeginreviewer = array();

  foreach($resultreviewer as $filerev) {
      array_push($arrayusernamebeginreviewer,$filerev['username']);
  }

     function findMissingrev( $a, $b, $n, $m) 
     { 
       $arrayusernameeditors = array();
         for ( $i = 0; $i < $n; $i++) 
         { 
             $j; 
             for ($j = 0; $j < $m; $j++) 
                 if ($a[$i] == $b[$j]) 
                     break; 
       
             if ($j == $m){
                array_push($arrayusernameeditors,$a[$i]);
             }
         }

         $selection = 0;
         include 'link/linklocal.php';
         foreach($arrayusernameeditors as $arrname){
             $sqlnameeditor = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrname'";
             $resultnameeditor = mysqli_query($link,$sqlnameeditor);
             $filenameeditor = mysqli_fetch_assoc($resultnameeditor);
             $fullname =  $filenameeditor['title'].$filenameeditor['firstname'].' '.$filenameeditor['middlename'].' '.$filename['lastname'];
     
             ?>
           <form  method="post">
           <div class="row">
           <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
           <label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $selection+1 ?>.<span><?php echo $fullname ?></b></span></label>
             <input type="hidden" id="custId" name="authornameselect" value="<?php echo $arrname ?>">
           </div>
           <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
             <button style="font-size:10px;" onclick="return confirm('Send Review Request to this author?');" class="btn btn-sm btn-secondary form-control mt-0" type="submit" name="select-reviewer"><b>Select</b></button>
             </div>
           </div>
             </form>
             <?php 
             $selection = $selection +1;   
             }
           } 
         $n = count($arrayusernamebeginreviewer); 
         $m = count($arrayusernamereviewershowing); 
         findMissingrev($arrayusernamebeginreviewer, $arrayusernamereviewershowing, $n, $m); 
           ?>
  </div>
  <!-- Reviewer Selection section ends here -->


 <!-- Editor Selection starts Here  -->
 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

 <h3 style="font-size:17px" class="text-dark "><b><i>Select Editor of this paper</i></b></h3>
  <hr class="bg-success">

  <?php
  $sqlreviewer = "SELECT username FROM author";
  $resultreviewer = mysqli_query($link,$sqlreviewer);
  $filereviewer = mysqli_fetch_assoc($resultreviewer);

   $arrayusernamebegineditor = array();

  foreach($resultreviewer as $filerev) {
      array_push($arrayusernamebegineditor,$filerev['username']);
  }

     function findMissing( $a, $b, $n, $m) 
     { 
       $arrayusernameeditors = array();
         for ( $i = 0; $i < $n; $i++) 
         { 
             $j; 
             for ($j = 0; $j < $m; $j++) 
                 if ($a[$i] == $b[$j]) 
                     break; 
       
             if ($j == $m){
                array_push($arrayusernameeditors,$a[$i]);
             }
         }

         $selection = 0;
         
         include 'link/linklocal.php';

         foreach($arrayusernameeditors as $arrname){
           // echo $arrname;
             $sqlnameeditor = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrname'";
             $resultnameeditor = mysqli_query($link,$sqlnameeditor);
             $filenameeditor = mysqli_fetch_assoc($resultnameeditor);
             $fullname =  $filenameeditor['title'].$filenameeditor['firstname'].' '.$filenameeditor['middlename'].' '.$filename['lastname'];
             // echo $fullname;
             // echo $arrnamee;
             ?>
           <form  method="post">
           <div class="row">
           <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
           <label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $selection+1 ?>.<span><?php echo $fullname ?></b></span></label>
             <input type="hidden" id="custId" name="authornameselect" value="<?php echo $arrname ?>">
           </div>
           <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
             <button style="font-size:10px;" onclick="return confirm('Send Review Request to this author?');" class="btn btn-sm btn-secondary form-control mt-0" type="submit" name="select-editor"><b>Select</b></button>
             </div>
           </div>
             </form>
             <?php 
             $selection = $selection +1;   
             }
           } 
         $n = count($arrayusernamebegineditor); 
         $m = count($arrayusernameeditorshowing); 
         findMissing($arrayusernamebegineditor, $arrayusernameeditorshowing, $n, $m); 
           ?>
  </div>
  <!-- Editor Selection section ends here -->
  </div>
</div>
 <!-- Selecting Editor Reviewer Selection section ends here  -->

 </div>


    <div class="pb-5"></div>

    </div>
    </div>

<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>


<?php } else  {

echo "<script>alert('You are trying with wrong direction');</script>";
header("refresh:0;url=unpublished-paper.php");
    } 
    
 

}
else {
  echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
  header("refresh:0;url=login.php");
}

}
  
    ?>