<?php 
session_start();
error_reporting(0);

// $link = mysqli_connect("sql103.epizy.com", "epiz_27210191", "d1cMVcXvOSxtu6q", "epiz_27210191_iubat");

$link = mysqli_connect("localhost", "root", "", "iubat");
  

if(strlen($_SESSION['alogin'])=="")
    {    
        $authoremail = "";
    }
    else
    {  
      $authoremail = $_SESSION["email"];
    }

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$idstr=strval($_GET['id']);
 
$unpublished = $idstr[-1];


if (!empty($_GET['id'])) {
$id=intval($_GET['id']);

$sql = "SELECT * FROM paper WHERE id = '$id' and action=0 ";

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


// Accept Paper section starts Here
  
if(isset($_POST['accept-paper']))
{
    $id = $_POST['id'];
    $action = 1;

    $pdate = date('d');
    $pmonth = date('m');
    $pyear = date('Y');


    $sql="update paper set action=:action,pdate:pdate,pmonth:pmonth,pyear:pyear where id=:id and action!=1 ";

    $query = $dbh->prepare($sql);
    $query->bindParam(':action',$action,PDO::PARAM_STR);
    $query->bindParam(':pdate',$pdate,PDO::PARAM_STR);
    $query->bindParam(':pyear',$pyear,PDO::PARAM_STR);

    $query->bindParam(':id',$id,PDO::PARAM_STR);

    $query->execute();

    $results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{

echo "<script>alert('Paper accepted...');</script>";
header("refresh:0;url=unpublished-paper.php");
}else{
  
echo "<script>alert('Paper is already Accepted!');</script>";
header("refresh:0;url=unpublished-paper.php");

} 
}
// Accept Paper section ends here

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
    <title>Document</title>
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
         <a href="#"><p class="fontSize14px">Number of Co-Author: <?php echo htmlentities($result->numberofcoauthor);?></p></a>
            </div>
        
            <div class="d-flex justify-content-between">
            <p class="fontSize14px"><b>Email:</b> <?php echo $authormail;?></p>
            <p class="fontSize14px"><b>Co-Authors:</b>[<?php echo $cauname; ?>]</p>

            </div>

        <p style="font-size:14px"><?php echo $abstract ?></p>
        <hr >

 <div class="d-flex justify-content-between">
 <div>
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
 <div>
 <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepath ?> "target ="_blank" role="button"><?php echo $filename;  ?></a>
 </div>

 <div>
  <form method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">

<button  type="submit"  class="bg-light" name="accept-paper" onclick="return confirm('Are you sure you want accept this paper?');" style="border:none;color:green;margin-top:0px;"> Accept <i class="fas fa-check"></i></button>

</form>
 </div>
</div>

    <!-- DashBoard Section ends  -->

    </div>

<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>


<?php } else  {

    echo " Id is empty";
    } ?>