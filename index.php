<?php 
include('link/config.php');

$query = "SELECT COUNT(*) as total_rows FROM paper WHERE action=1";
$stmt = $dbh->prepare($query);

// execute query
$stmt->execute();

// get total rows
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_paper = $row['total_rows'];

?>
<!DOCTYPE html>  
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUBAT JOURNAL</title>
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?>

    <!-- Css links -->
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
   <div>
    <!-- Heading Sections starts  -->
    <?php 
    include 'heading.php';
    ?>
    <!-- Heading Sections ends  --> 
    </div>
    <div class="container text-dark">
    <div class="row pt-1">
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <!-- Top Heading section starts here -->
    <div class="text-left pb-4">
        <?php 
         include 'header.php';
        ?>
    </div> 
    <!-- Top Heading Section ends here  -->
    </div> 
    </div> 
 
    <div class="row">
    <!-- Sidebar section starts here  -->
    <div  class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
     <?php
     include 'sidelinks.php'; 
     ?>  
    </div>
    <!-- Sidebar Section ends here  -->
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left ">
    <p  id="content" class="pt-4">
    <b>Aim and Scope: </b>It aims to address the most important issues in the aforementioned fields. The journal can be of great value to teachers, students, researchers, and experts dealing with these fields
    </p>
    <!-- <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more">Read more...</span></a> -->
    </div>

     <hr class="bg-secondary" >
     <?php  if ($total_paper>0) { ?>
    <!-- Published paper Showing Section Starts Here  -->
    <table id="heading-table">
    <tbody>
    <?php $sql = "SELECT paper.id,paper.paperid,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.pdate from paper WHERE action=1 ";
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
 
      if($query->rowCount() > 0) 
      {
      foreach($results as $result)  
      { 
    $authoremail = htmlentities($result->authoremail); 
    $publishdatestring = htmlentities($result->pdate);
    $publishdate = date("d-M-Y",strtotime($publishdatestring));
     ?> 
    <!-- Select User name section starts here  -->
    <?php include 'link/selectauthorname.php'; ?>
    <!-- Select user  name section ends here  -->

    <!-- Dashboard section starts  --> 
    <tr> 
    <td>
    <div class="jumbotron  mb-0 bg-transparent"> 
  
    <form action="paper-download" class="indexform" method="post">
    <input type="hidden" name="paperidpublic" value="<?php echo htmlentities($result->paperid);?>">
    <button class="bg-transparent" style="font-size:17px;border:none;outline:none;font-weight:500;color:#17defe;text-align:left;" type="submit" name="paperdownload"><?php echo htmlentities($result->papername);?></button>
    </form>
    <h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
    <h5 class="text-dark" style="font-size:16px;"><?php echo $authorname;?></h5>

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
    <!-- Published paper showing section ends here  -->

    <?php  }  else { ?>

    <!-- Else Current Issue Paper Showing Section Showing  -->
<!--  Volume 1 Issue 3 Section Starts Here  -->
<table id="heading-table">
    <tbody>
    <?php 
    $V2018 = '2018';
    $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2018'";
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

    <?php }}  ?>
    </tbody>
    </table>
<!-- Volume 1 Issue 3 Section Ends Here -->
<?php  }  ?>
  <!-- Else Current Issue Paper Showing Section Showing  -->

    </div>
    </div>
    <div class="pb-3"></div>
    </div>

    <!-- Footer section starts here  -->
    <?php
    include 'footer.php';
    ?> 
    <!-- Footer section ends here  -->
   </div>
   </div>
    <!-- Loader image section starts here  -->
    <div class="loader-wrapper">
      <span class="loader"><img src="images/IUBAT-Logo-load.gif"></span></span>
    </div>
    <!-- Loader image section ends here  -->
    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->
   <script> 
        $(document).ready(function(){
        $("#heading-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#heading-table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    // Aim and scope readmore section starts here 
        document.querySelector('#read-more').addEventListener('click', function() {
        document.querySelector('#content').style.height= 'auto';
       this.style.display= 'none';
        });
    //   Aim and scope read more section ends here 
    </script>
  </body>
  </html>