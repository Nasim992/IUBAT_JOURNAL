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
   <div class="sticky-top">
    <!-- Heading Sections starts  -->
    <?php 
    include 'author-header.php'
    ?>
    <!-- Heading Sections ends  --> 
    </div>
    <div class="container">
   
 
    <table id="heading-table"> 
           <tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action from paper where action=1"; 
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1;
      if($query->rowCount() > 0) 
      {
      foreach($results as $result) 
      {   ?>

          <!-- Dashboard section starts  -->
      
            <tr>
            <td>
            <div class="jumbotron  mb-0" >
            <h5 class="display-4"><?php echo htmlentities($result->papername);?></h5>
            <p ><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>
            <hr class="my-4">
            <div class="pb-3">
            <a class="btn btn-success btn-sm" href="paper-download.php?id=<?php echo htmlentities($result->id);?>" role="button">Download as PDF</a> 
            <a class="btn btn-success btn-sm float-right" href="see-more-public.php?id=<?php echo htmlentities($result->id);?>" role="button">See More...</a> 
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