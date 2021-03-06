<?php
session_start();
error_reporting(0);
include('../link/config.php');  
include('../functions.php');
checkLoggedInOrNot();
$editoremail = $_SESSION["email"];
IsChiefEditorLoggedIn($editoremail);

    // Associate Editor 
    if(isset($_POST['select-associateeditor'])) {

        $pemail = $_POST['pemail'];

        $sqlquthor = "UPDATE author SET associateeditor=1,academiceditor=NULL,reviewerselection=NULL WHERE primaryemail='$pemail'";
        if(mysqli_query($link, $sqlquthor)){
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
            echo "<script>alert('Associate Editor Select Successfully.');</script>";
        }
        else {
            echo "<script>alert('Something went wrong.');</script>";
        }

    }
    // Associate Editor 

    // Academic Editor 
    if(isset($_POST['select-academiceditor'])) {

        $pemail = $_POST['pemail'];

        $sqlquthor = "UPDATE author SET academiceditor=1,associateeditor=NULL,reviewerselection=NULL WHERE primaryemail='$pemail'";
        if(mysqli_query($link, $sqlquthor)){
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
            echo "<script>alert('Academic Editor Select Successfully.');</script>";
        }
        else {
            echo "<script>alert('Something went wrong.');</script>";
        }

    }
    // Academic Editor 

    // Author
    if(isset($_POST['select-author'])) {

        $pemail = $_POST['pemail'];
    
        $sqlquthor = "UPDATE author SET academiceditor=NULL,associateeditor=NULL WHERE primaryemail='$pemail'";
        if(mysqli_query($link, $sqlquthor)){
            // header("refresh:0;url=selecteditor");
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
            echo "<script>alert('Author Selected Successfully.');</script>";
         }
        else {
              echo "<script>alert('Something went wrong.');</script>";
         }
    
     }
     // Author
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
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

            <h6>SELECT ASSOCIATE AND ACADEMIC EDITOR</h6>
            <hr class="bg-secondary">
            <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm">

                <table id="dtBasicExample" class="table table-striped table-bordered table-hover" cellspacing="0">
                    <thead>
                        <tr>
                            <th>UserName</th>
                            <th>Full Name</th>
                            <th>Primary Email</th>
                            <th>Associate Editor</th>
                            <th>Academic Editor</th>
                            <th>Author</th>
                        </tr>
                    </thead>

                    <tbody id="myTable-admin">
                        <?php $sql = "SELECT author.id,author.username,author.title,author.firstname,author.middlename,author.lastname,author.primaryemail,author.primaryemailcc,author.secondaryemail,author.secondaryemailcc,author.contact,author.address,author.registrationtime,author.reviewerselection,author.associateeditor,author.academiceditor from author ";
                            $query = $dbh->prepare($sql); 
                            $query->execute(); 
                            $results=$query->fetchAll(PDO::FETCH_OBJ);  
                            $cnt=1;
                            if($query->rowCount() > 0)  
                            {
                            foreach($results as $result) 
                            { 
                            $title = htmlentities($result->title);
                            $firstname = htmlentities($result->firstname);
                            $middlename = htmlentities($result->middlename);
                            $lastname = htmlentities($result->lastname);
                            $fullname = $title.' '.$firstname.' '.$middlename.' '.$lastname;
                            $associateeditor = htmlentities($result->associateeditor);
                            $academiceditor = htmlentities($result->academiceditor);
                            ?>
                        <tr> 
                            <td class="result-color1"><?php echo htmlentities($result->username);?></td>
                            <td><?php echo $fullname ;?></td>
                            <td><?php echo htmlentities($result->primaryemail);?></td>
                            <td>
                                <?php if ($associateeditor==1) {
                                echo "<b class='btn btn-sm btn-success text-white'>Selected</b>";
                                } else { ?>
                                <form method="post">
                                    <input type="hidden" name="pemail"
                                        value="<?php echo htmlentities($result->primaryemail);?>">
                                    <button type="submit" name="select-associateeditor"
                                        class="btn btn-info btn-sm">Select</button>
                                </form>
                                <?php  } ?>
                            </td>
                            <td>
                                <?php if ($academiceditor==1) {
                                    echo "<b class='btn btn-sm btn-success text-white'>Selected</b>";
                                    } else { ?>
                                <form method="post">
                                    <input type="hidden" name="pemail"
                                        value="<?php echo htmlentities($result->primaryemail);?>">
                                    <button type="submit" name="select-academiceditor"
                                        class="btn btn-info btn-sm">Select</button>
                                </form>
                                <?php  } ?>
                            </td>
                            <td>
                                <?php if (($academiceditor==0 OR $academiceditor==NULL) and ($associateeditor==0 OR $associateeditor==NULL)) {
                                    echo "<b class='btn btn-sm btn-success text-white'>Selected</b>";
                                    } else { ?>
                                <form method="post">
                                    <input type="hidden" name="pemail"
                                        value="<?php echo htmlentities($result->primaryemail);?>">
                                    <button type="submit" name="select-author"
                                        class="btn btn-info btn-sm">Select</button>
                                </form>
                                <?php  } ?>
                            </td>
                        </tr>
                        <?php $cnt=$cnt+1;}} ?>
                    </tbody>
                </table>
            </div>
            <div class="mb-5"></div>
        </div>
    </div>
    <!-- Authors showing section ends here  -->
    </div>

    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
    $(function($) {
        $('#example').DataTable();

        $('#example2').DataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false
        });

        $('#example3').DataTable();
    });

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
