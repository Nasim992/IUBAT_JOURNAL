<?php
session_start();
error_reporting(0);

include('../link/config.php');

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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.5.1.slim.min.js"></script>

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

</head>
<body>
<div class="container">
<!-- Author showing header sections starts  -->

    <?php 
    include 'author-header.php';
    ?>

<!-- Author showing header sections ends   -->


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
                                <input id="myInput" class="form-control" type="text" placeholder="Search..">
                               </div>


                        <div class="panel-body p-20">

<table class="table table-striped" id="myTable"  cellspacing="0" width="100%">
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
<?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type from paper WHERE authoremail='$authoremail' ";
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
                <a href="paper-download.php?id=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></a>
                </td>
            <td ><?php echo htmlentities($result->type);?></td>

<td >
<a href="edit_symptoms.php?stid=<?php echo htmlentities($result->id);?>"><i class="far fa-edit" title="Edit"></i></a>
<a href="delete-paper.php?id=<?php echo htmlentities($result->id);?>&name=../documents/<?php echo htmlentities($result->name);?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
       
    
    </tbody>
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
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>

    <!-- Essential Js,Jquery  section ends  -->   
</body>
</html>

<?php } ?>



