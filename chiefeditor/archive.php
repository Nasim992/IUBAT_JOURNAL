<?php 
session_start();
error_reporting(0);
include('../link/config.php');
include('../functions.php');
checkLoggedInOrNot();
$editoremail = $_SESSION["email"];
IsChiefEditorLoggedIn($editoremail);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
</head>

<body>

    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php include 'header.php';?>
    </div>
    <!-- Author showing header sections ends   -->
    <div id="mySidebar" class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="main">
        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">
            <h6>ARCHIVE PAPER</h6>
            <hr class="bg-secondary">
            <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm p-4">
                <table id="dtBasicExample" class="table table-striped table-bordered table-hover">

                    <thead> 
                        <tr class="bg-secondary text-white">
                            <th>Paper ID</th>
                            <th>Paper Name</th>
                            <th>Author Name</th>
                            <th>Abstract</th>
                        </tr>
                    </thead>
                    <tbody id="myTable-admin">
                        <!-- Selecting paper section starts here  -->
                        <?php 
                            $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive";
                            $query = $dbh->prepare($sql); 
                            $query->execute(); 
                            $results=$query->fetchAll(PDO::FETCH_OBJ); 
                            $cnt=1;  
                            if($query->rowCount() > 0)  
                            {
                            foreach($results as $result) 
                            {    
                                $filename = htmlentities($result->filename);
                                $filepath = '../documents/archivefile/'.$filename;
                        ?>
                        <tr>
                            <td>
                            <?php  echo htmlentities($result->paperid); ?>
                            </td>
                            <td class="text-dark">
                            <a style="font-size:14px;" href="<?php echo $filepath ?> " target="_blank" role="button"> <?php  echo htmlentities($result->papername); ?></a>
                            <p>Published year: <b><?php  echo htmlentities($result->versionissue); ?></b></p>
                            </td>
                            <td>
                                 <?php   echo htmlentities($result->authorname); ?>
                            </td>
                            <td class="text-dark">
                            <?php   echo htmlentities($result->abstract); ?>
                            </td>
                        </tr>
                                  <?php }} ?>
 
                    </tbody>

                </table>

            </div>
            <div class="mb-5"></div>
        </div>
    </div>

    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>

    <script>
    // DataTables section starts here 
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    // Datables section ends here 
    </script>

    <!-- Essential Js,Jquery  section ends  -->
</body>

</html>