<?php 
session_start();
error_reporting(0);

// $link = mysqli_connect("sql103.epizy.com", "epiz_27210191", "d1cMVcXvOSxtu6q", "epiz_27210191_iubat");

$link = mysqli_connect("localhost", "root", "", "iubat");
   
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
      header("refresh:0;url=unpublished-paper.php");
    }
    else {
        echo "<script>alert('Paper is already Accepted!');</script>";
        header("refresh:0;url=unpublished-paper.php");

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

    if(mysqli_query($link, $sqlinsert))
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

    if(mysqli_query($link, $sqlinsert))
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
<div class="container">
   <!-- Dashboard section starts  --> 
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
        foreach($results as $result) 
        { 
        ?>
        <?php echo htmlentities($result->username);?>
        <?php 
        }}
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
        if($query->rowCount() > 0) 
        {
        foreach($results as $result) 
        { 
        ?>
        <?php echo htmlentities($result->username);?>
        <?php 
        }}
        ?>
            
            </small></span></h6>
            </div>

            </div>

        <p style="font-size:14px"><?php echo $abstract ?></p>
        <hr >

 <div class="row">
 <div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
 <?php if($unpublished == 'u') {
     ?>
     <a style="font-size:13px;" href="unpublished-paper.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>

     <?php  
    }
    else {
     ?>
     <a style="font-size:13px;" href="admin-dashboard.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>

    <?php } ?>
 </div>
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
    //  echo $filereviewer;

    $arrayusername = array();

     foreach($resultreviewer as $filerev) {
         array_push($arrayusername,$filerev['username']);
     }

    //  foreach($arrayusername as $arr) {
    //      echo $arr;
    //  }

    $sqlpaper = "SELECT paperid,username FROM reviewertable";
    $resultpaper = mysqli_query($link,$sqlpaper);
    $filepaper = mysqli_fetch_assoc($resultpaper);

    if(!empty($filepaper)) {
    //    echo $filepaper['paperid'];
    //    echo $filepaper['username'];
            $selection = 0;
            foreach($arrayusername as $arrname){
                $sqlname = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrname'";
                $resultname = mysqli_query($link,$sqlname);
                $filename = mysqli_fetch_assoc($resultname);
                $fullname =  $filename['title'].$filename['firstname'].' '.$filename['middlename'].' '.$filename['lastname'];

                // $flag = 0;
                // foreach($filepaper as $filepap) {
                //     if($id==$filepap['paperid'] && $filepap['username']==$arrname)
                //         $flag = 1;
                //     else 
                //         $flag=0;
                //     echo $filepap['paperid'];
                //     echo $filepap['username'];
                // }
              
              
                // echo $id;
                // echo $flag;
        

                ?>
 <form  method="post">

<div class="row">
<div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
<label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $selection ?>.<span><?php echo $fullname ?></b></span></label>
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
    else {
        $selection = 0;
        foreach($arrayusername as $arrname){
            $sqlname = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrname'";
            $resultname = mysqli_query($link,$sqlname);
            $filename = mysqli_fetch_assoc($resultname);
            $fullname =  $filename['title'].$filename['firstname'].' '.$filename['middlename'].' '.$filename['lastname'];
        ?> 
  <form  method="post">

<div class="row">
<div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
<label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $selection ?>.<span><?php echo $fullname ?></b></span></label>
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
    //  echo $filereviewer;

    $arrayusername = array();

     foreach($resultreviewer as $filerev) {
         array_push($arrayusername,$filerev['username']);
     }

    //  foreach($arrayusername as $arr) {
    //      echo $arr;
    //  }

    $sqlpaper = "SELECT paperid,username FROM reviewertable";
    $resultpaper = mysqli_query($link,$sqlpaper);
    $filepaper = mysqli_fetch_assoc($resultpaper);

    if(!empty($filepaper)) {
    //    echo $filepaper['paperid'];
    //    echo $filepaper['username'];
            $selection = 0;
            foreach($arrayusername as $arrname){
                $sqlname = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrname'";
                $resultname = mysqli_query($link,$sqlname);
                $filename = mysqli_fetch_assoc($resultname);
                $fullname =  $filename['title'].$filename['firstname'].' '.$filename['middlename'].' '.$filename['lastname'];

                // $flag = 0;
                // foreach($filepaper as $filepap) {
                //     if($id==$filepap['paperid'] && $filepap['username']==$arrname)
                //         $flag = 1;
                //     else 
                //         $flag=0;
                //     echo $filepap['paperid'];
                //     echo $filepap['username'];
                // }
              
              
                // echo $id;
                // echo $flag;
        

                ?>
 <form  method="post">

<div class="row">
<div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
<label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $selection ?>.<span><?php echo $fullname ?></b></span></label>
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
    else {
        $selection = 0;
        foreach($arrayusername as $arrname){
            $sqlname = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrname'";
            $resultname = mysqli_query($link,$sqlname);
            $filename = mysqli_fetch_assoc($resultname);
            $fullname =  $filename['title'].$filename['firstname'].' '.$filename['middlename'].' '.$filename['lastname'];
        ?> 
  <form  method="post">

<div class="row">
<div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
<label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $selection ?>.<span><?php echo $fullname ?></b></span></label>
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
     ?>
     </div>
     <!-- Editor Selection section ends here -->
     </div>
   </div>
    <!-- Selecting Editor Reviewer Selection section ends here  -->

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