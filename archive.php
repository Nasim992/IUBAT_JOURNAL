<?php 
 include('link/config.php'); 
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive</title>
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?> 
    <!-- Css links -->
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
    <style>
          .indexform button{
           padding:0 !important;
           margin:0 !important;
        }
        .indexform button:hover{
            color:#0b4953 !important;
        }
    </style>
</head> 
<body> 
<div class="content">
<div class=>
    <!-- Heading Sections starts  -->
    <?php 
    include 'heading.php'
    ?>
    <!-- Heading Sections ends  --> 
    </div>
 
    <div class="container">
    <div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
    <?php include "header.php"; ?>
    </div>
    </div> 
    </div>
 
    <div class="row">
    <!-- Sidebar section starts here  -->
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

<?php include "sidelinks.php"  ?>

    </div>
    <!-- Sidebar Section ends here  -->
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
        <h5 class="text-center">ARCHIVE</h5>
        <hr class="bg-secondary">
        <!-- Archive  -->
 
<!--  Volume 1 Issue 3 Section Starts Here  -->
<h6 class="text-info">VOLUME 1 ISSUE 3 </h6>
 <hr>
<table id="heading-table">
    <tbody>
    <?php 
    $V2016 = '2018';
    $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2016'";
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
 
      if($query->rowCount() > 0) 
      {
      foreach($results as $result)  
      {  
          $filepathname = htmlentities($result->filename);
          $filepath = 'documents/archivefile/'.$filepathname;

    $publishdatestring = htmlentities($result->publisheddate);
    $publishdate = date("Y",strtotime($publishdatestring));
     ?> 

    <!-- Dashboard section starts  --> 
    <tr> 
    <td>
    <div class="jumbotron  mb-0 bg-transparent">

    <a class="bg-transparent" style="font-size:17px;border:none;outline:none;font-weight:500;color:#17defe;text-align:left;"><?php echo htmlentities($result->papername);?></a>

    <div class="d-flex justify-content-between">
<div>
<h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
</div>
<div>
<a style="font-size:14px;" class="btn btn-info btn-sm" href="<?php echo $filepath ?> "target ="_blank" role="button">Download</a>
</div>
    </div>
    <h5 class="text-dark" style="font-size:16px;"><?php echo htmlentities($result->authorname);?></h5>

    <p id="paper-abstract<?php echo htmlentities($result->id);?>" style="font-size:14px;height: 6.0em;overflow: hidden;width:auto;"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>
    <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
   <!--Individual Read More section starts here   -->
    <script>
    document.querySelector('#read-more-abstract<?php echo htmlentities($result->id);?>').addEventListener('click', function() {
    document.querySelector('#paper-abstract<?php echo htmlentities($result->id);?>').style.height= 'auto';
        this.style.display= 'none';
        });
            </script>
      <!-- Individual Read More section ends here  -->
      <hr>
            </td>
           </div>
           </tr>
       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
    </table>
<!-- Volume 1 Issue 3 Section Ends Here -->

<!--  Volume 1 Issue 2 Section Starts Here  -->
<h6 class="text-info">VOLUME 2 ISSUE 2 </h6>
 <hr>
<table id="heading-table">
    <tbody>
    <?php 
    $V2016 = '2017';
    $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2016'";
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
 
      if($query->rowCount() > 0) 
      {
      foreach($results as $result)  
      {  
          $filepathname = htmlentities($result->filename);
          $filepath = 'documents/archivefile/'.$filepathname;

    $publishdatestring = htmlentities($result->publisheddate);
    $publishdate = date("Y",strtotime($publishdatestring));
     ?> 

    <!-- Dashboard section starts  --> 
    <tr> 
    <td>
    <div class="jumbotron  mb-0 bg-transparent">

    <a class="bg-transparent" style="font-size:17px;border:none;outline:none;font-weight:500;color:#17defe;text-align:left;"><?php echo htmlentities($result->papername);?></a>

    <div class="d-flex justify-content-between">
<div>
<h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
</div>
<div>
<a style="font-size:14px;" class="btn btn-info btn-sm" href="<?php echo $filepath ?> "target ="_blank" role="button">Download</a>
</div>
    </div>
    <h5 class="text-dark" style="font-size:16px;"><?php echo htmlentities($result->authorname);?></h5>

    <p id="paper-abstract<?php echo htmlentities($result->id);?>" style="font-size:14px;height: 6.0em;overflow: hidden;width:auto;"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>
    <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
   <!--Individual Read More section starts here   -->
    <script>
    document.querySelector('#read-more-abstract<?php echo htmlentities($result->id);?>').addEventListener('click', function() {
    document.querySelector('#paper-abstract<?php echo htmlentities($result->id);?>').style.height= 'auto';
        this.style.display= 'none';
        });
            </script>
      <!-- Individual Read More section ends here  -->
      <hr>
            </td>
           </div>
           </tr>
       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
    </table>
<!-- Volume 1 Issue 2 Section Ends Here -->

<!--  Volume 1 Issue 1 Section Starts Here  -->
 <h6 class="text-info">VOLUME 1 ISSUE 1 </h6>
 <hr>
<table id="heading-table">
    <tbody>
    <?php 
    $V2016 = '2016';
    $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2016'";
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
 
      if($query->rowCount() > 0) 
      {
      foreach($results as $result)  
      {  
          $filepathname = htmlentities($result->filename);
          $filepath = 'documents/archivefile/'.$filepathname;

    $publishdatestring = htmlentities($result->publisheddate);
    $publishdate = date("Y",strtotime($publishdatestring));
     ?> 

    <!-- Dashboard section starts  --> 
    <tr> 
    <td>
    <div class="jumbotron  mb-0 bg-transparent">

    <a class="bg-transparent" style="font-size:17px;border:none;outline:none;font-weight:500;color:#17defe;text-align:left;"><?php echo htmlentities($result->papername);?></a>
    <div class="d-flex justify-content-between">
<div>
<h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
</div>
<div>
<a style="font-size:14px;" class="btn btn-info btn-sm" href="<?php echo $filepath ?> "target ="_blank" role="button">Download</a>
</div>
    </div>

    <h5 class="text-dark" style="font-size:16px;"><?php echo htmlentities($result->authorname);?></h5>

    <p id="paper-abstract<?php echo htmlentities($result->id);?>" style="font-size:14px;height: 6.0em;overflow: hidden;width:auto;"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>
    <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
   <!--Individual Read More section starts here   -->
    <script>
    document.querySelector('#read-more-abstract<?php echo htmlentities($result->id);?>').addEventListener('click', function() {
    document.querySelector('#paper-abstract<?php echo htmlentities($result->id);?>').style.height= 'auto';
        this.style.display= 'none';
        });
            </script>
      <!-- Individual Read More section ends here  -->
      <hr>
            </td>
           </div>
           </tr>
       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
    </table>
<!-- Volume 1 Issue 1 Section Ends Here -->
<hr class="bg-secondary">


        <!-- Archive  -->
    </p>
    </div>

    </div>
    </div>
</div>
    <!-- Footer section starts here  -->
    <?php
    include 'footer.php'
    ?>
    <!-- Footer section ends here  -->
        <!-- Loader image section starts here  -->
        <div class="loader-wrapper">
      <span class="loader"><img src="images/IUBAT-Logo-load.gif"></span></span>
    </div>
    <!-- Loader image section ends here  -->
</div>
<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>