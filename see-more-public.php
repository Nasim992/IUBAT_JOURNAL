
<?php 
 session_start();
 error_reporting(0);
 
 include('link/config.php');

//  Check that someone is logged in or not 

 if(strlen($_SESSION['alogin'])=="")
    { 
      $emails = "Anonymous";
    }
    else
    { 
       $emails = $_SESSION["email"];
    }
//  Check that someone is logged in or not 

// Insert Comment To the Database section starte here 

    $id=intval($_GET['id']);
    $msg = "";
      if(isset($_POST['submit']))
    { 
      $paperid = $id;

      $name = $_POST['name'];

      if ($name !='') {
        $name = $_POST['name'];
      }
      else {
        $name = "Anonymous";
      }
      
      $email = $emails;
      $comments = $_POST['comment'];

      $sql="INSERT INTO  comments(paperid,name,email,comments) VALUES(:paperid,:name,:email,:comments)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':paperid',$paperid,PDO::PARAM_STR);
      $query->bindParam(':name',$name,PDO::PARAM_STR);
      $query->bindParam(':email',$email,PDO::PARAM_STR);
      $query->bindParam(':comments',$comments,PDO::PARAM_STR);
    
      $query->execute();
 
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      if($query->rowCount() > 0)
      {
        $msg = "Comment Posted Successfully!";

      } else{
          
         $msg  = "Something Went Wrong! ";

      }    
    }

  // Insert Comment To the Database section ends here 


  // Total Comments Count Sections starts here 
  
  $query = "SELECT COUNT(*) as total_rows FROM comments WHERE paperid = '$id'";
  $stmt = $dbh->prepare($query);
  
  // execute query
  $stmt->execute();
  
  // get total rows
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $total_rows = $row['total_rows'];


  // Total Comments Sections ends here 


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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
    <style>
    .comments {
      margin-top:0px !important;
      margin-bottom:0px !important;
      font-size:16px !important;
      width: max-content;
    line-height: normal;
    }
    </style>
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
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action from paper WHERE id='$id' and action = 1 ";
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

            <div class="d-flex justify-content-between">
            <div>
            <a href="index.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>
            </div>
            <div>
            <a class="btn btn-success btn-sm" href="paper-download.php?id=<?php echo htmlentities($result->id);?>" role="button">Download</a>
            </div>
            </div>
           </div>
           </td>
           </tr>
          
       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
    </table>

<!-- Public Comments Sections starts here  -->

<div class="d-flex justify-content-between comments row col-sm-12">

<div class="p-5 col-sm-12 col-lg-6 col-md-6">
<form method="post">

<div class="form-group">
    <label class="control-label" for="exampleInputEmail1">Name(Optional)</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your name">
  </div>
  <!-- <div class="form-group"> 
    <label for="exampleInputEmail1">Email address(Optional)</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div> -->

  <div class="form-group"> 
        <label for="exampleFormControlTextarea1">Comments: </label>
        <textarea name="comment" class="form-control " id="exampleFormControlTextarea1" name= "summary" rows="4" placeholder="Write Your Comments About the Paper " required></textarea>

     </div>

  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <div class="form-group">
  <button type="submit" name="submit" class="btn btn-primary">Post Comment</button>
  <h5 class="float-right text-success p-2"><?php echo $msg ?></h5>
  </div>


  </form>

</div>
 
<div class="p-5 col-sm-12 col-lg-6 col-md-6 row justify-content-center">
<div class=" rounded mt-2">
<h4 class="p-2">Comments(<?php echo $total_rows ?>) </h4>
<div class="rounded p-3">
<?php $sql = "SELECT comments.id,comments.paperid,comments.name,comments.email,comments.comments,comments.time from comments WHERE paperid='$id' ORDER BY id DESC";
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
      if($query->rowCount() > 0)  
      {
      foreach($results as $result) 
      {  
        ?>
    <div class="card mb-2 border-secondary">
    <div class="card-header bg-success py-1 text-light d-flex justify-content-between">
        <div>
        <span>Posted by:<?php echo htmlentities($result->name);?> &nbsp&nbsp&nbsp</span>
        </div>
        <div>
        <span class="float-right"> On: <?php echo htmlentities($result->time);?></span>
        </div>
    </div>
    <div class="card-body py-2">
    <p class="card-text"> <?php echo htmlentities($result->comments);?> </p>
    </div>

    <div class="card-footer py-2">
    <div class="float-right">
    <a href="delete-message.php" class="text-danger mr-2" onclick="return confirm('Do you want to delete this comment?');" title ="Delete"><i class="fas fa-trash"></i></a>
    <a href="edit-message.php" class="text-success mr-2"  title ="Edit"><i class="fas fa-edit"></i></a>

    </div>
    </div>

    </div>

      <?php }} ?>

</div>

</div>
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