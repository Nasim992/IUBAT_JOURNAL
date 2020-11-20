
<?php 
 
 include('link/config.php');



//  $authoremail = $_SESSION["email"];
 $id=intval($_GET['id']);


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
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
</head>
<body> 

    <div class="container">
    <div class="sticky-top">
    <!-- Heading Sections starts  -->
    <?php 
    include 'heading.php' 
    ?>
    <!-- Heading Sections ends  --> 
    </div>
 
    <table id="heading-table">
           <tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action from paper WHERE id='$id' ";
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
            <p class="lead"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>
            <hr class="my-4">

            <!-- <a class="btn btn-success btn-sm" href="paper-download.php?id=<?php echo htmlentities($result->id);?>" role="button">Download as PDF</a>
            <a class="btn btn-success btn-sm float-right" href="see-more-public.php" role="button">See More...</a> 
             -->
            </td>
           </div>
           </tr>
          
       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
    </table>

<!-- Public Comments Sections starts here  -->

<div class="d-flex justify-content-between bg-light p-5 mh-50">
<div>
<form>
<div class="form-group">
    <label for="exampleInputEmail1">Name(Optional)</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Comments</button>
</form>
</div>
<div>
<h1>Comments are showing here !!</h1>
</div>
</div>



<!-- Public Comments Sections ends here  -->

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
     </script>
</body>
</html>