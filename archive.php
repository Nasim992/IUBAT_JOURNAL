<?php
session_start();
error_reporting(0);
include('link/config.php'); 
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive</title>
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?>
    <!-- Css links -->
    <style>
    .indexform button {
        padding: 0 !important;
        margin: 0 !important;
    }
    .indexform button:hover {
        color: #0b4953 !important;
    }

    .volumeissue {
        cursor: pointer;
    }

    .volumeissue:hover {
        color: #17defe !important;
    }

    .colorbtn {
        color: #17defe !important;
    }
    </style>
</head>

<body>
    <div class="content">
        <div class="sticky-top">
            <!-- Heading Sections starts  -->
            <?php  include 'heading.php'?>
            <!-- Heading Sections ends  -->
        </div>
        <div style="font-size:18px;" class="container">
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

                </div>
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <div class="text-left pb-4">
                        <?php include "header.php"; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar section starts here  -->
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <?php include "sidelinks.php"  ?>
                </div>
                <!-- Sidebar Section ends here  -->
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <div class="text-left pb-4">
                        <h5 class="text-center">ARCHIVE</h5>
                        <a onclick="showpoint3()">
                            <h6 class="text-info volumeissue" id="4thpoint">> VOLUME 2 ISSUE 1 </h6>
                        </a>
                        <a onclick="showpoint2()">
                            <h6 class="text-info volumeissue" id="3rdpoint">> VOLUME 1 ISSUE 3 </h6>
                        </a>
                        <a onclick="showpoint1()">
                            <h6 class="text-info volumeissue" id="2ndpoint">> VOLUME 1 ISSUE 2 </h6>
                        </a>
                        <a onclick="showpoint()">
                            <h6 class="text-info volumeissue" id="1stpoint">> VOLUME 1 ISSUE 1 </h6>
                        </a>
                        <hr class="bg-secondary">
                        <!-- Archive  -->

<!-- -------------------------------------Volume 2 Issue 1 -------------------------------------------- -->
                         <div id="vol2issue1">
                            <h6 class="text-info">VOLUME 2 ISSUE 1 </h6>
                            <hr>
                            <table id="heading-table">
                                <tbody>
                                    <?php 
                                        $V2019 = '2019';
                                        $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2019'";
                                        $query = $dbh->prepare($sql); 
                                        $query->execute(); 
                                        $results=$query->fetchAll(PDO::FETCH_OBJ); 
                                        if($query->rowCount() > 0) 
                                        {
                                        foreach($results as $result)  
                                        {  
                                            $filepathname = htmlentities($result->filename);
                                            $filepath = 'documents/archivefile/'.$filepathname;
                                            $publishdatestring = htmlentities($result->publisheddate);
                                            $publishdate = date("Y",strtotime($publishdatestring));
                                        ?>
                                    <tr>
                                        <td>
                                            <div class="jumbotron text-justify  mb-0 bg-transparent">
                                                <a class="bg-transparent"style="font-size:18px;border:none;outline:none;font-weight:500;color:#098680;text-align:left;"><?php echo htmlentities($result->papername);?></a>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
                                                    </div>
                                                    <div>
                                                        <a style="font-size:17px;" class="btn btn-info btn-sm"href="<?php echo $filepath ?> " target="_blank" role="button">Download</a>
                                                    </div>
                                                </div>
                                                <h5 class="text-dark" style="font-size:16px;"><?php echo htmlentities($result->authorname);?></h5>
                                                <p id="paper-abstract<?php echo htmlentities($result->id);?>"style="font-size:17px;height: 6.0em;overflow: hidden;width:auto;">
                                                    <span style="font-weight:bold">Abstract:</span>
                                                    <?php echo htmlentities($result->abstract);?></p>
                                                <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
                                                <!--Individual Read More section starts here   -->
                                                <script>
                                                document.querySelector(
                                                        '#read-more-abstract<?php echo htmlentities($result->id);?>')
                                                    .addEventListener('click', function() {
                                                        document.querySelector(
                                                            '#paper-abstract<?php echo htmlentities($result->id);?>'
                                                            ).style.height = 'auto';
                                                        this.style.display = 'none';
                                                    });
                                                </script>
                                                <!-- Individual Read More section ends here  -->
                                                <hr>
                                        </td>
                        </div>
                        </tr>
                        <?php }} ?>
                        </tbody>
                        </table>
                    </div>
<!-- -------------------------------------Volume 2 Issue 1 -------------------------------------------- -->

<!-- -------------------------------------Volume 1 Issue 3 -------------------------------------------- -->
                        <div id="vol1issue3">
                            <h6 class="text-info">VOLUME 1 ISSUE 3 </h6>
                            <hr>
                            <table id="heading-table">
                                <tbody>
                                    <?php 
                                        $V2016 = '2018';
                                        $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2016'";
                                        $query = $dbh->prepare($sql); 
                                        $query->execute(); 
                                        $results=$query->fetchAll(PDO::FETCH_OBJ); 
                                        $cnt=1; 
                                    
                                        if($query->rowCount() > 0) 
                                        {
                                        foreach($results as $result)  
                                        {  
                                            $filepathname = htmlentities($result->filename);
                                            $filepath = 'documents/archivefile/'.$filepathname;
                                            $publishdatestring = htmlentities($result->publisheddate);
                                            $publishdate = date("Y",strtotime($publishdatestring));
                                        ?>
                                    <tr>
                                        <td>
                                            <div class="jumbotron text-justify  mb-0 bg-transparent">
                                                <a class="bg-transparent" style="font-size:18px;border:none;outline:none;font-weight:500;color:#098680;text-align:left;"><?php echo htmlentities($result->papername);?></a>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
                                                    </div>
                                                    <div>
                                                        <a style="font-size:14px;" class="btn btn-info btn-sm"href="<?php echo $filepath ?> " target="_blank"role="button">Download</a>
                                                    </div>
                                                </div>
                                                <h5 class="text-dark" style="font-size:17px;"><?php echo htmlentities($result->authorname);?></h5>
                                                <p id="paper-abstract<?php echo htmlentities($result->id);?>"style="font-size:17px;height: 6.0em;overflow: hidden;width:auto;">
                                                    <span style="font-weight:bold">Abstract:</span>
                                                    <?php echo htmlentities($result->abstract);?></p>
                                                <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
                                                <!--Individual Read More section starts here   -->
                                                <script>
                                                document.querySelector(
                                                        '#read-more-abstract<?php echo htmlentities($result->id);?>')
                                                    .addEventListener('click', function() {
                                                        document.querySelector(
                                                            '#paper-abstract<?php echo htmlentities($result->id);?>'
                                                            ).style.height = 'auto';
                                                        this.style.display = 'none';
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
<!-- -------------------------------------Volume 1 Issue 3 -------------------------------------------- -->

<!-- -------------------------------------Volume 1 Issue 2 -------------------------------------------- -->
                    <div id="vol1issue2">
                        <h6 class="text-info">VOLUME 1 ISSUE 2 </h6>
                        <hr>
                        <table id="heading-table">
                            <tbody>
                                <?php 
                                    $V2016 = '2017';
                                    $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2016'";
                                    $query = $dbh->prepare($sql); 
                                    $query->execute(); 
                                    $results=$query->fetchAll(PDO::FETCH_OBJ); 
                                    if($query->rowCount() > 0) 
                                    {
                                    foreach($results as $result)  
                                    {  
                                        $filepathname = htmlentities($result->filename);
                                        $filepath = 'documents/archivefile/'.$filepathname;
                                        $publishdatestring = htmlentities($result->publisheddate);
                                        $publishdate = date("Y",strtotime($publishdatestring));
                                    ?>
                                <!-- Dashboard section starts  -->
                                <tr>
                                    <td>
                                        <div class="jumbotron text-justify  mb-0 bg-transparent">
                                            <a class="bg-transparent" style="font-size:18px;border:none;outline:none;font-weight:500;color:#098680;text-align:left;"><?php echo htmlentities($result->papername);?></a>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
                                                </div>
                                                <div>
                                                    <a style="font-size:16px;" class="btn btn-info btn-sm" href="<?php echo $filepath ?> " target="_blank" role="button">Download</a>
                                                </div>
                                            </div>
                                            <h5 class="text-dark" style="font-size:16px;"><?php echo htmlentities($result->authorname);?></h5>
                                            <p id="paper-abstract<?php echo htmlentities($result->id);?>"style="font-size:17px;height: 6.0em;overflow: hidden;width:auto;"><span style="font-weight:bold">Abstract:</span>
                                                <?php echo htmlentities($result->abstract);?></p>
                                            <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
                                            <!--Individual Read More section starts here   -->
                                            <script>
                                            document.querySelector(
                                                    '#read-more-abstract<?php echo htmlentities($result->id);?>')
                                                .addEventListener('click', function() {
                                                    document.querySelector(
                                                        '#paper-abstract<?php echo htmlentities($result->id);?>'
                                                        ).style.height = 'auto';
                                                    this.style.display = 'none';
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
<!-- -------------------------------------Volume 1 Issue 2 -------------------------------------------- -->

<!-- -------------------------------------Volume 1 Issue 1 -------------------------------------------- -->
                <div id="vol1issue1">
                    <h6 class="text-info">VOLUME 1 ISSUE 1 </h6>
                    <hr>
                    <table id="heading-table">
                        <tbody>
                            <?php 
                            $V2016 = '2016';
                            $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$V2016'";
                            $query = $dbh->prepare($sql); 
                            $query->execute(); 
                            $results=$query->fetchAll(PDO::FETCH_OBJ); 
                            if($query->rowCount() > 0) 
                            {
                            foreach($results as $result)  
                            {  
                                $filepathname = htmlentities($result->filename);
                                $filepath = 'documents/archivefile/'.$filepathname;
                                $publishdatestring = htmlentities($result->publisheddate);
                                $publishdate = date("Y",strtotime($publishdatestring));
                            ?>
                            <!-- Dashboard section starts  -->
                            <tr>
                                <td>
                                    <div class="jumbotron text-justify  mb-0 bg-transparent">
                                        <a class="bg-transparent"style="font-size:18px;border:none;outline:none;font-weight:500;color:#098680;text-align:left;"><?php echo htmlentities($result->papername);?></a>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="text-primary" style="font-size:16px;"><small>Published on <?php echo $publishdate;?></small></h5>
                                            </div>
                                            <div>
                                                <a style="font-size:16px;" class="btn btn-info btn-sm"href="<?php echo $filepath ?> " target="_blank" role="button">Download</a>
                                            </div>
                                        </div>
                                        <h5 class="text-dark" style="font-size:16px;"><?php echo htmlentities($result->authorname);?></h5>
                                        <p id="paper-abstract<?php echo htmlentities($result->id);?>"style="font-size:17px;height: 6.0em;overflow: hidden;width:auto;"><span style="font-weight:bold">Abstract:</span>
                                            <?php echo htmlentities($result->abstract);?></p>
                                        <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
                                        <!--Individual Read More section starts here   -->
                                        <script>
                                        document.querySelector(
                                                '#read-more-abstract<?php echo htmlentities($result->id);?>')
                                            .addEventListener('click', function() {
                                                document.querySelector(
                                                        '#paper-abstract<?php echo htmlentities($result->id);?>')
                                                    .style.height = 'auto';
                                                this.style.display = 'none';
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
 <!-- -------------------------------------Volume 1 Issue 1 -------------------------------------------- -->
            <!-- Archive  -->
            </p>
        </div>
    </div>
    </div>
    </div>
    <!-- Footer section starts here  -->
    <?php include 'footer.php' ?>
    <!-- Footer section ends here  -->
    </div>
    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script>
    function showpoint() {
        document.getElementById("vol1issue1").style.display = "block";
        document.getElementById("vol1issue2").style.display = "none";
        document.getElementById("vol2issue1").style.display = "none";

        document.getElementById("1stpoint").classList.add('colorbtn');
        document.getElementById("2ndpoint").classList.remove('colorbtn');
        document.getElementById("3rdpoint").classList.remove('colorbtn');
        document.getElementById("4thpoint").classList.remove('colorbtn');
    }

    function showpoint1() {
        document.getElementById("vol1issue1").style.display = "none";
        document.getElementById("vol1issue2").style.display = "block";
        document.getElementById("vol1issue3").style.display = "none";
        document.getElementById("vol2issue1").style.display = "none";

        document.getElementById("1stpoint").classList.remove('colorbtn');
        document.getElementById("2ndpoint").classList.add('colorbtn');
        document.getElementById("3rdpoint").classList.remove('colorbtn');
        document.getElementById("4thpoint").classList.remove('colorbtn');
    }

    function showpoint2() {
        document.getElementById("vol1issue1").style.display = "none";
        document.getElementById("vol1issue2").style.display = "none";
        document.getElementById("vol1issue3").style.display = "block";
        document.getElementById("vol2issue1").style.display = "none";

        document.getElementById("1stpoint").classList.remove('colorbtn');
        document.getElementById("2ndpoint").classList.remove('colorbtn');
        document.getElementById("3rdpoint").classList.add('colorbtn');
        document.getElementById("4thpoint").classList.remove('colorbtn');
    }
    function showpoint3() {
        document.getElementById("vol1issue1").style.display = "none";
        document.getElementById("vol1issue2").style.display = "none";
        document.getElementById("vol1issue3").style.display = "none";
        document.getElementById("vol2issue1").style.display = "block";

        document.getElementById("1stpoint").classList.remove('colorbtn');
        document.getElementById("2ndpoint").classList.remove('colorbtn');
        document.getElementById("3rdpoint").classList.remove('colorbtn');
        document.getElementById("4thpoint").classList.add('colorbtn');
    }
    </script>
    <!-- Essential Js,Jquery  section ends  -->
</body>
</html>