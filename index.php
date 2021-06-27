<?php
session_start();
error_reporting(0);
include('link/config.php');
include('link/count.php');
include("functions.php");
$total_published = total_published(); 
$maximumyear = maximumyear();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The IUBAT Review is a multidisciplinary academic journal that the editors intend to publish annually. The office of the journal is located at the International University of Business Agriculture and Technology, the first non-government university in Bangladesh.">
    <title>IUBAT Review</title>
    <link rel="stylesheet" href="css/minimal_matrix.css" crossorigin>
    <?php include 'link/csslinks.php'; ?>
</head>
<body>
    <!-- --------------------------------Heading---------------------------  -->
    <header class="sticky-top">
        <?php include 'heading.php'; ?>
    </header>
    <!-- --------------------------------Heading---------------------------  -->
    <section class="hero-banner bottom">
        <div class="bg-image">
        </div>
        <div class="standout-content bottom">
            <div class="solution-hero-wordmark-title">IUBAT Review</div>
            <span>A Multidisciplinary Academic Journal</span>
            <div>
                <a class="btn btn-info" title="About Journal" href="journalinfo">About Journal ></a>
                <a class="btn btn-info" title="Submit Article" href="login">Submit An Article ></a>
            </div>
            <div>
            </div>
        </div>
    </section>
    <div class="container-fluid text-dark">
        <div class="row container-fluid__homepage ">
        <!----------------------------------- Latest Publications section---------------------  -->
            <section class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <table id="heading-table">
                    <tbody>
                        <h4 class="text-secondary">Latest Publications</h4>
                        <?php
                            $maximumyeardec = $maximumyear - 1;
                            $maximumyeardec2 = $maximumyear - 2;
                            $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$maximumyear' or versionissue='$maximumyeardec' or versionissue='$maximumyeardec2' ORDER BY versionissue DESC LIMIT 10";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                            ?>
                        <tr>
                            <td>
                                <!---- Accordions section starts ---->
                                <div class="accordion" id="accordionExample">                             
                                <?php $i=1;
                                    foreach ($results as $result) {
                                        $filepathname = htmlentities($result->filename);
                                        $filepath = 'documents/archivefile/' . $filepathname;
                                        $publishdatestring = htmlentities($result->publisheddate);
                                        $publishdate = date("Y", strtotime($publishdatestring));
                                        $show = '';
                                        if($i==1) {   $show = 'show';   }
                                        ?>
                                    <div class="card">
                                        <div class="card-header" id="headingOne<?php echo $i ?>">
                                            <h2 class="mb-0">
                                                <p class=" btn-link btn-block text-left  text-dark" type="button"
                                                    data-toggle="collapse" data-target="#collapseOne<?php echo $i ?>"
                                                    aria-expanded="true" aria-controls="collapseOne<?php echo $i ?>">
                                                    <span style="font-size:19px;"><b><?php echo htmlentities($result->papername); ?></b></span>
                                                    <br>
                                                    <small style="font-size:15px;color:#337ab7"><i><?php echo htmlentities($result->authorname); ?></i></small>
                                                </p>
                                            </h2>
                                        </div>
                                        <div id="collapseOne<?php echo $i ?>" class="collapse <?php  echo $show;?>"
                                            aria-labelledby="headingOne<?php echo $i ?>"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="text-primary" style="font-size:1.25rem;">
                                                            <small>Published on <?php echo $publishdate; ?></small></h5>
                                                    </div>
                                                    <div>
                                                        <a style="font-size:20px;color:#007398;"
                                                            title="Download this file" href="<?php echo $filepath ?> "
                                                            target="_blank" role="button"><i class="fa fa-download"
                                                                aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                <p id="paper-abstract<?php echo htmlentities($result->id); ?>"
                                                    style="font-size:17px;font-weight:400;line-height: 1.7em;overflow: hidden;width:auto;">
                                                    <span style="font-weight:bold">Abstract:</span><?php echo htmlentities($result->abstract); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i=$i+1; }  ?>
                                </div>
                                <!---- Accordions Section ends  ---->
                                 <a style="font-size:19px;" class="text-dark float-right p-3" href="archive"><i>Find more...</i></a>
                            </td>
                        </tr>
                        <?php   }  ?>
                    </tbody>
                </table>
            </section>
            <!-- -------------------------------------Latest Publication section ends ---------------------- -->

            <!-- ----------------- Recently published paper section--------------------------  -->
            <section class="col-sm-12 col-md-12 col-xl-4 col-lg-4">
                <img src="images/ijournal_img.jpg" class="img-fluid img-thumbnail w-100 " alt="Journal Image">
                <div style="font-size:17px; text-align:justify;">
                    <p>The IUBAT Review is a multidisciplinary academic journal that the editors intend to publish
                        annually. The office of the journal is located at the International University of Business
                        Agriculture and Technology, the first non-government university in Bangladesh.
                    </p>
                    <p>IUBAT Review is peer-reviewed. The editors accept submissions from authors in Bangladesh and
                        elsewhere. The articles should generally analyze current issues relevant to management, social
                        sciences, engineering, agriculture, science and technology.
                    </p>
                    <div class="card bg-light mb-3 w-100 h-25">
                        <div class="card-header">RECENTLY PUBLISHED</div>
                        <div class="card-body">
                    <!-- If Published paper Showing Section Starts Here  -->                                   
                      <?php if ($total_published > 0) {
                            $sql = "SELECT paper.id,paper.paperid,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.pdate,paper.resubmitpaper from paper WHERE action=1 ORDER BY pdate DESC LIMIT 5";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                                if(!empty(htmlentities($result->resubmitpaper))) {
                                    $filepath = 'documents/resubmit/'.htmlentities($result->resubmitpaper);
                                }
                                else  {
                                    $filepath = 'documents/file2/'.htmlentities($result->resubmitpaper);
                                }
                            
                                $authoremail = htmlentities($result->authoremail);
                                $publishdatestring = htmlentities($result->pdate);
                                $publishdate = date("d-M-Y", strtotime($publishdatestring));
                                include 'link/selectauthorname.php'; ?>
                            <!-- <form action="paper-download" class="indexform" method="post">
                              -->
                                <a class="bg-transparent" style="color:black;font-size: 17px;border:none;outline:none;font-weight:500;text-align:left;cursor:pointer;"
                            href="<?php echo $filepath; ?> " target="_blank" role="button"><?php echo htmlentities($result->papername); ?></a>
                                
                            <!-- </form> -->
                            <h5 class="text-primary" style="font-size:16px;"><small><i class="fa fa-calendar" aria-hidden="true"></i> Published on <?php echo $publishdate; ?></small></h5>
                            <?php }  } ?>
                            <!-- If Published paper showing section ends here  -->
                        </div>
                    </div>
                    <!-- If Not Published paper showing section ends here  -->
                    <?php  } else {
                        $sql = "SELECT archive.id,archive.paperid,archive.versionissue,archive.papername,archive.authorname,archive.filename,archive.publisheddate,archive.abstract from archive where versionissue='$maximumyear' ORDER BY versionissue DESC LIMIT 5";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            $filepathname = htmlentities($result->filename);
                            $filepath = 'documents/archivefile/' . $filepathname;
                            $publishdatestring = htmlentities($result->publisheddate);
                            $publishdate = date("Y", strtotime($publishdatestring)); ?>
                            <a class="bg-transparent" href="<?php echo $filepath ?> " target="_blank" style="color:black;font-size: 17px;border:none;outline:none;font-weight:500;text-align:left;"><?php echo htmlentities($result->papername); ?></a>
                            <h5 class="text-dark" style="font-size:16px;"><small> <i class="fa fa-calendar" aria-hidden="true"></i> Published on <?php echo $publishdate; ?></small></h5>
                            </tr>
                            <?php } }  ?>
                </div>
            </div>
            <?php  }  ?>
            <!-- If Not Published paper showing section ends here  -->
        </section>
        <!-- Recently published paper section ends here  -->
    </div>
    <div class="pb-5"></div>
    </div>
    <!----------------------------- Footer ----------------------------- -->
    <?php include 'footer.php'; ?>
    <!----------------------------- Footer ----------------------------- -->
    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->
    <script>
    // Search bar
    $(document).ready(function() {
        $("#heading-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#heading-table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    // Search bar
    </script>
</body>
</html>