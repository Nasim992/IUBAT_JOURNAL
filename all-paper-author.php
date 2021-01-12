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
    <title>All paper Author</title>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css"> 
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
</head> 
<body> 
<div class="sticky-top header-floating">
    <!-- Heading Sections starts  -->
    <?php 
    include 'author-header.php';
    ?>
    <!-- Heading Sections ends  --> 
    </div>
 
    <div class="container">
    <div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
   <?php
   include 'header.php';
   ?>
    </div>
    </div> 
    </div>
 
    <div class="row">
    <!-- Sidebar section starts here  -->
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
        <?php
        include 'sidelinks.php';
        ?>
    </div>
    <!-- Sidebar Section ends here  -->
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
    <p  id="content" class="pt-4">
    <b>Aim and Scope: </b>Production and Hosting by Elsevier B.V. on behalf of Faculty of Engineering, Alexandria University Peer Review under the responsibility of Faculty of Engineering, Alexandria University Alexandria Engineering Journal is an international journal devoted to publishing high quality papers in the field of engineering and applied science. Alexandria Engineering Journal is cited in the Engineering Information Services (EIS) and the Chemical Abstracts (CA). The papers published in Alexandria Engineering Journal are grouped into five sections, according to the following classification:

    • Mechanical, Production, Marine and Textile Engineering

    • Electrical Engineering, Computer Science and Nuclear Engineering

    • Civil and Architecture Engineering

    • Chemical Engineering and Applied Sciences

    • Environmental Engineering
    Alexandria Engineering Journal publishes original papers, critical reviews, technical papers, technical data, short notes, and letters to the editor. Papers covering experimental, theoretical, and computational aspects which contribute to the understanding of engineering and applied sciences or give an insight into engineering practices and processes are welcome. Authors from all over the world are invited to submit manuscripts for possible publications in Alexandria Engineering Journal.

    For queries related to the journal, please contact magdy@alexu.edu.eg
    </p>
    <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more">Read more...</span></a>
    </div>

<hr class="bg-secondary" >
    <table id="heading-table">
    <tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action from paper WHERE action=1 ";
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
            <a href="paper-download.php?id=<?php echo htmlentities($result->id);?>"><h5 style="font-size:16px;"><?php echo htmlentities($result->papername);?></h5></a>
            <h5 class="text-secondary" style="font-size:15px;"><?php echo $authorname;?></h5>
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
    </div>
    </div>
    </div>

    <!-- Footer section starts here  -->
    <?php
    include 'footer.php'
    ?>
    <!-- Footer section ends here  -->
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
<?php  }
?>