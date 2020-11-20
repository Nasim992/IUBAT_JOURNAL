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
    if(isset($_POST['accept-paper']))
        {
            $id = $_POST['id'];
            $action = 1;

            $sql="update paper set action=:action where id=:id and action!=1 ";

            $query = $dbh->prepare($sql);
            $query->bindParam(':action',$action,PDO::PARAM_STR);
    
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


?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin-dashboard.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
    <!-- <script> 
        $(document).ready(function(){
        $("#myInput-admin").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable-admin tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script> -->
    <style>
     .jumbotron {
         padding:0px !important;
     }
     button[type="submit"]:hover {
         background-color:none !important;
     }
     </style>
</head>
<body>
<div class="container">


<div class="sticky-top">
<!-- Author showing header sections starts  -->

<?php
include 'admin-header.php';
?>

<!-- Author showing header sections ends   -->
</div>


    <!-- Authors paper showing sections starts here  -->
    <div class="content-container">

<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
  
    

    <section class="section">
        <div class="container-fluid">

         

            <div class="row">
                <div class="col-md-12">
                                <div style="margin-top:20px;float:right;width:50%;margin-bottom:20px;">
                                <input id="myInput-admin" class="form-control" type="text" placeholder="Search..">
                               </div>


                        <div class="panel-body p-20">
 
   <table id="myTable-admin"  cellspacing="0" width="100%">

<!-- Admin Paper showing sections starts (jumbotron section) here -->

<tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action from paper WHERE action = 0";
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

            <div class="d-flex justify-content-between">
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

            <div class=" d-flex justify-content-between bg-light">

            <div class="p-4">
            <a href="paper-download-admin.php?id=<?php echo htmlentities($result->id);?>u " title="Download"><?php echo htmlentities($result->name);?></a>
            </div>

            <div class="p-4">
            <p><?php echo htmlentities($result->type);?></p>
            </div>

            <div class="p-4">
            <a href="feedback-paper.php?id=<?php echo htmlentities($result->id);?>" style="color:red;" title="Give Feedback">Feedback</a>
            </div>
            <div class="p-4">

            <form method="post">

            <input type="hidden" name="id" value="<?php echo htmlentities($result->id);?>">

            <button type="submit"  class="bg-light" name="accept-paper" onclick="return confirm('Are you sure you want accept this paper?');" style="border:none;color:green;"> Accept <i class="fas fa-check"></i></button>

            <!-- <a href="accepted-paper.php?id=<?php echo htmlentities($result->id);?>" name="accept-paper" style="color:green;" onclick="return confirm('Are you sure you want accept this paper?');" title="Accept">Accept <i class="fas fa-check"></i></a> -->
            </form>

            </div>


            <div class="p-4">
            <!-- <a href="edit-paper-author.php?id=<?php echo htmlentities($result->id);?>&nameprevious=documents/<?php echo htmlentities($result->name);?>"><i class="far fa-edit" title="Edit"></i></a> -->
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





<!-- Admin Paper showing sections ends (Jumbotron section) here  -->





<!-- 
    <thead>
        <tr class='bg-success text-white'>
            <th class="result-color1" scope="col">#</th>
            <th class="result-color1">id</th>
            <th class="result-color1">author email</th>
            <th class="result-color1">paper name</th>
            <th class="result-color1">abstract</th>
            <th class="result-color1">name</th>
            <th class="result-color1">type</th>
            <th class="result-color1">Actions</th>
        </tr>
    </thead>
 
    <tbody>
<?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type from paper ";
$query = $dbh->prepare($sql); 
$query->execute(); 
$results=$query->fetchAll(PDO::FETCH_OBJ); 
$cnt=1;
if($query->rowCount() > 0) 
{
foreach($results as $result) 
{   ?>
<tr>
<td><?php echo htmlentities($cnt);?></td><td class="result-color1"><?php echo htmlentities($result->id);?></td>
            <td ><?php echo htmlentities($result->authoremail);?></td>
            <td ><?php echo htmlentities($result->papername);?></td>
            <td ><?php echo htmlentities($result->abstract);?></td>
            <td title="download">
                <a href="paper-download-admin.php?id=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></a>
                </td>
            <td ><?php echo htmlentities($result->type);?></td>

<td >
<a href="edit_symptoms.php?stid=<?php echo htmlentities($result->id);?>"><i class="far fa-edit" title="Edit"></i></a>
<a href="delete-paper.php?id=<?php echo htmlentities($result->id);?>&name=documents/<?php echo htmlentities($result->name);?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
       
    
    </tbody> -->


</table>


<!-- /.col-md-12 -->
</div>

                    </div>
                </div>
                <!-- /.col-md-6 -->

  
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.section -->

</div>
<!-- /.main-page -->



</div>
<!-- /.content-container -->
</div>
<!-- /.content-wrapper -->

    <!-- Authors paper showing sections ends here  -->

</div>
<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->    
</body>
</html>

    <?php } ?>