<?php 
  include('link/config.php');
    // Total published paper count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action=1";
    $stmt = $dbh->prepare($query);
    // execute query
    $stmt->execute(); 
    // get total rows
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_published = $row['total_rows'];
    // Total published paper count section ends here

    // Maximum VersionIssue Section Starts Here 
    $query = "SELECT MAX(versionissue) as total_rows FROM archive";
    $stmt = $dbh->prepare($query);
    $stmt->execute(); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $maximumyear = $row['total_rows'];
    // Maximum VersionIssue Section Ends Here
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
          @media only screen and (max-width: 992px) {
            .leftrightpadding{
              padding:0px 10px 0px 10px !important;
            }
          }
          .leftrightpadding{
            padding:0px 30px 0px 30px;
          }
    </style>
</head>  
<body style="text-align:justify;">  
        <div>
        <!-- Heading Sections starts  -->
        <?php  
        include 'heading.php';
        ?>
        <!-- Heading Sections ends  --> 
        </div>
  <div class="leftrightpadding text-dark">
    
   <!-- Top Heading section starts here -->
    <div class="row pt-1">
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
        </div>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
          <div class="text-left pb-2">
          <?php 
          include 'header.php';
          ?>
          <div>
     </div>
     </div> 
    </div>  
    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
    </div>
    </div> 
    <!-- Top Heading Section ends here  -->
    <div class="row">
    <!--  Journal Image Showing section starts here -->
    <div class="col-sm-12 col-md-12 col-xl-4 col-lg-4">
    <img src="images/ijournal_img.jpg" class="img-fluid img-thumbnail w-100 " alt="Journal Image">
    <div   style="font-size:14px; text-align:justify;" class="p-1">
    <p>The IUBAT Review is a multidisciplinary academic journal that the editors intend to publish annually. The office of the journal is located at the International University of Business Agriculture and Technology, the first non-government university in Bangladesh.<p>
    <p>IUBAT Review is peer-reviewed. The editors accept submissions from authors in Bangladesh and elsewhere. The articles should generally analyze current issues relevant to management, social sciences, engineering, agriculture, science and technology.</p>
    
    <!-- Recently Published paper Section Starts Here  -->
    <div class="card bg-light mb-3 w-100 h-25" style="text-left">
   <div class="card-header">RECENTLY PUBLISHED</div>
   <div class="card-body">

   <?php  if ($total_published>0) { ?>
    <!-- Published paper Showing Section Starts Here  -->

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
  
    <form action="paper-download" class="indexform" method="post">
    <input type="hidden" name="paperidpublic" value="<?php echo htmlentities($result->paperid);?>">
    <button class="bg-transparent" style="border:none;outline:none;font-weight:500;color:#17defe;text-align:left;" type="submit" name="paperdownload"><?php echo htmlentities($result->papername);?></button>
    </form>
    <h5 class="text-primary" style="font-size:16px;"><small><i class="fa fa-calendar" aria-hidden="true"></i> Published on <?php echo $publishdate;?></small></h5>

   <!--Individual Read More section starts here   -->
    <script>
    document.querySelector('#read-more-abstract<?php echo htmlentities($result->id);?>').addEventListener('click', function() {
    document.querySelector('#paper-abstract<?php echo htmlentities($result->id);?>').style.height= 'auto';
        this.style.display= 'none';
        });
            </script>
      <!-- Individual Read More section ends here  -->
      <hr>
      
       <!-- DashBoard Section ends  -->
    <?php }} ?>
    <!-- Published paper showing section ends here  -->
    </div>
    </div>
    <?php  }  else { ?>
    <?php 
    $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$maximumyear' ";
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
 
    <a class="bg-transparent" href="<?php echo $filepath ?> " target ="_blank" style="font-size:17px;border:none;outline:none;font-weight:500;text-align:left;"><?php echo htmlentities($result->papername);?></a>
    <h5 class="text-dark" style="font-size:16px;"><small> <i class="fa fa-calendar" aria-hidden="true"></i> Published on <?php echo $publishdate;?></small></h5>
    <div class="d-flex justify-content-between">
<div>
</div>
<div>
<!-- <a style="font-size:14px;" class="btn btn-info btn-sm" href="<?php echo $filepath ?> "target ="_blank" role="button">Download</a> -->
</div>
   <!--Individual Read More section starts here   -->
           </div>
           </tr>

    <?php }}  ?>

    </div>
   </div>
   <?php  }  ?>
    <!-- Recently Published paper Section Ends Here  -->

    </div>
    </div>
    <!-- Journal Image Showing Section ends here here  -->

    <!-- paper showing section starts here  -->
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
    <div class="text-left ">
    </div>
     <hr class="bg-secondary" >
    <!-- Else Current Issue Paper Showing Section Showing  -->

    <!--  Latest Archive Section starts Here  -->
    <table id="heading-table">
    <tbody>
    <?php 
    $maximumyeardec=$maximumyear-1;
    $maximumyeardec2=$maximumyear-2;
    $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$maximumyear' or versionissue='$maximumyeardec' or versionissue='$maximumyeardec2' ORDER BY versionissue DESC LIMIT 10";
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
    <script>
    document.querySelector('#read-more-abstract<?php echo htmlentities($result->id);?>').addEventListener('click', function() {
    document.querySelector('#paper-abstract<?php echo htmlentities($result->id);?>').style.height= 'auto';
        this.style.display= 'none';
        });
            </script>
      <hr>
            </td>
           </div>
           </tr>

    <?php }}  ?>
    </tbody>
    </table>
    <!-- Latest Archive Section Ends  Here  -->
    </div>

      <!-- Sidebar section starts here  -->
    <div  class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
     <?php
     include 'sidelinks.php'; 
     ?>  
    </div>
    <!-- Sidebar Section ends here  -->
    </div>
    <div class="pb-5"></div>
    <div class="pb-5"></div>
    <div class="pb-5"></div>
    </div>

    <!-- Footer section starts here  -->
    <?php
    include 'footer.php';
    ?> 
    <!-- Footer section ends here  -->
   </div>


    
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