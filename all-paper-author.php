<?php 
 session_start();
 error_reporting(0);
 
 include('link/config.php');
 
 if(strlen($_SESSION['alogin'])=="")
     {     
     header("Location: login.php"); 
     }
     else
     {  
         $authoremail = $_SESSION["email"];
 

?> 


<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUBAT</title>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body> 
   <div class="sticky-top mr-2 ml-2  pb-3">
    <!-- Heading Sections starts  -->
    <?php 
    include 'author-header.php';
    ?>
    <!-- Heading Sections ends  --> 
    </div>
    <div class="container">
   
 
    <table id="heading-table"> 
           <tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.numberofcoauthor,paper.abstract,paper.name,paper.type,paper.action,paper.pdate,paper.pmonth,paper.pyear,paper.uploaddate,paper.cauname1,paper.cauname2,paper.cauname3,paper.cauname4,paper.cauname5,paper.cauemail1,paper.cauemail2,paper.cauemail3,paper.cauemail4,paper.cauemail5,paper.caudept1,paper.caudept2,paper.caudept3,paper.caudept4,paper.caudept5,paper.cauinstute1,paper.cauinstute2,paper.cauinstute3,paper.cauinstute4,paper.cauinstute5,paper.cauaddress1,paper.cauaddress2,paper.cauaddress3,paper.cauaddress4,paper.cauaddress5 from paper where action=1"; 
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1;
      if($query->rowCount() > 0) 
      {
      foreach($results as $result)  
      {   ?>

<!-- Select User name section starts here  -->
<?php  

// $link = mysqli_connect("localhost", "root", "", "iubat");

$link = mysqli_connect("sql103.epizy.com", "epiz_27210191", "d1cMVcXvOSxtu6q", "epiz_27210191_iubat");
  

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
            <div class="jumbotron  mb-0" >
            <h5 style="font-size:16px;"><?php echo htmlentities($result->papername);?></h5>

            <h6 style="font-size:14px;"><?php echo $authorname ?></h6>
            <h6 style="font-size:14px;"><?php echo htmlentities($result->authoremail);?></h6>
            <p style="font-size:13px;"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>
            <hr class="my-4">
            <div class="pb-3">
            <a style="font-size:13px;" class="btn btn-success btn-sm" href="paper-download.php?id=<?php echo htmlentities($result->id);?>" role="button">Download</a> 
            <a style="font-size:13px;" class="btn btn-success btn-sm float-right" href="see-more-public.php?id=<?php echo htmlentities($result->id);?>" role="button">See More</a> 
      </div>
        </td>
           </div>
           </tr>
          
      

       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
    </table>
    </div>
<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>

      <?php } ?>