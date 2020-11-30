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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
    <link rel="stylesheet" href="css/index.css">

    <title>Show Paper</title>

        <script>  
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
     </script>

     <style>
     .jumbotron {
         padding:0px !important;
     }
     </style>

</head>
<body>
<div class="container">

<div class="sticky-top">
<!-- Author showing header sections starts  -->

    <?php 
    include 'author-header.php';
    ?>

<!-- Author showing header sections ends   -->
</div>


<!-- Authors paper showing sections starts here  -->

            <div class="row">
                <div class="col-md-12">
                                <div style="margin-top:20px;float:right;width:50%;margin-bottom:20px;">
                                <input id="myInput" class="form-control" type="text" placeholder="Search..">
                               </div>
                  </div>
                  </div> 

        <!-- <div class="panel-body p-20"> -->
<div class="table-responsive">
<table  id="myTable"  cellspacing="0" width="100%">

<!-- Author paper showing section starts (Jumbotron section) -->

<tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action from paper WHERE authoremail='$authoremail'";
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
            <div class="jumbotron" > 

            <div class="d-flex justify-content-between col-sm-12">
            <div>
            <p>Paper ID : <?php echo htmlentities($result->id);?></p>
            </div>
            <div>
            <p><b> Status: <?php
            //  echo htmlentities($result->action);
            $test = htmlentities($result->action);

            if ($test!=1) {
                ?>
                <span style="color:goldenrod;">
               <?php  echo "Pending";
            }
            else {
                ?>
                </span>
                <span style="color:green;">
                <?php
                echo "Published";
            }
            
            ?>
            </span></b></p>
            </div>
            </div>

            <h5 class="display-4"><?php echo htmlentities($result->papername);?></h5>
            <p><b>Author Email: <?php echo htmlentities($result->authoremail);?></b></p>
            <p class="lead"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>

            <div class=" d-flex justify-content-between col-sm-12">
            <div >
            <a href="paper-download.php?id=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></a>
            </div>
            <div >
            <p><?php echo htmlentities($result->type);?></p>
            </div>
            <a href="edit-paper-author.php?id=<?php echo htmlentities($result->id);?>&nameprevious=documents/<?php echo htmlentities($result->name);?>"><i class="far fa-edit" title="Edit"></i></a>
            <a href="delete-paper.php?id=<?php echo htmlentities($result->id);?>&name=documents/<?php echo htmlentities($result->name);?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>
            </div>

           

           </div>
           <hr>
            </td>
           </div>
           </tr>
          
      

       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
        </table>


<!-- Authors paper showing section ends (jumbotron section) -->


</div>

    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>

    <!-- Essential Js,Jquery  section ends  -->   
</body>
</html>

<?php } ?>



