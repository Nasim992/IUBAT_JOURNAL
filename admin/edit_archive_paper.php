<?php 
session_start();
error_reporting(0);
include('../link/config.php');
include('../functions.php');
include('../link/functionsql.php');
checkLoggedInOrNot();
$adminemail = $_SESSION["email"];
IsAdminLoggedIn($adminemail);
     $paperid = $_GET['id'];

    //  Update Abstract section 

    if(isset($_POST['update_abstract']))
     { 
     $abstract = $_POST['abstract-update'];

     $sqlresubmit="update archive set abstract='".escape($abstract)."' where paperid='$paperid'"; 
     if(mysqli_query($link, $sqlresubmit))
     {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
     echo "<script>alert('Paper Updated Successfully.');</script>";
     }
     else {
         header("Location: " . $_SERVER["HTTP_REFERER"]);
         exit;
         echo "<script>alert('Something went wrong!');</script>";
     }   
}
    // Update Abstract section

    // Update Authorname section 
    if(isset($_POST['update_authorname']))
    { 
    $authorname = $_POST['authorname-update'];

    $sqlresubmit="update archive set authorname='".escape($authorname)."' where paperid='$paperid'"; 
    if(mysqli_query($link, $sqlresubmit))
    {
       header("Location: " . $_SERVER["HTTP_REFERER"]);
       exit;
    echo "<script>alert('Paper Updated Successfully.');</script>";
    }
    else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
        echo "<script>alert('Something went wrong!');</script>";
    }   
}
    // Update Authorname section 

        // Update Versionissue section 
        if(isset($_POST['update_versionissue']))
        { 
        $versionissue = $_POST['versionissue-update'];
    
        $sqlresubmit="update archive set versionissue='".escape($versionissue)."' where paperid='$paperid'"; 
        if(mysqli_query($link, $sqlresubmit))
        {
           header("Location: " . $_SERVER["HTTP_REFERER"]);
           exit;
        echo "<script>alert('Paper Updated Successfully.');</script>";
        }
        else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
            echo "<script>alert('Something went wrong!');</script>";
        }   
    }
        // Update Versionissue section 

        // Update Versionissue section 
                if(isset($_POST['update_papername']))
                { 
                $papername = $_POST['papername-update'];
            
                $sqlresubmit="update archive set papername='".escape($papername)."' where paperid='$paperid'"; 
                if(mysqli_query($link, $sqlresubmit))
                {
                   header("Location: " . $_SERVER["HTTP_REFERER"]);
                   exit;
                echo "<script>alert('Paper Updated Successfully.');</script>";
                }
                else {
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit;
                    echo "<script>alert('Something went wrong!');</script>";
                }   
            }
        // Update Versionissue section 
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
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
</head>
<body>
    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php include 'header.php'; ?>
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
                    <tbody id="myTable-admin">
                        <!-- Selecting paper section starts here  -->
                        <?php 
                            $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive WHERE paperid='$paperid'";
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
                                <b>Paper ID: </b><?php  echo htmlentities($result->paperid); ?>
                                <br>
                               <b>Paper Name: </b> <a style="font-size:14px;" href="<?php echo $filepath ?> " target="_blank" 
                                    role="button" title="Download this paper"> <?php  echo htmlentities($result->papername); ?></a>
                                <form method="post">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name= "papername-update" rows="2"  required><?php  echo htmlentities($result->papername); ?></textarea>
                                <button name="update_papername" class="btn btn-sm btn-info">Update</button>
                                </form>

                                <p>Published year: <b><?php  echo htmlentities($result->versionissue); ?></b></p>
                                <form method="post">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name= "versionissue-update" rows="2"  required><?php  echo htmlentities($result->versionissue); ?></textarea>
                                <button name="update_versionissue" class="btn btn-sm btn-info">Update</button>
                                </form>
                                
                                <b>Author Name: </b><?php   echo htmlentities($result->authorname); ?>
                                <form method="post">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name= "authorname-update" rows="2"  required><?php  echo htmlentities($result->authorname); ?></textarea>
                                <button name="update_authorname" class="btn btn-sm btn-info">Update</button>
                               </form>

                              <b>Abstract: </b><?php  echo htmlentities($result->abstract); ?>
                              <form method="post">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name= "abstract-update" rows="10"  required><?php  echo htmlentities($result->abstract); ?></textarea>
                                <button name="update_abstract" class="btn btn-sm btn-info">Update</button>
                              </form>
                                <br>
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
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
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