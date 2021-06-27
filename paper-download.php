<?php  
    session_start();
    error_reporting(0);
    include 'link/config.php';
    if($link === false){
        die("ERROR: Could not connect. " .mysqli_connect_error());
    }
    $id=($_POST['paperidpublic']); 
 
    $sql = "SELECT * FROM paper WHERE paperid = '$id' ";

    $result = mysqli_query($link,$sql);

    $file = mysqli_fetch_assoc($result);

    $filename = $file['name'];
    $papername = $file['papername'];
    $abstract = $file['abstract'];
    $authorname = $file['authoremail'];
    $resubmitpaper = $file['resubmitpaper'];

    if(!empty($resubmitpaper)) {
        $filepath = 'documents/resubmit/'.$file['resubmitpaper'];
    }
    else  {
        $filepath = 'documents/file2/'.$file['name2'];
    }

    $sql = "SELECT * FROM author WHERE  primaryemail= '$authorname' ";

    $result1 = mysqli_query($link,$sql); 

    $file1 = mysqli_fetch_assoc($result1);

    $title = $file1['title'];
    $fname= $file1['firstname'];
    $middlename= $file1['middlename'];
    $lastname= $file1['lastname'];

    $name = $title.' '.$fname.' '.$middlename.' ' .$lastname;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?>
    <!-- Css links -->
    <title>Paper Download</title>
</head>

<body>
    <div class="content">
        <div class="sticky-top">
            <!-- Heading Sections starts  -->
            <?php include 'heading.php'?>
            <!-- Heading Sections ends  -->
        </div>
        <div style="font-size:17px;" class="container mt-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

                </div>
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <div class="text-left pb-4">
                        <?php include 'header.php'; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar section starts here  -->
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <?php include 'sidelinks.php'; ?>
                </div>
                <!-- Sidebar Section ends here  -->
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <div class="text-left">
                    </div>
                    <hr class="bg-secondary">
                    <div class="jumbotron " style="text-align:justify;">
                        <h5 class="display-4">Name : <?php echo $papername; ?></h5>
                        <h6 class="display-5 ">Author:<span class="text-info"> <?php echo $name; ?></span></h6>
                        <p style="font-size:14px;"><b>Abstract:</b><?php echo $abstract; ?></p>
                        <hr class="my-4">

                        <a style="font-size:15px;" class="btn btn-success btn-sm float-right mb-4"
                            href="<?php echo $filepath; ?> " target="_blank" role="button">Download</a>
                    </div>
                </div>
            </div>
            <div class="pb-5"></div>
            <div class="pb-5"></div>
        </div>

        <!-- Footer section starts here  -->
        <?php include 'footer.php'; ?>
        <!-- Footer section ends here  -->
    </div>
    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->
    <script>
    $(document).ready(function() {
        $("#heading-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#heading-table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    // Aim and scope readmore section starts here 
    document.querySelector('#read-more').addEventListener('click', function() {
        document.querySelector('#content').style.height = 'auto';
        this.style.display = 'none';
    });
    //   Aim and scope read more section ends here 
    </script>
</body>
</html>